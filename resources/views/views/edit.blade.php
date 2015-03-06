@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('products' , 'Продукция') !!}</li>
	<li>{!! link_to_route('products.show' , $product->title , [$product->id]) !!}</li>
	<li>{!! link_to_route('products.edit' , 'Редактор' , [$product->id]) !!}</li>
	<li class="active">Внешний вид</li>
@stop

@section('content')

	<div id="gridster-system">
	
		<div id="gridster-control-panel">

			<div class="input-group">
				<div class="input-group-btn">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		            	Добавить виджет...
		            	<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu" role="menu" id="add-grid-widget">
						<li><a href="#" data-widget-type="text">с текстом</a></li>
						<li><a href="#" data-widget-type="image">с изображением</a></li>
						<li><a href="#" data-widget-type="parameters">с параметрами товара</a></li>
					<!--
					<li class="divider"></li>
					<li><a href="#">Separated link</a></li>
	            	-->
	            	</ul>

					<button type="button" class="btn btn-default" aria-expanded="false" id="delete-grid-widget" disabled="disabled">
						Удалить
					</button>
					<button type="button" class="btn btn-default" aria-expanded="false" id="edit-grid-widget" disabled  data-toggle="modal" data-target="#edit-widget-modal">
	            		Редактировать
					</button>
				</div>
			</div>

		</div>


		<div class="gridster">
		    <ul>
		    	
		    </ul>
		</div>

		<div class="modal fade bs-example-modal-lg" id="edit-widget-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Редакатирование виджета</h4>
					</div>
					<div class="modal-body">
						<p>One fine body&hellip;</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

	</div>

	

	<script type="text/template" id=""></script>

@stop