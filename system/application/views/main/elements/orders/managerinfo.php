<? $is_own_bid = isset($this->user->user_id);if ($is_own_bid){	$is_own_bid = ($bid->manager_id == $this->user->user_id OR 		$order->order_manager == $this->user->user_id OR 		$order->order_client == $this->user->user_id);}	if (empty($bid->statistics)) {//	$bid->statistics = $order->statistics;}?><div class='managerinfo'>	<span class="total">		Итого за заказ: <span class="order_total_cost"><?=$bid->total_cost?></span> <?=$order->order_currency?>		<? if ($is_own_bid) : ?>		<div class="biddetails">			<div class="expand">				<a href="javascript:expandBidDetails('<?= isset($bid) ? $bid->bid_id : 0 ?>');">подробнее</a>			</div>			<div>				<b>Расходы по заказу:</b>			</div>			<div><?=$order->order_products_cost?> <?=$order->order_currency?> <img class="tooltip" src="/static/images/mini_help.gif" title="Общая стоимость товаров в заказе"></div>			<div><?=$bid->manager_tax?> <?=$order->order_currency?> <img class="tooltip" src="/static/images/mini_help.gif" title="Комиссия посредника"></div>			<? if ($bid->foto_tax) : ?>			<div><?=$bid->order_tax?> <?=$order->order_currency?> <img class="tooltip" src="/static/images/mini_help.gif" title="Фото товаров"></div>			<? endif; ?>			<div><?=$bid->delivery_cost?> <?=$order->order_currency?> <img class="tooltip" src="/static/images/mini_help.gif" title="Стоимость доставки<?=empty($bid->delivery_cost) ? '' : ", $bid->delivery_name" ?>"></div>			<div>				<b>Итого: <?=$bid->total_cost?> <?=$order->order_currency?></b>			</div>			<div class="collapse">				<a href="javascript:collapseBidDetails('<?=$bid->bid_id?>');">свернуть</a>			</div>		</div>		<? endif; ?>	</span>	<? if (isset($bid->statistics)) : ?>	<img src='/static/images/avatar.png'>	<a href="/"><?= $bid->statistics->fullname ?></a>	(№ <?= empty($bid) ? $this->user->user_id : $bid->manager_id ?>)	<br>	<div>		<div class='rating'>			<a>+ 1</a> / <?=$this->session->userdata('manager_rating')?> / <a>- 1</a>		</div>		<a href='<?=$bid->statistics->website?>' class='manager_url'><?=$bid->statistics->website?></a>		<span class='label'>Выполненных заказов: <?=$bid->statistics->completed_orders?></span>	</div>	<br>	<? endif; ?>	<div class="status">		<? if (isset($bid->statistics)) : ?>		<span class='label status'>			<center>				100%<br>CASHBACK			</center>		</span>		<? endif; ?>		<span class='label'><?= isset($bid->created) ? date('d.m.Y h:i', strtotime($bid->created)) : date('d.m.Y h:i')?></span>	</div></div>