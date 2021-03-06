<a name="pagerScroll"></a>
<form method="POST" class='admin-inside' action="/admin/saveOrders2in/showClientPayedOrders2In" id="pagerForm">
	<? View::show('/admin/elements/div_float_credentials'); ?>
	<ul class='tabs'>
		<li><div><a href='<?=$selfurl?>showClientOpenOrders2In'>Новые</a></div></li>
		<li class='active'><div><a href='<?=$selfurl?>showClientPayedOrders2In'>Выполненные</a></div></li>
	</ul>
	<div class='table'>
		<div class='angle angle-lt'></div>
		<div class='angle angle-rt'></div>
		<div class='angle angle-lb'></div>
		<div class='angle angle-rb'></div>
		<? if (isset($Orders2In) && count($Orders2In)) : ?>
		<table>
			<col width='auto' />
			<col width='auto' />
			<col width='auto' />
			<col width='auto' />
			<col width='auto' />
			<col width='auto' />
			<col width='auto' />
			<tr>
				<th>№ заявки</th>
				<th>Клиент</th>
				<th>Способ оплаты</th>
				<th>Статус заявки</th>
				<th>Комментарии</th>
				<th>Сумма пополнения</th>
				<th>Сумма перевода</th>
			</tr>
			<? foreach ($Orders2In as $order) : ?>
			<tr>
				<td><b>№ <?=$order->order2in_id?></b>
					<br />
					<?=date("d.m.Y H:i", strtotime($order->order2in_createtime))?>
				</td>
				<td>
					<a href="/admin/editClient/<?=$order->order2in_user;?>"><?=$order->order2in_user;?></a>
					<br />
					<?=$order->client_surname?>
					<?=$order->client_name?>
					<?=$order->client_otc?>
					<br />
					(<?=$order->user_login?>)
				</td>
				<td>
					<? foreach ($services as $service) : 
					if ($service->payment_service_id == $order->order2in_payment_service) : ?>
					<u><?= $service->payment_service_name ?></u>
					<br />
					<? break; endif; endforeach; ?>
					<? if ($order->order2in_payment_service == 'bm' OR
						$order->order2in_payment_service == 'pb' OR
						$order->order2in_payment_service == 'bta' OR
						$order->order2in_payment_service == 'ccr' OR
						$order->order2in_payment_service == 'kkb' OR
						$order->order2in_payment_service == 'nb' OR
						$order->order2in_payment_service == 'tb' OR
						$order->order2in_payment_service == 'atf' OR
						$order->order2in_payment_service == 'ab' OR
						$order->order2in_payment_service == 'sv' OR
						$order->order2in_payment_service == 'vtb') : ?>
					<b>Номер карты:</b>
					<?= $order->order2in_details ?>
					<br />
					<? elseif ($order->order2in_payment_service == 'rbk' OR
						$order->order2in_payment_service == 'qw') : ?>
					<b>Номер кошелька:</b>
					<?= $order->order2in_details ?>
					<br />
					<? elseif ($order->order2in_payment_service == 'mb') : ?>
					<b>Email отправителя:</b>
					<?= $order->order2in_details ?>
					<br />
					<? else : ?>
					<?= $order->order2in_details ?>
					<br />
					<? endif; ?>
					
					<? if (($order->order2in_payment_service == 'bm' OR
							$order->order2in_payment_service == 'cc' OR
							$order->order2in_payment_service == 'so' OR
							$order->order2in_payment_service == 'op' OR
							$order->order2in_payment_service == 'pb' OR
							$order->order2in_payment_service == 'bta' OR
							$order->order2in_payment_service == 'ccr' OR
							$order->order2in_payment_service == 'kkb' OR
							$order->order2in_payment_service == 'nb' OR
							$order->order2in_payment_service == 'tb' OR
							$order->order2in_payment_service == 'atf' OR
							$order->order2in_payment_service == 'ab' OR
							$order->order2in_payment_service == 'sv' OR
							$order->order2in_payment_service == 'vtb') &&
							isset($Orders2InFoto[$order->order2in_id])) : ?>
					<b>Скриншот:</b>
					<a href="javascript:void(0)" onclick="setRel(<?=$order->order2in_id?>)">
						Посмотреть&nbsp;(<?=count($Orders2InFoto[$order->order2in_id]);?>)<?
						foreach ($Orders2InFoto[$order->order2in_id] as $o2iFoto) : ?><a rel="lightbox_<?=$order->order2in_id?>" href="/admin/showOrder2InFoto/<?=$order->order2in_id?>/<?=$o2iFoto?>" style="display:none;">Посмотреть</a><? endforeach; ?></a>
					<? endif; ?>
				</td>
				<td>
					<select name="status_<?=$order->order2in_id?>">
						<? foreach ($Orders2InStatuses as $key=>$val) : ?>
						<? if ($key != 'not_confirmed' OR 
							$order->order2in_payment_service == 'bm' OR
							$order->order2in_payment_service == 'cc' OR
							$order->order2in_payment_service == 'so' OR
							$order->order2in_payment_service == 'op' OR
							$order->order2in_payment_service == 'pb' OR
							$order->order2in_payment_service == 'bta' OR
							$order->order2in_payment_service == 'ccr' OR
							$order->order2in_payment_service == 'kkb' OR
							$order->order2in_payment_service == 'nb' OR
							$order->order2in_payment_service == 'tb' OR
							$order->order2in_payment_service == 'atf' OR
							$order->order2in_payment_service == 'ab' OR
							$order->order2in_payment_service == 'sv' OR
							$order->order2in_payment_service == 'vtb') : ?>
						<option value='<?=$key?>' <? if ($key==$order->order2in_status) : ?>selected="selected"<? endif; ?>><?= $val ?></option>
						<? endif; ?>
						<? endforeach; ?>	
					</select>
				</td>
				<td>
					<a href="/admin/showO2iComments/<?=$order->order2in_id;?>">Посмотреть</a>
					<?if ($order->order2in_2admincomment):?>
						<br />Добавлен новый коментарий
					<?endif;?>
				</td>
				<td>
					$<?= $order->order2in_amount ?>
				</td>
				<td>
					<? if ( ! empty($order->order2in_amount_local)) : ?>
					<?= $order->order2in_amount_local . $order->order2in_currency ?>
					<? elseif ( ! empty($order->order2in_amount_rur)) : ?>
					<?= $order->order2in_amount_rur . "руб." ?>
					<? elseif ( ! empty($order->order2in_amount_kzt)) : ?>
					<?= $order->order2in_amount_kzt . '<em class="tenge">&nbsp;&nbsp;&nbsp;</em>' ?>
					<? else : ?>
					-
					<? endif; ?>
				</td>
			</tr>
			<?endforeach;?>
			<tr class='last-row'>
				<td colspan='10'>
					<div class='float'>	
						<div class='submit'><div><input type='submit' value='Сохранить' /></div></div>
					</div>
				</td>
			</tr>
		</table>
		<?else:?>
			<div align="center">Заявки отсутствуют</div>
		<?endif;?>
		<br>
	</div>
	<? if (isset($pager)) echo $pager ?>
</form>