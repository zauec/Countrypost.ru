<? foreach ($services as $service) :	if ($service->payment_service_id == $payment->order2in_payment_service) : ?>	<b style="text-decoration: underline; font-weight: normal;"><?= $service->payment_service_name ?></b>	<br />	<? break; endif; endforeach; ?><? if ($payment->order2in_payment_service == 'bm' OR	$payment->order2in_payment_service == 'pb' OR	$payment->order2in_payment_service == 'bta' OR	$payment->order2in_payment_service == 'ccr' OR	$payment->order2in_payment_service == 'kkb' OR	$payment->order2in_payment_service == 'nb' OR	$payment->order2in_payment_service == 'tb' OR	$payment->order2in_payment_service == 'atf' OR	$payment->order2in_payment_service == 'ab' OR	$payment->order2in_payment_service == 'sv' OR	$payment->order2in_payment_service == 'vtb') : ?><b>Номер карты:</b><?= $payment->order2in_details ?><br /><? elseif ($payment->order2in_payment_service == 'rbk' OR	$payment->order2in_payment_service == 'qw') : ?><b>Номер кошелька:</b><?= $payment->order2in_details ?><br /><? elseif ($payment->order2in_payment_service == 'mb') : ?><b>Email отправителя:</b><?= $payment->order2in_details ?><br /><? else : ?><b style="text-decoration: underline; font-weight: normal;">	<?= $payment->payment_service_name ?></b><br /><b>Комментарий:</b><?= $payment->order2in_details ?><br /><? View::show('main/elements/payments/payment_screenshot'); ?><? endif; ?><? if ($payment->order2in_payment_service == 'bm' OR	$payment->order2in_payment_service == 'cc' OR	$payment->order2in_payment_service == 'so' OR	$payment->order2in_payment_service == 'op' OR	$payment->order2in_payment_service == 'pb' OR	$payment->order2in_payment_service == 'bta' OR	$payment->order2in_payment_service == 'ccr' OR	$payment->order2in_payment_service == 'kkb' OR	$payment->order2in_payment_service == 'nb' OR	$payment->order2in_payment_service == 'tb' OR	$payment->order2in_payment_service == 'atf' OR	$payment->order2in_payment_service == 'ab' OR	$payment->order2in_payment_service == 'sv' OR	$payment->order2in_payment_service == 'vtb') : ?>	<? View::show('main/elements/payments/payment_screenshot'); ?><? endif; ?>