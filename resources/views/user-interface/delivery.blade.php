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
			<li class="active">Доставка</li>
		</ol>
		<h2 class="about_heading universal_heading">Доставка</h2>
		<hr class="main_hr">
		<div class="about_text_block">
			<p><b>Доставка по России, Белоруссии ,Казахстан.</b></p>
			<p>Доставка осуществляется после 100%-й оплаты стоимости товара. Все заботы по отправке товара к Вам мы берем на себя. Стоимость доставки Вы можете рассчитать самостоятельно, например, на сайтах компаний, с которыми мы работаем, либо запросить у менеджера.</p>
			<p><b>Срок отгрузки со склада.</b></p>
			<p>Срок отгрузки со склада один рабочий день.<br> Если товар находится на основном складе компании.</p>
			<img src="/img/markup/ems.png" alt="EMS" class="delivery_logo">
			<p><b>Экспресс-доставка по всей России и 190 странам мира. <a href="http://www.emspost.ru/ru/calc/">EMS</a>  (Рекомендуем)</b></p>
			<p>Тарифы на перевозки грузов, можно посмотреть <a href="http://www.emspost.ru/ru/calc/">тут</a></p>
			<p>В любую точку страны , самые низкие цены.</p>
			<img src="/img/markup/elain.png" alt="Elain" class="delivery_logo">
			<p><b>Экспресс-доставка из г. Санкт Петербург  в  Москву - <a href="http://elainexpress.ru">Элайн Экспресс</a> (Рекомендуем в  Москву)</b></p>
			<p>450 -500 руб. Возможна оплата за доставку при получении.</p>
			<img src="/img/markup/evrodostavka.png" alt="SDEK" class="delivery_logo">
			<p><b>Экспресс-доставка по России - <a href="http://www.edostavka.ru/calculator.html">СДЭК.</a></b></p>
			<p>Возможна оплата за доставку при получении. Тарифы на перевозки грузов, можно посмотреть <a href="http://www.edostavka.ru/calculator.html">тут.</a></p>
			<img src="/img/markup/dellin.png" alt="Dellin" class="delivery_logo">
			<p><b>Доставка до терминала в г. Санкт Петербург – <a href="http://spb.dellin.ru/requests/">ТК Деловые Линии</a> - 150 руб.</b></p>
			<p>Тарифы на перевозки грузов, можно посмотреть <a href="http://spb.dellin.ru/requests/">тут</a></p>
			<img src="/img/markup/ratek.jpg" alt="RATEK" class="delivery_logo">
			<p><b>Доставка до терминала в г. Санкт Петербург – <a href="http://www.rateksib.ru/tarify/">ТК Ратэк</a> - 150 руб.</b></p>
			<p>Тарифы на перевозки грузов, можно посмотреть <a href="http://www.rateksib.ru/tarify/">тут</a></p>
			<img src="/img/markup/pek.png" alt="PEK" class="delivery_logo">
			<p><b>Доставка до терминала в г. Санкт Петербург - <a href="http://pecom.ru/services-are/the-calculation-of-the-cost/">ТК ПЭК</a> - 200руб.</b></p>
			<p><p>Тарифы на перевозки грузов, можно посмотреть <a href="http://pecom.ru/services-are/the-calculation-of-the-cost/">тут</a></p></p>
			<img src="/img/markup/zde.png" alt="ZDE" class="delivery_logo">
			<p><b>Доставка до терминала в г. Санкт Петербург – <a href="http://www.jde.ru/online/calculator.html">ТК ЖелДорЭкспедиция</a> - 200руб.</b></p>
			<p><p>Тарифы на перевозки грузов, можно посмотреть <a href="http://www.jde.ru/online/calculator.html">тут</a></p></p>
			<img src="/img/markup/kit.png" alt="KIT" class="delivery_logo">
			<p><b>Доставка до терминала в г. Санкт Петербург - <a href="http://calc.tk-kit.ru/calc/">ТК КИТ</a> - 200руб.</b></p>
			<p><p>Тарифы на перевозки грузов, можно посмотреть <a href="http://calc.tk-kit.ru/calc/">тут</a></p></p>
			<p style="margin-top: 20px;"><b>Посомтреть стоимость доставки на адрес по Санкт-Петерургу можно <a href="/map">тут</a></b></p>
		</div>
	</div>
@stop