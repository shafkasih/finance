<form class="form-horizontal" method="post">
<div class="modal-header bg-color-greenLight txt-color-white">
        <h5 class="modal-title" id="myModalLabel"><i class="fa fa-info-circle"></i>  	<b>Invoice Detail :</b> <?php echo $P->CD_INVOICE_NO ." (".$P->CD_SEQ_NO.")";?></h>
    </div>
<div class="modal-body">
<div class="form-group ">
<dt class="col-sm-2 text-right">1.</dt>
<dt class="col-sm-3 ">Company:</dt>
<dd class="col-sm-7 text-left"><?php echo $P->CD_COMPANY?> - <?php if($P->CD_COMPANY=="UPSI"){echo "Universiti Pendidikan Sultan Idris";}?></dd><br>

<dt class="col-sm-2 text-right">2.</dt>
<dt class="col-sm-3 ">Branch:</dt>
<dd class="col-sm-7"><?php echo $P->CD_BRANCH?> - <?php if($P->CD_BRANCH=="TM"){echo "Tanjong Malim";}else{echo  "Teluk Intan";}?> </dd><br>


<dt class="col-sm-2 text-right">3.</dt>
<dt class="col-sm-3 ">Sub Branch:</dt>
<dd class="col-sm-7"><?php echo $P->CD_SUB_BRANCH?> - <?php if($P->CD_SUB_BRANCH=="01"){echo "KSAS";}else if($P->CD_SUB_BRANCH=="02"){echo  "KSAJS";}else{echo "KCTI";}?> </dd><br>

<dt class="col-sm-2 text-right">4.</dt>
<dt class="col-sm-3 ">Fund:</dt>
<dd class="col-sm-7"><?php echo $P->CD_FUND?></dd><br>

<dt class="col-sm-2 text-right">5.</dt>
<dt class="col-sm-3 ">Cost Center:</dt>
<dd class="col-sm-7"><?php echo $P->CD_COST_CENTER?></dd><br>

<dt class="col-sm-2 text-right">6.</dt>
<dt class="col-sm-3">VOT:</dt>
<dd class="col-sm-7"><?php echo $P->CD_VOT?></dd><br>

<dt class="col-sm-2 text-right">7.</dt>
<dt class="col-sm-3 ">Account Code:</dt>
<dd class="col-sm-7"><?php echo $P->CD_ACCOUNT_CODE?></dd><br>

<dt class="col-sm-2 text-right">8.</dt>
<dt class="col-sm-3">Project Code:</dt>
<dd class="col-sm-7"><?php echo $P->CD_PROJECT_CODE?></dd><br>

<dt class="col-sm-2 text-right">9.</dt>
<dt class="col-sm-3">Description:</dt>
<dd class="col-sm-7"><?php echo $P->CD_DETAIL_DESC?></dd><br>

<dt class="col-sm-2 text-right">10.</dt>
<dt class="col-sm-3 ">Quantity:</dt>
<dd class="col-sm-7"><?php echo $P->CD_QTY?></dd><br>

<dt class="col-sm-2 text-right">11.</dt>
<dt class="col-sm-3 ">Unit Price: </dt>
<dd class="col-sm-7"><?php echo "RM ".number_format($P->CD_UNIT_PRICE,2)?></dd><br>

<dt class="col-sm-2 text-right">12.</dt>
<dt class="col-sm-3">Gross Amt:</dt>
<dd class="col-sm-7"><?php if($P->CD_GROSS_AMT==NULL){echo '-'; }else{echo "RM ".number_format($P->CD_GROSS_AMT,2);}?></dd><br>

<dt class="col-sm-2 text-right">13.</dt>
<dt class="col-sm-3">Total:</dt>
<dd class="col-sm-7"><?php echo "RM ".number_format($P->CD_TOTAL_AMT,2)?></dd><br>

<dt class="col-sm-2 text-right">14.</dt>
<dt class="col-sm-3 ">Status:</dt>
<dd class="col-sm-7"><?php echo $P->CD_STATUS?></dd><br>
</div>

</div>
  <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal"><i class="fa fa-remove sm"> </i> Close</button>
    </div>
</form>