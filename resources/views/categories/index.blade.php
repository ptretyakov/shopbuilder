@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li class="active">Категории товаров</li>
@stop

@section('content')

	<ul class='list-group'>
	@foreach ($categories as $category)
		<li class='list-group-item'>
			{!! link_to_route('admin.categories.show' , $category->title , [$category->id]) !!}
			{!! link_to_route('admin.categories.edit' , 'Редактировать' , [$category->id] , array('class' => 'btn btn-primary btn-xs edit-btn')) !!}
		</li>
	@endforeach
	</ul>

	<hr>
	{!! link_to_route('admin.categories.create' , 'Новая категория' , array(), array('class' => 'btn btn-success btn-s')) !!}
@stop