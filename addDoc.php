<script>
function sum() {
	var qty,unit,total,totaldetail,totalGST,tax,total_amt,percentTAX, total_net;
	qty= parseInt(document.addDoclist.CD_QTY.value);
	unit= parseFloat(document.addDoclist.CD_UNIT_PRICE.value);
	tax= parseFloat(document.addDoclist.CD_GST_TAXAMT.value);
	var count=parseFloat(document.addDoclist.count.value);
	var gst= parseFloat(document.addDoclist.gst.value);
	var rounding=parseFloat(document.addDoclist.rounding.value);
	total=qty * unit;
	percentTAX=(tax*total)/100;
	total_amt=percentTAX+total;
	totaldetail= total_amt + count;
	totalGST=(gst*totaldetail)/100
	total_net=(totaldetail + totalGST) - rounding;
	if(!isNaN(total_amt) && !isNaN(total_net)&& !isNaN(totaldetail)){
		document.addDoclist.CH_NETT_AMT.value=total_net;
		document.addDoclist.CD_GROSS_AMT.value=total;
		document.addDoclist.CH_TOTAL_AMT.value=totaldetail;
		document.addDoclist.CD_TOTAL_AMT.value=total_amt;
	}
	}
</script>
<section id="widget-grid" class="">
    <div class="jarviswidget  jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" role="widget">
        <header role="heading">
            <div class="jarviswidget-ctrls" role="menu">
                <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" data-placement="bottom"><i class="fa fa-expand "></i></a>
            </div>
            <h2><i class="fa fa-plus"></i>  Add New Detail</h2>				
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
							<form name="addDoclist" class="form-horizontal" method="post">
							<div class="modal-body">
								 <b>Note : </b> ( <b><font color="red">*</font></b> ) <b><font color="red">compulsory fields</font></b><br>&nbsp; <span id="note"></span>
								<div class="form-group">
									<label class="col-md-2 control-label">Invoice No: </label>
									<div class="col-md-10">
									   <input type="text" name="form[CD_INVOICE_NO]" id="doc_type" value="<?php echo $head->CH_INVOICE_NO ?>" class="form-control" placeholder=""  readonly> 
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Company: <b><font color="red">* </font></b> </label>
									<div class="col-md-10">
										<?php echo form_dropdown('form[CD_COMPANY]',$C,$Com,'class="form-control select2" id="C"')?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Branch: <b><font color="red">* </font></b> </label>
									<div class="col-md-4">
										<?php echo form_dropdown('form[CD_BRANCH]',$B,'','class="form-control select2" id="lsBranch"')?>
									</div>
									<label class="col-md-2 control-label">Sub Branch: <b><font color="red">* </font></b> </label>
									<div class="col-md-4">
										<?php echo form_dropdown('form[CD_SUB_BRANCH]', $SB, '', 'class="form-control width-50 select2" id="subBranch"') ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Fund: <b><font color="red">* </font></b> </label>
									<div class="col-md-4">
										<?php echo form_dropdown('form[CD_FUND]', $F, '', 'class="form-control select2" id="lsFUND"') ?>
									<input type="hidden" name="fund" id="fund" class="form-control" placeholder=""  readonly> 
									 </div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Cost Center: <b><font color="red">* </font></b> </label>
									<div class="col-md-4">
										<input type="text" name="form[CCTR]" class="form-control" id="lsCCTR"  placeholder="Cost Center" readonly>
									</div>
									<div class="col-md-5">
										<textarea rows="2" cols="100" class="form-control"id="cctrDes"  placeholder="Cost Center Description" style="text-transform:uppercase"  readonly></textarea>
									</div>
									<div class="col-md-1">
                                        <button type="button" class="btn btn-primary search_cctr_btn"><i class="fa fa-search"></i></button>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Project Code: <b><font color="red">* </font></b> </label>
									<div class="col-md-4">
										<input type="text" name="form[CD_PROJECT_CODE]" class="form-control"  placeholder="Project Code"id="PC" readonly>
									</div>
									<div class="col-md-5">
                                        <textarea rows="2" cols="100" class="form-control" id="PCDes"  placeholder="Project Code Description" style="text-transform:uppercase"   readonly></textarea>
									</div>
									<div class="col-md-1">
                                        <button type="button" class="btn btn-primary search_pc_btn"><i class="fa fa-search"></i></button>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">CR Account Code: <b><font color="red">* </font></b> </label>
									<div class="col-md-5">
										<?php echo form_dropdown('form[AC]', $AC, '', 'class="form-control select2" id="A"') ?>
									 </div>
									<label class="col-md-2 control-label">Vot. : <b><font color="red">* </font></b> </label>
									<div class="col-md-3">
										<?php echo form_dropdown('form[VOTE]', $V, $VD, 'class="form-control select2" id="V"') ?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-2 control-label">Description: <b><font color="red">* </font></b> </label>
									<div class="col-md-10">
									<textarea rows="2" cols="100" class="form-control" name="form[CD_DETAIL_DESC]" id="Description" placeholder="Description"></textarea>
									</div>
								</div>
									<input type="hidden" id="CH_NETT_AMT" name="form[CH_NETT_AMT]" class="form-control" readonly value="<?php echo $head->CH_NETT_AMT?>">
									<input type="hidden" id="CH_TOTAL_AMT" name="form[CH_TOTAL_AMT]" class="form-control" readonly value="<?php echo $head->CH_TOTAL_AMT?>">
									<input type="hidden" step="any" id="gst" class="form-control" readonly value="<?php if($head->CH_GOVT_TAX==NULL){echo "0";}else{ echo $head->CH_GOVT_TAX;}?>">
									<input type="hidden" step="any" id="rounding" class="form-control" readonly value="<?php if($head->CH_ROUNDING_AMT==NULL){echo "0";}else{ echo $head->CH_ROUNDING_AMT;}?>">
									<?php
									$count=0;
									foreach($detail_all as $P){
										$count=$count + $P->CD_TOTAL_AMT;	
									}?>
									<input type="hidden" name="form[CH_ENTER_BY]" id="form[CH_ENTER_BY]"class="form-control" readonly value="<?php echo $head->CH_ENTER_BY?>">
									<input type="hidden" id="count" step="any" class="form-control" id="count" value="<?php echo $count;?>">
								<hr>
								<div class="form-group" >
									<label class="col-md-3 control-label">Quantity:</label>
									<div class="col-md-3"><input type="number" step="any" id="CD_QTY" name="form[CD_QTY]"  class="form-control" onkeyup="sum()" value="0">
									</div><label class="col-md-2 control-label ">Unit Price: RM</label>
									<div class="col-md-3"><input type="number" step="any" id="CD_UNIT_PRICE" name="form[CD_UNIT_PRICE]" class="form-control" onkeyup="sum()" value="0">
									</div>
								</div>
								<div class="form-group" >
									<label class="col-md-3 control-label">Tax Amt (%):</label>
									<div class="col-md-3">
										<input type="number" id="CD_GST_TAXAMT" step="any" class="form-control" onkeyup="sum()"  name="form[CD_GST_TAXAMT]"value="0">
									</div><label class="col-md-2 control-label ">Total Amt: RM</label>
									<div class="col-md-3"><input type="text" step="any" id="CD_TOTAL_AMT" name="form[CD_TOTAL_AMT]"readonly class="form-control" value="0">
										<input type="hidden" step="any" id="CD_GROSS_AMT" name="form[CD_GROSS_AMT]"readonly class="form-control" value="0">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn btn-sm" title="Close" data-dismiss="modal" onclick="location.href = '<?php echo $this->lib->class_url("viewall/$head->CH_INVOICE_NO");?>';"> <i class="fa fa-arrow-left"></i>  Back</button>
								<button type="submit" class="btn btn-primary"> <i class="fa fa-save sm"> </i>   Save </button> 
							</div>
							</form>
						</div>
                        <!-- end myTabContent1 -->
                    </div>
                    <!-- end widget content -->
                            
                </div>
                <!-- end widget div -->

            </div>
        </div>
    </div>
<!-- SEARCH PAYTO page will be displayed here -->
<div class="modal fade" id="mySearchCCTRfModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header btn-primary">
                <h4 class="modal-title" id="myModalLabel">Search Cost Center Info</h4>
            </div>
            <div class="modal-body">
                <div id="alertSearch" class="text-primary">
                    <b>Note : </b> <b>Please enter a search keyword (Cost Center ID / Description)</b><br>&nbsp;
                </div>
                <div id="enterdisable-notify" style="display: none;">
                    <center><font color="red"><b>ALERT: Enter button are not allowed</b></font></center>
                </div>
                <div id="">
                    <div class="row">
                        <form class="form-horizontal" id="mySearchForm">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><b>Cost Center ID / Description</b></label>
                                <div class="col-md-7">
                                    <input type="text" name="" id="sKey" class="form-control" value="" placeholder="Cost Center ID / Description">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" name="button" class="btn btn-primary keyFilter"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>              
                </div>
                <div id="search_result_list"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-hand-o-left"></i> Close</button>
            </div>        
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- end SEARCH Cost Center DETAIL -->

<!-- SEARCH Project Code page will be displayed here -->
<div class="modal fade" id="mySearchPCModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header btn-primary">
                <h4 class="modal-title" id="myModalLabel">Search Project Code Info</h4>
            </div>
            <div class="modal-body">
                <div id="alertSearch2" class="text-primary">
                    <b>Note : </b> <b>Please enter a search keyword (Project Code ID / Description)</b><br>&nbsp;
                </div>
                <div id="enterdisable-notify2" style="display: none;">
                    <center><font color="red"><b>ALERT: Enter button are not allowed</b></font></center>
                </div>
                <div id="">
                    <div class="row">
                        <form class="form-horizontal" id="mySearchForm">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><b>Project Code ID / Description</b></label>
                                <div class="col-md-7">
                                    <input type="text" name="" id="PKey" class="form-control" value="" placeholder="Project Code ID / Description">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" name="button" class="btn btn-primary keyFilter2"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>              
                </div>
                <div id="search_result_list2"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-hand-o-left"></i> Close</button>
            </div>        
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>

$(document).ready(function(){		
	$('#A').select2({
        dropdownParent:$('#myTabContent1')
    });
	
	$('#V').select2({
        dropdownParent:$('#myTabContent1')
    });
	$('#lsFUND').select2({
        dropdownParent:$('#myTabContent1')
    });
	$('#C').select2({
        dropdownParent:$('#myTabContent1')
    });
	$('#lsBranch').select2({
        dropdownParent:$('#myTabContent1')
    });
	});
	
	$(document).ready(function(){	
		document.getElementById('sKey').addEventListener('keypress', function(event) {
			if (event.keyCode == 13) {
				event.preventDefault();
				$("#enterdisable-notify").show();
			}
		});
		
		document.getElementById('PKey').addEventListener('keypress', function(event) {
			if (event.keyCode == 13) {
				event.preventDefault();
				$("#enterdisable-notify2").show();
			}
		});
	});
	
	  // View Search Modal
    $('.search_cctr_btn').on('click', function () {
        $('#sKey').val('');
        $('#search_result_list').html('');
        $('#mySearchCCTRfModal').modal('show');
    });
	
	 // Search Result
    $('.keyFilter').on('click', function () {
        var search_key = $("#sKey").val();
        
        if (search_key) {
            $('#alertSearch').html('<b>Note : </b> <b>Please enter a search keyword (Cost Center ID / Description)</b><br>&nbsp;');
            $('#search_result_list').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
            $("#enterdisable-notify").hide();
            
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->lib->class_url('cctrSearchResult')?>',
                data: {'sKey' : search_key},
                success: function(res) {
                    $('#search_result_list').html(res);
                }
            });
        } else {
            msg.warning('Please enter a search keyword (Cost Center ID / Description)', '#alertSearch');
        }   
    });
	    // Select cctr
    $('#search_result_list').on('click','.select_cctr_btn', function() {
        var thisBtn = $(this);
        var sID     = thisBtn.parents('tr').data('cctr-id');
        var sdes    = thisBtn.parents('tr').data('cctr-des');

            $("#lsCCTR").val(sID);         
            $("#cctrDes").val(sdes);     
			
            $('#mySearchCCTRfModal').modal('hide');
            $('#sKey').val('');
            $('#search_result_list').html('');
               
    });
	
	  // View Search Modal
    $('.search_pc_btn').on('click', function () {
        $('#PKey').val('');
        $('#search_result_list2').html('');
        $('#mySearchPCModal').modal('show');
    });
	
	 // Search Result
    $('.keyFilter2').on('click', function () {
        var search_key = $("#PKey").val();
		var groupD =$('#lsFUND').val();
		var CCTR =$('#lsCCTR').val();
        
        if (search_key) {
            $('#alertSearch2').html('<b>Note : </b> <b>Please enter a search keyword (Project Code  ID / Description)</b><br>&nbsp;');
            $('#search_result_list2').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
            $("#enterdisable-notify").hide();
            
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->lib->class_url('PCSearchResult')?>',
                data: {'PKey' : search_key,'groupD':groupD,'CCTR':CCTR},
                success: function(res) {
                    $('#search_result_list2').html(res);
                }
            });
        } else {
            msg.warning('Please enter a search keyword (Project Code ID / Description)', '#alertSearch2');
        }   
    });
	
	    // Select PC
    $('#search_result_list2').on('click','.select_pc_btn', function() {
        var thisBtn = $(this);
        var sID     = thisBtn.parents('tr').data('pc-id');
        var sDes     = thisBtn.parents('tr').data('pc-des');

            $("#PC").val(sID);
            $("#PCDes").val(sDes);

                        
            $('#mySearchPCModal').modal('hide');
            $('#PKey').val('');
            $('#search_result_list2').html('');
               
    });
	
	$(document).ready(function(){	
		$('form').submit(function (e) { 
			e.preventDefault();
			var data = $('form').serialize();
			msg.wait('#alert');
			$.ajax({
				type: 'POST',
				url: '<?php echo $this->lib->class_url('saveDoc')?>',
				data: data,
				dataType: 'JSON',
				success: function(res) {
					msg.show(res.msg, res.alert, '#alert');
					
					if (res.sts == 1) {
						$.alert({title:'',content: res.msg, type: 'green',});
						setTimeout(function () {
							location = '<?php echo $this->lib->class_url("viewall/$head->CH_INVOICE_NO")?>';
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
		
	$(function() {		
		$('[data-toggle="tooltip"]').tooltip()		
	});
        
      	$('#lsBranch').change(function() {
		var branch = $(this).val();
		$('#faspinner').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
		$('#lsSubBranch').html('');
		
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('subranch')?>',
			data: {'branch' : branch},
			dataType: 'json',
			success: function(res) {
				$('#faspinner').html('');
				
				var resList = '<option value="" selected > --Please select-- </option>';
				//$('#lsStaffID').append(<option value="" selected > ---Please select--- </option>);
				
                if (res.sts == 1) {
                    for (var i in res.SB) {
						resList += '<option value="'+res.SB[i]['SS_SUBBRANCH_CODE']+'">'+res.SB[i]['SS_SUBBRANCH_DESC']+'</option>';
                        //$('#lsStaffID').append('<option value="' + res.staffList[i]['STAFF_ID'] + '">' + res.staffList[i]['STAFF_NAME'] + '</option>');
                    }
                } 
				
				$("#subBranch").html(resList);				
			}
		});
	});	
		//searching PC
	$('#lsFUND').change(function() {
			var fundD = $(this).val();
			$('#lsCCTR').val('');
			$('#cctrDes').val('');
			$("#PC").val('');
			$("#PCDes").val('');
			$('.search_pc_btn').attr('disabled',false);
			$.ajax({
				type: 'POST',
				url: '<?php echo $this->lib->class_url('FUNDPC')?>',
				data: {'fundD' : fundD},
				dataType: 'json',
				success: function(res) {
				//$('#lsCCTR').html(' ');
				if (res.sts == 1) {
						$('#fund').val(res.F);
						//$('#PC').val(res.F);
						
						if(res.F=="N"){
							$("#PC").val("-");
							$("#PCDes").val("-");
							$('.search_pc_btn').attr('disabled',true);
						}
					} else {
						$('#fund').val('');
					}
				}
			});
		});	
	
	$('#A').change(function() {
			var sID = $(this).val();
			
			$.ajax({
				type: 'POST',
				url: '<?php echo $this->lib->class_url('Description')?>',
				data: {'A' : sID},
				dataType: 'json',
				success: function(res) {
					if (res.sts == 1) {
						$('#Description').val(res.Description);
					} else {
						$('#Description').val('');
					}
				}
			});
		});	
             	 
	
             	 
</script>

 