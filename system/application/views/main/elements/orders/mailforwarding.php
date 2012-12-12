<?
$order = null;
for ($i = 0, $n = count($orders); $i<$n; $i++) :
    if ($orders[$i]->order_type == 'mail_forwarding') :
        $order = $orders[$i];
        break;
    endif;
endfor;
?>

<div class="mail_forwarding_order_form" style='display:none;'>

    <ol style="padding: 10px 0px; font-size: 14px; line-height: 26px;">
        <li>Выберите посредника на адрес которого вы будите самостоятельно заказывать.</li>
        <li>Добавьте ниже все товары заказанные на адрес посредника (для каждого товара укажите номер посылки - Tracking номер).</li>
    </ol>

    <div class='table' style="position:relative;">
        <div class='angle angle-lt'></div>
        <div class='angle angle-rt'></div>
        <div class='angle angle-lb'></div>
        <div class='angle angle-rb'></div>
        <form class='admin-inside' action="<?= $selfurl ?>checkout" id="mail_forwardingOrderForm" method="POST">
            <input type='hidden' name="order_id" class="order_id" value="<?= ($order) ? (int) $order->order_id : 0 ?>" />
            <input type='hidden' name="order_type" class="order_type" value="mail_forwarding" />
            <input type='hidden' name="order_currency" class="order_currency" value="<?= $order_currency ?>" />
            <div class='new_order_box'>
                <br style="clear:both;" />
                <div>
                    <span class="label dealer_number_box">Номер посредника*:</span>
                    <input class="textbox dealer_number_box" maxlength="6" type='text' id='dealer_id_mail_forwarding' name="dealer_id" style='width:180px;' >
                </div>
                <br style="clear:both;" />
                <div>
                    <span class="label">Cпособ доставки*:</span>
                    <input style="width:180px;" class="textbox" maxlength="255" type='text' id='requested_delivery_mail_forwarding' name="requested_delivery" />
                </div>
                <br style="clear:both;" />
            </div>
        </form>
    </div>
    <h3>Добавить товар:</h3>
    <div class="h2_link">
        <img src="/static/images/mini_help.gif" style="float:right;margin-left: 7px;" />
        <a href="javascript: void(0);" class="excel_switcher" style="">Массовая загрузка товаров</a>
    </div>
    <form class='admin-inside' action="<?= $selfurl ?>addProductManualAjax" id="mail_forwardingItemForm" method="POST">
        <input type='hidden' name="order_id" class="order_id" value="<?= ($order) ? (int) $order->order_id : 0 ?>" />
        <input type='hidden' name="order_type" class="order_type" value="mail_forwarding" />
        <input type='hidden' name="ocountry" class="countryFrom" value="<?= ($order) ? (int) $order->order_country_from : '' ?>" />
        <input type='hidden' name="ocountry_to" class="countryTo" value="<?= ($order) ? (int) $order->order_country_to : '' ?>" />
        <input type='hidden' name="city_to" class="cityTo" value="<?= ($order) ? (int) $order->order_city_to : '' ?>" />
        <input type='hidden' name="dealer_id" class="dealerId" value="<?= ($order) ? (int) $order->order_manager : '' ?>" />
        <input type='hidden' name="requested_delivery" class="requestedDelivery" value="<?= ($order) ? $order->preferred_delivery : '' ?>" />
        <input type='hidden' name="userfileimg" value="" />
        <div class='table add_detail_box' style="position:relative;">
            <div class='angle angle-lt'></div>
            <div class='angle angle-rt'></div>
            <div class='angle angle-lb'></div>
            <div class='angle angle-rb'></div>
            <div class='new_order_box'>
                <div>
                    <span class="label">Наименование товара*:</span>
                    <input style="width:180px;" class="textbox" maxlength="255" type='text' id='oname' name="oname" />
                </div>
                <br style="clear:both;" />
                <div>
                    <span class="label">Tracking номер*: <img style="margin-left: 7px;" src="/static/images/mini_help.gif"></span>
                    <input style="width:180px;" class="textbox" maxlength="11" type='text' id='otracking' name="otracking" />
                </div>
                <br style="clear:both;" />
                <div>
                    <span class="label">Ссылка на товар:</span>
                    <input style="width:180px;" class="textbox" maxlength="500" type='text' id='olink' name="olink" />
                </div>
                <br style="clear:both;" />
            </div>
        </div>
        <h3>Дополнительная информация по товару:</h3>
        <div class='add_detail_box' style="position:relative;">
            <div class='new_order_box'>
                <br style="clear:both;" />
                <div>
                    <span class="label">Цвет:</span>
                    <input style="width:180px;" class="textbox" maxlength="255" type='text' id='ocolor' name="ocolor" />
                </div>
                <br style="clear:both;" />
                <div>
                    <span class="label">Размер:</span>
                    <input style="width:180px;" class="textbox" maxlength="255" type='text' id='osize' name="osize" />
					<span class="label">
						<input class="border:auto;" type='button' value="подобрать размер" />
					</span>
                </div>
                <br style="clear:both;" />
                <div>
                    <span class="label">Количество:</span>
                    <input style="width:180px;" class="textbox" maxlength="255" type='text' id='oamount' name="oamount" value="1" />
                </div>
                <br style="clear:both;" />
                <div>
					<span class="label">
						Скриншот (max. 3 Mb):
					</span>
					<span class="label screenshot_switch" style="font-size:11px;margin:0;width:300px;">
						<a href="javascript: showScreenshotLink();">Добавить ссылку</a>&nbsp;или&nbsp;<a href="javascript: showScreenshotUploader();" class="screenshot_switch">Загрузить файл</a>
					</span>
                    <input class="textbox screenshot_link_box" type='text' id='oimg' name="userfileimg" style='display:none;width:180px;' value="" onfocus="javascript: if (this.value == 'ссылка на скриншот') this.value = '';" onblur="javascript: if (this.value == '') this.value = 'ссылка на скриншот';">
                    <input class="textbox screenshot_uploader_box" type='file' id='ofile' name="userfile" style='display:none;width:180px;'>
					<span class="label screenshot_link_box screenshot_uploader_box" style='display:none;'>
						<img border="0" src="/static/images/delete.png" title="Удалить">
					</span>
                </div>
                <br style="clear:both;" />
                <div>
                    <span class="label">Нужно ли фото товара?</span>
                    <input type='checkbox' id='foto_requested' name="foto_requested" />
                </div>
                <br style="clear:both;" />
                <div>
                    <span class="label">Комментарий к товару:</span>
                    <textarea style="width:180px;resize:auto!important;" class="textbox" maxlength="255" id='ocomment' name="ocomment"></textarea>
                </div>
                <br style="clear:both;" />
            </div>
        </div>
    </form>
    <div style="height: 50px;" class="admin-inside">
        <div class="submit">
            <div>
                <input type="button" value="Добавить товар" id="addItemMailforwarding" name="add" onclick="/*addItem();*/">
            </div>
        </div>
    </div>

	<? View::show('main/ajax/showNewOrderDetails', array('order_type' => 'mail_forwarding', 'order' => $order)); ?>
</div>
<script type="text/javascript">
	$(function()
    {
        $('div.mail_forwarding_order').click(function() {
            var order = new $.cpOrder(orderData);
            order.init("mail_forwarding");
        });

		// ссылка на скриншот
		$('.screenshot_link_box img').click(function() {
			$('.screenshot_link_box,.screenshot_uploader_box').hide('slow');
			$('.screenshot_switch').show('slow');
		});
		
		$('.excel_switcher').click(function() {
			$('.excel_box').show('slow');
			$('.add_detail_box').hide('slow');
		});
	});
</script>