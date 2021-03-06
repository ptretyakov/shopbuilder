<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Faker;
use Session;
use App\Product;
use App\Cart;

use Illuminate\Http\Request;


class TestsController extends Controller {

	public function getGoga(){
		$faker 		= Faker\Factory::create();
		$companies 	= ['Samsung' , 'Apple' , 'Nokia' , 'Motorolla' , 'LG' , 'Fly' , 'Philips' , 'Panasonic'];
		$parameters = ['вес' , 'ширина' , 'ос' , 'количество ядер' , 'частота процессора' , 'оперативная память' , 'диагональ экрана'];

		/* PRODUCTS TABLE DATA */
		$title 		= $companies[array_rand($companies , 1)]. " " .$faker->bothify('?##');
		$price 		= $faker->randomNumber(5);
		$count 		= $faker->randomNumber(2);
		$category 	= 1;
		$view 		= '<div class="gridster ready"><ul style="width: 725px; position: relative; height: 957px;"><li data-widget-type="title" class="title-widget gs-w" data-col="1" data-row="1" data-sizex="25" data-sizey="2" style="display: list-item;"><div class="product-title">'.$title.'</div><span class="gs-resize-handle gs-resize-handle-both"></span></li><li data-widget-type="parameters" class="parameters-widget gs-w" data-col="11" data-row="3" data-sizex="15" data-sizey="5" style="display: list-item;"><p>вес : <strong>200</strong></p> <p>ширина : <strong>4</strong></p> <p>ос : <strong>Android</strong></p> <p>количество ядер : <strong>4</strong></p> <p>оперативная память : <strong>1500</strong></p><span class="gs-resize-handle gs-resize-handle-both"></span></li><li data-widget-type="text" class="text-widget gs-w" data-col="11" data-row="8" data-sizex="15" data-sizey="9" style="display: list-item;"><div><b><span style="font-size: 18px;">Корпус с отделкой под настоящую кожу</span></b></div><div style="text-align: justify;">Оформленный «под кожу» корпус Samsung GALAXY Note3 Neo с отделкой декоративным стежком мгновенно выделяет смартфон среди других моделей и привлекает взгляды. Покрытие «под кожу» не только придает устройству элегантность и дополнительно защищает корпус от царапин, но и удобно ложится в ладонь, не грозя выскользнуть при неловком движении. Тонкость и изящество смартфона производят незабываемое впечатление. Вы можете придерживаться традиционной черной или белой цветовой схемы или попробовать более смелый ментоловый оттенок, если хотите выразить свое чувство стиля и оригинальность всего</div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span></li><li data-widget-type="image" class="image-widget gs-w" data-col="1" data-row="3" data-sizex="10" data-sizey="14" style="display: list-item;"><div class="image-widget-backdiv" style="background-image: url(http://localhost:8000/upimages/products_1_39238.jpeg);"></div><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span></li><li data-widget-type="text" class="text-widget gs-w" data-col="1" data-row="17" data-sizex="25" data-sizey="2" style="display: list-item;"><div style="text-align: center;"><span style="font-size: 32px;"><b>Пример тектового поля</b></span></div><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span></li><li data-widget-type="image" class="image-widget gs-w" data-col="1" data-row="19" data-sizex="25" data-sizey="15" style="display: list-item;"><div class="image-widget-backdiv" style="background-image: url(http://localhost:8000/upimages/products_1_74791.jpg);"></div><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span><span class="gs-resize-handle gs-resize-handle-both"></span></li></ul></div>';
		$editview 	= '[{"id":"","col":1,"row":1,"size_x":25,"size_y":2,"type":"title","htmlContent":"<div class=\"product-title\"><%= title %></div>\n\t"},{"id":"","col":11,"row":3,"size_x":15,"size_y":5,"type":"parameters","htmlContent":"<%= parameters %>"},{"id":"","col":11,"row":8,"size_x":15,"size_y":9,"type":"text","htmlContent":"<div><b><span style=\"font-size: 18px;\">Корпус с отделкой под настоящую кожу</span></b></div><div style=\"text-align: justify;\">Оформленный «под кожу» корпус Samsung GALAXY Note3 Neo с отделкой декоративным стежком мгновенно выделяет смартфон среди других моделей и привлекает взгляды. Покрытие «под кожу» не только придает устройству элегантность и дополнительно защищает корпус от царапин, но и удобно ложится в ладонь, не грозя выскользнуть при неловком движении. Тонкость и изящество смартфона производят незабываемое впечатление. Вы можете придерживаться традиционной черной или белой цветовой схемы или попробовать более смелый ментоловый оттенок, если хотите выразить свое чувство стиля и оригинальность всего</div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span>"},{"id":"","col":1,"row":3,"size_x":10,"size_y":14,"type":"image","htmlContent":"<div class=\"image-widget-backdiv\" style=\"background-image: url(http://localhost:8000/upimages/products_1_39238.jpeg);\"></div><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span>"},{"id":"","col":1,"row":17,"size_x":25,"size_y":2,"type":"text","htmlContent":"<div style=\"text-align: center;\"><span style=\"font-size: 32px;\"><b>Пример тектового поля</b></span></div><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span>"},{"id":"","col":1,"row":19,"size_x":25,"size_y":15,"type":"image","htmlContent":"<div class=\"image-widget-backdiv\" style=\"background-image: url(http://localhost:8000/upimages/products_1_74791.jpg);\"></div><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span><span class=\"gs-resize-handle gs-resize-handle-both\"></span>"}]';
		$visible 	= 1;



		echo str_replace(' ' , '_' , $title);

	}

	public function getAuthtest(){
		if(Auth::check()){
			echo "<p>User login</p>";
		}else{
			echo "<p>User don't login</p>";
		}

		$user = Auth::user();

		echo $user->id;

	}

	public function getCarts(){
		$cart = Cart::findOrFail(1)->get();

		echo $cart;
	}

	public function getProduct(){
		$product = Product::find(78);

		if ($product) {
			echo "Product isset";
		} else {
			echo "Product don't isset!";
		}
		
	}

	public function getZero(){
		$test = 0;
		if ($test) {
			echo "True";
		} else {
			echo "False";
		}
		
	}

	public function getSession(){
		Session::regenerate();
		Session::push('cart', 'test');
		Session::push('cart', 'test1');

		dd(Session::get('cart'));
	}

}
