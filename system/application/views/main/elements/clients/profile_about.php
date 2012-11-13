<div class="personal table">
	<div>
		<span>
			Страна:
		</span>
		<span>
			<img src="/static/images/flags/<?= $countries_en[$client->client_country] ?>.png" />
			<b><?=$countries[$client->client_country]?></b>
		</span>
	</div>
	<div>
		<span>
			Зарегистрирован:
		</span>
		<span>
			<?= isset($client->created) ? date('d.m.Y H:i', strtotime($client->created)) : date('d.m.Y H:i')?>
		</span>
	</div>
	<div>
		<span>
			Заказов в работе:
		</span>
		<span>
			12345678
		</span>
	</div>
	<div>
		<span>
			Выполненных заказов:
		</span>
		<span>
			12
		</span>
	</div>
	<div>
		<span>
			Отправленных посылок:
		</span>
		<span>
			120
		</span>
	</div>
	<div>
		<span>
			Отзывы:
		</span>
		<span>
			<? View::show('main/elements/clients/rating', array('client' => $client)); ?>
		</span>
	</div>
	<div>
		<span>
			Skype:
		</span>
		<span>
			<?= $client->statistics->skype ?>
		</span>
	</div>
	<div>
		<span>
			Email:
		</span>
		<span>
			<a href="mailto:<?= $client->statistics->email ?>"><?= $client->statistics->email ?></a>
		</span>
	</div>
</div>