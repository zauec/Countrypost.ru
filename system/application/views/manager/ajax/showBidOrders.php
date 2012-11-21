<form id="pagerForm" class='admin-inside' action="<?= $selfurl ?>closeOrders" method="POST">
	<? View::show($viewpath.'elements/orders/tabs', array('selected_submenu' => 'bid_orders')); ?>
	<div class='table centered_th centered_td'>
		<div class='angle angle-lt'></div>
		<div class='angle angle-rt'></div>
		<div class='angle angle-lb'></div>
		<div class='angle angle-rb'></div>
		<table>
			<tr>
				<th>Номер заказа</th>
				<th>Клиент</th>
				<th>Доставка в</th>
				<th>Общая стоимость</th>
				<th></th>
			</tr>
			<?if ($orders) : foreach($orders as $order) : ?>
			<tr>
				<td>
					<a href="<?= $selfurl . 'order/' . $order->order_id ?>"><b><?= $order->order_id ?></b></a>
					<br />
					<? if ($order->order_type == 'online' OR $order->order_type == 'offline') : ?>
					<?= $order->order_type ?> заказ
					<? elseif ($order->order_type == 'service') : ?>
					Услуга
					<? elseif ($order->order_type == 'delivery') : ?>
					Доставка
					<? endif; ?>
					<br />
					<? if ($order->package_day == 0) : ?>
					<?= $order->package_day == 0 ? "" : $order->package_day.' '.humanForm((int)$order->package_day, "день", "дня", "дней") ?> <?= $order->package_hour == 0 ? "" : $order->package_hour.' '.humanForm((int)$order->package_hour, "час", "часа", "часов") ?> назад
					<? else : ?>
					<?= $order->order_date ?>
					<? endif; ?>
				</td>
				<td>
					<a target="_blank" href="<?= BASEURL . $order->client_login ?>"><?= $order->client_login ?></b>
				</td>
				<td style="text-align:left;">
					<img src="/static/images/flags/<?= $order->order_country_to_en ?>.png" style="float:left;margin-right:10px;" />
					<b style="position:relative;top:6px;"><?= $order->order_country_to ?></b>
				</td>
				<td>
					<?= $order->order_products_cost + $order->order_delivery_cost ?> <?= $order->currency ?>
				</td>
				<td>
					<a href="<?= $selfurl ?>order/<?= $order->order_id ?>">Посмотреть</a>
				</td>
			</tr>
			<? endforeach; else : ?>
			<tr>
				<td colspan="5">
					Заказы не найдены.
				</td>
			</tr>
			<? endif; ?>
		</table>
	</div>
</form>
<?= $pager ?>