<div class='table centered_td centered_th'>
	<div class='angle angle-lt'></div>
	<div class='angle angle-rt'></div>
	<div class='angle angle-lb'></div>
	<div class='angle angle-rb'></div>
	<? if (isset($Orders2In) AND $Orders2In): ?>
	<table>
		<col width='auto' />
		<col width='auto' />
		<col width='auto' />
		<col width='auto' />
		<col width='auto' />
		<col width='auto' />
		<col width='1px' />
		<tr>
			<th>№ заявки</th>
			<th>№ заказа / посредник</th>
			<th>Сумма оплаты</th>
			<th>Сумма перевода</th>
			<th>Способ оплаты</th>
			<th>Статус</th>
			<th></th>
		</tr>
		<? foreach ($Orders2In as $o2i) : ?>
		<tr>
			<td>
				<b>№ <?= $o2i->order2in_id ?></b>
				<br />
				<?= date("d.m.Y H:i", strtotime($o2i->order2in_createtime)) ?>
			</td>
			<td>
				<a href="/manager/order/<?= $o2i->order_id ?>">№<?= $o2i->order_id ?></a>
				<br>
				<?= $order_types[$order->order_type] ?>
				<br>
				<a href="/<?= $o2i->statistics->login ?>"><?= $o2i->statistics->fullname ?></a>
				(<?= $o2i->statistics->login ?>)
			</td>
			<td>
				<?= $o2i->order2in_amount ?>
				<?= $order->order_currency ?>
			</td>
			<td>
				<? if ($o2i->is_countrypost == 0) : ?>
				перевод
				<br>
				напрямую
				<br>
				посреднику
				<? else : ?>
				<?= $o2i->order2in_amount_local ?>
				<?= $o2i->order2in_currency ?>
				<? endif; ?>
			</td>
			<td>
				<? View::show('/main/elements/payments/payment_description',
				array('payment' => $o2i)); ?>
			</td>
			<td>
				<? if ($o2i->order2in_status == 'payed') : ?>
				<?= $Orders2InStatuses[$o2i->order2in_status] ?>
				<? else : ?>
				<select name="o2i_status<?= $o2i->order2in_id ?>" class="order_status">
					<? foreach ($Orders2InStatuses as $status => $status_name) : ?>
					<option value="<?= $status ?>" <? if ($o2i->order2in_status == $status) :
						?>selected="selected"<? endif; ?>><?= $status_name ?></option>
					<? endforeach; ?>
				</select>
				<img class="float o2i_progress" style="display:none;margin-left: 5px;;"
					 src="/static/images/lightbox-ico-loading.gif"/>
				<? endif; ?>

			</td>
			<td>
				<a href="/manager/payment/<?= $o2i->order2in_id ?>">Посмотреть</a>
				<? if ($o2i->order2in_2admincomment) : ?>
				<br>
				Добавлен
				<br>
				новый
				<br>
				комментарий
				<? endif; ?>
				<? if ($o2i->order2in_status != 'payed') : ?>
				<br>
				<br>
				<a href="/manager/deletePayment/<?= $o2i->order2in_id ?>"><img
					title="Удалить"
					border="0"
					src="/static/images/delete.png"></a>
				<? endif; ?>
			</td>
		</tr>
		<? endforeach; ?>
	</table>
	<? else : ?>
	<div align="center">Заявки отсутствуют</div>
	<? endif; ?>
</div>
<? if (isset($pager)) echo $pager ?>
<script>
function status_handler(tab_status)
{
	payment_status_handler('<?= $selfurl ?>');
}
</script>