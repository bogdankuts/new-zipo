@if($notifications['newAdmins'] > 0
        || $notifications['newClients'] > 0
        || $notifications['newOrders'] > 0
        || $notifications['newUsers'] > 0
        || $notifications['newArticles'] > 0
        || $notifications['newDiscount'] != ''
        )
	<div class="notifications mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<h4 class="mdl-typography--display-1 main_heading">Со времени вашего последнего входа произошло следующее</h4>
		@if($notifications['newAdmins'] > 0)
			<div class="one_notification" id="newAdmins">
				<div class= "content">
					<div class="">
						<div class="mdl-badge" data-badge="{{$notifications['newAdmins']}}" id="new_admins">
							<i class="material-icons notification_icon">person_add</i>
						</div>
					</div>
					<div class="mdl-card__actions">
						<a href="/admin/new-admins-after-last-visit/{{$lastVisit}}" target="_blank" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
							Подробнее
						</a>
					</div>
					<div class="mdl-card__menu">
						<button class="mdl-button mdl-js-button mdl-button--icon close_notification-admins">
							<i class="material-icons">close</i>
						</button>
					</div>
					<div class="mdl-tooltip" for="new_admins">
						Новые админы
					</div>
				</div>
			</div>
		@endif
		@if($notifications['newClients'] > 0)
			<div class="one_notification" id="newClients">
				<div class= "content">
					<div class="">
						<div class="mdl-badge" data-badge="{{$notifications['newClients']}}" id="new_clients">
							<i class="material-icons notification_icon">person</i>
						</div>
					</div>
					<div class="mdl-card__actions">
						<a href="/admin/new-clients-after-last-visit/{{$lastVisit}}" target="_blank" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
							Подробнее
						</a>
					</div>
					<div class="mdl-card__menu">
						<button class="mdl-button mdl-js-button mdl-button--icon close_notification-clients">
							<i class="material-icons">close</i>
						</button>
					</div>
					<div class="mdl-tooltip" for="new_clients">
						Новые Клиенты
					</div>
				</div>
			</div>
		@endif
		@if($notifications['newOrders'] > 0)
			<div class="one_notification" id="newOrders">
				<div class= "content">
					<div class="">
						<div class="mdl-badge" data-badge="{{$notifications['newOrders']}}" id="new_orders">
							<i class="material-icons notification_icon">folder_open</i>
						</div>
					</div>
					<div class="mdl-card__actions">
						<a href="/admin/new-orders-after-last-visit/{{$lastVisit}}" target="_blank" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
							Подробнее
						</a>
					</div>
					<div class="mdl-card__menu">
						<button class="mdl-button mdl-js-button mdl-button--icon close_notification-orders">
							<i class="material-icons">close</i>
						</button>
					</div>
					<div class="mdl-tooltip" for="new_orders">
						Новые заказы
					</div>
				</div>
			</div>
		@endif
		@if($notifications['newUsers'] > 0)
			<div class="one_notification" id="newUsers">
				<div class= "content">
					<div class="">
						<div class="mdl-badge" data-badge="{{$notifications['newUsers']}}" id="new_users">
							<i class="material-icons notification_icon">account_box</i>
						</div>
					</div>
					<div class="mdl-card__actions">
						<a href="/admin/new-users-after-last-visit/{{$lastVisit}}" target="_blank" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
							Подробнее
						</a>
					</div>
					<div class="mdl-card__menu">
						<button class="mdl-button mdl-js-button mdl-button--icon close_notification-users">
							<i class="material-icons">close</i>
						</button>
					</div>
					<div class="mdl-tooltip" for="new_users">
						Новые Пользователи
					</div>
				</div>
			</div>
		@endif
		@if($notifications['newArticles'] > 0)
			<div class="one_notification" id="newArticles">
				<div class= "content">
					<div class="">
						<div class="mdl-badge" data-badge="{{$notifications['newArticles']}}" id="new_articles">
							<i class="material-icons notification_icon">description</i>
						</div>
					</div>
					<div class="mdl-card__actions">
						<a href="/admin/new-articles-after-last-visit/{{$lastVisit}}" target="_blank" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
							Подробнее
						</a>
					</div>
					<div class="mdl-card__menu">
						<button class="mdl-button mdl-js-button mdl-button--icon close_notification-articles">
							<i class="material-icons">close</i>
						</button>
					</div>
					<div class="mdl-tooltip" for="new_articles">
						Новые статьи
					</div>
				</div>
			</div>
		@endif
		@if($notifications['newDiscount'] != '')
			<div class="one_notification" id="newDiscount">
				<div class= "content">
					<div class="">
						<div class="mdl-badge" data-badge="1" id="new_discount">
							<i class="material-icons notification_icon">local_atm</i>
						</div>
					</div>
					<p class="full_block">{{$notifications['newDiscount']}}</p>
					<div class="mdl-card__menu">
						<button class="mdl-button mdl-js-button mdl-button--icon close_notification-discount">
							<i class="material-icons">close</i>
						</button>
					</div>
					<div class="mdl-tooltip" for="new_discount">
						Новая скидка
					</div>
				</div>
			</div>
		@endif
	</div>
@endif