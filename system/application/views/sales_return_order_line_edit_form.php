<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#sales_return_order_lineoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#sales_return_order_lineeditform').click(function(){$('#sales_return_order_lineeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Sales Return Order Line</h3>

<p>
<div id="sales_return_order_lineoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/sales_return_order_lineedit/submit" id="sales_return_order_lineeditform" class="editform">

<?=form_hidden("sales_return_order_line_id", $sales_return_order_line_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>Item *</td><td><?=form_dropdown('salesreturnorderline__item_id', $item_opt, $salesreturnorderline__item_id);?>&nbsp;<input id='salesreturnorderline__item_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturnorderline__item_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturnorderline__item_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/itemlookup', function(data) { $('#salesreturnorderline__item_id_dialog').html(data);$('#salesreturnorderline__item_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturnorderline__item_id]').append('<option value=' + lines[0] + '>' + lines[2] + '</option>');$('select[name=salesreturnorderline__item_id]').val(lines[0]);if (typeof window.sales_return_order_line_selected_item_id == 'function') { sales_return_order_line_selected_item_id("<?=site_url();?>"); }}$('#salesreturnorderline__item_id_dialog').dialog('close');});$('#salesreturnorderline__item_id_lookup').button().click(function() {$('#salesreturnorderline__item_id_dialog').dialog('open');});});});</script></tr><tr class='basic'>
<td>Quantity *</td><td><?=form_input(array('name' => 'salesreturnorderline__quantitytoreceive', 'value' => $salesreturnorderline__quantitytoreceive, 'id' => 'salesreturnorderline__quantitytoreceive'));?></td></tr><tr class='basic'>
<td>Unit *</td><td><?=form_dropdown('salesreturnorderline__uom_id', $uom_opt, $salesreturnorderline__uom_id);?>&nbsp;<input id='salesreturnorderline__uom_id_lookup' type='button' value='Lookup'></input></td><div id='salesreturnorderline__uom_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#salesreturnorderline__uom_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/uomlookup', function(data) { $('#salesreturnorderline__uom_id_dialog').html(data);$('#salesreturnorderline__uom_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=salesreturnorderline__uom_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=salesreturnorderline__uom_id]').val(lines[0]);if (typeof window.sales_return_order_line_selected_uom_id == 'function') { sales_return_order_line_selected_uom_id("<?=site_url();?>"); }}$('#salesreturnorderline__uom_id_dialog').dialog('close');});$('#salesreturnorderline__uom_id_lookup').button().click(function() {$('#salesreturnorderline__uom_id_dialog').dialog('open');});});});</script></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/sales_return_order_linelist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


