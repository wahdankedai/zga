<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#sales_return_order_open_paymentchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function sales_return_order_open_paymentconfirmdelete(delid, obj)
	{
		$('#sales_return_order_open_payment-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_order_open_paymentconfirmdelete3(delid, obj));
	}

function sales_return_order_open_paymentconfirmdelete2(delid, obj)
	{
		$( "#sales_return_order_open_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_order_open_paymentcalldeletefn('sales_return_order_open_paymentdelete', delid, 'sales_return_order_open_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_order_open_payment-dialog-confirm').html('');
	}
	
	function sales_return_order_open_paymentconfirmdelete3(delid, obj)
	{
		$( "#sales_return_order_open_payment-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					sales_return_order_open_paymentcalldeletefn3('sales_return_order_open_paymentdelete', delid, 'sales_return_order_open_paymentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_order_open_payment-dialog-confirm').html('');
	}

function sales_return_order_open_paymentcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function sales_return_order_open_paymentcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="sales_return_order_open_payment-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Sales Return Order Open Payment</h3>

<?=form_hidden("sales_return_order_open_payment_id", $sales_return_order_open_payment_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>Date</td><td><?=$salesreturnorder__date;?></td></tr><tr class='basic'>
<td>Return ID</td><td><?=$salesreturnorder__salesreturnorderid;?></td></tr><tr class='basic'>
<td>Customer</td><td><?=isset($customer_opt[$salesreturnorder__customer_id])?$customer_opt[$salesreturnorder__customer_id]:'';?></td></tr><tr class='basic'>
<td>Currency</td><td><?=isset($currency_opt[$salesreturnorder__currency_id])?$currency_opt[$salesreturnorder__currency_id]:'';?></td></tr><tr class='basic'>
<td>Currency Rate</td><td><?=number_format($salesreturnorder__currencyrate, 2);?></td></tr><tr class='basic'>
<td>Notes</td><td><?=$salesreturnorder__notes;?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$salesreturnorder__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$salesreturnorder__updatedby;?></td></tr>

</table>

<br>
<div id="sales_return_order_open_paymentbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_order_open_paymentedit/index/".$sales_return_order_open_payment_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_order_open_paymentconfirmdelete(<?=$sales_return_order_open_payment_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="sales_return_order_open_paymentchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_order_open_paymentlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
