<?php ?>
<section id="widget-grid" class="">
    <div class="jarviswidget  jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" role="widget">
        <header role="heading">
            <div class="jarviswidget-ctrls" role="menu">
                <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" data-placement="bottom"><i class="fa fa-expand "></i></a>
            </div>
            <h2>Invoice Information</h2>				
            <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
        </header>
        <div role="content">
            <div class="jarviswidget-editbox">
            </div>
            <div class="widget-body">

                <!-- widget div-->
                <div role="content">

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->

                    </div>
                        <!-- end widget edit box -->
                        <!-- add doc list button -->
                    
                    <div class="widget-body">
                        
                       	<!-- begin myTabContent1 -->
            <div id="myTabContent1" class="tab-content padding-10">
            <div class="tab-pane fade active in" id="s1">
			<div class="row text-left">
				<h5 class="panel-heading bg-color-blueLight txt-color-white">Invoice Header</h5>
			</div>
			<form class="form-horizontal" method="post">
				<div class="modal-body ">
					<div class="pull-right">
					<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
					<button type="button" title="Edit"class="edit btn btn-primary btn-sm"><strong><i class="fa fa-pencil-square fa-lg"></i></strong></button>
					<button type="button" title="Edit"class="edit2 btn btn-warning btn-sm"><strong><i class="fa fa-pencil-square fa-lg"></i></strong> Change Customer</button>
					<button type="button" title="Print" type_id="<?php echo $inEnc; ?>" class="print2 btn btn-success btn-sm"><strong></strong><i class="fa fa-file-pdf-o "></i>  Cover Letter</button>
					<button type="button" title="Print" type_id="<?php echo $inEnc; ?>" class="print btn btn-success btn-sm"><strong></strong><i class="fa fa-file-pdf-o "></i>  Print</button>
					</div>
				</div>
				<div class="modal-body ">
					<div class="form-group">
						<label class="col-md-2 control-label ">Invoice ID:</label>
						<div class="col-md-2">
							<input type="text" id="typeT" class="form-control" value="<?php echo $P->CH_INVOICE_NO?>" readonly>
						</div>
						<label class="col-md-2 control-label ">DT Account Code:</label>
						<div class="col-md-2">
							<input type="text" class="form-control" value="<?php echo $P->CH_GLACCT_CODE?>" readonly>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" value="<?php if($P->CH_CUST_TYPE=='STAF'){echo "STAFF";}else if($P->CH_CUST_TYPE=='SPON'){echo "SPONSOR";}else if($P->CH_CUST_TYPE=='OTHR'){echo "OTHER";}ELSE if($P->CH_CUST_TYPE=='VEND'){echo "VENDOR";}?>" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Invoice Description: </label>
						<div class="col-md-10">
							<input type="text" class="form-control" value="<?php echo $P->CH_INVOICE_DESC?>" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Customer ID: </label>
						<div class="col-md-4">
							<input type="text" class="form-control" value="<?php echo $P->CH_CUST_ID?>" placeholder="" readonly>
						</div>
						<label class="col-md-2 control-label">Customer Name:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" value="<?php echo $P->CH_CUST_NAME?>" placeholder="" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Customer Address: </label>
						<div class="col-md-10">
							<textarea rows="2" cols="50" class="form-control" readonly> <?php echo $P->CH_ADDRESS?> </textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Our Ref.:  </label> 
						<div class="col-md-4"><input type="text" class="form-control" value="<?php echo $P->CH_OUR_REF?>" readonly></div>
						<label class="col-md-2 control-label">Your. Ref: </label> 
						<div class="col-md-4"><input type="text" class="form-control" value="<?php echo $P->CH_YOUR_REF?>" readonly></div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Entry Date:</label>
						<div class="col-md-4">
							<input type="text"  class="form-control" value="<?php if($P->CH_INVOICE_DATE!=null){echo date_format(date_create($P->CH_INVOICE_DATE),"d-m-Y H:i:s A");}?>" placeholder="" readonly>
						</div>
						<label class="col-md-2 control-label">Entry By:</label>
						<div class="col-md-4">
							<input type="text"  class="form-control" value="<?php echo $P->CH_ENTER_BY?>" placeholder="" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Verify Date</label>
						<div class="col-md-4">
							<input type="text"  class="form-control" value="<?php  if($P->CH_VERIFY_DATE!=null){echo date_format(date_create($P->CH_VERIFY_DATE),"d-m-Y H:i:s A");}?>" placeholder="" readonly>
						</div>
						<label class="col-md-2 control-label">Verify By</label>
						<div class="col-md-4">
							<input type="text"  class="form-control" value="<?php echo $P->CH_VERIFY_BY?>" placeholder="" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Approve Date</label>
						<div class="col-md-4">
							<input type="text"  class="form-control" value="<?php if($P->CH_APPROVE_DATE!=null){echo date_format(date_create($P->CH_APPROVE_DATE),"d-m-Y H:i:s A");}?>" placeholder="" readonly>
						</div>
						<label class="col-md-2 control-label">Approve By</label>
						<div class="col-md-4">
							<input type="text"  class="form-control" value="<?php echo $P->CH_APPROVE_BY?>" placeholder="" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Cancel Date</label>
						<div class="col-md-4">
							<input type="text"  class="form-control" value="<?php if($P->CH_CANCEL_DATE!=null){echo date_format(date_create($P->CH_CANCEL_DATE),"d-m-Y H:i:s A");}?>" placeholder="" readonly>
						</div>
						<label class="col-md-2 control-label">Cancel By</label>
						<div class="col-md-4">
							<input type="text"  class="form-control" value="<?php echo $P->CH_CANCEL_BY?>" placeholder="" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Cancel Reason </label>
						<div class="col-md-10">
							<input type="text" class="form-control" value="<?php echo $P->CH_CANCEL_REASON?>" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Term:</label>
						<div class="col-md-10">
							<textarea  class="form-control" placeholder="" readonly><?php echo $P->CH_TERMS?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Gov. Tax:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" value="<?php echo $P->CH_GOVT_TAX ."%"?>" placeholder="" readonly>
						</div>
						<label class="col-md-2 control-label">Rounding Amt:</label>
						<div class="col-md-4">
							<input type="text"  class="form-control" value="<?php echo number_format($P->CH_ROUNDING_AMT,2)?>" placeholder="" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Total Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" value="<?php echo "RM". number_format($P->CH_TOTAL_AMT,2)?>" placeholder="" readonly>
						</div>
						<label class="col-md-2 control-label">Nett Amount:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" value="<?php echo "RM". number_format($P->CH_NETT_AMT,2)?>" placeholder="" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Status: </label>
						<div class="col-md-4">
							<input type="text" id="status" class="form-control" value="<?php echo $P->CH_STATUS?>" placeholder="" readonly>
						</div>
						<label class="col-md-2 control-label">Invoice Type: </label>
						<div class="col-md-4">
							<input type="text" id="status" class="form-control" value="<?php echo $P->CH_INVOICE_TYPE?>" placeholder="" readonly>
						</div>
					</div>
				</div>
			</form>	
				<div class="row text-left">
					<h5 class="panel-heading bg-color-blueLight txt-color-white">Invoice Detail</h5>
				</div>
				</div>              
						<div align="right">
                         <?php echo '<a href="'.site_url('acctreceivable/Wrf001/addDoc/'.$P->CH_INVOICE_NO). '"><button type="button" class="btn btn-primary btn-sm addDoc" data-toggle="tooltip"><i class="fa fa-plus"></i>  Add Invoice Detail</button></a>' ?>
                        </div> 			
							<br>
							<table id="table_list" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
											<th class="text-center">Seq ID</th>
											<th class="text-center">Description</th>
											<th class="text-center">CR Account Code</th>
											<th class="text-center">Qty</th>
											<th class="text-center">Unit Price</th>
											<th class="text-center">Tax(%)</th>
											<th class="text-center">Total Amount</th>
											<th class="text-center">Rounding</th>
											<th class="text-center">Action</th>
											</tr>
                                        </thead>
										
										<?php
                                            if (!empty($doc_rec)) {
                                            $i = 1;
                                                foreach ($doc_rec as $doc) {
												//$type_id=$doc->CD_INVOICE_NO;
                                                echo    '<tr>
                                                         
                                                            <td class="text-center">' . $doc->CD_SEQ_NO . '</td>
															<td class="text-left">' . $doc->CD_DETAIL_DESC . '</td>
															<td class="text-left">' . $doc->CD_ACCOUNT_CODE . '</td>
															<td class="text-center">' . $doc->CD_QTY . '</td>
															<td class="text-center">' . "RM".number_format($doc->CD_UNIT_PRICE,2) . '</td>
															<td class="text-center">' . $doc->CD_GST_TAXAMT*100 . '</td>
															<td class="text-center">' . "RM".number_format($doc->CD_TOTAL_AMT,2) . '</td>
															<td class="text-center">' . number_format($doc->CD_ROUNDING_AMT,2) . '</td>
															<td class="text-center">
                                                            <div class="btn center ">
															<button type="button" rel="tooltip"   title="view" type_id="' . $doc->CD_INVOICE_NO . '" doc_id="' . $doc->CD_SEQ_NO . '" class="btn btn-success btn-xs detail_doc_btn"><strong><i class="fa fa-info-circle"></i></strong></button>
                                                            <a href="'.site_url('acctreceivable/Wrf001/editDetail/'.$P->CH_INVOICE_NO .'/'.$doc->CD_SEQ_NO). '"><button type="button" rel="tooltip"  title="edit" type_id="' . $doc->CD_INVOICE_NO . '" doc_id="' . $doc->CD_SEQ_NO . '" class="btn btn-primary btn-xs edit_doc_btn"><strong><i class="fa fa-pencil-square"></i></strong></button></a>
                                                            <button type="button" rel="tooltip"  title="Delete" type_id="' . $doc->CD_INVOICE_NO . '" doc_id="' . $doc->CD_SEQ_NO . '" class="btn btn-danger btn-xs del_doc_btn"><strong><i class="fa fa-trash-o fa-lg"></i></strong></button>   
                                                            </td>
															</div>
                                                            </td>
                                                        </tr>';
												
                                                }
                                            } else {
                                                echo '<tr><td colspan="12" class="text-center">No record found.</td></tr>';
                                            }
                                        ?>
                                 </table>
                                    
                        </div>
                        <!-- end myTabContent1 -->
                    </div>
                    <!-- end widget content -->
                            
                </div>
                <!-- end widget div -->

            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cover Letter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
		</div>
		<div class="modal-body">
        <object id="web_viewer" data="" width="100%" height="500">
			Error: Embedded data could not be displayed.
		</object>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reportModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Invoice Query</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <object id="web_viewer2" data="" width="100%" height="500">
			Error: Embedded data could not be displayed.
		</object>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- ADD / EDIT / DELETE page will be displayed here -->
<div class="modal fade" id="myModalis2" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- end ADD / EDIT / DELETE -->

<div class="modal fade" id="myModalis" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- end ADD / EDIT / DELETE -->
<div class="modal fade" id="myEditModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header btn-warning">
				<h5 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square"></i> Change Customer</h5>
				</div>	
				  <div class="modal-body" >
					<div class="row">
					<div class="col-md-2"></div>
						<div class="col-md-2" class="form-control"><b>Customer Type:</b></div>
						<div class="col-md-5">
						<select name="cust_type" id="cust_type" class="form-control">
						  <option>-----Please Choose----</option>
						  <option value="STAF">Staff</option>
						  <option value="VEND">Vendor/General Debtor</option>
						  <option value="SPON">Sponsor</option>
						  <option value="OTHR">Other</option>
						</select>
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-2">
						<button type="button" align="right" title="back"class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"> Cancel</i></button>
					</div>
					</div>
					<div id="invoice_add"></div>
				  </div>
				</div>
			  </div>
			</div>

<script>  
var status = $('#status').val();
if(status != 'ENTRY'){
    $('.edit_doc_btn').attr('disabled',true);
    $('.del_doc_btn').attr('disabled',true);
    $('.edit').attr('disabled',true);
    $('.add_doc_btn').attr('disabled',true);
    $('.edit2').attr('disabled',true);
$('.addDoc').attr('disabled',true);


}

$(document).ready(function() {
	
	$('#table_list').dataTable({"language": {"search": "Search Detail :"}} );
	
	// $( '#container .toggle-button' ).click( function () {
  //  $( '#container input[type="checkbox"]' ).prop('checked', this.checked)
  //});
  
	$('#select-all').click(function(event) {
		if(this.checked) {
			$(':checkbox').prop('checked', true);
		} else {
			$(':checkbox').prop('checked', false);
		}
	});  
		
} );


 $('.chk_val_btn').click(function () {
        var checkedValues = $('input:checkbox:checked').map(function() {return this.value; }).get();
		alert (checkedValues);
  });

 
 $('.detail_doc_btn').click(function () {
     var type_id = $(this).attr('type_id');
     var doc_id = $(this).attr('doc_id');
        if (type_id) {
            $('#myModalis .modal-content').empty();
            $('#myModalis').modal('show');
            $.post('<?php echo $this->lib->class_url('viewDetail') ?>', {type_id: type_id , doc_id: doc_id}, function (res) {
                $('#myModalis .modal-content').html(res);
            });
        }
    });
	
	 $('.edit').click(function () {
        var type_id = $('#typeT').val();
        if (type_id) {
            $('#myModalis2 .modal-content').empty();
            $('#myModalis2').modal('show');
            $.post('<?php echo $this->lib->class_url('edit') ?>', {type_id: type_id}, function (res) {
                $('#myModalis2 .modal-content').html(res);
            });
        }
    });
	
	$('.edit2').click(function(){
		$('#myEditModal').modal('show');
	});
	
	$('#cust_type').change(function(){
		var cust_type = $(this).val();
		 var type_id = $('#typeT').val();
		$('#invoice_add').html('<br><div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
		$.ajax({
			type:'POST',
			url:'<?php echo $this->lib->class_url('editCust')?>',
			data:{'cust_type':cust_type,'type_id':type_id},
			success:function(res){
				$('#invoice_add').html(res);
				dt_invoice = $('#tbl_add_invoice').DataTable({
					"ordering":false
				});
			}
		});
		
	});
 
// Delete Doc
    $('.del_doc_btn').click(function () {
        var doc_id = $(this).attr('doc_id');
		 var type_id = $(this).attr('type_id');
        if (doc_id) {
            $('#myModalis .modal-content').empty();
            $('#myModalis').modal('show');
            $.post('<?php echo $this->lib->class_url('delDetail') ?>', {type_id: type_id ,doc_id: doc_id}, function (res) {
                $('#myModalis .modal-content').html(res);
            });
        }
    });

	
//##########TAB1 START
 
    $('.tab1Filter1_chg').on('change', function () {
        var filter1 = $("select#tab1Filter1").val();
      	
        $.post('<?php echo $this->lib->class_url('filter') ?>', {tab1Filter1: filter1}, function (res) {
            $('#content').html(res);
            pageSetUp();
        });
    });
     
   

	$('.print').click(function(){
		var type_id = $('#typeT').val();
		
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('setParampdf') ?>',
			data: {'type_id' : type_id},
			success: function() {
				var repURL = '<?php echo $this->lib->class_url('summary_report') ?>';
				var mywin = window.open(repURL , 'report');
				}
		});
		 
		/* if(type_id){
			$('#reportModal').modal('show');
			$('#web_viewer').attr('data','<?php echo $this->lib->class_url('run_report')?>/'+type_id);
		} */
	});
	
	$('.print2').click(function(){
		var type_id = $('#typeT').val();
		
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('setParampdf2') ?>',
			data: {'type_id' : type_id},
			success: function() {
				var repURL = '<?php echo $this->lib->class_url('summary_report2') ?>';
				var mywin = window.open(repURL , 'report');
				}
		});
	});

   
	
	


 
</script>