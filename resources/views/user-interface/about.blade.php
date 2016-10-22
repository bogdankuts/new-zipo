@extends('user-interface.layout')
@include('user-interface.partials.initial-meta')
@extends('user-interface.partials.header')
@extends('user-interface.partials.left-sidebar')
@extends('user-interface.partials.right-sidebar')
@extends('user-interface.partials.footer')

@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
			<li><a href="{{route('index')}}">Главная</a></li>
			<li class="active">О нас</li>
		</ol>
		<h2 class="about_heading universal_heading">О нас</h2>
		<hr class="main_hr">
		<div class="about_text_block">
			<p class="about_text">Наши виды деятельности </p>
			<b><p class="about_text">Обеспечение запасными частями любого Российского или импортного оборудования, (номенклатура 3 миллиона позиций).</p></b>
			<p class="about_text">Наша компания  предлагает широкий ассортимент комплектующих и запасных частей импортного и российского производства для торгового, холодильного, теплового и другого оборудования, используемого на предприятиях общественного питания, торговли, сферы услуг и пищевых производствах.</p>
			<p class="about_text">Среди наших партнеров как предприятия торговли, общественного питания, производственные предприятия так и организации, занимающиеся сервисным обслуживанием.</p>
			<p class="about_text">Запчасти данных производителей у нас есть в наличие , на складе в Санкт Петербурге</p>
			<img src="/img/markup/brand_1.png" alt="" class="about_brand">
			<img src="/img/markup/brand_2.png" alt="" class="about_brand">
			<img src="/img/markup/brand_3.png" alt="" class="about_brand">
			<img src="/img/markup/brand_4.png" alt="" class="about_brand">
			<img src="/img/markup/brand_5.png" alt="" class="about_brand">
			<img src="/img/markup/brand_6.png" alt="" class="about_brand">
			<img src="/img/markup/brand_7.png" alt="" class="about_brand">
			<img src="/img/markup/brand_8.png" alt="" class="about_brand">
			<img src="/img/markup/brand_9.png" alt="" class="about_brand">
			<img src="/img/markup/brand_10.png" alt="" class="about_brand">
			<img src="/img/markup/brand_11.png" alt="" class="about_brand">
			<img src="/img/markup/brand_12.png" alt="" class="about_brand">
			<img src="/img/markup/brand_13.png" alt="" class="about_brand">
			<img src="/img/markup/brand_14.png" alt="" class="about_brand">
			<img src="/img/markup/brand_15.png" alt="" class="about_brand">
			<img src="/img/markup/brand_16.png" alt="" class="about_brand">
			<img src="/img/markup/brand_17.png" alt="" class="about_brand">
			<img src="/img/markup/brand_18.png" alt="" class="about_brand">
			<img src="/img/markup/brand_19.png" alt="" class="about_brand">
			<img src="/img/markup/brand_20.png" alt="" class="about_brand">
			<img src="/img/markup/brand_21.png" alt="" class="about_brand">
			<img src="/img/markup/brand_22.png" alt="" class="about_brand">
			<img src="/img/markup/brand_23.png" alt="" class="about_brand">
			<img src="/img/markup/brand_24.png" alt="" class="about_brand">
			<img src="/img/markup/brand_25.png" alt="" class="about_brand">
			<img src="/img/markup/brand_26.png" alt="" class="about_brand">
			<img src="/img/markup/brand_27.png" alt="" class="about_brand">
			<img src="/img/markup/brand_28.png" alt="" class="about_brand about_brand_last">
			<b><p class="about_text">Поставка оборудования для вашего ресторана, кафе столовой или др. точки общественного  питания.</p></b>
			<b><p class="about_text">Постановка на сервисное обслуживание.</p></b>
			<p class="about_text">Процедура постановки, ресторана, кафе, магазина на сервис торгового оборудования в нашей компании выглядит следующим образом:</p>
			<ol>
				<li><p class="about_text about_list">Вы оформляете заявку по телефону /факсу или на эл. почту <a href="mailto:9872206@mail.ru">9872206@mail.ru</a>  в заявке нужно указать перечень оборудования.</p></li>
				<li><p class="about_text about_list">С Вами связывается наш специалист и договаривается о встрече;</p></li>
				<li><p class="about_text about_list">Производится осмотр Вашего оборудования;</p></li>
				<li><p class="about_text about_list">Выдается заключение об осмотре оборудования, для постановки на сервисное обслуживание а также рекомендации по эксплуатации;</p></li>
				<li><p class="about_text about_list">В случае Вашего согласия, оформляется договор сервисного обслуживания.</p></li>
			</ol>
			<p class="about_text">Что Вы получаете заключив с нами договор сервисного обслуживания:</p>
			<ul>
				<li><p class="about_text about_list">профилактические работы не менее 1-го раза в месяц;</p></li>
				<li><p class="about_text about_list">выезд на объект не позже чем через 4 часа с момента заявки;;</p></li>
				<li><p class="about_text about_list">ремонт оборудования за наш счет;</p></li>
				<li><p class="about_text about_list">наличие запчастей на нашем складе;</p></li>
				<li><p class="about_text about_list">обучение персонала в эксплуатации оборудования.</p></li>
			</ul>
			{{--<img src="/img/markup/giant_banner.png" alt="" class="giant_banner">--}}
			<b><p class="about_text">Обращаем ваше внимание на то, что сведения, размещенные на данном интернет-сайте, носят исключительно информативный характер и ни при каких условиях не могут расцениваться как публичная оферта, определяемая положениями Статьи 437 ГК РФ</p></b>
		</div>
	</div>
@stop