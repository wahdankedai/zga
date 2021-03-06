<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#blanket_inspection_sheetoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/blanket_inspection_sheetview/index/' },
		}; 
		
		$('#blanket_inspection_sheetform').click(function(){$('#blanket_inspection_sheetform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Blanket Inspection Sheet</h3>

<p>
<div id="blanket_inspection_sheetoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/blanket_inspection_sheetadd/submit" id="blanket_inspection_sheetform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>Date *</td><script type="text/javascript">$(document).ready(function() {$(".blanketinspectionsheet__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'blanketinspectionsheet__date', 'value' => $blanketinspectionsheet__date, 'class' => 'blanketinspectionsheet__datebasic'));?></td></tr>
<tr class='basic'>
<td>Customer *</td>
<td><?=form_dropdown('blanketinspectionsheet__customer_id', array(), '', 'class="basic"');?>&nbsp;<input id='blanketinspectionsheet__customer_id_lookup' type='button' value='Lookup'></input></td><div id='blanketinspectionsheet__customer_id_dialog'></div><script type="text/javascript">$(document).ready(function() {$('#blanketinspectionsheet__customer_id_dialog').dialog({ autoOpen: false, height: 500, width: 700, modal: true, buttons: { Cancel: function() { $( this ).dialog( 'close' ); } }, });$.get('<?=site_url();?>/customerlookup', function(data) { $('#blanketinspectionsheet__customer_id_dialog').html(data);$('#blanketinspectionsheet__customer_id_dialog a').attr('disabled', 'disabled');$('#blanketinspectionsheet__customer_id_dialog table tr').live('click', function() { var tr = $(this);var lines = $('td', tr).map(function(index, td) { return $(td).text(); });if (lines[0] != null) {$('select[name=blanketinspectionsheet__customer_id]').append('<option value=' + lines[0] + '>' + lines[1] + '</option>');$('select[name=blanketinspectionsheet__customer_id]').val(lines[0]);if (typeof window.blanket_inspection_sheet_selected_customer_id == 'function') { blanket_inspection_sheet_selected_customer_id("<?=site_url();?>"); }}$('#blanketinspectionsheet__customer_id_dialog').dialog('close');});$('#blanketinspectionsheet__customer_id_lookup').button().click(function() {$('#blanketinspectionsheet__customer_id_dialog').dialog('open');});});});</script></tr>
<tr class='basic'>
<td>Product Name</td>
<td><?=form_input(array('name' => 'blanketinspectionsheet__productname', 'value' => $blanketinspectionsheet__productname, 'class' => 'basic', 'id' => 'blanketinspectionsheet__productname'));?></td></tr>
<tr class='basic'>
<td>Press Type</td>
<td><?=form_input(array('name' => 'blanketinspectionsheet__presstype', 'value' => $blanketinspectionsheet__presstype, 'class' => 'basic', 'id' => 'blanketinspectionsheet__presstype'));?></td></tr>
<tr class='basic'>
<td>Bar Size</td>
<td><?=form_input(array('name' => 'blanketinspectionsheet__barsize', 'value' => $blanketinspectionsheet__barsize, 'class' => 'basic', 'id' => 'blanketinspectionsheet__barsize'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/blanket_inspection_sheetlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
