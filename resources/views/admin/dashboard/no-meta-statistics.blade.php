@if($noMetaItems != 0 || $noMetaArticles != 0 )
	<div class="review mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<h4 class="mdl-typography--display-1 main_heading">Обзор товаров и новостей</h4>
		<div class="charts">
			<div class="items @if ($noMetaArticles = 0) only @endif">
				<h5 class="mdl-typography--title title">Товары</h5>
				<canvas id="itemBasicChart" width="400" height="400"></canvas>
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent stats_more" id="items_more_statistic">
					Подробнее
				</button>
			</div>
			<div class="articles @if ($noMetaItems = 0) only @endif">
				<h5 class="mdl-typography--title title">Новости</h5>
				<canvas id="articleBasicChart" width="400" height="400"></canvas>
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent stats_more" id="articles_more_statistic">
					Подробнее
				</button>
			</div>
		</div>
	</div>
	<div class="items_more_statistic_block mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<div class="charts">
			<div class="one_graph">
				<h5 class="mdl-typography--title title">Товары без "meta-title"</h5>
				<canvas id="itemsTitleChart" width="200" height="200"></canvas>
				<a href="{{route('nt_items_admin')}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
					Посмотреть список
				</a>
			</div>
			<div class="one_graph">
				<h5 class="mdl-typography--title title">Товары без "meta-description"</h5>
				<canvas id="itemsDescriptionChart" width="200" height="200"></canvas>
				<a href="{{route('nd_items_admin')}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
					Посмотреть список
				</a>
			</div>
		</div>
	</div>
	<div class="articles_more_statistic_block mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<div class="charts">
			<div class="one_graph">
				<h5 class="mdl-typography--title title">Новости без "meta-title"</h5>
				<canvas id="articlesTitleChart" width="200" height="200"></canvas>
				<a href="{{route('nt_articles_admin')}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
					Посмотреть список
				</a>
			</div>
			<div class="one_graph">
				<h5 class="mdl-typography--title title">Новости без "meta-description"</h5>
				<canvas id="articlesDescriptionChart" width="200" height="200"></canvas>
				<a href="{{route('nd_articles_admin')}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
					Посмотреть список
				</a>
			</div>
		</div>
	</div>
@endif