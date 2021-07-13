<form class="form-horizontal" method="post">
	<div class="modal-header btn-primary">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Invoice</h4>
    </div>
	<div class="modal-body">
		<b>Note : </b> ( <b><font color="red">*</font></b> ) <b><font color="red">compulsory fields</font></b><br>&nbsp; <span id="note"></span>
		<div class="form-group">
			<label class="col-md-2 control-label">Invoice ID:</label>
			<div class="col-md-4">
				<input type="text" name="form[CH_INVOICE_NO]" class="form-control" readonly value="<?php echo $doctype_rec->CH_INVOICE_NO?>">
			</div>
			<div class="col-md-6">
				<input type="text" name="form[CH_CUST_TYPE]" class="form-control" readonly value="<?php echo $doctype_rec->CH_CUST_TYPE?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Customer ID:</label>
			<div class="col-md-4">
				<input type="text" name="form[CH_CUST_ID]" class="form-control" readonly value="<?php echo $doctype_rec->CH_CUST_ID?>">
			</div>
			<label class="col-md-2 control-label">Customer Name: </label>
			<div class="col-md-4">
				<input type="text" name="form[CH_CUST_NAME]" class="form-control" readonly value="<?php echo $doctype_rec->CH_CUST_NAME?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Address: <b><font color="red">* </font></b></label>
			<div class="col-md-10">
				<textarea rows="2" cols="50" name="form[CH_ADDRESS]" class="form-control"> <?php echo $doctype_rec->CH_ADDRESS?> </textarea>
			</div>
		</div>
		<div class="form-group">
				<label class="col-md-2 control-label">Our Ref. : </label> 
				<div class="col-md-4"><input type="text" name="CH_OUR_REF" id="CH_OUR_REF" value="<?php echo $doctype_rec->CH_OUR_REF?>" onkeyup="this.value=this.value.toUpperCase();" class="form-control" placeholder="Our Ref"></div>
				<label class="col-md-2 control-label">Your. Ref : </label> 
				<div class="col-md-4"><input type="text" name="CH_YOUR_REF" id="CH_YOUR_REF" value="<?php echo $doctype_rec->CH_YOUR_REF?>" onkeyup="this.value=this.value.toUpperCase();" class="form-control" placeholder="Your Ref"></div>
			</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Inv. Type: <b><font color="red">* </font></b></label>
			<div class="col-md-4">
				<?php echo form_dropdown('form[CH_INVOICE_TYPE]',$P,$doctype_rec->CH_INVOICE_TYPE,'class="form-control select2" id="A"')?>
			</div>
			<label class="col-md-2 control-label">DT Account Code: <b><font color="red">* </font></b></label>
			<div class="col-md-4">
				<?php echo form_dropdown('form[CH_GLACCT_CODE]',$A,$doctype_rec->CH_GLACCT_CODE,'class="form-control select2" id="B"')?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-2 control-label">Invoice Desc:<b><font color="red">* </font></b></label>
			<div class="col-md-10">
				<textarea rows="2" cols="50" name="form[CH_INVOICE_DESC]" class="form-control"><?php echo $doctype_rec->CH_INVOICE_DESC?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Term:   <b><font color="red">* </font></b></label>
			<div class="col-md-10">
				<input type="text" name="form[CH_TERMS]" class="form-control" value="<?php echo $doctype_rec->CH_TERMS?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Status:</label>
			<div class="col-md-4">
				<input type="text" name="form[CH_STATUS]" class="form-control" readonly value="<?php echo $doctype_rec->CH_STATUS?>">
			</div>
				<label class="col-md-2 control-label">Entry By:</label>
			 <div class="col-md-4">
				<input type="text" name="form[CH_ENTER_BY]" class="form-control" readonly value="<?php echo $doctype_rec->CH_ENTER_BY?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Govt Tax: %  <b><font color="red">* </font></b></label>
			<div class="col-md-4">
				<input type="text" name="form[CH_GOVT_TAX]" class="form-control" placeholder="0" value="<?php if($doctype_rec->CH_GOVT_TAX==NULL){echo "0";}else{ echo $doctype_rec->CH_GOVT_TAX;}?>">
			</div>
		</div>
			<input type="hidden" name="form[CH_TOTAL_AMT]" class="form-control" readonly value="<?php echo $doctype_rec->CH_TOTAL_AMT?>">
			<input type="hidden" name="form[CH_NETT_AMT]" class="form-control" readonly value="<?php echo $doctype_rec->CH_NETT_AMT?>">
	</div>
  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove sm"> </i> Close</button>
        <button type="submit" class="btn btn-primary"> <i class="fa fa-save sm"> </i> Save</button>
  </div>
</form>

<script>
    $('form').submit(function (e) {
        e.preventDefault();
        
      	var data = $('form').serializeArray();
        
        data.push({name: 'type_id', value: '<?php echo $doctype_rec->CH_INVOICE_NO ?>'},{name: 'CH_OUR_REF', value:$('#CH_OUR_REF').val()},{name: 'CH_YOUR_REF', value:$('#CH_YOUR_REF').val()});
	  	msg.wait('#alert');
	
		$('.btn').attr('disabled', 'disabled');
	  	$.post('<?php echo $this->lib->class_url('updateType') ?>', data, function (res) {
	       	if (res.sts === 1) {
				$.alert({title:'',content: res.msg, type: 'green',});
	         	setTimeout(function () {
	             	location = '<?php echo $this->lib->class_url("viewall/$doctype_rec->CH_INVOICE_NO")?>';
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
	
	$(document).ready(function(){		
	$('#A').select2({
        dropdownParent:$('#myModalis2')
    });
	
	$('#B').select2({
        dropdownParent:$('#myModalis2')
    });
	});
</script>
  