<script type="text/javascript">
	$(document).ready(function() {
		//$('a').attr('target', '_blank');
		
		
		$('form table.main td a').click( function() {
			openlink($(this).attr('href'));
			return false;
		});
		
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#purchase_order_quote_linelist',
					success: 		purchase_order_quote_lineshowResponse,
		}; 
		
		$('#purchase_order_quote_linelistform').submit(function() { 
			$('#purchase_order_quote_linelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function purchase_order_quote_lineconfirmdelete(delid, obj)
	{
		$('#purchase_order_quote_line-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_order_quote_lineconfirmdelete2(delid, obj));
	}
	
	function purchase_order_quote_lineconfirmdelete2(delid, obj)
	{
		$( "#purchase_order_quote_line-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_order_quote_linecalldeletefn('purchase_order_quote_linedelete', delid, 'purchase_order_quote_linelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_order_quote_line-dialog-confirm').html('');
	}
	
	function purchase_order_quote_linesortupdown(field, direction)
	{
		$("#purchase_order_quote_linecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#purchase_order_quote_linelist',
					success: 		purchase_order_quote_lineshowResponse,
		}; 
		$('#purchase_order_quote_linelistform').ajaxSubmit(options);
		return false;
	}
	
	function purchase_order_quote_lineshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#purchase_order_quote_linelist',
					success: 		purchase_order_quote_lineshowResponse,
		}; 
		
		$('#purchase_order_quote_linelistform').submit(function() { 
			$('#purchase_order_quote_linelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function purchase_order_quote_linecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function purchase_order_quote_lineadd()
	{
		$('#purchase_order_quote_lineformholder').load('<?=site_url()."/purchase_order_quote_lineadd/";?>', function()
		{$('#purchase_order_quote_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_order_quote_lineformholder' + '\').html(\'\');' + '$(\'' + '#purchase_order_quote_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_order_quote_linelist' + '\').load(\'<?=site_url();?>/purchase_order_quote_linelist\');' + ';"></input>');
		});	
	}
	
	function purchase_order_quote_lineedit(id)
	{
		$('#purchase_order_quote_lineformholder').load('<?=site_url()."/purchase_order_quote_lineedit/index/";?>' + id, function()
		{$('#purchase_order_quote_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_order_quote_lineformholder' + '\').html(\'\');' + '$(\'' + '#purchase_order_quote_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_order_quote_linelist' + '\').load(\'<?=site_url();?>/purchase_order_quote_linelist\');' + ';"></input>');
		});	
	}
	
	function purchase_order_quote_lineview(id)
	{
		$('#purchase_order_quote_lineformholder').load('<?=site_url()."/purchase_order_quote_lineview/index/";?>' + id, function()
		{$('#purchase_order_quote_lineclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_order_quote_lineformholder' + '\').html(\'\');' + '$(\'' + '#purchase_order_quote_lineclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_order_quote_linelist' + '\').load(\'<?=site_url();?>/purchase_order_quote_linelist\');' + ';"></input>');
		});	
	}
	
	function purchase_order_quote_linegotopage()
	{
		var page = document.purchase_order_quote_linelistform.pageno.options[document.purchase_order_quote_linelistform.pageno.selectedIndex].value;
		
		$("#purchase_order_quote_linecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#purchase_order_quote_linelist',
					success: 		purchase_order_quote_lineshowResponse,
		}; 
		$('#purchase_order_quote_linelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="purchase_order_quote_line-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="purchase_order_quote_lineclosebutton"></div>
		<div id="purchase_order_quote_lineformholder"></div>
		<div id="purchase_order_quote_linelist">
		<!--<form method="post" action="<?=site_url();?>/purchase_order_quote_linelist/index/" id="purchase_order_quote_linelistform" name="purchase_order_quote_linelistform">-->
		<form method="post" action="<?=current_url();?>" id="purchase_order_quote_linelistform" name="purchase_order_quote_linelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="purchase_order_quote_linecurrsort">
			</div>
			<div id="purchase_order_quote_linesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="purchase_order_quote_lineadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_order_quote_lineadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_order_quote_lineadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				<?php foreach ($fields as $k=>$v): ?>
					<th>
						<?=$v;?><br/>
						<?php if (in_array($k, $sortby))
						{
							$index = array_search($k, $sortby);
							if (true)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="purchase_order_quote_linesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="purchase_order_quote_linesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="purchase_order_quote_linesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="purchase_order_quote_linesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
							<?php endif; ?>
						<?php } ?>
					</th>
				<?php endforeach; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				</tr>

				<?php foreach ($rows as $row): ?>
					<tr>
					<td><?=anchor('itemview/index/'.$row['purchaseorderquoteline__item_id'], $row['item__name']);?></td><td><?=number_format($row['purchaseorderquoteline__quantity'], 2);?></td><td><?=anchor('uomview/index/'.$row['purchaseorderquoteline__uom_id'], $row['uom__name']);?></td><td><?=number_format($row['purchaseorderquoteline__price'], 2);?></td><td><?=number_format($row['purchaseorderquoteline__subtotal'], 2);?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="purchase_order_quote_lineview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/purchase_order_quote_lineview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="purchase_order_quote_lineedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_order_quote_lineedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_order_quote_lineconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="purchase_order_quote_linegotopage();"');?>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>