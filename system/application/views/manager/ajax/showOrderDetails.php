<?
$is_offer_accepted = ! empty($order->order_manager);
$is_own_order = $is_offer_accepted AND ($order->order_manager == $this->user->user_id);
$is_editable = in_array($order->order_status, $editable_statuses); ?>
<form class='admin-inside' id='detailsForm' action='<?= $selfurl ?>updateProductAjax' enctype="multipart/form-data" method="POST">
	<div class='table centered_td centered_th'>
		<div class='angle angle-lt'></div>
		<div class='angle angle-rt'></div>
		<div class='angle angle-lb'></div>
		<div class='angle angle-rb'></div>
		<table id="new_products">
			<colgroup>
				<col style="width: 60px;">
				<col style="auto">
				<col style="auto">
				<col style="width: 85px;">
				<col style="width: 85px;">
				<col style="width: 85px;">
				<col style="width: 169px;">
				<col style="width: 44px">
			</colgroup>
			<tr>
				<th nowrap>
					№ <input type='checkbox' id='select_all' />
				</th>
				<th>Товар</th>
				<th>Скриншот</th>
				<? if ($order->order_type != 'mail_forwarding') : ?>
				<th>
					Стоимость
				</th>
				<th>
					Местная<br>доставка
				</th>
				<th>
					Примерный<br>вес
				</th>
				<? else : ?>
				<th>Tracking №</th>
				<? endif; ?>
				<? if ($is_editable) : ?>
				<th>Статус</th>
				<th style="width:1px;"></th>
				<? endif; ?>
			</tr>
			<?
			$odetail_joint_id = 0;
			$odetail_joint_count = 0;
				
			if ( ! empty($odetails)) : foreach($odetails as $odetail) : 
				if (stripos($odetail->odetail_link, 'http://') !== 0)
				{
					$odetail->odetail_link = 'http://'.$odetail->odetail_link;
				}
				
				if (isset($odetail->odetail_img) && 
					stripos($odetail->odetail_img, 'http://') !== 0)
				{
					$odetail->odetail_img = 'http://'.$odetail->odetail_img;
				}
			 ?>
			<tr id='product<?= $odetail->odetail_id ?>'>
				<td id='odetail_id<?= $odetail->odetail_id ?>'>
					<?= $odetail->odetail_id ?>
					<? if ($is_editable) : ?>
					<br>
					<img id="progress<?= $odetail->odetail_id ?>" class="float" style="display:none;"
						 src="/static/images/lightbox-ico-loading.gif"/>
					<? endif; ?>
				</td>
				<form action='<?= $selfurl ?>updateProduct/<?= $order->order_id ?>/<?= $odetail->odetail_id ?>'
					  enctype="multipart/form-data"
					  method="POST">
				<td id='odetail_description<?= $odetail->odetail_id ?>'
					style="text-align: left; vertical-align: bottom;">
					<span class="plaintext">
						<a target="_blank" href="<?= $odetail->odetail_link ?>"><?= $odetail->odetail_product_name ?></a>
						<? if ($odetail->odetail_foto_requested) : ?>(требуется фото товара)<? endif; ?>
						<br>
						<b>Количество</b>: <?= $odetail->odetail_product_amount ?>
						<b>Размер</b>: <?= $odetail->odetail_product_size ?>
						<b>Цвет</b>: <?= $odetail->odetail_product_color ?>
						<br>
						<b>Комментарий</b>: <?= $odetail->odetail_comment ?>
					</span>
					<? if ($is_editable) : ?>
					<script>
						var odetail<?= $odetail->odetail_id ?> = {
							"link":"<?= $odetail->odetail_link ?>",
							"name":"<?= $odetail->odetail_product_name ?>",
							"color":"<?= $odetail->odetail_product_color ?>",
							"size":"<?= $odetail->odetail_product_size ?>",
							"amount":"<?= $odetail->odetail_product_amount ?>",
							"comment":"<?= $odetail->odetail_comment ?>",
							"img":"<?= $odetail->odetail_img ?>",
							"foto_requested":"<?= $odetail->odetail_foto_requested ?>",
							"is_editing":0};
					</script>
					<span class="producteditor" style="display: none;">
						<br>
						<b>Ссылка</b>:
						<textarea class="link" name="link"></textarea>
						<br>
						<b>Наименование</b>:
						<textarea class="name" name="name"></textarea>
						<br>
						<b>Количество</b>:
						<textarea class="amount int" name="amount"></textarea>
						<br>
						<b>Размер</b>:
						<textarea class="size" name="size"></textarea>
						<br>
						<b>Цвет</b>:
						<textarea class="color" name="color"></textarea>
						<br>
						<b>Комментарий</b>:
						<textarea class="ocomment" name="comment"></textarea>
						<br>
					</span>
					<? endif; ?>
				</td>
				<td id='odetail_img<?= $odetail->odetail_id ?>'>
					<span class="plaintext">
						<? if (isset($odetail->odetail_img)) : ?>
						<a href="#" onclick="window.open('<?= $odetail->odetail_img ?>');return false;"><?= (strlen($odetail->odetail_img)>17?substr($odetail->odetail_img,0,17).'...':$odetail->odetail_img) ?></a>
						<? else : ?>
						<a href="javascript:void(0)" onclick="setRel(<?= $odetail->odetail_id ?>);">
							Просмотреть скриншот <a rel="lightbox_<?= $odetail->odetail_id ?>" href="/client/showScreen/<?= $odetail->odetail_id ?>" style="display:none;">Посмотреть</a>
						</a>
						<? endif; ?>
					</span>
					<? if ($is_editable) : ?>
					<span class="producteditor" style="display: none;">
					</span>
					<? endif; ?>
				</td>
				</form>
				<td>
					<? if ($is_editable) : ?>
					<input type="text"
						   id="odetail_price<?= $odetail->odetail_id ?>"
						   name="odetail_price<?= $odetail->odetail_id ?>"
						   class="int"
						   value="<?= $odetail->odetail_price ?>"
						   style="width:60px"
						   maxlength="11"
						   onchange="update_odetail_price('<?= $order->order_id ?>',
								   '<?= $odetail->odetail_id ?>');">
					<? else : ?>
					<?= $odetail->odetail_price ?> <?= $order->order_currency ?>
					<? endif; ?>
				</td>
				<td>
					<? if ($is_editable) : ?>
					<input type="text"
						   id="odetail_pricedelivery<?= $odetail->odetail_id ?>"
						   name="odetail_price<?= $odetail->odetail_id ?>"
						   class="int"
						   value="<?= $odetail->odetail_pricedelivery ?>"
						   style="width:60px"
						   maxlength="11"
						   onchange="update_odetail_pricedelivery('<?= $order->order_id ?>',
								   '<?= $odetail->odetail_id ?>');">
					<? else : ?>
					<?= $odetail->odetail_pricedelivery ?> <?= $order->order_currency ?>
					<? endif; ?>
				</td>
				<? //if (!$odetail->odetail_joint_id) :
					//$order_delivery_cost += $odetail->odetail_pricedelivery;
				 ?>
				<td>
					<? if ($is_editable) : ?>
					<input type="text"
						   id="odetail_weight<?= $odetail->odetail_id ?>"
						   name="odetail_weight<?= $odetail->odetail_id ?>"
						   class="int"
						   value="<?= $odetail->odetail_weight ?>"
						   style="width:60px"
						   maxlength="11"
						   onchange="update_odetail_weight('<?= $order->order_id ?>', '<?= $odetail->odetail_id ?>')
								   ;">
					<? else : ?>
					<?= $odetail->odetail_weight ?>
					<? endif; ?>
				</td>
				<?// elseif ($odetail_joint_id != $odetail->odetail_joint_id) :
					//	$odetail_joint_id = $odetail->odetail_joint_id;
					//	$odetail_joint_count = $odetail->odetail_joint_count;
					//	$order_delivery_cost += $odetail->odetail_joint_cost;
				 ?>
				<!--td rowspan="<?= $odetail_joint_count ?>">
					<?//=$odetail->odetail_joint_cost ?>
				</td-->
				<? //endif; ?>
				<? if ($is_editable) : ?>
				<td>
					<select	id="odetail_status<?= $odetail->odetail_id ?>"
							name="odetail_status<?= $odetail->odetail_id ?>"
							class="odetail_status"
							onchange="update_odetail_status('<?= $order->order_id ?>',
									'<?= $odetail->odetail_id ?>');">
						<? foreach ($odetail_statuses[$order->order_type] as $status => $status_name) : ?>
						<option value="<?= $status ?>" <? if ($odetail->odetail_status == $status) :
							 ?>selected="selected"<? endif; ?>><?= $status_name ?></option>
						<? endforeach; ?>
					</select>
				</td>
				<td>
					<a href="javascript:editItem(<?= $odetail->odetail_id ?>)"
					   class="edit">
						<img border="0" src="/static/images/comment-edit.png" title="Редактировать">
					</a>
					<a href="javascript:cancelItem(<?= $odetail->odetail_id ?>)"
					   class="cancel"
					   style="display: none;">
						<img border="0" src="/static/images/comment-delete.png" title="Отменить">
					</a>
					<br>
					<a href="javascript:saveItem(<?= $odetail->odetail_id ?>)"
					   class="save"
					   style="display: none;">
						<img border="0" src="/static/images/done-filed.png" title="Сохранить">
					</a>
				</td>
				<? endif; ?>
			</tr>
			<? endforeach; endif; ?>
			<tr>
				<td colspan="3">&nbsp;</td>
				<td class="price_total product_total">
					<b class="total_product_cost"><?= $order->order_products_cost ?></b>&nbsp;<?=
					$order->order_currency ?>
				</td>
				<td class="delivery_total product_total">
					<b class="total_delivery_cost"><?= $order->order_delivery_cost ?></b>&nbsp;<?= $order->order_currency ?>
				</td>
				<td class="weight_total">
					<b class="total_weight"><?= $order->order_weight ?></b>г
				</td>
				<? if ($is_editable) : ?>
				<td colspan="2">&nbsp;</td>
				<? endif; ?>
			</tr>
			<? if ($bids_accepted) : ?>
			<tr class='last-row'>
				<td colspan='3'>
					<div class='floatleft'>
						<div class='submit'><div><input type='button' class="bid_button" value='Добавить предложение' onclick="showRequestForm('<?= $order->order_id ?>');" /></div></div>
					</div>
				</td>
				<td style="text-align: right;" colspan='3'>
					<b>
						<? if ( ! empty($order->preferred_delivery)) : ?>
						<br />
						Способ доставки: <b class="order_totals"><?= $order->preferred_delivery ?></b>
						<? endif; ?>
					</b>
				</td>
			</tr>
			<? endif; ?>
		</table>			
	</div>
</form>