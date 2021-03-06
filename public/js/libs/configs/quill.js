window.makeQuill = function (idEditor , idToolbar){

  console.log ('Initialize quill editor' , idEditor , idToolbar);

  // Initialize editor with custom theme and modules
  var fullEditor = new Quill('#'+idEditor, {
    modules: {
      'multi-cursor': true,
      'toolbar': { container: '#'+idToolbar },
      'link-tooltip': true
    },
    theme: 'snow'
  });

  return fullEditor;
}