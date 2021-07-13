<form class="form-horizontal" method="post">
    <div class="modal-header btn-danger">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash"></i> Delete Invoice</h4>
    </div>
    <div class="modal-body">
        <div id="alertDel"></div>
        <div>
        	Are you sure to delete this record? :<br><br>
        	<b>Invoice No   : <?php echo $doc_rec->CH_INVOICE_NO ?> </b><br>
        	<b>Customer No  : <?php echo $doc_rec->CH_CUST_ID ?> </b><br>
            <b>Customer Name: <?php echo $doc_rec->CH_CUST_NAME ?> </b><br>
		
    </div>
	</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
        
    </div>
</form>

<script>
	$(document).ready(function(){	
		$('form').submit(function (e) {
			e.preventDefault();
			msg.wait('#alertDel');
			$('.btn').attr('disabled', 'disabled');
			
			$.ajax({
				type: 'POST',
				url: '<?php echo $this->lib->class_url('deleteDet')?>',
				data: {type_id: '<?php echo $doc_rec->CH_INVOICE_NO ?>',
				id: '<?php echo $doc_rec->CH_ENTER_BY ?>'},
				dataType: 'JSON',
				success: function(res) {
					msg.show(res.msg, res.alert, '#alertDel');
					
					if (res.sts == 1) {
						setTimeout(function () {
							location = '<?php echo $this->lib->class_url('index')?>';
						}, 1000);
					} else {
						$('.btn').removeAttr('disabled');
					}
				},
				error: function() {
					$('.btn').removeAttr('disabled');
					msg.danger('Please contact administrator.', '#alertDel');
				}
			});	
		});	

	});  	  
</script>
	
</script>