<div class="mail_forwarding mail_forwarding_main table dealer_tab" style="display:none;">
	<div class='angle angle-lt'></div>
	<div class='angle angle-rt'></div>
	<div class='angle angle-lb'></div>
	<div class='angle angle-rb'></div>
	<div>
		<span>
			<b>Адреса:</b>
		</span>
		<span>
			<?= $manager->manager_address_local ?>
		</span>
	</div>
	<div>
		<span>
			&nbsp;
		</span>
		<span>
			<?= $manager->manager_addres ?>
		</span>
	</div>
	<div>
		<span>
			<b>Получатель:</b>
		</span>
		<span>
			<?= $manager->statistics->fullname ?>
		</span>
	</div>
	<? if ( ! empty($manager->manager_phone)) : ?>
	<div>
		<span>
			<b>Телефон:</b>
		</span>
		<span>
			<?= $manager->manager_phone ?>
		</span>
	</div>
	<? endif; ?>
</div>