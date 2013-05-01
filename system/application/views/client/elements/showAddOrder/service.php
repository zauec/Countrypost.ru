<div class="service_order_form">
    <form class='admin-inside'
		  action="<?= $selfurl ?>addProductToPrivilegedOrder/<?= $order->order_id ?>"
		  id="serviceItemForm"
		  method="POST">
        <input type='hidden' name="order_id" class="order_id" value="<?= ($order) ? (int) $order->order_id : 0 ?>" />
        <input type='hidden' name="order_type" class="order_type" value="service" />
        <input type='hidden' name="ocountry" class="countryFrom" value="<?= ($order) ? (int) $order->order_country_from : '' ?>" />
        <input type='hidden' name="ocountry_to" class="countryTo" value="<?= ($order) ? (int) $order->order_country_to : '' ?>" />
        <input type='hidden' name="city_to" class="cityTo" value="<?= ($order) ? (int) $order->order_city_to : '' ?>" />
        <input type='hidden' name="dealer_id" class="dealerId" value="<?= ($order) ? (int) $order->order_manager : '' ?>" />
        <input type='hidden' name="userfileimg" value="12345" />
        <div class='table add_detail_box' style="position:relative;">
            <div class='angle angle-lt'></div>
            <div class='angle angle-rt'></div>
            <div class='angle angle-lb'></div>
            <div class='angle angle-rb'></div>
            <div class='new_order_box'>
                <div style="height: 60px;">
                    <span class="label">Подробное описание что<br/> нужно сделать*:</span>
                    <textarea style="width:180px;resize:vertical;" class="textbox" maxlength="255" id='ocomment'
							  name="ocomment"></textarea>
                </div>
                <div>
                    <span class="label">Стоимость за выполнение:</span>
                    <input style="width:180px;" class="textbox" maxlength="11" type='text' id='oprice' name="oprice" />
                    <span class="label currency"><?= $order_currency ?></span>
                </div>
                <div>
                    <span class="label">Местная доставка:</span>
                    <input style="width:180px;" class="textbox" maxlength="11" type='text' id='odeliveryprice' name="odeliveryprice" />
                    <span class="label currency"><?= $order_currency ?></span>
                </div>
                <div style="height: 30px;">
                    <span class="label">
                        Скриншот (max. 3 MB):
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
            </div>
        </div>
		<div style="height: 50px;" class="admin-inside">
			<div class="submit">
				<div>
					<input type="submit" value="Добавить товар" id="addItem" name="add">
				</div>
			</div>
		</div>
	</form>
</div>