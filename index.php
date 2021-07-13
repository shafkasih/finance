<div id="app">
    <div class="row">
        <div class="col-xs-9 col-sm-12">
            <div class="jarviswidget jarviswidget-sortable jarviswidget-color-darken" role="widget">
                <header role="heading" class="ui-sortable-handle">
                    <h2>Invoice Entry</h2>
                </header>
                <div role="content">
                        <div id="myTabContent1" class="tab-content padding-10">
							<div class="row">
									<div class="col-sm-1"></div>
									<div class="col-sm-2 control-label" ><b>Customer Type: </b></div>
									<div class="col-sm-5"><?php echo form_dropdown('program',$program,$selected_program,'class="form-control" id="search_program"')?></div>
								    <div class="col-sm-4 "align="right"><button type="button" class="add btn btn-primary btn-sm"><i class="fa fa-plus"></i> New Invoice</button></div><br>
								</div>
							<hr>
							<table id="table_list" class="table table-bordered table-hover ">
								<thead>
									<th class="text-center">Invoice No</th>
									<th class="text-center">Enter By</th>
									<th class="text-center">Customer ID</th>
									<th class="text-center">Customer Name</th>
									<th class="text-center">Status</th>
									<th class="text-center">Action</th>
								</thead>
								<tbody>
								<?php
									foreach($programs as $P){
										//$ctc_no = $ctc_number($P->CTH_TYPE_CODE);
										echo '<tr>
										<td>'. $P->CH_INVOICE_NO .'</td>
										<td>'. $P->CH_ENTER_BY .'</td>
										<td>'. $P->CH_CUST_ID .'</td>
										<td>'. $P->CH_CUST_NAME .'</td>
										<td>'. $P->CH_STATUS .'</td>
										<td class="text-center"><div class="btn-group" >
										<a href="'.site_url('acctreceivable/Wrf001/viewall/'.$P->CH_INVOICE_NO). '"><button type="button" rel="tooltip"  title="Detail" type_id="' . $P->CH_INVOICE_NO . '" class="btn btn-success btn-sm btn"><i class="fa fa-info-circle fa-lg"></i> Detail</button></a>
									    </div></td>
									</tr>';
									}
								?>
								</tbody>
							</table>
					 </div>
                </div>
				</div>
            </div>
        </div>
    </div>
	<!-- Add Subject Modal -->
<div class="modal fade" id="myAddModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header btn-primary">
				<h5 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Add New Invoice</h5>
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
	
<!-- Student Detail Modal -->
<div class="modal fade" id="myDetailModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	 <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header btn-primary">
				<h4 class="modal-title" id="myModalLabel">View Invoice Role</h4>
			</div>					  
		 <div class="modal-body"></div>
		 <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		</div>
	</div>
</div>
							
<!-- ADD / EDIT / DELETE page will be displayed here -->
<div class="modal fade" id="myModalis" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<script>
$('#search_program').change(function(){
		var program = $(this).val();
		location = '<?php echo $this->lib->class_url('index')?>/'+program;
	});

	
$('.detail').click(function () {
        var type_id = $(this).attr('type_id');
        if (type_id) {
            $('#myModalis .modal-content').empty();
            $('#myModalis').modal('show');
            $.post('<?php echo $this->lib->class_url('detail') ?>', {type_id: type_id}, function (res) {
                $('#myModalis .modal-content').html(res);
            });
        }
    });
 $('.edit_type_btn').click(function () {
        var type_id = $(this).attr('type_id');
        if (type_id) {
            $('#myModalis .modal-content').empty();
            $('#myModalis').modal('show');
            $.post('<?php echo $this->lib->class_url('edit') ?>', {type_id: type_id}, function (res) {
                $('#myModalis .modal-content').html(res);
            });
        }
    });
  
	$('.add').click(function(){
		$('#myAddModal').modal('show');
	});
	var dt_invoice='';
	
	$('#cust_type').change(function(){
		var cust_type = $(this).val();
		$('#invoice_add').html('<br><div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
		$.ajax({
			type:'POST',
			url:'<?php echo $this->lib->class_url('add')?>',
			data:{'cust_type':cust_type},
			success:function(res){
				$('#invoice_add').html(res);
				dt_invoice = $('#tbl_add_invoice').DataTable({
					"ordering":false
				});
			}
		});
		
	});
	
	$('.btn_detail').click(function () {
        
        $.post('<?php echo $this->lib->class_url('viewall') ?>', function (res) {
        });
    });
$('#search_program').change(function(){
		var program = $(this).val();
		location = '<?php echo $this->lib->class_url('index')?>/'+program;
	});
$('#search_semintake').change(function(){
		var semintake = $(this).val();
		location = '<?php echo $this->lib->class_url('index')?>/'+semitake;
	});

	
$(document).ready(function() {
	$('#table_list').dataTable({"language": {"search": "Search Detail :"}} );
  });
  
  // Delete Doc
    $('.delete_type_btn').click(function () {
        var type_id = $(this).attr('type_id');
        if (type_id) {
            $('#myModalis .modal-content').empty();
            $('#myModalis').modal('show');
            $.post('<?php echo $this->lib->class_url('delDet') ?>', {type_id: type_id}, function (res) {
                $('#myModalis .modal-content').html(res);
            });
        }
    });
</script>


