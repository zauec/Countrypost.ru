<div id="newBidForm" style='display:none;'><? View::show('main/elements/orders/newBid'); ?></div><script type="text/javascript">	var bidFormInitialized = false;	function initBidForm()	{		bidFormInitialized = true;		refreshTotals();	}	function showNewBidForm()	{		if (window.user_group == undefined)		{			window.location = '#';			success('top', 'Пожалуйста, войдите или зарегистрируйтесь для добавления нового предложения.');		}		else		{			$('div#newBidButton').hide('slow');			$('div#newBidForm').show(0, function() {				$('div#bid0').each(function() {					if ( ! bidFormInitialized)					{						initBidForm();					}					$('div#bid0').show('slow', function() {						window.location = '#new_bid';					});				});			});		}	}	function cancelBid()	{		$('div#bid0').hide('slow');		$('div#newBidButton').show('slow');	}		function refreshTotals()	{		order_total_cost = 			order_products_cost +			manager_tax +			manager_foto_tax +			extra_tax +			parseFloat(order_delivery_cost);					order_total_cost = Math.ceil(order_total_cost);		$bid = $('#bid0');		$bid			.find('.manager_tax')			.val(manager_tax)			.html(manager_tax);		$bid			.find('.manager_tax_percentage')			.val(manager_tax_percentage)			.html(manager_tax_percentage);		$bid			.find('.manager_foto_tax')			.val(manager_foto_tax)			.html(manager_foto_tax);		$bid			.find('.requested_foto_count')			.val(requested_foto_count)			.html(requested_foto_count);		$bid			.find('.manager_foto_tax')			.val(manager_foto_tax)			.html(manager_foto_tax);		$bid			.find('.extra_tax')			.val(extra_tax)			.html(extra_tax);		$bid			.find('.order_total_cost')			.val(order_total_cost)			.html(order_total_cost);		$bid			.find('.order_delivery_cost')			.val(order_delivery_cost)			.html(order_delivery_cost);		$bid			.find('.order_products_cost')			.val(order_products_cost)			.html(order_products_cost);		$bid			.find('.order_weight')			.val(order_weight)			.html(order_weight);		$bid			.find('.extra_tax_counter')			.val(extra_tax_counter)			.html(extra_tax_counter);	}		function addBid()	{		$('#bidForm').submit();	}	function editFotoTax()	{		$('#bidForm .foto_tax_plaintext').hide('fast');		$('#bidForm .foto_tax_editor').show('fast');	}	function editManagerTax()	{		$('#bidForm .manager_tax_plaintext').hide('fast');		$('#bidForm .manager_tax_editor').show('fast');	}	function addExtraTax()	{		var $template = $('#bidForm .template').clone();		$template			.removeClass('template')			.find('input.extra_tax_value')			.attr('name', 'extra_tax_value' + extra_tax_counter)			.keypress(function(event) {				validate_float(event);			})			.change(function() {					updateExtraTax();				});		$template			.find('input.extra_tax_name')			.attr('name', 'extra_tax_name' + extra_tax_counter);		$('#bidForm div.extra_tax_box:last').after($template);		$template.show('fast');		extra_tax_counter++;		refreshTotals();	}	function parseGenericTax(input)	{		var newTax = $(input).val();		if (newTax == '')		{			newTax = 0;		}		return (isNaN(newTax) ? 0 : parseInt(newTax));	}	// доп. комиссии	function updateExtraTax()	{		extra_tax = 0;		$('#bidForm input.extra_tax_value').each(function(index, item) {			extra_tax += parseGenericTax(item);		});		refreshTotals();	}	function removeExtraTax(image)	{		$(image)			.parent()			.parent()			.remove();		updateExtraTax();		refreshTotals();	}</script>