
                <?php include "header.php" ?>
<div id="maincontent">
  
<h3 class="addtitle">Laporan Manufacturing</h3>

<p>
<div id="salesreportoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/laporan_manufacturing_cont/submit" id="salesreportform" class="addform">
<table width="100%" class="addtable">
<tr class='basic'>
<tr class='basic'>
<td>From Date *</td><script type="text/javascript">$(document).ready(function() {$(".salesreport__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'date_from', 'value' => $currentdate, 'class' => 'salesreport__datebasic'));?></td>
</tr>
<tr class='basic'>
<td>To Date *</td><script type="text/javascript">$(document).ready(function() {$(".salesreport__datebasic").datepicker({ showOn: 'button', buttonText: "Cal", autoSize: true, dateFormat: 'dd-mm-yy' });});</script>
<td><?=form_input(array('name' => 'date_to', 'value' => $currentdate, 'class' => 'salesreport__datebasic'));?></td>
</tr>

</table>

<p>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
