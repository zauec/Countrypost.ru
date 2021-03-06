<div class='table' id="pb_block" style="width:550px; position:fixed; z-index: 1000; display:none; top:200px;">
	<center>
		<h3 style="margin-top:0;margin-bottom:20px;">Заявка на пополнение счета</h3>
		<em style="display:none;" class="pink-color"></em>
	</center>
	<p>
		Пополнение счета переводом с карты на карту через Приватбанк:
		<br />
		<br />
		Вам нужно перевести <b><b class="pb_amount_uah"></b> гривен</b> на карту <?= PB_IN_ACCOUNT ?> (Украина). После перевода сохраните квитанцию.
	</p>
	<br />
	<form class='admin-inside' action="/client/addOrder2In/<?= $order->order_id ?>" enctype="multipart/form-data" method="POST">
		<input type="hidden" name="payment_service" value="pb" />
		<input type="hidden" name="total_uah" class="pb_amount_uah" value="" />
		<input type="hidden" name="total_usd" class="pb_amount_usd" value="" />
		<table>
			<tr>
				<td>Номер карты:</td>
				<td>
					<input type="text" name="account" maxlength="20" value="" />
					<i>Пример: 7790****2198</i>
				</td>
			</tr>
			<tr>
				<td>Фото квитанции:
					<br />(максимальный размер 3Mb)
				</td>
				<td><input type="file" name="userfile" value="" /></td>
			</tr>
			<tr class='last-row'>
				<td colspan='2'>
					<div class='float'>	
						<div class='submit'>
							<div>
								<input type='submit' name="add" value='Добавить заявку' />
							</div>
						</div>
						<div class='submit'>
							<div>
								<input type='button' value='Отмена' onclick="$('#lay').fadeOut('slow');$('#pb_block').fadeOut('slow');"/>
							</div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</form>
</div>
<script type="text/javascript">
	var pb_click = 0;

	function openPbPopup(user_id, amount_usd, amount_uah)
	{
		$('#pb_user_id').html(user_id);
		$('.pb_amount_usd').val(amount_usd);
		$('.pb_amount_uah').html(amount_uah).val(amount_uah);
		
		var offsetLeft	= window.innerWidth / 2 - 280;
		
		$('#pb_block').css({
			'left' : offsetLeft
		});
		
		$('#lay').css({
			'width': document.body.clientWidth,
			'height': document.body.clientHeight
		});
		
		$('#lay').fadeIn("slow");
		$('#pb_block').fadeIn("slow");
		
		if (!pb_click)
		{
			pb_click = 1;
			$('#lay').click(function(){
				$('#lay').fadeOut("slow");
				$('#pb_block').fadeOut("slow");
			})
		}
	}
</script>