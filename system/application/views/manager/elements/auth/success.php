<div class='top-block'>
	<div class='block-user'>
		<div class='left-block'>
			<h2>Авторизация</h2>
			<p>
				Здравствуйте,
				<span class='big-text'>
					<a href='<?= BASEURL . $this->user->user_group ?>'><?= $this->user->user_login ?></a>
				</span>
			</p>
			<p>
				<a href='/profile'>Изменить личные данные</a>
			</p>
			<div class='submit'>
				<div>
					<input type='submit' value='Выйти' onclick="javascript:window.location='<?=
					BASEURL ?>user/logout';" >
				</div>
			</div>
		</div>
		<div class='right-block'>
			<?	$credit = $this->session->userdata('manager_credit');
			$credit_date = $this->session->userdata('manager_credit_date');
			if (FALSE && isset($credit) && $credit && isset($credit_date) && $credit_date) : ?>
				<p>
					<? $date = new DateTime($credit_date); echo $date->format('d.m.Y');?>
					Кредит на
				<span class='big-text'>
					$<?= $credit ?>
				</span>
				</p>
				<? endif; ?>
		</div>
		<div class='center-block'>
			<h3>
				ВАШ НОМЕР НА САЙТЕ: <?= $this->user->user_id ?>
			</h3>
			<br>
			<p>
				<a href='/<?= $this->user->user_group ?>/history'>Статистика платежей</a>
			</p>
			<p>
				<a href='/<?= $this->user->user_group ?>/payments'>Заявки на оплату заказов</a>
			</p>
		</div>
	</div>
</div>
<?
if (isset($extra_view))
{
	if ($extra_view == 'newBid')
	{
		if (isset($extra_data))
		{
			View::show('main/elements/orders/newBid', array(
				'order' => $extra_data['order'],
				'new_bid' => $extra_data['bid']
			));
		}
	}
}
?>
<script>
var user_id = <?= $this->user->user_id ?>;
var user_group = '<?= $this->user->user_group ?>';
</script>
