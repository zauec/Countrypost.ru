<? $is_own_bid = isset($this->user->user_id);if ($is_own_bid){	$is_own_bid = ($bid->manager_id == $this->user->user_id OR 		$order->order_manager == $this->user->user_id OR 		$order->order_client == $this->user->user_id);}	$is_bid_hidden = ($order->order_manager AND	$order->order_manager != $bid->manager_id);?><div class='table bid' id='bid<?=$bid->bid_id?>' <? if ($is_bid_hidden) : ?>style="display:none;"<? endif; ?>>	<div class='angle angle-lt'></div>	<div class='angle angle-rt'></div>	<div class='angle angle-lb'></div>	<div class='angle angle-rb'></div>	<? View::show('main/elements/orders/managerinfo', array(		'bid' => $bid)); ?>	<br class="expander" style="clear:both;display:none;line-height:0;">	<? if ($is_own_bid) : ?>	<div class='table admin-inside' style="margin-top:0px;padding-top:10px;padding-bottom:0;" id="comments<?=$bid->bid_id?>">		<table>						<tr class="comment"<? if (empty($bid->comments)) : ?> style="display:none;"<? endif; ?>>				<th>					<b>Комментарии</b>				</th>			</tr>			<? if (isset($bid->comments)) : foreach ($bid->comments as $comment) : ?>			<tr class="comment">				<td>					<? View::show('main/elements/orders/comment', array(						'comment' => $comment)); ?>				</td>			</tr>			<? endforeach; endif; ?>			<tr class='last-row'>				<td>					<form class='admin-inside' action="<?= $selfurl ?>addBidComment/<?=$bid->bid_id?>" id="bidCommentForm" method="POST">						<div class='add-comment' style="display:none;">							<div><textarea id='comment' name='comment'></textarea></div>							<div class='submit comment-submit'><div><input type='submit' name="add" value="Добавить" /></div></div>						</div>					</form>				</td>			</tr>			<tr class='last-row'>				<td>					<div class='floatleft' style="width:100%;">							<? if (isset($this->user) AND							$this->user->user_group == 'client') : ?>						<form class='chooseBidForm' action="<?= $selfurl ?>chooseBid/<?=$bid->bid_id?>" id="chooseBidForm<?=$bid->bid_id?>" method="POST">							<div class='submit choose_bid'<? if ($order->order_manager) : ?> style="display:none;"<? endif; ?>><div><input type='button' class="" value='Выбрать исполнителем' onclick="chooseBid('<?=$bid->bid_id?>');" /></div></div>						</form>						<script>							$(function() {								$('#chooseBidForm<?=$bid->bid_id?>').ajaxForm({									target: $('#chooseBidForm<?=$bid->bid_id?>').attr('action'),									type: 'POST',									dataType: 'html',									iframe: true,									beforeSubmit: function(formData, jqForm, options)									{														beforeSubmitChoose('<?=$bid->bid_id?>');									},									success: function(response)									{										successSubmitChoose(response, '<?=$bid->bid_id?>');									},									error: function(response)									{										errorSubmitChoose(response, '<?=$bid->bid_id?>');									}								});							});						</script>						<? endif; ?>						<div class='submit add_comment'><div><input type='button' class="" value='Добавить комментарий' onclick="addComment('<?=$bid->bid_id?>');" /></div></div>						<div class='submit save_comment' style="display:none;"><div><input type='button' class="" value='Сохранить' onclick="saveComment('<?=$bid->bid_id?>');" /></div></div>						<div class='submit cancel_comment' style="display:none;"><div><input type='button' class="" value='Отмена' onclick="cancelComment('<?=$bid->bid_id?>');" /></div></div>						<div class='submit expand_comments' <? if (empty($bid->comments)) : ?>style='display:none;'<? endif; ?>><div><input type='button' value='Развернуть переписку' onclick="expandComments('<?=$bid->bid_id?>');" /></div></div>						<div class='submit collapse_comments' style='display:none;'><div><input type='button' value='Свернуть переписку' onclick="collapseComments('<?=$bid->bid_id?>');" /></div></div>						<? if (isset($this->user) AND							$this->user->user_group == 'manager' AND							$this->user->user_id == $bid->manager_id) : ?>						<div class='submit delete_bid'><div><input type='button' class="" value='Удалить предложение' onclick="deleteItem('<?=$bid->bid_id?>');" /></div></div>						<? endif; ?>						<div class='floatleft'>							<img class="float comment_progress" style="display:none;margin:0px;margin-top:5px;" src="/static/images/lightbox-ico-loading.gif"/>						</div>					</div>				</td>			</tr>		</table>	</div>	<? endif; ?></div><br><br><? if ($is_own_bid) : ?><script>	$(function() {		$('#bidCommentForm').ajaxForm({			target: $('#bidCommentForm').attr('action'),			type: 'POST',			dataType: 'html',			iframe: true,			beforeSubmit: function(formData, jqForm, options)			{				beforeSubmitComment();			},			success: function(response)			{				successSubmitComment(response);			},			error: function(response)			{				errorSubmitComment(response);			}		});		<?= editor('comment', 90, 920, 'PackageComment') ?>	});</script><? endif; ?>