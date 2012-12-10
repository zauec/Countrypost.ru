<div class='table centered_td centered_th' style="<?= ($order AND count($order->details)) ? '' : 'display:none;'?>">
    <div class='angle angle-lt'></div>
    <div class='angle angle-rt'></div>
    <div class='angle angle-lb'></div>
    <div class='angle angle-rb'></div>
    <table id="new_products">
        <colgroup>
            <col style="width: 60px;">
            <col>
            <col>
            <col style="width: 85px;">
            <col style="width: 85px;">
            <col style="width: 85px;">
            <col style="width: 44px">
        </colgroup>
        <tr>
            <th nowrap>
                № <input type='checkbox' id='select_all'>
            </th>
            <th>Товар</th>
            <th>Скриншот</th>
            <th>
                Стоимость
            </th>
            <th>
                Местная<br>доставка
            </th>
            <th>
                Вес<br>товара
            </th>
            <th style="width:1px;"></th>
        </tr>
        <?
        $odetail_joint_id = 0;
        $odetail_joint_count = 0;

        if ($order)
        {
            $odetails = $order->details;
        }

        if ( ! empty($odetails)) : foreach($odetails as $odetail) :

            if (stripos($odetail->odetail_link, 'http://') !== 0)
            {
                $odetail->odetail_link = 'http://'.$odetail->odetail_link;
            }

            // генерируем выдачу изображения: если 0 - не указано ничего, NULL - загружен файл, VALUE - ссылка на принтскрин
            if (isset($odetail->odetail_img) && $odetail->odetail_img=='0')
            {
                $oimg = '';
            }
            elseif (!isset($odetail->odetail_img) || $odetail->odetail_img===NULL)
            {
                $oimg = '<a href="javascript:void(0)" onclick="setRel('.$odetail->odetail_id.');">
                            <img src="/client/showScreen/'.$odetail->odetail_id.'" width="55px" height="55px">
                            <a rel="lightbox_'.$odetail->odetail_id.'" href="/client/showScreen/'.$odetail->odetail_id.'" style="display:none;">Посмотреть</a>
                        </a>';
            }
            elseif (isset($odetail->odetail_img) && $odetail->odetail_img !='0')
            {
                $img_src = $odetail->odetail_img;
                if (stripos($img_src, 'http://') !== 0)
                {
                    $img_src = 'http://'.$img_src;
                }

                $oimg = '<a target="_blank" href="'.$img_src.'">'.
                            (strlen($img_src) > 17 ?
                                substr($img_src, 0, 17).'...' :
                                $img_src).'</a>';
            }
        ?>
        <tr id='product<?= $odetail->odetail_id ?>'>
            <td id='odetail_id<?= $odetail->odetail_id ?>'>
                <input type="checkbox" name="odetail_id" value="<?= $odetail->odetail_id ?>"/>
                <br>
                <?= $odetail->odetail_id ?>
                <br>
                <img id="progress<?= $odetail->odetail_id ?>"
                     class="float"
                     style="display:none;"
                     src="/static/images/lightbox-ico-loading.gif"/>

            </td>

            <form id="odetail<?= $order_type ?><?= $odetail->odetail_id ?>" action="/client/updateNewProduct/<?= $order->order_id ?>/<?= $odetail->odetail_id ?>"
                  enctype="multipart/form-data"
                  method="POST">

                <td style="text-align: left; vertical-align: bottom;">

                    <?
                    switch ($order_type) {
                        case 'online' :
                            ?>
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
                            </span><?
                            break;
                        case 'offline' :
                            ?>
                            <span class="plaintext">
                                <b><?= $odetail->odetail_product_name ?></b><br>
                                <b>Магазин</b>: <?= $odetail->odetail_shop ?>
                                <? if ($odetail->odetail_foto_requested) : ?>(требуется фото товара)<? endif; ?>
                                <br>
                                <b>Количество</b>: <?= $odetail->odetail_product_amount ?>
                                <b>Размер</b>: <?= $odetail->odetail_product_size ?>
                                <b>Цвет</b>: <?= $odetail->odetail_product_color ?>
                                <br>
                                <b>Комментарий</b>: <?= $odetail->odetail_comment ?>
                            </span>
                            <span class="producteditor" style="display: none;">
                                <br>
                                <b>Наименование</b>:
                                <textarea class="name" name="name"></textarea>
                                <br>
                                <b>Магазин</b>:
                                <textarea class="shop" name="shop"></textarea>
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
                            </span><?
                            break;
                        case 'service' :
                            ?>
                            <span class="plaintext">
                                <b><?= $odetail->odetail_product_name ?></b><br>
                                <b>Описание услуги</b>: <?= $odetail->odetail_comment ?>
                            </span>
                            <span class="producteditor" style="display: none;">
                                <br>
                                <b>Наименование</b>:
                                <textarea class="name" name="name"></textarea>
                                <br>
                                <b>Описание услуги</b>:
                                <textarea class="ocomment" name="comment"></textarea>
                                <br>
                            </span><?
                            break;
                        case 'delivery' :
                            $link = '';
                            if ( !empty($odetail->odetail_link) && stripos($odetail->odetail_link, 'http://') !==0 )
                            {
                                $link = 'http://'.$odetail->odetail_link;
                            }
                            elseif ( !empty($odetail->odetail_link) )
                            {
                                $link = $odetail->odetail_link;
                            }
                            ?>
                            <span class="plaintext">
                                <b><?=($link)?'<a href="'.$link.'" target="BLANK">':''?><?= $odetail->odetail_product_name ?><?=($link)?'</a>':''?></b>
                                <? if ($odetail->odetail_insurance) : ?>(требуется страховка)<? endif; ?>
                                <br>
                                <b>Количество</b>: <?= $odetail->odetail_product_amount ?>
                                <b>Объём</b>: <?= $odetail->odetail_volume ?>
                                <b>ТН ВЭД</b>: <?= $odetail->odetail_tnved ?>
                                <br>
                                <b>Комментарий</b>: <?= $odetail->odetail_comment ?>
                            </span>
                            <span class="producteditor" style="display: none;">
                                <br>
                                <b>Наименование</b>:
                                <textarea class="name" name="name"></textarea>
                                <br>
                                <b>Ссылка на товар</b>:
                                <textarea class="link" name="link"></textarea>
                                <br>
                                <b>Количество</b>:
                                <textarea class="amount int" name="amount"></textarea>
                                <br>
                                <b>Объём</b>:
                                <textarea class="volume" name="volume"></textarea>
                                <br>
                                <b>ТН ВЭД</b>:
                                <textarea class="tnved" name="tnved"></textarea>
                                <br>
                                <b>Требуется страховка?</b>
                                <div style="float:right">
                                    <label><input type="radio" name="insurance" id="insurance_y" value="1"/> Да</label>
                                    <label><input type="radio" name="insurance" id="insurance_n" value="0"/> Нет</label>
                                </div>
                                <br>
                                <b>Комментарий</b>:
                                <textarea class="ocomment" name="comment"></textarea>
                                <br>
                            </span><?
                            break;
                    } ?>
                </td>
                <td>
                    <span class="plaintext">
                    </span>

                    <span class="producteditor" style="display: none;">
                    </span>
                </td>

            </form>

            <td>
                <input type="text"
                   order-id="<?= $order->order_id ?>"
                   odetail-id="<?= $odetail->odetail_id ?>"
                   id="odetail_price<?= $odetail->odetail_id ?>"
                   class="odetail_price int"
                   name="odetail_price<?= $odetail->odetail_id ?>"
                   value="<?= $odetail->odetail_price ?>"
                   style="width:60px"
                   maxlength="11">
            </td>
            <td>
                <input type="text"
                   order-id="<?= $order->order_id ?>"
                   odetail-id="<?= $odetail->odetail_id ?>"
                   id="odetail_pricedelivery<?= $odetail->odetail_id ?>"
                   class="odetail_pricedelivery int"
                   name="odetail_pricedelivery<?= $odetail->odetail_id ?>"
                   value="<?= $odetail->odetail_pricedelivery ?>"
                   style="width:60px"
                   maxlength="11">
            </td>
            <td>

                <input type="text"
                   order-id="<?= $order->order_id ?>"
                   odetail-id="<?= $odetail->odetail_id ?>"
                   id="odetail_weight<?= $odetail->odetail_id ?>"
                   class="odetail_weight int"
                   name="odetail_weight<?= $odetail->odetail_id ?>"
                   value="<?= $odetail->odetail_weight ?>"
                   style="width:60px"
                   maxlength="11">

            </td>
            <td>
                <a href="#"
                   odetail-id="<?= $odetail->odetail_id ?>"
                   class="edit">
                    <img border="0" src="/static/images/comment-edit.png" title="Редактировать"></a>
                <br>
                <a href="#"
                   odetail-id="<?= $odetail->odetail_id ?>"
                   class="delete">
                    <img border="0" src="/static/images/delete.png" title="Удалить"></a>
                <br>
                <a href="#"
                   odetail-id="<?= $odetail->odetail_id ?>"
                   class="cancel"
                   style="display: none;">
                    <img border="0" src="/static/images/comment-delete.png" title="Отменить"></a>
                <br>
                <a href="#"
                   odetail-id="<?= $odetail->odetail_id ?>"
                   class="save"
                   style="display: none;">
                    <img border="0" src="/static/images/done-filed.png" title="Сохранить"></a>
            </td>
        </tr>
        <? endforeach; endif; ?>

        <tr>
            <td colspan="3">&nbsp;</td>
            <td class="price_total product_total">
                <b class="total_product_cost"><?= ($order) ? $order->order_products_cost : '' ?></b>&nbsp;<?=
                ($order) ? $order->order_currency : '' ?>
            </td>
            <td class="delivery_total product_total">
                <b class="total_delivery_cost"><?= ($order) ? $order->order_delivery_cost : '' ?></b>&nbsp;<?= ($order) ? $order->order_currency : '' ?>
            </td>
            <td class="weight_total">
                <b class="total_weight"><?= ($order) ? $order->order_weight : '' ?></b> г
            </td>
            <td>&nbsp;</td>
        </tr>
        <tr class='last-row'>
            <td colspan='2' style="border: none;">
                <div class='floatleft'>
                    <div class='submit'><div><input type='submit' value='Объединить доставку' /></div></div>
                </div>
                <img class="tooltip_join" src="/static/images/mini_help.gif" />
            </td>
            <td style="text-align: right; border: none;" colspan='5'>
                <br />
                <b>
                    Итого: <b class="order_totals"></b>
                    <br />
                    Доставка в <span class='countryTo' style="float:none; display:inline; margin:0;"></span><span class='cityTo' style="float:none; display:inline; margin:0;"></span>: <b class="weight_total"></b>
                </b>
            </td>
        </tr>

    </table>
</div>


<div style="height: 50px; <?= ((empty($this->user->user_group) OR !($order AND count($order->details))) ? 'display:none;' : '')?>" class="admin-inside checkOutOrderBlock">
    <div class="submit">
        <div>
            <input type="button" value="Готово" id="<?= $order_type ?>checkoutOrder" name="checkout" onclick="/*checkout();*/">
        </div>
    </div>
</div>

<? if (empty($this->user->user_group)) : ?>
<br><br>
<? View::show('main/elements/auth/new_order'); ?>
<? endif; ?>
    
<script>


	function cancelItem(id) {
		if ($('#odetail_product_name' + id + ' textarea').length)
		{
			var odetail = eval('odetail' + id);
			
			$('#odetail_product_name' + id).html(odetail['odetail_product_name']);

			$('#odetail_product_color' + id).html(odetail['odetail_product_color'] + ' / ' + odetail['odetail_product_size'] + ' / ' + odetail['odetail_product_amount']);

			$('#odetail_link' + id + ',#odetail_img' + id).find('label,textarea,input,br').remove();
			$('#odetail_link' + id + ',#odetail_img' + id).children().show();
			$('#odetail_img' + id + ' a[rel]').hide();
						
			$('#odetail_action' + id)			
				.html('<a href="javascript:editItem(' + id + ')" id="odetail_edit' + id + '"><img border="0" src="/static/images/comment-edit.png" title="Изменить"></a><br /><a href="javascript:deleteItem(' + id + ')"><img border="0" src="/static/images/delete.png" title="Удалить"></a>');
		}
	}

	function saveItem(id) {
		if ($('#odetail_product_name' + id + ' textarea').length)
		{
			$('#odetail_product_name' + id).parent().find('input,textarea').attr('readonly', true);
			$('#odetail_action' + id).html('<img border="0" src="/static/images/lightbox-ico-loading.gif" title="Товар сохраняется..."><br><a href="javascript:cancelItem(' + id + ')" id="odetail_cancel' + id + '"><img border="0" src="/static/images/comment-delete.png" title="Отменить"></a>');
			$('#odetail_id').val(id);
			$('#detailsForm').submit();						
		}
	}
	
	function setRel(id){
		$("a[rel*='lightbox_"+id+"']").lightBox();
		var aa = $("a[rel*='lightbox_"+id+"']");
		$(aa[0]).click();
	}

    function getSelectedCurrency()
    {
        return selectedCurrency;
    }
</script>