<div class="latest_orders mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--6-col">
	<h4 class="mdl-typography--display-1 main_heading">Последние заказы</h4>
	@foreach($recentOrders as $order)
		@include('admin.dashboard.order')
	@endforeach
</div>
<div class="latest_orders mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--6-col">
	<h4 class="mdl-typography--display-1 main_heading">Последние выполненные заказы</h4>
	@foreach($recentDoneOrders as $order)
		@include('admin.dashboard.order')
	@endforeach
</div>