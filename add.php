<form class="form-horizontal" method="post">
<hr>
	<table id="tbl_add_invoice" class="table table-striped">
	 <div class="modal-body">
		<div class="form-group">
			<label class="col-md-4 control-label"><b>Note : </b> ( <b><font color="red">*</font></b> ) <b><font color="red">compulsory fields</font></b><br>&nbsp; <span id="note"></span></label>
			<div class="col-md-4 pull-right"><?php echo form_dropdown('',$i,'','class="form-control select2" id="lsStaffID"') ?></div>
		</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Customer ID: <b><font color="red">* </font></b> </label>
				<div class="col-md-4"><input type="text" name="form[CustomerID]" id="id" class="form-control" placeholder="Customer ID" onkeyup="this.value=this.value.toUpperCase();"></div>
				<div class="col-md-6"><input type="text" name="form[CustomerName]" readonly id="name" class="form-control" placeholder="Name" ></div>
			</div>
				<input type="hidden" name="form[CH_CUST_TYPE]" id="typeID" value="<?php echo $p; ?>">
				<input type="hidden" name="form[CH_INVOICE_DATE]"  value="<?php echo date("d/m/Y"); ?>" >
				<input type="hidden" name="form[CH_TOTAL_AMT]"  value="0" >
				<input type="hidden" name="form[CH_STATUS]"  value="ENTRY" >
				<input type="hidden" name="form[CH_NETT_AMT]"  value="0" >
			<div class="form-group">
				<label class="col-md-2 control-label">Address: <b><font color="red">* </font></b></label>
				<div class="col-md-10"><textarea rows="2" cols="100" class="form-control" name="form[Address]" placeholder="Address" id="alamat"></textarea></div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Our Ref. : </label> 
				<div class="col-md-4"><input type="text" name="CH_OUR_REF" id="CH_OUR_REF" class="form-control" placeholder="Our Ref" onkeyup="this.value=this.value.toUpperCase();" ></div>
				<label class="col-md-2 control-label">Your. Ref : </label> 
				<div class="col-md-4"><input type="text" name="CH_YOUR_REF" id="CH_YOUR_REF"class="form-control" placeholder="Your Ref" onkeyup="this.value=this.value.toUpperCase();" ></div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Inv. Type:   <b><font color="red">* </font></b></label> 
				<div class="col-md-4"><?php echo form_dropdown('form[InvType]',$P,'','class="form-control select2" id="meseg" ')?></div>
				<label class="col-md-2 control-label">DT Account ID:  <b><font color="red">* </font></b></label> 
				<div class="col-md-4"><?php echo form_dropdown('form[AcoountCode]',$A,'','class="form-control select2" id="A"')?></div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Invoice Desc:  <b><font color="red">* </font></b></label> 
				<div class="col-md-10"><textarea rows="2" cols="100" class="form-control" name="form[InvoiceDescription]" placeholder="Description"></textarea></div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Terms:<b><font color="red">* </font></b></label> 
				<div class="col-md-10"><input type="text" name="form[Terms]" class="form-control" value="Sila Bayar Dalam Tempoh 30 Hari Dari Tarikh Inbois" ></div>
			</div>
				<input type="hidden" name="form[GovtTax]" placeholder="0"class="form-control" value="0">
				<input type="hidden" name="form[RoundingAMT]" placeholder="0.00" class="form-control" value="0.00">
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove sm"> </i>  Close</button>
		<button type="submit" class="btn btn-primary">Next  ></button>      
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
	
	$(document).ready(function(){	
		$('form').submit(function (e) { 
			e.preventDefault();
			var CH_OUR_REF = $('#CH_OUR_REF').val();
			var CH_YOUR_REF = $('#CH_YOUR_REF').val();
			var data = $('form').serializeArray();
			data.push({name: 'CH_OUR_REF', value:$('#CH_OUR_REF').val()},{name: 'CH_YOUR_REF', value:$('#CH_YOUR_REF').val()});
			msg.wait('#alert');
			$.ajax({
				type: 'POST',
				url: '<?php echo $this->lib->class_url('saveInvoice')?>',
				data: data,
				dataType: 'JSON',
				success: function(res) {
					if (res.sts == 1) {
						$.alert({title:'',content: 'Record successfully saved.', type: 'green',});
						setTimeout(function () {
							
							location = '<?php echo $this->lib->class_url('viewall')?>/'+res.msg;
						}, 1000);
					} else {
						$.alert({title:'',content: res.msg, type: 'red',});
						$('.btn').removeAttr('disabled');
					}
				},
				error: function() {
					$('.btn').removeAttr('disabled');
					msg.danger('Please contact administrator.', '#alert');
				}
			});	
		});  				

	}); 

	$(document).ready(function(){		
    $('#lsStaffID').select2({
        dropdownParent:$('#myAddModal')
    });
	
	$('#A').select2({
        dropdownParent:$('#myAddModal')
    });
	
	$('#meseg').select2({
        dropdownParent:$('#myAddModal')
    });
});
	
</script>
