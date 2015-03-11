// Generated by CoffeeScript 1.9.0
(function() {
  var AdminApp;

  AdminApp = {
    Views: {},
    Collections: {},
    Models: {},
    initViews: {},
    initModels: {},
    initCollections: {}
  };

  AdminApp.Views.categoryParameters = Backbone.View.extend({
    el: '#edit-categories-form',
    $elParams: $('#category-edit-parameters'),
    $elLabels: $('#parameters-links'),
    $elSearchParams: $('#category-edit-searchparameters'),
    initialize: function() {
      var addSearchTag, deleteLabel, insertLabel;
      console.log('Initialize categoryParameters view');
      insertLabel = (function(_this) {
        return function(tagname) {
          var label;
          console.log('insertLabel');
          label = "<a href='#' class='label label-primary parameter-label'>" + tagname + "</a> ";
          return _this.$elLabels.append(label);
        };
      })(this);
      deleteLabel = (function(_this) {
        return function(tagname) {
          _this.$elLabels.find('a:contains(' + tagname + ')').remove();
          return _this.$elSearchParams.removeTag(tagname);
        };
      })(this);
      addSearchTag = (function(_this) {
        return function(tagname) {
          if (!_this.$elParams.tagExist(tagname)) {
            return _this.$elSearchParams.removeTag(tagname);
          }
        };
      })(this);
      this.$elParams.tagsInput({
        'width': '100%',
        'defaultText': 'добавить параметр',
        'onAddTag': function(tagname) {
          return insertLabel(tagname);
        },
        'onRemoveTag': function(tagname) {
          return deleteLabel(tagname);
        }
      });
      return this.$elSearchParams.tagsInput({
        'width': '100%',
        'defaultText': '',
        'onAddTag': function(tagname) {
          return addSearchTag(tagname);
        }
      });
    },
    events: {
      'click .parameter-label': 'clickParameterLebel'
    },
    clickParameterLebel: function(e) {
      var el, tag;
      e.preventDefault();
      el = $(e.target);
      tag = el.html();
      if (!this.$elSearchParams.tagExist(tag)) {
        return this.$elSearchParams.addTag(tag);
      } else {
        return console.log('Параметр уже существует');
      }
    }
  });

  AdminApp.Views.viewsGridSystem = Backbone.View.extend({
    el: '#gridster-system',
    $gridster: {},
    quillObject: {},
    responseData: {},
    $selectedWiget: null,
    $deleteWidget: $('#delete-grid-widget'),
    $editWidget: $('#edit-grid-widget'),
    $editModal: $('#edit-widget-modal'),
    $templateTextEditor: $('#template-text-editor'),
    $templateLoadImage: $('#template-load-views-image'),
    $templateParameters: $('#product-parameters-template'),
    $templateProductTitle: $('#product-title-template'),
    $widgetEditorBody: $('#widget-editor-body'),
    idTextEditor: 'full-editor',
    idTextEditorsToolbar: 'full-toolbar',
    initialize: function() {
      console.log('Inititalize viewsGridSystem');
      this.$gridster = $('.gridster > ul').gridster({
        widget_margins: [2, 2],
        widget_base_dimensions: [25, 25],
        autogrow_cols: true,
        max_cols: 25,
        resize: {
          enabled: true
        }
      }).data('gridster');
      this.$editModal.on('shown.bs.modal', (function(_this) {
        return function() {
          console.log('Открываем редактор для ' + _this.$selectedWiget.attr('data-widget-type'));
          return _this.initEditor(_this.$selectedWiget.attr('data-widget-type'));
        };
      })(this));
      return this.$editModal.on('hide.bs.modal', (function(_this) {
        return function() {
          _this.$widgetEditorBody.html(' ');
          return _this.$widgetEditorBody.append('<div class="loader"></div>');
        };
      })(this));
    },
    events: {
      'click #add-grid-widget': 'addWidget',
      'click .gs-w': 'clickWidget',
      'click #delete-grid-widget': 'deleteWidget',
      'click #edit-grid-widget': 'openEditDialog',
      'click #widget-save-changes': 'saveWidgetContent',
      'submit #widget-editor-body form': 'loadImage'
    },
    saveWidgetContent: function() {
      var type;
      type = this.$selectedWiget.attr('data-widget-type');
      switch (type) {
        case 'text':
          return this.saveTextWidget();
        case 'image':
          return this.saveImageWidget();
      }
    },
    saveTextWidget: function() {
      var html;
      html = this.quillObject.getHTML();
      console.log(html);
      return this.$selectedWiget.html(html + '<span class="gs-resize-handle gs-resize-handle-both"></span>');
    },
    openEditDialog: function() {},
    initEditor: function(type) {
      switch (type) {
        case 'text':
          return this.initTextEditor();
        case 'image':
          return this.initImageEditor();
      }
    },
    saveImageWidget: function() {
      console.log('Close image widget');
      this.$selectedWiget.html('<span class="gs-resize-handle gs-resize-handle-both"></span>');
      return this.$selectedWiget.css({
        'background-repeat': 'no-repeat',
        'background-image': 'url(' + this.responseData.imageurl + ')',
        'background-size': 'contain'
      });
    },
    loadImage: function(e) {
      var data, form, pb, resdiv, status, xhr;
      e.preventDefault();
      form = e.target;
      data = new FormData(form);
      xhr = new XMLHttpRequest();
      pb = $('#progress-load-image');
      status = $('#status-load-image');
      resdiv = $('#result-load-image');
      if ($(form).find('input[type=file]').val() !== '') {
        xhr.open('POST', form.action);
        xhr.onload = (function(_this) {
          return function(e) {
            var result;
            status.text(e.currentTarget.responseText);
            result = JSON.parse(e.currentTarget.responseText);
            console.log(result.imageurl);
            resdiv.css('background-image', 'url(' + result.imageurl + ')');
            return _this.responseData = result;
          };
        })(this);
        xhr.upload.onprogress = function(e) {
          return pb.progressbar("value", e.loaded / e.total * 100);
        };
        return xhr.send(data);
      } else {
        return status.text("Необходимо выбрать файл");
      }
    },
    initImageEditor: function() {
      console.log('Init image editor');
      this.$widgetEditorBody.html(this.$templateLoadImage.html());
      $('#progress-load-image').progressbar({
        option: {
          value: false
        }
      });
      if (!window.FormData) {
        return $('#status-load-image').text("Ваш браузер не потдерживает FormData");
      }
    },
    initTextEditor: function() {
      var content;
      content = this.$selectedWiget.html();
      this.$widgetEditorBody.html(this.$templateTextEditor.html());
      $('#' + this.idTextEditor).html(content);
      return this.quillObject = makeQuill(this.idTextEditor, this.idTextEditorsToolbar);
    },
    deleteWidget: function() {
      this.$deleteWidget.attr('disabled', 'disabled');
      this.$editWidget.attr('disabled', 'disabled');
      this.$gridster.remove_widget(this.$selectedWiget);
      return this.selectedWiget = null;
    },
    unselectWidget: function() {
      if (this.$selectedWiget != null) {
        this.$selectedWiget.css({
          'background': '#ddd'
        });
      }
      return this.$selectedWiget = null;
    },
    addWidget: function(e) {
      var el, text, type;
      e.preventDefault();
      el = $(e.target);
      type = el.attr('data-widget-type');
      text = el.text();
      switch (type) {
        case 'parameters':
          text = this.$templateParameters.html();
          break;
        case 'title':
          text = this.$templateProductTitle.html();
      }
      return this.$gridster.add_widget('<li data-widget-type="' + type + '" class="' + type + '-widget">' + text + '</li>', 4, 4);
    },
    clickWidget: function(e) {
      var el;
      e.preventDefault();
      el = $(e.target);
      if (!el.is('li')) {
        el = el.parent('li.gs-w');
      }
      console.log('Click on widget');
      if (this.$selectedWiget != null) {
        this.$selectedWiget.css({
          'border': '1px dashed #ccc'
        });
      }
      this.$selectedWiget = el;
      this.$deleteWidget.removeAttr('disabled');
      this.$editWidget.removeAttr('disabled');
      return this.$selectedWiget.css({
        'border': '1px solid #ccc'
      });
    }
  });

  AdminApp.initViews.categoryParameters = new AdminApp.Views.categoryParameters();

  AdminApp.initViews.viewsGridSystem = new AdminApp.Views.viewsGridSystem();


  /*
  $('#typeWidget').on 'change' , ->
  	console.log "Test change"
   */

}).call(this);
