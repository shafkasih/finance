<form class="form-horizontal" method="post">
<hr>
<table id="tbl_add_invoice2" class="table table-striped">
	<div class="modal-body">
		<b>Note : </b> ( <b><font color="red">*</font></b> ) <b><font color="red">compulsory fields</font></b><br>&nbsp; <span id="note"></span>
		<div class="form-group">
            <label class="col-md-2 control-label">Customer ID: <b><font color="red">* </font></b> </label>
            <div class="col-md-3"> <input type="text" name="form[CustomerID]" class="form-control" onkeyup="this.value=this.value.toUpperCase();" placeholder="Customer ID"></div>
			<label class="col-md-2 control-label">Name Customer:   <b><font color="red">* </font></b></label> 
			<div class="col-md-5"><input type="text" name="form[CustomerName]" class="form-control" placeholder="Customer Name"></div>
        </div>
			<input type="hidden" name="form[CH_CUST_TYPE]" value="<?php echo $p; ?>">
			<input type="hidden" name="form[CH_INVOICE_DATE]"  value="<?php echo date("d/m/Y"); ?>" >
			<input type="hidden" name="form[CH_TOTAL_AMT]"  value="0" >
			<input type="hidden" name="form[CH_STATUS]"  value="ENTRY" >
			<input type="hidden" name="form[CH_NETT_AMT]"  value="0" >
		<div class="form-group">
			<label class="col-md-2 control-label">Address:   <b><font color="red">* </font></b></label> 
			<div class="col-md-10"><textarea rows="2" cols="50" class="form-control" name="form[Address]" placeholder="Address" id="alamat"></textarea></div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Inv. Type:  <b><font color="red">* </font></b></label> 
			<div class="col-md-4"><?php echo form_dropdown('form[InvType]',$P,'','class="form-control select2" id="meseg" ')?></div>
			<label class="col-md-2 control-label">Account ID:  <b><font color="red">* </font></b></label> 
			<div class="col-md-4"><?php echo form_dropdown('form[AcoountCode]',$A,'','class="form-control select2" id="A"')?></div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Invoice Desc:  <b><font color="red">* </font></b></label> 
			<div class="col-md-10"><textarea rows="2" cols="50" class="form-control" name="form[InvoiceDescription]" placeholder="Description"></textarea></div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Terms:</label> 
			<div class="col-md-10"><input type="text" name="form[Terms]" class="form-control" value="Sila Bayar Dalam Tempoh 30 Hari Dari Tarikh Inbois" ></div>
		</div>
			<input type="hidden" name="form[GovtTax]" placeholder="0"class="form-control" value="0">
			<input type="hidden" name="form[RoundingAMT]" placeholder="0.00" class="form-control" value="0.00">
    </div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
	<button type="submit" class="btn btn-primary">Next ></button>
</div>
	
</table>
</form>

<script>
	
	$(document).ready(function(){	
		$('form').submit(function (e) { 
			e.preventDefault();
			var data = $('form').serialize();
			msg.wait('#alert');
			$('.btn').attr('disabled', 'disabled');
			$.ajax({
				type: 'POST',
				url: '<?php echo $this->lib->class_url('saveInvoice2')?>',
				data: data,
				dataType: 'JSON',
				success: function(res) {
					if (res.sts == 1) {
						$.alert({title:'',content: 'Record successfully saved. Bill No: '+res.msg, type: 'green',});
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
	$('#A').select2({
        dropdownParent:$('#myAddModal')
    });
	
	$('#meseg').select2({
        dropdownParent:$('#myAddModal')
    });
	});
</script>
