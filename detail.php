<form class="form-horizontal" method="post">
<div class="modal-header btn-primary">
   <h4 class="modal-title" id="myModalLabel"><i class="fa fa-info"></i> View Invoice Detail</h4>
</div>
<div class="modal-body">
<div class="form-group">
<dt class="col-sm-4">Invoice No</dt>
<dd class="col-sm-8"><?php echo $P->CH_INVOICE_NO?></dd><br>

<dt class="col-sm-4">Customer Type</dt>
<dd class="col-sm-8"><?php echo $P->CH_CUST_TYPE?></dd><br>

<dt class="col-sm-4">Customer ID</dt>
<dd class="col-sm-8"><?php echo $P->CH_CUST_ID?></dd><br>

<dt class="col-sm-4">Invoice Description</dt>
<dd class="col-sm-8"><?php echo $P->CH_INVOICE_DESC?></dd><br>

<dt class="col-sm-4">Address</dt>
<dd class="col-sm-8"><?php if($P->CH_ADDRESS==NULL){echo '-'; }else{echo $P->CH_ADDRESS;}?></dd><br>

<dt class="col-sm-4">Entry Date</dt>
<dd class="col-sm-8"><?php echo $P->CH_INVOICE_DATE?></dd><br>

<dt class="col-sm-4">Entry By</dt>
<dd class="col-sm-8"><?php echo $P->CH_ENTER_BY?></dd><br>

<dt class="col-sm-4">Term</dt>
<dd class="col-sm-8"><?php if($P->CH_TERMS==NULL){echo '-'; }else{echo $P->CH_TERMS;}?></dd><br>

<dt class="col-sm-4">Account Code</dt>
<dd class="col-sm-8"><?php echo $P->CH_GLACCT_CODE?></dd><br>

<dt class="col-sm-4">Nett Amount (RM)</dt>
<dd class="col-sm-8"><?php echo $P->CH_NETT_AMT?></dd><br>

<dt class="col-sm-4">Status</dt>
<dd class="col-sm-8"><?php echo $P->CH_STATUS?></dd><br>

</div>
</div>
  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>