<form class="form-horizontal" method="post">
<hr>
<table id="tbl_add_invoice" class="table table-striped">
	<div class="modal-body">
		<b>Note : </b> ( <b><font color="red">*</font></b> ) <b><font color="red">compulsory fields</font></b><br>&nbsp; <span id="note"></span>
		<div class="form-group">
			<label class="col-md-3 control-label">Customer ID: <b><font color="red">* </font></b> </label>
			<div class="col-md-9">
			<input type="text" name="form[CustomerID]" class="form-control" onkeyup="this.value=this.value.toUpperCase();" placeholder="Customer ID"></div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Name Customer:   <b><font color="red">* </font></b></label> 
			<div class="col-md-9"><input type="text" name="form[CustomerName]" class="form-control" placeholder="Customer Name"></div>
        </div>
			<input type="hidden" name="form[CH_CUST_TYPE]" id="typeID" value="<?php echo $p; ?>">
			<input type="hidden" name="form[CH_INVOICE_NO]" id="typeID" value="<?php echo $id; ?>">
			<input type="hidden" name="form[CH_ENTER_BY]" class="form-control" readonly value="<?php echo $doctype_rec->CH_ENTER_BY?>">
		<div class="form-group">
			<label class="col-md-3 control-label">Address:   <b><font color="red">* </font></b></label> 
			<div class="col-md-9"><textarea rows="2" cols="50" class="form-control" name="form[Address]" placeholder="Address" id="alamat"></textarea></div>
		</div>
    </div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove sm"> </i> Close</button>
		<button type="submit" class="btn btn-warning">Change</button>  
	</div>
</table>
</form>

<script>
	
	 $('form').submit(function (e) {
        e.preventDefault();
        
      	var data = $('form').serializeArray();
        
        data.push({name: 'type_id', value: '<?php echo $id ?>'});
	  	msg.wait('#alert');
	
		$('.btn').attr('disabled', 'disabled');
	  	$.post('<?php echo $this->lib->class_url('updateTypeCust') ?>', data, function (res) {
	       	if (res.sts === 1) {
				$.alert({title:'',content: res.msg, type: 'green',});
	         	setTimeout(function () {
	             	location = '<?php echo $this->lib->class_url("viewall/$id")?>';
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
