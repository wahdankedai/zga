<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#received_suppliers_itemsoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/received_suppliers_itemsview/index/' },
		}; 
		
		$('#received_suppliers_itemsform').click(function(){$('#received_suppliers_itemsform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Received Suppliers Items</h3>

<p>
<div id="received_suppliers_itemsoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/received_suppliers_itemsadd/submit" id="received_suppliers_itemsform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/received_suppliers_itemslist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
