<form class="form-horizontal" method="post">
<hr>
<table id="tbl_add_invoice" class="table table-striped">
	 <div class="modal-body">
		<div class="form-group">
			<label class="col-md-5 control-label"><b>Note : </b> ( <b><font color="red">*</font></b> ) <b><font color="red">compulsory fields</font></b><br>&nbsp; <span id="note"></span></label>
			<div class="col-md-5 pull-right"><?php echo form_dropdown('',$i,'','class="form-control select2" id="lsStaffID"') ?></div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Customer ID: <b><font color="red">* </font></b> </label>
			<div class="col-md-9"><input type="text" name="form[CustomerID]" id="id" class="form-control" placeholder="Customer ID" onkeyup="this.value=this.value.toUpperCase();"></div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label"></label>
			<div class="col-md-9"><input type="text" name="form[CustomerName]" readonly id="name" class="form-control" placeholder="Name" ></div>
		</div>
			<input type="hidden" name="form[CH_CUST_TYPE]" id="typeID" value="<?php echo $p; ?>">
			<input type="hidden" name="form[CH_INVOICE_NO]" id="typeID" value="<?php echo $id; ?>">
			<input type="hidden" name="form[CH_ENTER_BY]" class="form-control" readonly value="<?php echo $doctype_rec->CH_ENTER_BY?>">
		<div class="form-group">
			<label class="col-md-3 control-label">Address: <b><font color="red">* </font></b></label>
			<div class="col-md-9"><textarea rows="2" cols="100" class="form-control" name="form[Address]" placeholder="Address" id="alamat"></textarea></div>
		</div>
	</div>
	<div class="modal-footer">
	 <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove sm"> </i> Close</button>
	 <button type="submit" class="btn btn-warning">Change</button>  
	</div>
	
</table>
</form>

<script>
$('#lsStaffID').change(function() {
    var sID = $('#lsStaffID').val();
	var typeID = $('#typeID').val();
	if(typeID=="STAF"){
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('staff')?>',
			data: {'ID' : sID},
			dataType: 'json',
			success: function(res) {
                if (res.sts == 1) {
                    $('#id').val(res.id);
                    $('#name').val(res.name);
					$('#alamat').val(res.alamat);
                } else if(res.sts == 2){
					$.alert({title:'',content: res.msg, type: 'red',});
					$('#id').val('');
                    $('#name').val('');
					$('#alamat').val('');
				}
				else {
					 $('#id').val(res.id);
					$('#name').val(res.name);
					$('#alamat').val('');
					$('.btn').removeAttr('disabled');
				}
			},
		});
	}
	
	else if(typeID=="VEND"){
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('vend')?>',
			data: {'ID' : sID},
			dataType: 'json',
			success: function(res) {
                if (res.sts == 1) {
					 $('#id').val(res.id);
                    $('#name').val(res.name);
					$('#alamat').val(res.alamat);
                }  else if(res.sts == 2){
					$.alert({title:'',content: res.msg, type: 'red',});
					$('#id').val('');
                    $('#name').val('');
					$('#alamat').val('');
				}
				else {
					$('#id').val(res.id);
					$('#name').val(res.name);
					$('#alamat').val('');
					$('.btn').removeAttr('disabled');
				}
			},
		});
	}
	
	else if(typeID=="SPON"){
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('spon')?>',
			data: {'ID' : sID},
			dataType: 'json',
			success: function(res) {
                if (res.sts == 1) {
					$('#id').val(res.id);
                    $('#name').val(res.name);
					$('#alamat').val(res.alamat);
                } else if(res.sts == 2){
					$.alert({title:'',content: res.msg, type: 'red',});
					$('#id').val('');
                    $('#name').val('');
					$('#alamat').val('');
				}else {
					$('#id').val(res.id);
					$('#name').val(res.name);
					$('#alamat').val('');
					$('.btn').removeAttr('disabled');
				}
			},
		});
	}
	else if(typeID=="OTHR"){
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('othr')?>',
			data: {'ID' : sID},
			dataType: 'json',
			success: function(res) {
                if (res.sts == 1) {
					$('#id').val(res.id);
                    $('#name').val(res.name);
					$('#alamat').val(res.alamat);
                } else if(res.sts == 2){
					$.alert({title:'',content: res.msg, type: 'red',});
					$('#id').val('');
                    $('#name').val('');
					$('#alamat').val('');
				}else {
					$('#id').val(res.id);
					$('#name').val(res.name);
					$('#alamat').val('');
					$('.btn').removeAttr('disabled');
				}
			},
		});
	}
	});	
	
	$('#id').change(function() {
		 $('#name').val('');
		 $('#alamat').val('');
		var ID = $('#id').val();
		var typeID = $('#typeID').val();
			$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('detailCust')?>',
			data: {'ID':ID,'typeID':typeID},
			dataType: 'json',
			success: function(res) {
                if (res.sts == 1) {
                    $('#name').val(res.name);
					$('#alamat').val(res.alamat);
					
                } else {
					$.alert({title:'',content: res.msg, type: 'red',});
				}
				}	
				
			});
	});	
	
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

	
	$(document).ready(function(){		
    $('#lsStaffID').select2({
        dropdownParent:$('#myEditModal')
    });
	});
	
</script>
