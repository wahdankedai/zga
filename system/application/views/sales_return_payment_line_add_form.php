<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#sales_return_payment_lineoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/sales_return_payment_lineview/index/' },
		}; 
		
		$('#sales_return_payment_lineform').click(function(){$('#sales_return_payment_lineform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Sales Return Payment Line</h3>

<p>
<div id="sales_return_payment_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_payment_lineadd/submit" id="sales_return_payment_lineform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Sales Return Invoice</td>
<td><?=form_dropdown('salesreturnpaymentline__salesreturninvoice_id', array(), '', 'class="basic"');?>&nbsp;<input id='salesreturnpaymentline__salesreturninvoice_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturnpaymentline__salesreturninvoice_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturnpaymentline__salesreturninvoice_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/sales_return_invoicelookup', function(data) { $('#salesreturnpaymentline__salesreturninvoice_id_dialog').html(data);$('#salesreturnpaymentline__salesreturninvoice_id_dialog a').attr('disabled', 'disabled');$('#salesreturnpaymentline__salesreturninvoice_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturnpaymentline__salesreturninvoice_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesreturnpaymentline__salesreturninvoice_id]').val(lines[0]);if (typeof window.sales_return_payment_line_selected_salesreturninvoice_id == 'function') { sales_return_payment_line_selected_salesreturninvoice_id("<?=site_url();?>"); }}$('#salesreturnpaymentline__salesreturninvoice_id_dialog').dialog('close');});$('#salesreturnpaymentline__salesreturninvoice_id_lookup').button().click(function() {$('#salesreturnpaymentline__salesreturninvoice_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_payment_linelist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
