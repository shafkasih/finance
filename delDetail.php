<script>
function sum() {
	var totalGST,total_amt, total_net;
	total_amt= parseInt(document.form1.CD_TOTAL_AMT.value);
	var count=parseFloat(document.form1.count.value);
	var gst= parseFloat(document.form1.gst.value);
	var rounding=parseFloat(document.form1.rounding.value);
	totalGST=(gst*count)/100
	total_net=(count + totalGST) - rounding;
	if(!isNaN(total_amt) && !isNaN(total_net)){
		document.form1.CH_NETT_AMT.value=total_net;
		document.form1.CH_TOTAL_AMT.value=count;
	}
	}
</script>
<form class="form-horizontal" name="form1" method="post">
    <div class="modal-header btn-danger">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash"></i> <b>Delete Detail :</b> <?php echo $detail->CD_INVOICE_NO ." (".$detail->CD_SEQ_NO.")";?></h4>
    </div>
    <div class="modal-body">
			Are you sure to delete this record? :<br><br>
        <div class="form-group">
        	<dt class="col-sm-3">Description:</dt>
			<dd class="col-sm-8"><?php echo $detail->CD_DETAIL_DESC?></dd><br>
			
            <dt class="col-sm-3">Total AMT:</dt>
			<dd class="col-sm-3"><?php echo "RM ".number_format($detail->CD_TOTAL_AMT,2);?></dd><br><br>
			
			<dt class="col-sm-6"><input type="checkbox" step="any" id="CD_TOTAL_AMT" onclick="sum()" value="<?php echo $detail->CD_TOTAL_AMT?>" required ><font color="red"><b> Please tick for confirmation.</b></font></dt>
		</div>
			<input type="hidden" id="CH_NETT_AMT" name="form[CH_NETT_AMT]" class="form-control" readonly value="<?php echo $head->CH_NETT_AMT?>">
			<input type="hidden" id="CH_TOTAL_AMT" name="form[CH_TOTAL_AMT]" class="form-control" readonly value="<?php echo $head->CH_TOTAL_AMT?>">
			<input type="hidden" step="any" id="gst"  readonly value="<?php if($head->CH_GOVT_TAX==NULL){echo "0";}else{ echo $head->CH_GOVT_TAX;}?>">
			<input type="hidden" step="any" id="rounding" readonly value="<?php if($head->CH_ROUNDING_AMT==NULL){echo "0";}else{ echo $head->CH_ROUNDING_AMT;}?>">
			<?php
			$count=0;
			foreach($detail_all as $P){
				$count=$count + $P->CD_TOTAL_AMT;	
			}?>
			<input type="hidden" name="form[CH_ENTER_BY]" readonly value="<?php echo $head->CH_ENTER_BY?>">
			<input type="hidden" id="count" step="any"  value="<?php echo $count;?>">
	</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
        
    </div>
</form>

<script>
   $('form').submit(function (e) {
        e.preventDefault();
        
      	var data = $('form').serializeArray();
        
        data.push({
		name: 'type_id', value: '<?php echo $head->CH_INVOICE_NO ?>'},
		{name: 'enter', value: '<?php echo $head->CH_ENTER_BY ?>'},
			{name: 'seq', value: '<?php echo $detail->CD_SEQ_NO?>' 
		});
	
	  	$.post('<?php echo $this->lib->class_url('deletedetail') ?>', data, function (res) {
	       	
	       	if (res.sts === 1) {
				$.alert({title:'',content: res.msg, type: 'green',});
	         	setTimeout(function () {
	             	location = '<?php echo $this->lib->class_url("viewall/$head->CH_INVOICE_NO")?>';
	         	}, 1000);
	       	} else {
				$.alert({title:'',content: res.msg, type: 'red',});
	         	$('.btn').removeAttr('disabled');
	     	}
	  	}, 'json').error(function () {
	   		$('.btn').removeAttr('disabled');
	    	msg.danger('Please contact administrator.', '#alert');
	 	});
    });  	  
</script>
	