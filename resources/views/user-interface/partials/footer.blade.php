@section('footer')
	<footer>
		<div class="full_screen">
			<div @if($snow == '1') id="snow" @endif>
				<div class="container_zipo" >
					<a href="/" class="logo_footer">
						{{ Html::image("img/markup/logo_footer.jpg", "logo", ['class'=>'logo_footer_i']) }}
					</a>
					<nav class="nav_footer">
						@if($snow == '1')
							<p class="greetings"> Компания Зип Общепит желает Вам хорошего Нового Года и счастливого Рождества!</p>
						@endif
						<ul class="nav_footer_ul">
							<li class="@if ($env == 'catalog' || $env == 'byproducer' || $env == 'search') active @endif">
								<a href="/">Каталог</a>
							</li>
							<li class="@if ($env == 'price') active @endif"><a href="{{route('price_page')}}">Прайс-лист</a></li>
							<li class="@if ($env == 'delivery') active @endif"><a href="{{route('delivery')}}">Доставка</a></li>
							<li class="@if ($env == 'specials') active @endif"><a href="{{route('specials')}}">Специальные предложения</a></li>
							<li class="@if ($env == 'about') active @endif"><a href="{{route('about')}}">О нас</a></li>
							<li class="@if ($env == 'contacts') active @endif"><a href="{{route('contacts')}}">Контакты</a></li>
						</ul>
					</nav>
					<div class="footer_description_block">
						<p class="footer_description">Кухонное оборудование запасные части<br>
							к оборудованию предприятий общественного питания</p>
						<p class="footer_copy"><i class="fa fa-copyright"></i>2015. "Зип Общепит" All rights reserved</p>
						<p class="footer_link">made by <a href="http://www.dev.bzzz.biz.ua">bzzz! web development studio</a></p>
					</div>
				</div>
			</div>
		</div>
	</footer>
@stop