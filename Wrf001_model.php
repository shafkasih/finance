<?php
/** 
  * @version 1.0
  * @author Siti Nabilah Huda binti Razak
  * @required Wrf001_model
*/
defined('BASEPATH') OR exit('No direct script access allowed');

/*--------------------------------------------------------------
  @Load Wrf001_model 
  --------------------------------------------------------------*/
class Wrf001_model extends CI_Model {

private $staff_id;
    public function __construct() {
        $this->load->database();
		$this->staff_id = $this->lib->userid();
    }

/*--------------------------------------------------------------
  @Funtion getInvs() for get invoice(first page)
  @operation collectin data index()
  --------------------------------------------------------------*/
	public function getInvs($program){
		$this->db->select('*');
		$this->db->from('cinvoice_head');
		$this->db->where('ch_cust_type !=','STUD');
		if(empty($program))
		{
			$this->db->where('ch_cust_type',$program);
			$this->db->where('ch_status','ENTRY');
		}
		
		else if(!empty($program)){
			//$this->db->order_by('CH_INVOICE_NO', 'DESC');
			$this->db->where('ch_cust_type',$program);
			$this->db->where('ch_status','ENTRY');
		}
		$this->db->order_by('ch_invoice_no', 'desc');
		//$this->db->limit(20);
		return $this->db->get()->result_case('UPPER');
	}//getInvs()

/*--------------------------------------------------------------
  @Funtion getInv() for get detail of data Invoice type customer
  @operation from detail() Wrf001.php
  --------------------------------------------------------------*/
	public function getInv() {
		
       $this->db->select('ch_cust_type');
	   $this->db->from('cinvoice_head');
	   $this->db->where('ch_cust_type !=','STUD');
	   $this->db->order_by('ch_cust_type asc');
	   return $this->db->get()->result_case('UPPER');
    }//getInv()

/*--------------------------------------------------------------
  @Funtion getInvoice() for data Invoice type customer
  @operation from detail() Wrf001.php
  --------------------------------------------------------------*/
	public function getInvoice($type_id) {
		
       $this->db->select('*');
	   $this->db->from('cinvoice_head');
	   $this->db->where('ch_invoice_no',$type_id);
	   return $this->db->get()->row_case('UPPER');
    }//getInvoice()

/*--------------------------------------------------------------
  @Funtion getInvoiceHead() for data Invoice header using parameter NO BL
  @operation from viewall() Wrf001.php
  --------------------------------------------------------------*/
	public function getInvoiceHead($type_id) {
		
       $this->db->select('*');
	   $this->db->from('cinvoice_head');
	   $this->db->where('ch_invoice_no',$type_id);
	   return $this->db->get()->row_case('UPPER');
    }//getInvoiceHead()
	
/*--------------------------------------------------------------
  @Funtion getInvoiceDetail() for data Invoice detail using parameter NO BL and Sequance No
  @operation from viewall() Wrf001.php
  --------------------------------------------------------------*/
	public function getInvoiceDetail($type_id) {
		
       $this->db->select('*');
	   $this->db->from('cinvoice_detl');
	   $this->db->where('cd_invoice_no',$type_id);
	  return $this->db->get()->result_case('UPPER');
    }//getInvoiceDetail()
	
	//----------------------get all detail bagi paparan edit---------------------------------
	//CODE LAMA
	public function getInvoiceDetail2($type_id,$doc_id) {
       $this->db->select('substr(cd_glacct_code,1,6) as cctr,substr(cd_glacct_code,15,2) as vot,substr(cd_glacct_code,8,6) as account_code',false);
	   $this->db->from('cinvoice_detl');
	   $this->db->where('cd_seq_no=',$doc_id );
	   $this->db->where('cd_invoice_no=',$type_id);
	   return $this->db->get()->row_case('UPPER');
    }
/*--------------------------------------------------------------
  @Funtion getInvoiceDetail3() for data Invoice detail using parameter NO BL and Sequance No
  @operation from viewall() Wrf001.php
  --------------------------------------------------------------*/
	public function getInvoiceDetail3($type_id,$doc_id) {
       $this->db->select('*');
	   $this->db->from('cinvoice_detl');
	   $this->db->where('cd_invoice_no',$type_id);
	   $this->db->where('cd_seq_no',$doc_id );
	   return $this->db->get()->row_case('UPPER');
    }//getInvoiceDetail3()
	
/*--------------------------------------------------------------
  @Funtion getInvoiceDetail4() for get CD_TOTAL_AMT Detail
  @operation from delDetail() Wrf001.php
  --------------------------------------------------------------*/
	public function getInvoiceDetail4($type_id,$doc_id) {
       $this->db->select('cd_total_amt');
	   $this->db->from('cinvoice_detl');
	   $this->db->where('cd_invoice_no =',$type_id);
	   $this->db->where('cd_seq_no!=',$doc_id );
	   return $this->db->get()->result_case('UPPER');
    }//getInvoiceDetail4()

/*--------------------------------------------------------------
  @Funtion getInvoiceDetail4() for get CD_TOTAL_AMT Detail
  @operation from addDoc() Wrf001.php
  --------------------------------------------------------------*/
	public function getInvoiceDetail5($type_id) {
       $this->db->select('cd_total_amt');
	   $this->db->from('cinvoice_detl');
	   $this->db->where('cd_invoice_no =',$type_id);
	   return $this->db->get()->result_case('UPPER');
    }//getInvoiceDetail5()
	
/*--------------------------------------------------------------
  @get cctr
 ---------------------------------------------------------------*/
	public function getCCTR() {
		
       $this->db->select('cm_costctr_code,cm_costctr_code||\'  -  \'||cm_costctr_desc as cm_costctr_desc');
	   $this->db->from('costctr_main');
	   return $this->db->get()->result_case('UPPER');
    }//getCCTR()
	
/*--------------------------------------------------------------
  @get project Code
 ---------------------------------------------------------------*/
	public function getProjectCode() {
		
       $this->db->select('am_acct_code,am_acct_code||\'  -  \'||am_acct_desc as am_acct_desc');
	   $this->db->from('account_main');
	   $this->db->where('am_acct_level','3');
	   return $this->db->get()->result_case('UPPER');
    }

/*--------------------------------------------------------------
  @get vot
 ---------------------------------------------------------------*/	
	public function getVot() {
		
       $this->db->select('vm_votype_id,vm_votype_id||\'  -  \'||vm_votype_desc as vm_votype_desc');
	   $this->db->from('votype_main');
	   return $this->db->get()->result_case('UPPER');
    }
	
/*--------------------------------------------------------------
  @get gst
 ---------------------------------------------------------------*/
	public function getGST() {
		
       $this->db->select('gtc_taxcode,gtc_taxcode||\'  -  \'||gtc_taxcode_desc as gtc_taxcode_desc');
	   $this->db->from('gst_tax_code');
	   $this->db->where('gtc_tax_type','OUTPUT');
	   return $this->db->get()->result_case('UPPER');
    }
	
/*--------------------------------------------------------------
  @get nett amt
 ---------------------------------------------------------------*/
	public function getInvoiceHead2($type_id) {
       $this->db->select('*');
	   $this->db->from('cinvoice_head');
	   $this->db->where('ch_invoice_no',$type_id);
	   return $this->db->get()->row_case('UPPER');
    }

/*--------------------------------------------------------------
  @get staff
 ---------------------------------------------------------------*/
	public function getStaff() {
		
       $this->db->select('sm_staff_id,sm_staff_id||\'  -  \'|| sm_staff_name as sm_staff_name');
	   $this->db->from('ims_hris.staff_main');
	   return $this->db->get()->result_case('UPPER');
    }

/*--------------------------------------------------------------
  @get vendor
 ---------------------------------------------------------------*/
	public function getVendor() {
		
       $this->db->select('vm_vendor_code,vm_vendor_code||\'  -  \'||vm_vendor_name as vm_vendor_name');
	   $this->db->from('vendor_main');
	   $this->db->where("vm_type_supplier = 'Y' or vm_type_contractor ='Y'");
	   //$this->db->('VM_TYPE_CONTRACTOR','Y');
	   $this->db->where('vm_vendor_status','ACTIVE');
	   return $this->db->get()->result_case('UPPER');
    }
/*--------------------------------------------------------------
  @get other
 ---------------------------------------------------------------*/
	public function getOther() {
		
       $this->db->select('vm_vendor_code,vm_vendor_code||\'  -  \'||vm_vendor_name as vm_vendor_name');
	   $this->db->from('vendor_main');
	   $this->db->where('vm_type_other','Y');
	   $this->db->where('vm_vendor_status','ACTIVE');
	   return $this->db->get()->result_case('UPPER');
    }
/*--------------------------------------------------------------
  @get spondor
 ---------------------------------------------------------------*/
	public function getSponsor() {
		
       $this->db->select('sm_sponsor_id,sm_sponsor_id||\'  -  \'||sm_sponsor_name as sm_sponsor_name');
	   $this->db->from('sponsor_main');
	    $this->db->where('sm_status','ACTIVE');
	   return $this->db->get()->result_case('UPPER');
    }
	
/*--------------------------------------------------------------
  @get role type
 ---------------------------------------------------------------*/
	public function getRole(){
		
       $this->db->select('invoice_type_decs');
	   $this->db->from('invoice_type_role');
	   $this->db->where('invoice_type_user','ACCOUNT');
	   $this->db->order_by('invoice_type_decs asc');
	   return $this->db->get()->result_case('UPPER');
    }


/*--------------------------------------------------------------
  @account detail
 ---------------------------------------------------------------*/
	public function getAccCode(){
		
       $query="select am_acct_code,  am_acct_code||' - '|| am_acct_desc as am_acct_desc
		from account_main
		where am_acct_code like '%A16%'
		or am_acct_code like '%A15%'
		and am_acct_level='3'";
		$del=$this->db->query($query);
		return $del->result_case('UPPER');
    }	
	
	
	public function totalAllDetail($id){
		
       $query="select sum(cd_total_amt) total
		from cinvoice_detl
		where  cd_invoice_no='$id'";
		$del=$this->db->query($query);
		return $del->row_case('UPPER')->TOTAL;
    }
	
	public function getGSTAmt($id){
		
       $query="select coalesce(ch_govt_tax,0) ch_govt_tax
		from cinvoice_head
		where  ch_invoice_no='$id'";
		$del=$this->db->query($query);
			   return $del->row_case('UPPER')->CH_GOVT_TAX;
    }
	
	public function AM_GST_TAXCODE($id){
		
       $query="select coalesce(am_gst_taxcode,0) am_gst_taxcode
		from account_main
		where  am_acct_code='$id'";
		$del=$this->db->query($query);
		return $del->row_case('UPPER')->AM_GST_TAXCODE;
    }	
	
	
	public function totl_GST_Tax($id){
		
       $query="select coalesce(gtc_tax_rate,0) gtc_tax_rate
		from gst_tax_code
		where  gtc_taxcode='$id'";
		$del=$this->db->query($query);
		return $del->row_case('UPPER')->GTC_TAX_RATE;
    }
	
	
	public function lv_amount($total){
		
       $query="select round('$total',2) as total ";
	   $del=$this->db->query($query);
	   return $del->row_case('UPPER')->TOTAL;
    }
	
	public function lv_amt_after($lv_amount){
		
       $query="select round_bnm('$lv_amount') as total ";
	   $del=$this->db->query($query);
	   return $del->row_case('UPPER')->TOTAL;
    }

/*--------------------------------------------------------------
  @get staff for  edit
 ---------------------------------------------------------------*/
	public function getStaff2($sID){
		$this->db->select('*');
		$this->db->from('ims_hris.staff_main');
		$this->db->where('sm_staff_id',$sID);
		//$this->db->limit(20);
		  return $this->db->get()->row_case('UPPER');
	}

	public function getStaff4(){
		$this->db->select('*');
		$this->db->from('ims_hris.staff_main');
		//$this->db->limit(20);
		  return $this->db->get()->result_case('UPPER');
	}
	public function getStaff3($sID){
		$this->db->select('*');
		$this->db->from('v_payto_type');
		$this->db->where('pt_type_code',$sID);
		//$this->db->limit(20);
	
			  return $this->db->get()->row_case('UPPER');

	}

/*--------------------------------------------------------------
  @get vendor for edit
 ---------------------------------------------------------------*/
	public function getVend2($sID){
		$this->db->select('*');
		$this->db->from('vendor_main');
		$this->db->where('vm_vendor_code',$sID);
		//$this->db->limit(20);
		return $this->db->get()->row_case('UPPER');
	}
	public function getVend3($sID){
		$this->db->select('*');
		$this->db->from('v_payto_type');
		$this->db->where('pt_type_code',$sID);
		//$this->db->limit(20);
		
		return $this->db->get()->row_case('UPPER');
		
	}
	public function getVend4(){
		$this->db->select('*');
		$this->db->from('vendor_main');
		//$this->db->limit(20);
		
		return $this->db->get()->result_case('UPPER');
		
	}

/*--------------------------------------------------------------
  @get sponsor for edit
 ---------------------------------------------------------------*/
	public function getSpon2($sID){
		$this->db->select('*');
		$this->db->from('sponsor_main');
		$this->db->where('sm_sponsor_id',$sID);
		//$this->db->limit(20);
		return $this->db->get()->row_case('UPPER');
	}
	public function getSpon3($sID){
		$this->db->select('*');
		$this->db->from('v_payto_type');
		$this->db->where('pt_type_code',$sID);
		//$this->db->limit(20);
		
		return $this->db->get()->row_case('UPPER');
		
	}
	
	public function getSpon4(){
		$this->db->select('*');
		$this->db->from('sponsor_main');
		//$this->db->limit(20);
		  return $this->db->get()->result_case('UPPER');
	}
/*--------------------------------------------------------------
  @get detail customer
 ---------------------------------------------------------------*/
	public function getDetailCust($sid,$typeID){
		$this->db->select('*');
		$this->db->from('v_payto_type');
		$this->db->where('pt_type_code',$sid);
		$this->db->where('pt_payto_type',$typeID);
			  return $this->db->get()->row_case('UPPER');
		
	}

/*--------------------------------------------------------------
  @operation for add invoice
 ---------------------------------------------------------------*/
	    public function addInvoice($form,$seqNo,$CH_OUR_REF,$CH_YOUR_REF) {
		$submissionDate = "now()";
        $data = array(
			"ch_invoice_no"=>$seqNo,
            "ch_cust_id" =>$form['CustomerID'],
            "ch_our_ref" =>$CH_OUR_REF,
            "ch_your_ref" =>$CH_YOUR_REF,
            "ch_cust_type" =>$form['CH_CUST_TYPE'],
			//"CH_INVOICE_DATE" =>$form['CH_INVOICE_DATE'],
			"ch_total_amt" =>$form['CH_TOTAL_AMT'],
			"ch_status" =>$form['CH_STATUS'],
			"ch_nett_amt" =>$form['CH_NETT_AMT'],
			"ch_bal_amt" =>$form['CH_NETT_AMT'],
			"ch_address" =>$form['Address'],
			"ch_cust_name" =>$form['CustomerName'],
			"ch_invoice_type" =>$form['InvType'],
			"ch_glacct_code" =>$form['AcoountCode'],
			"ch_invoice_desc" =>$form['InvoiceDescription'],
			"ch_terms" =>$form['Terms'],
			"ch_govt_tax" =>$form['GovtTax'],
			"ch_rounding_amt" =>$form['RoundingAMT'],
			"ch_paid_amt" =>"0",
            "ch_enter_by" => strtoupper($this->staff_id)
        );

			$this->db->set("ch_invoice_date", $submissionDate, false);
			$this->db->set("ch_enter_date", $submissionDate, false);
			$this->db->set("ch_trans_entry_date", $submissionDate, false);

        return $this->db->insert('cinvoice_head',$data);
    } 
	
/*--------------------------------------------------------------
  @generate BL No
 ---------------------------------------------------------------*/
    public function getNextSeq($parmID) {
		/* $seqNo = 0;
		$sql = oci_parse($this->db->conn_id, "begin :bindOutput1 := finance.getnumber(:bind1); end;");
		oci_bind_by_name($sql, ":bind1", $parmID, 10);	//IN
		oci_bind_by_name($sql, ":bindOutput1", $seqNo, 12);				//OUT
		oci_execute($sql, OCI_DEFAULT); 
		
		if (!empty($seqNo)) {
			return $seqNo;
		}
		
		return 0;	 */
		
		$query ="select finance_getnumber ('".$parmID."') AS seqNo ";
		$data =$this->db->query($query);
		return $data->row_case('UPPER')->SEQNO;
;
    }

/*--------------------------------------------------------------
  @get invoice
 ---------------------------------------------------------------*/
	    public function getInvoiceNo($seqNo) {
        $this->db->select('ch_invoice_no as ch_invoice_no');
        $this->db->from('cinvoice_head');
		$this->db->where('ch_invoice_no',$seqNo);
        $q = $this->db->get();
        return $q->row_case('UPPER');
		}
		
/*--------------------------------------------------------------
  @operation update header
 ---------------------------------------------------------------*/
	 public function updateInvoice($type_id,$form,$CH_YOUR_REF,$CH_OUR_REF,$lv_rounding_amt,$lv_amt_after,$lv_amount	) {
      $data=array(
        "ch_invoice_no"=>$form['CH_INVOICE_NO'],
		"ch_our_ref" =>$CH_OUR_REF,
        "ch_your_ref" =>$CH_YOUR_REF,
		"ch_cust_type"=>$form['CH_CUST_TYPE'],
		"ch_invoice_type"=>$form['CH_INVOICE_TYPE'],
		"ch_cust_id"=>$form['CH_CUST_ID'],
		"ch_cust_name"=>$form['CH_CUST_NAME'],
		"ch_glacct_code"=>$form['CH_GLACCT_CODE'],
		"ch_address"=>$form['CH_ADDRESS'],
		"ch_invoice_desc"=>$form['CH_INVOICE_DESC'],
		"ch_status"=>$form['CH_STATUS'],
		"ch_terms"=>$form['CH_TERMS'],
		"ch_govt_tax"=>$form['CH_GOVT_TAX'],
		"ch_total_gst"=>$form['CH_GOVT_TAX'],
		"ch_rounding_amt"=>$lv_rounding_amt,
		"ch_total_amt"=>$form['CH_TOTAL_AMT'],
		"ch_enter_by"=>$form['CH_ENTER_BY'],
		);
  
		$this->db->set("ch_nett_amt", $lv_amt_after, false);
		$this->db->set("ch_bal_amt", $lv_amt_after, false);
        $this->db->where("ch_invoice_no", $type_id);
        return $this->db->update("cinvoice_head",$data);
	} 

/*--------------------------------------------------------------
  @update invoice for change customer
 ---------------------------------------------------------------*/
	public function updateInvoiceCust($type_id,$form) {
      $data=array(
        "ch_invoice_no"=>$form['CH_INVOICE_NO'],
		"ch_cust_id"=>$form['CustomerID'],
		"ch_cust_type"=>$form['CH_CUST_TYPE'],
		"ch_cust_name"=>$form['CustomerName'],
		"ch_address"=>$form['Address'],
		);
        $this->db->where("ch_invoice_no", $type_id);
        return $this->db->update("cinvoice_head",$data);
	} 
	
/*--------------------------------------------------------------
  @get chect entry, delete, update
 ---------------------------------------------------------------*/
	public function getInvoiceCheck($type_id,$check) {
        $this->db->select('ch_invoice_no as ch_invoice_no');
        $this->db->from('cinvoice_head');
		$this->db->where('ch_invoice_no', $type_id);
		if($check == strtoupper($this->staff_id))
		{
			return 1;
		}else{
			return 0;
		}
	}
	 public function getInvoiceCheck4($type_id,$check) {
		$this->db->select('ch_enter_by');
        $this->db->from('cinvoice_head');
		$this->db->where('ch_invoice_no',$type_id);
		if($check== strtoupper($this->staff_id))
		{
			return 1;
		}else{
			return 0;
		}
		} 
/*--------------------------------------------------------------
  @show header detail
 ---------------------------------------------------------------*/
	public function detlDoc($type_id) {
		
	$this->db->select('*');
	$this->db->from('cinvoice_head');
	$this->db->where('ch_invoice_no',$type_id);
	    return $this->db->get()->row_case('UPPER');

    }
	
/*--------------------------------------------------------------
  @get chect entry, delete, update
 ---------------------------------------------------------------*/
	public function getInvoiceCheck2($type_id) {
    $this->db->select('cd_invoice_no');
    $this->db->from('cinvoice_detl');
	$this->db->where('cd_invoice_no',$type_id);
	return $this->db->get()->result_case('UPPER');
    } 

/*--------------------------------------------------------------
  @get chect entry, delete, update 
 ---------------------------------------------------------------*/
	public function getInvoiceCheck3($type_id) {
		$this->db->select('ch_enter_by');
        $this->db->from('cinvoice_head');
		$this->db->where('ch_invoice_no', $type_id);
		return $this->db->get()->result_case('UPPER');
	}

/*--------------------------------------------------------------
  @DELETE RECORD HEADER
 ---------------------------------------------------------------*/
     
    public function deleteHead($type_id) {
        $this->db->where('ch_invoice_no', $type_id);
		return $this->db->delete("cinvoice_head");
    }
	

/*--------------------------------------------------------------
  @UPDATE RECORD DETAIL
 ---------------------------------------------------------------*/
 
	public function updateDetail($type_id,$form,$seq,$PC,$gst2,$gst,$Totalrounding,$rounding) {
				
				$data=array(
				"cd_qty"=>$form['CD_QTY'],
				"cd_unit_price"=>$form['CD_UNIT_PRICE'],
				"cd_gst_taxamt"=>$gst2,
				"cd_gst_taxpct" =>$gst,
				"cd_total_amt" =>$Totalrounding,
				"cd_bal_amt"=>$Totalrounding,
				"cd_company"=>$form['CD_COMPANY'],
				"cd_branch"=>$form['CD_BRANCH'],
				"cd_sub_branch"=>$form['CD_SUB_BRANCH'],
				"cd_fund"=>$form['CD_FUND'],
				"cd_cost_center"=>$form['CCTR'],
				"cd_account_code"=>$form['AC'],
				"cd_vot"=>$form['VOTE'],
				"cd_project_code"=>$PC,
				"cd_rounding_amt"=>$rounding,
				"cd_detail_desc"=>$form['CD_DETAIL_DESC'],
				
				);
					$A=(string)$form['CCTR'];
					$B=(string)$form['AC'];
					$C=(string)$form['VOTE'];
					$D=(string)$form['CD_COMPANY'];
					$E=(string)$form['CD_BRANCH'];
					$F=(string)$form['CD_SUB_BRANCH'];
					$G=(string)$form['CD_FUND'];
					$H=(string)$PC;
					
					if($H=='-'){
					$CD_GLACCT_CODE= $D . "-" . $E . "-" . $F . "-" . $G . "-" . $A . "-" . $C . "-" . $B;
					$this->db->set("cd_glacct_code_report",$CD_GLACCT_CODE,true);
					}else{
					$CD_GLACCT_CODE= $D . "-" . $E . "-" . $F . "-" . $G . "-" . $A . "-" . $H . "-" . $C . "-" . $B;
					$this->db->set("cd_glacct_code_report",$CD_GLACCT_CODE,true);
					}
				
				
				$this->db->where("cd_invoice_no",$type_id);
				$this->db->where("cd_seq_no",$seq);
				
				return $this->db->update("cinvoice_detl",$data);

		} 
		
	/*--------------------------------------------------------------
  @update RECORD HEADER
 ---------------------------------------------------------------*/
	 public function updateInvoice2($type_id,$totalAllDetail,$lv_rounding_amt,$lv_amt_after) {
		
		$data=array(
		"ch_nett_amt"=>$lv_amt_after,
		"ch_bal_amt"=>$lv_amt_after,
		"ch_total_amt"=>$totalAllDetail,
		"ch_rounding_amt"=>$lv_rounding_amt
		);
		$this->db->where("ch_invoice_no",$type_id);
		
		return $this->db->update("cinvoice_head",$data);

		} 
		
/*--------------------------------------------------------------
  @DELETE RECORD detail
 ---------------------------------------------------------------*/
	public function deleteDetail($type_id,$seq) {
		$this->db->where("cd_invoice_no",$type_id);
		$this->db->where("cd_seq_no",$seq);
		return $this->db->delete("cinvoice_detl");
    }
	
/*--------------------------------------------------------------
  @get Company
 ---------------------------------------------------------------*/
	public function getCompony(){
		
       $this->db->select('cm_cmpy_code,cm_cmpy_code||\'  -  \'||cm_cmpy_desc as cm_cmpy_desc');
	   $this->db->from('company_main');
	   return $this->db->get()->result_case('UPPER');
    }
	
/*--------------------------------------------------------------
  @get branch
 ---------------------------------------------------------------*/
	public function getBranch(){
		
       $this->db->select('bs_branch_code,bs_branch_code||\'  -  \'||bs_branch_desc as bs_branch_desc');
	   $this->db->from('branch_setup');
	   return $this->db->get()->result_case('UPPER');
    }
	public function getBranch2(){
		
       $this->db->select('*');
	   $this->db->from('branch_setup');
	   return $this->db->get()->result_case('UPPER');
    }
	
/*--------------------------------------------------------------
  @get subranch
 ---------------------------------------------------------------*/
	public function getSubBranch($branch){
		
       $this->db->select('ss_subbranch_code,ss_subbranch_code||\'  -  \'||ss_subbranch_desc as ss_subbranch_desc');
	   $this->db->from('subbranch_setup');
	   $this->db->where('ss_branch_code',$branch);
	   return $this->db->get()->result_case('UPPER');
    }

/*--------------------------------------------------------------
  @get subranch detail
 ---------------------------------------------------------------*/	
	public function getSubBranch2($k){
		
       $this->db->select('*');
	   $this->db->from('subbranch_setup');
	   $this->db->where('ss_subbranch_code',$k);
	   return $this->db->get()->row_case('UPPER');
    }
	public function getSubBranch1($branch){
		
       $this->db->select('ss_subbranch_code,ss_subbranch_code||\'  -  \'||ss_subbranch_desc as ss_subbranch_desc');
	 $this->db->from('subbranch_setup');
	   $this->db->where('ss_branch_code',$branch);
	   return $this->db->get()->result_case('UPPER');
    }
	
	public function getSubBranch3(){
		
       $this->db->select('ss_subbranch_code,ss_subbranch_code||\'  -  \'||ss_subbranch_desc as ss_subbranch_desc');
	 $this->db->from('subbranch_setup');
	   return $this->db->get()->result_case('UPPER');
    }
	
/*--------------------------------------------------------------
  @get fund
 ---------------------------------------------------------------*/
	public function getFund(){
		
       $this->db->select('at_type_code,at_type_code||\'  -  \'||at_type_desc as at_type_desc');
	   $this->db->from('account_type');
	   return $this->db->get()->result_case('UPPER');
    }

/*--------------------------------------------------------------
  @get Fund for PC
 ---------------------------------------------------------------*/
	public function getFundPC($FUND){
		
       $this->db->select('at_project_flag');
	   $this->db->from('account_type');
	   $this->db->where('at_type_code',$FUND);
	  $query = $this->db->get();
	   if ($query->num_rows() > 0) {
                return $query->row_case('UPPER');
            }
			 return null;
    }
	
/*--------------------------------------------------------------
  @get account description
 ---------------------------------------------------------------*/
	public function getADesc($sid){
       $this->db->select('am_acct_desc');
	   $this->db->from('account_main');
	   $this->db->where('am_acct_code',$sid);
	   $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->row_case('UPPER');
            }
			 return null;
        
       
    }

/*--------------------------------------------------------------
  @get project code
 ---------------------------------------------------------------*/
	public function getPC($CCTR,$groupD){
		
       $this->db->select('pm_project_code,pm_project_code||\'  -  \'||pm_project_desc as pm_project_desc');
	   $this->db->from('project_main');
	   $this->db->where('pm_fund_code',$CCTR);
	   $this->db->where('pm_group_code',$groupD);
	   return $this->db->get()->result_case('UPPER');
    }	
	public function getPC1($CCTR){
		
       $this->db->select('pm_project_code,pm_project_code||\'  -  \'||pm_project_desc as pm_project_desc');
	   $this->db->from('project_main');
	   //$this->db->where("(substr(pm_fund_code,1,6)='$cctr')");
	   $this->db->where('pm_fund_code',$CCTR);
	   return $this->db->get()->result_case('UPPER');
    }
	public function getPC2(){
		
       $this->db->select('pm_project_code,pm_project_code||\'  -  \'||pm_project_desc as pm_project_desc');
	   $this->db->from('project_main');
	   return $this->db->get()->result_case('UPPER');
    }

/*--------------------------------------------------------------
  @get fund
 ---------------------------------------------------------------*/
	public function getCCTR2(){
		
       $this->db->select('cm_costctr_code,cm_costctr_code||\'  -  \'||cm_costctr_desc as cm_costctr_desc');
	   $this->db->from('costctr_main');
	   $this->db->order_by('cm_costctr_code asc');
	   return $this->db->get()->result_case('UPPER');
    }
	
	public function getCCTR3(){
		
       $this->db->select('*');
	   $this->db->from('costctr_main');
	   $this->db->order_by('cm_costctr_code asc');
	   return $this->db->get()->result_case('UPPER');
    }
	
/*--------------------------------------------------------------
  @get account code 
 ---------------------------------------------------------------*/
	public function getAC(){
		
       $this->db->select('am_acct_code,am_acct_code||\'  -  \'||am_acct_desc as am_acct_desc');
	   $this->db->from('account_main');
	   $this->db->where('am_acct_level','3');
	   
	   return $this->db->get()->result_case('UPPER');
    }

/*--------------------------------------------------------------
  @get vote
 ---------------------------------------------------------------*/
	public function getDasar(){
		
       $this->db->select('vm_votype_id,vm_votype_id||\'  -  \'||vm_votype_desc as vm_votype_desc');
	   $this->db->from('votype_main');
	   return $this->db->get()->result_case('UPPER');
    }
		
	
/*--------------------------------------------------------------
  @operation insert detail
 ---------------------------------------------------------------*/
	    public function addDoc($form,$CD_GLACCT_CODE,$gst2,$gst,$Totalrounding,$rounding) {
			
		
		
		
		
        $data = array(
			"cd_invoice_no"=>$form['CD_INVOICE_NO'],
            "cd_company" =>$form['CD_COMPANY'],
			//"CH_INVOICE_DATE" =>$form['CH_INVOICE_DATE'],
			"cd_branch" =>$form['CD_BRANCH'],
			"cd_sub_branch" =>$form['CD_SUB_BRANCH'],
			"cd_fund" =>$form['CD_FUND'],
			"cd_project_code" =>$form['CD_PROJECT_CODE'],
			"cd_detail_desc" =>$form['CD_DETAIL_DESC'],
			"cd_qty" =>$form['CD_QTY'],
			"cd_unit_price" =>$form['CD_UNIT_PRICE'],
			"cd_gst_taxamt" =>$gst2,
			"cd_gst_taxpct" =>$gst,
			"cd_gross_amt" =>$form['CD_GROSS_AMT'],
			"cd_total_amt" =>$Totalrounding,
			"cd_bal_amt" =>$Totalrounding,
			"cd_cost_center" =>$form['CCTR'],
			"cd_account_code" =>$form['AC'],
			"cd_vot" =>$form['VOTE'],
			"cd_rounding_amt"=>$rounding,
            "cd_status" =>"ENTRY"
        );
        return $this->db->insert('cinvoice_detl',$data);
    }

/*--------------------------------------------------------------
  @get maximum number for invoice detail
 ---------------------------------------------------------------*/
	public function SEQNO($type_id) {
	$this->db->select_max('cd_seq_no');
	$this->db->where('cd_invoice_no',$type_id);
	$result = $this->db->get('cinvoice_detl')->row_case('UPPER');  
	return $result->CD_SEQ_NO;
	}	
/*--------------------------------------------------------------
  @get serching fo cost center
 ---------------------------------------------------------------*/
	public function getSearchCctrList($keyword=null) {
		$andWhere = "";
        $this->db->select('cm_costctr_code, cm_costctr_desc');
        $this->db->from('costctr_main');
		if(!empty($keyword)) {
			$andWhere = "(cm_costctr_code like '" . strtoupper($keyword) . "%' OR upper(cm_costctr_desc) LIKE '" . strtoupper($keyword) . "%')";	
			$this->db->where($andWhere);
		}
		$this->db->order_by('cm_costctr_code desc');
        $q = $this->db->get();        
        return $q->result_case('UPPER');
    } 
	
/*--------------------------------------------------------------
  @get project code
 ---------------------------------------------------------------*/
	public function getSearchPcList($keyword=null,$CCTR,$groupD){
		$andWhere = "";
       $this->db->select('pm_project_code,pm_project_desc');
	   $this->db->from('project_main');
	   if(!empty($keyword)) {
			$andWhere = "(pm_project_code like '" . strtoupper($keyword) . "%' OR pm_project_desc LIKE '" . strtoupper($keyword) . "%')";	
			$this->db->where($andWhere);
		}
	   $this->db->where('pm_fund_code',$CCTR);
	   $this->db->where('pm_group_code',$groupD);
	   $this->db->order_by('pm_project_code desc');
	   return $this->db->get()->result_case('UPPER');
    }
	
/*---------------------------------------------------------------------------
get cctr code description
-----------------------------------------------------------------------------*/
	public function getcctrDes($sid){
       $this->db->select('cm_costctr_desc');
	   $this->db->from('costctr_main');
	   $this->db->where('cm_costctr_code',$sid);
	   return $this->db->get()->row_case('UPPER')->CM_COSTCTR_DESC;
    }
/*---------------------------------------------------------------------------
get project code description
-----------------------------------------------------------------------------*/
	public function getPCDesc2($sid){
       $this->db->select('pm_project_desc');
	   $this->db->from('project_main');
	   $this->db->where('pm_project_code',$sid);
	   return $this->db->get()->row_case('UPPER')->PM_PROJECT_DESC;
    }

}

//---------------------------------------------------------------
// @end of process
// @22/2/2019
//---------------------------------------------------------------
?>