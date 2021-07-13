<?php
/** 
  * @version 1.0
  * @include index(), detail(), edit(), viewall(),viewDetail(),editDetail(),edit(),add(),
  * editCust(),editCust2(),add2(),staff(),vend(),spon(),detailCust(),saveInvoice(),saveInvoice2(),
  * updateType(),updateTypeCust(),delDet(),updateType2(), delDetail(), deletedetail(), addDoc(),subranch(),
  * FUNDPC(),getCCTR(),getPCS(),PC(),Description(),saveDoc(), run_report()
  * @author Siti Nabilah Huda binti Razak
  * @required Wrf001.php
*/
defined('BASEPATH') OR exit('No direct script access allowed');

/*--------------------------------------------------------------
  @Load Wrf001_model for connection data in DB 
  @Location (MODULES/ACCTRECEIVABLE/MODELS/WRF001_MODEL)
  --------------------------------------------------------------*/
	class Wrf001 extends MY_Controller {
	private $staff_id;
    function __construct() {
        parent::__construct();
        $this->load->model('Wrf001_model','fee');
		$this->staff_id = $this->lib->userid();
    }// Access connection
	
/*--------------------------------------------------------------
  @Run funtion index() for view main page
  @operation view all invoice using searching by type customer
  @Find funtion getInvs() to get data for view
  --------------------------------------------------------------*/
	public function index($program=null){
		$this->session->set_userdata('referer',current_url());
		$data['program'] = $this->dropdown($this->fee->getInv(),'CH_CUST_TYPE','CH_CUST_TYPE','---Please Select---',true);
		$data['selected_program'] = $program;
		$data['programs'] = $this->fee->getInvs($program);
		$this->render($data);
	}//index()
	
/*--------------------------------------------------------------
  @Run funtion detail() for view detail.php 
  @operation view all detail of invoice searching by type customer
  @Find funtion getInvoice() to get Invoice searching by type customer
  --------------------------------------------------------------*/
	public function detail(){
		$type_id = $this->input->post('type_id',true);
		$data['P'] = $this->fee->getInvoice($type_id);
		$this->render($data);
	}//detail()

/*--------------------------------------------------------------
  @Run funtion viewall() for view viewall.php 
  @operation view detail of header invoice using ID invoice
  @Find funtion getInvoiceHead() - view detail of header invoice
				getInvoiceDetail() - view detail of detail invoice
  --------------------------------------------------------------*/
	public function viewall($type_id){
		$data['inEnc'] = $this->lib->encrypt($type_id);
		$data['P'] = $this->fee->getInvoiceHead($type_id);
		//$data['P'] = $this->fee->getInvoiceHead($type_id);
		$data['doc_rec'] = $this->fee->getInvoiceDetail($type_id);
		$this->render($data);
	}// viewall()
	
/*--------------------------------------------------------------
  @Run funtion viewDetail() for view viewDetail.php 
  @operation view detail of detail invoice using ID invoice
  @Find funtion getInvoiceDetail3() - view detail of header invoice
				getInvoiceDetail2() - view detail of detail invoice
  --------------------------------------------------------------*/	
	public function viewDetail(){
		$type_id = $this->input->post('type_id',true);
		$doc_id = $this->input->post('doc_id',true);
		$data['P'] = $this->fee->getInvoiceDetail3($type_id,$doc_id);
		$data['doc_rec2'] = $this->fee->getInvoiceDetail2($type_id,$doc_id);
		$this->render($data);
	}//viewDetail()
	
/*--------------------------------------------------------------
  @Run funtion editDetail() for view editDetail.php 
  @operation edit detail of detail invoice using ID invoice and sequnceNo
  --------------------------------------------------------------*/	
	public function editDetail($id,$seq){
		$type_id = $id;
		$doc_id = $seq;
		$data['C'] = $this->dropdown($this->fee->getCompony(),'CM_CMPY_CODE','CM_CMPY_CODE','--Please Select--');
		$data['B'] = $this->dropdown($this->fee->getBranch(),'BS_BRANCH_CODE','BS_BRANCH_DESC','--Please Select--');
		$branch = $this->input->post('branch',true);
		$data['SB'] = $this->dropdown($this->fee->getSubBranch3(), 'SS_SUBBRANCH_CODE', 'SS_SUBBRANCH_DESC', ' ---Please select--- ');
		$data['F'] = $this->dropdown($this->fee->getFund(),'AT_TYPE_CODE','AT_TYPE_DESC','--Please Select--');
		$data['AC'] = $this->dropdown($this->fee->getAC(),'AM_ACCT_CODE','AM_ACCT_DESC','--Please Select--');
		$data['PC'] = $this->dropdown($this->fee->getPC2(), 'PM_PROJECT_CODE', 'PM_PROJECT_DESC', ' ---Please select--- ');
		$data['V'] = $this->dropdown($this->fee->getDasar(),'VM_VOTYPE_ID','VM_VOTYPE_DESC','--Please Select--');
		$data['CCTR'] = $this->dropdown($this->fee->getCCTR2(),'CM_COSTCTR_CODE','CM_COSTCTR_DESC','--Please Select--');
		$data['detail'] = $this->fee->getInvoiceDetail3($type_id,$doc_id);
		$det=$this->fee->getInvoiceDetail3($type_id,$doc_id);
		$data['costcenterDes']=$this->fee->getcctrDes($det->CD_COST_CENTER);
		if($det->CD_PROJECT_CODE=='-' || $det->CD_PROJECT_CODE==null){
				$data['projectcodeDes']='-';
		}else{
			$data['projectcodeDes']=$this->fee->getPCDesc2($det->CD_PROJECT_CODE);
		
		}
		$data['detail_all'] = $this->fee->getInvoiceDetail4($type_id,$doc_id);
		$data['head'] = $this->fee->getInvoiceHead2($type_id);
		$data['doc_rec2'] = $this->fee->getInvoiceDetail2($type_id,$doc_id);
		$this->render($data);
	}//editDetail()
	
/*--------------------------------------------------------------
  @Run funtion edit() for view edit.php 
  @operation edit detail of header invoice using ID invoice
  --------------------------------------------------------------*/	
		public function edit(){
		$type_id = $this->input->post('type_id',true);
		$data['P'] = $this->dropdown($this->fee->getRole(),'INVOICE_TYPE_DECS','INVOICE_TYPE_DECS','--Please Select--');
		$data['A'] = $this->dropdown($this->fee->getAccCode(),'AM_ACCT_CODE','AM_ACCT_DESC','--Please Select--');
		$data['doctype_rec'] = $this->fee->getInvoice($type_id);
		$this->render($data);
	}//edit()
	
/*--------------------------------------------------------------
  @Run funtion add() for view add.php 
  @operation add detail of header invoice using type customer
  --------------------------------------------------------------*/	
	public function add(){
		$data['P'] = $this->dropdown($this->fee->getRole(),'INVOICE_TYPE_DECS','INVOICE_TYPE_DECS','--Please Select--');
		$data['A'] = $this->dropdown($this->fee->getAccCode(),'AM_ACCT_CODE','AM_ACCT_DESC','--Please Select--');
		$cust_type = $this->input->post('cust_type',true);
		$data['p']=$this->input->post('cust_type',true);
		if($cust_type=='STAF'){
			$data['i'] =$this->dropdown($this->fee->getStaff(),'SM_STAFF_ID','SM_STAFF_NAME','--Search--');
		}else if($cust_type=='VEND'){
			$data['i'] = $this->dropdown($this->fee->getVendor(),'VM_VENDOR_CODE','VM_VENDOR_NAME','--Search--');
		}else if($cust_type=='SPON'){
			$data['i'] = $this->dropdown($this->fee->getSponsor(),'SM_SPONSOR_ID','SM_SPONSOR_NAME','--Search--');
		}
		else{
			$data['i'] = $this->dropdown($this->fee->getOther(),'VM_VENDOR_CODE','VM_VENDOR_NAME','--Search--');
		}
		$this->renderAjax($data);
	}//add()
	
/*--------------------------------------------------------------
  @Run funtion editCust() for view editCust.php 
  @operation edit type of customer
  --------------------------------------------------------------*/		
	public function editCust(){
		$cust_type = $this->input->post('cust_type',true);
		$type_id = $this->input->post('type_id',true);
		$data['p']=$this->input->post('cust_type',true);
		$data['id']=$this->input->post('type_id',true);
		$data['doctype_rec'] = $this->fee->getInvoice($type_id);
		if($cust_type=='STAF'){
			$data['i'] =$this->dropdown($this->fee->getStaff(),'SM_STAFF_ID','SM_STAFF_NAME','--Search--');
		}else if($cust_type=='VEND'){
			$data['i'] = $this->dropdown($this->fee->getVendor(),'VM_VENDOR_CODE','VM_VENDOR_NAME','--Search--');
		}else if($cust_type=='SPON'){
			
			$data['i'] = $this->dropdown($this->fee->getSponsor(),'SM_SPONSOR_ID','SM_SPONSOR_NAME','--Search--');
		}
		else{
			$data['i'] = $this->dropdown($this->fee->getOther(),'VM_VENDOR_CODE','VM_VENDOR_NAME','--Search--');
		}
		$this->renderAjax($data);
	}//editCust()
	
/*--------------------------------------------------------------
  @Run funtion editCust2() for view editCust2.php 
  @operation edit type of customer others
  --------------------------------------------------------------*/	
	public function editCust2(){
		$cust_type = $this->input->post('cust_type',true);
		$type_id = $this->input->post('type_id',true);
		$data['p']=$this->input->post('cust_type',true);
		$data['id']=$this->input->post('type_id',true);
		$data['doctype_rec'] = $this->fee->getInvoice($type_id);
		$this->renderAjax($data);
	}//editCust2()
	
/*--------------------------------------------------------------
  @Run funtion add2() for view add2.php 
  @operation add type of customer others
  --------------------------------------------------------------*/	
	public function add2(){
		$data['p']=$this->input->post('cust_type',true);
		$data['P'] = $this->dropdown($this->fee->getRole(),'INVOICE_TYPE_DECS','INVOICE_TYPE_DECS','--Please Select--');
		$data['A'] = $this->dropdown($this->fee->getAccCode(),'AM_ACCT_CODE','AM_ACCT_DESC','--Please Select--');
		$this->renderAjax($data);
	}//add2()

/*--------------------------------------------------------------
  @Run funtion staff() 
  @operation search detail of staff 
  --------------------------------------------------------------*/	
	public function staff(){
		$this->isAjax();
		
		// get parameter values
		$sid = $this->input->post('ID',true);	
		
		// get available records
		$staff= $this->fee->getStaff2($sid);
		$staff2= $this->fee->getStaff3($sid);
		       
        if (!empty($staff)&& !empty($staff2)) {
			$name = $staff->SM_STAFF_NAME;
			$id = $staff->SM_STAFF_ID;
			$alamat = $staff2->PT_ADDRESS;
            $json = array('sts' => 1, 'name' => $name,'alamat' => $alamat,'id' => $id);
        } else if(empty($staff)&&empty($staff2)){
			$json = array('sts' => 2, 'msg' => 'Please select customer properlty', 'alert' => 'danger');
		}else {
			$name = $staff->SM_STAFF_NAME;
			$id = $staff->SM_STAFF_ID;
			$alamat = 'Please insert Address';
			
           $json = array('sts' => 0, 'name' => $name,'alamat' => $alamat,'id' => $id);
        }
		
		echo json_encode($json);
    }//staff()
	
/*--------------------------------------------------------------
  @Run funtion vend() 
  @operation search detail of vender 
  --------------------------------------------------------------*/	
		public function vend(){
		$this->isAjax();
		
		// get parameter values
		$sid = $this->input->post('ID',true);	
		
		// get available records
		$vend= $this->fee->getVend2($sid);
		$vend2= $this->fee->getVend3($sid);
		       
        if (!empty($vend)&& !empty($vend2)) {
			$name = $vend->VM_VENDOR_NAME;
			$id = $vend->VM_VENDOR_CODE;
			$alamat = $vend2->PT_ADDRESS;
            $json = array('sts' => 1, 'name' => $name,'alamat' => $alamat,'id' => $id);
        } else if(empty($vend)&&empty($vend)){
			$json = array('sts' => 2, 'msg' => 'Please select customer properlty', 'alert' => 'danger');
		} else {
			$name = $vend->VM_VENDOR_NAME;
			$id = $vend->VM_VENDOR_CODE;
			$alamat = 'Please insert Address';
			$json = array('sts' => 0, 'name' => $name,'alamat' => $alamat,'id' => $id);
        }
		
		echo json_encode($json);
    }//vend()
	
	/*--------------------------------------------------------------
  @Run funtion other() 
  @operation search detail of other 
  --------------------------------------------------------------*/	
		public function othr(){
		$this->isAjax();
		
		// get parameter values
		$sid = $this->input->post('ID',true);	
		
		// get available records
		$vend= $this->fee->getVend2($sid);
		$vend2= $this->fee->getVend3($sid);
		       
        if (!empty($vend)&& !empty($vend2)) {
			$name = $vend->VM_VENDOR_NAME;
			$id = $vend->VM_VENDOR_CODE;
			$alamat = $vend2->PT_ADDRESS;
            $json = array('sts' => 1, 'name' => $name,'alamat' => $alamat,'id' => $id);
        } else if(empty($vend)&&empty($vend)){
			$json = array('sts' => 2, 'msg' => 'Please select customer properlty', 'alert' => 'danger');
		} else {
			$name = $vend->VM_VENDOR_NAME;
			$id = $vend->VM_VENDOR_CODE;
			$alamat = 'Please insert Address';
			$json = array('sts' => 0, 'name' => $name,'alamat' => $alamat,'id' => $id);
        }
		
		echo json_encode($json);
    }//vend()
	
	
/*--------------------------------------------------------------
  @Run funtion spon() 
  @operation search detail of sponsor 
  --------------------------------------------------------------*/	
	public function spon(){
		$this->isAjax();
		
		// get parameter values
		$sid = $this->input->post('ID',true);	
		
		// get available records
		$spon= $this->fee->getSpon2($sid);
		$spon2= $this->fee->getSpon3($sid);
		       
        if (!empty($spon) && !empty($spon2) ) {
			$name = $spon-> SM_SPONSOR_NAME;
			$id = $spon-> SM_SPONSOR_ID;
			$alamat = $spon2->PT_ADDRESS;
            $json = array('sts' => 1, 'name' => $name,'alamat' => $alamat,'id' => $id);
        }else if(empty($spon)&&empty($spon)){
			$json = array('sts' => 2, 'msg' => 'Please select customer properlty', 'alert' => 'danger');
		} else {
			$name = $spon-> SM_SPONSOR_NAME;
			$id = $spon-> SM_SPONSOR_ID;
			$alamat = 'Please insert Address';
           $json = array('sts' => 0, 'name' => $name,'alamat' => $alamat,'id' => $id);
		   
        }
		
		echo json_encode($json);
    }//spon()
	
/*--------------------------------------------------------------
  @Run funtion detailCust() 
  @operation get Detail customer using keyup
  --------------------------------------------------------------*/	
	public function detailCust(){
		$this->isAjax();
		
		// get parameter values
		$sid = $this->input->post('ID',true);	
		$typeID = $this->input->post('typeID',true);	
		
		// get available records
		$DetailCust= $this->fee->getDetailCust($sid,$typeID);
	
        if (!empty($DetailCust->PT_TYPE_CODE) ) {
			$name = $DetailCust->PT_TYPE_NAME;
			$alamat = $DetailCust->PT_ADDRESS;
            $json = array('sts' => 1, 'name' => $name,'alamat' => $alamat);
        } else {
			$json = array('sts' => 0, 'msg' => 'Please enter Customer ID Propertly', 'alert' => 'danger');
		   
        }
		
		echo json_encode($json);
    }//detailCust()
	
/*--------------------------------------------------------------
  @Run funtion saveInvoice() 
  @operation save invoice staff,vendor, spon
  --------------------------------------------------------------*/	
	public function saveInvoice() {
		$this->isAjax();
		
    	// get parameter values
        $form = $this->input->post('form',true);
        $CH_YOUR_REF = $this->input->post('CH_YOUR_REF',true);
        $CH_OUR_REF = $this->input->post('CH_OUR_REF',true);

		// form / input validation
		$rule = array(
		'CustomerID' => 'required',
		'Address' => 'required',
		'InvType' => 'required',
		'AcoountCode' => 'required');
		$exclRule = null;
		//parmID=BLYYMM
		
		list($status, $err) = $this->validation('form', $form, $exclRule, $rule);
		if ($status == 1) {	
		$parmID = 'BL' . substr($form['CH_INVOICE_DATE'],8,2). substr($form['CH_INVOICE_DATE'],3,2);
		$seqNo = $this->fee->getNextSeq($parmID);
			
			$recCounter = $this->fee->getInvoiceNo($seqNo);	
			//print_r($seqNo);
			//print_r($recCounter);
			//exit();
			if (empty($recCounter)) {
				if (!empty($seqNo)) {
					
					/* 	$getGST_Tax=$this->fee->AM_GST_TAXCODE($form['AcoountCode']);
						$totl_GST_Tax=0;
						if($getGST_Tax!=0){
							$totl_GST_Tax=$this->fee->totl_GST_Tax($getGST_Tax);
						}else{
							$getGST_Tax=null;
						} */
						
						
						
						
						$insert = $this->fee->addInvoice($form,$seqNo,$CH_OUR_REF,$CH_YOUR_REF);
						
						if ($insert > 0) {
							$seqNo = $this->lib->encrypt($seqNo);
								$json = array('sts' =>1, 'msg' => $seqNo, 'alert' => 'success');
						} else {
								$json = array('sts' => 0, 'msg' => 'Record failed to be saved', 'alert' => 'danger');
						}
				} else {
					$json = array('sts' => 0, 'msg' => 'Customer Invoice Running No Not Setup (BLyymm). Please go to Setup Screen.', 'alert' => 'danger');
				}
				
			} else {
						$json = array('sts' => 0, 'msg' => 'Record failed to be saved. Record already exists', 'alert' => 'danger');
					}
					
			} else {
					$json = array('sts' => 0, 'msg' => 'Field marked * is compulsory.', 'alert' => 'danger');
			}
				
				echo json_encode($json);
    }//saveInvoice()
	
/*--------------------------------------------------------------
  @Run funtion saveInvoice2() 
  @operation save invoice for other
  --------------------------------------------------------------*/		
	public function saveInvoice2() {
		$this->isAjax();
		
    	// get parameter values
        $form = $this->input->post('form',true);

		// form / input validation
		$rule = array(
		'CH_ADDRESS' => 'required',
		'CH_INVOICE_TYPE' => 'required',
		'CH_GLACCT_CODE' => 'required');
		$exclRule = null;
		//parmID=BLYYMM
		
		list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

		if ($status == 1) {	
		$parmID = 'BL' . substr($form['CH_INVOICE_DATE'],8,2). substr($form['CH_INVOICE_DATE'],3,2);
		$seqNo = $this->fee->getNextSeq($parmID);
		
		$recCounter = $this->fee->getInvoiceNo($seqNo);	
		
		if (empty($recCounter)) {
			if (!empty($seqNo)) {
					$insert = $this->fee->addInvoice($form, $seqNo);
					
					if ($insert > 0) {
							$json = array('sts' => 1, 'msg' => $seqNo, 'alert' => 'success');
					} else {
							$json = array('sts' => 0, 'msg' => 'Record failed to be saved', 'alert' => 'danger');
					}
			} else {
				$json = array('sts' => 0, 'msg' => 'Customer Invoice Running No Not Setup (BLyymm). Please go to Setup Screen.', 'alert' => 'danger');
			}
			
		} else {
					$json = array('sts' => 0, 'msg' => 'Record failed to be saved. Record already exists', 'alert' => 'danger');
				}
				
		} else {
				$json = array('sts' => 0, 'msg' => 'Field marked * is compulsory.', 'alert' => 'danger');
		}
			
			echo json_encode($json);
    }//saveInvoice2
	
	
/*--------------------------------------------------------------
  @Run funtion updateType() 
  @operation update invoice
  --------------------------------------------------------------*/	
	public function updateType() {
        // get parameter values
       $form = $this->input->post('form');
	   $CH_YOUR_REF = $this->input->post('CH_YOUR_REF',true);
       $CH_OUR_REF = $this->input->post('CH_OUR_REF',true);
	   
	   $check=$form['CH_ENTER_BY'];
       $type_id = $this->post('type_id');
       // set rule        
       $rule = array('type_id' => 'mandatory');
       
       $exclRule = array();
       
       list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        // Begin Update Record
   		if ($status == 1) {
			
			$recCounter = $this->fee->getInvoiceCheck($type_id,$check);
			
			if ($recCounter==1)
			{
				// $getGST_Tax=$this->fee->AM_GST_TAXCODE($form['CH_GLACCT_CODE']);
				// $totl_GST_Tax=0;
				// if($getGST_Tax!=0){
					// $totl_GST_Tax=$this->fee->totl_GST_Tax($getGST_Tax);
				// }else{
					// $getGST_Tax=null;
				// }
				
		
				/* ROUNDING PROCESS
				$lv_amountt= $this->fee->lv_amount($form['CH_TOTAL_AMT']);
				
				$totgst=0;
				if($form['CH_GOVT_TAX']!=0){
					
					$totgst=($lv_amountt*$form['CH_GOVT_TAX']) / 100;
				}
				$lv_amount=$lv_amountt+$totgst;
				$lv_amt_after =$this->fee->lv_amt_after($lv_amount);  
				$lv_rounding_amt = $lv_amt_after - $lv_amount;
						
				
				$update = $this->fee->updateInvoice($type_id,$form,$CH_YOUR_REF,$CH_OUR_REF,$lv_rounding_amt,$lv_amt_after,$lv_amount);
	        	 */
				 
				$lv_amountt= $form['CH_TOTAL_AMT'];
				
				$totgst=0;
				if($form['CH_GOVT_TAX']!=0){
					
					$totgst=($lv_amountt*$form['CH_GOVT_TAX']) / 100;
				}
				$lv_amount=$lv_amountt+$totgst;
				$lv_amt_after =$lv_amount;  
				$lv_rounding_amt = $lv_amt_after - $lv_amount;
						
				
				$update = $this->fee->updateInvoice($type_id,$form,$CH_YOUR_REF,$CH_OUR_REF,$lv_rounding_amt,$lv_amt_after,$lv_amount);
	        	
				if ($update > 0) {
					$json = array('sts'=>1,'msg'=>'Record successfully updated', 'alert' => 'success');
				} else {
					$json = array('sts' => 0, 'msg' => 'Record failed to be updated', 'alert' => 'danger');
				}
			}else{
				$json = array('sts' => 0, 'msg' => 'Sorry your cant update because you are not entry person.', 'alert' => 'danger');
			}
		}else{
			
			$json = array('sts' => 0, 'msg' => 'Field marked * is compulsory.', 'alert' => 'danger');
		}
			
        echo json_encode($json);
        
    }//updateType()

/*--------------------------------------------------------------
  @Run funtion updateTypeCust() 
  @operation update invoice
  --------------------------------------------------------------*/		
	public function updateTypeCust() {
        
        // get parameter values
       $form = $this->input->post('form');
	   $check=$form['CH_ENTER_BY'];
       $type_id = $this->post('type_id');
       // set rule        
       $rule = array('type_id' => 'mandatory');
       
       $exclRule = array();
       
       list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        // Begin Update Record
   		if ($status == 1) {
			
			$recCounter = $this->fee->getInvoiceCheck($type_id,$check);
			
			if ($recCounter==1)
			{
				$update = $this->fee->updateInvoiceCust($type_id, $form);
	        	
				if ($update > 0) {
					$json = array('sts'=>1,'msg'=>'Record successfully updated', 'alert' => 'success');
				} else {
					$json = array('sts' => 0, 'msg' => 'Record failed to be updated', 'alert' => 'danger');
				}
			}else{
				$json = array('sts' => 0, 'msg' => 'Sorry your cant update because you are not entry person.', 'alert' => 'danger');
			}
		}else{
			
			$json = array('sts' => 0, 'msg' => 'Field marked * is compulsory.', 'alert' => 'danger');
		}
			
        echo json_encode($json);
        
    }//updateTypeCust()
	
	
/*--------------------------------------------------------------
  @Run funtion delDet() 
  @operation delete invoice
  --------------------------------------------------------------*/	
	public function delDet() {
		$type_id = $this->post('type_id');
		if (!empty($type_id)) {
			$data['doc_rec'] = $this->fee->detlDoc($type_id);
			$this->renderAjax($data);
		} else {
			echo 'Invalid Request.';
		}
		}//delDet()
		
/*--------------------------------------------------------------
  @Run funtion deleteDet() 
  @operation delete invoice
  --------------------------------------------------------------*/	
	public function deleteDet() {
		$type_id = $this->post('type_id');
		$id = $this->post('id');
		$senderID = $this->staff_id;
			if (!empty($type_id)) {
				$recCounter = $this->fee->getInvoiceCheck2($type_id);
				if($recCounter==NULL)
				{
					
					if(($id)==($senderID)){
							$del = $this->fee->deleteHead($type_id);
							if ($del > 0) {
								$json = array('sts' => 1, 'msg' => 'Record successfully deleted', 'alert' => 'success');
							}
							else {
								$json = array('sts' => 0, 'msg' => 'Record failed to be deleted', 'alert' => 'danger');
							}
					}else{
						
						$json = array('sts' => 0, 'msg' => 'Record failed to be deleted, you are not Entry this invoice', 'alert' => 'danger');
					}
				}else{
					$json = array('sts' => 0, 'msg' => 'Invalid operation.Please delete details first before delete the invoice', 'alert' => 'danger');
				}
				
			}else{
				
				$json = array('sts' => 0, 'msg' => 'Invalid operation.Please contact Administator!', 'alert' => 'danger');
			}	
			 echo json_encode($json);
	}//deleteDet
		
		
/*--------------------------------------------------------------
  @Run funtion updateType2() 
  @operation update invoice detail
  --------------------------------------------------------------*/	
	public function updateType2() {  
        // get parameter values
       $form = $this->input->post('form');
	   //$check=$form['CH_ENTER_BY'];
       $type_id = $this->post('type_id');
	   $check = $this->post('enter');
	   $seq=$this->post('seq');
       // set rule        
       $rule = array('type_id' =>'mandatory','seq'=>'mandatory');
       
       $exclRule = array();
       
       list($status, $err) = $this->validation('form', $form, $exclRule, $rule);
 
        // Begin Update Record
   		if ($status == 1) {
		if($form['CD_PROJECT_CODE']=="0"){
			$PC="-";
		}else{
			$PC=$form['CD_PROJECT_CODE'];
		}
			
			//$recCounter ='1';
			//$recCounter = $this->fee->getInvoiceCheck($type_id,$check);
			
			if ($this->staff_id==$form['CH_ENTER_BY'])
			{
					//--- process Rounding
					/* $gst=0;
					$gst2=$form['CD_GST_TAXAMT']/100;
					if($form['CD_GST_TAXAMT']!=0){
						$gst= ($form['CD_GST_TAXAMT'] * $form['CD_GROSS_AMT'])/100;
					}	
					$totalGST=$form['CD_GROSS_AMT']+$gst;
					
					$TOTAL=$this->fee->lv_amount($totalGST);
					$Totalrounding=$this->fee->lv_amt_after($TOTAL);
	
					$rounding=$Totalrounding - $TOTAL;
				
				    $update2 = $this->fee->updateDetail($type_id,$form,$seq,$PC,$gst2,$gst,$Totalrounding,$rounding);
					*/
					
					$gst=0;
					$gst2=$form['CD_GST_TAXAMT']/100;
					if($form['CD_GST_TAXAMT']!=0){
						$gst= ($form['CD_GST_TAXAMT'] * $form['CD_GROSS_AMT'])/100;
					}	
					$totalGST=$form['CD_GROSS_AMT']+$gst;
					
					$TOTAL=$totalGST;
					$Totalrounding=$TOTAL;
	
					$rounding=$Totalrounding - $TOTAL;
				
				    $update2 = $this->fee->updateDetail($type_id,$form,$seq,$PC,$gst2,$gst,$Totalrounding,$rounding);
				
					
					
					//--- rounding Head
					/* $totalAllDetail=$this->fee->totalAllDetail($type_id);
					$lv_amount= $this->fee->lv_amount($totalAllDetail);
					$gst=$this->fee->getGSTAmt($type_id);
					$totgst=0;
					if($gst!=0){
						
						$totgst=($totalAllDetail*$gst) / 100;
					}
					$lv_amount=$lv_amount+$totgst;
					$lv_amt_after =$this->fee->lv_amt_after($lv_amount);  
					$lv_rounding_amt = $lv_amt_after - $lv_amount;
					
				    $update = $this->fee->updateInvoice2($type_id,$totalAllDetail,$lv_rounding_amt,$lv_amt_after);
	        	 */
				
					$totalAllDetail=$this->fee->totalAllDetail($type_id);
					$lv_amount= $this->fee->lv_amount($totalAllDetail);
					$gst=$this->fee->getGSTAmt($type_id);
					$totgst=0;
					if($gst!=0){
						
						$totgst=($totalAllDetail*$gst) / 100;
					}
					$lv_amount=$lv_amount+$totgst;
					$lv_amt_after =$lv_amount;  
					$lv_rounding_amt = $lv_amt_after - $lv_amount;
					
				    $update = $this->fee->updateInvoice2($type_id,$totalAllDetail,$lv_rounding_amt,$lv_amt_after);
	        	
				if(($update > 0)&&($update2 > 0)) {
					$json = array('sts'=>1,'msg'=>'Record successfully updated', 'alert' => 'success');
				} else {
					$json = array('sts'=> 0, 'msg' => 'Record successfully updated', 'alert' => 'danger');
				}
			}else{
				$json = array('sts' => 0, 'msg' => 'Sorry your cant update because you are not entry person.', 'alert' => 'danger');
			}
		}else{
			
			$json = array('sts' => 0, 'msg' => 'Field marked * is compulsory.', 'alert' => 'danger');
		}
			
        echo json_encode($json);
        
    }//updateType2()
	
/*--------------------------------------------------------------
  @Run funtion delDetail() 
  @operation view for delete invoice detail
  --------------------------------------------------------------*/	
	public function delDetail() {
		$type_id = $this->input->post('type_id',true);
		$doc_id = $this->input->post('doc_id',true);
		if (!empty($type_id) && !empty($doc_id)) {
			$data['head'] = $this->fee->getInvoiceHead2($type_id);
			$data['detail'] = $this->fee->getInvoiceDetail3($type_id,$doc_id);
			$data['detail_all'] = $this->fee->getInvoiceDetail4($type_id,$doc_id);
			$data['doc_rec2'] = $this->fee->getInvoiceDetail2($type_id,$doc_id);
			$this->renderAjax($data);
		} else {
			echo 'Invalid Request.';
		}
	}//delDetail()
	
/*--------------------------------------------------------------
  @Run funtion deletedetail() 
  @operation delete invoice detail
  --------------------------------------------------------------*/
	public function deletedetail() {
        
        // get parameter values
       $form = $this->input->post('form');
	   //$check=$form['CH_ENTER_BY'];
       $type_id = $this->post('type_id');
	   $check = $this->post('enter');
	   $seq=$this->post('seq');
       // set rule        
       $rule = array('type_id' =>'mandatory','seq'=>'mandatory');
       
       $exclRule = array();
       
       list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

        // Begin Update Record
   		if ($status == 1) {
			
			//$recCounter ='1';
			//$recCounter = $this->fee->getInvoiceCheck($type_id,$check);
			
			if ( strtoupper($this->staff_id) ==$form['CH_ENTER_BY'])
			{
				
				$del = $this->fee->deleteDetail($type_id,$seq);
				
				
				//----Process Rounding Head--
				/* $totalAllDetail=$this->fee->totalAllDetail($type_id);
				$lv_amount= $this->fee->lv_amount($totalAllDetail);
				$gst=$this->fee->getGSTAmt($type_id);
				$totgst=0;
				if($gst!=0){
					
					$totgst=($totalAllDetail*$gst) / 100;
				}
				$lv_amount=$lv_amount+$totgst;
				$lv_amt_after =$this->fee->lv_amt_after($lv_amount);  
				$lv_rounding_amt = $lv_amt_after - $lv_amount;
				
				$update = $this->fee->updateInvoice2($type_id,$totalAllDetail,$lv_rounding_amt,$lv_amt_after);
				 */
				
				$totalAllDetail=$this->fee->totalAllDetail($type_id);
				$lv_amount= $this->fee->lv_amount($totalAllDetail);
				$gst=$this->fee->getGSTAmt($type_id);
				$totgst=0;
				if($gst!=0){
					
					$totgst=($totalAllDetail*$gst) / 100;
				}
				$lv_amount=$lv_amount+$totgst;
				$lv_amt_after =$lv_amount;  
				$lv_rounding_amt = $lv_amt_after - $lv_amount;
				
				$update = $this->fee->updateInvoice2($type_id,$totalAllDetail,$lv_rounding_amt,$lv_amt_after);
				
	        	
				if(($update > 0)&&($del > 0)) {
					$json = array('sts'=>1,'msg'=>'Record successfully deleted', 'alert' => 'success');
				} else {
					$json = array('sts'=> 0, 'msg' => 'Record failed to be deleted', 'alert' => 'danger');
				}
			}else{
				$json = array('sts' => 0, 'msg' => 'Record failed to be deleted, you are not Entry this invoice', 'alert' => 'danger');
			}
		}else{
			
			$json = array('sts' => 0, 'msg' => 'Record failed to be deleted, you are not Entry this invoice', 'alert' => 'danger');
		}
			
        echo json_encode($json);
        
    }//deletedetail()
	
/*--------------------------------------------------------------
  @Run funtion addDoc() 
  @operation view detail for add
  --------------------------------------------------------------*/
    public function addDoc($id) {
		$type=$id;
		$data['C'] = $this->dropdown($this->fee->getCompony(),'CM_CMPY_CODE','CM_CMPY_CODE','--Please Select--');
		$data['B'] = $this->dropdown($this->fee->getBranch(),'BS_BRANCH_CODE','BS_BRANCH_DESC','--Please Select--');
		$data['VD']="00";
		$data['Com']="UPSI";
		$branch = $this->input->post('branch',true);
		$data['SB'] = $this->dropdown($this->fee->getSubBranch1($branch), 'SS_SUBBRANCH_CODE', 'SS_SUBBRANCH_DESC', ' ---Please select--- ');
		$data['F'] = $this->dropdown($this->fee->getFund(),'AT_TYPE_CODE','AT_TYPE_DESC','--Please Select--');
		$data['CCTR'] = $this->dropdown($this->fee->getCCTR2(),'CM_COSTCTR_CODE','CM_COSTCTR_DESC','--Please Select--');
		$CCTR = $this->input->post('CCTR',true);
		$data['PC'] = $this->dropdown($this->fee->getPC1($CCTR), 'PM_PROJECT_CODE', 'PM_PROJECT_DESC', ' ---Please select--- ');
		$data['AC'] = $this->dropdown($this->fee->getAC(),'AM_ACCT_CODE','AM_ACCT_DESC','--Please Select--');
		$data['V'] = $this->dropdown($this->fee->getDasar(),'VM_VOTYPE_ID','VM_VOTYPE_DESC','--Please Select--');
		$data['type'] =$id;
        $type= $data['type'] =$id;
		$data['head'] = $this->fee->getInvoiceHead2($type);
		$data['detail_all'] = $this->fee->getInvoiceDetail5($type);
		
        $this->render($data);
    }//addDoc()
	
/*--------------------------------------------------------------
  @Run funtion subranch() 
  @operation searching detail of subbranch
  --------------------------------------------------------------*/
    public function subranch(){
		$this->isAjax();
		
		// get parameter values
		$branch = $this->input->post('branch',true);	
		
		// get available records
		$SB = $this->fee->getSubBranch($branch);
		       
        if (!empty($SB)) {
            $success = 1;
        } else {
            $success = 0;
        }
		
		$json = array('sts' => $success, 'SB' => $SB);
		
		echo json_encode($json);
    }//subbranch()
	
/*--------------------------------------------------------------
  @Run funtion FUNDPC() 
  @operation searching detail of fund
  --------------------------------------------------------------*/
    public function FUNDPC(){
		$this->isAjax();
		
		// get parameter values
		$fundD = $this->input->post('fundD',true);	
		
		// get available records
		$F = $this->fee->getFundPC($fundD);
		       
        if (!empty($F)) {
			$F = $F->AT_PROJECT_FLAG;
            $json = array('sts' => 1, 'F' => $F);
        } else {
            $json = array('sts' => 0, 'F' => $F);
        }
		echo json_encode($json);
    }//FUNPC()
	
/*--------------------------------------------------------------
  @Run funtion getCCTR() and getPCS()
  @operation Control CCTR and PC
  --------------------------------------------------------------*/
    public function getCCTR(){
		$this->isAjax();
		$data['CCTR'] = $this->fee->getCCTR3();
		echo json_encode($data);
    }//getCCTR()
	 public function getPCS(){
		$this->isAjax();
		$data['PCS'] = 1;
		echo json_encode($data);
    }//getPCS()
	
/*--------------------------------------------------------------
  @Run funtion PC() 
  @operation view PROJECT CODE
  --------------------------------------------------------------*/
    public function PC(){
		$this->isAjax();
		
		// get parameter values
		$CCTR = $this->input->post('CCTR',true);	
		$fundD = $this->input->post('fundD',true);	
		$groupD = $this->input->post('groupD',true);	
		
		if($fundD=="Y"){
			$PC = $this->fee->getPC($CCTR,$groupD);      
			if (!empty($PC)) {
				$success = 1;
				$json = array('sts' => $success, 'PC' => $PC);
			} else {
				$success = 0;
				$json = array('sts' => $success, 'PC' => $PC);
			}
		}
		else{
			$success= 2;
			$PC= "-";
			$json = array('sts' => $success, 'PC' =>$PC);
		}
		
		echo json_encode($json);
    }//PC()
	
/*--------------------------------------------------------------
  @Run funtion Description() 
  @operation view project description
  --------------------------------------------------------------*/
	    public function Description(){
		$this->isAjax();
		
		// get parameter values
		$sid = $this->input->post('A',true);	
		
		// get available records
		$Description = $this->fee->getADesc($sid);
		       
        if (!empty($Description)) {
			$Description = $Description->AM_ACCT_DESC;
            $json = array('sts' => 1, 'Description' => $Description);
        } else {
			$Description = '';
            $json = array('sts' => 0, 'Description' => $Description);
        }
		
		echo json_encode($json);
    }//Description()
	
/*--------------------------------------------------------------
  @Run funtion Description() 
  @operation save detail
  --------------------------------------------------------------*/
	public function saveDoc() {
		$form = $this->input->post('form');
	
		$rule = array(
		'CD_COMPANY' => 'required',
		'CD_BRANCH' => 'required',
		'CD_SUB_BRANCH' => 'required',
		'CD_FUND' => 'required',
		'CCTR' => 'required',
		'AC' => 'required',
		'VOTE' => 'required',
		'CD_PROJECT_CODE' => 'required',
		'CD_DETAIL_DESC' => 'required', 
		'CD_QTY' => 'required',     
		'CD_UNIT_PRICE' => 'required',
		);
		
		$exclRule = array();
		list($status, $err) = $this->validation('form', $form, $exclRule, $rule);

			// Begin Update Record
			if ($status == 1) {
				$check = $form['CH_ENTER_BY'];
				if($check==$this->staff_id){
				$recCounter ='1';
				}else{
					$recCounter ='0';
				}
				if($recCounter==1)
				{
					$running_no =$this->fee->SEQNO($form['CD_INVOICE_NO']);
					if($running_no==NULL){
						$running_no2 = 1;
						}
						else{
						$running_no2=$running_no + 1;
					}
					
					//rounding
					
					$A=(string)$form['CCTR'];
					$B=(string)$form['AC'];
					$C=(string)$form['VOTE'];
					$D=(string)$form['CD_COMPANY'];
					$E=(string)$form['CD_BRANCH'];
					$F=(string)$form['CD_SUB_BRANCH'];
					$G=(string)$form['CD_FUND'];
					$H=(string)$form['CD_PROJECT_CODE'];
					
					if($H=='-'){
					$CD_GLACCT_CODE= $D . "-" . $E . "-" . $F . "-" . $G . "-" . $A . "-" . $C . "-" . $B;
					$this->db->set("cd_glacct_code_report",$CD_GLACCT_CODE,true);
					}else{
					$CD_GLACCT_CODE= $D . "-" . $E . "-" . $F . "-" . $G . "-" . $A . "-" . $H . "-" . $C . "-" . $B;
					$this->db->set("cd_glacct_code_report",$CD_GLACCT_CODE,true);
					}
					
					$this->db->set("cd_seq_no", $running_no2, false);
					
				
					
					//----ROUNDING PROCESS detail----
					/* 	$gst=0;
					$gst2=$form['CD_GST_TAXAMT']/100;
					if($form['CD_GST_TAXAMT']!=0){
						$gst= ($form['CD_GST_TAXAMT'] * $form['CD_GROSS_AMT'])/100;
					}	
					$totalGST=$form['CD_GROSS_AMT']+$gst;
					
					$TOTAL=$this->fee->lv_amount($totalGST);
					$Totalrounding=$this->fee->lv_amt_after($TOTAL);
	
					$rounding=$Totalrounding - $TOTAL;
					
					$insert = $this->fee->addDoc($form,$CD_GLACCT_CODE,$gst2,$gst,$Totalrounding,$rounding);
					 */
					 
					$gst=0;
					$gst2=$form['CD_GST_TAXAMT']/100;
					if($form['CD_GST_TAXAMT']!=0){
						$gst= ($form['CD_GST_TAXAMT'] * $form['CD_GROSS_AMT'])/100;
					}	
					$totalGST=$form['CD_GROSS_AMT']+$gst;
					
					$TOTAL=$totalGST;
					$Totalrounding=$TOTAL;
	
					$rounding=$Totalrounding - $TOTAL;
					
					$insert = $this->fee->addDoc($form,$CD_GLACCT_CODE,$gst2,$gst,$Totalrounding,$rounding);
					
					//--- rounding Head--
					/* 	$totalAllDetail=$this->fee->totalAllDetail($form['CD_INVOICE_NO']);
					$lv_amount= $this->fee->lv_amount($totalAllDetail);
					$gst=$this->fee->getGSTAmt($form['CD_INVOICE_NO']);
					$totgst=0;
					if($gst!=0){
						
						$totgst=($totalAllDetail*$gst) / 100;
					}
					$lv_amount=$lv_amount+$totgst;
					$lv_amt_after =$this->fee->lv_amt_after($lv_amount);  
					$lv_rounding_amt = $lv_amt_after - $totalAllDetail;
					
					$update = $this->fee->updateInvoice2($form['CD_INVOICE_NO'],$totalAllDetail,$lv_rounding_amt,$lv_amt_after);	
					 */
					
					$totalAllDetail=$this->fee->totalAllDetail($form['CD_INVOICE_NO']);
					$lv_amount= $this->fee->lv_amount($totalAllDetail);
					$gst=$this->fee->getGSTAmt($form['CD_INVOICE_NO']);
					$totgst=0;
					if($gst!=0){
						
						$totgst=($totalAllDetail*$gst) / 100;
					}
					$lv_amount=$lv_amount+$totgst;
					$lv_amt_after =$lv_amount;  
					$lv_rounding_amt = $lv_amt_after - $totalAllDetail;
					
					$update = $this->fee->updateInvoice2($form['CD_INVOICE_NO'],$totalAllDetail,$lv_rounding_amt,$lv_amt_after);	
					
					
					if (($insert > 0)&&($update > 0)) {
						$json = array('sts' => 1, 'msg' => 'Record successfully saved', 'alert' => 'success');
					} else {
						$json = array('sts' => 0, 'msg' => 'Record failed to be saved', 'alert' => 'danger');
					}
				}else{
				$json = array('sts' => 0, 'msg' => 'Sorry your cant add because you are not entry person.', 'alert' => 'danger');
				}
			}else{
				
				$json = array('sts' => 0, 'msg' => 'Field marked * is compulsory.', 'alert' => 'danger');
			}
				
			echo json_encode($json);
       
	}//saveDoc()

/*--------------------------------------------------------------
  @Run funtion Description() 
  @operation Print report cover letter
  --------------------------------------------------------------*/
	public function run_report($type_id){
		$this->load->library('jasperreport');
		$format="pdf";
		$param=array(
			'InvoiceNo'=>$type_id
		);
		$this->jasperreport->runReport('/Reports/Training/Nabilah/WRR019',$format,$param);
	}//run_report()

	//---------------------------verify processing ---------------------------------
	public function run_report2($type_id){
		$this->load->library('jasperreport');
		$format="pdf";
		$param=array(
			'InvoiceNo'=>$type_id
		);
		$this->jasperreport->runReport('/Reports/Training/Nabilah/WZR002',$format,$param);
	}
	//----------serching for Cost Center------------------
	public function cctrSearchResult(){
        // get parameter values
        $keyword = $this->input->post('sKey',true);
        
        // get available records
        $data['cctr'] = $this->fee->getSearchCctrList($keyword);
        
        $this->renderAjax($data);
    }
	//-----------Searching for Project Code---------------
	public function PCSearchResult(){
        // get parameter values
        $keyword = $this->input->post('PKey',true);
        $CCTR = $this->input->post('CCTR',true);	
		$groupD = $this->input->post('groupD',true);	
        // get available records
		$data['pc']= $this->fee->getSearchPcList($keyword,$CCTR,$groupD); 
        
        $this->renderAjax($data);
    }
	
	public function setParampdf() 
    {
		// clear filter for report ID
    	$type_id = $this->input->post('type_id');
    	  
		// set session value
        $this->session->set_userdata('type_id', $type_id);
        
    }
	public function summary_report()
    {
       $type_id = $this->session->userdata('type_id');
  
        $this->load->library('jasperreport');
		 $param=array(
                'InvoiceNo'=>$type_id
			);
	
		
	ini_set('max_execution_time',0);
	ini_set('memory_limit','2048M');
	$this->jasperreport->runReportMyFis('WZR002','pdf',$param,'WZR002');
        //$this->jasperreport->runReport("/Reports/MyFIS_Dev/WZR002", "pdf", $param);
        
    }
	
	
	public function setParampdf2() 
    {
		// clear filter for report ID
    	$type_id = $this->input->post('type_id');
    	  
		// set session value
        $this->session->set_userdata('type_id', $type_id);
        
    }
	public function summary_report2()
    {
       $type_id = $this->session->userdata('type_id');
  
        $this->load->library('jasperreport');
		 $param=array(
                'InvoiceNo'=>$type_id
			);
	
		
		ini_set('max_execution_time',0);
		ini_set('memory_limit','2048M');
	$this->jasperreport->runReportMyFis('WRR019','pdf',$param,'WRR019');
        //$this->jasperreport->runReport("/Reports/MyFIS_Dev/WRR019", "pdf", $param);
        
    }
}
//---------------------------------------------------------------
// @end of process
// @22/2/2019
//---------------------------------------------------------------
?>
