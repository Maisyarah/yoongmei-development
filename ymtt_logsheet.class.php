<?php
include("mybasic_config.php");	/********** DB access **********/

class ymtt_logsheet{

	protected $query_out, $execute, $results, $query_out2, $execute2, $results2, $query_out3, $execute3, $results3, $query_out4, $execute4, $results4, $query_out_1, $execute_1, $results_1, $query_out2_1, $execute2_1, $results2_1, $query_out3_1, $execute3_1, $results3_1; /********** for query purpose only **********/

	protected $full_date,$date_shj,$date_shj2,$date_shj3,$date_shj4,$logsheet_yest, $logsheet_dayb4yest;/********** for date only **********/
	protected $logsheet_id, $logsheet_no, $logsheet_id_existence, $logsheet_refno, $logsheet_branch, $logsheet_lryno, $logsheet_driver_id, $logsheet_driver_icno, $logsheet_attendant_id, $logsheet_attendant_id2, $logsheet_approved_by, $logsheet_issued_by, $logsheet_advance, $logsheet_backdate;/********** for logsheet purpose only **********/
	
	protected $ls_item_id, $logsheeti_invoice_no, $logsheeti_do_no, $logsheeti_from, $logsheeti_to, $logsheeti_consignor, $logsheeti_consignee, $logsheeti_particulars, $logsheeti_noofpckgs, $logsheeti_weight, $logsheeti_freight, $logsheeti_remarks;/********** for logsheet item details only **********/
	protected $adm_id,$adm_dept,$adm_branch,$adm_permission, $insert_type; /********** for admin who 1 2review / delete only **********/
	protected $logsheet_existingno, $logsheet_currentno, $logsheet_newno, $logsheet_lastno, $logsheet_rotation;/********** for Logsheet No only **********/
	protected $logsheet_tripno, $logsheet_newtripno, $logsheet_lasttripno;/********** for Logsheet Trip No only **********/
	protected $logsheet_destination,$logsheet_origin,$logsheet_advance_cash; /********** for setting destination and advance in Logsheet only **********/
	protected $view_check_no, $view;


	
	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO RECORD NEW LOGSHEET ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_newlogsheet($logsheet_refno, $logsheet_branch, $logsheet_lryno, $logsheet_driver_id, $logsheet_driver_icno, $logsheet_attendant_id, $logsheet_attendant_id2, $logsheet_approved_by, $logsheet_issued_by, $logsheet_advance, $logsheeti_invoice_no, $logsheeti_do_id, $logsheeti_do_no, $logsheeti_from, $logsheeti_to, $logsheeti_consignor, $logsheeti_consignee, $logsheeti_particulars, $logsheeti_noofpckgs, $logsheeti_weight, $logsheeti_freight, $logsheeti_remarks, $date_shj, $full_date, $insert_type, $logsheet_backdate){

		return $this->logsheet_record($logsheet_refno, $logsheet_branch, $logsheet_lryno, $logsheet_driver_id, $logsheet_driver_icno, $logsheet_attendant_id, $logsheet_attendant_id2, $logsheet_approved_by, $logsheet_issued_by, $logsheet_advance, $logsheeti_invoice_no, $logsheeti_do_id, $logsheeti_do_no, $logsheeti_from, $logsheeti_to, $logsheeti_consignor, $logsheeti_consignee, $logsheeti_particulars, $logsheeti_noofpckgs, $logsheeti_weight, $logsheeti_freight, $logsheeti_remarks, $date_shj, $full_date, $insert_type, $logsheet_backdate);
		/***** changelogs (start) *****/
		/*
		--------------- [05-10-2012] (start) -----------------
		1) add lry_trptype for local + outstation trip on lorry selection
		--------------- [05-10-2012] (end) -------------------
		*/
		/***** changelogs (end) *****/
	}
	


	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT OF UPDATE LOGSHEET INFO ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_updatelogsheet($logsheet_pgnow,$logsheet_id,$logsheet_origin,$logsheet_dest_branch,$logsheet_dlvr_date,$logsheet_lry_id_ori,$logsheet_lry_id,$logsheet_drv_id,$logsheet_attn_id,$logsheet_adv,$logsheet_adv_vchr_id,$logsheet_remarks, $adm_id, $adm_name,$adm_dept, $adm_branch){
		return $this->logsheet_update($logsheet_pgnow,$logsheet_id,$logsheet_origin,$logsheet_dest_branch,$logsheet_dlvr_date,$logsheet_lry_id_ori,$logsheet_lry_id,$logsheet_drv_id,$logsheet_attn_id,$logsheet_adv,$logsheet_adv_vchr_id,$logsheet_remarks, $adm_id, $adm_name,$adm_dept, $adm_branch);
	}
	
	

	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT OF DELETE LOGSHEET INFO ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_deletelogsheet($adm_id, $logsheet_id, $adm_dept, $adm_branch, $adm_permission, $full_date){
		return $this->logsheet_delete($adm_id, $logsheet_id, $adm_dept, $adm_branch, $adm_permission, $full_date);
	}
	
	
	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT OF DELETE LOGSHEET INFO ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_dellogsheet_item($logsheet_id, $odr_id, $adm_id, $adm_dept, $adm_branch, $adm_permission){
		return $this->logsheet_delete_item($logsheet_id, $odr_id, $adm_id, $adm_dept, $adm_branch, $adm_permission);
	}
	
	
	
	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT OF DELETE LOGSHEET INFO ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_addlogsheet_item($logsheet_id, $odr_id, $adm_id, $adm_dept, $adm_branch, $adm_permission){
		return $this->logsheet_add_item($logsheet_id, $odr_id, $adm_id, $adm_dept, $adm_branch, $adm_permission);
	}
	
	
	
	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO PRINT LOGSHEET ONLY									   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_printlogsheet($adm_id, $logsheet_id, $logsheet_pg_brk, $logsheet_itm_brk_cntr, $logsheet_itm_brk_id, $adm_dept, $adm_branch, $adm_permission, $full_date){
		return $this->logsheet_print_skeleton($adm_id, $logsheet_id, $logsheet_pg_brk, $logsheet_itm_brk_cntr, $logsheet_itm_brk_id, $adm_dept, $adm_branch, $adm_permission, $full_date);
		//return $this->logsheet_print($adm_id, $logsheet_id, $adm_dept, $adm_branch, $adm_permission, $full_date);
		
		/** changelog 08092012 **/
		/*
			1) fix the page break prob
		*/
	}


	
	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO PRINT LOGSHEET ONLY									   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_printlogsheetfull($adm_id, $logsheet_id, $logsheet_pg_brk, $logsheet_itm_brk_cntr, $logsheet_itm_brk_id, $adm_dept, $adm_branch, $adm_permission, $full_date){
		return $this->logsheet_print_full($adm_id, $logsheet_id, $logsheet_pg_brk, $logsheet_itm_brk_cntr, $logsheet_itm_brk_id, $adm_dept, $adm_branch, $adm_permission, $full_date);
		//return $this->logsheet_print($adm_id, $logsheet_id, $adm_dept, $adm_branch, $adm_permission, $full_date);
		
		/** changelog 08092012 **/
		/*
			1) fix the page break prob
		*/
	}


	
	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO REVIEW LOGSHEET ONLY									   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_reviewlogsheet($logsheet_id, $logsheet_no, $adm_id, $adm_dept, $adm_branch, $adm_permission, $process, $option, $odr_id, $odr_no){
		return $this->logsheet_review($logsheet_id, $logsheet_no, $adm_id, $adm_dept, $adm_branch, $adm_permission, $process, $option, $odr_id, $odr_no);
	}



	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO REVIEW LOGSHEET ONLY									   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_reviewlogsheet_item($adm_id, $logsheet_id, $adm_dept, $adm_branch, $adm_permission, $full_date){
		return $this->logsheet_item_review($adm_id, $logsheet_id, $adm_dept, $adm_branch, $adm_permission, $full_date);
	}



	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO LISTING LOGSHEET ONLY									   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_listinglogsheet($adm_id, $adm_dept, $adm_branch, $adm_permission, $date_shj, $date_shj2, $date_shj3, $local_outstation, $pcash_status, $pcash_no, $lsht_id, $vcase, $view_type, $pgnow, $pg_log,$pg_name,$page_no,$order_type,$ordering,$filtering){
		return $this->logsheet_listing($adm_id, $adm_dept, $adm_branch, $adm_permission, $date_shj, $date_shj2, $date_shj3, $local_outstation, $pcash_status, $pcash_no, $lsht_id, $vcase, $view_type, $pgnow, $pg_log,$pg_name,$page_no,$order_type,$ordering,$filtering);
		
		/** changelog 08092012 **/
		/*
			1) add counter for no of itm 2hv pg break on lgsht printing.
		*/
		
		/** changelog 18092012 **/
		/*
			1) revert back the changes n add back the advance n tested it.
			2) remove the trip expenses div block
		*/
		/** changelog 30092012 **/
		/*
			1) add local trip listing filter
		*/
		/** changelog 24102014 **/
		/*
			1) add outsource lorry info input
		*/
		
	}



	
	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO LISTING LOGSHEET ONLY									   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_historylogsheet($adm_id, $adm_dept, $adm_branch, $adm_permission, $date_shj, $date_shj2, $date_shj3, $pcash_status, $pcash_no, $lsht_id, $vcase, $view_type, $pgnow, $pg_name,$page_no,$order_type,$ordering,$filtering){
		return $this->logsheet_history($adm_id, $adm_dept, $adm_branch, $adm_permission, $date_shj, $date_shj2, $date_shj3, $pcash_status, $pcash_no, $lsht_id, $vcase, $view_type, $pgnow, $pg_name,$page_no,$order_type,$ordering,$filtering);
		
		/** changelog 27122015 **/
		/*
			1) created a new ver to suits monthly & history only.
		*/

	}



	
	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO LISTING LOGSHEET ONLY									   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_viewlogsheet($adm_id, $adm_dept, $adm_branch, $adm_permission, $date_shj, $date_shj2,$display_date, $lry_id, $branch_filter, $view_type, $pgnow, $pg_name,$page_no,$order_type,$ordering,$filtering){
		return $this->logsheet_view($adm_id, $adm_dept, $adm_branch, $adm_permission, $date_shj, $date_shj2,$display_date, $lry_id, $branch_filter, $view_type, $pgnow, $pg_name,$page_no,$order_type,$ordering,$filtering);
	}


	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO PRINT LOGSHEET ONLY									   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_viewlogsheet_update($logsheet_total_2update,$logsheet_freight,$logsheet_tripcost,$logsheet_maintenance,$logsheet_profit,$adm_id,$adm_dept,$adm_branch,$adm_permission){
		return $this->logsheet_view_update($logsheet_total_2update,$logsheet_freight,$logsheet_tripcost,$logsheet_maintenance,$logsheet_profit,$adm_id,$adm_dept,$adm_branch,$adm_permission);
		/***** changelogs (start) *****/
		/*
		--------------- [05-10-2012] (start) -----------------
		1) add outstation on logsheet no generation
		2) add pay table info inside
		--------------- [05-10-2012] (end) -------------------
		*/
		/***** changelogs (end) *****/
	}
	
	
	
	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO LISTING LOGSHEET ONLY							     	   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_listinglogsheet_details($adm_id, $adm_dept, $adm_branch, $adm_permission, $ls_report_branch, $date_shj, $date_shj2, $date_shj3, $date_shj4, $full_date,$pg_name,$page_no,$order_type,$ordering,$filtering){
		return $this->logsheet_listing_details($adm_id, $adm_dept, $adm_branch, $adm_permission, $ls_report_branch, $date_shj, $date_shj2, $date_shj3, $date_shj4, $full_date,$pg_name,$page_no,$order_type,$ordering,$filtering);
	}
	
	
	
	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO GET CONSIGNORS INFO ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_infoconsignor($logsheeti_consignor, $adm_id, $adm_dept, $adm_permission, $full_date){
		return $this->consignor_info($logsheeti_consignor, $adm_id, $adm_dept, $adm_permission, $full_date);
	}



	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO GET CONSIGNEE INFO ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_infoconsignee($logsheeti_consignee, $adm_id, $adm_dept, $adm_permission, $full_date){
		return $this->consignee_info($logsheeti_consignee, $adm_id, $adm_dept, $adm_permission, $full_date);
	}
		

	
	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO GET DELIVERY ORDER NO ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_getlsno($adm_id,$adm_dept,$adm_branch,$adm_permission,$full_date){
		return $this->logsheet_no_get($adm_id,$adm_dept,$adm_branch,$adm_permission,$full_date);
	}


	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO SET DELIVERY ORDER NO ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_setlsno($adm_id,$dorder_no,$dorder_id,$adm_dept,$adm_branch,$adm_permission,$full_date){
		return $this->logsheet_no_set($adm_id,$dorder_no,$dorder_id,$adm_dept,$adm_branch,$adm_permission,$full_date);
	}



	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO SET DELIVERY ORDER NO ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_destinationlogsheet($adm_id,$adm_dept,$adm_permission,$logsheet_id,$logsheet_destination,$logsheet_origin,$logsheet_advance_cash,$logsheet_driver,$logsheet_attendant, $logsheet_drv_change, $nrmal, $extr1, $extr2, $extr3, $adv1, $adv2, $adv3, $ddct1, $ddct2, $ddct3, $teid, $update_me, $os_name, $os_regno, $os_lry_type, $full_date,$tomorrow_only){
		return $this->logsheet_destination($adm_id,$adm_dept,$adm_permission,$logsheet_id,$logsheet_destination,$logsheet_origin,$logsheet_advance_cash,$logsheet_driver,$logsheet_attendant, $logsheet_drv_change, $nrmal, $extr1, $extr2, $extr3, $adv1, $adv2, $adv3, $ddct1, $ddct2, $ddct3, $teid, $update_me, $os_name, $os_regno, $os_lry_type, $full_date,$tomorrow_only);
		/***** changelogs (start) *****/
		/*
		--------------- [05-10-2012] (start) -----------------
		1) add lry_trptype for local + outstation trip on lorry selection
		--------------- [05-10-2012] (end) -------------------
		*/
		/***** changelogs (end) *****/
	}



	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO SET DELIVERY ORDER NO ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_arrivallogsheet($adm_id,$adm_dept,$adm_permission,$logsheet_id, $arrival_code, $arrival_code_only, $arrival_branch, $ls_process_day){
		return $this->logsheet_arrival($adm_id,$adm_dept,$adm_permission,$logsheet_id, $arrival_code, $arrival_code_only, $arrival_branch, $ls_process_day);
		/***** changelogs (start) *****/
		/*
		--------------- [30-09-2012] (start) -----------------
		1) add arrival code, arrival_code_only, arrival branch & ls_process_day to reuse in local trips
		--------------- [30-09-2012] (end) -------------------
		*/
		/***** changelogs (end) *****/
	}



	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO LISTING ARRIVAL LOGSHEET ONLY							   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_listinglogsheet_arrival($adm_id,$adm_dept,$adm_permission,$logsheet_origin,$logsheet_destination,$date_shj,$date_shj2,$date_shj3,$full_date){
		return $this->logsheet_listing_arrival($adm_id,$adm_dept,$adm_permission,$logsheet_origin,$logsheet_destination,$date_shj,$date_shj2,$date_shj3,$full_date);
	}



	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO LISTING ARRIVAL LOGSHEET ONLY							   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_listinglogsheet_arrival_aio($adm_id,$adm_dept,$adm_permission,$logsheet_origin,$logsheet_destination,$date_shj,$date_shj2,$date_shj3,$process_day){
		return $this->logsheet_listing_arrival_aio($adm_id,$adm_dept,$adm_permission,$logsheet_origin,$logsheet_destination,$date_shj,$date_shj2,$date_shj3,$process_day);
		/***** changelogs (start) *****/
		/*
		--------------- [29-09-2012] (start) -----------------
		1) add attendant on the list
		2) extend update form 2whole logsheet
		3) add receive code
		4) damage code update
		--------------- [29-09-2012] (end) -------------------
		
		--------------- [17-10-2012] (start) -----------------
		1) remove trip expenses
		2) move the arrival code to bottom
		3) add hr
		--------------- [17-10-2012] (end) -------------------
		*/
		/***** changelogs (end) *****/
	}



	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO LISTING ARRIVAL LOGSHEET ONLY							   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_logsheet_lorry_available($adm_id,$adm_dept,$adm_permission,$logsheet_origin,$logsheet_destination,$date_shj,$date_shj2,$full_date){
		return $this->logsheet_lorry_available($adm_id,$adm_dept,$adm_permission,$logsheet_origin,$logsheet_destination,$date_shj,$date_shj2,$full_date);
	}

	
	
	
	
	
	
	
	
	
	
	
	
	/*
	|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
	| LOCAL TRIP PUBLIC FUNCTIONS ADDED ON 30092012	(START)					   																																					   |
	|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
	*/
	
	
	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO LISTING LOGSHEET ONLY									   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_listinglogsheet_local($adm_id, $adm_dept, $adm_branch, $adm_permission, $date_shj, $date_shj2,$date_shj3, $full_date,$day2view, $view_type, $pgnow){
		return $this->logsheet_local_listing($adm_id, $adm_dept, $adm_branch, $adm_permission, $date_shj, $date_shj2,$date_shj3, $full_date,$day2view, $view_type, $pgnow);
		
		/** changelog 06102012 **/
		/*
			1) change to view only local logsheet, other features remains
		*/
		
	}
	
	
	
	/*
	|--------------------------------------------------------------------------|
	| PUBLIC FNCT TO SET DELIVERY ORDER NO ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_destinationlogsheet_local($adm_id,$adm_dept,$adm_permission,$logsheet_id,$logsheet_origin,$logsheet_advance_cash,$logsheet_driver,$logsheet_attendant, $logsheet_drv_change, $nrmal, $extr1, $extr2, $extr3, $adv1, $adv2, $adv3, $ddct1, $ddct2, $ddct3, $teid, $update_me, $full_date,$tomorrow_only){
		return $this->logsheet_local_destination($adm_id,$adm_dept,$adm_permission,$logsheet_id,$logsheet_origin,$logsheet_advance_cash,$logsheet_driver,$logsheet_attendant, $logsheet_drv_change, $nrmal, $extr1, $extr2, $extr3, $adv1, $adv2, $adv3, $ddct1, $ddct2, $ddct3, $teid, $update_me, $full_date,$tomorrow_only);
		/***** changelogs (start) *****/
		/*
		--------------- [05-10-2012] (start) -----------------
		1) add lry_trptype for local + outstation trip on lorry selection
		--------------- [05-10-2012] (end) -------------------
		*/
		/***** changelogs (end) *****/
	}
	
	/*
	|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
	| LOCAL TRIP PUBLIC FUNCTIONS ADDED ON 30092012	(END)					   																																					   |
	|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
	*/


	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF DELETE LOGSHEET LORRY DRIVER ONLY					   |
	|--------------------------------------------------------------------------|
	*/
	public function logsheet_lorry_driver($adm_id, $logsheet_lryno, $adm_branch, $adm_permission, $full_date, $insert_type){
		global $db1;
		
		$this->query_out = $query_out;
		$this->execute = $execute;
		$this->results = $results;
		$this->view_driver = $view_driver;
		$this->view_driver = array();
				
		$this->adm_id = $adm_id;
		$this->logsheet_lryno = $logsheet_lryno;
		$this->adm_branch = $adm_branch;
		$this->adm_permission = $adm_permission;
		$this->full_date = $full_date;
		$this->insert_type = $insert_type;
		

		/********** get the lorry driver id from the lorry no which already recorded ymt_driver **********/
		//if($this->insert_type == "dorder"){
			$this->query_out = "select driver_id, driver_nric from ymt_driver where driver_lorry_no='$this->logsheet_lryno'";
		//}else{
		//	$this->query_out = "select driver_id, driver_nric from ymt_driver where driver_id='$this->logsheet_lryno'";
		//}
		
		//echo "1st-> $this->query_out";
		$this->execute = $db1->query($this->query_out);
		
		/**********  getting the logsheet result **********/
		if ($db1->num_rows($this->execute) == 0){
			$this->view_driver = array(1,123456);
		}else{

			$this->results = $db1->fetch_array($this->execute);
			$this->view_driver = array($this->results['driver_id'],$this->results['driver_nric']);		

		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

		return $this->view_driver;
	}
		
		
	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF CHECKING LOGSHEET NO ONLY							   |
	|--------------------------------------------------------------------------|
	*/
	public function logsheet_checkno($adm_id,$adm_dept,$logsheet_branch,$logsheet_dest_branch,$adm_permission,$deliverydate,$lry_id,$lry_trptype){
		/***** changelogs (start) *****/
		/*
		--------------- [11-12-2015] (start) -----------------
		1) overhaul ls no as too many bugs across daily & mth end ls no setup.
			a) chk if temp / real ls
			b) if temp, chk same yr & mth / nt, same yr different mth r addon
			c) set new no based on temp condition above
			d) 
		--------------- [11-12-2015] (end) -------------------
		*/
		/***** changelogs (end) *****/
		if($_SESSION['mychecking'] == 1 || $adm_id == 1){	
			//echo "<p style='color: purple; font-style:oblique;'>wir lght chk no: $adm_id,$adm_dept,$logsheet_branch,$logsheet_dest_branch,$adm_permission,$deliverydate,$lry_id,$lry_trptype</p>";	
		}
		global $db1, $php_date, $php_yr, $php_mth, $php_dy_only, $php_leap_yr, $php_date_start, $php_date_end, $php_date_tmrw, $php_date_1mth_b4, $php_date_1mth_ftr;
		
		$this->query_out110	= $query_out110;
		$this->execute110	= $execute110;
		$this->results110	= $results110;
		$this->query_out120 = $query_out120;
		$this->execute120	= $execute120;
		$this->results120	= $results120;
		$this->query_out130	= $query_out130;
		$this->execute130	= $execute130;
		$this->results130	= $results130;
		
		$this->adm_id			= $adm_id;
		$this->adm_dept			= $adm_dept;
		$this->adm_permission	= $adm_permission;
		
		$this->deliverydate			= $deliverydate;
		$this->deliverydate2		= explode("-",$deliverydate);
		
		$this->lry_id			= $lry_id;
		$this->lry_trptype		= $lry_trptype;
		
		if($this->lry_trptype == 0){
			$this->deliverydate3			= date("Y-m-d",mktime(0,0,0,date($this->deliverydate2[1]),date($this->deliverydate2[2])-1,date($this->deliverydate2[0])));//added for mth end calculation
			$this->deliverydate_startofmth	= date("Y-m-d",mktime(0,0,0,date($this->deliverydate2[1]),01,date($this->deliverydate2[0])));//added for mth end calculation
			$this->deliverydate_endofmth= date("Y-m-t",mktime(0,0,0,date($this->deliverydate2[1])-1,date($this->deliverydate2[2]),date($this->deliverydate2[0])));//added for mth end calculation
		}else{
			$this->deliverydate3			= date("Y-m-d",mktime(0,0,0,date($this->deliverydate2[1]),date($this->deliverydate2[2]),date($this->deliverydate2[0])));//added for mth end calculation
			$this->deliverydate_startofmth	= date("Y-m-d",mktime(0,0,0,date($this->deliverydate2[1]),01,date($this->deliverydate2[0])));//added for mth end calculation
			$this->deliverydate_endofmth	= date("Y-m-t",mktime(0,0,0,date($this->deliverydate2[1]),date($this->deliverydate2[2]),date($this->deliverydate2[0])));//added for mth end calculation
		}

		$this->deliverydate_endofmth2	= substr($this->deliverydate_endofmth,8);
		$this->deliverydate_endofmth3	= substr($this->deliverydate_endofmth,4,2);
		
		$this->logsheet_branch		= $logsheet_branch;
		$this->logsheet_dest_branch = $logsheet_dest_branch;
		$this->logsheet_existingno	= $logsheet_existingno;
		$this->logsheet_currentno	= $logsheet_currentno;
		$this->logsheet_newno		= $logsheet_newno;
		$this->logsheet_lastno		= $logsheet_lastno;
		$this->logsheet_tripno		= $logsheet_tripno;
		$this->logsheet_newtripno	= $logsheet_newtripno;
		$this->logsheet_lasttripno	= $logsheet_lasttripno;
		$this->view_check_no		= $view_check_no;
		$this->view_check_no		= array();
		
		/**** date purpose only (start) ****/
		$this->php_date			= $php_date;
		$this->php_yr			= $php_yr;
		$this->php_mth			= $php_mth;
		$this->php_dy_only		= $php_dy_only;
		$this->php_leap_yr		= $php_leap_yr;
		$this->php_date_start	= $php_date_start;
		$this->php_date_end		= $php_date_end;
		$this->php_date_tmrw	= $php_date_tmrw;
		$this->php_date_1mth_b4	= $php_date_1mth_b4;
		$this->php_date_1mth_ftr= $php_date_1mth_ftr;
		/**** date purpose only (end) ****/

		$this->php_mth_delivery = "";
		
		$this->ls_condition 	= "";
		$this->ls_new_yr_mth 	= "";
		$this->ls_new_yr_mth_yr	= "";
		$this->ls_new_yr_mth_no	= "";
		$this->ls_new_yr_mth_cut= "";
		$this->ls_new_yr_mth_cnt= 0;

		
		/********** Assign New Logsheet No from Nov 2015 upon req by Ms Lim JB (start) **********/
		while($this->ls_new_yr_mth_cut == ""){
		
//echo "<p>start & end of mth day only : $this->deliverydate_startofmth || ".substr($this->deliverydate_endofmth,8)."</p>";
			$this->query_out110 = "select * from ymt_logsheet where ls_branch='$this->logsheet_branch' and ls_delivery_yr = '".$this->deliverydate2[0]."' ";
			
			if($this->ls_new_yr_mth == "mth" ){
			
				$this->query_out110 .= " and ls_delivery_mth = '".$this->deliverydate2[1]."' ";
				
				if( ($this->deliverydate2[2] > 01 || $this->deliverydate2[2] > 1) && $this->deliverydate_startofmth == $this->deliverydate){//for taking 1st day out 
					$this->query_out110 .= " and ls_issued_date > '".$this->deliverydate2[0]."-".$this->deliverydate2[1]."-01' ";
				}
				
				if($this->deliverydate2[2] < 15 && ($this->deliverydate2[0]."-".$this->deliverydate2[1]."-01" <> $this->deliverydate)){//for long leave chking purpose 
					$this->query_out110 .= " and ls_issued_date between '".$this->deliverydate2[0]."-".$this->deliverydate2[1]."-01' and '".$this->deliverydate2[0]."-".$this->deliverydate2[1]."-15'";
				}
				
			}

			$this->query_out110 .=  " and ls_local = $this->lry_trptype ";
			
			if(!empty($this->logsheet_dest_branch)){	$this->query_out110 .= " and ls_destination_branch = '$this->logsheet_dest_branch' ";		}
			
			$this->query_out110 .= " order by ls_no desc limit 1";

			if($_SESSION['mychecking'] == 1 || $this->adm_id == 1){	
				//echo "<p style='color: purple; font-style:oblique;'>$this->ls_new_yr_mth_cnt lght chk no-> $this->query_out110  -- MTH : $this->ls_new_yr_mth_cut, ENDOFMTH : $this->deliverydate3</p>";
			}

			$this->execute110 = $db1->query($this->query_out110);
			
			if($_SESSION['mychecking'] == 1 || $this->adm_id == 1){	
				//echo "<p style='color: purple; font-style:oblique;'>$this->ls_new_yr_mth_cnt NUWROWs-> ".$db1->num_rows($this->execute110)."</p>";
			}

			if ($db1->num_rows($this->execute110) > 0){ //exist, so chk the mth

				if($this->ls_new_yr_mth == "mth"){

					$this->ls_new_yr_mth_cut	= "yes";
					$this->ls_new_yr_mth_no 	= "addons";

				}else{
					$this->ls_new_yr_mth = "mth";
				}

			}else{//not exist, create a new no
				//echo "addons / fullnewno ".$this->deliverydate3. " -- ".$this->deliverydate_endofmth;
				
				$this->ls_new_yr_mth_no = (($this->deliverydate2[0] <> $this->php_yr) && ($this->deliverydate2[0]."-".$this->deliverydate2[1]."-01" == $this->deliverydate)) ? "addons" : ($this->deliverydate3 == $this->deliverydate_endofmth) ? "addons" : "fullnewno"; 
				
				$this->ls_new_yr_mth_cut	= "yes";

			}

			$this->ls_new_yr_mth_cnt++;

		}/********** while($this->ls_new_yr_mth_cut == "nope") closing **********/
		
		if($this->adm_id == 1){
			//echo "<p style='font; red'>final verdict : ".$this->ls_new_yr_mth_no."</p>";
			//exit;
		}
		
		
		
		if($this->ls_new_yr_mth_no == "fullnewno"){

			if(!empty($this->logsheet_dest_branch)){

				//echo "<p style='font; red'>with dest : ".$this->logsheet_dest_branch."</p>";
			
				/********** if lgsht no (start) **********/
				$this->query_out130 = "select * from ymt_logsheet_no_new where ls_no_new_branch = '$this->logsheet_branch' and ls_no_new_branch_dest = '$this->logsheet_dest_branch' and ls_no_new_status = 1 and ls_no_new_local = '$this->lry_trptype' ";
				
				if($_SESSION['mychecking'] == 1 || $this->adm_id == 1){		
					//echo "<p style='color: purple; font-style:oblique;'>2nd lght chk no-> $this->query_out130</p>";		
				}

				$this->execute130 = $db1->query($this->query_out130);
				$this->results130 = $db1->fetch_assoc($this->execute130);
				
				$this->logsheet_newtripno 	= 1;/********** New logsheet Trip No Shown **********/
				$this->logsheet_newlsno		= $this->results130['ls_no_new_start'].substr($this->php_yr,2).$this->php_mth."001";
				/********** Assign New Logsheet No from Nov 2015 upon req by Ms Lim JB (end) **********/
				
			}else{
				$this->logsheet_newtripno 	= 1;/********** New logsheet Trip No Shown **********/
				$this->logsheet_newlsno		= substr($this->php_yr,2).$this->php_mth."001";/********** New logsheet No Shown **********/
			}
			
		}
		
		if($this->ls_new_yr_mth_no == "addons"){
			
			if(($this->deliverydate2[0]."-".$this->deliverydate2[1]."-01" == $this->deliverydate) && ($db1->num_rows($this->execute110) == 0)){
				
				$this->query_out120 = "select ls_id, ls_branch, ls_no, ls_trip_no from ymt_logsheet where ls_branch='$this->logsheet_branch' and ls_delivery_yr = '".$this->php_yr."'  and ls_delivery_mth = '".$this->php_mth."'  and ls_local = '$this->lry_trptype' ";
				
				if(!empty($this->logsheet_dest_branch)){	$this->query_out120 .= " and ls_destination_branch = '$this->logsheet_dest_branch' ";		}
				
				$this->query_out120 .= " order by ls_no desc limit 1";

				if($_SESSION['mychecking'] == 1 || $this->adm_id == 1){	
					//echo "<p style='color: purple; font-style:oblique;'>get from current yr ls no -> $this->query_out120</p>";
				}

				$this->execute120 = $db1->query($this->query_out120);
				
				$this->results120 			= $db1->fetch_assoc($this->execute120);
				$this->logsheet_newtripno 	= $this->results120['ls_trip_no'] + 1;/********** New logsheet Trip No Shown **********/
				$this->logsheet_newlsno		= $this->results120['ls_no'] + 1;
				//echo "<p style='color: red; font-style:oblique;'>lsht_start 213v & 110 empty: $this->lsht_start || trip no : $this->logsheet_newtripno || new ls no : $this->logsheet_newlsno</p>";	
			}else{
			
				$this->results110 			= $db1->fetch_assoc($this->execute110);
				$this->logsheet_newtripno 	= $this->results110['ls_trip_no'] + 1;/********** New logsheet Trip No Shown **********/
				$this->logsheet_newlsno		= $this->results110['ls_no'] + 1;
				//echo "<p style='color: purple; font-style:oblique;'>lsht_start 213v: $this->lsht_start || trip no : $this->logsheet_newtripno || new ls no : $this->logsheet_newlsno</p>";	
			}
			
		}
		/********** Assign New Logsheet No from Nov 2015 upon req by Ms Lim JB (end) **********/

		
		
		if($_SESSION['mychecking'] == 1 || $this->adm_id == 1){
			//echo "<p style='color: purple; font-style:oblique;'>lsht_start 213v: $this->lsht_start || trip no : $this->logsheet_newtripno || new ls no : $this->logsheet_newlsno</p>";	
			//exit; 
		}
		
		$this->view_check_no = array(0=>$this->lsht_start,1=>$this->logsheet_newtripno,2=>$this->logsheet_newlsno);

		return $this->view_check_no;
		
	}
	
	
	
	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF RECORDING NEW LOGSHEET ONLY							   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_record($logsheet_refno, $logsheet_branch, $logsheet_lryno, $logsheet_driver_id, $logsheet_driver_icno, $logsheet_attendant_id, $logsheet_attendant_id2, $logsheet_approved_by, $logsheet_issued_by, $logsheet_advance, $logsheeti_invoice_no, $logsheeti_do_id, $logsheeti_do_no, $logsheeti_from, $logsheeti_to, $logsheeti_consignor, $logsheeti_consignee, $logsheeti_particulars, $logsheeti_noofpckgs, $logsheeti_weight, $logsheeti_freight, $logsheeti_remarks, $date_shj, $full_date, $insert_type, $logsheet_backdate){

		//echo "<p> logsheet insert->> $logsheet_refno, $logsheet_branch, $logsheet_lryno, $logsheet_driver_id, $logsheet_driver_icno, $logsheet_attendant_id, $logsheet_attendant_id2, $logsheet_approved_by, $logsheet_issued_by, $logsheet_advance, $logsheeti_invoice_no, $logsheeti_do_no, $logsheeti_from, $logsheeti_to, $logsheeti_consignor, $logsheeti_consignee, $logsheeti_particulars, $logsheeti_noofpckgs, $logsheeti_weight, $logsheeti_freight, $logsheeti_remarks, $date_shj, $full_date, insert_type : $insert_type</p>";
		global $db1;
		
		$this->query_out = $query_out;
		$this->execute = $execute;
		$this->results = $results;
		$this->query_out2 = $query_out2;
		$this->execute2 = $execute2;
		$this->results2 = $results2;
		$this->query_out3 = $query_out3;
		$this->execute3 = $execute3;
		$this->results3 = $results3;
		
		/********** logsheet main detail **********/
		$this->logsheet_refno = $logsheet_refno;
		$this->logsheet_branch = $logsheet_branch;
		$this->logsheet_lryno = $logsheet_lryno;
		$this->logsheet_driver_id = $logsheet_driver_id;
		$this->logsheet_driver_icno = $logsheet_driver_icno;
		$this->logsheet_attendant_id = $logsheet_attendant_id;
		$this->logsheet_attendant_id2 = $logsheet_attendant_id2;
		$this->logsheet_approved_by = $logsheet_approved_by;
		$this->logsheet_issued_by = $logsheet_issued_by;
		$this->logsheet_advance = $logsheet_advance;
		
		/********** logsheet item detail **********/
		$this->logsheet_id = $logsheet_id;
		$this->logsheeti_invoice_no = $logsheeti_invoice_no;
		$this->logsheeti_do_id = $logsheeti_do_id;
		$this->logsheeti_do_no = $logsheeti_do_no;
		$this->logsheeti_from = $logsheeti_from;
		$this->logsheeti_to = $logsheeti_to;
		$this->logsheeti_consignor = $logsheeti_consignor;
		$this->logsheeti_consignee = $logsheeti_consignee;
		$this->logsheeti_particulars = $logsheeti_particulars;
		$this->logsheeti_noofpckgs = $logsheeti_noofpckgs;
		$this->logsheeti_weight = $logsheeti_weight;
		$this->logsheeti_freight = $logsheeti_freight;
		$this->logsheeti_remarks = $logsheeti_remarks;
		$this->logsheet_newno = $logsheet_newno;
		$this->logsheet_id_existence = $logsheet_id_existence;
		$this->insert_type = $insert_type;
		$this->logsheet_backdate = $logsheet_backdate;

		$this->logsheet_rotation = $logsheet_rotation;

		$this->adm_dept = $adm_dept;

		/********** date **********/
		$this->date_shj = $date_shj;
		$this->full_date = $full_date;

		$this->view = $view;
		$this->view = array();	
		 
		/**********  verify the logsheet record orignated frm whr **********/
		if($this->insert_type == "dorder"){

			/**********  get the logsheet id n nric **********/
			$this->logsheet_driver_id = $this->logsheet_lorry_driver($this->logsheet_issued_by,$this->logsheet_lryno,$this->logsheet_branch,"full",$this->full_date, $this->insert_type);

			/**********  get the current logsheet id so tat all the other do goes inside tis logsheet id **********/
			$this->query_out3 = "SELECT ls_id from ymt_logsheet WHERE ls_lorry_no='$this->logsheet_lryno' and ls_issued_date='$this->date_shj' and ls_issued_mth='".date("n")."' and ls_issued_yr='".date("Y")."' and ls_completed=0 and ls_branch = '$this->logsheet_branch'";
			//echo "<p>check prev logsheet id_>> $this->query_out3</p>";
			$this->execute3 = $db1->query($this->query_out3);
			if($db1->num_rows($this->execute3) > 0){
				$this->results3 = $db1->fetch_array($this->execute3);
				$this->logsheet_id = $this->results3['ls_id'];
				$this->logsheet_id_existence = "yes";
			}else{
				$this->logsheet_id_existence = "no";
			}
			
		}else{

			/**********  get the logsheet id n nric **********/
			$this->logsheet_driver_id = $this->logsheet_lorry_driver($this->logsheet_issued_by,$this->logsheet_driver_id,$this->logsheet_branch,"full",$this->date_shj, $this->insert_type);
			$this->logsheet_id_existence = "no";

		}

			
		if($this->logsheet_id_existence == "no"){

			/**********  get logsheet no n trip no **********/
			$this->logsheet_newno = $this->logsheet_checkno($this->logsheet_issued_by,"admin",$this->logsheet_branch,"","full",$this->logsheet_lryno,"outstation");//update to logsheet_lryno on 12022012
			
			/**********  insert into logsheet as new record **********/
			if($this->logsheet_backdate == "yes"){
				$this->query_out = "INSERT INTO ymt_logsheet(ls_no, ls_refno, ls_branch, ls_lorry_no, ls_driver, ls_driver_icno, ls_attendant, ls_attendant2, ls_approved_by, ls_issued_by, ls_issued_date, ls_issued_mth, ls_issued_yr, ls_advance, ls_trip_no, ls_backdate) values(";	
				$this->query_out .= "'".$this->logsheet_newno[0]."', '$this->logsheet_refno', '$this->logsheet_branch', '$this->logsheet_lryno', '".$this->logsheet_driver_id[0]."', '".$this->logsheet_driver_id[1]."', '$this->logsheet_attendant_id', '$this->logsheet_attendant_id2', '$this->logsheet_approved_by', '$this->logsheet_issued_by', '$this->full_date', '".date("n")."', '".date("Y")."', '$this->logsheet_advance', '".$this->logsheet_newno[1]."', '1')";
			}else{
				$this->query_out = "INSERT INTO ymt_logsheet(ls_no, ls_refno, ls_branch, ls_lorry_no, ls_driver, ls_driver_icno, ls_attendant, ls_attendant2, ls_approved_by, ls_issued_by, ls_issued_date, ls_issued_mth, ls_issued_yr, ls_advance, ls_trip_no) values(";	
				$this->query_out .= "'".$this->logsheet_newno[0]."', '$this->logsheet_refno', '$this->logsheet_branch', '$this->logsheet_lryno', '".$this->logsheet_driver_id[0]."', '".$this->logsheet_driver_id[1]."', '$this->logsheet_attendant_id', '$this->logsheet_attendant_id2', '$this->logsheet_approved_by', '$this->logsheet_issued_by', '$this->full_date', '".date("n")."', '".date("Y")."', '$this->logsheet_advance', '".$this->logsheet_newno[1]."')";
			}
			
			//echo "1st lvl logsheet -> $this->query_out";
			
			$this->execute = $db1->query($this->query_out);
			$this->logsheet_id = $db1->insert_id();
		}

		$this->logsheet_rotation = sizeof($this->logsheeti_noofpckgs);
		
		//echo "<p>ref: $this->logsheet_refno,<br> brnch: $this->logsheet_branch,<br> lry: $this->logsheet_lryno,<br> drv id : $this->logsheet_driver_id,<br> drv icno: $this->logsheet_driver_icno,<br> attn id: $this->logsheet_attendant_id, <br>attn id2 : $this->logsheet_attendant_id2, <br>apprv:$this->logsheet_approved_by, <br>issued: $this->logsheet_issued_by, <br>advanced: $this->logsheet_advance, <br>Inv NO:  $this->logsheeti_invoice_no, <br>do no: $this->logsheeti_do_no, <br>frm: $this->logsheeti_from, <br>to: $this->logsheeti_to, <br>cnsgnr: $this->logsheeti_consignor, <br>cnsgne: $this->logsheeti_consignee, <br><hr>rotation: $this->logsheet_rotation</p>";
		
		/**********  getting the logsheet result **********/	
		for($this->itemcount = 0;$this->itemcount < $this->logsheet_rotation;$this->itemcount++){//replace for loop wit while loop n use the count no inside the array to store the date.
			
			/********** assign logsheet's information **********/
			$this->query_out2 = "INSERT INTO ymt_logsheet_item(lsi_refno, lsi_ls_id, lsi_invoice_no, lsi_do_no, lsi_do_id, lsi_from, lsi_to, lsi_consignor, lsi_consignee, lsi_particulars, lsi_no_of_pckgs, lsi_weight, lsi_frieght, lsi_remarks, lsi_date_issued) values(";	
			$this->query_out2 .= "'$this->logsheet_refno', '$this->logsheet_id', '";
			$this->query_out2 .= $this->logsheeti_invoice_no."', '";
			$this->query_out2 .= $this->logsheeti_do_no."', '"; 
			$this->query_out2 .= $this->logsheeti_do_id."', '"; 
			$this->query_out2 .= $this->logsheeti_from."', '";
			$this->query_out2 .= $this->logsheeti_to."', '"; 
			$this->query_out2 .= $this->logsheeti_consignor."', '"; 
			$this->query_out2 .= $this->logsheeti_consignee."', '";
			$this->query_out2 .= $this->logsheeti_particulars[$this->itemcount]."', '"; 
			$this->query_out2 .= $this->logsheeti_noofpckgs[$this->itemcount]."', '";
			$this->query_out2 .= $this->logsheeti_weight[$this->itemcount]."', '"; 
			$this->query_out2 .= $this->logsheeti_freight[$this->itemcount]."', '";
			$this->query_out2 .= $this->logsheeti_remarks[$this->itemcount]."', ";
			$this->query_out2 .= "'$this->date_shj')";

			//echo "<p>2nd, logsheet item -> $this->query_out2</p>";
			$this->execute2 = $db1->query($this->query_out2);
		}
						
		if($this->execute2){		
			$this->query_out4 = "update ymt_lorry set lorry_available = '0' where lorry_id = '$this->logsheet_lryno'";
			$this->execute4 = $db1->query($this->query_out4);
			if($this->execute4){
				$this->view = array(0=>"logsheet_masuk",1=>$this->logsheet_newno[0],2=>$this->logsheet_newno[1]);			
			}else{
				$this->view = array(0=>"logsheet_masuk_lorry_problem",1=>$this->logsheet_newno[0],2=>$this->logsheet_newno[1]);			
			}
		}

		return $this->view;

	}
	
	

	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF UPDATING LOGSHEET ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_update($logsheet_pgnow,$logsheet_id,$logsheet_origin,$logsheet_dest_branch,$logsheet_dlvr_date,$logsheet_lry_id_ori,$logsheet_lry_id,$logsheet_drv_id,$logsheet_attn_id,$logsheet_adv,$logsheet_adv_vchr_id,$logsheet_remarks, $adm_id, $adm_name, $adm_dept, $adm_branch){
		if($adm_id == 1){
			//echo "<p>wir : $logsheet_pgnow,$logsheet_id,$logsheet_origin,$logsheet_dest_branch,$logsheet_dlvr_date,$logsheet_lry_id_ori,$logsheet_lry_id,$logsheet_drv_id,$logsheet_attn_id,$logsheet_adv,$logsheet_adv_vchr_id,$logsheet_remarks, $adm_id, $adm_name, $adm_dept, $adm_branch</p>";
			//exit;
		}
		global $db1,$useripadd, $php_time, $php_date, $php_date_yest, $php_date_tmrw;
		
		$this->query_out 	= $query_out;
		$this->execute 		= $execute;
		$this->results 		= $results;
		$this->query_out2 	= $query_out2;
		$this->execute2 	= $execute2;
		$this->results2 	= $results2;
		$this->query_out3 	= $query_out3;
		$this->execute3 	= $execute3;
		$this->results3 	= $results3;

		$this->logsheet_pgnow 		= $logsheet_pgnow;
		$this->logsheet_id 			= $logsheet_id;
		$this->logsheet_origin 		= $logsheet_origin;
		$this->logsheet_dest_branch = $logsheet_dest_branch;
		$this->logsheet_dlvr_date 	= $logsheet_dlvr_date;
		$this->logsheet_lry_id_ori 	= $logsheet_lry_id_ori;
		$this->logsheet_lry_id		= $logsheet_lry_id;
		$this->logsheet_drv_id 		= $logsheet_drv_id;
		$this->logsheet_attn_id 	= $logsheet_attn_id;
		$this->logsheet_adv 		= $logsheet_adv;
		
		$this->logsheet_remarks 	= $logsheet_remarks;

		$this->logsheet_adv_vchr_id_expl = explode("^",$logsheet_adv_vchr_id);
		
		$this->logsheet_adv_new = (!empty($this->logsheet_adv)) ? $this->logsheet_adv : $this->logsheet_adv_vchr_id_expl[1];
		
		$this->logsheet_newno2	= "";

		$this->adm_id 		= $adm_id;
		$this->adm_name		= $adm_name;
		$this->adm_dept 	= $adm_dept;
		$this->adm_branch 	= $adm_branch;
		
		$this->full_date 	= $php_time;
		$this->php_date		= $php_date;
		$this->php_date_yest= $php_date_yest;
		$this->php_date_tmrw= $php_date_tmrw;
		
		/********** log purpose start **********/
		$this->log_action 	= "Update Logsheet (New Sys)";
		$this->log_desc 	= "";
		$this->log_result 	= "";
		$this->log_error 	= "";
		$this->log_ipadd 	= $useripadd;
		$this->updated_by	= $adm_id;
		/********** log purpose start **********/
		

		/**********  verify the logsheet existence **********/
		$this->query_out = "select * from ymt_logsheet where ls_id = '$this->logsheet_id' ";
		if($this->adm_id == 1){
			//echo "<p>Q1 chk-> : 1st-> $this->query_out</p>";
		}
		$this->execute = $db1->query($this->query_out);

		/**********  getting the logsheet result **********/
		if ($db1->num_rows($this->execute) == 0){
			$this->view 		= array(0=>"xlogsheet");
			$this->log_result 	= "Logsheet : ".$this->logsheet_id." invalid.";
			$this->log_error 	= "Error";
			$this->log_desc 	= $this->query_out;
		}else{

			$this->results = $db1->fetch_assoc($this->execute);

			$this->query_out_adm= "select admin_id, admin_name from ymt_admin where admin_id = '".$this->results['ls_issued_by']."'";
			//echo "<p>Q2 admin info-> : 2nd-> $this->query_out_adm</p>";
			$this->execute_adm 	= $db1->query($this->query_out_adm);
			$this->results_adm 	= $db1->fetch_assoc($this->execute_adm);

			/**********  assign logsheet's information **********/
			$this->query_out2  = "UPDATE ymt_logsheet set ";
			$this->query_out2 .= "ls_updated_on = '$this->full_date', ";

			/**** update ls no ****/
			if(empty($this->results['ls_destination_branch']) && $this->logsheet_pgnow == "temp" || $this->results['ls_destination_branch'] <> $this->logsheet_dest_branch){

				$this->logsheet_newno = $this->logsheet_checkno($this->adm_id,"admin",$this->logsheet_origin,$this->logsheet_dest_branch,"full",$this->full_date,$this->logsheet_lry_id,"outstation");

				$this->query_out2 .= "ls_no = '".$this->logsheet_newno[2]."', ls_trip_no = '".$this->logsheet_newno[1]."', ls_destination_branch = '".$this->logsheet_dest_branch."', ls_approved_by = '$this->adm_id', ";
				//echo "<p>Q2 LS info-> : 2nd-> ".$this->results['ls_issued_date']." ($this->php_date) :-> ".$this->results['ls_delivery_date']."[$this->php_date_tmrw]</p>";

				if($this->results['ls_issued_date'] <> $this->php_date || $this->results['ls_delivery_date'] <> $this->php_date_tmrw){

					$this->logsheet_remarks = "MISSED TO CONFIRM BY ".$this->results_adm['admin_name']." ON ".$this->results['ls_issued_date']." AND WERE UPDATED ON ".$this->full_date." BY ".$this->adm_name.". ".strtoupper($this->logsheet_remarks);

				}

			}

			if(!empty($this->results['ls_remarks'])){ 		$this->logsheet_remarks = $this->results['ls_remarks'].". ".$this->logsheet_remarks;			}

			if(!empty($this->logsheet_remarks)){
				$this->query_out2 .= "ls_remarks = '".strtoupper($this->logsheet_remarks)."', ";
			}

			if($this->results['ls_delivery_date'] <> $this->logsheet_dlvr_date){
				$this->query_out2 .= "ls_delivery_date = '$this->logsheet_dlvr_date', ";
			}

			if($this->results['ls_lorry_no'] <> $this->logsheet_lry_id){
				$this->query_out2 .= "ls_lorry_no = '$this->logsheet_lry_id', ";
			}

			if($this->results['ls_driver'] <> $this->logsheet_drv_id){
				$this->query_out2 .= "ls_driver = '$this->logsheet_drv_id', ";
			}

			if($this->results['ls_attendant'] <> $this->logsheet_attn_id){
				$this->query_out2 .= "ls_attendant = '$this->logsheet_attn_id', ";
			}

			if($this->results['ls_advance'] <> $this->logsheet_adv_new){
				$this->query_out2 .= "ls_advance = '$this->logsheet_adv_new', ";
			}


			$this->query_out2 .= " ls_updated_by = '$this->adm_id'";
			$this->query_out2 .= " WHERE ls_id='$this->logsheet_id'";


			if($this->adm_id == 1){
				//echo "<p>Q2 update P1-> : 1st-> $this->query_out2</p>";
				//exit;
			}

			$this->execute2 = $db1->query($this->query_out2);

			if($this->execute2){

				$this->logsheet_newno2 = ($this->results['ls_no'] <> $this->logsheet_newno[2] && !empty($this->logsheet_newno[2])) ? $this->logsheet_newno[2] : $this->results['ls_no'];

				//echo "<p>P3 Update : ".$this->logsheet_adv_vchr_id_expl[0].", new ls no : ".$this->logsheet_newno2."</p>";

				if($this->logsheet_adv_vchr_id_expl[0] > 0 || !empty($this->logsheet_adv_vchr_id_expl[0])){

					$this->query_out3 	= "select pay_remarks from ymt_pettycash where pay_id = '".$this->logsheet_adv_vchr_id_expl[0]."' and pay_status = 1";
					if($this->adm_id == 1){
						//echo "<p>Q3 -> : 1st-> $this->query_out3</p>";
					}
					$this->execute3 	= $db1->query($this->query_out3);

					if ($db1->num_rows($this->execute3) > 0){
						$this->results3		= $db1->fetch_assoc($this->execute3);
						$this->payremark_new= $this->results3['pay_remarks'].",";
					}

					$this->query_out4 	= "update ymt_pettycash set pay_lgsht_id = '".$this->logsheet_id."', pay_lgsht = '$this->logsheet_origin -> $this->logsheet_dest_branch ".$this->logsheet_newno2." - $this->php_date', pay_updated_on = '$this->full_date', pay_updated_by = '$this->adm_id', pay_remarks = '".$this->payremark_new." UPDATED LOGSHEET WITH PETTYCASH INFO ON $this->full_date' where pay_id = '".$this->logsheet_adv_vchr_id_expl[0]."' ";
					if($this->adm_id == 1){
						//echo "<p>Q4 update P2-> : 1st-> $this->query_out4</p>";
					}
					$this->execute4  	= $db1->query($this->query_out4);

				}

				if($this->execute4){
					$this->view 		= array(0=>"logsheet_update_pcash",1=>$this->logsheet_newno2,2=>$this->logsheet_newno[1]);
					$this->log_result 	= "Successfully update petty cash : ".$this->logsheet_adv_vchr_id_expl[0];
					$this->log_desc 	= $this->query_out4;
				}else{
					$this->view 		= array(0=>"logsheet_update",1=>$this->logsheet_newno2,2=>$this->logsheet_newno[1]);
					$this->log_result 	= "Successfully update logsheet only : ".$this->logsheet_id;
					$this->log_desc 	= $this->query_out2;
				}

			}

		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

		$this->log_result = $this->ymtt_log($this->log_action, str_replace("'","",$this->log_desc), $this->log_result, $this->log_error, $this->updated_by, $this->log_ipadd, $this->full_date);

		return $this->view;
	}

	
	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF DELETE LOGSHEET ONLY									   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_delete($adm_id, $logsheet_id, $adm_dept, $adm_branch, $adm_permission, $full_date){
		global $db1,$useripadd,$php_time, $pg_lftmenu_lgsht, $pg_lftmenu_do, $pg_lftmenu_lorry, $pg_lftmenu_client;
		
		$this->query_out = $query_out;
		$this->execute = $execute;
		$this->results = $results;
		$this->query_out2 = $query_out2;
		$this->execute2 = $execute2;
		$this->results2 = $results2;
		$this->query_out3 = $query_out3;
		$this->execute3 = $execute3;
		$this->results3 = $results3;
		
		$this->adm_id = $adm_id;
		$this->logsheet_id = $logsheet_id;
		$this->adm_branch = $adm_branch;
		$this->adm_permission = $adm_permission;
		$this->full_date = $full_date;
		
		/********** log purpose start **********/
		$this->log_action 	= "Remove D/O From Logsheet (New Sys)";
		$this->log_desc 	= "";
		$this->log_result 	= "";
		$this->log_error 	= "";
		$this->log_ipadd 	= $useripadd;
		$this->updated_by	= $adm_id;
		/********** log purpose start **********/
		

		/**********  verify the logsheet existence **********/
		$this->query_out = "select ls_id, ls_no from ymt_logsheet where ls_id='$this->logsheet_id' and ls_status = 1";
		//echo "1st-> $this->query_out";
		$this->execute = $db1->query($this->query_out);
		
		/**********  getting the logsheet result **********/
		if ($db1->num_rows($this->execute) == 0){
			$this->view = "xlogsheet";
		}else{
			
			/********** delete logsheet's information if all the item is also deleted, else, giv warning msg **********/
			$this->query_out2 = "select lsi_id, lsi_ls_id from ymt_logsheet_item WHERE lsi_ls_id='$this->logsheet_id' and lsi_status = 1";
			//echo "2nd-> $this->query_out2";
			$this->execute2 = $db1->query($this->query_out2);
			if ($db1->num_rows($this->execute2) > 0){
				$this->view = "logsheet_item_active";
			}else{

				/********** Getting logsheet information **********/
				$this->results = $db1->fetch_array($this->execute);
				
				/********** delete logsheet's information if all the item is also deleted, else, giv warning msg **********/
				$this->query_out3 = "UPDATE ymt_logsheet set ls_status = '7' WHERE ls_id='$this->logsheet_id' and ls_status = 1";
				//echo "2nd-> $this->query_out2";
				$this->execute3 = $db1->query($this->query_out3);
					
				if($this->execute3){
					$this->view = array("logsheet_delete",$this->results['ls_no']);
				}
			}

		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/
		
		$this->log_result = $this->ymtt_log($this->log_action, str_replace("'","",$this->log_desc), $this->log_result, $this->log_error, $this->updated_by, $this->log_ipadd, $this->full_date);

		return $this->view;
	}



	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF DELETE LOGSHEET ONLY									   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_delete_item($logsheet_id, $odr_id, $adm_id, $adm_dept, $adm_branch, $adm_permission){
		global $db1,$useripadd,$php_time, $pg_lftmenu_lgsht, $pg_lftmenu_do, $pg_lftmenu_lorry, $pg_lftmenu_client;
		
		$this->query_out 	= $query_out;
		$this->execute 		= $execute;
		$this->results 		= $results;
		$this->query_out2 	= $query_out2;
		$this->execute2 	= $execute2;
		$this->results2 	= $results2;
		$this->query_out3 	= $query_out3;
		$this->execute3 	= $execute3;
		$this->results3 	= $results3;
		
		$this->logsheet_id 		= $logsheet_id;
		$this->odr_id 			= $odr_id;
		$this->lgsht_info_basic	= "";
		$this->log_result2		= ""; 
		
		$this->adm_id 			= $adm_id;
		$this->adm_dept 		= $adm_dept;
		$this->adm_branch 		= $adm_branch;
		$this->adm_permission 	= $adm_permission;
		
		$this->full_date 		= $php_time;
		
		
		/********** log purpose start **********/
		$this->log_action 	= "Remove D/O From Logsheet (New Sys)";
		$this->log_desc 	= "";
		$this->log_result 	= "";
		$this->log_error 	= "";
		$this->log_ipadd 	= $useripadd;
		$this->updated_by	= $adm_id;
		/********** log purpose start **********/
		

		/**********  verify the logsheet existence **********/
		$this->query_out = "select lsi_id, lsi_ls_id, lsi_do_id from ymt_logsheet_item where lsi_ls_id='$this->logsheet_id' and lsi_do_id = '$this->odr_id' and lsi_status = 1";
		//echo "<p>1st-> $this->query_out</p>";
		$this->execute = $db1->query($this->query_out);
		
		/**********  getting the logsheet result **********/
		if ($db1->num_rows($this->execute) == 0){
			$this->view 		= array("xlogsheet_item",$this->results2['do_no']);
			$this->log_result 	= "Lgsht ID : ".$this->logsheet_id." invalid.";
			$this->log_error 	= "Error";
			$this->log_desc 	= $this->query_out;
		}else{
			
			/********** chk do if exist, else warning msg **********/
			$this->query_out2 = "select do_id, do_branch, do_no, date_format(do_issued_date, '%d %b %Y') as do_date_issued from ymt_do WHERE do_id='$this->odr_id' and do_status = 1";
			//echo "<p>2nd-> $this->query_out2</p>";
			$this->execute2 = $db1->query($this->query_out2);
			if ($db1->num_rows($this->execute2) == 0){
				$this->view 		= array("xdo",$this->results2['do_no']);
				$this->log_result 	= "D/O ID : ".$this->odr_id." invalid.";
				$this->log_error 	= "Error";
				$this->log_desc 	= $this->query_out2;
			}else{

				/********** Getting logsheet information **********/
				$this->results2 = $db1->fetch_assoc($this->execute2);
				
				
				/********** delete logsheet's item, else, giv warning msg **********/
				$this->query_out3 = "DELETE from ymt_logsheet_item WHERE lsi_ls_id='$this->logsheet_id' and lsi_do_id = '$this->odr_id' and lsi_status = 1";
				//echo "<p>3rd-> $this->query_out3</p>";
				$this->execute3 = $db1->query($this->query_out3);
					
				if($this->execute3){
				
					//change D/O status to empty so it can b used again.
					$this->query_out4 = "UPDATE ymt_do set do_lorry_no = 0, do_updated_by = '".$this->adm_id."', do_updated_on = '".$this->full_date."' WHERE do_id = '$this->odr_id' and do_status = 1";
					//echo "<p>4th-> $this->query_out4</p>";
					$this->execute4 = $db1->query($this->query_out4);
					
					if($this->execute4){
						
						/********** get the logsheet info (start) **********/
						$this->query_out5_0 = "select ls_id, ls_no, ls_branch, ls_lorry_no, ls_issued_by, date_format(ls_issued_date, '%d %b %Y') as ls_date_issued , ls_trip_no, ls_destination_branch from ymt_logsheet where ls_id='$this->logsheet_id' and ls_status = 1";
						//echo "<p>5th0-> $this->query_out5_0</p>";
						$this->execute5_0 	= $db1->query($this->query_out5_0);
						$this->results5_0 	= $db1->fetch_assoc($this->execute5_0);
						
						$this->lgsht_info_basic  = "<p>";
							$this->lgsht_info_basic .= "Logsheet No: ".$this->results5_0['ls_no']." | Trip No : ".$this->results5_0['ls_trip_no']."<br />";
							
							
							$this->query_out5_1 = "select lorry_id, lorry_regno from ymt_lorry where lorry_id='".$this->results5_0['ls_lorry_no']."' and lorry_status = 1";
							//echo "<p>5th1-> $this->query_out5_1</p>";
							$this->execute5_1 	= $db1->query($this->query_out5_1);
							$this->results5_1 	= $db1->fetch_assoc($this->execute5_1);
							
							
							$this->lgsht_info_basic .= "Lorry No: ".$this->results5_1['lorry_regno']." | From : ".$this->results5_0['ls_branch']." to : ".$this->results5_0['ls_destination_branch']."<br />";
							
							
							$this->query_out5_2 = "select admin_id, admin_name from ymt_admin where admin_id='".$this->results5_0['ls_issued_by']."' ";
							//echo "<p>5th1-> $this->query_out5_2</p>";
							$this->execute5_2 	= $db1->query($this->query_out5_2);
							$this->results5_2 	= $db1->fetch_assoc($this->execute5_2);
							
							
							$this->lgsht_info_basic .= "Issued By: ".$this->results5_2['admin_name']." | Issued On : ".$this->results5_0['ls_date_issued']."<br /><br />";
							$this->lgsht_info_basic .= "D/O No: ".$this->results2['do_no']." | Issued On : ".$this->results2['do_date_issued']."<br />";
						$this->lgsht_info_basic .= "</p>";
						
						/********** get the logsheet info (end) **********/
						
						/********** chk if there is any other do_id  for tat lgsheet b4 it get cancelled **********/
						$this->query_out5 = "select lsi_id, lsi_ls_id, lsi_do_id from ymt_logsheet_item where lsi_ls_id='$this->logsheet_id' and lsi_status = 1";
						//echo "<p>5th-> $this->query_out5</p>";
						$this->execute5 = $db1->query($this->query_out5);
						
						/**********  getting the logsheet result **********/
						if ($db1->num_rows($this->execute5) == 0){
							
							/********** delete logsheet's item, else, giv warning msg **********/
							$this->query_out6 = "DELETE from ymt_logsheet WHERE where ls_id='$this->logsheet_id' and ls_status = 1";
							//echo "<p>6th-> $this->query_out6</p>";
							$this->execute6 = $db1->query($this->query_out6);
								
							if($this->execute6){
								
								$this->log_result	= "success"; 
								$this->log_result2	= "Logsheet Deleted"; 
								$this->log_desc 	= $this->query_out4;
								$this->view 		= array("logsheet_item_delete",$this->results2['do_no']);
						
							}/********** if($this->execute6) closing **********/
							
						}else{
							$this->log_result2	= "Logsheet Remains"; 
						}/********** if ($db1->num_rows($this->execute5) == 0) closing **********/
						
						
						
						/********** once checked, log the action for later review **********/
						$this->query_out5_3 = "INSERT INTO ymt_logsheet_logs SET ls_log_action = '".$this->log_action."', ls_log_desc = '".$this->lgsht_info_basic."', ls_log_result = '".$this->log_result2."', ls_log_userid = '".$this->updated_by."', ls_log_ipadd = '".$this->log_ipadd."', ls_log_date = '".$this->full_date."'";
						//echo "<p>5th3-> $this->query_out5_3</p>";
						$this->execute5_3 = $db1->query($this->query_out5_3);

						
					}/********** if($this->execute4) closing **********/
					
				}else{/********** if($this->execute3) closing **********/
				
					$this->log_result	= "deleted_already"; 
					$this->log_desc 	= $this->query_out4;
					$this->view 		= array("logsheet_item_delete_already",$this->results2['do_no']);
					
				}/********** if($this->execute3) else closing **********/
				
			}/********** if ($db1->num_rows($this->execute2) == 0) else closing **********/

		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/
		
		
		$this->log_result = $this->ymtt_log($this->log_action, str_replace("'","",$this->log_desc), $this->log_result, $this->log_error, $this->updated_by, $this->log_ipadd, $this->full_date);

		return $this->view;
	}



	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF DELETE LOGSHEET ONLY									   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_add_item($logsheet_id, $odr_id, $adm_id, $adm_dept, $adm_branch, $adm_permission){
		global $db1,$useripadd,$php_time, $pg_lftmenu_lgsht, $pg_lftmenu_do, $pg_lftmenu_lorry, $pg_lftmenu_client;
		
		$this->query_out 	= $query_out;
		$this->execute 		= $execute;
		$this->results 		= $results;
		$this->query_out2 	= $query_out2;
		$this->execute2 	= $execute2;
		$this->results2 	= $results2;
		$this->query_out3 	= $query_out3;
		$this->execute3 	= $execute3;
		$this->results3 	= $results3;
		
		$this->logsheet_id 		= $logsheet_id;
		$this->odr_id 			= $odr_id;
		$this->lgsht_info_basic	= "";
		$this->log_result2		= ""; 
		
		$this->adm_id 			= $adm_id;
		$this->adm_dept 		= $adm_dept;
		$this->adm_branch 		= $adm_branch;
		$this->adm_permission 	= $adm_permission;
		
		$this->full_date 		= $php_time;
		
		
		/********** log purpose start **********/
		$this->log_action 	= "Add D/O To Logsheet (New Sys)";
		$this->log_desc 	= "";
		$this->log_result 	= "";
		$this->log_error 	= "";
		$this->log_ipadd 	= $useripadd;
		$this->updated_by	= $adm_id;
		/********** log purpose start **********/
		

		/**********  verify the logsheet existence **********/
		$this->query_out = "select lsi_id, lsi_ls_id, lsi_do_id from ymt_logsheet_item where lsi_ls_id='$this->logsheet_id' and lsi_do_id <> '$this->odr_id' and lsi_status = 1";
		echo "<p>1st-> $this->query_out</p>";
		$this->execute = $db1->query($this->query_out);
		
		/**********  getting the logsheet result **********/
		if ($db1->num_rows($this->execute) == 0){
			$this->view 		= array("xlogsheet_item",$this->results2['do_no']);
			$this->log_result 	= "Lgsht ID : ".$this->logsheet_id." invalid.";
			$this->log_error 	= "Error";
			$this->log_desc 	= $this->query_out;
		}else{
			
			/********** chk do if exist, else warning msg **********/
			$this->query_out2 = "select do_id, do_branch, do_no, date_format(do_issued_date, '%d %b %Y') as do_date_issued from ymt_do WHERE do_id='$this->odr_id' and do_status = 1";
			//echo "<p>2nd-> $this->query_out2</p>";
			$this->execute2 = $db1->query($this->query_out2);
			if ($db1->num_rows($this->execute2) == 0){
				$this->view 		= array("xdo",$this->results2['do_no']);
				$this->log_result 	= "D/O ID : ".$this->odr_id." invalid.";
				$this->log_error 	= "Error";
				$this->log_desc 	= $this->query_out2;
			}else{

				/********** Getting logsheet information **********/
				//$this->results2 = $db1->fetch_assoc($this->execute2);
				
				$this->query_out_dbl_chk = "select lsi_id, lsi_ls_id, lsi_do_id from ymt_logsheet_item where lsi_ls_id='$this->logsheet_id' and lsi_do_id = '$this->odr_id' and lsi_status = 1";
				echo "<p>1st-> $this->query_out_dbl_chk</p>";
				$this->execute_dbl_chk = $db1->query($this->query_out_dbl_chk);
				
				/**********  getting the logsheet result **********/
				if ($db1->num_rows($this->execute_dbl_chk) == 0){
				
					/********** delete logsheet's item, else, giv warning msg **********/
					$this->query_out3 = "INSERT INTO ymt_logsheet_item SET lsi_refno = 'add_itm_later', lsi_ls_id='$this->logsheet_id', lsi_do_id = '$this->odr_id'";
					echo "<p>3rd-> $this->query_out3</p>";
					$this->execute3 = $db1->query($this->query_out3);
						
					if($this->execute3){
					
						
						
						/********** get the logsheet info (start) **********/
						$this->query_out5_0 = "select ls_id, ls_no, ls_branch, ls_lorry_no, ls_trip_no, ls_destination_branch from ymt_logsheet where ls_id='$this->logsheet_id' and ls_status = 1";
						//echo "<p>5th0-> $this->query_out5_0</p>";
						$this->execute5_0 	= $db1->query($this->query_out5_0);
						$this->results5_0 	= $db1->fetch_assoc($this->execute5_0);
						/********** get the logsheet info (end) **********/	
						
						
					
						//change D/O status to empty so it can b used again.
						$this->query_out4 = "UPDATE ymt_do set do_lorry_no = '".$this->results5_0['ls_lorry_no']."', do_updated_by = '".$this->adm_id."', do_updated_on = '".$this->full_date."' WHERE do_id = '$this->odr_id' and do_status = 1";
						//echo "<p>4th-> $this->query_out4</p>";
						$this->execute4 = $db1->query($this->query_out4);
						
						if($this->execute4){
							
							
							$this->lgsht_info_basic  = "<p>";
								$this->lgsht_info_basic .= "Logsheet No: ".$this->results5_0['ls_no']." | Trip No : ".$this->results5_0['ls_trip_no']."<br />";
								
								
								$this->query_out5_1 = "select lorry_id, lorry_regno from ymt_lorry where lorry_id='".$this->results5_0['ls_lorry_no']."' and lorry_status = 1";
								//echo "<p>5th1-> $this->query_out5_1</p>";
								$this->execute5_1 	= $db1->query($this->query_out5_1);
								$this->results5_1 	= $db1->fetch_assoc($this->execute5_1);
								
								
								$this->lgsht_info_basic .= "Lorry No: ".$this->results5_1['lorry_regno']." | From : ".$this->results5_0['ls_branch']." to : ".$this->results5_0['ls_destination_branch']."<br />";
								
								
								$this->query_out5_2 = "select admin_id, admin_name from ymt_admin where admin_id='".$this->results5_0['ls_issued_by']."' ";
								//echo "<p>5th1-> $this->query_out5_2</p>";
								$this->execute5_2 	= $db1->query($this->query_out5_2);
								$this->results5_2 	= $db1->fetch_assoc($this->execute5_2);
								
								
								$this->lgsht_info_basic .= "Issued By: ".$this->results5_2['admin_name']." | Issued On : ".$this->results5_0['ls_date_issued']."<br /><br />";
								$this->lgsht_info_basic .= "D/O No: ".$this->results2['do_no']." | Issued On : ".$this->results2['do_date_issued']."<br />";
							$this->lgsht_info_basic .= "</p>";
							
							/********** get the logsheet info (end) **********/
							$this->log_result	= "success"; 
							$this->log_result2	= "Logsheet Add Item"; 
							$this->log_desc 	= $this->query_out4;
							$this->view 		= array("logsheet_item_add",$this->results2['do_no']);
					
							
							/********** once checked, log the action for later review **********/
							$this->query_out5_3 = "INSERT INTO ymt_logsheet_logs SET ls_log_action = '".$this->log_action."', ls_log_desc = '".$this->lgsht_info_basic."', ls_log_result = '".$this->log_result2."', ls_log_userid = '".$this->updated_by."', ls_log_ipadd = '".$this->log_ipadd."', ls_log_date = '".$this->full_date."'";
							//echo "<p>5th3-> $this->query_out5_3</p>";
							$this->execute5_3 = $db1->query($this->query_out5_3);

							
						}/********** if($this->execute4) closing **********/
						
					}else{/********** if($this->execute3) closing **********/
					
						$this->log_result	= "added_already"; 
						$this->log_desc 	= $this->query_out4;
						$this->view 		= array("logsheet_item_added_already",$this->results2['do_no']);
						
					}/********** if($this->execute3) else closing **********/
					
				}else{/********** if($this->execute3) closing **********/
					
					$this->log_result	= "added_already"; 
					$this->log_desc 	= $this->query_out4;
					$this->view 		= array("logsheet_item_added_already",$this->results2['do_no']);
					
				}/********** if($this->execute3) else closing **********/
			
				
			}/********** if ($db1->num_rows($this->execute2) == 0) else closing **********/

		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/
		
		
		$this->log_result = $this->ymtt_log($this->log_action, str_replace("'","",$this->log_desc), $this->log_result, $this->log_error, $this->updated_by, $this->log_ipadd, $this->full_date);

		return $this->view;
	}



	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF PRINTING LOGSHEET ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_print_skeleton($adm_id, $logsheet_id, $logsheet_pg_brk, $logsheet_itm_brk_cntr, $logsheet_itm_brk_id, $adm_dept, $adm_branch, $adm_permission, $full_date){
		//echo "<p>wir : $adm_id, $logsheet_id, $logsheet_pg_brk, $logsheet_itm_brk_cntr, $logsheet_itm_brk_id, $adm_dept, $adm_branch, $adm_permission, $full_date</p>";
		global $db1;
		
		$this->query_out	= $query_out;
		$this->execute		= $execute;
		$this->results		= $results;
		$this->query_out2	= $query_out2;
		$this->execute2		= $execute2;
		$this->results2		= $results2;
		$this->query_out3	= $query_out3;
		$this->execute3		= $execute3;
		$this->results3		= $results3;
		$this->query_out4	= $query_out4;
		$this->execute4		= $execute4;
		$this->results4		= $results4;
		$this->query_out5	= $query_out5;
		$this->execute5		= $execute5;
		$this->results5		= $results5;
				
		$this->adm_id 					= $adm_id;
		$this->logsheet_id 				= $logsheet_id;
		$this->logsheet_pg_brk			= $logsheet_pg_brk;
		$this->logsheet_itm_brk_cntr	= $logsheet_itm_brk_cntr;
		$this->logsheet_itm_brk_id		= $logsheet_itm_brk_id;
		
		$this->adm_dept 		= $adm_dept;
		$this->adm_branch 		= $adm_branch;
		$this->adm_permission 	= $adm_permission;
		$this->full_date 		= $full_date;

		$this->margintop 	= "";
		$this->pgbreak	 	= "";
		$this->doicnt 		= 1;
		
		/**********  verify the logsheet existence **********/
		//$this->query_out = "select a.ls_id, a.ls_no, ls_branch, a.ls_lorry_no, a.ls_driver, date_format(ls_issued_date, '%d %M %Y') as date_issued, a.ls_trip_no, b.lorry_id, b.lorry_regno, c.driver_id, c.driver_name, c.driver_mobile from ymt_logsheet a, ymt_lorry b, ymt_driver c where a.ls_lorry_no = b.lorry_id and a.ls_driver = c.driver_id and ls_branch= '$this->adm_branch' and ls_id='$this->logsheet_id' and ls_status = 1";
		$this->query_out = "select a.ls_id, a.ls_no, a.ls_branch, a.ls_lorry_no, a.ls_driver, date_format(ls_issued_date, '%d %b %Y') as date_issued, a.ls_advance, a.ls_trip_no, b.lorry_id, b.lorry_regno from ymt_logsheet a, ymt_lorry b where a.ls_lorry_no = b.lorry_id and a.ls_id='$this->logsheet_id' and a.ls_status = 1";
		//echo "<p>1st-> $this->query_out</p>";
		$this->execute = $db1->query($this->query_out);
		
		
		
		if($this->logsheet_pg_brk == "break" && $this->logsheet_itm_brk_cntr > 17){
			$this->pgbreak = "page-break-after: always;";
		}
		
		/********** lgsht wrapper (start) 08092012 **********/
		$this->view .= "<div style='width: 986px; border: 0px solid #555; clear: both; ".$this->pgbreak."'>";
			
			
			/**********  getting the logsheet result **********/
			if ($db1->num_rows($this->execute) == 0){
				$this->view = "xlogsheet";
			}else{
				
				/********** Getting logsheet information **********/
				$this->results = $db1->fetch_array($this->execute);
				
				
				//logsheet top header
				$this->view .= "<div style='width: 980px; height: 30px; border: 0px solid #555;	clear: both;'>";
					 $this->view .= "<span style='width: 170px;float: right;border: 0px solid #555;font-size: 1.5em;'>".$this->results['ls_branch']." No : ".$this->results['ls_no']."</span>";
					 $this->view .= "<div class='clear' >&nbsp;</div>";
				$this->view .= "</div>";
				
							
				if($this->adm_branch == "BM"){		$this->margintop = " margin-top: 15px; ";	}else{	$this->margintop = " margin-top: 15px; ";/*dass add on 31032012 to set alignment*/	}
				
				$this->view .= "<table cellspacing='0' cellpadding='0' border='0' style='width: 980px; ".$this->margintop."' align='left'>";			
				$this->view .= "<tr>";
					$this->view .= "<td style='width: 150px; height: 30px; text-align: center; vertical-align: middle; font-size: 14px;border: 0px solid #555;'>";	
						$this->view .= $this->results['lorry_regno'];					
					$this->view .= "</td>";
					$this->view .= "<td style='width: 90px; height: 30px; text-align: right; vertical-align: middle; font-size: 14px;border: 0px solid #555;'>";	
						$this->view .= "&nbsp;";					
					$this->view .= "</td>";
					$this->view .= "<td style='width: 180px; height: 30px; text-align: left; vertical-align: middle; font-size: 14px;border: 0px solid #555;'>";	
						/**********  get the consignor info **********/
						$this->query_out6 = "select driver_id, driver_name from ymt_driver where driver_id='".$this->results['ls_driver']."'";
						//echo "2nd-> $this->query_out2";
						$this->execute6 = $db1->query($this->query_out6);
						$this->results6 = $db1->fetch_assoc($this->execute6);
						
						
						if(strlen($this->results6['driver_name']) > 19){
							$this->view6 .= substr($this->results6['driver_name'],0,19);
						}else{
							$this->view6 .= $this->results6['driver_name'];
						}
											
						$this->view .= "<div style='width: 175px; height: auto; overflow: hidden; border: 0px solid #555;'>".$this->view6."</div>";
						
					$this->view .= "</td>";
					$this->view .= "<td style='width: 70px; height: 30px; text-align: right; vertical-align: middle; font-size: 14px;border: 0px solid #555;'>";	
						$this->view .= "&nbsp;";
					$this->view .= "</td>";
					$this->view .= "<td style='width: 180px; height: 30px; text-align: left; vertical-align: middle; font-size: 14px;border: 0px solid #555;'>";	
						/**********  get the consignor info **********/
						$this->query_out7 = "select driver_id, driver_name from ymt_driver where driver_id='".$this->results['ls_driver']."'";
						//echo "2nd-> $this->query_out2";
						$this->execute7 = $db1->query($this->query_out7);
						$this->results7 = $db1->fetch_array($this->execute7);
						//$this->view7 .= $this->results7['driver_name'];
						
						if(strlen($this->results7['driver_name']) > 19){
							$this->view7 .= substr($this->results7['driver_name'],0,19);
						}else{
							$this->view7 .= $this->results6['driver_name'];
						}
						
						$this->view .= "<div style='width: 175px; height: auto; overflow: hidden; border: 0px solid #555;'>".$this->view7."</div>";
											
					$this->view .= "</td>";
					$this->view .= "<td style='width: 80px; height: 30px; text-align: right; vertical-align: middle; font-size: 14px;border: 0px solid #555;'>";	
						$this->view .= $this->results['date_issued'];
					$this->view .= "</td>";
					
					$this->view .= "<td style='width: 50px; height: 30px; text-align: right; vertical-align: middle; font-size: 14px;border: 0px solid #555;'>";	
						$this->view .= "&nbsp;";
					$this->view .= "</td>";
					$this->view .= "<td style='width: 40px; height: 30px; vertical-align: middle; font-size: 14px;border: 0px solid #555;text-align: right;'>";	
						$this->view .= $this->results['ls_trip_no'];
					$this->view .= "</td>";
					
				$this->view .= "</tr>";
				$this->view .= "</table>";
							
				$this->view .= "<br><br>";/********** table closing **********/
				
			}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

			//$this->view .= "<div style='width: 990px; height: 600px; border: 0px solid #555;'>";/********** table closing **********/
			
			/**********  get the primary logsheet info **********/
			$this->query_out2 = "select do_id, do_no, do_consignor, do_collect_frm, do_consignee, do_deliver_to, do_deliver_to2, do_cust_dono, lsi_id, lsi_ls_id  from ymt_do join ymt_logsheet_item on do_id = lsi_do_id  where lsi_ls_id='$this->logsheet_id' and lsi_status = '1' order by lsi_id asc";
			//echo "1st-> $this->query_out2";
			$this->execute2 = $db1->query($this->query_out2);
			
			/**********  getting the logsheet result **********/
			if ($db1->num_rows($this->execute2) == 0){
				$this->view2 = "xlogsheet_item";
			}else{
				$this->view2 .= "<table cellspacing='0' cellpadding='0' border='0' style='border: 0px solid #999; font-size: 12px; margin-top: 10px; ' align='left'>";
				$this->view2 .= "<tr>";
				$this->view2 .= "<th style='border-bottom: 0px solid #999; border-right: 0px solid #999; width: 70px; text-align: left; vertical-align: top; height: 30px; '>&nbsp;</th>";
				$this->view2 .= "<th style='border-bottom: 0px solid #999; border-right: 0px solid #999; width: 75px; text-align: left; vertical-align: top;'>&nbsp;</th>";
				$this->view2 .= "<th style='border-bottom: 0px solid #999; border-right: 0px solid #999; width: 30px; text-align: left; vertical-align: top;'>&nbsp;</th>";
				$this->view2 .= "<th style='border-bottom: 0px solid #999; border-right: 0px solid #999; width: 75px; text-align: left; vertical-align: top;'>&nbsp;</th>";
				$this->view2 .= "<th style='border-bottom: 0px solid #999; border-right: 0px solid #999; width: 180px; text-align: left; vertical-align: top;'>&nbsp; </th>";
				$this->view2 .= "<th style='border-bottom: 0px solid #999; border-right: 0px solid #999; width: 180px; text-align: left; vertical-align: top;'>&nbsp; </th>";
				$this->view2 .= "<th style='border-bottom: 0px solid #999; border-right: 0px solid #999; width: 180px; text-align: left; vertical-align: top;'>&nbsp;</th>";
				$this->view2 .= "<th style='border-bottom: 0px solid #999; border-right: 0px solid #999; width: 50px; text-align: left; vertical-align: top;'>&nbsp;</th>";
				$this->view2 .= "<th style='border-bottom: 0px solid #999; border-right: 0px solid #999; width: 60px;text-align: left; vertical-align: top;'>&nbsp;</th>";
				$this->view2 .= "<th style='border-bottom: 0px solid #999; text-align: left; vertical-align: top; width: 60px;'>&nbsp;</th>";
				$this->view2 .= "</tr>";
				
				/********** Getting logsheet content information **********/
				while($this->results2 = $db1->fetch_array($this->execute2)){/********** while opening **********/
					//print_r($this->results);
					//print_r("<br>");
					$this->view2 .= "<tr>";
					$this->view2 .= "<td style='border-bottom: 0px solid #999; border-right: 0px solid #999; ' valign='top'>";
					
						$this->view2 .= "<div style='width: 75px; height: auto; overflow: hidden; text-align: left;'>".$this->results2['do_no']."</div>";
					
					$this->view2 .= "</td>";
					$this->view2 .= "<td style='border-bottom: 0px solid #999; border-right: 0px solid #999; height: 26px; ' valign='top' >";
					
						$this->view2 .= "<div style='width: 75px; height: auto; overflow: hidden; text-align: left;'>".$this->results2['do_cust_dono']."</div>";
					
					$this->view2 .= "</td>";
					
					$this->view2 .= "<td style='border-bottom: 0px solid #999; border-right: 0px solid #999; ' valign='top'>".$this->results2['do_collect_frm']."</td>";
					$this->view2 .= "<td style='border-bottom: 0px solid #999; border-right: 0px solid #999; text-align: center;' valign='top'>";
									
						$this->view2 .= "<div style='width: 80px; height: auto; overflow: hidden; text-align: left;'>".$this->results2['do_deliver_to2']."</div>";
					
					$this->view2 .= "</td>";
					
					
					/**********  get the consignor info **********/
					$this->query_out3 = "select client_id, client_name from ymt_client where client_id='".$this->results2['do_consignor']."'";
					//echo "2nd-> $this->query_out2";
					$this->execute3 = $db1->query($this->query_out3);
					$this->results3 = $db1->fetch_array($this->execute3);
					$this->view2 .= "<td style='border-bottom: 0px solid #999; border-right: 0px solid #999; padding-left: 6px; '  valign='top'>";
					
					if(strlen($this->results3['client_name']) > 20){
						$this->view2 .= substr($this->results3['client_name'],0,20);
					}else{
						$this->view2 .= $this->results3['client_name'];
					}
									
					$this->view2 .= "</td>";

					
					/**********  get the consignee info **********/
					$this->query_out4 = "select client_id, client_name from ymt_client where client_id='".$this->results2['do_consignee']."'";
					//echo "3rd-> $this->query_out3";
					$this->execute4 = $db1->query($this->query_out4);
					$this->results4 = $db1->fetch_array($this->execute4);
					$this->view2 .= "<td style='border-bottom: 0px solid #999; border-right: 0px solid #999; padding-left: 6px; '  valign='top'>";
					
					if(strlen($this->results4['client_name']) > 20){
						$this->view2 .= substr($this->results4['client_name'],0,20);
					}else{
						$this->view2 .= $this->results4['client_name'];
					}
					
					$this->view2 .= "</td>";
					

					$this->view2 .= "<td colspan='4' style='border-bottom: 0px solid #999; vertical-align: top; ' >";
					
						$this->view2 .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='left'>";
						
						/**********  get the secondary logsheet info **********/
						$this->query_out5 	= "select doi_id, doi_desc, doi_qty, doi_weight, doi_unit_prc, doi_frieght from ymt_do_item where doi_do_id = '".$this->results2['do_id']."'";
						//echo "4th-> $this->query_out5<br>";
						$this->execute5 	= $db1->query($this->query_out5);

						
						if ($db1->num_rows($this->execute5) > 0){
						
							/********** Getting logsheet's secondary information **********/
							while($this->results5 = $db1->fetch_array($this->execute5)){/********** while opening **********/
			
								$this->view2 .= "<tr>";
									$this->view2 .= "<td style='border-bottom: 0px solid #999; border-right: 0px solid #999; width: 470px; text-align: left; vertical-align: top; height: 26px;'>&nbsp;".$this->results5['doi_desc']."</td>";
									$this->view2 .= "<td style='border-bottom: 0px solid #999; border-right: 0px solid #999;  width: 140px; text-align: left; vertical-align: top; '>".$this->results5['doi_qty']."</td>";
									$this->view2 .= "<td style='border-bottom: 0px solid #999; border-right: 0px solid #999; width: 160px; text-align: left; vertical-align: top;'>".$this->results5['doi_weight']."</td>";
									$this->view2 .= "<td style='border-bottom: 0px solid #999; width: 150px; vertical-align: top; text-align: left; '>";
									
									//if($this->results5['doi_frieght'] = "0.00"){
										$this->view2 .= "&nbsp;";
									//}else{
									//	$this->view2 .= $this->results5['doi_frieght'];
									//}
									
									$this->view2 .= "</td>";
								$this->view2 .= "</tr>";
								
								$this->doicnt += 1;
								
							}/********** while closing **********/
							
						}else{
							$this->doicnt += 1;
						}
						
						
						if($this->doicnt % 16 == 0){
							$this->view2 .= "<tr>";
								$this->view2 .= "<td colspan='4' height='260'>";
									//$this->view2 .= "<div style='clear: both; width: 670px; height: 260px;'>&nbsp;</div>";
									$this->view2 .= "&nbsp;";
								$this->view2 .= "</td>";
							$this->view2 .= "</tr>";
						}
						
						$this->view2 .= "</table>";/********** particulars table closing **********/
						
						//$this->view2 .= "<br>".$this->doicnt;
						
					$this->view2 .= "</td>";
					$this->view2 .= "</tr>";


				}/********** while closing **********/

				$this->view .= $this->view2."</table>";/********** table closing **********/
					
			}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/
		
		
		$this->view2 .= "</div>";
		/********** while closing **********/
		

		return $this->view;
	}



	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF PRINTING LOGSHEET ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_print_full($adm_id, $logsheet_id, $logsheet_pg_brk, $logsheet_itm_brk_cntr, $logsheet_itm_brk_id, $adm_dept, $adm_branch, $adm_permission, $full_date){
		//echo "<p>wir : $adm_id, $logsheet_id, $logsheet_pg_brk, $logsheet_itm_brk_cntr, $logsheet_itm_brk_id, $adm_dept, $adm_branch, $adm_permission, $full_date</p>";
		global $db1,$useripadd,$php_time, $companyname, $companyregno, $companygst;
		
		$this->query_out	= $query_out;
		$this->execute		= $execute;
		$this->results		= $results;
		$this->query_out2	= $query_out2;
		$this->execute2		= $execute2;
		$this->results2		= $results2;
		$this->query_out3	= $query_out3;
		$this->execute3		= $execute3;
		$this->results3		= $results3;
		$this->query_out4	= $query_out4;
		$this->execute4		= $execute4;
		$this->results4		= $results4;
		$this->query_out5	= $query_out5;
		$this->execute5		= $execute5;
		$this->results5		= $results5;
		$this->query_out7	= $query_out7;
		$this->execute7		= $execute7;
		$this->results7		= $results7;
		
				
		$this->adm_id 					= $adm_id;
		$this->logsheet_id 				= $logsheet_id;
		$this->logsheet_pg_brk			= $logsheet_pg_brk;
		$this->logsheet_itm_brk_cntr	= $logsheet_itm_brk_cntr;
		$this->logsheet_itm_brk_id		= $logsheet_itm_brk_id;
		
		$this->adm_dept 		= $adm_dept;
		$this->adm_branch 		= $adm_branch;
		$this->adm_permission 	= $adm_permission;
		$this->full_date 		= $full_date;
		
		$this->lsght_local_otstn= "";

		$this->margintop 	= "";
		$this->pgbreak	 	= "";
		$this->doicnt 		= 1;
		
		/**********  verify the logsheet existence **********/
		//$this->query_out = "select a.ls_id, a.ls_no, ls_branch, a.ls_lorry_no, a.ls_driver, date_format(ls_issued_date, '%d %M %Y') as date_issued, a.ls_trip_no, b.lorry_id, b.lorry_regno, c.driver_id, c.driver_name, c.driver_mobile from ymt_logsheet a, ymt_lorry b, ymt_driver c where a.ls_lorry_no = b.lorry_id and a.ls_driver = c.driver_id and ls_branch= '$this->adm_branch' and ls_id='$this->logsheet_id' and ls_status = 1";
		$this->query_out = "select a.ls_id, a.ls_no, a.ls_branch, a.ls_lorry_no, a.ls_driver, date_format(ls_issued_date, '%d %b %Y') as date_issued, a.ls_advance, a.ls_trip_no, a.ls_destination_branch, b.lorry_id, b.lorry_regno from ymt_logsheet a, ymt_lorry b where a.ls_lorry_no = b.lorry_id and a.ls_id='$this->logsheet_id' and a.ls_status = 1";
		//echo "<p>1st-> $this->query_out</p>";
		$this->execute = $db1->query($this->query_out);
		
		
		
		if($this->logsheet_pg_brk == "break" && $this->logsheet_itm_brk_cntr > 17){
			$this->pgbreak = "page-break-after: always;";
		}
		
		/********** lgsht wrapper (start) 08092012 **********/
		$this->view .= "<div style='width: 986px; border: 0px solid #555; clear: both; ".$this->pgbreak."'>";
			
			
			/**********  getting the logsheet result **********/
			if ($db1->num_rows($this->execute) == 0){
				$this->view = "xlogsheet";
			}else{
				
				/********** Getting logsheet information **********/
				$this->results 			 = $db1->fetch_assoc($this->execute);
				$this->lsght_local_otstn = $this->results['ls_local']; //added for local



				$this->view .= "<!-- HEADER INFO START -->";
				$this->view .= "<div class='row'>";
				
					$this->view .= "<div class='col-md-9 col-xs-9 lsprint_padding_right_5'>";
					
						$this->view .= "<div class='panel panel-default' style='margin-top: 5px; margin-bottom: 10px;'>";
						
							$this->view .= "<div class='panel-body'>";
								
								$this->view .= "<h3 style='margin-top: 0px;'>".$companyname." <small>".$companyregno."</small></h3>";
								
								$this->view .= "<div class='row'>";
								
									$this->view .= "<div class='col-md-3 col-xs-3' >";
										$this->view .= "DATE : <strong>".$this->results['date_issued']."</strong>";
									$this->view .= "</div>";//.col-md-3 closing
									$this->view .= "<div class='col-md-3 col-xs-3'>";
										$this->view .= "LORRY NO : <strong>".$this->results['lorry_regno']."</strong>";
									$this->view .= "</div>";//.col-md-3 closing
									$this->view .= "<div class='col-md-6 col-xs-6'>";
									
										/**********  get the consignor info **********/
										$this->query_out6 = "select driver_id, driver_name from ymt_driver where driver_id='".$this->results['ls_driver']."'";
										//echo "2nd-> $this->query_out2";
										$this->execute6 = $db1->query($this->query_out6);
										$this->results6 = $db1->fetch_assoc($this->execute6);
										
										
										if(strlen($this->results6['driver_name']) > 30){
											$this->view6 .= substr($this->results6['driver_name'],0,30);
										}else{
											$this->view6 .= $this->results6['driver_name'];
										}
									
										$this->view .= "DRIVER NAME : <strong>".$this->view6."</strong>";
										
										
									$this->view .= "</div>";//.col-md-3 closing
									
								$this->view .= "</div>";//.row closing


							$this->view .= "</div>";/**** .panel-body closing ****/

						$this->view .= "</div>";/**** .panel panel-default closing ****/
						
					$this->view .= "</div>";/**** .col-xs-8 closing ****/
					
					
					$this->view .= "<div class='col-md-3 col-xs-3 lsprint_padding_right_0'>";
					
						$this->view .= "<div class='panel panel-default' style='margin-top: 5px; margin-bottom: 10px;'>";
						
							$this->view .= "<div class='panel-heading'>";
								$this->view .= "<h3 class='panel-title'>";
									$this->view .= "<div class='row'>";
										$this->view .= "<div class='col-md-4 lsprint_title_left' >";
											$this->view .= "L/S NO : ";
										$this->view .= "</div>";
										$this->view .= "<div class='col-md-8 lsprint_title_right'>";
											$this->view .= "<strong>".$this->results['ls_branch']."->".$this->results['ls_destination_branch']." ".$this->results['ls_no']."</strong>";
										$this->view .= "</div>";//.col-md-4 closing
									$this->view .= "</div>";//.row closing
								$this->view .= "</h3>";
							$this->view .= "</div>";
					
					
							$this->view .= "<div class='panel-body' style='padding-bottom: 13px;'>";
								$this->view .= "<div class='row'>";
									$this->view .= "<div class='col-md-4 lsprint_title_left'>";
										$this->view .= "TRIP NO : ";
									$this->view .= "</div>";
									$this->view .= "<div class='col-md-8 lsprint_title_right'>";
										$this->view .= "<strong>".$this->results['ls_trip_no']."</strong>";
									$this->view .= "</div>";//.col-md-4 closing
								$this->view .= "</div>";//.row closing

							$this->view .= "</div>";/**** .panel-body closing ****/
								
						$this->view .= "</div>";/**** .panel panel-default closing ****/
						
					$this->view .= "</div>";/**** .col-xs-4 closing ****/
				
				$this->view .= "</div>";/**** .row closing ****/
				$this->view .= "<!-- HEADER INFO END -->";


			}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

			
			
			$this->view .= "<!-- CONTENT INFO START -->";
			$this->view .= "<div class='row'>";
			
				$this->view .= "<div class='col-md-12 col-xs-12 lsprint_padding_right_0'>";
					
					//$this->view .= "<div style='width: 990px; height: 600px; border: 0px solid #555;'>";/********** table closing **********/
					
					/**********  get the primary logsheet info **********/
					$this->query_out2 = "select do_id, do_no, do_consignor, do_collect_frm, do_consignee, do_deliver_to, do_deliver_to2, do_cust_dono, lsi_id, lsi_ls_id from ymt_do join ymt_logsheet_item on do_id = lsi_do_id  where lsi_ls_id = '$this->logsheet_id' and lsi_status = '1' order by lsi_id asc";
					//echo "<p>Q2 -> $this->query_out2</p>";
					//exit;
					$this->execute2 = $db1->query($this->query_out2);
					
					/**********  getting the logsheet result **********/
					if ($db1->num_rows($this->execute2) == 0){
						$this->view2 = "xlogsheet_item";
					}else{
						
						
						if($this->lsght_local_otstn == 0){
							
							$this->view2 .= "<table class='table table-bordered table-lgsht_content' style='font-size: 11px; margin-top: 10px;'>";
								$this->view2 .= "<thead>";
									$this->view2 .= "<tr>";
										$this->view2 .= "<th style='width: 60px;'>Invoice</th>";
										$this->view2 .= "<th style='width: 75px;'>D/O</th>";
										$this->view2 .= "<th style='width: 30px;'>From</th>";
										$this->view2 .= "<th style='width: 75px;'>To</th>";
										$this->view2 .= "<th style='width: 180px;'>Consignor</th>";
										$this->view2 .= "<th style='width: 180px;'>Consignee</th>";
										$this->view2 .= "<th style='width: 155px;'>Description</th>";
										$this->view2 .= "<th style='width: 25px;'>Qty</th>";
										$this->view2 .= "<th style='width: 50px;'>Uom</th>";
										$this->view2 .= "<th style='width: 60px;'>Weight</th>";
										$this->view2 .= "<th style='width: 60px;'>Freight</th>";
									$this->view2 .= "</tr>";
								$this->view2 .= "</thead>";
							
							$total=0;
								$this->view2 .= "<tbody>";
								
									/********** Getting logsheet content information **********/
									while($this->results2 = $db1->fetch_array($this->execute2)){/********** while opening **********/

										//print_r($this->results);
										//print_r("<br>");
										$this->view2 .= "<tr>";
											$this->view2 .= "<td>";
											
												//$this->view2 .= "<div style='width: 75px; height: auto; overflow: hidden;'>".$this->results2['do_no']."</div>";
												$this->view2 .= $this->results2['do_no'];
											
											$this->view2 .= "</td>";
											$this->view2 .= "<td>";
											
												$this->view2 .= "<div style='width: 75px; height: auto; overflow: hidden; text-align: left;'>".str_replace(",",",<br />",$this->results2['do_cust_dono']) ."</div>";
											
											$this->view2 .= "</td>";
											
											$this->view2 .= "<td>".$this->results2['do_collect_frm']."</td>";
											$this->view2 .= "<td>";

												$this->view2 .= "<div style='width: 80px; height: auto; overflow: hidden; text-align: left;'>".$this->results2['do_deliver_to2']."</div>";

											$this->view2 .= "</td>";
											
											
											/**********  get the consignor info **********/
											$this->query_out3 = "select client_id, client_name from ymt_client where client_id='".$this->results2['do_consignor']."'";
											//echo "2nd-> $this->query_out2";
											$this->execute3 = $db1->query($this->query_out3);
											$this->results3 = $db1->fetch_array($this->execute3);
											$this->view2 .= "<td style='border-bottom: 0px solid #999; border-right: 0px solid #999; padding-left: 6px; '  valign='top'>";
											
											if(strlen($this->results3['client_name']) > 20){
												$this->view2 .= substr($this->results3['client_name'],0,20);
											}else{
												$this->view2 .= $this->results3['client_name'];
											}

											$this->view2 .= "</td>";

											
											/**********  get the consignor info **********/
											$this->query_out4 = "select client_id, client_name from ymt_client where client_id='".$this->results2['do_consignee']."'";
											//echo "3rd-> $this->query_out3";
											$this->execute4 = $db1->query($this->query_out4);
											$this->results4 = $db1->fetch_array($this->execute4);
											$this->view2 .= "<td style='border-bottom: 0px solid #999; border-right: 0px solid #999; padding-left: 6px; '  valign='top'>";
											
											if(strlen($this->results4['client_name']) > 20){
												$this->view2 .= substr($this->results4['client_name'],0,20);
											}else{
												$this->view2 .= $this->results4['client_name'];
											}
											
											$this->view2 .= "</td>";
											

											$this->view2 .= "<td colspan='4' style='padding: 0px !important;'>";
											
												$this->view2 .= "<div style='width: 100%; padding: 0px; margin: 0px;'>";
												//$this->view2 .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='left' class='table-lgsht_content'>";
												
													/**********  get the secondary logsheet info **********/
													$this->query_out5 	= "select doi_id, doi_desc, doi_qty, doi_uom, doi_weight, doi_unit_prc, doi_frieght from ymt_do_item where doi_do_id = '".$this->results2['do_id']."'";
													//echo "<p>Q4 -> $this->query_out5</p>";
													$this->execute5 	= $db1->query($this->query_out5);

													if ($db1->num_rows($this->execute5) > 0){
													
														/********** Getting logsheet's secondary information **********/
														while($this->results5 = $db1->fetch_array($this->execute5)){/********** while opening **********/
										                     
															/* $this->view2 .= "<tr>";
																$this->view2 .= "<td style='border-bottom: 0px solid #999; border-right: 0px solid #999; width: 470px; text-align: left; vertical-align: top; height: 26px;'>&nbsp;".$this->results5['doi_desc']."</td>";
																$this->view2 .= "<td style='border-bottom: 0px solid #999; border-right: 0px solid #999;  width: 140px; text-align: left; vertical-align: top; '>".$this->results5['doi_qty']."</td>";
																$this->view2 .= "<td style='border-bottom: 0px solid #999; border-right: 0px solid #999; width: 160px; text-align: left; vertical-align: top;'>".$this->results5['doi_weight']."</td>";
																$this->view2 .= "<td style='border-bottom: 0px solid #999; width: 150px; vertical-align: top; text-align: left; '>";
																
																//if($this->results5['doi_frieght'] = "0.00"){
																	$this->view2 .= "&nbsp;";
																//}else{
																//	$this->view2 .= $this->results5['doi_frieght'];
																//}
																
																$this->view2 .= "</td>";
															$this->view2 .= "</tr>"; */
															
															//$this->view2 .= "<tr>";
																$this->view2 .= "<div class='div_desc'>".$this->results5['doi_desc']."</div>";																
																$this->view2 .= "<div class='div_qty'>";
																	
																	if(!empty($this->results5['doi_qty'])){	
																		$this->view2 .= $this->results5['doi_qty'];
																	}else{
																		$this->view2 .= "&nbsp;";
																	}

																$this->view2 .= "</div>";
																
																$this->view2 .= "<div class='div_uom'>";
																	
																	if(!empty($this->results5['doi_uom'])){	
																		$this->view2 .= $this->results5['doi_uom'];
																	}else{
																		$this->view2 .= "&nbsp;";
																	}

																$this->view2 .= "</div>";
																
																
																$this->view2 .= "<div class='div_weight'>";
																
																	if(!empty($this->results5['doi_weight'])){	
																		$this->view2 .= $this->results5['doi_weight'];
																	}else{
																		$this->view2 .= "&nbsp;";
																	}

																$this->view2 .= "</div>";
																
																$this->view2 .= "<div class='div_freight'>";
																
																//if($this->results5['doi_frieght'] = "0.00"){
																	$this->view2 .= "&nbsp;";
																//}else{
																//	$this->view2 .= $this->results5['doi_frieght'];
																//}
																
																$this->view2 .= "</div>";
															    
															    $this->view2 .= "<td>";
																$this->query_out6="select do_id, do_total_frieght from ymt_do where do_id='".$this->results2['do_id']."'";
																$this->execute6=$db1->query($this->query_out6);
												
																while($this->results6=$db1->fetch_array($this->execute6))
												                {
														         $this->view2 .= "<div class='div_total_frieght'>";
															     if(!empty($this->results6['do_total_frieght'])){	
																		$this->view2 .= $this->results6['do_total_frieght'];
																	
																	    $total=$this->results6['do_total_frieght'] + $total;
																	}else{
																		$this->view2 .= "&nbsp;";
																	}
																$this->view2 .= "</div>";
														         }
															$this->view2 .="</td>";
															
															$this->doicnt += 1;
															
														}/********** while closing **********/
														
													}else{
														$this->doicnt += 1;
													}
													
												
												if($this->doicnt % 16 == 0){
													$this->view2 .= "<tr>";
														$this->view2 .= "<td colspan='5' height='260'>";
															//$this->view2 .= "<div style='clear: both; width: 670px; height: 260px;'>&nbsp;</div>";
															$this->view2 .= "&nbsp;";
														$this->view2 .= "</td>";
													$this->view2 .= "</tr>";
												}

												$this->view2 .= "</div>";/********** particulars table closing **********/
												//$this->view2 .= "</table>";/********** particulars table closing **********/
												//$this->view2 .= "<br>".$this->doicnt;

											$this->view2 .= "</td>";
										$this->view2 .= "</tr>";


									}/********** while closing **********/


								$this->view2 .= "</tbody>";

                                 

								$this->view2 .= "<tfoot>";

									$this->view2 .= "<tr>";
										$this->view2 .= "<td colspan='9' rowspan='2'>";
											$this->view2 .= "Remarks : ";								
										$this->view2 .= "</td>";
										$this->view2 .= "<td>";
											$this->view2 .= "<strong>TOTAL</strong>"."";
										$this->view2 .= "</td>";
										$this->view2 .= "<td>";
										$this->view2 .= "$total";
										$this->view2 .= "</td>";
										//$this->view2 .= "<td>&nbsp;</td>";
									$this->view2 .= "</tr>";
									$this->view2 .= "<tr>";
										$this->view2 .= "<td colspan='2' style='border-right: 1px solid #fff;' >&nbsp;</td>";
									$this->view2 .= "</tr>";

								$this->view2 .= "</tfoot>";

							$this->view .= $this->view2."</table>";/********** table closing **********/


						}else{/********** if($this->lsght_local_otstn == 0) closing **********/


							$this->view2 .= "<table class='table table-bordered table-lgsht_content' style='font-size: 11px; margin-top: 10px;'>";
								$this->view2 .= "<thead>";
									$this->view2 .= "<tr>";
										$this->view2 .= "<th style='width: 100px;'>D/O NO</th>";
										$this->view2 .= "<th style='width: 200px;'>DELIVERY TO</th>";
										$this->view2 .= "<th style='width: 200px;'>CUSTOMER CHOP & SIGN</th>";
										$this->view2 .= "<th style='width: 150px;'>REMARKS</th>";
									$this->view2 .= "</tr>";
								$this->view2 .= "</thead>";


								$this->view2 .= "<tbody>";

									/********** Getting logsheet content information **********/
									while($this->results2 = $db1->fetch_array($this->execute2)){/********** while opening **********/

										$this->view2 .= "<tr>";
											$this->view2 .= "<td>".$this->results2['do_no']."</td>";

											$this->view2 .= "<td>";

												/**********  get the consignor info **********/
												$this->query_out4 = "select client_id, client_name from ymt_client where client_id='".$this->results2['do_consignee']."'";
												//echo "3rd-> $this->query_out3";
												$this->execute4 = $db1->query($this->query_out4);
												$this->results4 = $db1->fetch_assoc($this->execute4);


												$this->view2 .= "<div style='width: 190px; height: 100px; overflow: hidden; text-align: left;'>";

													/* if(strlen($this->results4['client_name']) > 20){
														$this->view2 .= substr($this->results4['client_name'],0,20);
													}else{ */
														$this->view2 .= "<strong>".$this->results4['client_name']."</strong>";
													//}

													$this->view2 .= "<br />".$this->results2['do_deliver_to2'];
												$this->view2 .= "</div>";

											$this->view2 .= "</td>";

											$this->view2 .= "<td>&nbsp;</td>";
											$this->view2 .= "<td>&nbsp;</td>";
										$this->view2 .= "</tr>";


									}/********** while closing **********/
									
									if($db1->num_rows($this->execute2) < 9){
										
										for($this->localdocnt = 0; $this->localdocnt < (8 - $db1->num_rows($this->execute2)); $this->localdocnt++){
											
											$this->view2 .= "<tr>";
												$this->view2 .= "<td>&nbsp;</td>";
												$this->view2 .= "<td>";

													$this->view2 .= "<div style='width: 190px; height: 100px; overflow: hidden; text-align: left;'>";
														$this->view2 .= "&nbsp;";
													$this->view2 .= "</div>";

												$this->view2 .= "</td>";

												$this->view2 .= "<td>&nbsp;</td>";
												$this->view2 .= "<td>&nbsp;</td>";
											$this->view2 .= "</tr>";
											
										}
										
									}


								$this->view2 .= "</tbody>";


							$this->view .= $this->view2."</table>";/********** table closing **********/


						}/********** if($this->lsght_local_otstn == 0) else closing **********/


					}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/
				
			
				$this->view .= "</div>";/**** .col-xs-12 closing ****/
				
			$this->view .= "</div>";/**** .row closing ****/
			$this->view .= "<!-- CONTENT INFO END -->";
			
			
			
			$this->view .= "<!-- FOOTER INFO START -->";
			$this->view .= "<div class='row'>";

				$this->view .= "<div class='col-md-12 col-xs-12 lsprint_padding_right_0'>";

					$this->view .= "<p>";
						$this->view .= "I undertake full responsibility of the goods loaded into my lorry, and found them correct and in good condition. <br />";
						$this->view .= "And also undertake to deliver each article to its proper owner at destination without fail.";
					$this->view .= "</p>";
					
					$this->view .= "<p>";
						$this->view .= "Saya setuju bertanggungjawab sepenuhnya ke atas barang-barang yang telah dimuatkan ke dalam lori saya dan mengesahkan bahawa barangan tersebut adalah betul dan berada di dalam keadaan yang baik. ";
						$this->view .= "Dan akan bertanggungjawab untuk menghantar setiap barang kepada pemiliknya di destinasi yang betul tanpa melakukan kesilapan.";
					$this->view .= "</p>";

				$this->view .= "</div>";/**** .col-xs-12 closing ****/

			$this->view .= "</div>";/**** .row closing ****/
			
			$this->view .= "<div class='row' style='margin-top: 50px;'>";

				$this->view .= "<div class='col-md-5 col-xs-5 lsprint_padding_right_0'>";

					$this->view .= "<p>";
						$this->view .= "Signature Of Driver  ________________________________________ ";
					$this->view .= "</p>";

				$this->view .= "</div>";/**** .col-xs-12 closing ****/
				
				$this->view .= "<div class='col-md-5 col-xs-5 lsprint_padding_right_0'>";

					$this->view .= "<p>";
						$this->view .= "Approved By  ________________________________________ ";
					$this->view .= "</p>";

				$this->view .= "</div>";/**** .col-xs-12 closing ****/

				$this->view .= "<div class='col-md-2 col-xs-2 lsprint_padding_right_0'>";

					$this->view .= "<p>";
						$this->view .= "Advance :  _________";
					$this->view .= "</p>";

				$this->view .= "</div>";/**** .col-xs-12 closing ****/

			$this->view .= "</div>";/**** .row closing ****/
			$this->view .= "<!-- FOOTER INFO END -->";
			
			
		
		$this->view2 .= "</div>";
		/********** lgsht wrapper (end) 08092012 **********/
		

		return $this->view;
	}



	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF REVIEWING LOGSHEET ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_review($logsheet_id, $logsheet_no, $adm_id, $adm_dept, $adm_branch, $adm_permission, $process, $option, $odr_id, $odr_no){
		//echo "<p>wir: $logsheet_id, $logsheet_no, $adm_id, $adm_dept, $adm_branch, $adm_permission, $process, $option, $odr_id, $odr_no</p>";
		global $db1,$useripadd, $php_time, $php_date, $php_date_14dys_b4, $php_date_7dys_b4, $pg_lftmenu_lgsht, $pg_lftmenu_do, $pg_lftmenu_lorry, $pg_lftmenu_client, $deviceType;
		
		$this->query_out	= $query_out;
		$this->execute		= $execute;
		$this->results		= $results;
		$this->query_out2	= $query_out2;
		$this->execute2		= $execute2;
		$this->results2		= $results2;
		$this->query_out3	= $query_out3;
		$this->execute3		= $execute3;
		$this->results3		= $results3;
		$this->query_out4	= $query_out4;
		$this->execute4		= $execute4;
		$this->results4		= $results4;
		$this->query_out5	= $query_out5;
		$this->execute5		= $execute5;
		$this->results5		= $results5;
		$this->query_out6	= $query_out6;
		$this->execute6		= $execute6;
		$this->results6		= $results6;
		$this->query_out7	= $query_out7;
		$this->execute7		= $execute7;
		$this->results7		= $results7;
				
		$this->adm_id			= $adm_id;
		$this->adm_dept			= $adm_dept;
		$this->adm_branch		= $adm_branch;
		$this->adm_permission 	= $adm_permission;
		
		
		$this->logsheet_id 	= $logsheet_id;
		$this->logsheet_no 	= ($deviceType <> "computer") ? " No: ".$logsheet_no : " Log Sheet No: ".$logsheet_no;
		$this->process	 	= $process;
		$this->option 		= $option;
		$this->odr_id	 	= $odr_id;
		$this->odr_no	 	= $odr_no;
		
		$this->pg_lftmenu_lgsht = $pg_lftmenu_lgsht;
		$this->pg_lftmenu_do	= $pg_lftmenu_do;
		$this->pg_lftmenu_lorry = $pg_lftmenu_lorry;
		$this->pg_lftmenu_client= $pg_lftmenu_client;
		
		
		$this->full_date 			= $php_time;
		$this->php_date 			= $php_date;
		$this->php_date_14dys_b4 	= $php_date_14dys_b4;
		$this->php_date_7dys_b4 	= $php_date_7dys_b4;
		
		
		$this->ls_crnt_status	= "";
		$this->datedeliver_exp	= "";
		$this->lsadv2show		= "";
		
		
		$this->view .= "<div class='portlet box purple'>";
				
			$this->view .= "<div class='portlet-title'>";
				$this->view .= "<div class='caption'><i class='icon-reorder'></i>";
					$this->view .= ($deviceType <> "computer") ? "Update L/S " : "Update Logsheet";
				$this->view .= "</div>";/**** .caption closing ****/

				$this->view .= "<div class='caption2'>".$this->logsheet_no.$this->deviceType."</div>";/**** .caption2 closing ****/
				
			$this->view .= "</div>";/**** .portlet-title closing ****/


			$this->view .= "<div class='portlet-body form'>";


				/**********  verify the logsheet existence **********/
				//$this->query_out = "select a.ls_id, a.ls_branch, a.ls_no, a.ls_driver, a.ls_issued_date, a.ls_delivery_date, date_format(ls_issued_date, '%d %M %Y') as date_issued, date_format(ls_delivery_date, '%d %M %Y') as date_deliver, a.ls_trip_no, a.ls_destination_branch, a.ls_advance, a.ls_backdate, a.ls_issued_by, c.lorry_id, c.lorry_regno from ymt_logsheet a, ymt_lorry c where a.ls_lorry_no = c.lorry_id and ls_id='$this->logsheet_id' and ls_status = 1";
				$this->query_out = "select ls_id, ls_branch, ls_no, ls_lorry_no, ls_driver, ls_issued_date, ls_delivery_date, date_format(ls_issued_date, '%d %M %Y') as date_issued, date_format(ls_delivery_date, '%d %M %Y') as date_deliver, ls_trip_no, ls_destination_branch, ls_advance, ls_backdate, ls_issued_by, ls_approved_by, ls_remarks from ymt_logsheet where ls_id='$this->logsheet_id' and ls_status = 1";
				//echo "<p>Q1 chk-> $this->query_out</p>";

				$this->execute = $db1->query($this->query_out);

				/**********  getting the logsheet result **********/
				if ($db1->num_rows($this->execute) == 0){
					$this->view = "xlogsheet";
				}else{

					/********** Getting logsheet information **********/
					$this->results = $db1->fetch_assoc($this->execute);


					if($this->option == "del_item" || $this->process == "logsheet_update" || $this->process == "logsheet_info" ){
						$this->view .= "<form name='logsheet_detail' id='logsheet_detail' class='form-horizontal form-bordered form-row-stripped' method='post' action='' >";
					}else{
						$this->view .= "<div class='form-horizontal form-bordered form-row-stripped'>";
					}


						if($this->results['do_status'] == 0){
							$this->view .= "<div style='background: url(../images/cancelled_watermarked.gif) no-repeat 50% 20%; width: 100%; height: 100%;' >";
						}


						$this->view .= "<div class='form-body'>";


							$this->view .= "<div class='form-group'>";

								$this->view .= "<label class='control-label col-md-2 col-xs-4'>Lorry No</label>";
								$this->view .= "<div class='col-md-4 col-xs-8'>";


									$this->query_out_lry = "select lorry_id, lorry_regno from ymt_lorry where lorry_status = 1 order by lorry_regno asc";
									//echo "<p>Q2 Lry-> $this->query_out_lry</p>";
									$this->execute_lry = $db1->query($this->query_out_lry);
									$this->view .= "<select name='lorry_assigned' id='lorry_assigned' class='form-control'>";

										$this->view .= "<option value='EMPTY' ";
										if ($this->results['ls_lorry_no'] == 0 || $_REQUEST['lorry_assigned'] == "EMPTY"){			$this->view .= " selected='selected' ";			}
										$this->view .= " >EMPTY</option>";

										while($this->results_lry = $db1->fetch_array($this->execute_lry)){
											$this->view .= "<option value='".$this->results_lry['lorry_id']."'";

											if($this->results_lry['lorry_id'] == $this->results['ls_lorry_no']){ //dass add on 01052016 bug fixed (start)
												$this->view .= " selected='selected' ";		
											}//dass add on 01052016 bug fixed (end)

											$this->view .= " >".$this->results_lry['lorry_regno']."</option>";
										}/********** while($this->results_lry = $db1->fetch_array($this->execute_lry)) closing **********/

									$this->view .= "</select>&nbsp;&nbsp;";

									if($this->option == "del_item" || $this->process == "logsheet_update" || $this->process == "logsheet_info"){
										$this->view .= "<input type='hidden' name='ls_lryid_ori' value='".$this->results['ls_lorry_no']."'>";
										$this->view .= "<input type='hidden' name='ls_lryregno_ori' value='".$this->results_lry['lorry_regno']."'>";
									}

									/* $this->view .= "<p class='form-control-static'>";

										$this->view .= "<strong style='color: #000;'><a href='".$this->pg_lftmenu_lorry['link_10']."&lry_id=".$this->results['lorry_id']."&lry_regno=".$this->results['lorry_regno']."' ";

										if($this->results['ls_backdate'] == 1){
											$this->view .= " style='color: #000000;'";
										}

										$this->view .= ">".$this->results['lorry_regno']."</a></strong>";

									$this->view .= "</p>"; */

								$this->view .= "</div>";/**** .col-md-4 closing ****/


							if($deviceType <> "computer"){
								$this->view .= "</div>";/**** .form-group closing ****/
								$this->view .= "<div class='form-group'>";
							}

								$this->view .= "<label class='control-label col-md-2 col-xs-4'>Dest & Trip No</label>";
								$this->view .= "<div class='col-md-4 col-xs-8'>";

									$this->view .= "<select name='destination_branch' id='destination_branch' size='1' class='form-control input-small floatleft' />";

										$this->view .= "<option value='EMPTY' ";				
											if($this->results['ls_destination_branch'] == "EMPTY"){		$this->view .= " selected='selected' ";		}
										$this->view .= " >EMPTY</option>";

										$this->view .= "<option value='JB' ";				
											if($this->results['ls_destination_branch'] == "JB"){		$this->view .= " selected='selected' ";		}
										$this->view .= " >JB</option>";

										$this->view .= "<option value='KL' ";				
											if($this->results['ls_destination_branch'] == "KL"){		$this->view .= " selected='selected' ";		}
										$this->view .= " >KL</option>";

										$this->view .= "<option value='BM' ";				
											if($this->results['ls_destination_branch'] == "BM"){		$this->view .= " selected='selected' ";		}
										$this->view .= " >BM</option>";

										$this->view .= "<option value='SP' ";				
											if($this->results['ls_destination_branch'] == "SP"){		$this->view .= " selected='selected' ";		}
										$this->view .= " >SP</option>";

									$this->view .= "</select>";

									$this->view .= "&nbsp;&nbsp;<strong style='color: #000; margin-left: 8px; font-size : 18px; margin-top: 4px;' class='floatleft'>".$this->results['ls_trip_no']."</strong>";
									$this->view .= "<div class='clearfix'>&nbsp;</div>";
									$this->view .= "<input type='hidden' name='lsid' id='lsid' value='".$this->results['ls_id']."' size='3'>";


									$this->ls_crnt_status	= (empty($this->results['ls_destination_branch']) || $this->results['ls_destination_branch'] == "EMPTY") ? "temp" : "real";

										$this->view .= "<input type='hidden' name='page_now' id='page_now' value='".$this->ls_crnt_status."'>";
										$this->view .= "<input type='hidden' name='origin_branch' id='origin_branch' value='".$this->results['ls_branch']."'>";
										$this->view .= "<input type='hidden' name='update_dest_advance' id='update_dest_advance' value='confirm'>";
										$this->view .= "<input type='hidden' name='starting_date' id='starting_date' value='".$php_time."'>";

										if($this->view_type == "= 0"){
											$this->view .= "<input type='hidden' name='lgsht_type_now' id='lgsht_type_now' value='temp_logsheet'>";
										}

										if($this->view_type == "> 0"){
											$this->view .= "<input type='hidden' name='lgsht_type_now' id='lgsht_type_now' value='real_logsheet'>";
										}


								$this->view .= "</div>";/**** .col-md-9 closing ****/

							$this->view .= "</div>";/**** .form-group closing ****/


							$this->view .= "<div class='form-group'>";

								$this->view .= "<label class='control-label col-md-2 col-xs-4'>Issued Date (By)</label>";
								$this->view .= "<div class='col-md-4 col-xs-8'>";

									$this->view .= "<p class='form-control-static'>";

										$this->view .= $this->results['date_issued'];
										$this->view .= "<input type='hidden' name='lgsht_issued_date' id='lgsht_issued_date' value='".$this->results['ls_issued_date']."'>";

										$this->query_out_admin = "Select admin_id, admin_name from ymt_admin where admin_id = '".$this->results['ls_issued_by']."' and admin_status = 1";
										//echo "<p>Q3 issuer-> $this->query_out_admin</p>";
										$this->execute_admin = $db1->query($this->query_out_admin);

										if($db1->num_rows($this->execute_admin) > 0){
											$this->results_admin = $db1->fetch_assoc($this->execute_admin);
											$this->view .= " (".$this->results_admin['admin_name'].")";
										}else{
											$this->view .= "Admin In-Active";
										}

									$this->view .= "</p>";

								$this->view .= "</div>";/**** .col-md-9 closing ****/

							if($deviceType <> "computer"){
								$this->view .= "</div>";/**** .form-group closing ****/
								$this->view .= "<div class='form-group'>";
							}

								$this->view .= "<label class='control-label col-md-2 col-xs-4'>Delivery Date (By)</label>";
								$this->view .= "<div class='col-md-4 col-xs-8'>";

									$this->datedeliver_exp = explode("-",$this->results['ls_delivery_date']);

									$this->view .= "<select class='form-control input-small' name='dlvr_date_only' style='display: inline-block; margin-right: 8px;'>";

									for($this->datecnt = 1;$this->datecnt < 32; $this->datecnt++){
										$this->view .= "<option value='".$this->datecnt."' ";

										if($this->datecnt == $this->datedeliver_exp[2]){	$this->view .= " selected='selected' ";	}
										$this->view .= " >";

										$this->view .= $this->datecnt;
										$this->view .= "</option>";
									}

									$this->view .= "</select> - ";

									$this->view .= "<select class='form-control input-small' name='dlvr_mth_only' style='display: inline-block; margin-right: 8px;'>";

									for($this->mthcnt = 1;$this->mthcnt < 13; $this->mthcnt++){
										$this->view .= "<option value='".$this->mthcnt."' ";

										if($this->mthcnt == $this->datedeliver_exp[1]){	$this->view .= " selected='selected' ";	}
										$this->view .= " >";

										$this->view .= $this->mthcnt;
										$this->view .= "</option>";
									}

									$this->view .= "</select> - ";


									$this->view .= "<select class='form-control input-small' name='dlvr_yr_only'  style='display: inline-block;'>";

									for($this->yrcnt = 2015;$this->yrcnt < 2022; $this->yrcnt++){
										$this->view .= "<option value='".$this->yrcnt."' ";

										if($this->yrcnt == $this->datedeliver_exp[0]){	$this->view .= " selected='selected' ";	}
										$this->view .= " >";

										$this->view .= $this->yrcnt;
										$this->view .= "</option>";
									}

									$this->view .= "</select>";

									$this->view .= "<div class='clearfix'></div>";/**** .col-md-9 closing ****/


								$this->view .= "</div>";/**** .col-md-9 closing ****/

							$this->view .= "</div>";/**** .form-group (Dest) closing ****/


							$this->view .= "<div class='form-group'>";

								$this->view .= "<label class='control-label col-md-2'>Driver</label>";
								$this->view .= "<div class='col-md-4'>";

									$this->query_out6 = "select driver_id, driver_branch, driver_route, driver_name, driver_mobile, driver_lorry_no from ymt_driver where driver_name != '' and driver_nature = 'Driver' and driver_active = 1 order by driver_name asc";
									//echo "<p>Q5 drv-> $this->query_out6</p>";
									$this->execute6 = $db1->query($this->query_out6);
									$this->view .= "<select name='driver_assigned' id='driver_assigned' class='form-control'>";

										$this->view .= "<option value=''";
										if ($this->results['ls_driver'] == 0){			$this->view .= " selected='selected' ";			}
										$this->view .= " >&nbsp;</option>";

										while($this->results6 = $db1->fetch_array($this->execute6)){/********** while opening **********/
											$this->view .= "<option value='".$this->results6['driver_id']."'";

											if(($this->results6['driver_lorry_no'] == $this->results['lorry_id']) && $this->results['ls_driver'] == 0){	
												$this->view .= " selected='selected' ";		$this->driverroute = $this->results6['driver_route'];
											}elseif($this->results6['driver_id'] == $this->results['ls_driver']){	//dass add on 22032012 bug fixed (start)
												$this->view .= " selected='selected' ";		$this->driverroute = $this->results6['driver_route'];
											}//dass add on 22032012 bug fixed (end)

											$this->view .= " >".$this->results6['driver_name']."</option>";
										}

									$this->view .= "</select>&nbsp;&nbsp;";

								$this->view .= "</div>";/**** .col-md-9 closing ****/


								$this->view .= "<label class='control-label col-md-2'>Attendant</label>";
								$this->view .= "<div class='col-md-4'>";

									$this->query_out6_6 = "select driver_id, driver_branch, driver_route, driver_name, driver_mobile, driver_lorry_no from ymt_driver where driver_name != '' and driver_nature = 'Attendant' and driver_active = 1 order by driver_name asc";
									//echo "<p>Q6 attendant-> $this->query_out6_6</p>";
									$this->execute6_6 = $db1->query($this->query_out6_6);
									$this->view .= "<select name='driver_attendant_assigned' id='driver_attendant_assigned' class='form-control'>";

										$this->view .= "<option value=''";
										if ($this->results['ls_driver'] == 0){			$this->view .= " selected='selected' ";			}
										$this->view .= " >&nbsp;</option>";

										while($this->results6_6 = $db1->fetch_array($this->execute6_6)){/********** while opening **********/

											$this->view .= "<option value='".$this->results6_6['driver_id']."'";

											if(($this->results6_6['driver_lorry_no'] == $this->results['lorry_id']) && $this->results['ls_driver'] == 0){	
												$this->view .= " selected='selected' ";		$this->driverroute = $this->results6_6['driver_route'];
											}elseif($this->results6_6['driver_id'] == $this->results['ls_driver']){	//dass add on 22032012 bug fixed (start)
												$this->view .= " selected='selected' ";		$this->driverroute = $this->results6_6['driver_route'];
											}//dass add on 22032012 bug fixed (end)

											$this->view .= " >".$this->results6_6['driver_name']."</option>";

										}

									$this->view .= "</select>";

								$this->view .= "</div>";/**** .col-md-9 closing ****/

							$this->view .= "</div>";/**** .form-group (Attendant) closing ****/


							$this->view .= "<div class='form-group'>";

								$this->view .= "<label class='control-label col-md-2 col-xs-4'>Advance (RM)</label>";
								$this->view .= "<div class='col-md-4 col-xs-8'>";


									//get petty cash 4related lorry
									$this->query_out_pcash 	 = "select pay_id, pay_no, pay_debit, pay_lgsht, pay_lgsht_id, pay_rec_date, date_format(pay_rec_date, '%d %M %Y') as vchr_issued_on from ymt_pettycash where pay_trans_type = 3010 and pay_status = 1 and pay_lry = ".$this->results['ls_lorry_no']." and pay_rec_date between '".$this->php_date_7dys_b4."' and '".$this->php_date."' order by pay_no asc";
									//echo "<p>Q7 -> $this->query_out_pcash</p>";
									$this->execute_pcash 	= $db1->query($this->query_out_pcash);

									if($db1->num_rows($this->execute_pcash) > 0){

										$this->view .= "<select name='petty_cash_adv_voucher' id='petty_cash_adv_voucher' class='form-control input-medium' style='display: inline-block; margin-right: 8px;'>";

											while($this->results_pcash = $db1->fetch_array($this->execute_pcash)){
												$this->view .= "<option value='".$this->results_pcash['pay_id']."^".$this->results_pcash['pay_debit']."'";

												if($this->results_pcash['pay_lgsht_id'] == $this->results['ls_id']){	
													$this->view .= " selected='selected' ";		
												}
												$this->view .= " >".$this->results_pcash['pay_debit']. " (".$this->results_pcash['pay_no']." - ".$this->results_pcash['vchr_issued_on'].")</option>";
											}

										$this->view .= "</select>";
										
									}

									$this->view .= "<input type='text' name='advance_cash' id='advance_cash' class='form-control input-small' value='".$this->results['ls_advance']."' style='display: inline-block;' />";


								$this->view .= "</div>";/**** .col-md-9 closing ****/


							if($deviceType <> "computer"){
								$this->view .= "</div>";/**** .form-group closing ****/
								$this->view .= "<div class='form-group'>";
							}

								/* check if no of item of tat logsheet is more tan 16 (start) - 08092012  */
								$this->lgsht_no_itm	= 0;
								$this->itmcntstart 	= 1;
								$this->prnt_link_extra = "";

								$this->query_out_lgsht_no_itm 	= "select lsi_id, lsi_ls_id, lsi_do_id from ymt_logsheet_item where lsi_ls_id = '".$this->results['ls_id']."' and lsi_status = 1";
								//echo "<p>Q7 print_itm cal-> $this->query_out_lgsht_no_itm</p>";
								$this->execute_lgsht_no_itm 	= $db1->query($this->query_out_lgsht_no_itm);
								if($db1->num_rows($this->execute_lgsht_no_itm) > 0 ){

									//echo "lgsht cnt : ".$db1->num_rows($this->execute_lgsht_no_itm)."  for lg id : ".$this->results['ls_id']." --> ";

									while($this->results_lgsht_no_itm = $db1->fetch_array($this->execute_lgsht_no_itm)){

										$this->lgshtid_cnted = $this->results_lgsht_no_itm['lsi_ls_id'];
										$this->query_out_do_no_itm 	= "select doi_id from ymt_do_item where doi_do_id = '".$this->results_lgsht_no_itm['lsi_do_id']."' ";
										//echo "<p>3rd - 3-> $this->query_out_do_no_itm</p>";
										$this->execute_do_no_itm 	= $db1->query($this->query_out_do_no_itm);

										if($db1->num_rows($this->execute_do_no_itm) > 0 ){
											//echo "do cnt : ".$db1->num_rows($this->execute_do_no_itm)." for lg id : ".$this->results['ls_id']."<br>";
											$this->lgsht_no_itm	+= $db1->num_rows($this->execute_do_no_itm);
										}else{
											$this->lgsht_no_itm++;
										}

										//echo "<p><strong>final cnt : $this->itmcntstart) ".$this->lgsht_no_itm."</strong> for lg id : ".$this->results['ls_id']."<br>";
										$this->itmcntstart++;

									}/********** while($this->results_lgsht_no_itm = $db1->fetch_array($this->execute_lgsht_no_itm)) closing **********/


								}else{
									$this->lgsht_no_itm = 0;
								}					
								/* check if no of item of tat logsheet is more tan 16 (end) - 08092012  */

								if($this->lgsht_no_itm > 16 && $this->lgshtid_cnted == $this->results['ls_id']){		$this->prnt_link_extra = "&pg=break";		}

								
								
								$this->view .= "<label class='control-label col-md-2'>&nbsp;</label>";
								$this->view .= "<div class='col-md-4'>";

									$this->view .= "<p class='form-control-static'>";

										$this->view .= "<a href='".$this->pg_lftmenu_lgsht['link_41']."&ls_id=".$this->results['ls_id'].$this->prnt_link_extra."&itm=".$this->lgsht_no_itm."' target='_blank' >";
											$this->view .= "<img src='images/print.png' style='text-decoration: none;border: 2px solid green; '>";
										$this->view .= "</a>";


										$this->view .= "<input type='hidden' name='page_now' id='page_now' value='temp'>";
										$this->view .= "<input type='hidden' name='origin_branch' id='origin_branch' value='".$this->results['ls_branch']."'>";
										$this->view .= "<input type='hidden' name='update_dest_advance' id='update_dest_advance' value='confirm'>";
										$this->view .= "<input type='hidden' name='starting_date' id='starting_date' value='".$php_time."'>";

										if($this->view_type == "= 0"){
											$this->view .= "<input type='hidden' name='lgsht_type_now' id='lgsht_type_now' value='temp_logsheet'>";
										}

										if($this->view_type == "> 0"){
											$this->view .= "<input type='hidden' name='lgsht_type_now' id='lgsht_type_now' value='real_logsheet'>";
										}	


									$this->view .= "</p>";

								$this->view .= "</div>";/**** .col-md-9 closing ****/

							$this->view .= "</div>";/**** .form-group (Advance) closing ****/


						$this->view .= "</div>";/**** .form-body closing ****/


						$this->view .= "<div class='clearfix' >&nbsp;</div>";



						/**********  today's logsheet info **********/
						$this->query_out2 = "SELECT lsi_id, lsi_do_id  FROM `ymt_logsheet_item` WHERE lsi_ls_id = '".$this->results['ls_id']."' and lsi_status = 1";
						//echo "<p>Q8 LS Item-> $this->query_out2</p>";
						$this->execute2 = $db1->query($this->query_out2);

						$this->no_content = 1;     


						/**********  getting the logsheet result **********/
						if ($db1->num_rows($this->execute2) == 0){
							$this->view .= "<div class='alert alert-danger'>";
								$this->view .= "<strong>Error!</strong>";
								$this->view .= "<p>There is no Record available on selected date</p>";
							$this->view .= "</div><!-- notification danger -->";

							$this->record_found_today = "no";
						}else{
							
							
							if($this->option == "del_item" && ($this->process == "logsheet_update" || $this->process == "logsheet_info" )){
								$this->view .= "<div class='alert alert-warning'>";
									$this->view .= "<strong>Warning!</strong>";
									$this->view .= "<p>Are you sure you want to remove this D/O No : <strong>".$this->odr_no."</strong> ?</p>";
								$this->view .= "</div><!-- notification msgalert -->";
							}
							
							
							
							if($this->option == "add_item" && ($this->process == "logsheet_update" || $this->process == "logsheet_info" )){
								
								/********** add item or D/O to logsheet (start) **********/
								$this->query_out_add_emty_do = "select a.do_id, a.do_branch, a.do_no, a.do_collect_frm, a.do_deliver_to, a.do_deliver_to2, a.do_issued_by, a.do_issued_date, date_format(do_issued_date, '%d %b %Y') as date_issued, date_format(do_issued_date, '%d-%m-%Y') as date_issued2, date_format(do_delivery_date, '%d %M %Y') as date_delivery, a.do_status, a.do_consignor, a.do_consignee, a.do_lorry_no from ymt_do a where do_issued_date <= '$this->date_shj' and do_issued_date >= '".$this->php_date_14dys_b4."' and do_branch = '$this->adm_branch' and do_status = 1 and do_lorry_no = 0 and do_local = 0 order by do_no desc";
								//echo "<p>Q9 LS Add Item-> $this->query_out_add_emty_do</p>";
								/********** add item or D/O to logsheet (end) **********/
								
								
								$this->view .= "<div class='alert alert-info'>";
									$this->view .= "<strong>Info</strong>";
									$this->view .= "<p>Are you sure you want to add these D/O to your current logsheet ?</p>";
								$this->view .= "</div><!-- notification msginfo -->";
							}
						
							if($deviceType <> "computer"){	$this->view .= "<div class='table-responsive'' style='padding: 10px;' >";	}
							
								$this->view .= "<table class='table table-bordered table-striped table-condensed'>";
									$this->view .= "<thead>";
										$this->view .= "<tr>";
										$this->view .= "<th class='numeric width_5_prcnt'>#</th>";
										$this->view .= "<th class='numeric width_10_prcnt'>DO No</th>";
										$this->view .= "<th class='width_5_prcnt'>From</th>";
										$this->view .= "<th class='width_5_prcnt'>To</th>";
										$this->view .= "<th class='width_15_prcnt'>Consignor</th>";
										$this->view .= "<th class='width_15_prcnt'>Consignee</th>";
										$this->view .= "<th class='width_25_prcnt'>Description</th>";
										$this->view .= "<th class='numeric width_5_prcnt'>Qty</th>";
										$this->view .= "<th class='numeric width_5_prcnt'>UOM</th>";
										$this->view .= "<th class='numeric width_5_prcnt'>Weight</th>";		
									$this->view .= "</tr>";
									$this->view .= "</thead>";

									$this->view .= "<tbody>";

									/********** Getting logsheet information **********/
									while($this->results2 = $db1->fetch_array($this->execute2)){

										$this->view .= "<tr>";

											$this->view .= "<td>";
												$this->view .= $this->no_content;//running no
											$this->view .= "</td>";

											$this->view .= "<td>";

												$this->query_out7 = "select do_id, do_no from ymt_do where do_id = '".$this->results2['lsi_do_id']."' and do_status = 1";
												//echo "<p>Q10 LS Item D/O No-> $this->query_out7</p>";
												$this->execute7 = $db1->query($this->query_out7);
												$this->results7 = $db1->fetch_assoc($this->execute7);
												$this->view .= "<a href='".$this->pg_lftmenu_do['link_10']."&dorder_id=".$this->results7['do_id']."' ";

												if($this->results['ls_backdate'] == 1){		$this->view .= " style='color: #5BC236;'";			}	
												$this->view .= ">".$this->results7['do_no']."</a>&nbsp;&nbsp;";								


												if($this->option == "" && ($this->process == "logsheet_update" || $this->process == "logsheet_info" || $this->process == "" )){

													$this->view .= "<a href='".$this->pg_lftmenu_lgsht['link_15']."&dorder_id=".$this->results7['do_id']."&ls_id=".$this->results['ls_id']."' class='btn btn3 btn_trash' title='delete this D/O from the logsheet' alt='delete tis D/O from the logsheet'>";	
														$this->view .= "&nbsp;";
													$this->view .= "</a>&nbsp;&nbsp;";

												}

											$this->view .= "</td>";


											/********** grb ls item info frm do item **********/
											$this->query_out20 = "SELECT do_id, do_no, do_consignor, do_collect_frm, do_consignee, do_deliver_to, do_deliver_to2 FROM `ymt_do` WHERE do_id = '".$this->results2['lsi_do_id']."' and do_status = 1 ";
											//echo "<p>Q11 LS Item D/O No-> $this->query_out20</p>"; //echo "<p>1st-> $this->query_out2</p>";
											$this->execute20 = $db1->query($this->query_out20);
											$this->results20 = $db1->fetch_assoc($this->execute20);

											$this->view .= "<td>";
												$this->view .= $this->results20['do_collect_frm'];
											$this->view .= "</td>";
											$this->view .= "<td>";
												$this->view .= $this->results20['do_deliver_to2'];
											$this->view .= "</td>";

											$this->view .= "<td>";

												$this->query_out5 = "select client_id, client_name as consignee_name from ymt_client where client_id='".$this->results20['do_consignor']."' and (client_status = 1 || client_status = 3)";
												//echo "<p>5st-> $this->query_out_5</p>";
												$this->execute5 = $db1->query($this->query_out5);
												$this->results5 = $db1->fetch_array($this->execute5);
												$this->view .= "<a href='".$this->pg_lftmenu_client['link_10']."&clnt_id=".$this->results5['client_id']."' ";

												if($this->results['ls_backdate'] == 1){			$this->view .= " style='color: #5BC236;'";			}
												$this->view .= ">".$this->results5['consignee_name']."</a>";

											$this->view .= "</td>";		

											$this->view .= "<td>";

											$this->query_out3 = "select client_id, client_name as consignee_name from ymt_client where client_id='".$this->results20['do_consignee']."' and (client_status = 1 || client_status = 3)";
											//echo "<p>3st-> $this->query_out_3</p>";
											$this->execute3 = $db1->query($this->query_out3);
											$this->results3 = $db1->fetch_array($this->execute3);
											$this->view .= "<a href='".$this->pg_lftmenu_client['link_10']."&clnt_id=".$this->results3['client_id']."' ";

											if($this->results['ls_backdate'] == 1){			$this->view .= " style='color: #5BC236;'";			}
											$this->view .= ">".$this->results3['consignee_name']."</a>";

											$this->view .= "</td>";	
											
											
											$this->view .= "<td colspan='4'>"; 
											
											
												$this->view .= "<table class='table table-bordered table-condensed'>";
													$this->view .= "<tbody>";

														/**********  today's logsheet info **********/
														$this->query_out4 = "select doi_desc, doi_qty, doi_uom, doi_weight from ymt_do_item where doi_do_id = '".$this->results20['do_id']."' order by doi_id desc";
														//echo "<p>1st-> $this->query_out4</p>";
														$this->execute4 = $db1->query($this->query_out4);
														
														while($this->results4 = $db1->fetch_array($this->execute4)){/********** while opening **********/
															$this->view .= "<tr>";
																$this->view .= "<td class='width_63_prcnt'>".$this->results4['doi_desc']."</td>";
																$this->view .= "<td class='width_13_prcnt'>".$this->results4['doi_qty']."</td>";
																$this->view .= "<td class='width_13_prcnt'>".$this->results4['doi_uom']."</td>";
																$this->view .= "<td class='width_12_prcnt'>".$this->results4['doi_weight']."</td>";
															$this->view .= "</tr>";
														}
													$this->view .= "</tbody>";
														
												$this->view .= "</table>";/********** table of logsheet item record closing **********/
												

											$this->view .= "</td>";
											
										$this->view .= "</tr>";
										
										$this->no_content++;

									}/********** while($this->results2 = $db1->fetch_array($this->execute2)) closing **********/
									
									$this->view .= "</tbody>";

								$this->view .= "</table>";/********** D/O table closing **********/
								
								
								$this->view .= "<div class='form-body'>";

									$this->view .= "<div class='form-group'>";

										$this->view .= "<label class='control-label col-md-2'>Remarks <span class='required'>*</span></label>";
										$this->view .= "<div class='col-md-10'>";
	
											$this->view .= "<input type='text' name='lgsht_remarks' id='lgsht_remarks' class='form-control' value='' />";
											$this->view .= $this->results['ls_remarks'];


										$this->view .= "</div>";/**** .col-md-4 closing ****/

									$this->view .= "</div>";/**** .form-group closing ****/

								$this->view .= "</div>";/**** .form-body closing ****/
								
								
								
								
								
								
								
								
							
							if($deviceType <> "computer"){		$this->view .= "</div>";/**** .table-responsive closing ****/		}
					
						}/********** if ($db1->num_rows($this->execute2) == 0) closing **********/

					
					
						if($this->results['do_status'] == 0){		$this->view .= "</div> <!-- cancel div end -->";		}

								
								$this->view .= "<div class='form-actions fluid'>";
								
									$this->view .= "<div class='row'>";
									
										$this->view .= "<div class='col-md-12'>";
											
											$this->view .= "<div class='col-md-12'>";
									   
											if($this->option == "del_item" && ($this->process == "logsheet_update" || $this->process == "logsheet_info" )){
												$this->view .= "<button type='submit' class='btn red'>Confirm Remove this D/O</button>";
												$this->view .= "<input type='hidden' name='ls_id' value='".$this->logsheet_id."'>";
												$this->view .= "<input type='hidden' name='dorder_id' value='".$this->odr_id."'>";
												$this->view .= "<input type='hidden' name='delete_item' value='confirm'>";
											}elseif($this->option == "add_item" && ($this->process == "logsheet_update" || $this->process == "logsheet_info" )){
												$this->view .= "<button type='submit' class='btn green'>Confirm Add this D/O</button>";
												
												$this->view .= "<input type='hidden' name='ls_id' value='".$this->logsheet_id."'>";
												$this->view .= "<input type='hidden' name='dorder_id' value='".$this->odr_id."'>";
												$this->view .= "<input type='hidden' name='add_item' value='confirm'>";
											}else{
												$this->view .= "<button type='submit' class='btn green'>Update Logsheet</button>";
											}
									
											$this->view .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:history.go(-1)'><button type='button' class='btn default'>Back</button></a>";

											
											$this->view .= "</div>";/**** .col-md-offset-3 col-md-9 closing ****/
											
										$this->view .= "</div>";/**** .col-md-12 closing ****/
										
									$this->view .= "</div>";/**** .row closing ****/
									
								$this->view .= "</div>";/**** .form-actions fluid closing ****/
								
					
					if($this->option == "del_item" || $this->process == "logsheet_update" || $this->process == "logsheet_info" ){
						$this->view .= "</form>";
					}else{
						$this->view .= "</div>";
					}
					
					
				}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

				
				
				
				if(($this->option <> "cancel" && $this->option <> "add_item") && ($this->process == "logsheet_update" || $this->process == "logsheet_info")){
					
					$this->view .= "<div class='clearfix' >&nbsp;</div>";
				
					$this->view .= "<hr style='border: 3px solid #000;' />";
					
					$this->view .= "<h3 style='margin-left: 10px;'>Add Empty D/O to Logsheet</h3>";
			
					/********** add item or D/O to logsheet (start) **********/
					$this->query_out_emty_do = "select a.do_id, a.do_branch, a.do_no, a.do_collect_frm, a.do_deliver_to, a.do_deliver_to2,  a.do_issued_date, date_format(do_issued_date, '%d %b %Y') as date_issued, a.do_consignor, a.do_consignee from ymt_do a where do_issued_date <= '".$this->php_date."' and do_issued_date >= '".$this->php_date_14dys_b4."' and do_branch = '$this->adm_branch' and do_status = 1 and do_lorry_no = 0 and do_local = 0 order by do_no desc";
					//echo "<p>emty Do only Q: ".$this->query_out_emty_do."</p>";
					/********** add item or D/O to logsheet (end) **********/
					
					$this->execute_emty_do = $db1->query($this->query_out_emty_do);
					if ($db1->num_rows($this->execute_emty_do) > 0){
						
						$this->view .= "<form name='add_itm_logsheet' id='add_itm_logsheet' class='form-horizontal form-bordered form-row-stripped' method='post' action='".$this->pg_lftmenu_lgsht['link_14']."&ls_id=".$this->results['ls_id']."' style='margin-top: 20px;' >";
						
						
							$this->view .= "<div class='form-body' style='border-top: 1px solid #EFEFEF;'>";
								
								$this->view .= "<div class='form-group'>";
								
									$this->view .= "<label class='control-label col-md-3'>Empty D/O</label>";
									
									$this->view .= "<div class='col-md-9'>";
									
										$this->view .= "<select class='form-control' name='dorder_id' >";
										
											while($this->results_emty_do = $db1->fetch_array($this->execute_emty_do)){
											
												
												$this->query_out_cgnor = "select client_name from ymt_client where client_id = '".$this->results_emty_do['do_consignor']."' and (client_status = 1 || client_status = 3)";
												//echo "<p>cgnor Q: ".$this->query_out_cgnor."</p>";
												/********** add item or D/O to logsheet (end) **********/
												
												$this->execute_emty_cgnor = $db1->query($this->query_out_cgnor);
												if ($db1->num_rows($this->execute_emty_cgnor) > 0){
													$this->results_emty_cgnor = $db1->fetch_assoc($this->execute_emty_cgnor);
												}
												
												
												$this->query_out_cgnee = "select client_name from ymt_client where client_id = '".$this->results_emty_do['do_consignee']."' and (client_status = 1 || client_status = 3)";
												//echo "<p>cgnee Q: ".$this->query_out_cgnee."</p>";
												/********** add item or D/O to logsheet (end) **********/
												
												$this->execute_emty_cgnee = $db1->query($this->query_out_cgnee);
												if ($db1->num_rows($this->execute_emty_cgnee) > 0){
													$this->results_emty_cgnee = $db1->fetch_assoc($this->execute_emty_cgnee);
												}
												
												
												$this->view .= "<option value='".$this->results_emty_do['do_id']."'>";
													$this->view .= $this->results_emty_do['do_no']." [ ".$this->results_emty_cgnor['client_name']."  to ".$this->results_emty_cgnee['client_name']." ]";
												$this->view .= "</option>";
											}

										$this->view .= "</select>";
											
									$this->view .= "</div>";/**** .col-md-9 closing ****/
									
								$this->view .= "</div>";/**** .form-group closing ****/

							$this->view .= "</div>";/**** .form-body closing ****/

							

							$this->view .= "<div class='form-actions fluid'>";
						
								$this->view .= "<div class='row'>";
								
									$this->view .= "<div class='col-md-12'>";
										
										$this->view .= "<div class='col-md-12'>";
											
											$this->view .= "<button type='submit' class='btn purple'>Add D/O to Logsheet</button>";
											$this->view .= "<input type='hidden' name='lsid' value='".$this->results['ls_id']."'>";
											$this->view .= "<input type='hidden' name='add_ls_itm' value='confirm'>";
											$this->view .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:history.go(-1)'><button type='button' class='btn default'>Back</button></a>";
										
										$this->view .= "</div>";/**** .col-md-12 closing ****/
										
									$this->view .= "</div>";/**** .col-md-12 closing ****/
									
								$this->view .= "</div>";/**** .row closing ****/
								
							$this->view .= "</div>";/**** .form-actions fluid closing ****/
							
							
							
						$this->view .= "</form>";
					
					
					}/**** if ($db1->num_rows($this->execute_emty_do) > 0) closing ****/
					
				}/**** if(($this->option <> "cancel" && $this->option <> "add_item") && ($this->process == "logsheet_update" || $this->process == "logsheet_info")) closing ****/
				
				
				
				if(($this->option <> "cancel" && $this->option <> "del_item") && ($this->process == "logsheet_update" || $this->process == "logsheet_info" )){
					
					$this->view .= "<form name='delete_logsheet' method='post' action='".$this->pg_lftmenu_lgsht['link_11']."&ls_id=".$this->results['ls_id']."' class='form-horizontal form-bordered form-row-stripped' style='margin-top: 20px;' >";
						
						$this->view .= "<div class='form-actions fluid'>";
						
							$this->view .= "<div class='row'>";
							
								$this->view .= "<div class='col-md-12'>";
									
									$this->view .= "<div class='col-md-12'>";
										
										$this->view .= "<button class='btn red'>Delete Logsheet</button>";
										$this->view .= "<input type='hidden' name='lsid' value='".$this->results['ls_id']."'>";
										$this->view .= "<input type='hidden' name='delete_ls' value='confirm'>";
									
									$this->view .= "</div>";/**** .col-md-offset-3 col-md-9 closing ****/
									
								$this->view .= "</div>";/**** .col-md-12 closing ****/
								
							$this->view .= "</div>";/**** .row closing ****/
							
						$this->view .= "</div>";/**** .form-actions fluid closing ****/
						
						
						
					$this->view .= "</form>";
					
				}/**** if(($this->option <> "cancel" && $this->option <> "del_item") && ($this->process == "logsheet_update" || $this->process == "logsheet_info" )) closing ****/
				
				$this->view .= "<br />";
				
				
			
			$this->view .= "</div>";/**** .portlet-body form closing ****/
			
			
		$this->view .= "</div>";/**** .portlet box purple closing ****/
		

		return $this->view;
	}


	
	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF LISTING LOGSHEET ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_listing($adm_id, $adm_dept, $adm_branch, $adm_permission, $date_shj, $date_shj2, $date_shj3, $local_outstation, $pcash_status, $pcash_no, $lsht_id, $vcase, $view_type, $pgnow, $pg_log,$pg_name,$page_no,$order_type,$ordering,$filtering){
		//echo "<p>wir: $adm_id, $adm_dept, $adm_branch, $adm_permission, $date_shj, $date_shj2, $date_shj3, $local_outstation, $pcash_status, $pcash_no, $lsht_id, $vcase, $view_type, $pgnow, $pg_log,$pg_name,$page_no,$order_type,$ordering,$filtering</p>";
		global $db1,$useripadd,$php_time, $php_date, $pg_lftmenu_lgsht, $pg_lftmenu_do, $pg_lftmenu_lorry, $pg_lftmenu_client, $pg_lftmenu_petty_cash, $deviceType;

		$this->query_out	= $query_out;
		$this->execute		= $execute;
		$this->results		= $results;
		$this->query_out2	= $query_out2;
		$this->execute2		= $execute2;
		$this->results2		= $results2;
		$this->query_out3	= $query_out3;
		$this->execute3		= $execute3;
		$this->results3		= $results3;
		$this->query_out4	= $query_out4;
		$this->execute4		= $execute4;
		$this->results4		= $results4;
		$this->query_out5	= $query_out5;
		$this->execute5		= $execute5;
		$this->results5		= $results5;
		$this->query_out6	= $query_out6;
		$this->execute6		= $execute6;
		$this->results6		= $results6;
		$this->query_out7	= $query_out7;
		$this->execute7		= $execute7;
		$this->results7		= $results7;

		$this->adm_id			= $adm_id;
		$this->adm_dept			= $adm_dept;
		$this->adm_branch		= $adm_branch;
		$this->adm_permission 	= $adm_permission;
		$this->full_date		= $full_date;

		$this->vcase		= $vcase;
		$this->view_type	= $view_type;
		$this->pgnow		= $pgnow;
		$this->pg_log		= $pg_log;
		$this->pg_name		= $pg_name;

		$this->pcash_status	= $pcash_status;
		$this->pcash_no		= $pcash_no;
		$this->lsht_id		= $lsht_id;

		$this->pg_lftmenu_lgsht 	= $pg_lftmenu_lgsht;
		$this->pg_lftmenu_do		= $pg_lftmenu_do;
		$this->pg_lftmenu_lorry 	= $pg_lftmenu_lorry;
		$this->pg_lftmenu_client	= $pg_lftmenu_client;
		$this->pg_lftmenu_petty_cash= $pg_lftmenu_petty_cash;

		$this->deviceType		= $deviceType;

		$this->local_outstation	= $local_outstation;

		/**** Ordering purposes ****/
		$this->order_type 	= (!empty($order_type)) ? $order_type 	: "" ;
		$this->ordering 	= (!empty($ordering)) 	? $ordering 	: "asc" ;
		$this->filtering 	= (!empty($filtering)) 	? $filtering 	: "" ;
		$this->pg_ordering 	= (!empty($pg_ordering))? $pg_ordering 	: "" ;
		$this->font_style 	= "";
		$thie->ahref		= "";

		/**** Paging purposes ****/
		$this->page_no 		= (!empty($page_no))? $page_no 	: 1 ;
		$this->page_size 	= 20;
		$this->start_row 	= 0;


		$this->no			= 1;
		$this->full_time	= $php_time;
		$this->php_date		= $php_date;

		$this->date_shj		= $date_shj;
		$this->date_shj2	= $date_shj2;
		$this->date_shj3	= $date_shj3;





		/**********  today's logsheet info **********/
		$this->query_out = "select a.ls_id, a.ls_branch, a.ls_no, a.ls_for, a.ls_lry_owner, a.ls_lry_regno, a.ls_lry_type, a.ls_lry_trailer, a.ls_lry_dimension, a.ls_splr_id, a.ls_driver, a.ls_issued_date, a.ls_delivery_date, a.ls_trip_no, a.ls_destination_branch, a.ls_advance, a.ls_backdate, date_format(ls_issued_date, '%d %b %Y') as date_delivery, c.lorry_id, c.lorry_regno, c.lorry_owner from ymt_logsheet a, ymt_lorry c where a.ls_lorry_no = c.lorry_id and ls_branch= '$this->adm_branch' and ls_status = 1 and ls_local = '$this->local_outstation' and ls_issued_date between '$this->date_shj' and '$this->date_shj2' and ls_trip_no ".$this->view_type." and deleted_at is NULL order by ls_issued_date ".$this->ordering.", ls_trip_no ".$this->ordering;
		//echo "<p style='color: green;'> before pagin : $this->query_out</p>";
		//exit;
		//echo $this->query_out;
		/**** Set the page no ****/
		if(empty($this->page_no)){
			if($this->start_row  == 0){
				$this->page_no = $this->start_row + 1;
				$this->no = 0;
			}
		}else{
			$this->start_row = ($this->page_no - 1) * $this->page_size;
			$this->no = $this->start_row + 1;
		}

		/**** Set the counter start ****/
		if($this->page_no % $this->page_size == 0){
			$this->counter_start = $this->page_no - ($this->page_size - 1);
		}else{
			$this->counter_start = $this->page_no - ($this->page_no % $this->page_size) + 1;
		}

		/**** Counter End ****/
		$this->counter_end = $this->counter_start + ($this->page_size - 1);

		$this->execute = $db1->query($this->query_out);

		$this->data_num	= $db1->num_rows($this->execute);

		$this->query_out .= " LIMIT $this->start_row,$this->page_size";
		//echo "<p style='color: purple;'> after pagin : $this->query_out</p>";
		$this->record_count = $db1->num_rows($this->execute);

		$this->max_page = $this->record_count % $this->page_size;
		if($this->record_count % $this->page_size == 0){
			$this->max_page = $this->record_count / $this->page_size;
		}else{
			$this->max_page = ceil($this->record_count / $this->page_size);
		}

		//echo "<p>1st Q Final -> $this->query_out</p>";
		//exit;
		$this->execute = $db1->query($this->query_out);


		/**********  getting the logsheet result **********/
		if ($db1->num_rows($this->execute) == 0){

			$this->view .= "<h3 class='form-section' style='margin-left: 10px;'>";
				$this->view .= " No Record Found";
			$this->view .= "</h3>";
			$this->view .= "<div class='clearfix'>&nbsp;</div>";/********** div closing **********/

		}else{


			/********** Getting logsheet information **********/
			while($this->results = $db1->fetch_array($this->execute)){/********** while opening **********/

				if($this->adm_id == 1 || ($this->pg_log == "" && ($this->php_date == $this->date_shj))){
					$this->view .= "<form class='form-horizontal form-bordered form-row-stripped' name='dest_advance".$this->results['ls_id']."' id='dest_advance".$this->results['ls_id'].$this->page_no."' method='post' action=''>";/********** Form Opening background: $this->bck_color; color: $this->font_color **********/
				}else{
					$this->view .= "<div class='form-horizontal form-bordered form-row-stripped'>";
				}


					/**** Logsheet info div (start) ****/
					$this->view .= "<div class='form-body' style='border-left: 1px solid #efefef;border-right: 1px solid #efefef;'>";


						/**** form-group @ lorry (start) ****/
						$this->view .= "<div class='form-group' style='border-top: 1px solid #efefef;'>";

							$this->view .= "<label class='control-label col-md-2'>Lorry No</label>";
							$this->view .= "<div class='col-md-2'>";

								$this->view .= "<p class='form-control-static'>";
									$this->view .= "<strong style='color: #000;'><a href='".$this->pg_lftmenu_lorry['link_10']."&lry_id=".$this->results['lorry_id']."&lry_regno=".$this->results['lorry_regno']."' ";

									if($this->results['ls_backdate'] == 1){		$this->view .= " style='color: #000000;'";		}

									$this->view .= ">".$this->results['lorry_regno']."</a> (".$this->results['ls_branch'].")</strong>";

								$this->view .= "</p>";

							$this->view .= "</div>";

						//$this->view .= "</div>";
						/**** form-group @ lorry (closing) ****/

						/**** form-group @ logsheet no(start) ****/
						//$this->view .= "<div class='form-group'>";
					
							$this->view .= "<label class='control-label col-md-2'>LogSheet No</label>";
							$this->view .= "<div class='col-md-2' style='padding: 10px 6px;'>";
								
								$this->view .= "<p class='form-control-static'>";
									$this->view .= "<strong style='color: #000;'><a href='".$this->pg_lftmenu_lgsht['link_10']."&ls_id=".$this->results['ls_id']."&ls_no=".$this->results['ls_no']."' ";

									if($this->results['ls_backdate'] == 1){
										$this->view .= " style='color: #000000;'";
									}

									
									$this->view .= ">";
										$this->view .= $this->results['ls_branch']."->".$this->results['ls_destination_branch']." ";//added new ls no style upon req by Ms Lim JB 
										$this->view .= $this->results['ls_no'];
									$this->view .= "</a></strong>";
									
									
									
									
										/* check if no of item of tat logsheet is more tan 16 (start) - 08092012  */
										//1) get the num of logsheet item.
										//2) get the num of do item.
										//3) add all n check if > 16
										//echo "pgbrk cntr : ".$this->lgsht_no_itm." for lg id : ".$this->results['ls_id']." <br><br> ";
										
										$this->lgsht_no_itm	= 0;
										$this->itmcntstart 	= 1;
										$this->prnt_link_extra = "";
						
										$this->query_out_lgsht_no_itm 	= "select lsi_id, lsi_ls_id, lsi_do_id from ymt_logsheet_item where lsi_ls_id = '".$this->results['ls_id']."' and lsi_status = 1";
										//echo "<p>3rd - 2-> $this->query_out_lgsht_no_itm</p>";
										$this->execute_lgsht_no_itm 	= $db1->query($this->query_out_lgsht_no_itm);
										if($db1->num_rows($this->execute_lgsht_no_itm) > 0 ){
										
											//echo "lgsht cnt : ".$db1->num_rows($this->execute_lgsht_no_itm)."  for lg id : ".$this->results['ls_id']." --> ";
											

											while($this->results_lgsht_no_itm = $db1->fetch_array($this->execute_lgsht_no_itm)){/********** while opening **********/
												
												$this->lgshtid_cnted = $this->results_lgsht_no_itm['lsi_ls_id'];
												$this->query_out_do_no_itm 	= "select doi_id from ymt_do_item where doi_do_id = '".$this->results_lgsht_no_itm['lsi_do_id']."' ";
												//echo "<p>3rd - 3-> $this->query_out_do_no_itm</p>";
												$this->execute_do_no_itm 	= $db1->query($this->query_out_do_no_itm);
												
												if($db1->num_rows($this->execute_do_no_itm) > 0 ){
													//echo "do cnt : ".$db1->num_rows($this->execute_do_no_itm)." for lg id : ".$this->results['ls_id']."<br>";
													
													$this->lgsht_no_itm	+= $db1->num_rows($this->execute_do_no_itm);
												}else{
													$this->lgsht_no_itm++;
												}
												
												//echo "<p><strong>final cnt : $this->itmcntstart) ".$this->lgsht_no_itm."</strong> for lg id : ".$this->results['ls_id']."<br>";
												$this->itmcntstart++;
												
											}
											
											
										}else{
											$this->lgsht_no_itm = 0;
										}					
										/* check if no of item of tat logsheet is more tan 16 (end) - 08092012  */
										
										if($this->lgsht_no_itm > 16 && $this->lgshtid_cnted == $this->results['ls_id']){		$this->prnt_link_extra = "&pg=break";		}
										

										/**** form-group @ Print (start) ****/
										//$this->view .= "<div class='form-group'>";
										
											//$this->view .= "<label class='control-label col-md-3'>Print</label>";
											//$this->view .= "<div class='col-md-9'>";
										
												/* check if no of item of tat logsheet is more tan 16 (start) - 08092012  */
												//1) get the num of logsheet item.
												//2) get the num of do item.
												//3) add all n check if > 16
												//echo "pgbrk cntr : ".$this->lgsht_no_itm." for lg id : ".$this->results['ls_id']." <br><br> ";
												
												$this->lgsht_no_itm	= 0;
												$this->itmcntstart 	= 1;
												$this->prnt_link_extra = "";
								
												$this->query_out_lgsht_no_itm 	= "select lsi_id, lsi_ls_id, lsi_do_id from ymt_logsheet_item where lsi_ls_id = '".$this->results['ls_id']."' and lsi_status = 1";
												//echo "<p>3rd - 2-> $this->query_out_lgsht_no_itm</p>";
												$this->execute_lgsht_no_itm 	= $db1->query($this->query_out_lgsht_no_itm);
												if($db1->num_rows($this->execute_lgsht_no_itm) > 0 ){

													//echo "lgsht cnt : ".$db1->num_rows($this->execute_lgsht_no_itm)."  for lg id : ".$this->results['ls_id']." --> ";


													while($this->results_lgsht_no_itm = $db1->fetch_array($this->execute_lgsht_no_itm)){/********** while opening **********/

														$this->lgshtid_cnted = $this->results_lgsht_no_itm['lsi_ls_id'];
														$this->query_out_do_no_itm 	= "select doi_id from ymt_do_item where doi_do_id = '".$this->results_lgsht_no_itm['lsi_do_id']."' ";
														//echo "<p>3rd - 3-> $this->query_out_do_no_itm</p>";
														$this->execute_do_no_itm 	= $db1->query($this->query_out_do_no_itm);

														if($db1->num_rows($this->execute_do_no_itm) > 0 ){
															//echo "do cnt : ".$db1->num_rows($this->execute_do_no_itm)." for lg id : ".$this->results['ls_id']."<br>";

															$this->lgsht_no_itm	+= $db1->num_rows($this->execute_do_no_itm);
														}else{
															$this->lgsht_no_itm++;
														}

														//echo "<p><strong>final cnt : $this->itmcntstart) ".$this->lgsht_no_itm."</strong> for lg id : ".$this->results['ls_id']."<br>";
														$this->itmcntstart++;

													}


												}else{
													$this->lgsht_no_itm = 0;
												}					
												/* check if no of item of tat logsheet is more tan 16 (end) - 08092012  */

												if($this->lgsht_no_itm > 16 && $this->lgshtid_cnted == $this->results['ls_id']){		$this->prnt_link_extra = "&pg=break";		}


												//$this->view .= "<p class='form-control-static'>";

													$this->view .= "<a href='".$this->pg_lftmenu_lgsht['link_41']."&ls_id=".$this->results['ls_id'].$this->prnt_link_extra."&itm=".$this->lgsht_no_itm."' target='_blank' >";
														$this->view .= "&nbsp;&nbsp;<img src='images/print.png' style='text-decoration: none;border: 2px solid green; '>";
													$this->view .= "</a>";

												//$this->view .= "</p>";										

											//$this->view .= "</div>";

										//$this->view .= "</div>";
										/**** form-group @ Print (closing) ****/


								$this->view .= "</p>";										

							$this->view .= "</div>";

						//$this->view .= "</div>";
						/**** form-group @ logsheet no (closing) ****/

						/**** form-group @ trip no (start) ****/
						//$this->view .= "<div class='form-group'>";

							$this->view .= "<label class='control-label col-md-2'>Dest. & Trip No</label>";
							$this->view .= "<div class='col-md-2'>";

								if($this->vcase == "daily"){

									$this->view .= "<select name='destination_branch' id='destination_branch' size='1' class='form-control width_50_prcnt floatleft' >";

										if($this->local_outstation == 0){

											$this->view .= "<option value='JB' ";				
												if($this->results['ls_destination_branch'] == "JB"){		$this->view .= " selected='selected' ";		}				
											$this->view .= " >JB</option>";

											$this->view .= "<option value='KL' ";				
												if($this->results['ls_destination_branch'] == "KL"){		$this->view .= " selected='selected' ";		}				
											$this->view .= " >KL</option>";

											$this->view .= "<option value='BM' ";				
												if($this->results['ls_destination_branch'] == "BM"){		$this->view .= " selected='selected' ";		}				
											$this->view .= " >BM</option>";

											$this->view .= "<option value='SP' ";				
												if($this->results['ls_destination_branch'] == "SP"){		$this->view .= " selected='selected' ";		}				
											$this->view .= " >SP</option>";

										}else{

											$this->view .= "<option value='".$this->results['ls_branch']."' selected='selected' >".$this->results['ls_branch']."</option>";

										}
										
										
									$this->view .= "</select>";	
									
									$this->view .= "<span class='form-control-static floatleft'>&nbsp;&nbsp; & &nbsp;&nbsp; <strong style='color: #000;'>".$this->results['ls_trip_no']."</strong></span>";
									
								}else{

									$this->view .= "<p class='form-control-static'>";
										$this->view .= "<strong style='color: #000;'>".$this->results['ls_destination_branch'] ."</strong> & ";
										$this->view .= "<strong style='color: #000;'>".$this->results['ls_trip_no']."</strong>";
									$this->view .= "</p>";

								}


								$this->view .= "<input type='hidden' name='lsid' id='lsid' value='".$this->results['ls_id']."' size='3'>";	

								$this->view .= "<div class='clearfix'></div>";

							$this->view .= "</div>";

						$this->view .= "</div>";
						/**** form-group @ trip no (closing) ****/
						
						/**** form-group @ from (start) ****/
						/* $this->view .= "<div class='form-group'>";
					
							$this->view .= "<label class='control-label col-md-3'>From</label>";
							$this->view .= "<div class='col-md-9'>";
							
								$this->view .= "<p class='form-control-static'>";
									$this->view .= " <strong style='color: #000;'>".$this->results['ls_branch']."</strong>";
								$this->view .= "</p>";										
								
							$this->view .= "</div>";
							
						$this->view .= "</div>"; */
						/**** form-group @ from (closing) ****/	
						
						
						
						if($this->results['lorry_owner'] == "outsource"){
						
							/**** form-group @ supplier name (start) ****/
							$this->view .= "<div class='form-group'>";
						
								$this->view .= "<label class='control-label col-md-2'>OS Supplier Name</label>";
								$this->view .= "<div class='col-md-6'>";
								
									$this->query_out10 = "select lry_splr_id, lry_splr_name from ymt_lorry_supplier where lry_splr_status = 1 order by lry_splr_name asc";
									//echo "<p>Supplier Q-> $this->query_out10</p>";
									$this->execute10 = $db1->query($this->query_out10);
									$this->view .= "<select name='supplier_name' id='supplier_name' class='form-control' >";

										$this->view .= "<option value=''";
										if ($this->results['ls_splr_id'] == 0){			$this->view .= " selected='selected' ";			}
										$this->view .= " >&nbsp;</option>";

										while($this->results10 = $db1->fetch_array($this->execute10)){/********** while opening **********/
											$this->view .= "<option value='".$this->results10['lry_splr_id']."'";
										
											if($this->results10['lry_splr_id'] == $this->results['ls_splr_id']){	$this->view .= " selected='selected' ";		}

											$this->view .= " >".$this->results10['lry_splr_name']."</option>";
										}

									$this->view .= "</select>&nbsp;&nbsp;";									
									
								$this->view .= "</div>";
								
							//$this->view .= "</div>";
							/**** form-group @ supplier name (closing) ****/
						
							/**** form-group @ independent lorry regno (start) ****/
							//$this->view .= "<div class='form-group'>";
								
								$this->view .= "<label class='control-label col-md-2'>OS Lorry Type</label>";
								$this->view .= "<div class='col-md-2'>";
								
									$this->view .= "<input type='text' name='os_lorry_type' id='os_lorry_type' class='form-control input-medium' value='".$this->results['ls_lry_type']."' >";
									
								$this->view .= "</div>";
								
								
							$this->view .= "</div>";
							/**** form-group @ independent lorry regno (closing) ****/
						
							/**** form-group @ independent lorry type (start) ****/
							$this->view .= "<div class='form-group'>";
						
								
								$this->view .= "<label class='control-label col-md-2'>OS Lorry Reg No</label>";
								$this->view .= "<div class='col-md-2'>";
								
									$this->view .= "<input type='text' name='os_lorry_regno' id='os_lorry_regno' class='form-control input-small' value='".$this->results['ls_lry_regno']."' >";
									
								$this->view .= "</div>";
								
							//$this->view .= "</div>";
							/**** form-group @ independent lorry type (closing) ****/
						
							/**** form-group @ independent lorry trailer (start) ****/
							//$this->view .= "<div class='form-group'>";
						
								$this->view .= "<label class='control-label col-md-2'>OS Lorry Trailer</label>";
								$this->view .= "<div class='col-md-2'>";
								
									$this->view .= "<input type='text' name='os_lorry_type' id='os_lorry_type' class='form-control input-small' value='".$this->results['ls_lry_type']."' >";
									
								$this->view .= "</div>";
								
							//$this->view .= "</div>";
							/**** form-group @ independent lorry trailer (closing) ****/
						
							/**** form-group @ independent lorry dimension (start) ****/
							//$this->view .= "<div class='form-group'>";
						
								$this->view .= "<label class='control-label col-md-2'>OS Lorry Dimension</label>";
								$this->view .= "<div class='col-md-2'>";
								
									$this->view .= "<input type='text' name='os_lorry_dimension' id='os_lorry_dimension' class='form-control input-medium' value='".$this->results['ls_lry_dimension']."' >";
									$this->view .= "<input type='hidden' name='os_lry_tag_".$this->results['ls_id']."' id='os_lry_tag_".$this->results['ls_id']."' value='yes'>";
								$this->view .= "</div>";
								
							$this->view .= "</div>";
							/**** form-group @ independent lorry dimension (closing) ****/
						
						
						
						
						}else{/**** if($this->results['lorry_owner'] == "outsource") (closing) ****/
						
						
						
						
							/**** form-group @ driver (start) ****/
							$this->view .= "<div class='form-group'>";
						
								$this->view .= "<label class='control-label col-md-2'>Driver || Attn</label>";
								$this->view .= "<div class='col-md-6'>";
								
									$this->view .= "<p class='form-control-static'>";
										
										$this->query_out6 = "select driver_id, driver_branch, driver_route, driver_name, driver_mobile, driver_lorry_no from ymt_driver where driver_name != '' and driver_nature = 'Driver' and driver_status = 1 and driver_active = 1 order by driver_name asc";
										//echo "<p>2nd-> $this->query_out6</p>";
										$this->execute6 = $db1->query($this->query_out6);
										
										$this->view .= "<select name='driver_assigned' id='driver_assigned' class='form-control input-medium floatleft' >";

											$this->view .= "<option value=''";
											//if ($this->results['ls_driver'] == 0){			$this->view .= " selected='selected' ";			}
											$this->view .= " >&nbsp;</option>";

											while($this->results6 = $db1->fetch_array($this->execute6)){/********** while opening **********/
												$this->view .= "<option value='".$this->results6['driver_id']."'";
											
												if(($this->results6['driver_lorry_no'] == $this->results['lorry_id']) && $this->results['ls_driver'] == 0){	
													$this->view .= " selected='selected' ";		$this->driverroute = $this->results6['driver_route'];
												}elseif($this->results6['driver_id'] == $this->results['ls_driver']){	//dass add on 22032012 bug fixed (start)
													$this->view .= " selected='selected' ";		$this->driverroute = $this->results6['driver_route'];
												}//dass add on 22032012 bug fixed (end)

												$this->view .= " >".$this->results6['driver_name']."</option>";
											}

										$this->view .= "</select>";
										
										
										$this->view .= " <span class='displayblk floatleft width_05 form-control-static'>&nbsp; || &nbsp;&nbsp;</span>";
										
										
										$this->query_out6_2 = "select driver_id, driver_branch, driver_route, driver_name, driver_mobile, driver_lorry_no from ymt_driver where driver_name != '' and driver_nature = 'Attendant' and driver_status = 1 and driver_active = 1 order by driver_name asc";
										//echo "<p>2nd-> $this->query_out6_2</p>";
										$this->execute6_2 = $db1->query($this->query_out6_2);
										$this->view .= "<select name='attendant_assigned' id='attendant_assigned' class='form-control input-medium floatleft'>";

											$this->view .= "<option value=''";
											//if ($this->results['ls_driver'] == 0){			$this->view .= " selected='selected' ";			}
											$this->view .= " >&nbsp;</option>";

											while($this->results6_2 = $db1->fetch_array($this->execute6_2)){/********** while opening **********/
												$this->view .= "<option value='".$this->results6_2['driver_id']."'";
												
												if($this->results6_2['driver_id'] == $this->results['ls_driver']){
													$this->view .= " selected='selected' ";
												}

												$this->view .= " >".$this->results6_2['driver_name']."</option>";
											}

										$this->view .= "</select>&nbsp;&nbsp;";		

										
									$this->view .= "</p>";										
									
								$this->view .= "</div>";
								
							//$this->view .= "</div>";
							/**** form-group @ driver (closing) ****/	
							
							/**** form-group @ Attendant (start) ****/
							//$this->view .= "<div class='form-group'>";
						
								/* $this->view .= "<label class='control-label col-md-2'>Attendant</label>";
								$this->view .= "<div class='col-md-3'>";
								
									$this->view .= "<p class='form-control-static'>";
										$this->query_out6_2 = "select driver_id, driver_branch, driver_route, driver_name, driver_mobile, driver_lorry_no from ymt_driver where driver_name != '' and driver_nature = 'Attendant' and driver_id = '".$this->results['ls_attendant']."'";
										//echo "<p>2nd-> $this->query_out6_2</p>";
										$this->execute6_2 = $db1->query($this->query_out6_2);
										$this->results6_2 = $db1->fetch_array($this->execute6_2);
											
										if($db1->num_rows($this->execute6_2) > 0){
											$this->results6_2 = $db1->fetch_assoc($this->execute6_2);								
											$this->view .= ": <strong style='color: #000; '>".$this->results6_2['driver_name']."</strong> (".$this->results6_2['driver_mobile'].")";
										}else{
											$this->view .= " none";
										}
									$this->view .= "</p>";										
									
								$this->view .= "</div>"; */
								
							//$this->view .= "</div>";
							/**** form-group @ Attendant (closing) ****/
							
							/**** form-group @ Advance (start) ****/
							//$this->view .= "<div class='form-group'>";
						
								$this->view .= "<label class='control-label col-md-2'><strong style='font-size: 14px; color: #000000;'>[".$this->results['date_delivery']."]</strong></label>";
								$this->view .= "<div class='col-md-2'>";

									if(($this->results['ls_advance'] == "" || $this->results['ls_advance'] == "0.00") && $this->results['lorry_owner'] == "ours"){
										$this->view .= "<p class='form-control-static'>";
											$this->view .= "<strong>";

												if(!empty($this->results['ls_driver'])){
													$this->view .= "<a href='".$this->pg_lftmenu_petty_cash['link_21']."&lry_id=".$this->results['lorry_id']."&drv_id=".$this->results['ls_driver']."&ls_id=".$this->results['ls_id']."&ls_no=".$this->results['ls_branch'].$this->results['ls_no']."&rurl=".str_replace("/","",$_SERVER['PHP_SELF'])."&rurl2=".$_GET['route']."'  class='text-success'>Insert Advance</a>";
												}else{
													$this->view .= "<a href='".$this->pg_lftmenu_petty_cash['link_21']."&lry_id=".$this->results['lorry_id']."&ls_id=".$this->results['ls_id']."&ls_no=".$this->results['ls_branch'].$this->results['ls_no']."&rurl=".str_replace("/","",$_SERVER['PHP_SELF'])."&rurl2=".$_GET['route']."'  class='text-success'>Insert Advance</a>";
												}

											$this->view .= "</strong>";
										$this->view .= "</p>";
									}else{

										$this->view .= "<div style='float: left; width: 50%;'>";
											$this->view .= "<input type='text' name='advance_cash' id='advance_cash' class='form-control input-small' value='".$this->results['ls_advance']."' style='width: 78px !important;	'>";
										$this->view .= "</div>";


										$this->view .= "<div style='float: left; width: 50%; text-align: right; '>";
											$this->view .= "<p class='form-control-static'>";
											
												$this->query_out6_5 = "select pay_id, pay_no, pay_refno, pay_branch, pcash_voucher from ymt_pettycash join ymt_pettycash_code on pay_trans_type = pcash_code where pay_status = 1 and pay_lgsht_id = '".$this->results['ls_id']."'";
												//echo "<p>Q6-5 PCASH record-> $this->query_out6_5</p>";
												$this->execute6_5 = $db1->query($this->query_out6_5);
												
												if($db1->num_rows($this->execute6_5) > 0){
													$this->results6_5 = $db1->fetch_assoc($this->execute6_5);								
													$this->view .= "&nbsp;P-Cash (";
													
														$this->view .= "<a href='".$this->pg_lftmenu_petty_cash['link_10']."&pid=".$this->results6_5['pay_id']."&voucher=".$this->results6_5['pcash_voucher']."&branch=".$this->results6_5['pay_branch']."' >";
															$this->view .= $this->results6_5['pay_no'];
														$this->view .= "</a>";
													$this->view .= ")";
												}else{
													$this->view .= " none";
												}

											$this->view .= "</p>";
										$this->view .= "</div>";


									}


								$this->view .= "</div>";

							$this->view .= "</div>";
							/**** form-group @ Advance (closing) ****/	

						}/**** if($this->results['lorry_owner'] == "outsource") else (closing) ****/


					$this->view .= "</div>";
					/**** Logsheet info div @ form-body (end) ****/



					if( $this->adm_id == 1 || ($this->pg_log == "" && ($this->php_date == $this->date_shj))){
					
						/**** form-group @ Button (start) ****/
						$this->view .= "<div class='form-actions fluid'>";

							$this->view .= "<div class='row'>";
							
								$this->view .= "<div class='col-md-12'>";
								
									$this->view .= "<div class='col-md-12'>";
										
										
										$this->view .= "<button type='submit' class='btn green'><i class='icon-ok'></i> Finalise & Confirm</button>";
										$this->view .= "&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' class='btn default'>Cancel</button>";
										
										$this->view .= "<input type='hidden' name='page_now' id='page_now' value='temp'>";
										$this->view .= "<input type='hidden' name='origin_branch' id='origin_branch' value='".$this->results['ls_branch']."'>";
										$this->view .= "<input type='hidden' name='update_dest_advance' id='update_dest_advance' value='confirm'>";
										$this->view .= "<input type='hidden' name='starting_date' id='starting_date' value='".$php_time."'>";
										
										if($this->view_type == "= 0"){
											$this->view .= "<input type='hidden' name='lgsht_type_now' id='lgsht_type_now' value='temp_logsheet'>";
										}
										
										if($this->view_type == "> 0"){
											$this->view .= "<input type='hidden' name='lgsht_type_now' id='lgsht_type_now' value='real_logsheet'>";
										}
					
									$this->view .= "</div>";
									/**** .col-md-12 (closing) ****/							
									
								$this->view .= "</div>";
								/**** .col-md-12 (closing) ****/
								
							$this->view .= "</div>";
							/**** .row (closing) ****/
							
						$this->view .= "</div>";
						/**** .form-group @ Button (closing) ****/
					
					}/********** if($this->pg_log == "" && ($this->php_date == $this->date_shj)) closing **********/
					
				if( $this->adm_id == 1 || ($this->pg_log == "" && ($this->php_date == $this->date_shj))){
					$this->view .= "</form><br>";/********** form name='dest_advance' closing **********/
				}else{
					$this->view .= "</div><br>";/********** form name='dest_advance' closing **********/
				}
				
				


				
				/**********  today's logsheet info **********/
				$this->query_out2 = "SELECT lsi_id, lsi_do_id  FROM `ymt_logsheet_item` WHERE lsi_ls_id = '".$this->results['ls_id']."' and lsi_status = 1";
				//echo "<p>1st-> $this->query_out2</p>";
				$this->execute2 = $db1->query($this->query_out2);
				
				$this->no_content = 1;     
                    

				/**********  getting the logsheet result **********/
				if ($db1->num_rows($this->execute2) == 0){
					$this->view .= "<div class='alert alert-danger'>";
						$this->view .= "<strong>Error!</strong>";
						$this->view .= "There is no Record available on selected date.";
					$this->view .= "</div><!-- notification msg danger -->";
					$this->record_found_today = "no";
				}else{
					
					if($this->deviceType <> "computer"){
						$this->view .= "<div class='table-scrollable'>";/********** table-scrollable opening **********/
					}
						
						$this->view .= "<table class='table table-striped table-bordered table-hover'>";
							$this->view .= "<thead>";
								$this->view .= "<tr>";
									$this->view .= "<th >#</th>";
									$this->view .= "<th class='width_6_prcnt'>DO No</th>";
									$this->view .= "<th class='width_5_prcnt'>From</th>";
									$this->view .= "<th class='width_10_prcnt'>To</th>";
									$this->view .= "<th class='width_20_prcnt'>Consignor</th>";
									$this->view .= "<th class='width_20_prcnt'>Consignee</th>";
									$this->view .= "<th class='width_13_prcnt'>Description</th>";
									$this->view .= "<th class='width_5_prcnt'>Qty</th>";
									$this->view .= "<th class='width_6_prcnt'>UOM</th>";
									$this->view .= "<th class='width_8_prcnt'>Kg/MT</th>";
								$this->view .= "</tr>";
							$this->view .= "</thead>";

							$this->view .= "<tbody>";
							
							
							/********** Getting logsheet information **********/
							while($this->results2 = $db1->fetch_array($this->execute2)){/********** while opening **********/
							//print_r($this->results2);
							//print_r("<br>");
								
								$this->view .= "<tr>";
								$this->view .= "<td>";
									$this->view .= $this->no_content;//running no
								$this->view .= "</td>";
								
								$this->view .= "<td>";
								
									$this->query_out7 = "select do_id, do_no from ymt_do where do_id = '".$this->results2['lsi_do_id']."' and do_status = 1";
									$this->execute7 = $db1->query($this->query_out7);
									$this->results7 = $db1->fetch_assoc($this->execute7);
									$this->view .= "<a href='".$this->pg_lftmenu_do['link_10']."&dorder_id=".$this->results7['do_id']."' ";
									
									if($this->results['ls_backdate'] == 1){		$this->view .= " style='color: #5BC236;'";			}	
									$this->view .= ">".$this->results7['do_no']."</a>&nbsp;&nbsp;";
									
									$this->view .= "<a href='".$this->pg_lftmenu_lgsht['link_15']."&dorder_id=".$this->results7['do_id']."&dorder_no=".$this->results7['do_no']."&ls_id=".$this->results['ls_id']."' class='btn btn3 btn_trash' title='delete this D/O from the logsheet' alt='delete tis D/O from the logsheet'>";	
										$this->view .= "&nbsp;";
									$this->view .= "</a>&nbsp;&nbsp;";
						
								$this->view .= "</td>";


								/********** grb ls item info frm do item **********/
								$this->query_out20 = "SELECT do_id, do_no, do_consignor, do_collect_frm, do_consignee, do_deliver_to, do_deliver_to2 FROM `ymt_do` WHERE do_id = '".$this->results2['lsi_do_id']."' and do_status = 1 ";
								//echo "<p>1st-> $this->query_out2</p>";
								$this->execute20 = $db1->query($this->query_out20);
								$this->results20 = $db1->fetch_assoc($this->execute20);
								
								$this->view .= "<td>";
									$this->view .= $this->results20['do_collect_frm'];
								$this->view .= "</td>";
								$this->view .= "<td>";
									$this->view .= $this->results20['do_deliver_to2'];
								$this->view .= "</td>";
								
								$this->view .= "<td>";
							
									$this->query_out5 = "select client_id, client_name as consignee_name from ymt_client where client_id='".$this->results20['do_consignor']."' and (client_status = 1 || client_status = 3)";
									//echo "<p>5st-> $this->query_out_5</p>";
									$this->execute5 = $db1->query($this->query_out5);
									$this->results5 = $db1->fetch_array($this->execute5);
									$this->view .= "<a href='".$this->pg_lftmenu_client['link_10']."&clnt_id=".$this->results5['client_id']."' ";
									
									if($this->results['ls_backdate'] == 1){			$this->view .= " style='color: #5BC236;'";			}
									$this->view .= ">".$this->results5['consignee_name']."</a>";
								
								$this->view .= "</td>";		
								
								$this->view .= "<td>";
								
								$this->query_out3 = "select client_id, client_name as consignee_name from ymt_client where client_id='".$this->results20['do_consignee']."' and (client_status = 1 || client_status = 3)";
								//echo "<p>3st-> $this->query_out_3</p>";
								$this->execute3 = $db1->query($this->query_out3);
								$this->results3 = $db1->fetch_array($this->execute3);
								$this->view .= "<a href='".$this->pg_lftmenu_client['link_10']."&clnt_id=".$this->results3['client_id']."' ";
								
								if($this->results['ls_backdate'] == 1){			$this->view .= " style='color: #5BC236;'";			}
								$this->view .= ">".$this->results3['consignee_name']."</a>";

								$this->view .= "</td>";	
								
								
								$this->view .= "<td colspan='4'>"; 
								
								
									$this->view .= "<table class='table table-striped table-bordered table-hover marginbottom5'>";
										
										$this->view .= "<tbody>";

											/**********  today's logsheet info **********/
											$this->query_out4 = "select doi_desc, doi_qty, doi_uom, doi_weight from ymt_do_item where doi_do_id = '".$this->results20['do_id']."' order by doi_id desc";
											//echo "<p>1st-> $this->query_out4</p>";
											$this->execute4 = $db1->query($this->query_out4);
											
											while($this->results4 = $db1->fetch_array($this->execute4)){/********** while opening **********/
												$this->view .= "<tr>";
												$this->view .= "<td class='width_55_prcnt'>".$this->results4['doi_desc']."</td>";
												$this->view .= "<td class='width_10_prcnt'>".$this->results4['doi_qty']."</td>";
												$this->view .= "<td class='width_13_prcnt'>".$this->results4['doi_uom']."</td>";
												$this->view .= "<td class='width_20_prcnt'>".$this->results4['doi_weight']."</td>";
												$this->view .= "</tr>";
											}
										$this->view .= "</tbody>";
											
									$this->view .= "</table>";/********** table of logsheet item record closing **********/
									

								$this->view .= "</td>";
								$this->view .= "</tr>";
								
								$this->no_content++;

							}/********** while closing **********/
						
					
							$this->view .= "</tbody>";
			
						$this->view .= "</table>";/********** table of logsheet item record closing **********/
					
					
					if($this->deviceType <> "computer"){
						$this->view .= "</div>";/********** div table-scrollable closing **********/
					}					
					
					
					$this->view .= "<br><hr style='color: #f00; background-color: #f00; height: 5px;' /><br>";/********** break **********/

				}/********** if ($db1->num_rows($this->execute2) == 0) else closing **********/

				

				$this->no++;

			}/********** while closing **********/
			
			
			$this->view .= "<!--start pagination-->";

					$this->view .= "<ul class='pagination' style='margin: 15px 0px;  ";
						if($this->max_page > 18 && $this->max_page < 37 ){	$this->view .= " height: 70px; ";		}
						
						if($this->max_page > 36 && $this->max_page < 55 ){	$this->view .= " height: 110px; ";		}
						
						if($this->max_page > 54 && $this->max_page < 73 ){	$this->view .= " height: 140px; ";		}
						
						if($this->max_page > 72 && $this->max_page < 91 ){	$this->view .= " height: 170px; ";		}
					$this->view .= " ' >";
					
					
						$this->page_no_inside = $this->page_no - 1;
						
						$this->view .= "<li class='previous'>";
							$this->view .= "<a ";
							if($this->page_no == 1){ /*prev page */ $this->view .= "class='disable' ";	}
								$this->view .= "href='".$this->pg_name."?branch=".$this->adm_branch."&route=".$_GET['route']."&view=".$_GET['view']."&case=".$_GET['case']."&search_option=".$this->search_option."&active_option=".$this->active_option."&sdate=".$this->date_shj."&edate=".$this->date_shj2."&pg_no=".$this->page_no_inside."&order_type=".$this->order_type."&ordering=".$this->ordering."&filtering=".$this->filtering."&proc=yes' title=''>&lsaquo;</a>";
						$this->view .= "</li>";
					

					for($this->paging_no=1;$this->paging_no<=$this->max_page;$this->paging_no++){
						
						if($this->paging_no == $this->page_no){		$thie->ahref = "current";		}else{		$thie->ahref = "";		}
						
						$this->view .= "<li>";
						
							$this->view .= "<a class='".$thie->ahref."' href='".$this->pg_name."?branch=".$this->adm_branch."&route=".$_GET['route']."&view=".$_GET['view']."&case=".$_GET['case']."&search_option=".$this->search_option."&active_option=".$this->active_option."&sdate=".$this->date_shj."&edate=".$this->date_shj2."&pg_no=".$this->paging_no."&order_type=".$this->order_type."&ordering=".$this->ordering."&filtering=".$this->filtering."&proc=yes' title='' ";
							
							 if($this->page_no == $this->paging_no){ $this->view .= " class='active' "; } 
							
							$this->view .= ">$this->paging_no</a>";
						
						$this->view .= "</li>";
						
						if($this->paging_no == 18 || $this->paging_no == 36 || $this->paging_no == 54 || $this->paging_no == 72 ){	$this->view .= "<div class='clear' style='height: 30px;'></div>";		}
					}
					
					
						$this->page_no_inside = $this->page_no + 1;
						
						$this->view .= "<li class='next'>";
						
							$this->view .= "<a ";
							if($this->page_no == $this->max_page){ /*prev page */ $this->view .= "class='disable' ";	}
								$this->view .= "
								href='".$this->pg_name."?branch=".$this->adm_branch."&route=".$_GET['route']."&view=".$_GET['view']."&case=".$_GET['case']."&search_option=".$this->search_option."&active_option=".$this->active_option."&sdate=".$this->date_shj."&edate=".$this->date_shj2."&pg_no=".$this->page_no_inside."&order_type=".$this->order_type."&ordering=".$this->ordering."&filtering=".$this->filtering."&proc=yes' title=''>&rsaquo;</a>";
						
						$this->view .= "</li>";
					
					
					$this->view .= "</ul>";
				$this->view .= "<!--end pagination-->";
				$this->view .= "<br /><br />";
				
				
			
		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

		return $this->view;
	}


	
	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF LISTING LOGSHEET ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_history($adm_id, $adm_dept, $adm_branch, $adm_permission, $date_shj, $date_shj2, $date_shj3, $pcash_status, $pcash_no, $lsht_id, $vcase, $view_type, $pgnow, $pg_name,$page_no,$order_type,$ordering,$filtering){
		echo "<p>wir ls history: $adm_id, $adm_dept, $adm_branch, $adm_permission, $date_shj, $date_shj2, $date_shj3, $vcase, $pcash_status, $pcash_no, $lsht_id, $view_type, $pgnow, $pg_name,$page_no,$order_type,$ordering,$filtering</p>";
		global $db1,$useripadd,$php_time, $php_date, $pg_lftmenu_lgsht, $pg_lftmenu_do, $pg_lftmenu_lorry, $pg_lftmenu_client, $pg_lftmenu_petty_cash, $deviceType;
		
		$this->query_out	= $query_out;
		$this->execute		= $execute;
		$this->results		= $results;
		$this->query_out2	= $query_out2;
		$this->execute2		= $execute2;
		$this->results2		= $results2;
		$this->query_out3	= $query_out3;
		$this->execute3		= $execute3;
		$this->results3		= $results3;
		$this->query_out4	= $query_out4;
		$this->execute4		= $execute4;
		$this->results4		= $results4;
		$this->query_out5	= $query_out5;
		$this->execute5		= $execute5;
		$this->results5		= $results5;
		$this->query_out6	= $query_out6;
		$this->execute6		= $execute6;
		$this->results6		= $results6;
		$this->query_out7	= $query_out7;
		$this->execute7		= $execute7;
		$this->results7		= $results7;
				
		$this->adm_id			= $adm_id;
		$this->adm_dept			= $adm_dept;
		$this->adm_branch		= $adm_branch;
		$this->adm_permission 	= $adm_permission;
		$this->full_date		= $full_date;
		
		$this->vcase		= $vcase;
		$this->view_type	= $view_type;
		$this->pgnow		= $pgnow;
		$this->pg_log		= $pg_log;
		$this->pg_name		= $pg_name;
		
		$this->pcash_status	= $pcash_status;
		$this->pcash_no		= $pcash_no;
		$this->lsht_id		= $lsht_id;
		
		$this->pg_lftmenu_lgsht 	= $pg_lftmenu_lgsht;
		$this->pg_lftmenu_do		= $pg_lftmenu_do;
		$this->pg_lftmenu_lorry 	= $pg_lftmenu_lorry;
		$this->pg_lftmenu_client	= $pg_lftmenu_client;
		$this->pg_lftmenu_petty_cash= $pg_lftmenu_petty_cash;
		
		$this->deviceType	= $deviceType;
		
		/**** Ordering purposes ****/
		$this->order_type 	= (!empty($order_type)) ? $order_type 	: "" ;
		$this->ordering 	= (!empty($ordering)) 	? $ordering 	: "asc" ;
		$this->filtering 	= (!empty($filtering)) 	? $filtering 	: "" ;
		$this->pg_ordering 	= (!empty($pg_ordering))? $pg_ordering 	: "" ;
		$this->font_style 	= "";
		$thie->ahref		= "";

		/**** Paging purposes ****/
		$this->page_no 		= (!empty($page_no))? $page_no 	: 1 ;
		$this->page_size 	= 30;
		$this->start_row 	= 0;


		$this->no			= 1;
		$this->full_time	= $php_time;
		$this->php_date		= $php_date;
		
		$this->date_shj		= $date_shj;
		$this->date_shj2	= $date_shj2;
		$this->date_shj3	= $date_shj3;
		
		
	
		/**********  today's logsheet info **********/
		$this->query_out = "select a.ls_id, a.ls_branch, a.ls_no, a.ls_for, a.ls_lry_owner, a.ls_lry_regno, a.ls_lry_type, a.ls_lry_trailer, a.ls_lry_dimension, a.ls_splr_id, a.ls_driver, a.ls_issued_date, a.ls_delivery_date, a.ls_trip_no, a.ls_completed, a.ls_destination_branch, a.ls_advance, a.ls_backdate, date_format(ls_issued_date, '%d %b %Y') as date_delivery, c.lorry_id, c.lorry_regno, c.lorry_owner from ymt_logsheet a, ymt_lorry c where a.ls_lorry_no = c.lorry_id and ls_branch= '$this->adm_branch' and ls_issued_date between '$this->date_shj' and '$this->date_shj2' and ls_status = 1 and ls_trip_no ".$this->view_type." order by ls_issued_date ".$this->ordering.", ls_trip_no ".$this->ordering;
		
		//echo "<p style='color: green;'> before pagin : $this->query_out</p>";
		
		/**** Set the page no ****/
		if(empty($this->page_no)){
			if($this->start_row  == 0){
				$this->page_no = $this->start_row + 1;
				$this->no = 0;
			}
		}else{
			$this->start_row = ($this->page_no - 1) * $this->page_size;
			$this->no = $this->start_row + 1;
		}

		/**** Set the counter start ****/
		if($this->page_no % $this->page_size == 0){
			$this->counter_start = $this->page_no - ($this->page_size - 1);
		}else{
			$this->counter_start = $this->page_no - ($this->page_no % $this->page_size) + 1;
		}
		
		/**** Counter End ****/
		$this->counter_end = $this->counter_start + ($this->page_size - 1);

		$this->execute = $db1->query($this->query_out);
		
		$this->data_num	= $db1->num_rows($this->execute);

		$this->query_out .= " LIMIT $this->start_row,$this->page_size";
		
		//echo "<p style='color: purple;'> after pagin : $this->query_out</p>";
		
		$this->record_count = $db1->num_rows($this->execute);

		$this->max_page = $this->record_count % $this->page_size;
		if($this->record_count % $this->page_size == 0){
			$this->max_page = $this->record_count / $this->page_size;
		}else{
			$this->max_page = ceil($this->record_count / $this->page_size);
		}
		
		//echo "<p>1st Q Final -> $this->query_out</p>";
		//exit;
		$this->execute = $db1->query($this->query_out);
		

		/**********  getting the logsheet result **********/
		if ($db1->num_rows($this->execute) == 0){
		
			$this->view .= "<h3 class='form-section' style='margin-left: 10px;'>";
				$this->view .= " No Record Found";
			$this->view .= "</h3>";
			$this->view .= "<div class='clearfix'>&nbsp;</div>";/********** div closing **********/
			
		}else{


			if($this->deviceType <> "computer"){		$this->view .= "<div class='table-scrollable'>";/********** table-scrollable opening **********/		}

				$this->view .= "<table class='table table-striped table-bordered table-hover'>";
					$this->view .= "<thead>";
						$this->view .= "<tr>";
							$this->view .= "<th class='width_3_prcnt'>#</th>";
							$this->view .= "<th class='width_15_prcnt'>Lorry <br />Driver</th>";
							$this->view .= "<th class='width_17_prcnt'>L/S No </th>";
							$this->view .= "<th class='width_5_prcnt'>Trip</th>";
							$this->view .= "<th class='width_5_prcnt'>Dest</th>";
							$this->view .= "<th class='width_45_prcnt'>D/O Summary</th>";
							$this->view .= "<th class='width_8_prcnt'>Status</th>";
						$this->view .= "</tr>";
					$this->view .= "</thead>";

					$this->view .= "<tbody>";


						/********** Getting logsheet information **********/
						while($this->results = $db1->fetch_array($this->execute)){/********** while opening **********/

							$this->view .= "<tr>";
								$this->view .= "<td>";
									$this->view .= $this->no_content;//running no
								$this->view .= "</td>";

								$this->view .= "<td>";

									//$this->view .= "<p class='form-control-static'>";
										$this->view .= "<strong style='color: #000;'><a href='".$this->pg_lftmenu_lorry['link_10']."&lry_id=".$this->results['lorry_id']."&lry_regno=".$this->results['lorry_regno']."' ";

										if($this->results['ls_backdate'] == 1){		$this->view .= " style='color: #000000;'";		}

										$this->view .= ">".$this->results['lorry_regno']."</a> (".$this->results['ls_branch'].")</strong> <br />";


										$this->query_out3 	= "select driver_name from ymt_driver where driver_id = '".$this->results['ls_driver']."' and driver_status = 1";
										$this->execute3 	= $db1->query($this->query_out3);
										$this->results3 	= $db1->fetch_assoc($this->execute3);

										$this->view .= $this->results3['driver_name'];
									//$this->view .= "</p>";

								$this->view .= "</td>";


								$this->view .= "<td>";

										$this->view .= "<strong style='color: #000;'><a href='".$this->pg_lftmenu_lgsht['link_10']."&ls_id=".$this->results['ls_id']."&ls_no=".$this->results['ls_no']."' ";

											if($this->results['ls_backdate'] == 1){		$this->view .= " style='color: #000000;'";		}

											$this->view .= ">";
												$this->view .= $this->results['ls_branch']."->".$this->results['ls_destination_branch']." ";//added new ls no style upon req by Ms Lim JB 
												$this->view .= $this->results['ls_no'];
											$this->view .= "</a></strong>";


											/* check if no of item of tat logsheet is more tan 16 (start) - 08092012  */
											//1) get the num of logsheet item.
											//2) get the num of do item.
											//3) add all n check if > 16
											//echo "pgbrk cntr : ".$this->lgsht_no_itm." for lg id : ".$this->results['ls_id']." <br><br> ";

											$this->lgsht_no_itm	= 0;
											$this->itmcntstart 	= 1;
											$this->prnt_link_extra = "";

											$this->query_out_lgsht_no_itm 	= "select lsi_id, lsi_ls_id, lsi_do_id from ymt_logsheet_item where lsi_ls_id = '".$this->results['ls_id']."' and lsi_status = 1";
											//echo "<p>3rd - 2-> $this->query_out_lgsht_no_itm</p>";
											$this->execute_lgsht_no_itm 	= $db1->query($this->query_out_lgsht_no_itm);
											if($db1->num_rows($this->execute_lgsht_no_itm) > 0 ){

												//echo "lgsht cnt : ".$db1->num_rows($this->execute_lgsht_no_itm)."  for lg id : ".$this->results['ls_id']." --> ";


												while($this->results_lgsht_no_itm = $db1->fetch_array($this->execute_lgsht_no_itm)){/********** while opening **********/

													$this->lgshtid_cnted = $this->results_lgsht_no_itm['lsi_ls_id'];
													$this->query_out_do_no_itm 	= "select doi_id from ymt_do_item where doi_do_id = '".$this->results_lgsht_no_itm['lsi_do_id']."' ";
													//echo "<p>3rd - 3-> $this->query_out_do_no_itm</p>";
													$this->execute_do_no_itm 	= $db1->query($this->query_out_do_no_itm);

													if($db1->num_rows($this->execute_do_no_itm) > 0 ){
														//echo "do cnt : ".$db1->num_rows($this->execute_do_no_itm)." for lg id : ".$this->results['ls_id']."<br>";

														$this->lgsht_no_itm	+= $db1->num_rows($this->execute_do_no_itm);
													}else{
														$this->lgsht_no_itm++;
													}

													//echo "<p><strong>final cnt : $this->itmcntstart) ".$this->lgsht_no_itm."</strong> for lg id : ".$this->results['ls_id']."<br>";
													$this->itmcntstart++;

												}


											}else{
												$this->lgsht_no_itm = 0;
											}					
											/* check if no of item of tat logsheet is more tan 16 (end) - 08092012  */

											if($this->lgsht_no_itm > 16 && $this->lgshtid_cnted == $this->results['ls_id']){		$this->prnt_link_extra = "&pg=break";		}



											/* check if no of item of tat logsheet is more tan 16 (start) - 08092012  */
											//1) get the num of logsheet item.
											//2) get the num of do item.
											//3) add all n check if > 16
											//echo "pgbrk cntr : ".$this->lgsht_no_itm." for lg id : ".$this->results['ls_id']." <br><br> ";

											$this->lgsht_no_itm	= 0;
											$this->itmcntstart 	= 1;
											$this->prnt_link_extra = "";

											$this->query_out_lgsht_no_itm 	= "select lsi_id, lsi_ls_id, lsi_do_id from ymt_logsheet_item where lsi_ls_id = '".$this->results['ls_id']."' and lsi_status = 1";
											//echo "<p>3rd - 2-> $this->query_out_lgsht_no_itm</p>";
											$this->execute_lgsht_no_itm 	= $db1->query($this->query_out_lgsht_no_itm);
											if($db1->num_rows($this->execute_lgsht_no_itm) > 0 ){

											//echo "lgsht cnt : ".$db1->num_rows($this->execute_lgsht_no_itm)."  for lg id : ".$this->results['ls_id']." --> ";

												while($this->results_lgsht_no_itm = $db1->fetch_array($this->execute_lgsht_no_itm)){/********** while opening **********/

													$this->lgshtid_cnted = $this->results_lgsht_no_itm['lsi_ls_id'];
													$this->query_out_do_no_itm 	= "select doi_id from ymt_do_item where doi_do_id = '".$this->results_lgsht_no_itm['lsi_do_id']."' ";
													//echo "<p>3rd - 3-> $this->query_out_do_no_itm</p>";
													$this->execute_do_no_itm 	= $db1->query($this->query_out_do_no_itm);

													if($db1->num_rows($this->execute_do_no_itm) > 0 ){
														//echo "do cnt : ".$db1->num_rows($this->execute_do_no_itm)." for lg id : ".$this->results['ls_id']."<br>";

														$this->lgsht_no_itm	+= $db1->num_rows($this->execute_do_no_itm);
													}else{
														$this->lgsht_no_itm++;
													}

													//echo "<p><strong>final cnt : $this->itmcntstart) ".$this->lgsht_no_itm."</strong> for lg id : ".$this->results['ls_id']."<br>";
													$this->itmcntstart++;

												}


											}else{
												$this->lgsht_no_itm = 0;
											}					
											/* check if no of item of tat logsheet is more tan 16 (end) - 08092012  */

											if($this->lgsht_no_itm > 16 && $this->lgshtid_cnted == $this->results['ls_id']){		$this->prnt_link_extra = "&pg=break";		}

												$this->view .= "<a href='".$this->pg_lftmenu_lgsht['link_41']."&ls_id=".$this->results['ls_id'].$this->prnt_link_extra."&itm=".$this->lgsht_no_itm."' target='_blank' >";
													$this->view .= "&nbsp;&nbsp;<img src='images/print.png' style='text-decoration: none;border: 2px solid green; '>";
												$this->view .= "</a>";


								$this->view .= "</td>";

								$this->view .= "<td>";
									$this->view .= "<strong style='color: #000;'>".$this->results['ls_trip_no']."</strong>";
								$this->view .= "</td>";

								$this->view .= "<td>";
									$this->view .= "<strong style='color: #000;'>".$this->results['ls_destination_branch'] ."</strong>";							
								$this->view .= "</td>";


								/********** D/O Summary (start) **********/
								$this->view .= "<td>";


									$this->view .= "<table class='table table-striped table-bordered table-hover marginbottom5'>";
										/* $this->view .= "<thead>";
											$this->view .= "<tr>";
												$this->view .= "<th >#</th>";
												$this->view .= "<th class='width_15_prcnt'>Lorry <br />Driver</th>";
											$this->view .= "</tr>";
										$this->view .= "</thead>";*/

										$this->view .= "<tbody>";

											/**********  today's logsheet info **********/
											$this->query_out4 = "SELECT d.do_id, d.do_branch, d.do_no, d.do_consignor, d.do_collect_frm, d.do_consignee, d.do_deliver_to, d.do_deliver_to2 FROM ymt_do d, ymt_logsheet L, ymt_logsheet_item Li WHERE L.ls_id = Li.lsi_ls_id and d.do_id = Li.lsi_do_id and L.ls_id = '".$this->results['ls_id']."' and L.ls_status = 1 and d.do_status = 1 ";
											//echo "<p>Do Summary Q -> $this->query_out4</p>";
											//exit;
											$this->execute4 = $db1->query($this->query_out4);

											while($this->results4 = $db1->fetch_array($this->execute4)){/********** while opening **********/

												$this->fromto_numrows = "";
												$this->no_content_do2 = 1;

												$this->view .= "<tr>";
													$this->view .= "<td class='width_20_prcnt'>";

														$this->view .= "<a href='".$this->pg_lftmenu_do['link_10']."&dorder_id=".$this->results4['do_id']."' >";
															$this->view .= $this->results4['do_branch']." ".$this->results4['do_no'];
														$this->view .= "</a>";

													$this->view .= "</td>";
													$this->view .= "<td class='width_80_prcnt'>";

														$this->query_out5 	= "select client_id, client_name from ymt_client where client_id in ( '".$this->results4['do_consignor']."','".$this->results4['do_consignee']."' ) and (client_status = 1 || client_status = 3)";
														//echo "<p>5st-> $this->query_out_5</p>";
														$this->execute5 	= $db1->query($this->query_out5);

														$this->fromto_numrows = $db1->num_rows($this->execute5);

														while($this->results5 = $db1->fetch_array($this->execute5)){/********** while opening **********/

															$this->view .= "<a href='".$this->pg_lftmenu_client['link_10']."&clnt_id=".$this->results5['client_id']."' ";

															if($this->results['ls_backdate'] == 1){			$this->view .= " style='color: #5BC236;'";			}
															$this->view .= ">".$this->results5['client_name']."</a>";

															//$this->view .= "(".$this->results4['do_collect_frm'].")";
															if($this->fromto_numrows > 1 && $this->no_content_do2 == 1){		$this->view .= " <strong>-></strong> ";		}

															$this->no_content_do2++;
														}

													$this->view .= "</td>";
												$this->view .= "</tr>";

											}

										$this->view .= "</tbody>";

									$this->view .= "</table>";/********** table of logsheet item record closing **********/


								$this->view .= "</td>";	
								/********** D/O Summary (end) **********/


								$this->view .= "<td>"; 
									$this->view .= ($this->results['ls_completed'] == 1)? "Completed" : "No Update" ;
								$this->view .= "</td>";
							$this->view .= "</tr>";

							$this->no_content++;

						}/********** while($this->results = $db1->fetch_array($this->execute)) closing **********/


					$this->view .= "</tbody>";

				$this->view .= "</table>";/********** table of logsheet item record closing **********/


			if($this->deviceType <> "computer"){			$this->view .= "</div>";/********** div table-scrollable closing **********/			}	

			$this->view .= "<br><hr style='color: #f00; background-color: #f00; height: 5px;' /><br>";/********** break **********/

		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/


		$this->no++;


		$this->view .= "<!--start pagination-->";

			$this->view .= "<ul class='pagination' style='margin: 15px 0px;  ";
				if($this->max_page > 18 && $this->max_page < 37 ){	$this->view .= " height: 70px; ";		}

				if($this->max_page > 36 && $this->max_page < 55 ){	$this->view .= " height: 110px; ";		}

				if($this->max_page > 54 && $this->max_page < 73 ){	$this->view .= " height: 140px; ";		}

				if($this->max_page > 72 && $this->max_page < 91 ){	$this->view .= " height: 170px; ";		}
			$this->view .= " ' >";


				$this->page_no_inside = $this->page_no - 1;

				$this->view .= "<li class='previous'>";
					$this->view .= "<a ";
					if($this->page_no == 1){ /*prev page */ $this->view .= "class='disable' ";	}
						$this->view .= "href='".$this->pg_name."?branch=".$this->adm_branch."&route=".$_GET['route']."&view=".$_GET['view']."&case=".$_GET['case']."&search_option=".$this->search_option."&active_option=".$this->active_option."&sdate=".$this->date_shj."&edate=".$this->date_shj2."&pg_no=".$this->page_no_inside."&order_type=".$this->order_type."&ordering=".$this->ordering."&filtering=".$this->filtering."&proc=yes' title=''>&lsaquo;</a>";
				$this->view .= "</li>";


			for($this->paging_no=1;$this->paging_no<=$this->max_page;$this->paging_no++){

				if($this->paging_no == $this->page_no){		$thie->ahref = "current";		}else{		$thie->ahref = "";		}

				$this->view .= "<li>";

					$this->view .= "<a class='".$thie->ahref."' href='".$this->pg_name."?branch=".$this->adm_branch."&route=".$_GET['route']."&view=".$_GET['view']."&case=".$_GET['case']."&search_option=".$this->search_option."&active_option=".$this->active_option."&sdate=".$this->date_shj."&edate=".$this->date_shj2."&pg_no=".$this->paging_no."&order_type=".$this->order_type."&ordering=".$this->ordering."&filtering=".$this->filtering."&proc=yes' title='' ";

					 if($this->page_no == $this->paging_no){ $this->view .= " class='active' "; } 

					$this->view .= ">$this->paging_no</a>";

				$this->view .= "</li>";

				if($this->paging_no == 18 || $this->paging_no == 36 || $this->paging_no == 54 || $this->paging_no == 72 ){	$this->view .= "<div class='clear' style='height: 30px;'></div>";		}
			}


				$this->page_no_inside = $this->page_no + 1;

				$this->view .= "<li class='next'>";

					$this->view .= "<a ";
					if($this->page_no == $this->max_page){ /*prev page */ $this->view .= "class='disable' ";	}
						$this->view .= "
						href='".$this->pg_name."?branch=".$this->adm_branch."&route=".$_GET['route']."&view=".$_GET['view']."&case=".$_GET['case']."&search_option=".$this->search_option."&active_option=".$this->active_option."&sdate=".$this->date_shj."&edate=".$this->date_shj2."&pg_no=".$this->page_no_inside."&order_type=".$this->order_type."&ordering=".$this->ordering."&filtering=".$this->filtering."&proc=yes' title=''>&rsaquo;</a>";

				$this->view .= "</li>";


			$this->view .= "</ul>";
		$this->view .= "<!--end pagination-->";
		$this->view .= "<br /><br />";


		return $this->view;
	}



	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF LISTING LOGSHEET ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_view($adm_id, $adm_dept, $adm_branch, $adm_permission, $date_shj, $date_shj2,$display_date, $lry_id, $branch_filter, $view_type, $pgnow, $pg_name,$page_no,$order_type,$ordering,$filtering){
		//echo "<p>wir: $adm_id, $adm_dept, $adm_branch, $adm_permission, $date_shj, $date_shj2,$display_date, $lry_id, $view_type, $pgnow, $pg_name,$page_no,$order_type,$ordering,$filtering</p>";
		global $db1,$useripadd,$php_time, $pg_lftmenu_lorry, $pg_lftmenu_lgsht;

		$this->query_out	= $query_out;
		$this->execute		= $execute;
		$this->results		= $results;
		$this->query_out2	= $query_out2;
		$this->execute2		= $execute2;
		$this->results2		= $results2;
		$this->query_out3	= $query_out3;
		$this->execute3		= $execute3;
		$this->results3		= $results3;
		$this->query_out4	= $query_out4;
		$this->execute4		= $execute4;
		$this->results4		= $results4;
		$this->query_out5	= $query_out5;
		$this->execute5		= $execute5;
		$this->results5		= $results5;
		$this->query_out6	= $query_out6;
		$this->execute6		= $execute6;
		$this->results6		= $results6;
		$this->query_out7	= $query_out7;
		$this->execute7		= $execute7;
		$this->results7		= $results7;

		$this->adm_id		= $adm_id;
		$this->adm_dept		= $adm_dept;
		$this->adm_branch	= $adm_branch;
		$this->adm_permission = $adm_permission;
		$this->full_date	= $php_time;

		$this->lry_id		= $lry_id;
		$this->branch_filter= $branch_filter;

		$this->view_type	= $view_type;
		$this->pgnow		= $pgnow;

		$this->pg_lftmenu_lorry		= $pg_lftmenu_lorry;
		$this->pg_lftmenu_lgsht		= $pg_lftmenu_lgsht;

		$this->no			= 1;
		$this->date_shj		= $date_shj;
		$this->date_shj2	= $date_shj2;
		$this->display_date	= $display_date;

		$this->grand_ttl_do 		= "";
		$this->grand_ttl_trip 		= "";
		$this->grand_ttl_cost		= "";
		$this->grand_ttl_frieght	= "";
		$this->grand_ttl_tripcost	= "";
		$this->grand_ttl_maintenance= "";
		$this->grand_ttl_profit		= "";
		
		$this->ls_view_id_value2	= array();		
		$this->ls_view_id			= array();
		$this->ls_view_id2			= array();
		$this->ls_view_id2_newvalue	= "";
		


		/**********  today's logsheet info **********/
		$this->query_out  = "select a.ls_id, a.ls_branch, a.ls_no, a.ls_driver, a.ls_issued_date, date_format(a.ls_issued_date, '%d %b %Y') as date_issued, a.ls_delivery_date, a.ls_trip_no, a.ls_destination_branch, a.ls_advance, a.ls_trip_cost, a.ls_maintenance, a.ls_profit, a.ls_backdate, c.lorry_id, c.lorry_regno from ymt_logsheet a, ymt_lorry c where a.ls_lorry_no = c.lorry_id  and ls_issued_date between '$this->date_shj' and '$this->date_shj2' and ls_status = 1 and ls_trip_no $this->view_type ";

		if($this->lry_id <> "all"){				$this->query_out .= " and ls_lorry_no = $this->lry_id ";		}
		if($this->branch_filter <> "all"){		$this->query_out .= " and ls_branch = '$this->adm_branch' ";		}

		$this->query_out .= " order by ls_id asc, ls_delivery_date asc";
		//echo "<p>1st-> $this->query_out</p>";
		//exit;
		$this->execute = $db1->query($this->query_out);

		$this->view .= "<div class='entry_content_new'>";
			$this->view .= "<h4>";
				$this->view .= "Logsheet ";
				$this->view .= ($this->pgnow <> "daily") ? "Issued Date From $this->display_date To $this->display_date2" : "Issued Date : $this->display_date";
			$this->view .= "</h4>";
			$this->view .= '<div class="clear">&nbsp;</div>';
		$this->view .= "</div>";/********** div closing **********/


		/**********  getting the logsheet result **********/
		if ($db1->num_rows($this->execute) == 0){
			$this->record_found_today = "no";
		}else{


			$this->view .= "<form id='logsheet_view' name='logsheet_view' class='form-horizontal form-bordered form-row-stripped' action='' method='post'>";
			
				$this->view .= "<table class='table table-striped table-bordered table-hover'>";
					$this->view .= "<thead>";
						$this->view .= "<tr>";
							$this->view .= "<th class='width_3_prcnt'>#</th>";
							$this->view .= "<th class='width_10_prcnt'>Date</th>";
							$this->view .= "<th class='width_11_prcnt'>L/S No (Trip)<br />From->To</th>";
							//$this->view .= "<th class='width_8_prcnt'>From->To</th>";
							$this->view .= "<th class='width_20_prcnt'>Lorry No <br />Driver Name</th>";
							//$this->view .= "<th class='width_20_prcnt'>Driver Name</th>";
							$this->view .= "<th class='width_7_prcnt'>Ttl D/O</th>";
							$this->view .= "<th class='width_8_prcnt text-right'>Adv (RM)</th>";
							$this->view .= "<th class='width_10_prcnt text-right'>Ttl Freight</th>";
							$this->view .= "<th class='width_10_prcnt text-right'>Trip Cost</th>";
							$this->view .= "<th class='width_10_prcnt text-right'>Maintenance</th>";
							$this->view .= "<th class='width_10_prcnt text-right'>Profit</th>";
						$this->view .= "</tr>";
					$this->view .= "</thead>";

					$this->view .= "<tbody>";


						/********** Getting lorry information **********/
						while($this->results = $db1->fetch_array($this->execute)){	/********** while opening **********/
							//print_r($this->results);
$this->ls_view_id3			= "";
							$this->view .= "<tr>";
								$this->view .= "<td>".$this->no."</td>";
								$this->view .= "<td>";
									$this->view .= $this->results['date_issued'];
								$this->view .= "</td>";
								/*$this->view .= "<td>";
									$this->view .= $this->results['ls_trip_no'];
								$this->view .= "</td>";*/

								$this->view .= "<td>";
									$this->view .= "<a href='".$this->pg_lftmenu_lgsht['link_10']."&ls_id=".$this->results['ls_id']."'><strong>".$this->results['ls_no']."</strong></a> (".$this->results['ls_trip_no'].")";
									$this->view .= "<br /><span style='font-size: 15px;'>".$this->results['ls_branch']."->".$this->results['ls_destination_branch']."</span>";

								$this->view .= "</td>";
								/* $this->view .= "<td>";
									$this->view .= $this->results['ls_branch']."->".$this->results['ls_destination_branch'];
								$this->view .= "</td>"; */

								$this->view .= "<td>";
									$this->view .= "<a href='".$this->pg_lftmenu_lorry['link_10']."&lry_id=".$this->results['lorry_id']."&lry_regno=".$this->results['lorry_regno']."'><strong>".$this->results['lorry_regno']."</strong></a><br />";
								//$this->view .= "</td>";

								// $this->view .= "<td>";
									$this->query_out2 = "select driver_id, driver_name, driver_nric from ymt_driver WHERE driver_lorry_no = '".$this->results['lorry_id']."'";
									//echo "<p>2nd-> $this->query_out2</p>";
									$this->execute2 = $db1->query($this->query_out2);
									$this->results2 = $db1->fetch_array($this->execute2);

									$this->view2 = "<a href='ymtt_driver_info.php?drv_id=".$this->results2['driver_id']."&icno=".$this->results2['driver_nric']."'>";
										$this->view2 .= substr($this->results2['driver_name'],0,17)."..." ;
									$this->view2 .= "</a>";
									$this->view .= $this->view2;
								$this->view .= "</td>";

								$this->view .= "<td class='text-right'>";//total do

									$this->query_out3  = "select count(do_id) as ttl_do, sum(do_total_frieght) as ttl_frieght, sum(do_total_frieght_gst) as ttl_frieght_gst from ymt_do join ymt_logsheet_item on lsi_do_id = do_id where lsi_ls_id = '".$this->results['ls_id']."' and lsi_status = 1 and do_status = 1";
									//echo "<p>3rd Q-> $this->query_out3</p>";
									$this->execute3 = $db1->query($this->query_out3);
									$this->results3 = $db1->fetch_assoc($this->execute3);

									$this->view .= $this->results3['ttl_do'];
								$this->view .= "</td>";

								$this->view .= "<td class='text-right'>";//total cost given to driver if any
									$this->view .= $this->results['ls_advance'];
								$this->view .= "</td>";


								$this->view .= "<td class='text-right'>";//total frieght
									$this->view .= number_format($this->results3['ttl_frieght'],2);
									$this->view .= "<input type='hidden' class='form-control' name='ls_freight[".$this->results['ls_id']."]' id='ls_freight[".$this->results['ls_id']."]' value='".$this->results3['ttl_frieght']."'/>" ;
								$this->view .= "</td>";

								$this->ls_view_id[$this->results['ls_id']] 		= $this->results3['ttl_frieght'] - $this->results['ls_advance']; //get outside for jquery process
								$this->ls_view_id3 			= $this->results3['ttl_frieght'] - $this->results['ls_advance']; //get outside for jquery process
								
								$this->ls_view_id2[] 		= "#ls_profit[".$this->results['ls_id']."]@".$this->ls_view_id3; //get outside for jquery process
								
								$this->grand_ttl_do 		+= $this->results3['ttl_do'];
								$this->grand_ttl_cost		+= $this->results['ls_advance'];
								$this->grand_ttl_frieght	+= $this->results3['ttl_frieght'];


								$this->view .= "<td class='text-right'>";//trip cost

									if($this->results['ls_trip_cost'] <> 0 || $this->results['ls_trip_cost'] <> "0.00"){
										$this->grand_ttl_tripcost	+= $this->results['ls_trip_cost'];
									}

									$this->view .= "<input type='text' class='form-control' name='ls_tripcost[".$this->results['ls_id']."]' id='ls_tripcost[".$this->results['ls_id']."]' value='".number_format($this->results['ls_trip_cost'],2)."' />";

								$this->view .= "</td>";

								$this->view .= "<td class='text-right'>";//maintenance

									if($this->results['ls_maintenance'] <> 0 || $this->results['ls_maintenance'] <> "0.00"){
										$this->grand_ttl_maintenance	+= $this->results['ls_maintenance'];
									}

									$this->view .= "<input type='text' class='form-control' name='ls_maintenance[".$this->results['ls_id']."]' id='ls_maintenance[".$this->results['ls_id']."]' value='".number_format($this->results['ls_maintenance'],2)."'/>" ;

								$this->view .= "</td>";

								$this->view .= "<td class='text-right'>";//profit

									if($this->results['ls_profit'] <> 0 || $this->results['ls_profit'] <> "0.00"){
										$this->grand_ttl_profit	+= $this->results['ls_profit'];
									}

									$this->view .= "<input type='text' class='form-control' name='ls_profit[".$this->results['ls_id']."]' id='ls_profit[".$this->results['ls_id']."]' value='".number_format($this->results['ls_profit'],2)."'/>" ;
								$this->view .= "</td>";


							$this->view .= "</tr>";


							$this->no++;

						}/********** ($this->results = $db1->fetch_array($this->execute)) while closing **********/


					$this->view .= "</tbody>";


					$this->view .= "<tfoot>";
						$this->view .= "<tr>";
							$this->view .= "<td class='text-right' colspan='4'>";
								$this->view .= "<h3>GRAND TOTAL (RM): </h3>";
								$this->view .= "<input type='hidden' class='form-control' name='total_ls2update' id='total_ls2update' value='".$this->no."'/>" ;
								//$this->view .= "<input type='hidden' class='form-control' name='all_ls_views2update' id='all_ls_views2update' value='".$this->ls_view_id."'/>" ;
							$this->view .= "</td>";
							$this->view .= "<td class='text-right'><h3>".$this->grand_ttl_do."</h3></td>";
							$this->view .= "<td class='text-right'><h3>".number_format($this->grand_ttl_cost,2)."</h3></td>";
							$this->view .= "<td class='text-right'><h3>".number_format($this->grand_ttl_frieght,2)."</h3></td>";
							$this->view .= "<td class='text-right'><h3>".number_format($this->grand_ttl_tripcost,2)."</h3></td>";
							$this->view .= "<td class='text-right'><h3>".number_format($this->grand_ttl_maintenance,2)."</h3></td>";
							$this->view .= "<td class='text-right'><h3>".number_format($this->grand_ttl_profit,2)."</h3></td>";
						$this->view .= "</tr>";
					$this->view .= "</tfoot>";

				$this->view .= "</table>";/********** table closing **********/
				
				
				//$this->view .= "<script type='text/javascript'>";
				
				//foreach($this->ls_view_id as $this->ls_view_id_now => $this->ls_view_id_value){
				//foreach($this->ls_view_id2 as $this->ls_view_id2_value){
					
					//$this->ls_view_id2_newvalue	= explode("@",$this->ls_view_id2_value);
					
					//$this->view .= "var tripprofit".$this->ls_view_id2_newvalue[0]." 	= ".$this->ls_view_id2_newvalue[1].";";
					//$this->view .= "var fnltripprofit".$this->ls_view_id2_newvalue[0]."	= 0;";
					
					//$this->view .= "jQuery('".$this->ls_view_id2_newvalue[0]."').click(function() {";

						//$this->view .= "alert('final amount ' + tripprofit".$this->ls_view_id2_newvalue[0]." + '<br>');";

						/* $this->view .= "var tripprofit".$this->ls_view_id_now." 	= 0;";
						$this->view .= "var fnltripprofit".$this->ls_view_id_now."	= 0;";
						
						$this->view .= "tripprofit".$this->ls_view_id_now." 		= Number(".$this->ls_view_id_value2[0]." - ".$this->ls_view_id_value2[1]." - jQuery('#ls_tripcost[".$this->ls_view_id_now."]').val() - jQuery('#ls_maintenance[".$this->ls_view_id_now."]').val());";
						
						$this->view .= "fnltripprofit".$this->ls_view_id_now." 		= tripprofit".$this->ls_view_id_now.".toFixed(2);";
						
						$this->view .= "jQuery('#ls_profit[".$this->ls_view_id_now."]').val(fnltripprofit".$this->ls_view_id_now.");"; */
					//$this->view .= "});";
					
					
					

					/* $this->view .= "jQuery('#ls_profit[133784]').click(function() {";
						$this->view .= "var tripprofit133784 	= 0;";
						//$this->view .= "var fnltripprofit133784	= 0;";

						$this->view .= "tripprofit133784 		= ".$this->ls_view_id_value2[0]." - ".$this->ls_view_id_value2[1]." - Number(jQuery('#ls_tripcost[133784]').val() - jQuery('#ls_maintenance[133784]').val());";

						//$this->view .= "fnltripprofit133784 		= tripprofit133784.toFixed(2);";

						//$this->view .= "jQuery('#ls_profit[133784]').val(fnltripprofit133784);";
						$this->view .= "alert('final amount' + tripprofit133784);";
						
					$this->view .= "});"; */
					
					
//$this->view .= "js loop id: ".$this->ls_view_id_now." <-- value --> : ".$this->ls_view_id_value." <br />";
				//}
				//$this->view .= "</script>";
				
				
				
				$this->view .= "<div class='form-actions fluid'>";
						$this->view .= "<div class='row'>";
							$this->view .= "<div class='col-md-12'>";
								$this->view .= "<div class='col-md-4'>";	
									$this->view .= "<button type='submit' class='btn green'>Update All</button>";
									$this->view .= "&nbsp;&nbsp;&nbsp;&nbsp;";							
									$this->view .= "<button type='reset' class='btn default'>Reset</button>	";							
									$this->view .= "<input type='hidden' value='UpdateNow' id='lgsht_view_history' name='lgsht_view_history'>";
								$this->view .= "</div>";
							$this->view .= "</div>";
						$this->view .= "</div>";
				$this->view .= "</div>";
			
			$this->view .= "</table>";/********** table closing **********/


		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

		return $this->view;
	}




	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF PRINTING LOGSHEET ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_view_update($logsheet_total_2update,$logsheet_freight,$logsheet_tripcost,$logsheet_maintenance,$logsheet_profit,$adm_id,$adm_dept,$adm_branch,$adm_permission){
		if($_SESSION['mychecking_do_blnk_cnhg'] == 1){	
			echo "<p style='color: purple; font-style: italic;'>update do view : 1 masuk->> $logsheet_total_2update,$logsheet_freight,$logsheet_tripcost,$logsheet_maintenance,$logsheet_profit,$adm_id,$adm_dept,$adm_branch,$adm_permission</p>";
		}
		
		global $db1, $php_time, $php_date, $useripadd;

		$this->query_out	= $query_out;
		$this->execute		= $execute;
		$this->results		= $results;
		$this->query_out2	= $query_out2;
		$this->execute2		= $execute2;
		$this->results2		= $results2;
		$this->query_out3	= $query_out3;
		$this->execute3		= $execute3;
		$this->results3		= $results3;
		$this->query_out4	= $query_out4;
		$this->execute4		= $execute4;
		$this->results4		= $results4;
		$this->query_out5	= $query_out5;
		$this->execute5		= $execute5;
		$this->results5		= $results5;

		
		$this->logsheet_total_2update	= $logsheet_total_2update;
		$this->logsheet_freight			= $logsheet_freight;
		$this->logsheet_tripcost		= $logsheet_tripcost;
		$this->logsheet_maintenance		= $logsheet_maintenance;//array style
		$this->logsheet_profit			= $logsheet_profit;
		$this->no_fbp			= $no_fbp;
		
		
		$this->adm_id			= $adm_id;
		$this->adm_dept			= $adm_dept;
		$this->adm_branch		= $adm_branch;
		$this->adm_permission	= $adm_permission;
		$this->full_date		= $php_time;
		$this->php_date			= $php_date;
		
		

		$this->view		= $view;
		$this->process	= "";
		
		
		/********** log purpose start **********/
		$this->log_action 	= "Update L/S Profit (New Sys)";
		$this->log_desc 	= "";
		$this->log_result 	= "";
		$this->log_error 	= "";
		$this->log_ipadd 	= $useripadd;
		$this->updated_by	= $adm_id;
		/********** log purpose start **********/
		
		//exit;

		/**********  loop until the id inside all settled start **********/
		//for($this->loop_cnt=0;$this->loop_cnt < $this->logsheet_total_2update;$this->loop_cnt++){
		foreach($this->logsheet_freight as $this->logsheet_freight_id => $this->logsheet_freight_new){

			/**********  verify the temp do status n existence **********/
			$this->query_out_lsno = "select * from ymt_logsheet where ls_id='".$this->logsheet_freight_id."' and ls_status = 1";
			if($_SESSION['mychecking_do_blnk_cnhg'] == 1){	
				echo "<p style='color: purple; font-style: italic;'>1->> $this->query_out_lsno</p>";		
			}

			$this->execute_lsno = $db1->query($this->query_out_lsno);
			
			/**********  getting the logsheet result **********/
			if ($db1->num_rows($this->execute_lsno) == 0){
				$this->view			= "xexist";
				$this->log_result 	= "L/S : ".$this->logsheet_freight_id." invalid.";
				$this->log_error 	= "Error";
				$this->log_desc 	= $this->query_out_lsno;
			}else{
				
				/********** Getting logsheet information **********/
				$this->results_lsno = $db1->fetch_assoc($this->execute_lsno);
				
				$this->query_out2  = "UPDATE ymt_logsheet SET ";					
				$this->query_out2 .= " ls_trip_cost = '".$this->logsheet_tripcost[$this->logsheet_freight_id]."', ";
				$this->query_out2 .= " ls_maintenance = '".$this->logsheet_maintenance[$this->logsheet_freight_id]."', ";
				$this->query_out2 .= " ls_profit = '".($this->logsheet_freight_new - $this->results_lsno['ls_advance'] - $this->logsheet_maintenance[$this->logsheet_freight_id] - $this->logsheet_tripcost[$this->logsheet_freight_id])."', ";
				$this->query_out2 .= " ls_updated_on_2 = '".$this->full_date."', ls_updated_by_2 = '".$this->adm_id."' ";	

				$this->query_out2 .= " WHERE ls_id='".$this->logsheet_freight_id."' and ls_status = 1";
				
				if($_SESSION['mychecking_do_blnk_cnhg'] == 1){	
					echo "<p style='color: purple; font-style: italic;'>3->> insert in do : $this->query_out2 : $this->logsheet_freight_new</p>";
				}			
				
				$this->execute2 = $db1->query($this->query_out2);
				if($this->execute2){
					$this->view			= "ls_view_updated";
					$this->log_result 	= "Successfully updated L/S Profit on : ".$this->logsheet_freight_id.".";
					//$this->log_error 	= "Error";
					$this->log_desc 	= $this->query_out2;
					
				}
			

			}/***** total big closure *****/

		}/**********  forloop until the id inside all settled end **********/
		
		$this->log_result = $this->ymtt_log($this->log_action, str_replace("'","",$this->log_desc), $this->log_result, $this->log_error, $this->updated_by, $this->log_ipadd, $this->full_date);
		
		//echo "final view : ".$this->view;
		//exit;
		return $this->view;
	}
	
	
	
	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF LISTING LOGSHEET DETAILS ONLY						   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_listing_details($adm_id, $adm_dept, $adm_branch, $adm_permission, $ls_report_branch, $date_shj, $date_shj2, $date_shj3, $date_shj4, $full_date,$pg_name,$page_no,$order_type,$ordering,$filtering){
		global $db1,$useripadd,$php_time,$pg_lftmenu_lgsht;
		
		$this->query_out	= $query_out;
		$this->execute		= $execute;
		$this->results		= $results;
		$this->query_out2	= $query_out2;
		$this->execute2		= $execute2;
		$this->results2		= $results2;
		$this->query_out3	= $query_out3;
		$this->execute3		= $execute3;
		$this->results3		= $results3;
		$this->query_out4	= $query_out4;
		$this->execute4		= $execute4;
		$this->results4		= $results4;
		$this->query_out5	= $query_out5;
		$this->execute5		= $execute5;
		$this->results5		= $results5;
				
		$this->adm_id			= $adm_id;
		$this->adm_dept			= $adm_dept;
		$this->adm_branch		= $adm_branch;
		$this->adm_permission	= $adm_permission;
		$this->ls_report_branch = $ls_report_branch;

		$this->colfrm	= "";
		$this->delto	= "";

		$this->date_shj	 = $date_shj;
		$this->date_shj2 = $date_shj2;
		$this->date_shj3 = $date_shj3;
		$this->date_shj4 = $date_shj4;
		$this->full_date = $full_date;

		$this->pg_name 			= $pg_name;
		$this->pg_lftmenu_lgsht	= $pg_lftmenu_lgsht;
		
		/**** Ordering purposes ****/
		$this->order_type 	= $order_type;
		$this->ordering 	= $ordering;
		$this->filtering 	= $filtering;
		$this->pg_ordering 	= "";
		$this->font_style 	= "";
		$thie->ahref		= "";

		/**** Paging purposes ****/
		$this->page_no 		= $page_no;
		$this->page_size 	= 30;
		$this->start_row 	= 0;
	
		
						
		/**********  logsheet info **********/
		//$this->query_out = "select a.ls_id, a.ls_no, a.ls_driver, a.ls_issued_date, a.ls_trip_no, b.lsi_do_no, b.lsi_consignor, b.lsi_to, c.lorry_id, c.lorry_regno, d.driver_name, d.driver_mobile from ymt_logsheet a, ymt_logsheet_item b, ymt_lorry c, ymt_driver d where a.ls_id = b.lsi_ls_id and a.ls_lorry_no = c.lorry_id and a.ls_driver = d.driver_id and ls_branch= '$this->adm_branch' and ls_issued_date between '$this->date_shj' and '$this->date_shj3' group by ls_trip_no order by ls_issued_date desc";
		
		$this->query_out = "select a.ls_id, a.ls_no, a.ls_driver, a.ls_issued_date, a.ls_delivery_date, date_format(ls_delivery_date, '%d %b %Y') as date_delivered, a.ls_advance, a.ls_trip_no, a.ls_destination_branch, c.lorry_id, c.lorry_regno from ymt_logsheet a, ymt_lorry c where a.ls_lorry_no = c.lorry_id and ls_branch= '".strtoupper($this->ls_report_branch)."' and ls_delivery_date between '$this->date_shj' and '$this->date_shj3' and ls_status = 1 order by ls_issued_date ".$this->ordering;
		
		/**** Set the page no ****/
		if(empty($this->page_no)){
			if($this->start_row  == 0){
				$this->page_no = $this->start_row + 1;
				$this->no = 0;
			}
		}else{
			$this->start_row = ($this->page_no - 1) * $this->page_size;
			$this->no = $this->start_row + 1;
		}

		/**** Set the counter start ****/
		if($this->page_no % $this->page_size == 0){
			$this->counter_start = $this->page_no - ($this->page_size - 1);
		}else{
			$this->counter_start = $this->page_no - ($this->page_no % $this->page_size) + 1;
		}

		/**** Counter End ****/
		$this->counter_end = $this->counter_start + ($this->page_size - 1);

		$this->execute = $db1->query($this->query_out);
		
		$this->data_num	= $db1->num_rows($this->execute);

		$this->query_out .= " LIMIT $this->start_row,$this->page_size";
		//echo "<p style='color: purple;'> after pagin : $this->query_out</p>";
		$this->record_count = $db1->num_rows($this->execute);

		$this->max_page = $this->record_count % $this->page_size;
		if($this->record_count % $this->page_size == 0){
			$this->max_page = $this->record_count / $this->page_size;
		}else{
			$this->max_page = ceil($this->record_count / $this->page_size);
		}
		
		//echo "1st-> $this->query_out";
		$this->execute = $db1->query($this->query_out);
		
		/**********  getting the logsheet result **********/
		if ($db1->num_rows($this->execute) == 0){

			$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center'>";
			$this->view .= "<tr>";
			$this->view .= "<td valign='top' colspan='6' align='right' style='font-size: 1.6em; border-bottom: 3px solid #999; ' height='35'>From &nbsp;&nbsp; $this->date_shj2 &nbsp;&nbsp; to &nbsp;&nbsp;  $this->date_shj4</td>";
			$this->view .= "</tr>";
			$this->view .= "<tr>";
			$this->view .= "<td height='40'>&nbsp;</td>";
			$this->view .= "</tr>";
			$this->view .= "</table>";/********** table closing **********/
			$this->record_found_today = "no";
		}else{
			
			$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center'>";
			$this->view .= "<tr>";
			$this->view .= "<td valign='top' colspan='6' align='right' style='font-size: 1.3em; border-bottom: 3px solid #999;' height='35'>From &nbsp;&nbsp; <span style='font-size: 1.6em;'>$this->date_shj2 </span>&nbsp;&nbsp; to &nbsp;&nbsp; <span style='font-size: 1.6em;'>$this->date_shj4</span></td>";
			$this->view .= "</tr>";
			$this->view .= "<tr>";
			$this->view .= "<td>&nbsp;</td>";
			$this->view .= "</tr>";
			$this->view .= "</table>";/********** table closing **********/

	$this->no 			= 1;

			/********** Getting logsheet information **********/
			/********** Getting logsheet information **********/
			while($this->results = $db1->fetch_array($this->execute)){/********** while opening **********/

				if($this->no % 2 == 0){
					if($this->results['ls_backdate'] == 1){
						$this->bck_color = "#005DB3";
						$this->font_color = "#FFFFFF";
					}else{
						$this->bck_color = "#FFFFFF";
						$this->font_color = "#666666";
					}
				}else{
					if($this->results['ls_backdate'] == 1){
						$this->bck_color = "#005DB3";
						$this->font_color = "#FFFFFF";
					}else{
						$this->bck_color = "#F2F4F8";
						$this->font_color = "#666666";
					}
					
				}

				$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center' style='background: $this->bck_color; color: $this->font_color'>";
				$this->view .= "<tr>";
				$this->view .= "<td align='left' style='font-size: 1.25em; width: 70px; vertical-align: middle;' height='45'>Trip No</td>";
				$this->view .= "<td width='20' style=' vertical-align: middle;'>&nbsp;:&nbsp;</td>";
				$this->view .= "<td align='left' style='font-size: 1.25em; width: 95px; vertical-align: middle;'><strong>".$this->results['ls_trip_no']."</strong>";
				$this->view .= "<input type='hidden' name='lsid' id='lsid' value='".$this->results['ls_id']."' size='3'>";
				$this->view .= "</td>";

				$this->view .= "<td valign='top' align='left' style='font-size: 1.25em; width: 70px; vertical-align: middle;'>Driver</td>";
				$this->view .= "<td width='20' style=' vertical-align: middle;'>&nbsp;:&nbsp;</td>";
				$this->view .= "<td valign='top' align='left' style='font-size: 1.25em; width: 270px; vertical-align: middle;'><strong>";

				$this->query_out6 = "select driver_id, driver_name, driver_mobile from ymt_driver where driver_id='".$this->results['ls_driver']."'";
				//echo "<p>1st-> $this->query_out6</p>";
				$this->execute6 = $db1->query($this->query_out6);
				$this->results6 = $db1->fetch_array($this->execute6);
				$this->view .= "<a href='ymtt_driver_info.php?drv_id=".$this->results6['driver_id']."'>".$this->results6['driver_name']."</a></strong>(".$this->results6['driver_mobile'].")";

				$this->view .= "</td>";
				
				$this->view .= "<td valign='top' align='left' style='font-size: 1.25em; width: 90px; vertical-align: middle;'>Logsheet No</td>";
				$this->view .= "<td width='20' style=' vertical-align: middle;'>&nbsp;:&nbsp;</td>";
				$this->view .= "<td align='left' style='font-size: 1.25em; width: 110px; vertical-align: middle;'>";
				
				$this->view .= "<strong><a href='ymtt_logsheet_info.php?ls_id=".$this->results['ls_id']."' ";

				if($this->results['ls_backdate'] == 1){
					$this->view .= " style='color: #000000;'";
				}

				$this->view .= ">".$this->results['ls_no']."</a></strong></td>";

				$this->view .= "<td valign='top' align='left' style='font-size: 1.25em; width: 90px; vertical-align: middle;'>Dest. Branch</td>";
				$this->view .= "<td width='20' style=' vertical-align: middle;'>&nbsp;:&nbsp;</td>";
								
				$this->view .= "<td align='right' style='font-size: 1.25em;  vertical-align: middle; width: 30px;'>";
				$this->view .= $this->results['ls_destination_branch'];

				
				$this->view .= "</td>";
				$this->view .= "</tr>";

				$this->view .= "<tr>";
				$this->view .= "<td valign='top' align='left' style='font-size: 1.25em; ' height='35'>Lorry No</td>";
				$this->view .= "<td width='20' style=' '>&nbsp;:&nbsp;</td>";
				
				
				$this->view .= "<td align='left' style='font-size: 1.25em; width: 95px; '>";
				$this->view .= "<strong><a href='ymtt_lorry_info.php?lry_id=".$this->results['lorry_id']."&lry_regno=".$this->results['lorry_regno']."' ";

				if($this->results['ls_backdate'] == 1){		$this->view .= " style='color: #000000;'";			}
				$this->view .= ">".$this->results['lorry_regno']."</a></strong>";
				$this->view .= "</td>";

							
				$this->view .= "<td valign='top' align='left' style='font-size: 1.25em; '>Attendant</td>";
				$this->view .= "<td width='20'>&nbsp;:&nbsp;</td>";
				
				$this->view .= "<td valign='top' align='left' style='font-size: 1.25em; width: 220px;'><strong>";
				$this->query_out6_1 = "select driver_id, driver_name, driver_mobile from ymt_driver where driver_id='".$this->results['ls_driver']."'";
				//echo "<p>1st-> $this->query_out6</p>";
				$this->execute6_1 = $db1->query($this->query_out6_1);
				$this->results6_1 = $db1->fetch_array($this->execute6_1);
				$this->view .= "<a href='ymtt_driver_info.php?drv_id=".$this->results6_1['driver_id']."'>".$this->results6_1['driver_name']."</a></strong>(".$this->results6_1['driver_mobile'].")";

				$this->view .= "</td>";


				$this->view .= "<td valign='top' align='left' style='font-size: 1.25em; '>Arrived Date</td>";
				$this->view .= "<td width='20'>&nbsp;:&nbsp;</td>";
				$this->view .= "<td align='left' style='font-size: 1.25em; color: #ff0000; font-weight: bold;'>";
				$this->view .= $this->results['date_delivered'];
				$this->view .= "</td>";

				$this->view .= "<td valign='top' align='left'>";
				$this->view .= "<strong style='font-size: 16px; text-decoration: underline;'>RM ".$this->results['ls_advance']."</strong>";
				$this->view .= "</td>";

				$this->view .= "<td width='20'>";
				$this->view .= "&nbsp;";
				$this->view .= "</td>";
				$this->view .= "<td valign='top' align='right'>";
					
					//$this->view .= "<div style='float: left; width: 55px; '>";
					/* check if no of item of tat logsheet is more tan 16 (start) - 08092012  */
					//1) get the num of logsheet item.
					//2) get the num of do item.
					//3) add all n check if > 16
					//echo "pgbrk cntr : ".$this->lgsht_no_itm." for lg id : ".$this->results['ls_id']." <br><br> ";
					
					$this->lgsht_no_itm	= 0;
					$this->itmcntstart 	= 1;
					$this->prnt_link_extra = "";
					$this->pgbrk_do_itm_id = "";
		
		
					$this->query_out_lgsht_no_itm 	= "select lsi_id, lsi_ls_id, lsi_do_id from ymt_logsheet_item where lsi_ls_id = '".$this->results['ls_id']."' and lsi_status = 1 order by lsi_id asc";
					//echo "<p>3rd - 2-> $this->query_out_lgsht_no_itm</p>";
					$this->execute_lgsht_no_itm 	= $db1->query($this->query_out_lgsht_no_itm);
					if($db1->num_rows($this->execute_lgsht_no_itm) > 0 ){
					
						//echo "lgsht cnt : ".$db1->num_rows($this->execute_lgsht_no_itm)."  for lg id : ".$this->results['ls_id']." --> ";
						
													
						while($this->results_lgsht_no_itm = $db1->fetch_array($this->execute_lgsht_no_itm)){/********** while opening **********/
							
							$this->lgshtid_cnted = $this->results_lgsht_no_itm['lsi_ls_id'];
							$this->query_out_do_no_itm 	= "select doi_id from ymt_do_item where doi_do_id = '".$this->results_lgsht_no_itm['lsi_do_id']."' ";
							//echo "<p>3rd - 3-> $this->query_out_do_no_itm</p>";
							$this->execute_do_no_itm 	= $db1->query($this->query_out_do_no_itm);
							
							if($db1->num_rows($this->execute_do_no_itm) > 0 ){
								//echo "do cnt : ".$db1->num_rows($this->execute_do_no_itm)." for lg id : ".$this->results['ls_id']."<br>";
								
								$this->itmidcntstart 	= 1;
								$this->lgsht_no_itm	+= $db1->num_rows($this->execute_do_no_itm);
								
								if($this->lgsht_no_itm == 16 ){			$this->pgbrk_do_itm_id = "&itm_id=".$this->results_lgsht_no_itm['lsi_do_id'];		}
								
							}else{
								$this->lgsht_no_itm++;
							}
							
							//echo "<p><strong>final cnt : $this->itmcntstart) ".$this->lgsht_no_itm."</strong> for lg id : ".$this->results['ls_id']."<br>";
							$this->itmcntstart++;
							
						}/********** while closing **********/
						
						
					}else{
						$this->lgsht_no_itm = 0;
					}

					if($this->lgsht_no_itm > 16 ){		$this->prnt_link_extra = "&pg=break";		}					
					
					/* check if no of item of tat logsheet is more tan 16 (end) - 08092012  */
					//$this->view .= "</div>";
					
						
					$this->view .= "<a href='".$this->pg_lftmenu_lgsht['link_41']."&ls_id=".$this->results['ls_id'].$this->prnt_link_extra."&itm=".$this->lgsht_no_itm.$this->pgbrk_do_itm_id."' target='_blank'><img src='images/print.png' style='text-decoration: none; border: 0px;'></a>";
					
					
				
				$this->view .= "</td>";
				$this->view .= "</tr>";
				$this->view .= "</table>";/********** table closing **********/


				/**********  today's logsheet info **********/
				$this->query_out2 = "SELECT lsi_id, lsi_do_id  FROM `ymt_logsheet_item` WHERE lsi_ls_id = '".$this->results['ls_id']."' and lsi_status = 1";
				//echo "<p>1st-> $this->query_out2</p>";
				$this->execute2 = $db1->query($this->query_out2);
							

				/**********  getting the logsheet result **********/
				if ($db1->num_rows($this->execute2) == 0){
					$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center'>";
					$this->view .= "<tr>";
					$this->view .= "<td valign='top' colspan='6' align='right' style='font-size: 1.3em; border-bottom: 3px solid #999;' height='35'>Date : $this->date_shj2</td>";
					$this->view .= "</tr>";
					$this->view .= "<tr>";
					$this->view .= "<td>&nbsp;</td>";
					$this->view .= "</tr>";
					$this->view .= "</table>";/********** table closing **********/
					$this->record_found_today = "no";
				}else{
					
					$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' style='border: 1px solid #DDDDDD; background: $this->bck_color; color: $this->font_color' align='center'>";
					$this->view .= "<tr>";
					$this->view .= "<th valign='top' width='55' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;'>DO No</th>";
					$this->view .= "<th valign='top' width='170' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;'>Consignor</th>";
					$this->view .= "<th valign='top' width='100' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;'>From</th>";
					$this->view .= "<th valign='top' width='170' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;'>Consignee</th>";
					$this->view .= "<th valign='top' width='100' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; '>To</th>";
					$this->view .= "<th valign='top' width='200' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;'>Description</th>";
					$this->view .= "<th valign='top' width='80' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; '>Quantity</th>";
					$this->view .= "<th valign='top' width='80' align='left' style='border-bottom: 1px solid #DDDDDD;'>Weight</th>";
					$this->view .= "</tr>";

					/********** Getting logsheet information **********/
					while($this->results2 = $db1->fetch_array($this->execute2)){/********** while opening **********/
					//print_r($this->results2);
					//print_r("<br>");
						
						$this->view .= "<tr>";
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top;'>";	
						
						$this->query_out7 = "select do_id, do_no, do_consignor, do_collect_frm, do_consignee, do_deliver_to, do_deliver_to2 from ymt_do where do_id = '".$this->results2['lsi_do_id']."' and do_status = 1";
						//echo "<p>Q7 : $this->query_out7</p>";
						$this->execute7 = $db1->query($this->query_out7);
						$this->results7 = $db1->fetch_assoc($this->execute7); 
						$this->colfrm = $this->results7['do_collect_frm'];
						$this->delto = $this->results7['do_deliver_to2'];

						$this->view .= "<a href='ymtt_do_info.php?dorder_id=".$this->results7['do_id']."' ";
						
						if($this->results['ls_backdate'] == 1){		$this->view .= " style='color: #5BC236;'";			}	
						$this->view .= ">".$this->results7['do_no']."</a>&nbsp;&nbsp;";
				
						$this->view .= "</td>";

						/********** grb ls item info frm do item **********/
						$this->query_out20 = "select client_id, client_name as consignee_name from ymt_client where client_id='".$this->results7['do_consignor']."' and (client_status = 1 || client_status = 3)";
						//echo "<p>1st-> $this->query_out2</p>";
						$this->execute20 = $db1->query($this->query_out20);
						$this->results20 = $db1->fetch_assoc($this->execute20);


						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top; text-align: left;'>";
							$this->view .= "<a href='ymtt_client_info.php?clnt_id=".$this->results20['client_id']."' ";
							
							if($this->results['ls_backdate'] == 1){			$this->view .= " style='color: #5BC236;'";			}
							$this->view .= ">".$this->results20['consignee_name']."</a>";
						$this->view .= "</td>";
					
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top;'>".$this->colfrm."</td>";						
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top;'>";
					
							$this->query_out3 = "select client_id, client_name as consignee_name from ymt_client where client_id='".$this->results7['do_consignee']."' and (client_status = 1 || client_status = 3)";
							//echo "<p>3st-> $this->query_out_3</p>";
							$this->execute3 = $db1->query($this->query_out3);
							$this->results3 = $db1->fetch_array($this->execute3);
							$this->view .= "<a href='ymtt_client_info.php?clnt_id=".$this->results3['client_id']."' ";
							
							if($this->results['ls_backdate'] == 1){			$this->view .= " style='color: #5BC236;'";			}
							$this->view .= ">".$this->results3['consignee_name']."</a>";				
						
						$this->view .= "</td>";	
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top;'>".$this->delto."</td>";

						$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;' colspan='3'>"; 

							$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center'>";


								/**********  today's logsheet info **********/
								$this->query_out4 = "select doi_desc, doi_qty, doi_weight from ymt_do_item where doi_do_id = '".$this->results7['do_id']."' order by doi_id desc";
								//echo "<p>1st-> $this->query_out4</p>";
								$this->execute4 = $db1->query($this->query_out4);
								
								while($this->results4 = $db1->fetch_array($this->execute4)){/********** while opening **********/
									$this->view .= "<tr>";
									$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;' width='200'>".$this->results4['doi_desc']."</td>";
									$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 82px;' >".$this->results4['doi_qty']."</td>";
									$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD;  width: 82px;' >".$this->results4['doi_weight']."</td>";
									$this->view .= "</tr>";
								}

							
							$this->view .= "</table>";/********** table of logsheet item record closing **********/

						$this->view .= "</td>";
						$this->view .= "</tr>";
						

					}/********** while closing **********/

					$this->view .= "</table>";/********** table of logsheet item record closing **********/

					$this->view .= "<br><hr style='color: #f00; background-color: #f00; height: 5px;' /><br>";/********** break **********/

				}/********** if ($db1->num_rows($this->execute2) == 0) else closing **********/

				$this->view .= "<br><br>";/********** table closing **********/
				$this->no++;

			}/********** while closing **********/
			
			
			$this->view .= "<!--start pagination-->";

				$this->view .= "<div class='pagination' style='margin-bottom: 10px;  ";
					if($this->max_page > 18 && $this->max_page < 37 ){	$this->view .= " height: 70px; ";		}
					
					if($this->max_page > 36 && $this->max_page < 55 ){	$this->view .= " height: 110px; ";		}
					
					if($this->max_page > 54 && $this->max_page < 73 ){	$this->view .= " height: 140px; ";		}
					
					if($this->max_page > 72 && $this->max_page < 91 ){	$this->view .= " height: 170px; ";		}
				$this->view .= " ' >";
				
							
				if($this->page_no > 1){ //prev page
					$this->page_no_inside = $this->page_no - 1;
					$this->view .= "<a class='read' href='".$this->pg_name."?branch=".$this->adm_branch."&search_option=".$this->search_option."&active_option=".$this->active_option."&start_date=".$this->date_shj."&end_date=".$this->date_shj3."&pg_no=".$this->page_no_inside."&order_type=".$this->order_type."&ordering=".$this->ordering."&filtering=".$this->filtering."&proc=yes' title=''>&laquo; Prev</a>";
				}

				for($this->paging_no=1;$this->paging_no<=$this->max_page;$this->paging_no++){
					
					if($this->paging_no == $this->page_no){		$thie->ahref = "read read_highlighted";		}else{		$thie->ahref = "read";		}
					
					
					$this->view .= "<a class='".$thie->ahref."' href='".$this->pg_name."?branch=".$this->adm_branch."&search_option=".$this->search_option."&active_option=".$this->active_option."&start_date=".$this->date_shj."&end_date=".$this->date_shj3."&pg_no=".$this->paging_no."&order_type=".$this->order_type."&ordering=".$this->ordering."&filtering=".$this->filtering."&proc=yes' title='' ";
					
					 if($this->page_no == $this->paging_no){ $this->view .= " class='active' "; } 
					
					$this->view .= ">$this->paging_no</a>";
					
					if($this->paging_no == 18 || $this->paging_no == 36 || $this->paging_no == 54 || $this->paging_no == 72 ){	$this->view .= "<div class='clear' style='height: 30px;'></div>";		}
				}
				
				if($this->page_no < $this->max_page){ //nxt page
					$this->page_no_inside = $this->page_no + 1;
					$this->view .= "<a class='read' href='".$this->pg_name."?branch=".$this->adm_branch."&search_option=".$this->search_option."&active_option=".$this->active_option."&start_date=".$this->date_shj."&end_date=".$this->date_shj3."&pg_no=".$this->page_no_inside."&order_type=".$this->order_type."&ordering=".$this->ordering."&filtering=".$this->filtering."&proc=yes' title=''>Next &raquo;</a>";
				}
				
				$this->view .= "</div>";
			$this->view .= "<!--end pagination-->";
			$this->view .= "<div class='clear'></div>";


		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/


		return $this->view;
	}
	


	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF GET DELIVERY ORDER NO ONLY							   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_no_get($adm_id,$adm_dept,$adm_branch,$adm_permission,$full_date){
		global $db1;
		
		$this->query_out = $query_out;
		$this->execute = $execute;
		$this->results = $results;
						
		$this->adm_id = $adm_id;
		$this->adm_dept = $adm_dept;
		$this->adm_branch = $adm_branch;
		$this->adm_permission = $adm_permission;

		/********** Do date info **********/
		$this->full_date = $full_date;
		
		/********** DO NO info **********/
		$this->query_out = "select * from ymt_logsheet_no where ls_no_branch = '$this->adm_branch' and ls_no_status = 1";
		//echo "1st-> $this->query_out";
		$this->execute = $db1->query($this->query_out);
		
		/**********  getting the do no result **********/
		if ($db1->num_rows($this->execute) == 0){
			$this->view .= "<input type='text' id='lsno_start_no' name='lsno_start_no' value='00000001' />";
		}else{

			/********** Getting do information **********/
			$this->results = $db1->fetch_array($this->execute);

			$this->view .= "<input type='hidden' value='".$this->results['ls_no_id']."' id='lsno_id' name='lsno_id' />";//running no
			$this->view .= "<input type='text' id='lsno_start_no' name='lsno_start_no' value='".$this->results["ls_no_start"]."' />";	

		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

		return $this->view;
	}



	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF SET DELIVERY ORDER NO ONLY							   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_no_set($adm_id,$logsheet_no,$logsheet_id,$adm_dept,$adm_branch,$adm_permission,$full_date){
		global $db1;
		
		$this->query_out = $query_out;
		$this->execute = $execute;
		$this->results = $results;
		$this->query_out2 = $query_out2;
		$this->execute2 = $execute2;
		$this->results2 = $results2;
						
		$this->adm_id = $adm_id;
		$this->logsheet_no = $logsheet_no;
		$this->logsheet_id = $logsheet_id;
		$this->adm_dept = $adm_dept;
		$this->adm_branch = $adm_branch;
		$this->adm_permission = $adm_permission;

		/********** Do date info **********/
		$this->full_date = $full_date;
		
		/********** DO NO info **********/
		$this->query_out = "select * from ymt_logsheet_no where ls_no_branch = '$this->adm_branch' and ls_no_status = 1";
		//echo "1st-> $this->query_out";
		$this->execute = $db1->query($this->query_out);
		
		/**********  getting the do no result **********/
		if ($db1->num_rows($this->execute) == 0){
			$this->query_out2 = "insert into ymt_logsheet_no (ls_no_start, ls_no_branch, ls_no_date) values ('$this->logsheet_no', '$this->adm_branch', '$this->full_date') ";
		}else{
			$this->query_out2 = "update ymt_logsheet_no set ls_no_start = '$this->logsheet_no', ls_no_date = '$this->full_date' where ls_no_id = '$this->logsheet_id' and ls_no_status = 1 and ls_no_start <>''";	
		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

		$this->execute2 = $db1->query($this->query_out2);

		if($this->execute2){		
			$this->view = $this->logsheet_no;
		}

		return $this->view;
	}



	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF SET DELIVERY ORDER NO ONLY							   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_destination($adm_id,$adm_dept,$adm_permission,$logsheet_id,$logsheet_destination,$logsheet_origin,$logsheet_advance_cash,$logsheet_driver,$logsheet_attendant, $logsheet_drv_change, $nrmal, $extr1, $extr2, $extr3, $adv1, $adv2, $adv3, $ddct1, $ddct2, $ddct3, $teid, $update_me, $os_name, $os_regno, $os_lry_type, $full_date,$tomorrow_only){
		if($_SESSION['mychecking'] == 1 || $adm_id == 1){	
			//echo "<p>wir lgsht dest->> $adm_id,$adm_dept,$adm_permission,$logsheet_id,$logsheet_destination,$logsheet_origin,$logsheet_advance_cash,$logsheet_driver,$logsheet_attendant, $logsheet_drv_change, $nrmal, $extr1, $extr2, $extr3, $adv1, $adv2, $adv3, $ddct1, $ddct2, $ddct3, $teid, $update_me, $os_name, $os_regno, $os_lry_type, $full_date,$tomorrow_only</p>";		
			//exit;
		}
		global $db1, $php_time, $php_date, $php_mth, $php_yr, $useripadd;
		
		$this->query_out	= $query_out;
		$this->execute		= $execute;
		$this->results		= $results;
		$this->query_out2	= $query_out2;
		$this->execute2		= $execute2;
		$this->results2		= $results2;

		$this->adm_id				= $adm_id;
		$this->adm_dept				= $adm_dept;
		$this->adm_permission		= $adm_permission;
		$this->logsheet_id			= $logsheet_id;
		$this->logsheet_destination = $logsheet_destination;
		$this->logsheet_origin		= $logsheet_origin;
		$this->logsheet_advance_cash= $logsheet_advance_cash;
		$this->logsheet_driver		= $logsheet_driver;
		$this->logsheet_attendant	= $logsheet_attendant;
		$this->logsheet_drv_change	= $logsheet_drv_change;
		
		$this->nrmal	= $nrmal;
		$this->extr1	= $extr1;
		$this->extr2	= $extr2;
		$this->extr3	= $extr3;
		$this->adv1		= $adv1;
		$this->adv2		= $adv2;
		$this->adv3		= $adv3;
		$this->ddct1	= $ddct1;
		$this->ddct2	= $ddct2;
		$this->ddct3	= $ddct3;
		
		$this->teid			= $teid;
		$this->update_me	= $update_me;
		
		$this->os_name		= $os_name;
		$this->os_regno		= $os_regno;
		$this->os_lry_type	= $os_lry_type;

		$this->logsheet_newno	= "";
		$this->lorry_booked		= "";
		$this->delvry_date		= "";
		$this->te_new_id		= "";

		/********** Do date info **********/
		$this->full_date			= $php_time;
		$this->php_date				= $php_date;
		$this->php_mth				= $php_mth;
		$this->php_yr				= $php_yr;
		$this->tomorrow_only		= $tomorrow_only;

		/********** log purpose start **********/
		$this->log_action 	= "Change Temp Logsheet 2 Real Logsheet (New Sys)";
		$this->log_desc 	= "";
		$this->log_result 	= "";
		$this->log_error 	= "";
		$this->log_ipadd 	= $useripadd;
		$this->updated_by	= $adm_id;
		/********** log purpose start **********/
		
		
		/********** LS NO info **********/
		$this->query_out = "select * from ymt_logsheet where ls_id = '$this->logsheet_id' and ls_status = 1";
		if($_SESSION['mychecking'] == 1 || $this->adm_id == 1){	
			//echo "<p>1st lgsht dest->> $this->query_out</p>";
			//exit;
		}
		
		$this->execute = $db1->query($this->query_out);
		
		/**********  getting the do no result **********/
		if ($db1->num_rows($this->execute) == 0){
			$this->view			= "invalid_logsheet";	
			$this->log_result 	= "Temp Logsheet : ".$this->logsheet_id." invalid.";
			$this->log_error 	= "Error";
			$this->log_desc 	= $this->query_out;
		}else{

			$this->results			= $db1->fetch_assoc($this->execute);
			$this->lorry_booked 	= $this->results['ls_lorry_no'];
			$this->lgsht_local_r_nt = $this->results['ls_local'];

			//date bug once new ls no issued on nov 15 (start)
			if($this->adm_id == 1 ){
				$this->delvry_date = $this->php_date;
			}else{
				$this->delvry_date	= ($this->logsheet_destination == $this->logsheet_origin) ? $this->php_date : $this->tomorrow_only;//added on 1202012
			}
			//date bug once new ls no issued on nov 15 (end)


			if(empty($this->results['ls_destination_branch']) || $this->results['ls_destination_branch'] <> $this->logsheet_destination){
				$this->logsheet_newno = $this->logsheet_checkno($this->adm_id,"admin",$this->logsheet_origin,$this->logsheet_destination,"full",$this->delvry_date,$this->lorry_booked,$this->lgsht_local_r_nt);
			}

			if($_SESSION['mychecking'] == 1 || $this->adm_id == 1){	
				//echo "<p>local / nt ->> ".$this->lgsht_local_r_nt." - date : ".$this->delvry_date."</p>";
				//echo "<p>new ls no details ->> ";
				//print_r($this->logsheet_newno);
				//echo "</p>";
			}

//exit;
			$this->query_out2 = "update ymt_logsheet set ls_destination_branch = '$this->logsheet_destination', ls_advance = '$this->logsheet_advance_cash', ls_driver = '$this->logsheet_driver', ls_attendant= '$this->logsheet_attendant', ls_approved_by = '$this->adm_id' ";

			if($this->logsheet_newno[2] > 0){	$this->query_out2 .= " , ls_no = '".$this->logsheet_newno[2]."', ls_trip_no = '".$this->logsheet_newno[1]."' "; 	}	/**** added new ls_no update upon req by Ms Lim JB****/

			if( $this->lgsht_local_r_nt == 0  && (!empty($this->delvry_date) || $this->delvry_date <> $this->php_date) ){ 
				$this->query_out2 .= ", ls_delivery_date = '".$this->delvry_date."', ls_delivery_mth = '".substr($this->delvry_date,5,2)."',ls_delivery_yr = '".substr($this->delvry_date,0,4)."' ";
			}
			
			if( $this->lgsht_local_r_nt == 1  && (!empty($this->delvry_date) || $this->delvry_date == $this->php_date) ){  
				$this->query_out2 .= ", ls_delivery_date = '".$this->php_date."', ls_delivery_mth = '".substr($this->php_date,5,2)."',ls_delivery_yr = '".substr($this->php_date,0,4)."' ";
			}
			$this->query_out2 .= " where ls_id = '$this->logsheet_id' and ls_branch = '$this->logsheet_origin' and ls_status = 1";


		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

		if($_SESSION['mychecking'] == 1 || $this->adm_id == 1){	
			//echo "<p>2nd lgsht dest->> $this->query_out2 - dlvry date: ".$this->delvry_date."</p>";
			//exit;	
		}

		$this->execute2 = $db1->query($this->query_out2);


		if($this->execute2){	


			/********** update / change driver permenantly case 03062012 (start) **********/
			if($this->logsheet_drv_change == "yes"){


				/**** get prev lorry drove. reset to available thn update new lorry info 2drv n lorry. 03062012 (start) ****/
				$this->query_out_chng_lry_drv 	= "select driver_lorry_no from ymt_driver where driver_id = '$this->logsheet_driver' and driver_status = 1";
				//if($_SESSION['mychecking'] == 1){	echo "<p>change driver Q ->> $this->query_out_chng_lry_drv</p>";		}
				$this->execute_chng_lry_drv 	= $db1->query($this->query_out_chng_lry_drv);

				if ($db1->num_rows($this->execute_chng_lry_drv) > 0){

					$this->results_chng_lry_drv	= $db1->fetch_assoc($this->execute_chng_lry_drv);

					/**** reset old lorry to available 03062012 (start) ****/
					$this->query_out_old_lry 	= "update ymt_lorry set lorry_drv = 0, lorry_last_updated = '".$this->full_date."' where lorry_id = '".$this->results_chng_lry_drv['driver_lorry_no']."' and lorry_status = 1";
					//if($_SESSION['mychecking'] == 1){	echo "<p>change driver Q ->> $this->query_out_old_lry</p>";		}
					$this->execute_old_lry 		= $db1->query($this->query_out_old_lry);
					/**** reset old lorry to available 03062012 (end) ****/


					if($this->execute_old_lry){


						/**** update prev drv of new lorry 2empty lorry 03062012 (start) ****/
						$this->query_out_prev_drv_new_lry 	= "update ymt_driver set driver_lorry_no = 0, driver_last_updated_on = '".$this->full_date."' where driver_lorry_no = '".$this->lorry_booked."' ";
						//if($_SESSION['mychecking'] == 1){	echo "<p>change driver Q ->> $this->query_out_prev_drv_new_lry</p>";		}
						$this->execute_prev_drv_new_lry 	= $db1->query($this->query_out_prev_drv_new_lry);
						/**** update prev drv of new lorry 2empty lorry 03062012 (end) ****/


						if($this->execute_prev_drv_new_lry){

							/**** update drv info of new lorry 03062012 (start) ****/
							$this->query_out_drv_new_lry 	= "update ymt_driver set driver_lorry_no = '".$this->lorry_booked."', driver_last_updated_on = '".$this->full_date."' where driver_id = '".$this->logsheet_driver."' ";
							//if($_SESSION['mychecking'] == 1){	echo "<p>change driver Q ->> $this->query_out_drv_new_lry</p>";		}
							$this->execute_drv_new_lry 		= $db1->query($this->query_out_drv_new_lry);
							/**** update drv info of new lorry 03062012 (end) ****/


						}else{

							$this->view			= "invalid_old_drv";	
							$this->log_result 	.= "Update Prev DRV of LRY - Lgsht ID : ".$this->lorry_booked." invalid.";
							$this->log_error 	= "Error";
							$this->log_desc 	= $this->query_out_prev_drv_new_lry;

						}



					}else{

						$this->view			= "invalid_lorry";	
						$this->log_result 	.= "Update Lorry - Lgsht ID : ".$this->results_chng_lry_drv['driver_lorry_no']." invalid.";
						$this->log_error 	= "Error";
						$this->log_desc 	= $this->query_out_old_lry;

					}


				}else{

					$this->view			= "invalid_drv";	
					$this->log_result 	.= "Change Drv - Lgsht ID : ".$this->logsheet_driver." invalid.";
					$this->log_error 	= "Error";
					$this->log_desc 	= $this->query_out_chng_lry_drv;

				}/**** get prev lorry drove. reset to available thn update new lorry info 2drv n lorry. 03062012 (end) ****/

			}
			/********** update / change driver permenantly case 03062012 (end) **********/


			/****** Out Source Supplier Update (14062016) - start ******/
			if($this->os_name > 0){

				/**** confirm supplier from the list ****/
				$this->query_out_lry_supplier 	= "select * from ymt_lorry_supplier where lry_splr_id = '".$this->os_name."' and lry_splr_status = 1";
				//if($this->adm_id == 1){	echo "<p>Lry Supplier Q ->> $this->query_out_lry_supplier</p>";		}
				$this->execute_lry_supplier 	= $db1->query($this->query_out_lry_supplier);

				if ($db1->num_rows($this->execute_lry_supplier) == 0){

					$this->view			= "invalid_logsheet_supplier";	
					$this->log_result 	= "Supplier ID : ".$this->os_name." invalid.";
					$this->log_error 	= "Error";
					$this->log_desc 	= $this->query_out_lry_supplier;

				}else{

					$this->query_out_lry_supplier2 	= "update ymt_logsheet set ls_lry_owner = 'outsource', ls_splr_id = '".$this->os_name."', ls_lry_regno = '".$this->os_regno."', ls_lry_type = '".$this->os_lry_type."' where ls_id = '$this->logsheet_id' and ls_status = 1";
					//if($this->adm_id == 1){	echo "<p>Lry Supplier Q ->> $this->query_out_lry_supplier</p>";		}
					$this->execute_lry_supplier2	= $db1->query($this->query_out_lry_supplier2);

					//outsource update at d/o
					$this->query_out_lry_supplier3 = "update ymt_do join ymt_logsheet_item on do_id = lsi_do_id set do_sender = 'outsource' where lsi_ls_id = '$this->logsheet_id' and lsi_status = 1 and do_status = 1";
					//if($this->adm_id == 1){	echo "<p>Update D/O Outsource Q ->> $this->query_out_lry_supplier3</p>";		}
					$this->execute_lry_supplier3   = $db1->query($this->query_out_lry_supplier3);

				}

			}
			/****** Out Source SUpplier Update (14062016) - end ******/


			$this->query_out3	= "update ymt_lorry set lorry_available = 0 where lorry_id = '$this->lorry_booked'";
			//echo "3->> $this->query_out3";
			$this->execute3		= $db1->query($this->query_out3);			
			$this->view			= "success";

			if($this->results['ls_trip_no'] <> ""){			$this->tripno = $this->results['ls_trip_no'];		}else{			$this->tripno = $this->logsheet_newno[1];			}	

			$this->log_result 	= "Successfully changed logsheet : ".$this->logsheet_id. " | Trip no : ".$this->tripno. " | Lorry ID : ".$this->lorry_booked;
			$this->log_desc 	= $this->query_out2;


		}

		$this->log_result = $this->ymtt_log($this->log_action, str_replace("'","",$this->log_desc), $this->log_result, $this->log_error, $this->updated_by, $this->log_ipadd, $this->full_date);

		return $this->view;

	}



	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF SET DELIVERY ORDER NO ONLY							   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_arrival($adm_id,$adm_dept,$adm_permission,$logsheet_id, $arrival_code, $arrival_code_only, $arrival_branch, $ls_process_day){
		//echo "<p>wir : $adm_id,$adm_dept,$adm_permission,$logsheet_id, $arrival_code, $arrival_code_only, $arrival_branch, $ls_process_day</p>";
		global $db1, $php_time, $php_date, $php_mth, $php_yr, $useripadd;

		$this->query_out	= $query_out;
		$this->execute		= $execute;
		$this->results		= $results;
		$this->query_out2	= $query_out2;
		$this->execute2		= $execute2;
		$this->results2		= $results2;

		$this->adm_id			= $adm_id;
		$this->adm_dept			= $adm_dept;
		$this->adm_permission	= $adm_permission;
		$this->logsheet_id		= $logsheet_id;
		$this->arrival_code		= $arrival_code;
		$this->arrival_code_only= $arrival_code_only;
		$this->arrival_branch	= $arrival_branch;
		$this->ls_process_day	= $ls_process_day;
		$this->logsheet_lryno	= "";		

		$this->diesel			= $diesel;
		$this->wages			= $wages;
		$this->alloance			= $alloance;
		$this->toll				= $toll;
		$this->repair			= $repair;
		$this->u_ldng			= $u_ldng;
		$this->misc				= $misc;

		/********** Do date info **********/
		$this->full_date		= $php_time;

		/********** DO NO info **********/
		$this->query_out = "select * from ymt_logsheet where ls_id = '$this->logsheet_id' and ls_status = 1 and ls_destination_branch <> ''";
		//echo "1st-> $this->query_out";
		$this->execute = $db1->query($this->query_out);

		/**********  getting the do no result **********/
		if ($db1->num_rows($this->execute) == 0){
			$this->view = "invalid_logsheet";			
		}else{
			$this->query_out2 = "update ymt_logsheet set ls_completed = '1', ls_arrival_date = '".$this->full_date."' where ls_id = '$this->logsheet_id' and ls_status = 1";	
			//echo "<p>$this->query_out2</p>";
			$this->execute2 = $db1->query($this->query_out2);
		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/
		

		if($this->execute2){

			/**** update arrival code on both do & lgsht item (start) ****/
			//foreach($this->arrival_code as $this->itmid=>$this->arrival_codes){
			foreach($this->arrival_code as $this->itmid){
				//echo "<p>arrival code : '".$this->arrival_codes."'</p>";
				//exit;
				$this->assignlocal		= "";
				$this->assignlocal2		= "";
				$this->assignlocal3		= "";
				$this->doid2prcs		= "";
				
				$this->query_out2_2 = "SELECT doi_do_id from ymt_do_item where doi_id = ".$this->itmid;
				//echo "<p>get the do_id 1st -> $this->query_out2_2</p>";
				$this->execute2_2 = $db1->query($this->query_out2_2);
				$this->results2_2 = $db1->fetch_assoc($this->execute2_2);
				$this->doid2prcs		= $this->results2_2['doi_do_id'];
				
				//exit;
				
				if(strtoupper(trim($this->arrival_code_only)) <> "0"){
					
					if(strtoupper(trim($this->arrival_code_only)) == "DMG" || strtoupper(trim($this->arrival_code_only)) == "DLV"){			
						$this->assignlocal 	= " , lsi_local = 0 ";		
						$this->assignlocal2 = " , do_local = 0 ";		
						$this->assignlocal3 = " , doi_local = 0 ";		
					}else{
						$this->assignlocal 	= " , lsi_local = 1 ";	
						$this->assignlocal2 = " , do_local = 1 ";	
						$this->assignlocal3 = " , doi_local = 1 ";	
					}
					
					
					/********** assign do's information **********/
					$this->query_out3 = "UPDATE ymt_logsheet_item set lsi_code = '".strtoupper(str_replace("'","",trim($this->arrival_code_only)))."', lsi_updated_on = '$this->full_date', lsi_updated_by = $this->adm_id ".$this->assignlocal." WHERE lsi_do_id = ".$this->doid2prcs." and lsi_ls_id = $this->logsheet_id";	
					//echo "<p>3rd-> $this->query_out3</p>";
					//exit;
					$this->execute3 = $db1->query($this->query_out3);
					
					if($this->execute3){
						/********** assign do's information **********/
						
						$this->query_out4 = "UPDATE ymt_do set do_code = '".strtoupper(str_replace("'","",trim($this->arrival_code_only)))."', do_arrive ='".$this->arrival_branch."', do_updated_on = '$this->full_date', do_updated_by = $this->adm_id ".$this->assignlocal2." WHERE do_id = ".$this->doid2prcs." ";	
						//echo "<p>4th-> $this->query_out4</p>";
						$this->execute4 = $db1->query($this->query_out4);
						
						if($this->execute4){
							
							$this->query_out4_2 = "UPDATE ymt_do_item set doi_code = '".strtoupper(str_replace("'","",trim($this->arrival_code_only)))."', doi_updated_on = '$this->full_date', doi_updated_by = $this->adm_id ".$this->assignlocal3." WHERE doi_do_id = ".$this->doid2prcs." and doi_id = $this->itmid ";	
							//echo "<p>4th-2-> $this->query_out4_2</p>";
							//exit;
							$this->execute4_2 = $db1->query($this->query_out4_2);
							
							
							$this->query_out5 = "SELECT do_id, do_branch, do_arrive, do_code, do_local from ymt_do where do_local = 1 and do_id = '".$this->itmid."' and do_code = 'RTN'";
							//echo "<p>5h check if local / from other brch -> $this->query_out5</p>";
							$this->execute5 = $db1->query($this->query_out5);
							$this->results5 = $db1->fetch_assoc($this->execute5);
							
							if($this->results5['do_branch'] <> $this->results5['do_arrive']){
								$this->query_out6 = "UPDATE ymt_do set do_local = 0 WHERE do_id = $this->itmid ";	
								//echo "<p>6th update do_local = 0 so canot b used to send as local anymore-> $this->query_out6</p>";
								$this->execute6 = $db1->query($this->query_out6);
								
								$this->query_out6_2 = "UPDATE ymt_logsheet_item set lsi_local = 0 WHERE lsi_do_id = $this->itmid ";	
								//echo "<p>6th update do_local = 0 so canot b used to send as local anymore-> $this->query_out6_2</p>";
								$this->execute6_2 = $db1->query($this->query_out6_2);
							}
													
						}
					}
				}
				

			}/********** foreach($this->arrival_code as $this->itmid=>$this->arrival_codes) closing **********/
			
			
			if($this->diesel <> "" || $this->wages <> "" || $this->alloance <> "" || $this->toll <> "" || $this->repair <> "" || $this->u_ldng <> "" || $this->misc <> ""){
				
				$this->query_out_te_chk = "select te_id, te_no, te_trip_no, te_lgsht, te_lry_id, te_drv_id from ymt_trip_expenses where te_lgsht = '$this->logsheet_id' and te_status = 2 ";
				//echo "<p>TE chk Q -> $this->query_out_te_chk</p>";
			
				$this->execute_te_chk	= $db1->query($this->query_out_te_chk);
				
				/**********  getting the do no result **********/
				if ($db1->num_rows($this->execute_te_chk) > 0){
					$this->view = "te_updated";			
				}else{
					$this->query_out_te_updt = "update ymt_trip_expenses set ";

					if($this->diesel <> ""){		$this->query_out_te_updt.= "te_diesel = '".$this->diesel."', ";			}
					if($this->wages <> ""){			$this->query_out_te_updt.= "te_wages = '".$this->wages."', ";			}
					if($this->alloance <> ""){		$this->query_out_te_updt.= "te_allowance = '".$this->alloance."', ";	}
					if($this->toll <> ""){			$this->query_out_te_updt.= "te_toll  = '".$this->toll."', ";			}
					if($this->repair <> ""){		$this->query_out_te_updt.= "te_repairs  = '".$this->repair."', ";		}
					if($this->u_ldng <> ""){		$this->query_out_te_updt.= "te_load_unload = '".$this->u_ldng."', ";	}
					if($this->misc <> ""){			$this->query_out_te_updt.= "te_misc  = '".$this->misc."', ";			}

					$this->query_out_te_updt.= " te_total = '1111', te_bal = '222', te_status = 2, te_updated_by = '".$this->adm_id."', te_date_2 = '".$this->full_date."' where te_lgsht = '$this->logsheet_id' and te_status = 1";	
					//echo "<p>TE update Q -> $this->query_out_te_updt</p>";
					//exit;
					$this->execute_te_updt	= $db1->query($this->query_out_te_updt);
				}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/


			}
			/**** update arrival code on both do & lgsht item (end) ****/


			$this->query_out7 = "update ymt_lorry set lorry_available = 1 where lorry_id = '$this->logsheet_lryno'";
			$this->execute7 = $db1->query($this->query_out7);
			if($this->execute7){
				$this->view = "success";
			}else{
				$this->view = "success_lorry_xsuccess";
			}

		}

		return $this->view;
	}



	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF LISTING LOGSHEET ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_listing_arrival($adm_id,$adm_dept,$adm_permission,$logsheet_origin,$logsheet_destination,$date_shj,$date_shj2,$date_shj3,$full_date){
		global $db1, $pg_lftmenu_lgsht;
		
		$this->query_out 	= $query_out;
		$this->execute 		= $execute;
		$this->results 		= $results;
		$this->query_out2 	= $query_out2;
		$this->execute2 	= $execute2;
		$this->results2 	= $results2;
		$this->query_out3 	= $query_out3;
		$this->execute3 	= $execute3;
		$this->results3 	= $results3;
		$this->query_out4 	= $query_out4;
		$this->execute4 	= $execute4;
		$this->results4 	= $results4;
		$this->query_out5 	= $query_out5;
		$this->execute5 	= $execute5;
		$this->results5 	= $results5;
		$this->query_out6 	= $query_out6;
		$this->execute6 	= $execute6;
		$this->results6 	= $results6;
		$this->query_out7 	= $query_out7;
		$this->execute7 	= $execute7;
		$this->results7 	= $results7;
				
		$this->adm_id 			= $adm_id;
		$this->adm_dept 		= $adm_dept;
		$this->adm_permission 	= $adm_permission;

		$this->logsheet_origin 		= $logsheet_origin;
		$this->logsheet_destination = $logsheet_destination;
		
		$this->pg_lftmenu_lgsht 	= $pg_lftmenu_lgsht;
				
		$this->date_shj  = $date_shj;
		$this->date_shj2 = $date_shj2;
		$this->date_shj3 = $date_shj3;
		$this->full_date = $full_date;

		$this->no 		 = 1;

		
		/**********  today's logsheet info **********/
		$this->query_out = "select a.ls_id, a.ls_branch, a.ls_no, a.ls_driver, a.ls_issued_date, a.ls_trip_no, a.ls_destination_branch, a.ls_advance, a.ls_completed, c.lorry_id, c.lorry_regno from ymt_logsheet a, ymt_lorry c where a.ls_lorry_no = c.lorry_id and ls_branch= '$this->logsheet_origin' and ls_destination_branch = '$this->logsheet_destination' and ls_delivery_date between '$this->date_shj2' and '$this->date_shj' and ls_status = 1 order by ls_id desc";
		//echo "1st-> $this->query_out";
		$this->execute = $db1->query($this->query_out);

		
		$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center'>";
		$this->view .= "<tr>";
		$this->view .= "<td valign='top' align='left' style='font-size: 1.6em; border-bottom: 3px solid #999; color: #000000;' height='35'>Arriving From : $this->logsheet_origin</td>";
		$this->view .= "<td valign='top' colspan='6' align='right' style='font-size: 1.6em; border-bottom: 3px solid #999;' height='35'>Arrival Date : $this->date_shj3</td>";
		$this->view .= "</tr>";
		$this->view .= "<tr>";
		$this->view .= "<td height='40'>&nbsp;</td>";
		$this->view .= "</tr>";
		$this->view .= "</table>";/********** table closing **********/

		
		
		/**********  getting the logsheet result **********/
		if ($db1->num_rows($this->execute) == 0){
			$this->record_found_today = "no";
		}else{

			/********** Getting logsheet information **********/
			while($this->results = $db1->fetch_array($this->execute)){/********** while opening **********/
				
				if($this->no % 2 == 0){		$this->bck_color = "#FFFFFF";		$this->font_color = "#666666";		}else{		$this->bck_color = "#F2F4F8";		$this->font_color = "#666666";		}
				
				$this->view .= "<form name='dest_arrived' id='dest_arrived' method='post' action=''>";/********** Form Opening **********/
				$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center' style='background: $this->bck_color; color: $this->font_color'>";
				$this->view .= "<tr>";
				$this->view .= "<td align='left' style='font-size: 1.25em; vertical-align: middle; width: 65px;' height='45'>Trip No</td>";
				$this->view .= "<td width='30' style=' vertical-align: middle;'>&nbsp;:&nbsp;</td>";
				$this->view .= "<td align='left' style='font-size: 1.25em; vertical-align: middle; width: 100px;'><strong>".$this->results['ls_trip_no']."</strong>";
				$this->view .= "<input type='hidden' name='lsid' id='lsid' value='".$this->results['ls_id']."' size='3'>";
				$this->view .= "</td>";
				$this->view .= "<td valign='top' align='left' style='font-size: 1.25em; width: 80px; vertical-align: middle;'>Driver</td>";
				$this->view .= "<td width='30' style=' vertical-align: middle;'>&nbsp;:&nbsp;</td>";
				
				$this->query_out6 = "select driver_id, driver_name, driver_mobile from ymt_driver where driver_id='".$this->results['ls_driver']."'";
				//echo "<p>1st-> $this->query_out6</p>";
				$this->execute6 = $db1->query($this->query_out6);
				$this->results6 = $db1->fetch_array($this->execute6);

				$this->view .= "<td align='left' style='font-size: 1.25em; width: 230px; vertical-align: middle;'><strong><a href='ymtt_driver_info.php?drv_id=".$this->results6['driver_id']."'>".$this->results6['driver_name']."</a></strong>(".$this->results6['driver_mobile'].")";
				$this->view .= "</td>";
				
				$this->view .= "<td valign='top' align='left' style='font-size: 1.25em; width: 100px; vertical-align: middle;'>Logsheet No</td>";
				$this->view .= "<td width='30' style=' vertical-align: middle;'>&nbsp;:&nbsp;</td>";
				$this->view .= "<td align='left' style='font-size: 1.25em; width: 100px; vertical-align: middle;'>";
				$this->view .= "<strong><a href='ymtt_logsheet_info.php?ls_id=".$this->results['ls_id']."'>".$this->results['ls_no']."</a></strong></td>";


				$this->view .= "<td valign='top' align='left' style='font-size: 1.25em; width: 100px; vertical-align: middle;'>Dest Branch</td>";
				$this->view .= "<td width='30' style=' vertical-align: middle;'>&nbsp;:&nbsp;</td>";
								
				$this->view .= "<td align='left' style='font-size: 1.25em;  vertical-align: middle; width: 50px; '>";
				$this->view .= $this->results['ls_destination_branch'];
				$this->view .= "</td>";
				$this->view .= "</tr>";

				
				$this->view .= "<tr>";
				$this->view .= "<td valign='top' align='left' style='font-size: 1.25em; ' height='35'>Lorry No</td>";
				$this->view .= "<td width='30' style=' vertical-align: middle;'>&nbsp;:&nbsp;</td>";
								
				$this->view .= "<td align='left' style='font-size: 1.25em; vertical-align: middle;'><strong><a href='ymtt_lorry_info.php?lry_id=".$this->results['lorry_id']."&lry_regno=".$this->results['lorry_regno']."'>".$this->results['lorry_regno']."</a></strong></td>";
							
				$this->view .= "<td valign='top' align='left' style='font-size: 1.25em; '>Attendant</td>";
				$this->view .= "<td width='30'>&nbsp;:&nbsp;</td>";
				$this->view .= "<td align='left' style='font-size: 1.25em;'>";
				$this->view .= "<strong>".$this->results6['driver_name']."</strong></td>";

				$this->view .= "<td valign='top' align='left' style='font-size: 1.25em; '>Advance</td>";
				$this->view .= "<td width='30'>&nbsp;:&nbsp;</td>";
				$this->view .= "<td align='left' style='font-size: 1.25em;'>";
				$this->view .= $this->results['ls_advance'];
				$this->view .= "</td>";

				$this->view .= "<td valign='top' align='left' colspan='2'>";

				if($this->results['ls_completed'] == 1){
					$this->view .= "<span style='text-decoration: blink; font-size: 14px; font-weight: bold; color: #ff0000;'>Successfully Arrived</span>";
				}else{
					$this->view .= "<input type='hidden' name='update_arrival' id='update_arrival' value='confirm'>";
					$this->view .= "<input type='submit' name='submit' id='submit' value='Arrived' size='3'>";
				}

				$this->view .= "</td>";

				$this->view .= "<td valign='top' align='right' style='padding-right: 24px;'><a href='".$this->pg_lftmenu_lgsht['link_41']."&ls_id=".$this->results['ls_id']."' target='_blank'><img src='images/print.png' style='text-decoration: none; border: 0px;'></a></td>";
				$this->view .= "</tr>";
				$this->view .= "</table>";/********** table closing **********/			
				$this->view .= "</form><br>";/********** form name='dest_advance' closing **********/


				/**********  today's logsheet info **********/
				$this->query_out2 = "SELECT lsi_id, lsi_do_id FROM `ymt_logsheet_item` WHERE lsi_ls_id = '".$this->results['ls_id']."'";
				//echo "<p>1st-> $this->query_out2</p>";
				$this->execute2 = $db1->query($this->query_out2);
							

				/**********  getting the logsheet result **********/
				if ($db1->num_rows($this->execute2) == 0){
					$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center'>";
					$this->view .= "<tr>";
					$this->view .= "<td valign='top' colspan='6' align='right' style='font-size: 1.3em; border-bottom: 3px solid #999;' height='35'>Date : $this->date_shj2</td>";
					$this->view .= "</tr>";
					$this->view .= "<tr>";
					$this->view .= "<td>&nbsp;</td>";
					$this->view .= "</tr>";
					$this->view .= "</table>";/********** table closing **********/
					$this->record_found_today = "no";
				}else{
					
					$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' style='border: 1px solid #DDDDDD; background: $this->bck_color; color: $this->font_color' align='center'>";
					$this->view .= "<tr>";
					$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 65px;'>DO No</th>";
					$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 90px;'>From</th>";
					$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 90px;'>To</th>";
					$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 145px;'>Consignor</th>";
					$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 145px;'>Consignee</th>";
					$this->view .= "<th valign='top' width='200' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;'>Description</th>";
					$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;  width: 85px;'>Quantity</th>";
					$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; width: 85px;'>Weight</th>";
					$this->view .= "</tr>";

					/********** Getting logsheet information **********/
					while($this->results2 = $db1->fetch_array($this->execute2)){/********** while opening **********/
					//print_r($this->results2);
					//print_r("<br>");
						
						$this->view .= "<tr>";
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top;'>";	
						
						$this->query_out7 = "select do_id, do_no from ymt_do where do_id = '".$this->results2['lsi_do_id']."' and do_status = 1";
						$this->execute7 = $db1->query($this->query_out7);
						$this->results7 = $db1->fetch_assoc($this->execute7);
						$this->view .= "<a href='ymtt_do_info.php?dorder_id=".$this->results7['do_id']."' ";
						
						if($this->results['ls_backdate'] == 1){		$this->view .= " style='color: #5BC236;'";			}	
						$this->view .= ">".$this->results7['do_no']."</a>&nbsp;&nbsp;";
				
						$this->view .= "</td>";


						/********** grb ls item info frm do item **********/
						$this->query_out20 = "SELECT do_id, do_no, do_consignor, do_collect_frm, do_consignee, do_deliver_to FROM `ymt_do` WHERE do_id = '".$this->results2['lsi_do_id']."' and do_status = 1 ";
						//echo "<p>1st-> $this->query_out2</p>";
						$this->execute20 = $db1->query($this->query_out20);
						$this->results20 = $db1->fetch_assoc($this->execute20);
						
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top;'>".$this->results20['do_collect_frm']."</td>";
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top;'>".$this->results20['do_deliver_to']."</td>";
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top;'>";
					
						$this->query_out5 = "select client_id, client_name as consignee_name from ymt_client where client_id='".$this->results20['do_consignor']."' and (client_status = 1 || client_status = 3)";
						//echo "<p>5st-> $this->query_out_5</p>";
						$this->execute5 = $db1->query($this->query_out5);
						$this->results5 = $db1->fetch_array($this->execute5);
						$this->view .= "<a href='ymtt_client_info.php?clnt_id=".$this->results5['client_id']."' ";
						
						if($this->results['ls_backdate'] == 1){			$this->view .= " style='color: #5BC236;'";			}
						$this->view .= ">".$this->results5['consignee_name']."</a>";
						
						$this->view .= "</td>";		
						
						$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top;'>";
						
						$this->query_out3 = "select client_id, client_name as consignee_name from ymt_client where client_id='".$this->results20['do_consignee']."' and (client_status = 1 || client_status = 3)";
						//echo "<p>3st-> $this->query_out_3</p>";
						$this->execute3 = $db1->query($this->query_out3);
						$this->results3 = $db1->fetch_array($this->execute3);
						$this->view .= "<a href='ymtt_client_info.php?clnt_id=".$this->results3['client_id']."' ";
						
						if($this->results['ls_backdate'] == 1){			$this->view .= " style='color: #5BC236;'";			}
						$this->view .= ">".$this->results3['consignee_name']."</a>";

						$this->view .= "</td>";	
						
						
						$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;' colspan='3'>"; 

						$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center'>";

						/**********  today's logsheet info **********/
						$this->query_out4 = "select doi_desc, doi_qty, doi_weight from ymt_do_item where doi_do_id = '".$this->results20['do_id']."' order by doi_id desc";
						//echo "<p>1st-> $this->query_out4</p>";
						$this->execute4 = $db1->query($this->query_out4);
						
						while($this->results4 = $db1->fetch_array($this->execute4)){/********** while opening **********/
							$this->view .= "<tr>";
							$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;' width='200'>".$this->results4['doi_desc']."</td>";
							$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 85px;' >".$this->results4['doi_qty']."</td>";
							$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD;  width: 85px;' >".$this->results4['doi_weight']."</td>";
							$this->view .= "</tr>";
						}
						

						$this->view .= "</table>";/********** table of logsheet item record closing **********/

						$this->view .= "</td>";
						$this->view .= "</tr>";

					}/********** while closing **********/

					$this->view .= "</table>";/********** table of logsheet item record closing **********/

					$this->view .= "<br><br>";/********** break **********/

				}/********** if ($db1->num_rows($this->execute2) == 0) else closing **********/

				

				$this->no++;

			}/********** while closing **********/

		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

		return $this->view;
	}


	
	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF LISTING LOGSHEET ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_listing_arrival_aio($adm_id,$adm_dept,$adm_permission,$logsheet_origin,$logsheet_destination,$date_shj,$date_shj2,$date_shj3,$process_day){
	//echo "<p>wir : $adm_id,$adm_dept,$adm_permission,$logsheet_origin,$logsheet_destination,$date_shj,$date_shj2,$date_shj3,$process_day</p>";
		global $db1, $php_time, $useripadd, $pg_lftmenu_lgsht, $pg_lftmenu_do, $pg_lftmenu_lorry, $pg_lftmenu_client, $pg_lftmenu_petty_cash, $deviceType;
		
		$this->query_out	= $query_out;
		$this->execute		= $execute;
		$this->results		= $results;
		$this->query_out2	= $query_out2;
		$this->execute2		= $execute2;
		$this->results2		= $results2;
		$this->query_out3	= $query_out3;
		$this->execute3		= $execute3;
		$this->results3		= $results3;
		$this->query_out4	= $query_out4;
		$this->execute4		= $execute4;
		$this->results4		= $results4;
		$this->query_out5	= $query_out5;
		$this->execute5		= $execute5;
		$this->results5		= $results5;
		$this->query_out6	= $query_out6;
		$this->execute6		= $execute6;
		$this->results6		= $results6;
		$this->query_out7	= $query_out7;
		$this->execute7		= $execute7;
		$this->results7		= $results7;
				
		$this->adm_id		= $adm_id;
		$this->adm_dept		= $adm_dept;
		$this->adm_branch	= $adm_branch;
		$this->adm_permission = $adm_permission;
		$this->full_date	= $full_date;
		
		$this->logsheet_origin 		= $logsheet_origin;
		$this->logsheet_destination = $logsheet_destination;
		
		$this->pg_lftmenu_lgsht 	= $pg_lftmenu_lgsht;
		$this->pg_lftmenu_do		= $pg_lftmenu_do;
		$this->pg_lftmenu_lorry 	= $pg_lftmenu_lorry;
		$this->pg_lftmenu_client	= $pg_lftmenu_client;
		$this->pg_lftmenu_petty_cash= $pg_lftmenu_petty_cash;
		
		$this->deviceType	= $deviceType;
		
		
		$this->no			= 1;
		$this->date_shj		= $date_shj;
		$this->date_shj2	= $date_shj2;
		$this->date_shj3	= $date_shj3;
		$this->full_date 	= $php_time;
		
		$this->process_day = $process_day;

		$this->padtop = "";

		$this->no = 1;
		

		
		/**********  today's logsheet info **********/
		$this->query_out = "select a.ls_id, a.ls_branch, a.ls_no, a.ls_driver, a.ls_attendant, a.ls_issued_date, a.ls_trip_no, a.ls_destination_branch, a.ls_advance, a.ls_completed, c.lorry_id, c.lorry_regno from ymt_logsheet a, ymt_lorry c where a.ls_lorry_no = c.lorry_id and ls_branch= '$this->logsheet_origin' and ls_destination_branch = '$this->logsheet_destination' and ls_delivery_date between '$this->date_shj' and '$this->date_shj2' and ls_status = 1 order by ls_id desc";
		//echo "<p>1st-> $this->query_out</p>";
		$this->execute = $db1->query($this->query_out);

		$this->view .= "<h3 class='form-section' style='margin-left: 10px;'>";
			$this->view .= "<div class='row'>";
				$this->view .= "<div class='col-md-6'>";
					$this->view .= "Arriving From : $this->logsheet_origin";
				$this->view .= "</div>";
				
				$this->view .= "<div class='col-md-6 text-right'>";
					$this->view .= "Arrival Date : $this->date_shj3";
				$this->view .= "</div>";
			$this->view .= "</div>";
		$this->view .= "</h3>";
		$this->view .= "<div class='clearfix'>&nbsp;</div>";/********** div closing **********/
		

		/**********  getting the logsheet result **********/
		if ($db1->num_rows($this->execute) == 0){
			$this->record_found_today = "no";
		}else{
			
			
			/********** Getting logsheet information **********/
			while($this->results = $db1->fetch_array($this->execute)){/********** while opening **********/
				$this->acode_no = 1;
				if($this->no % 2 == 0){		$this->bck_color = "#FFFFFF";		$this->font_color = "#666666";		}else{		$this->bck_color = "#F2F4F8";		$this->font_color = "#666666";		}
				
				
				$this->view .= "<form class='form-horizontal form-bordered form-row-stripped' name='dest_advance".$this->results['ls_id']."' id='dest_advance".$this->results['ls_id']."' method='post' action=''>";/********** Form Opening background: $this->bck_color; color: $this->font_color **********/
					
				
					/**** Logsheet info div (start) ****/
					$this->view .= "<div class='form-body' style='border-left: 1px solid #efefef;border-right: 1px solid #efefef;'>";
					
						
						/**** form-group @ lorry (start) ****/
						$this->view .= "<div class='form-group' style='border-top: 1px solid #efefef;'>";
					
							$this->view .= "<label class='control-label col-md-2'>Lorry No</label>";
							$this->view .= "<div class='col-md-2'>";
							
								$this->view .= "<p class='form-control-static'>";
									$this->view .= "<strong style='color: #000;'><a href='".$this->pg_lftmenu_lorry['link_10']."&lry_id=".$this->results['lorry_id']."&lry_regno=".$this->results['lorry_regno']."' ";

									if($this->results['ls_backdate'] == 1){		$this->view .= " style='color: #000000;'";		}

									$this->view .= ">".$this->results['lorry_regno']."</a> (".$this->results['ls_branch'].")</strong>";
									
								$this->view .= "</p>";										
								
							$this->view .= "</div>";
							
						//$this->view .= "</div>";
						/**** form-group @ lorry (closing) ****/

						/**** form-group @ logsheet no(start) ****/
						//$this->view .= "<div class='form-group'>";
					
							$this->view .= "<label class='control-label col-md-2'>LogSheet No</label>";
							$this->view .= "<div class='col-md-2'>";
							
								$this->view .= "<p class='form-control-static'>";
									$this->view .= "<strong style='color: #000;'><a href='".$this->pg_lftmenu_lgsht['link_10']."&ls_id=".$this->results['ls_id']."' ";

									if($this->results['ls_backdate'] == 1){		$this->view .= " style='color: #000000;'";		}

									$this->view .= ">".$this->results['ls_no']."</a></strong>";
									
									
									
									
										/* check if no of item of tat logsheet is more tan 16 (start) - 08092012  */
										//1) get the num of logsheet item.
										//2) get the num of do item.
										//3) add all n check if > 16
										//echo "pgbrk cntr : ".$this->lgsht_no_itm." for lg id : ".$this->results['ls_id']." <br><br> ";
										
										$this->lgsht_no_itm	= 0;
										$this->itmcntstart 	= 1;
										$this->prnt_link_extra = "";
						
										$this->query_out_lgsht_no_itm 	= "select lsi_id, lsi_ls_id, lsi_do_id from ymt_logsheet_item where lsi_ls_id = '".$this->results['ls_id']."' and lsi_status = 1";
										//echo "<p>3rd - 2-> $this->query_out_lgsht_no_itm</p>";
										$this->execute_lgsht_no_itm 	= $db1->query($this->query_out_lgsht_no_itm);
										if($db1->num_rows($this->execute_lgsht_no_itm) > 0 ){
										
											//echo "lgsht cnt : ".$db1->num_rows($this->execute_lgsht_no_itm)."  for lg id : ".$this->results['ls_id']." --> ";
											

											while($this->results_lgsht_no_itm = $db1->fetch_array($this->execute_lgsht_no_itm)){/********** while opening **********/
												
												$this->lgshtid_cnted = $this->results_lgsht_no_itm['lsi_ls_id'];
												$this->query_out_do_no_itm 	= "select doi_id from ymt_do_item where doi_do_id = '".$this->results_lgsht_no_itm['lsi_do_id']."' ";
												//echo "<p>3rd - 3-> $this->query_out_do_no_itm</p>";
												$this->execute_do_no_itm 	= $db1->query($this->query_out_do_no_itm);
												
												if($db1->num_rows($this->execute_do_no_itm) > 0 ){
													//echo "do cnt : ".$db1->num_rows($this->execute_do_no_itm)." for lg id : ".$this->results['ls_id']."<br>";
													
													$this->lgsht_no_itm	+= $db1->num_rows($this->execute_do_no_itm);
												}else{
													$this->lgsht_no_itm++;
												}
												
												//echo "<p><strong>final cnt : $this->itmcntstart) ".$this->lgsht_no_itm."</strong> for lg id : ".$this->results['ls_id']."<br>";
												$this->itmcntstart++;
												
											}
											
											
										}else{
											$this->lgsht_no_itm = 0;
										}					
										/* check if no of item of tat logsheet is more tan 16 (end) - 08092012  */
										
										if($this->lgsht_no_itm > 16 && $this->lgshtid_cnted == $this->results['ls_id']){		$this->prnt_link_extra = "&pg=break";		}
										

										/**** form-group @ Print (start) ****/
										//$this->view .= "<div class='form-group'>";
										
											//$this->view .= "<label class='control-label col-md-3'>Print</label>";
											//$this->view .= "<div class='col-md-9'>";
										
												/* check if no of item of tat logsheet is more tan 16 (start) - 08092012  */
												//1) get the num of logsheet item.
												//2) get the num of do item.
												//3) add all n check if > 16
												//echo "pgbrk cntr : ".$this->lgsht_no_itm." for lg id : ".$this->results['ls_id']." <br><br> ";
												
												$this->lgsht_no_itm	= 0;
												$this->itmcntstart 	= 1;
												$this->prnt_link_extra = "";
								
												$this->query_out_lgsht_no_itm 	= "select lsi_id, lsi_ls_id, lsi_do_id from ymt_logsheet_item where lsi_ls_id = '".$this->results['ls_id']."' and lsi_status = 1";
												//echo "<p>3rd - 2-> $this->query_out_lgsht_no_itm</p>";
												$this->execute_lgsht_no_itm 	= $db1->query($this->query_out_lgsht_no_itm);
												if($db1->num_rows($this->execute_lgsht_no_itm) > 0 ){
												
													//echo "lgsht cnt : ".$db1->num_rows($this->execute_lgsht_no_itm)."  for lg id : ".$this->results['ls_id']." --> ";
													

													while($this->results_lgsht_no_itm = $db1->fetch_array($this->execute_lgsht_no_itm)){/********** while opening **********/
														
														$this->lgshtid_cnted = $this->results_lgsht_no_itm['lsi_ls_id'];
														$this->query_out_do_no_itm 	= "select doi_id from ymt_do_item where doi_do_id = '".$this->results_lgsht_no_itm['lsi_do_id']."' ";
														//echo "<p>3rd - 3-> $this->query_out_do_no_itm</p>";
														$this->execute_do_no_itm 	= $db1->query($this->query_out_do_no_itm);
														
														if($db1->num_rows($this->execute_do_no_itm) > 0 ){
															//echo "do cnt : ".$db1->num_rows($this->execute_do_no_itm)." for lg id : ".$this->results['ls_id']."<br>";
															
															$this->lgsht_no_itm	+= $db1->num_rows($this->execute_do_no_itm);
														}else{
															$this->lgsht_no_itm++;
														}
														
														//echo "<p><strong>final cnt : $this->itmcntstart) ".$this->lgsht_no_itm."</strong> for lg id : ".$this->results['ls_id']."<br>";
														$this->itmcntstart++;
														
													}
													
													
												}else{
													$this->lgsht_no_itm = 0;
												}					
												/* check if no of item of tat logsheet is more tan 16 (end) - 08092012  */
												
												if($this->lgsht_no_itm > 16 && $this->lgshtid_cnted == $this->results['ls_id']){		$this->prnt_link_extra = "&pg=break";		}
												
												
												//$this->view .= "<p class='form-control-static'>";
												
													$this->view .= "<a href='".$this->pg_lftmenu_lgsht['link_41']."&ls_id=".$this->results['ls_id'].$this->prnt_link_extra."&itm=".$this->lgsht_no_itm."' target='_blank' >";
														$this->view .= "&nbsp;&nbsp;<img src='images/print.png' style='text-decoration: none;border: 2px solid green; '>";
													$this->view .= "</a>";
										
												//$this->view .= "</p>";										
												
											//$this->view .= "</div>";
											
										//$this->view .= "</div>";
										/**** form-group @ Print (closing) ****/

										
								$this->view .= "</p>";										
								
							$this->view .= "</div>";
							
						//$this->view .= "</div>";
						/**** form-group @ logsheet no (closing) ****/

						/**** form-group @ trip no (start) ****/
						//$this->view .= "<div class='form-group'>";
					
							$this->view .= "<label class='control-label col-md-2'>Trip No</label>";
							$this->view .= "<div class='col-md-2'>";
							
								$this->view .= "<p class='form-control-static'>";
									$this->view .= " <strong style='color: #000;'>".$this->results['ls_trip_no']."</strong>";
									$this->view .= "<input type='hidden' name='lsid' id='lsid' value='".$this->results['ls_id']."' size='3'>";	
								$this->view .= "</p>";										
								
							$this->view .= "</div>";
							
						$this->view .= "</div>";
						/**** form-group @ trip no (closing) ****/
						
						/**** form-group @ from (start) ****/
						/* $this->view .= "<div class='form-group'>";
					
							$this->view .= "<label class='control-label col-md-3'>From</label>";
							$this->view .= "<div class='col-md-9'>";
							
								$this->view .= "<p class='form-control-static'>";
									$this->view .= " <strong style='color: #000;'>".$this->results['ls_branch']."</strong>";
								$this->view .= "</p>";										
								
							$this->view .= "</div>";
							
						$this->view .= "</div>"; */
						/**** form-group @ from (closing) ****/	
						
						/**** form-group @ driver (start) ****/
						$this->view .= "<div class='form-group'>";
					
							$this->view .= "<label class='control-label col-md-3'>Driver || Attn</label>";
							$this->view .= "<div class='col-md-5'>";
							
								$this->view .= "<p class='form-control-static'>";
									
									$this->query_out6 = "select driver_id, driver_branch, driver_route, driver_name, driver_mobile, driver_lorry_no from ymt_driver where driver_name != '' and driver_nature = 'Driver' and driver_id = '".$this->results['ls_driver']."' and driver_active = 1";
									//echo "<p>2nd-> $this->query_out6</p>";
									$this->execute6 = $db1->query($this->query_out6);
									$this->results6 = $db1->fetch_assoc($this->execute6);
									
									$this->view .= " <strong style='color: #000; '>".$this->results6['driver_name']."</strong> (".$this->results6['driver_mobile'].")";
									
									
									$this->view .= " || ";
									
									$this->query_out6_2 = "select driver_id, driver_branch, driver_route, driver_name, driver_mobile, driver_lorry_no from ymt_driver where driver_name != '' and driver_nature = 'Attendant' and driver_id = '".$this->results['ls_attendant']."' and driver_active = 1";
									//echo "<p>2nd-> $this->query_out6_2</p>";
									$this->execute6_2 = $db1->query($this->query_out6_2);
									$this->results6_2 = $db1->fetch_array($this->execute6_2);
										
									if($db1->num_rows($this->execute6_2) > 0){
										$this->results6_2 = $db1->fetch_assoc($this->execute6_2);								
										$this->view .= ": <strong style='color: #000; '>".$this->results6_2['driver_name']."</strong> (".$this->results6_2['driver_mobile'].")";
									}else{
										$this->view .= " none";
									}
									
									
									
									
								$this->view .= "</p>";										
								
							$this->view .= "</div>";
							
						//$this->view .= "</div>";
						/**** form-group @ driver (closing) ****/	
						
						/**** form-group @ Attendant (start) ****/
						//$this->view .= "<div class='form-group'>";
					
							/* $this->view .= "<label class='control-label col-md-2'>Attendant</label>";
							$this->view .= "<div class='col-md-3'>";
							
								$this->view .= "<p class='form-control-static'>";
									$this->query_out6_2 = "select driver_id, driver_branch, driver_route, driver_name, driver_mobile, driver_lorry_no from ymt_driver where driver_name != '' and driver_nature = 'Attendant' and driver_id = '".$this->results['ls_attendant']."'";
									//echo "<p>2nd-> $this->query_out6_2</p>";
									$this->execute6_2 = $db1->query($this->query_out6_2);
									$this->results6_2 = $db1->fetch_array($this->execute6_2);
										
									if($db1->num_rows($this->execute6_2) > 0){
										$this->results6_2 = $db1->fetch_assoc($this->execute6_2);								
										$this->view .= ": <strong style='color: #000; '>".$this->results6_2['driver_name']."</strong> (".$this->results6_2['driver_mobile'].")";
									}else{
										$this->view .= " none";
									}
								$this->view .= "</p>";										
								
							$this->view .= "</div>"; */
							
						//$this->view .= "</div>";
						/**** form-group @ Attendant (closing) ****/
						
						/**** form-group @ Advance (start) ****/
						//$this->view .= "<div class='form-group'>";
					
							//$this->view .= "<label class='control-label col-md-3'>Advance (RM)</label>";
							$this->view .= "<div class='col-md-2'>";
							
								$this->view .= "<p class='form-control-static anyprice'>";
									$this->view .= $this->results['ls_advance'];
								$this->view .= "</p>";										
								
							$this->view .= "</div>";
							
						$this->view .= "</div>";
						/**** form-group @ Advance (closing) ****/	
							
							
							
					
					$this->view .= "</div>";
					/**** Logsheet info div @ form-body (end) ****/
					
					
					$this->view .= "<div class='clearfix' style='height: 20px;'></div>";
					

					/**********  today's logsheet info **********/
					$this->query_out2 = "SELECT lsi_id, lsi_do_id FROM `ymt_logsheet_item` WHERE lsi_ls_id = '".$this->results['ls_id']."' and lsi_status = 1";
					//echo "<p>1st-> $this->query_out2</p>";
					$this->execute2 = $db1->query($this->query_out2);


					/**********  getting the logsheet result **********/
					if ($db1->num_rows($this->execute2) == 0){
						$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center'>";
						$this->view .= "<tr>";
						$this->view .= "<td valign='top' colspan='6' align='right' style='font-size: 1.3em; border-bottom: 3px solid #999;' height='35'>Date : $this->date_shj2</td>";
						$this->view .= "</tr>";
						$this->view .= "<tr>";
						$this->view .= "<td>&nbsp;</td>";
						$this->view .= "</tr>";
						$this->view .= "</table>";/********** table closing **********/
						$this->record_found_today = "no";
					}else{
						
						$this->view .= "<table class='table table-striped table-bordered table-hover'>";
							$this->view .= "<thead>";
								$this->view .= "<tr>";
									$this->view .= "<th >#</th>";
									$this->view .= "<th >DO No</th>";
									$this->view .= "<th >From</th>";
									$this->view .= "<th >To</th>";
									$this->view .= "<th >Consignor</th>";
									$this->view .= "<th >Consignee</th>";
									$this->view .= "<th >Description</th>";
									$this->view .= "<th >Quantity</th>";				
									$this->view .= "<th >Weight</th>";				
									$this->view .= "<th >Status</th>";				
								$this->view .= "</tr>";
							$this->view .= "</thead>";
						
							$this->view .= "<tbody>";
							
								$this->no_content = 1;  
								
								/********** Getting logsheet information **********/
								while($this->results2 = $db1->fetch_array($this->execute2)){/********** while opening **********/
								//print_r($this->results2);
								//print_r("<br>");
									
									$this->view .= "<tr>";
									
										$this->view .= "<td>";
											$this->view .= $this->no_content;//running no
										$this->view .= "</td>";
										
										$this->view .= "<td>";	
										
											$this->query_out7 = "select do_id, do_no from ymt_do where do_id = '".$this->results2['lsi_do_id']."' and do_status = 1";
											$this->execute7 = $db1->query($this->query_out7);
											$this->results7 = $db1->fetch_assoc($this->execute7);
											$this->view .= "<a href='".$this->pg_lftmenu_do['link_10']."&dorder_id=".$this->results7['do_id']."' ";
									
											if($this->results['ls_backdate'] == 1){		$this->view .= " style='color: #5BC236;'";			}	
											$this->view .= ">".$this->results7['do_no']."</a>&nbsp;&nbsp;";


										$this->view .= "</td>";


										/********** grb ls item info frm do item **********/
										$this->query_out20 = "SELECT do_id, do_no, do_consignor, do_collect_frm, do_consignee, do_deliver_to, do_deliver_to2, do_code FROM `ymt_do` WHERE do_id = '".$this->results2['lsi_do_id']."' and do_status = 1 ";
										//echo "<p>1st-> $this->query_out2</p>";
										$this->execute20 = $db1->query($this->query_out20);
										$this->results20 = $db1->fetch_assoc($this->execute20);
										
										$this->view .= "<td>".$this->results20['do_collect_frm']."</td>";
										$this->view .= "<td>".$this->results20['do_deliver_to2']."</td>";
										$this->view .= "<td>";
									
											$this->query_out5 = "select client_id, client_name as consignee_name from ymt_client where client_id='".$this->results20['do_consignor']."' and (client_status = 1 || client_status = 3)";
											//echo "<p>5st-> $this->query_out_5</p>";
											$this->execute5 = $db1->query($this->query_out5);
											$this->results5 = $db1->fetch_array($this->execute5);
											$this->view .= "<a href='ymtt_client_info.php?clnt_id=".$this->results5['client_id']."' ";
											
											if($this->results['ls_backdate'] == 1){			$this->view .= " style='color: #5BC236;'";			}
											$this->view .= ">".$this->results5['consignee_name']."</a>";
										
										$this->view .= "</td>";		
										
										$this->view .= "<td>";
										
											$this->query_out3 = "select client_id, client_name as consignee_name from ymt_client where client_id='".$this->results20['do_consignee']."' and (client_status = 1 || client_status = 3)";
											//echo "<p>3st-> $this->query_out_3</p>";
											$this->execute3 = $db1->query($this->query_out3);
											$this->results3 = $db1->fetch_array($this->execute3);
											$this->view .= "<a href='ymtt_client_info.php?clnt_id=".$this->results3['client_id']."' ";
											
											if($this->results['ls_backdate'] == 1){			$this->view .= " style='color: #5BC236;'";			}
											$this->view .= ">".$this->results3['consignee_name']."</a>";

										$this->view .= "</td>";	
										
										
										$this->view .= "<td colspan='4'>"; 
										
											$this->view .= "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered table-hover'>";
												$this->view .= "<tbody>";
												
												
												/**********  today's logsheet info **********/
												$this->query_out4 = "select doi_id, doi_do_id, doi_desc, doi_qty, doi_weight, doi_code from ymt_do_item where doi_do_id = '".$this->results20['do_id']."' order by doi_id desc";
												//echo "<p>1st-> $this->query_out4</p>";
												$this->execute4 = $db1->query($this->query_out4);
												
												$this->id2chkndsply_arrv = "";
												
												while($this->results4 = $db1->fetch_array($this->execute4)){/********** while opening **********/
													$this->view .= "<tr>";
														$this->view .= "<td class='width_60_prcnt'>";
														$this->view .= $this->results4['doi_desc'];
														
															if($this->results['ls_completed'] == 1 && $this->results4['doi_code'] <> "DLV"){
																$this->view .= "<span style='display: block; float: right;  width: 30px; '>";
																	$this->view .= "<a href='ymtt_logsheet_item_damage.php?iid=".$this->results4['doi_id']."&do_id=".$this->results2['lsi_do_id']."&ls_id=".$this->results['ls_id']."' style='font-size: 10px;color: #800080;' title='To report goods damage for ".$this->results4['doi_desc']."' alt='To report goods damage for ".$this->results4['doi_desc']."'>";
																		$this->view .= "DMG";						
																	$this->view .= "</a>";
																$this->view .= "</span>";
															}

														$this->view .= "</td>";
														//$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;' width='200'>".$this->results4['doi_desc']."</td>";
														$this->view .= "<td class='width_13_prcnt'>".$this->results4['doi_qty']."</td>";
														$this->view .= "<td class='width_12_prcnt'>".$this->results4['doi_weight']."</td>";
														
														
														$this->view .= "<td class='width_10_prcnt'>";
														
															if($this->results4['doi_code'] <> "" && $this->results['ls_completed'] == 1){
																$this->view .= $this->results4['doi_code'];
																$this->id2chkndsply_arrv = $this->results4['doi_code'];									
															}else{
																$this->view .= "<input type='checkbox' name='arrival_code[]' value='".$this->results4['doi_id']."' size='1' >&nbsp;".$this->results4['doi_code'];
															}
															
														$this->view .= "</td>";
													
													$this->view .= "</tr>";
												}
									
												$this->view .= "</tbody>";/********** table of logsheet item record closing **********/
									
											$this->view .= "</table>";/********** table of logsheet item record closing **********/

										$this->view .= "</td>";
										
									$this->view .= "</tr>";
									
									$this->no_content++;

								}/********** while closing **********/

							$this->view .= "</tbody>";

						$this->view .= "</table>";/********** table of logsheet item record closing **********/

						$this->view .= "<div class='clearfix' style='height: 20px;'></div>";/********** break **********/
						
						
						/**** form-group @ Button (start) ****/
						$this->view .= "<div class='form-actions fluid' style='border-left: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;'>";
						
							$this->view .= "<div class='row'>";
								
								$this->view .= "<div class='col-md-12'>";
								
									/**** form-group @ Advance (start) ****/
									$this->view .= "<div class='col-md-3 labeltitle'>Arrival Status</div>";
									$this->view .= "<div class='col-md-3'>";
									
										$this->query_out_acode = "SELECT ac_id, ac_code, ac_desc FROM `ymt_arrival_code` WHERE ac_status = 1 order by ac_order ASC";
										//echo "<p>arrival code Q-> $this->query_out_acode</p>";
										$this->execute_acode = $db1->query($this->query_out_acode);
										
										if($this->id2chkndsply_arrv == ""){
											$this->view .= "<select name='arrival_code_only' class='form-control input-medium'>";
											
												while($this->results_acode = $db1->fetch_array($this->execute_acode)){/********** while opening **********/							
													$this->view .= "<option value='".$this->results_acode['ac_code']."'>".$this->results_acode['ac_desc']."</option>";

												}/********** while($this->results_acode = $db1->fetch_array($this->execute_acode)) closing **********/
											
											$this->view .= "</select>";
										}
										
										
									$this->view .= "</div>";
									
									$this->view .= "<div class='col-md-3'>";

										if($this->id2chkndsply_arrv == ""){
												$this->view .= "<input type='hidden' name='update_arrival' id='update_arrival' value='confirm'>";
												$this->view .= "<button type='submit' class='btn green'><i class='icon-ok'></i> Arrived</button>";
										}else{
											$this->view .= "<p class='form-control-static'>";
												$this->view .= "All Logsheet Item have been updated. To Update again, pls click on each DO & update it.";
											$this->view .= "</p>";
										}									
										
									$this->view .= "</div>";
									/**** form-group @ Advance (closing) ****/	
								
								$this->view .= "</div>";
								/**** .col-md-12 (closing) ****/

							$this->view .= "</div>";
							/**** .row (closing) ****/
							
						$this->view .= "</div>";
						/**** .form-group @ Button (closing) ****/
					
						
					}/********** if ($db1->num_rows($this->execute2) == 0) else closing **********/

				
				$this->view .= "</form><br>";/********** form name='dest_advance' closing **********/	

				$this->view .= "<hr style='border: 3px solid #333; margin: 20px 0px 0px 0px;' />";/********** form name='dest_advance' closing **********/		
				$this->view .= "<br>";/********** break **********/

				$this->no++;
				

			}/********** while($this->results = $db1->fetch_array($this->execute)) closing **********/
			

		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

		return $this->view;
	}



	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF LOGSHEET NOTIFICATION ONLY							   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_lorry_available($adm_id,$adm_dept,$adm_permission,$logsheet_origin,$logsheet_destination,$date_shj,$date_shj2,$full_date){
		global $db1;
		
		$this->query_out = $query_out;
		$this->execute = $execute;
		$this->results = $results;
		$this->query_out2 = $query_out2;
		$this->execute2 = $execute2;
		$this->results2 = $results2;
				
		$this->adm_id = $adm_id;
		$this->adm_dept = $adm_dept;
		$this->adm_permission = $adm_permission;
		$this->logsheet_origin = $logsheet_origin;
		$this->logsheet_destination = $logsheet_destination;
				
		$this->date_shj = $date_shj;
		$this->date_shj2 = $date_shj2;
		$this->date_shj3 = $date_shj3;
		$this->full_date = $full_date;
		$this->no = 1;
		
		/**********  available lorry info **********/
		if($this->logsheet_destination == ""){
			$this->query_out = "SELECT DISTINCT lorry_id, lorry_regno FROM ymt_lorry WHERE lorry_branch='$this->logsheet_origin' and lorry_available = 1 and lorry_id NOT IN ( SELECT ls_lorry_no FROM ymt_logsheet WHERE ls_issued_date = '$this->date_shj' AND ls_branch = '$this->logsheet_origin' ) order by lorry_id desc";
		}else{
			$this->query_out = "SELECT DISTINCT lorry_id, lorry_regno, lorry_branch, ls_lorry_no, ls_destination_branch FROM ymt_lorry join ymt_logsheet on lorry_id = ls_lorry_no WHERE ls_issued_date = '$this->date_shj' AND ls_destination_branch = '$this->logsheet_destination' and ls_completed = 1 and lorry_available = 1 order by lorry_id desc";/**** check if the lorry has arrived in destination or not ****/
		}
		
		//echo "1st-> $this->query_out";
		$this->execute = $db1->query($this->query_out);

		if($this->logsheet_origin <> "" ){
			$this->branch_title = $this->logsheet_origin;
		}else{
			$this->branch_title = $this->logsheet_destination;
		}

		/**********  getting the logsheet result **********/
		if ($db1->num_rows($this->execute) == 0){

			$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center'>";
			$this->view .= "<tr>";
			$this->view .= "<td valign='top' colspan='6' align='right' style='font-size: 1.6em; border-bottom: 3px solid #999;' height='35'>Date : $this->date_shj2</td>";
			$this->view .= "</tr>";
			$this->view .= "<tr>";
			$this->view .= "<td height='40'><br>";
			$this->view .= "<p class='allert-message' style='font-size: 15px;'><strong>No lorries available in $this->branch_title branch. All are occupied.</strong></p>";
			$this->view .= "</td>";
			$this->view .= "</tr>";
			$this->view .= "</table>";/********** table closing **********/
			$this->record_found_today = "no";
		}else{
						
			if($this->logsheet_destination == ""){

				$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center'>";
				$this->view .= "<tr>";
				$this->view .= "<td valign='top' colspan='6' align='right' style='font-size: 1.6em; border-bottom: 3px solid #999;' height='35'>Date : $this->date_shj2</td>";
				$this->view .= "</tr>";
				$this->view .= "<tr>";
				$this->view .= "<td>&nbsp;</td>";
				$this->view .= "</tr>";
				$this->view .= "</table>";/********** table closing **********/

				$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' style='border: 1px solid #DDDDDD; background: $this->bck_color; color: $this->font_color' align='center'>";
				$this->view .= "<tr>";
				$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 35px;'>No</th>";
				$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 200px;'>Lorry Reg No</th>";
				$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 200px;'>Lorry Driver Name</th>";
				$this->view .= "</tr>";

				/********** Getting available lorry information **********/
				while($this->results = $db1->fetch_array($this->execute)){/********** while opening **********/
					
					if($this->no % 2 == 0){
						$this->bck_color = "#FFFFFF";					$this->font_color = "#666666";
					}else{
						$this->bck_color = "#F2F4F8";					$this->font_color = "#666666";
					}
					
					$this->view .= "<tr style='background: $this->bck_color; color: $this->font_color'>";
					$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top; text-align: left;' >".$this->no."</td>";	
					
					$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top; text-align: left;' >";	
					$this->view .= "<a href='ymtt_do_new.php?lorry_id=".$this->results['lorry_id']."&lry_reg_no=".$this->results['lorry_regno']."'>".$this->results['lorry_regno']."</a>&nbsp;&nbsp;";		
					$this->view .= "</td>";

					$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; vertical-align: top;'>";
									
					$this->query_out2 = "select driver_id, driver_name, driver_lorry_no from ymt_driver where driver_lorry_no='".$this->results['lorry_id']."' and (driver_status = 1 || driver_status = 3)";
					//echo "<p>1st-> $this->query_out_2</p>";
					$this->execute2 = $db1->query($this->query_out2);
					$this->results2 = $db1->fetch_array($this->execute2);

					$this->view .= "<a href='ymtt_driver_info.php?drv_id=".$this->results2['driver_id']."'>".$this->results2['driver_name']."</a>";
					$this->view .= "</td>";		
					$this->view .= "</tr>";
					
					$this->no++;

				}/********** while closing **********/

				$this->view .= "</table>";/********** table closing **********/			
				$this->view .= "<br>";/********** br closing **********/

			}else{
				
				$this->view .= "<table width='96%' cellspacing='0' cellpadding='0' border='0' align='center'>";
				$this->view .= "<tr>";
				$this->view .= "<td valign='top' colspan='6' align='right' style='font-size: 1.6em; border-bottom: 3px solid #999;' height='35'>Date : $this->date_shj2</td>";
				$this->view .= "</tr>";
				$this->view .= "<tr>";
				$this->view .= "<td>&nbsp;</td>";
				$this->view .= "</tr>";
				$this->view .= "</table>";/********** table closing **********/

				$this->view .= "Other Branch Lorry which is available";
				$this->view .= "<table width='96%' cellspacing='0' cellpadding='0' border='0' style='border: 1px solid #DDDDDD; background: $this->bck_color; color: $this->font_color' align='center'>";
				$this->view .= "<tr>";
				$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 35px;'>No</th>";
				$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 200px;'>Lorry Reg No</th>";
				$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 200px;'>Lorry Driver Name</th>";
				$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 50px;'>Branch</th>";
				$this->view .= "</tr>";

				/********** Getting available incoming lorry information **********/
				while($this->results = $db1->fetch_array($this->execute)){/********** while opening **********/
					
					$this->query_out3 = "SELECT ls_id, ls_lorry_no, lorry_id, lorry_regno, lorry_branch FROM ymt_logsheet join ymt_lorry on ls_lorry_no = lorry_id WHERE ls_lorry_no = '".$this->results['lorry_id']."' and ls_issued_date = '$this->date_shj' AND ls_branch = '$this->logsheet_destination' and ls_completed = 0 order by lorry_id desc";/**** check if the lorry already has has a logsheet or not? ****/

					$this->execute3 = $db1->query($this->query_out3);
					
					/**********  getting the logsheet lorry result **********/
					if ($db1->num_rows($this->execute3) == 0){
						$this->view .= "<tr style='background: $this->bck_color; color: $this->font_color'>";
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top; text-align: left;' colspan='4'>";
						$this->view .= "<p class='allert-message' style='font-size: 15px;'><strong>No incoming lorries available in $this->branch_title branch. All are occupied.</strong></p></td>";	
						$this->view .= "</tr>";

					}else{

						$this->results3 = $db1->fetch_array($this->execute3);

						if($this->no % 2 == 0){
							$this->bck_color = "#FFFFFF";					$this->font_color = "#666666";
						}else{
							$this->bck_color = "#F2F4F8";					$this->font_color = "#666666";
						}
						
						$this->view .= "<tr style='background: $this->bck_color; color: $this->font_color'>";
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top; text-align: left;' >".$this->no."</td>";	
						
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top; text-align: left;' >";	
						$this->view .= "<a href='ymtt_do_new.php?lorry_id=".$this->results3['lorry_id']."&lry_reg_no=".$this->results3['lorry_regno']."'>".$this->results3['lorry_regno']."</a>&nbsp;&nbsp;";		
						$this->view .= "</td>";

						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top;'>";
										
						$this->query_out4 = "select driver_id, driver_name, driver_lorry_no from ymt_driver where driver_lorry_no='".$this->results3['lorry_id']."' and (driver_status = 1 || driver_status = 3)";
						//echo "<p>1st-> $this->query_out_2</p>";
						$this->execute4 = $db1->query($this->query_out4);
						$this->results4 = $db1->fetch_array($this->execute4);

						$this->view .= "<a href='ymtt_driver_info.php?drv_id=".$this->results4['driver_id']."'>".$this->results4['driver_name']."</a>";
						$this->view .= "</td>";
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top;'>";
						$this->view .= $this->results['lorry_branch']."</td>";
						$this->view .= "</tr>";

					}			
					
					$this->no++;

				}/********** while closing **********/

				$this->view .= "</table>";/********** table closing **********/			
				$this->view .= "<br>";/********** br closing **********/

			}

			

		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

		return $this->view;
	}


	
	
	
	
	/*
	|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
	| LOCAL TRIP PRIVATE FUNCTIONS ADDED ON 30092012 (START)						   																																			   |
	|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
	*/
		
	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF LISTING LOGSHEET ONLY								   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_local_listing($adm_id,$adm_dept,$adm_branch,$adm_permission,$date_shj,$date_shj2,$date_shj3,$full_date,$day2view, $view_type, $pgnow){
		global $db1,$useripadd,$php_time,$pg_lftmenu_lgsht;
		
		$this->query_out	= $query_out;
		$this->execute		= $execute;
		$this->results		= $results;
		$this->query_out2	= $query_out2;
		$this->execute2		= $execute2;
		$this->results2		= $results2;
		$this->query_out3	= $query_out3;
		$this->execute3		= $execute3;
		$this->results3		= $results3;
		$this->query_out4	= $query_out4;
		$this->execute4		= $execute4;
		$this->results4		= $results4;
		$this->query_out5	= $query_out5;
		$this->execute5		= $execute5;
		$this->results5		= $results5;
		$this->query_out6	= $query_out6;
		$this->execute6		= $execute6;
		$this->results6		= $results6;
		$this->query_out7	= $query_out7;
		$this->execute7		= $execute7;
		$this->results7		= $results7;
				
		$this->adm_id		= $adm_id;
		$this->adm_dept		= $adm_dept;
		$this->adm_branch	= $adm_branch;
		$this->adm_permission = $adm_permission;
		$this->full_date	= $full_date;
		
		
		$this->pg_lftmenu_lgsht	= $pg_lftmenu_lgsht;
		
		$this->day2view		= $day2view;
		$this->view_type	= $view_type;
		$this->pgnow		= $pgnow;

		$this->no			= 1;
		$this->date_shj		= $date_shj;
		$this->date_shj2	= $date_shj2;
		$this->date_shj3	= $date_shj3;

		
		/**********  today's logsheet info **********/
		$this->query_out = "select a.ls_id, a.ls_branch, a.ls_no, a.ls_driver, a.ls_issued_date, a.ls_delivery_date, a.ls_trip_no, a.ls_destination_branch, a.ls_advance, a.ls_backdate, c.lorry_id, c.lorry_regno from ymt_logsheet a, ymt_lorry c where a.ls_lorry_no = c.lorry_id and ls_branch= '$this->adm_branch' and ls_issued_date = '$this->date_shj' and ls_status = 1 and ls_local = 1 and ls_trip_no $this->view_type order by ls_issued_date desc, ls_trip_no desc";
		//echo "<p>1st-> $this->query_out</p>";
		$this->execute = $db1->query($this->query_out);

		
		$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center' >";
		$this->view .= "<tr>";			
		$this->view .= "<td valign='top' align='left' style='font-size: 1.6em; border-bottom: 3px solid #999; ' height='35'>";
		$this->view .= "$this->adm_branch Branch List";
		$this->view .= "</td>";
		$this->view .= "<td valign='top' align='left' style='font-size: 1.6em; border-bottom: 3px solid #999;' height='35'>";
		$this->view .= "&nbsp;";
		$this->view .= "</td>";
		$this->view .= "<td valign='top' align='left' style='font-size: 1.6em; border-bottom: 3px solid #999;' height='35'>";
		$this->view .= "&nbsp;";
		$this->view .= "</td>";					
		$this->view .= "<td valign='top' align='right' style='font-size: 1.6em; border-bottom: 3px solid #999; width: 200px; cursor: pointer;' height='35' id='".$this->day2view."_click'>Date : $this->date_shj3</td>";
		$this->view .= "</tr>";
		$this->view .= "<tr>";
		$this->view .= "<td height='40'>&nbsp;</td>";
		$this->view .= "</tr>";
		$this->view .= "</table>";/********** table closing **********/
		
		
		/**********  getting the logsheet result **********/
		if ($db1->num_rows($this->execute) == 0){
			$this->record_found_today = "no";
		}else{
						
			
			if($this->day2view == "today_JB" || $this->day2view == "today_KL" || $this->day2view == "today_BM" || $this->day2view == "today_SP" ){
				$this->view .= "<div style='width: 100%;' id='$this->day2view'>";/********** div opening **********/
			}else{
				$this->view .= "<div style='display: block; width: 100%;' id='$this->day2view'>";/********** div opening **********/
			}

			
			/********** Getting logsheet information **********/
			while($this->results = $db1->fetch_array($this->execute)){/********** while opening **********/
				//echo "<p>backdated logsheet : ".$this->results['ls_trip_no']." -> ".$this->results['ls_backdate']." </p>";
				if($this->no % 2 == 0){
					if($this->results['ls_backdate'] == 1){
						$this->bck_color = "#005DB3";
						$this->font_color = "#FFFFFF";
					}else{
						$this->bck_color = "#FFFFFF";
						$this->font_color = "#666666";
					}
				}else{
					if($this->results['ls_backdate'] == 1){
						$this->bck_color = "#005DB3";
						$this->font_color = "#FFFFFF";
					}else{
						$this->bck_color = "#F2F4F8";
						$this->font_color = "#666666";
					}
					
				}
				
				
				$this->view .= "<form name='dest_advance' id='dest_advance' method='post' action=''>";/********** Form Opening **********/
					
				
					/**** Logsheet info div (start) ****/
					$this->view .= "<div style='width: 99%; padding: 10px 5px; margin-bottom: 15px; clear: both; font-size: 1.4em; background: $this->bck_color; color: $this->font_color'>";
						
						$this->view .= "<h4 style='margin-bottom: 15px;'>Logsheet Info</h4>";
						/**** 1st rows div (start) ****/
						$this->view .= "<div style='float: left; width: 200px; margin-right: 10px; '>";
						
							$this->view .= "<div style='float: left; width: 120px;'>Trip No</div>";
							$this->view .= "<div style='float: left; width: 70px;'>";
								$this->view .= ": <strong style='color: #000;'>".$this->results['ls_trip_no']."</strong>";
								$this->view .= "<input type='hidden' name='lsid' id='lsid' value='".$this->results['ls_id']."' size='3'>";
							$this->view .= "</div>";
							$this->view .= "<div class='clear'>&nbsp;</div>";
																	
						$this->view .= "</div>";
						
						
						$this->view .= "<div style='float: left; width: 290px; margin-right: 10px; '>";
						
							$this->view .= "<div style='float: left; width: 85px;'>Driver</div>";
							$this->view .= "<div style='float: left; width: 200px;'>";
								//$this->view .= ": <strong style='color: #000;'>".$this->results_ls['ls_branch']." ".$this->results['do_no']."</strong>";
								$this->query_out6 = "select driver_id, driver_branch, driver_route, driver_name, driver_mobile, driver_lorry_no from ymt_driver where driver_name != '' and driver_nature = 'Driver'";
								//echo "<p>2nd-> $this->query_out6</p>";
								$this->execute6 = $db1->query($this->query_out6);
								$this->view .= "<select name='driver_assigned' id='driver_assigned' style='font-size: 12px; width: 150px;'>";

									$this->view .= "<option value=''";
									if ($this->results['ls_driver'] == 0){			$this->view .= " selected='selected' ";			}
									$this->view .= " >&nbsp;</option>";

									while($this->results6 = $db1->fetch_array($this->execute6)){/********** while opening **********/
										$this->view .= "<option value='".$this->results6['driver_id']."'";
									
										if(($this->results6['driver_lorry_no'] == $this->results['lorry_id']) && $this->results['ls_driver'] == 0){	
											$this->view .= " selected='selected' ";		$this->driverroute = $this->results6['driver_route'];
										}elseif($this->results6['driver_id'] == $this->results['ls_driver']){	//dass add on 22032012 bug fixed (start)
											$this->view .= " selected='selected' ";		$this->driverroute = $this->results6['driver_route'];
										}//dass add on 22032012 bug fixed (end)

										$this->view .= " >".$this->results6['driver_name']."</option>";
									}

								$this->view .= "</select>&nbsp;&nbsp;";
								
								
								
							$this->view .= "</div>";
							$this->view .= "<div class='clear'>&nbsp;</div>";
											
						$this->view .= "</div>";
						
						
						
						
						$this->view .= "<div style='float: left; width: 240px; margin-right: 10px; '>";
							
							$this->view .= "<div style='float: left; width: 120px;'>Lorry No</div>";
							$this->view .= "<div style='float: left; width: 90px;'>";
								$this->view .= ": <strong style='color: #000;'><a href='ymtt_lorry_info.php?lry_id=".$this->results['lorry_id']."&lry_regno=".$this->results['lorry_regno']."' ";

								if($this->results['ls_backdate'] == 1){
									$this->view .= " style='color: #000000;'";
								}

								$this->view .= ">".$this->results['lorry_regno']."</a></strong>";
								
							$this->view .= "</div>";
							$this->view .= "<div class='clear'>&nbsp;</div>";
							
						$this->view .= "</div>";	

						$this->view .= "<div style='float: left; width: 150px; '>";
											
							$this->view .= "<div style='float: left; width: 90px;'>Dest.</div>";
							$this->view .= "<div style='float: left; width: 60px;'>";
								$this->view .= ": <strong style='color: #000;'>".$this->results['ls_destination_branch']."</strong>";
							$this->view .= "</div>";
							$this->view .= "<div class='clear'>&nbsp;</div>";					
							
						$this->view .= "</div>";
						
						$this->view .= "<div class='clear' style='margin-bottom: 10px;'>&nbsp;</div>";					
						/**** 1st rows div (end) ****/
						
						
						
						
						/**** 2nd rows div (start) ****/
						
						$this->view .= "<div style='float: left; width: 200px; margin-right: 10px; '>";
						
							$this->view .= "<div style='float: left; width: 120px;'>LogSheet No</div>";
							$this->view .= "<div style='float: left; width: 70px;'>";
								$this->view .= ": <strong style='color: #000;'><a href='ymtt_logsheet_info.php?ls_id=".$this->results['ls_id']."' ";

								if($this->results['ls_backdate'] == 1){
									$this->view .= " style='color: #000000;'";
								}

								$this->view .= ">".$this->results['ls_no']."</a></strong>";
					
					
							$this->view .= "</div>";
							$this->view .= "<div class='clear' style='margin-bottom: 10px;'>&nbsp;</div>";
							
						$this->view .= "</div>";
						
						
						$this->view .= "<div style='float: left; width: 290px; margin-right: 10px; '>";/**** 2nd rows driver & attentdant div wrapper (start) ****/
						
							
							$this->view .= "<div style='float: left; width: 290px; margin-right: 10px; '>";
							
								$this->view .= "<div style='float: left; width: 85px;'>Attendant</div>";
								$this->view .= "<div style='float: left; width: 200px;'>";
									$this->query_out6 = "select driver_id, driver_name, driver_mobile from ymt_driver where driver_name != '' and driver_nature = 'Attendant'";
									//echo "<p>3rd-> $this->query_out6</p>";
									$this->execute6 = $db1->query($this->query_out6);
									//$this->results6 = $db1->fetch_array($this->execute6);
									
									
									$this->view .= "<select name='attendant_assigned' style='font-size: 12px; width: 150px;'>";

										if ($this->results['ls_driver'] == 0){		$this->view .= "<option value=''>&nbsp;</option>";		}

										while($this->results6 = $db1->fetch_array($this->execute6)){/********** while opening **********/
											$this->view .= "<option value='".$this->results6['driver_id']."'";
											
											if($this->results6['driver_id'] == $this->results['ls_driver']){
												$this->view .= " selected='selected' ";
											}

											$this->view .= " >".$this->results6['driver_name']."</option>";
										}
										
										$this->view .= "</select>&nbsp;&nbsp;";
										
								$this->view .= "</div>";
								$this->view .= "<div class='clear'>&nbsp;</div>";
													
								
							$this->view .= "</div>";
							$this->view .= "<div class='clear'>&nbsp;</div>";
							
							$this->view .= "<div style='float: left; width: 290px; margin-top: 5px;'>";
											
								$this->view .= "<div style='float: left; width: 220px; font-size: 0.7em;'>Confirm Change Driver permenantly ?</div>";
								$this->view .= "<div style='float: left; width: 50px;font-size: 0.7em;'>";
									$this->view .= "<input type='checkbox' name='change_drv_yes' id='change_drv_yes' value='yes' >&nbsp;Yes";
								$this->view .= "</div>";
								$this->view .= "<div class='clear'>&nbsp;</div>";					
								
							$this->view .= "</div>";
							
						
						$this->view .= "</div>";/**** 2nd rows driver & attentdant div wrapper (end) ****/
						
						
						$this->view .= "<div style='float: left; width: 240px; '>";
											
							$this->view .= "<div style='float: left; width: 120px; '>Advance (RM)</div>";
							$this->view .= "<div style='float: left; width: 90px;margin-left: 10px;'>";
							
								$this->view .= "<input type='text' name='advance_cash' id='advance_cash' style='margin-top: 0px;' ";

								if($this->results['ls_advance'] <> ""){			$this->view .= "value='".$this->results['ls_advance']."' ";			}else{		$this->view .= "value='' ";			}
								
								$this->view .= "size='6'>";
								
							$this->view .= "</div>";
							$this->view .= "<div class='clear'>&nbsp;</div>";					
							
						$this->view .= "</div>";
						
						
						/* check if no of item of tat logsheet is more tan 16 (start) - 08092012  */
						//1) get the num of logsheet item.
						//2) get the num of do item.
						//3) add all n check if > 16
						//echo "pgbrk cntr : ".$this->lgsht_no_itm." for lg id : ".$this->results['ls_id']." <br><br> ";
						
						$this->lgsht_no_itm	= 0;
						$this->lgsht_no_itm2= 0;
						$this->itmcntstart 	= 1;
						$this->itmcntstart2	= 1;
						$this->prnt_link_extra = "";
		
						$this->query_out_lgsht_no_itm 	= "select lsi_id, lsi_ls_id, lsi_do_id from ymt_logsheet_item WHERE (lsi_ls_id = '".$this->results['ls_id']."' || lsi_ls_id_2 = '".$this->results['ls_id']."' || lsi_ls_id_3 = '".$this->results['ls_id']."' || lsi_ls_id_4 = '".$this->results['ls_id']."' || lsi_ls_id_5 = '".$this->results['ls_id']."') and lsi_status = 1 and lsi_local = 1 ";
						//echo "<p>3rd - 2-> $this->query_out_lgsht_no_itm</p>";
						$this->execute_lgsht_no_itm 	= $db1->query($this->query_out_lgsht_no_itm);
						if($db1->num_rows($this->execute_lgsht_no_itm) > 0 ){
						
							//echo "lgsht cnt : ".$db1->num_rows($this->execute_lgsht_no_itm)."  for lg id : ".$this->results['ls_id']." --> ";
							
														
							while($this->results_lgsht_no_itm = $db1->fetch_array($this->execute_lgsht_no_itm)){/********** while opening **********/
								
								$this->lgshtid_cnted = $this->results_lgsht_no_itm['lsi_ls_id'];
								$this->query_out_do_no_itm 	= "select doi_id from ymt_do_item where doi_do_id = '".$this->results_lgsht_no_itm['lsi_do_id']."' ";
								//echo "<p>3rd - 3-> $this->query_out_do_no_itm</p>";
								$this->execute_do_no_itm 	= $db1->query($this->query_out_do_no_itm);
								
								if($db1->num_rows($this->execute_do_no_itm) > 0 ){
									//echo "do cnt : ".$db1->num_rows($this->execute_do_no_itm)." for lg id : ".$this->results['ls_id']."<br>";
									
									$this->lgsht_no_itm	+= $db1->num_rows($this->execute_do_no_itm);
								}else{
									$this->lgsht_no_itm++;
								}
								
								//echo "<p><strong>final cnt : $this->itmcntstart) ".$this->lgsht_no_itm."</strong> for lg id : ".$this->results['ls_id']."<br>";
								$this->itmcntstart++;
								
							}
							
							
						}else{
							$this->lgsht_no_itm = 0;
						}				
						/* check if no of item of tat logsheet is more tan 16 (end) - 08092012  */
						
						
						if($this->lgsht_no_itm > 16 && $this->lgshtid_cnted == $this->results['ls_id']){		$this->prnt_link_extra = "&pg=break";		}
						
						$this->view .= "<div style='float: left; width: 30px; border: 2px solid green; padding: 4px;margin-left: 115px;'>";
								$this->view .= "<a href='".$this->pg_lftmenu_lgsht['link_41']."&ls_id=".$this->results['ls_id'].$this->prnt_link_extra."&itm=".$this->lgsht_no_itm."' target='_blank'><img src='images/print.png' style='text-decoration: none; border: 0px;'></a>";
						$this->view .= "</div>";
						
						
						$this->view .= "<div class='clear' style='margin-bottom: 30px;'>&nbsp;</div>";					
						/**** 2nd rows div (end) ****/
						
						
						
						$this->view .= "<input type='hidden' name='page_now' id='page_now' value='temp'>";
						
						
						
						
						$this->view .= "<input type='hidden' name='origin_branch' id='origin_branch' value='".$this->results['ls_branch']."'>";
						$this->view .= "<input type='hidden' name='update_dest_advance' id='update_dest_advance' value='confirm'>";
						$this->view .= "<input type='hidden' name='starting_date' id='starting_date' value='".$php_time."'>";
						$this->view .= "<input type='submit' name='submit' id='submit' value='Set Dest. Branch & Trip Expense' size='3'>";
						
					$this->view .= "</div>";
					/**** Logsheet info div (end) ****/
					
					
					
					
					/**** Trip Expenses info div (start) ****/
					//$this->view .= "<div style='width: 98.7%; padding: 10px 5px; margin-bottom: 35px; clear: both; font-size: 1.1em; border: 2px solid #005DB3; background: $this->bck_color2; '>";
						
						//$this->view .= "<h4 style='margin-bottom: 15px; color: #005DB3;'>Trip Expenses</h4>";
						
						//$this->query_out_te = "select te_id, te_no, te_trip_no, te_lgsht from ymt_trip_expenses where te_lgsht = '".$this->results['ls_id']."'";
						////echo "<p>4th-> $this->query_out_te</p>";
						//$this->execute_te = $db1->query($this->query_out_te);
						//$this->results_te = $db1->fetch_assoc($this->execute_te);

						//$this->query_out_te_det = "select tei_id, tei_normal, tei_extra_1, tei_extra_2, tei_extra_3, tei_extra_4, tei_extra_5, tei_extra_total, tei_adv_1, tei_adv_2, tei_adv_3, tei_adv_4, tei_adv_5, tei_adv_total, tei_deduct_1, tei_deduct_2, tei_deduct_3, tei_deduct_4, tei_deduct_5, tei_adv_deduct_total, tei_adv_deduct_bal from ymt_trip_expenses_items where tei_te_id= '".$this->results_te['te_id']."'";
						////echo "<p>te Q-> $this->query_out_te_det</p>";
						//$this->execute_te_det 	= $db1->query($this->query_out_te_det);
						
						/**********  getting the logsheet result **********/
						if ($db1->num_rows($this->execute_te_det) == 0 && $this->pgnow <> "temp_real"){
							//$this->view .= "<h4 style='margin-bottom: 15px; color: #005DB3;'>Not Issued to this driver</h4>";
						}else{
							
							$this->results_te_det = $db1->fetch_assoc($this->execute_te_det);
							
							/**** 1st rows div (start) ****/
							//$this->view .= "<div style='float: left; width: 230px; '>";
							
								// $this->view .= "<div style='float: left; width: 120px;padding-top: 6px;font-weight: bold;'>Normal (RM)</div>";
								// $this->view .= "<div style='float: left; width: 80px;'>";
									// $this->view .= "<input type='text' name='nrmal_".$this->results['ls_id']."' id='nrmal_".$this->results['ls_id']."' value='";
									
									// if($this->results_te_det['tei_normal'] <> ''){
										// $this->view .= $this->results_te_det['tei_normal'];
									// }else{
										// $this->view .= $_REQUEST['nrmal_'.$this->results['ls_id']];
									// }									
									
									// $this->view .= "' size='6'>";
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear'>&nbsp;</div>";

								// $this->view .= "<div style='float: left; width: 120px;padding-top: 6px;font-weight: bold;'>Extra 1 (RM)</div>";
								// $this->view .= "<div style='float: left; width: 80px;'>";
									// $this->view .= "<input type='text' name='extr1_".$this->results['ls_id']."' id='extr1_".$this->results['ls_id']."' value='";
									
									// if($this->results_te_det['tei_extra_1'] <> ''){
										// $this->view .= $this->results_te_det['tei_extra_1'];
									// }else{
										// $this->view .= $_REQUEST['extr1_'.$this->results['ls_id']];
									// }									
									
									// $this->view .= "' size='6'>";					
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear' style=''>&nbsp;</div>";

								// $this->view .= "<div style='float: left; width: 120px;padding-top: 6px;font-weight: bold;'>Extra 2 (RM)</div>";
								// $this->view .= "<div style='float: left; width: 80px;'>";
									// $this->view .= "<input type='text' name='extr2_".$this->results['ls_id']."' id='extr2_".$this->results['ls_id']."' value='";
									
									// if($this->results_te_det['tei_extra_2'] <> ''){
										// $this->view .= $this->results_te_det['tei_extra_2'];
									// }else{
										// $this->view .= $_REQUEST['extr2_'.$this->results['ls_id']];
									// }									
									
									// $this->view .= "' size='6'>";
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear'>&nbsp;</div>";


								// $this->view .= "<div style='float: left; width: 120px;padding-top: 6px;font-weight: bold;'>Extra 3 (RM)</div>";
								// $this->view .= "<div style='float: left; width: 80px;'>";
									// $this->view .= "<input type='text' name='extr3_".$this->results['ls_id']."' id='extr3_".$this->results['ls_id']."' value='";
									
									// if($this->results_te_det['tei_extra_3'] <> ''){
										// $this->view .= $this->results_te_det['tei_extra_3'];
									// }else{
										// $this->view .= $_REQUEST['extr3_'.$this->results['ls_id']];
									// }									
									
									// $this->view .= "' size='6'>";
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear'>&nbsp;</div>";
																		
							// $this->view .= "</div>";





							// $this->view .= "<div style='float: left; width: 240px; '>";
							
								// $this->view .= "<div style='float: left; width: 130px;padding-top: 6px;font-weight: bold;'>Advance 1 (RM)</div>";
								// $this->view .= "<div style='float: left; width: 100px;'>";
									// $this->view .= "<input type='text' name='adv1_".$this->results['ls_id']."' id='adv1_".$this->results['ls_id']."' value='";
									
									// if($this->results_te_det['tei_adv_1'] <> ''){
										// $this->view .= $this->results_te_det['tei_adv_1'];
									// }else{
										// $this->view .= $_REQUEST['adv1_'.$this->results['ls_id']];
									// }									
									
									// $this->view .= "' size='6'>";
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear'>&nbsp;</div>";

								// $this->view .= "<div style='float: left; width: 130px;padding-top: 6px;font-weight: bold;'>Advance 2 (RM)</div>";
								// $this->view .= "<div style='float: left; width: 100px;'>";
									// $this->view .= "<input type='text' name='adv2_".$this->results['ls_id']."' id='adv2_".$this->results['ls_id']."' value='";
									
									// if($this->results_te_det['tei_adv_2'] <> ''){
										// $this->view .= $this->results_te_det['tei_adv_2'];
									// }else{
										// $this->view .= $_REQUEST['adv2_'.$this->results['ls_id']];
									// }									
									
									// $this->view .= "' size='6'>";					
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear'>&nbsp;</div>";

								// $this->view .= "<div style='float: left; width: 130px;padding-top: 6px;font-weight: bold;'>Advance 3 (RM)</div>";
								// $this->view .= "<div style='float: left; width: 100px;'>";
									// $this->view .= "<input type='text' name='adv3_".$this->results['ls_id']."' id='adv3_".$this->results['ls_id']."' value='";
									
									// if($this->results_te_det['tei_adv_3'] <> ''){
										// $this->view .= $this->results_te_det['tei_adv_3'];
									// }else{
										// $this->view .= $_REQUEST['adv3_'.$this->results['ls_id']];
									// }									
									
									// $this->view .= "' size='6'>";
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear' style='margin-bottom: 10px;'>&nbsp;</div>";							
								
							// $this->view .= "</div>";




							
							//$this->view .= "<div style='float: left; width: 230px;'>";
								
								// $this->view .= "<div style='float: left; width: 130px;padding-top: 6px; font-weight: bold;'>Deduction 1 (RM)</div>";
								// $this->view .= "<div style='float: left; width: 100px;'>";
									// $this->view .= "<input type='text' name='ddct1_".$this->results['ls_id']."' id='ddct1_".$this->results['ls_id']."' value='";
									
									// if($this->results_te_det['tei_deduct_1'] <> ''){
										// $this->view .= $this->results_te_det['tei_deduct_1'];
									// }else{
										// $this->view .= $_REQUEST['ddct1_'.$this->results['ls_id']];
									// }									
									
									// $this->view .= "' size='6'>";
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear'>&nbsp;</div>";

								// $this->view .= "<div style='float: left; width: 130px;padding-top: 6px;font-weight: bold;'>Deduction 2 (RM)</div>";
								// $this->view .= "<div style='float: left; width: 100px;'>";
									// $this->view .= "<input type='text' name='ddct2_".$this->results['ls_id']."' id='ddct2_".$this->results['ls_id']."' value='";
									
									// if($this->results_te_det['tei_deduct_2'] <> ''){
										// $this->view .= $this->results_te_det['tei_deduct_2'];
									// }else{
										// $this->view .= $_REQUEST['ddct2_'.$this->results['ls_id']];
									// }									
									
									// $this->view .= "' size='6'>";					
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear'>&nbsp;</div>";

								// $this->view .= "<div style='float: left; width: 130px;padding-top: 6px;font-weight: bold;'>Deduction 3 (RM)</div>";
								// $this->view .= "<div style='float: left; width: 100px;'>";
									// $this->view .= "<input type='text' name='ddct3_".$this->results['ls_id']."' id='ddct3_".$this->results['ls_id']."' value='";
									
									// if($this->results_te_det['tei_deduct_3'] <> ''){
										// $this->view .= $this->results_te_det['tei_deduct_3'];
									// }else{
										// $this->view .= $_REQUEST['ddct3_'.$this->results['ls_id']];
									// }									
									
									// $this->view .= "' size='6'>";
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear'>&nbsp;</div>";
															
							// $this->view .= "</div>";	

							// $this->view .= "<div class='clear' style='margin-bottom: 10px;'>&nbsp;</div>";					
							/**** 1st rows div (end) ****/
							
							
							
							/**** 2nd rows div (start) ****/
							// $this->view .= "<div style='float: left; width: 230px; '>";
							
								// $this->view .= "<div style='float: left; width: 130px;font-weight: bold;'>Subtotal 1 (RM)</div>";
								// $this->view .= "<div style='float: left; width: 70px; '>";
									// $this->view .= "<strong style='color: #000; font-weight: bold; '>".number_format(($this->results_te_det['tei_normal']+$this->results_te_det['tei_extra_1']+$this->results_te_det['tei_extra_2']+$this->results_te_det['tei_extra_3']+$this->results_te_det['tei_extra_4']+$this->results_te_det['tei_extra_5']),2)."</strong>";
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear'>&nbsp;</div>";
																		
							// $this->view .= "</div>";
							// $this->view .= "<div style='float: left; width: 230px; margin-right: 10px; '>";
							
								// $this->view .= "<div style='float: left; width: 140px;font-weight: bold;'>Subtotal 2 (RM)</div>";
								// $this->view .= "<div style='float: left; width: 70px;'>";
									// $this->view .= "<strong style='color: #000; font-weight: bold; '>".number_format(($this->results_te_det['tei_adv_1']+$this->results_te_det['tei_adv_2']+$this->results_te_det['tei_adv_3']+$this->results_te_det['tei_adv_4']+$this->results_te_det['tei_adv_5']),2)."</strong>";
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear'>&nbsp;</div>";
								
							// $this->view .= "</div>";
							
							// $this->view .= "<div style='float: left; width: 230px;'>";
								
								// $this->view .= "<div style='float: left; width: 140px;font-weight: bold;'>Subtotal 3 (RM)</div>";
								// $this->view .= "<div style='float: left; width: 70px;'>";
									// $this->view .= "<strong style='color: #000; font-weight: bold; '>".number_format(($this->results_te_det['tei_deduct_1']+$this->results_te_det['tei_deduct_2']+$this->results_te_det['tei_deduct_3']+$this->results_te_det['tei_deduct_4']+$this->results_te_det['tei_deduct_5']),2)."</strong>";
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear'>&nbsp;</div>";
								
							// $this->view .= "</div>";


							// $this->view .= "<div style='float: left; width: 200px;'>";
								
								// $this->view .= "<div style='float: left; width: 130px;font-weight: bold;'>Grandtotal (RM)</div>";
								// $this->view .= "<div style='float: left; width: 70px;'>";
									// $this->view .= "<strong style='color: #000; font-weight: bold; '>".number_format($this->results_te_det['tei_adv_deduct_bal'],2)."</strong>";
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear'>&nbsp;</div>";
								
							// $this->view .= "</div>";							

							// $this->view .= "<div class='clear' style=''>&nbsp;</div>";				
							/**** 2nd rows div (end) ****/
							
							
							/**** 4th rows div (start) ****/
							// $this->view .= "<div style='float: left; width: 300px; margin-right: 10px; '>";
							
								// $this->view .= "<div style='float: left; width: 150px;padding-top: 6px;font-weight: bold;'>Subtotal (RM)</div>";
								// $this->view .= "<div style='float: left; width: 100px;'>";
									// $this->view .= "<input type='text' name='subttl' id='subttl' value='".$_REQUEST['subttl']."' size='6'>";
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear'>&nbsp;</div>";
																		
							// $this->view .= "</div>";
							// $this->view .= "<div style='float: left; width: 300px; margin-right: 10px; '>";
							
								// $this->view .= "<div style='float: left; width: 150px;padding-top: 6px;font-weight: bold;'>Total (RM)</div>";
								// $this->view .= "<div style='float: left; width: 100px;'>";
									// $this->view .= "<input type='text' name='total' id='total' value='".$_REQUEST['total']."' size='6'>";					
								// $this->view .= "</div>";
								// $this->view .= "<div class='clear' style='margin-bottom: 10px;'>&nbsp;</div>";
								
							// $this->view .= "</div>";
							
							// $this->view .= "<div style='float: left; width: 290px;'>";
								
								////$this->view .= "<div style='float: left; width: 150px;padding-top: 6px;'>Advance 3 (RM)</div>";
								////$this->view .= "<div style='float: left; width: 100px;'>";
									////$this->view .= "<input type='text' name='adv3' id='adv3' value='".$_REQUEST['adv3']."' size='10'>";
								////$this->view .= "</div>";
								////$this->view .= "<div class='clear'>&nbsp;</div>";
								
							// $this->view .= "</div>";	

							//$this->view .= "<div class='clear' style='margin-bottom: 10px;'>&nbsp;</div>";				
							/**** 4th rows div (end) ****/
						
						}
						
						
						
						// if($this->results_te['te_id'] > 0 && $this->results_te['te_id'] <> ""){
							// $this->view .= "<input type='hidden' name='update_te_only_".$this->results['ls_id']."' id='update_te_only_".$this->results['ls_id']."' value='yes'>";
							// $this->view .= "<input type='hidden' name='teid_".$this->results['ls_id']."' id='teid_".$this->results_te['te_id']."' value='".$this->results_te['te_id']."'>";
						// }
						
						// if($this->results['ls_trip_no'] > 0 ){
							// $this->view .= "<input type='hidden' name='page_now' id='page_now' value='real'>";
						// }else{
							// $this->view .= "<input type='hidden' name='page_now' id='page_now' value='temp'>";
						// }
						
						
						
						// $this->view .= "<input type='hidden' name='origin_branch' id='origin_branch' value='".$this->results['ls_branch']."'>";
						// $this->view .= "<input type='hidden' name='update_dest_advance' id='update_dest_advance' value='confirm'>";
						// $this->view .= "<input type='hidden' name='starting_date' id='starting_date' value='".$php_time."'>";
						// $this->view .= "<input type='submit' name='submit' id='submit' value='Set Dest. Branch & Trip Expense' size='3'>";
						
						
					//$this->view .= "</div>";
					/**** Trip Expenses info div (end) ****/
					
					//$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center' style='background: $this->bck_color; color: $this->font_color'>";
					// $this->view .= "<tr>";
					// $this->view .= "<td align='left' style='font-size: 1.25em; width: 70px; vertical-align: middle;' height='45'>Trip No</td>";
					// $this->view .= "<td width='20' style=' vertical-align: middle;'>&nbsp;:&nbsp;</td>";
					// $this->view .= "<td align='left' style='font-size: 1.25em; width: 95px; vertical-align: middle;'><strong>".$this->results['ls_trip_no']."</strong>";
					// $this->view .= "<input type='hidden' name='lsid' id='lsid' value='".$this->results['ls_id']."' size='3'>";
					// $this->view .= "</td>";

					// $this->view .= "<td valign='top' align='left' style='font-size: 1.25em; width: 70px; vertical-align: middle;'>Driver</td>";
					// $this->view .= "<td width='20' style=' vertical-align: middle;'>&nbsp;:&nbsp;</td>";
									
					// $this->query_out6 = "select driver_id, driver_branch, driver_route, driver_name, driver_mobile, driver_lorry_no from ymt_driver where driver_name != '' and driver_nature = 'Driver'";
					////echo "<p>1st-> $this->query_out6</p>";
					// $this->execute6 = $db1->query($this->query_out6);
					// $this->view .= "<td align='left' style='font-size: 1.25em; vertical-align: middle;'>";
					
						// $this->view .= "<select name='driver_assigned' id='driver_assigned' style='font-size: 12px; width: 125px;'>";

						// $this->view .= "<option value=''";
						// if ($this->results['ls_driver'] == 0){			$this->view .= " selected='selected' ";			}
						// $this->view .= " >&nbsp;</option>";

						// while($this->results6 = $db1->fetch_array($this->execute6)){/********** while opening **********/
							// $this->view .= "<option value='".$this->results6['driver_id']."'";
						
							// if(($this->results6['driver_lorry_no'] == $this->results['lorry_id']) && $this->results['ls_driver'] == 0){	
								// $this->view .= " selected='selected' ";		$this->driverroute = $this->results6['driver_route'];
							// }elseif($this->results6['driver_id'] == $this->results['ls_driver']){	//dass add on 22032012 bug fixed (start)
								// $this->view .= " selected='selected' ";		$this->driverroute = $this->results6['driver_route'];
							// }//dass add on 22032012 bug fixed (end)

							// $this->view .= " >".$this->results6['driver_name']."</option>";
						// }

						// $this->view .= "</select>&nbsp;&nbsp;";

					// $this->view .= "</td>";
					
					// $this->view .= "<td valign='top' align='left' style='font-size: 1.25em; width: 120px; vertical-align: middle;'>Logsheet No</td>";
					// $this->view .= "<td width='20' style=' vertical-align: middle;'>&nbsp;:&nbsp;</td>";
					// $this->view .= "<td align='left' style='font-size: 1.25em; width: 110px; vertical-align: middle;'>";
					
					// $this->view .= "<strong><a href='ymtt_logsheet_info.php?ls_id=".$this->results['ls_id']."' ";

					// if($this->results['ls_backdate'] == 1){
						// $this->view .= " style='color: #000000;'";
					// }

					// $this->view .= ">".$this->results['ls_no']."</a></strong></td>";

					// $this->view .= "<td valign='top' align='left' style='font-size: 1.25em; width: 110px; vertical-align: middle;'>Dest. Branch</td>";
					// $this->view .= "<td width='20' style=' vertical-align: middle;'>&nbsp;:&nbsp;</td>";
									
					// $this->view .= "<td align='right' style='font-size: 1.25em;  vertical-align: middle; width: 70px;'>";
									
					// $this->view .= "<select name='destination_branch' id='destination_branch' size='1' />";

					
					// $this->view .= "<option value='JB' ";				
						// if($this->results['ls_destination_branch'] == "JB"){		$this->view .= " selected='selected' ";		}				
					// $this->view .= " >JB</option>";
					
					// $this->view .= "<option value='KL' ";				
						// if($this->results['ls_destination_branch'] == "KL"){		$this->view .= " selected='selected' ";		}				
					// $this->view .= " >KL</option>";
					
					// $this->view .= "<option value='BM' ";				
						// if($this->results['ls_destination_branch'] == "BM"){		$this->view .= " selected='selected' ";		}				
					// $this->view .= " >BM</option>";
					
					// $this->view .= "<option value='SP' ";				
						// if($this->results['ls_destination_branch'] == "SP"){		$this->view .= " selected='selected' ";		}				
					// $this->view .= " >SP</option>";
					
					// $this->view .= "</select>";
					// $this->view .= "</td>";
					// $this->view .= "</tr>";

					// $this->view .= "<tr>";
					// $this->view .= "<td valign='top' align='left' style='font-size: 1.25em; ' height='35'>Lorry No</td>";
					// $this->view .= "<td width='20' style=' vertical-align: middle;'>&nbsp;:&nbsp;</td>";
					
					
					// $this->view .= "<td align='left' style='font-size: 1.25em; width: 95px; vertical-align: middle;'>";
					// $this->view .= "<strong><a href='ymtt_lorry_info.php?lry_id=".$this->results['lorry_id']."&lry_regno=".$this->results['lorry_regno']."' ";

					// if($this->results['ls_backdate'] == 1){
						// $this->view .= " style='color: #000000;'";
					// }

					// $this->view .= ">".$this->results['lorry_regno']."</a></strong>";
					// $this->view .= "</td>";


								
					// $this->view .= "<td valign='top' align='left' style='font-size: 1.25em; '>Attendant</td>";
					// $this->view .= "<td width='20'>&nbsp;:&nbsp;</td>";
					
					// $this->query_out6 = "select driver_id, driver_name, driver_mobile from ymt_driver where driver_name != '' and driver_nature = 'Attendant'";
					////echo "<p>1st-> $this->query_out6</p>";
					// $this->execute6 = $db1->query($this->query_out6);
					// $this->results6 = $db1->fetch_array($this->execute6);
					// $this->view .= "<td align='left' style='font-size: 1.25em; vertical-align: middle;'>";
					
					// $this->view .= "<select name='attendant_assigned' style='font-size: 12px; width: 125px;'>";

						// if ($this->results['ls_driver'] == 0){		$this->view .= "<option value=''>&nbsp;</option>";		}

						// while($this->results6 = $db1->fetch_array($this->execute6)){/********** while opening **********/
							// $this->view .= "<option value='".$this->results6['driver_id']."'";
							
							// if($this->results6['driver_id'] == $this->results['ls_driver']){
								// $this->view .= " selected='selected' ";
							// }

							// $this->view .= " >".$this->results6['driver_name']."</option>";
						// }
						
						// $this->view .= "</select>&nbsp;&nbsp;";

					// $this->view .= "</td>";


					// $this->view .= "<td valign='top' align='left' style='font-size: 1.25em; '>Advance (RM)</td>";
					// $this->view .= "<td width='20'>&nbsp;:&nbsp;</td>";
					// $this->view .= "<td align='left' style='font-size: 1.25em;'>";
					// $this->view .= "<input type='text' name='advance_cash' id='advance_cash' ";

					// if($this->results['ls_advance'] <> ""){			$this->view .= "value='".$this->results['ls_advance']."' ";			}else{		$this->view .= "value='' ";			}
					// $this->view .= "size='6'>";

					// $this->view .= "</td>";

					// $this->view .= "<td valign='top' align='left'>";
					// $this->view .= "<input type='hidden' name='origin_branch' id='origin_branch' value='".$this->results['ls_branch']."'>";
					// $this->view .= "<input type='hidden' name='update_dest_advance' id='update_dest_advance' value='confirm'>";
					// $this->view .= "<input type='hidden' name='starting_date' id='starting_date' value='".$php_time."'>";
					// $this->view .= "<input type='submit' name='submit' id='submit' value='Set Dest. Branch' size='3'>";
					// $this->view .= "</td>";

					// $this->view .= "<td width='20'>&nbsp;&nbsp;</td>";					
					// $this->view .= "<td valign='top' align='right'><a href='ymtt_logsheet_print.php?ls_id=".$this->results['ls_id']."' target='_blank'><img src='images/print.png' style='text-decoration: none; border: 0px;'></a></td>";
					// $this->view .= "</tr>";

					// /**** change / update driver 2 new lorry on logsheet 03062012(start) ****/
					// $this->view .= "<tr>";
						// $this->view .= "<td valign='top' align='left' style='font-size: 1em; ' colspan='4'>Confirm Change Driver permenantly ?</td>";
						// $this->view .= "<td width='20'>&nbsp;:&nbsp;</td>";
						// $this->view .= "<td valign='top' align='left' style='font-size: 1em; ' >";
							// $this->view .= "<input type='checkbox' name='change_drv_yes' id='change_drv_yes' value='yes' colspan='7'>&nbsp;Yes";
						// $this->view .= "</td>";					
					// $this->view .= "</tr>";
					// /**** change / update driver 2 new lorry on logsheet 03062012(start) ****/


					// $this->view .= "</table>";/********** table closing **********/			
//				$this->view .= "<input type='hidden' name='origin_branch' id='origin_branch' value='".$this->results['ls_branch']."'>";
//				$this->view .= "<input type='hidden' name='update_dest_advance' id='update_dest_advance' value='confirm'>";
//				$this->view .= "<input type='submit' name='submit' id='submit' value='Set Destination Branch' size='3'>";
				$this->view .= "</form><br>";/********** form name='dest_advance' closing **********/


				/**********  today's logsheet info **********/
				$this->query_out2 = "SELECT lsi_id, lsi_do_id  FROM `ymt_logsheet_item` WHERE (lsi_ls_id = '".$this->results['ls_id']."' || lsi_ls_id_2 = '".$this->results['ls_id']."' || lsi_ls_id_3 = '".$this->results['ls_id']."' || lsi_ls_id_4 = '".$this->results['ls_id']."' || lsi_ls_id_5 = '".$this->results['ls_id']."') and lsi_status = 1 and lsi_local = 1";
				//echo "<p>1st-> $this->query_out2</p>";
				$this->execute2 = $db1->query($this->query_out2);
						
						
				$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' style='border: 1px solid #DDDDDD; background: $this->bck_color; color: $this->font_color' align='center'>";
				$this->view .= "<tr>";
				$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 55px;'>DO No</th>";
				$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 50px;'>From</th>";
				$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 90px;'>To</th>";
				$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 145px;'>Consignor</th>";
				$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; width: 145px;'>Consignee</th>";
				$this->view .= "<th valign='top' width='280' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;'>Description</th>";
				$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;  width: 85px;'>Quantity</th>";
				$this->view .= "<th valign='top' align='left' style='border-bottom: 1px solid #DDDDDD; width: 85px;'>Weight</th>";
				$this->view .= "</tr>";

				/**********  getting the logsheet result **********/
				if ($db1->num_rows($this->execute2) > 0){					

					/********** Getting logsheet information **********/
					while($this->results2 = $db1->fetch_array($this->execute2)){/********** while opening **********/
					//print_r($this->results2);
					//print_r("<br>");
						
						$this->view .= "<tr>";
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top;'>";	
						
						$this->query_out7 = "select do_id, do_no from ymt_do where do_id = '".$this->results2['lsi_do_id']."' and do_status = 1";
						$this->execute7 = $db1->query($this->query_out7);
						$this->results7 = $db1->fetch_assoc($this->execute7);
						$this->view .= "<a href='ymtt_do_info.php?dorder_id=".$this->results7['do_id']."' ";
						
						if($this->results['ls_backdate'] == 1){		$this->view .= " style='color: #5BC236;'";			}	
						$this->view .= ">".$this->results7['do_no']."</a>&nbsp;&nbsp;";
				
						$this->view .= "</td>";


						/********** grb ls item info frm do item **********/
						$this->query_out20 = "SELECT do_id, do_no, do_consignor, do_collect_frm, do_consignee, do_deliver_to, do_deliver_to2 FROM `ymt_do` WHERE do_id = '".$this->results2['lsi_do_id']."' and do_status = 1 ";
						//echo "<p>1st-> $this->query_out2</p>";
						$this->execute20 = $db1->query($this->query_out20);
						$this->results20 = $db1->fetch_assoc($this->execute20);
						
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top;'>".$this->results20['do_collect_frm']."</td>";
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top;'>".$this->results20['do_deliver_to2']."</td>";
						$this->view .= "<td style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top; text-align: left;'>";
					
						$this->query_out5 = "select client_id, client_name as consignee_name from ymt_client where client_id='".$this->results20['do_consignor']."' and (client_status = 1 || client_status = 3)";
						//echo "<p>5st-> $this->query_out_5</p>";
						$this->execute5 = $db1->query($this->query_out5);
						$this->results5 = $db1->fetch_array($this->execute5);
						$this->view .= "<a href='ymtt_client_info.php?clnt_id=".$this->results5['client_id']."' ";
						
						if($this->results['ls_backdate'] == 1){			$this->view .= " style='color: #5BC236;'";			}
						$this->view .= ">".$this->results5['consignee_name']."</a>";
						
						$this->view .= "</td>";		
						
						$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; vertical-align: top; text-align: left;'>";
						
						$this->query_out3 = "select client_id, client_name as consignee_name from ymt_client where client_id='".$this->results20['do_consignee']."' and (client_status = 1 || client_status = 3)";
						//echo "<p>3st-> $this->query_out_3</p>";
						$this->execute3 = $db1->query($this->query_out3);
						$this->results3 = $db1->fetch_array($this->execute3);
						$this->view .= "<a href='ymtt_client_info.php?clnt_id=".$this->results3['client_id']."' ";
						
						if($this->results['ls_backdate'] == 1){			$this->view .= " style='color: #5BC236;'";			}
						$this->view .= ">".$this->results3['consignee_name']."</a>";

						$this->view .= "</td>";	
						
						
						$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;' colspan='3'>"; 

						$this->view .= "<table width='100%' cellspacing='0' cellpadding='0' border='0' align='center'>";
														

						/**********  today's logsheet info **********/
						$this->query_out4 = "select doi_desc, doi_qty, doi_weight from ymt_do_item where doi_do_id = '".$this->results20['do_id']."' order by doi_id desc";
						//echo "<p>1st-> $this->query_out4</p>";
						$this->execute4 = $db1->query($this->query_out4);
						
						while($this->results4 = $db1->fetch_array($this->execute4)){/********** while opening **********/
							$this->view .= "<tr>";
							$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;text-align: left;' width='280'>".$this->results4['doi_desc']."</td>";
							$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;text-align: left; width: 85px;' >".$this->results4['doi_qty']."</td>";
							$this->view .= "<td valign='top' style='border-bottom: 1px solid #DDDDDD; text-align: left; width: 85px;' >".$this->results4['doi_weight']."</td>";
							$this->view .= "</tr>";
						}

						
						$this->view .= "</table>";/********** table of logsheet item record closing **********/

						$this->view .= "</td>";
						$this->view .= "</tr>";

					}/********** while closing **********/

					

				}/********** if ($db1->num_rows($this->execute2) == 0) else closing **********/

				$this->view .= "</table>";/********** table of logsheet item record closing **********/

				$this->view .= "<br><hr style='color: #f00; background-color: #f00; height: 5px;' /><br>";/********** break **********/

				$this->no++;

			}/********** while closing **********/

			$this->view .= "</div>";/********** break **********/

		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

		return $this->view;
	}
	
	
	
	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF SET DELIVERY ORDER NO ONLY							   |
	|--------------------------------------------------------------------------|
	*/
	private function logsheet_local_destination($adm_id,$adm_dept,$adm_permission,$logsheet_id,$logsheet_origin,$logsheet_advance_cash,$logsheet_driver,$logsheet_attendant, $logsheet_drv_change, $nrmal, $extr1, $extr2, $extr3, $adv1, $adv2, $adv3, $ddct1, $ddct2, $ddct3, $teid, $update_me, $full_date,$tomorrow_only){
		if($_SESSION['mychecking'] == 1){	
			echo "<p>wir lgsht dest->> $adm_id,$adm_dept,$adm_permission,$logsheet_id,$logsheet_origin,$logsheet_advance_cash,$logsheet_driver,$logsheet_attendant, $logsheet_drv_change, $nrmal, $extr1, $extr2, $extr3, $adv1, $adv2, $adv3, $ddct1, $ddct2, $ddct3, $teid, $update_me, $full_date,$tomorrow_only</p>";		
			//exit;
		}
		global $db1, $php_time, $php_date, $php_mth, $php_yr, $useripadd;
		
		$this->query_out	= $query_out;
		$this->execute		= $execute;
		$this->results		= $results;
		$this->query_out2	= $query_out2;
		$this->execute2		= $execute2;
		$this->results2		= $results2;
						
		$this->adm_id				= $adm_id;
		$this->adm_dept				= $adm_dept;
		$this->adm_permission		= $adm_permission;
		$this->logsheet_id			= $logsheet_id;
		$this->logsheet_destination = $logsheet_destination;
		$this->logsheet_origin		= $logsheet_origin;
		$this->logsheet_advance_cash= $logsheet_advance_cash;
		$this->logsheet_driver		= $logsheet_driver;
		$this->logsheet_attendant	= $logsheet_attendant;
		$this->logsheet_drv_change	= $logsheet_drv_change;
		
		$this->nrmal	= $nrmal;
		$this->extr1	= $extr1;
		$this->extr2	= $extr2;
		$this->extr3	= $extr3;
		$this->adv1		= $adv1;
		$this->adv2		= $adv2;
		$this->adv3		= $adv3;
		$this->ddct1	= $ddct1;
		$this->ddct2	= $ddct2;
		$this->ddct3	= $ddct3;
		
		$this->teid			= $teid;
		$this->update_me	= $update_me;

		$this->logsheet_newno	= "";
		$this->lorry_booked		= "";
		$this->delvry_date		= "";
		$this->te_new_id		= "";

		/********** Do date info **********/
		$this->full_date			= $php_time;
		$this->php_mth				= $php_mth;
		$this->php_yr				= $php_yr;
		$this->tomorrow_only		= $tomorrow_only;

		/********** log purpose start **********/
		$this->log_action 	= "Update Logsheet Local Advance & Driver";
		$this->log_desc 	= "";
		$this->log_result 	= "";
		$this->log_error 	= "";
		$this->log_ipadd 	= $useripadd;
		$this->updated_by	= $adm_id;
		/********** log purpose start **********/
		
		/********** DO NO info **********/
		$this->query_out = "select ls_id, ls_trip_no, ls_lorry_no, ls_delivery_date, ls_delivery_mth, ls_delivery_yr from ymt_logsheet where ls_id = '$this->logsheet_id' and ls_status = 1 and ls_local = 1";
		if($_SESSION['mychecking'] == 1){	echo "<p>1st lgsht dest->> $this->query_out</p>";		}
		
		$this->execute = $db1->query($this->query_out);
		
		/**********  getting the do no result **********/
		if ($db1->num_rows($this->execute) == 0){
			$this->view			= "invalid_logsheet";	
			$this->log_result 	= "Local Logsheet : ".$this->logsheet_id." invalid.";
			$this->log_error 	= "Error";
			$this->log_desc 	= $this->query_out;
		}else{

			$this->results		= $db1->fetch_assoc($this->execute);
			$this->lorry_booked = $this->results['ls_lorry_no'];
			$this->delvry_date	= $this->results['ls_delivery_date'];//added on 1202012
			
			//grab the trip no n assign here in since it is confirmed n if the trip no doesn't exist in the particular logsheet			
			$this->query_out2 = "update ymt_logsheet set ls_advance = '$this->logsheet_advance_cash', ls_driver = '$this->logsheet_driver', ls_attendant= '$this->logsheet_attendant', ls_approved_by = '$this->adm_id' ";
			$this->query_out2 .= " where ls_id = '$this->logsheet_id' and ls_branch = '$this->logsheet_origin' and ls_status = 1";
				
			
				
		}/********** if ($db1->num_rows($this->execute) == 0) else closing **********/

		if($_SESSION['mychecking'] == 1){	echo "<p>2nd lgsht dest->> $this->query_out2</p>";		}
		$this->execute2 = $db1->query($this->query_out2);

		if($this->execute2){	
		
			if($this->nrmal <> '' && $this->nrmal > 0 ){
			//echo "i'm here";
			//exit;
				/**** check if got insert or nt 1st, thn only insert (start) ****/
				$this->query_out_te_1st = "select te_trip_no, te_lgsht, te_lry_id from ymt_trip_expenses where te_lgsht = '$this->logsheet_id' and te_status= 1 ";
				//echo "<p>check TE 1st Q : $this->query_out_te_1st</p>";
				$this->execute_te_1st 	= $db1->query($this->query_out_te_1st);
				
				if($db1->num_rows($this->execute_te_1st) == 0){
				
					$this->query_out_te = "insert into ymt_trip_expenses set ";
					$this->query_out_te .= " te_trip_no = '".$this->results['ls_trip_no']."', te_lgsht = '$this->logsheet_id', ";
					$this->query_out_te .= " te_lry_id = '$this->lorry_booked', te_drv_id = '$this->logsheet_driver', ";
					$this->query_out_te .= " te_status= 1, ";
					$this->query_out_te .= " te_issued_by = '$this->adm_id', te_date = '$this->full_date', te_mth = '$this->php_mth', te_yr = '$this->php_yr' ";
					
					//echo "<p>update TE 2nd Q : $this->query_out_te</p>";
					$this->execute_te 	= $db1->query($this->query_out_te);
					$this->te_new_id 	= $db1->insert_id();
				
				}else{
					
					$this->results_te	= $db1->fetch_assoc($this->execute_te);
					
					if($this->results_te['te_trip_no'] == 0){
						$this->query_out_te = "update ymt_trip_expenses set ";
						$this->query_out_te .= " te_trip_no = '".$this->results['ls_trip_no']."' where  te_trip_no = '0' and te_status= 1 and te_id = ".$this->teid;
						
						//echo "<p>update TE 2nd Q : $this->query_out_te</p>";
						$this->execute_te 	= $db1->query($this->query_out_te);
					}
					
					$this->te_new_id 	= $this->teid;

				}
				
				
				
				$this->query_out_te_itm_1st = "select tei_id, tei_normal, tei_extra_1, tei_adv_1 from ymt_trip_expenses_items where tei_te_id = '$this->te_new_id'";
				//echo "<p>check TE Itm 1st Q : $this->query_out_te_itm_1st</p>";
				$this->execute_te_itm_1st 	= $db1->query($this->query_out_te_itm_1st);
				
				if($db1->num_rows($this->execute_te_itm_1st) == 0){
					$this->query_out_te_itm  = "insert into ymt_trip_expenses_items set tei_te_id = '$this->te_new_id', ";
				}else{
					$this->query_out_te_itm  = "update ymt_trip_expenses_items set ";
				}
				
				
				$this->te_extr_ttl 	= $this->nrmal + $this->extr1 + $this->extr2 + $this->extr3 + $this->extr4 + $this->extr5;
				$this->te_adv_ttl 	= $this->adv1 + $this->adv2 + $this->adv3 + $this->adv4 + $this->adv5;
				$this->te_ddct_ttl 	= $this->ddct1 + $this->ddct2 + $this->ddct3 + $this->ddct4 + $this->ddct5;
							
									
				$this->query_out_te_itm .= "tei_normal = '".$this->nrmal."', ";
				$this->query_out_te_itm .= "tei_normal_remarks = '', ";
				$this->query_out_te_itm .= "tei_extra_1 = '".$this->extr1."', ";
				$this->query_out_te_itm .= "tei_extra_1_remarks = '', ";
				$this->query_out_te_itm .= "tei_extra_2 = '".$this->extr2."', ";
				$this->query_out_te_itm .= "tei_extra_2_remarks = '', ";
				$this->query_out_te_itm .= "tei_extra_3 = '".$this->extr3."', ";
				$this->query_out_te_itm .= "tei_extra_3_remarks = '', ";
				// $this->query_out_te_itm .= "tei_extra_4 = '".$this->extr4."', ";
				// $this->query_out_te_itm .= "tei_extra_4_remarks = '', ";
				// $this->query_out_te_itm .= "tei_extra_5 = '".$this->extr5."', ";
				// $this->query_out_te_itm .= "tei_extra_5_remarks = '', ";
				
				$this->query_out_te_itm .= "tei_extra_total = '".$this->te_extr_ttl."', ";
					
				
				
				$this->query_out_te_itm .= "tei_adv_1 = '".$this->adv1."', ";
				$this->query_out_te_itm .= "tei_adv_1_remarks = '', ";
				$this->query_out_te_itm .= "tei_adv_2 = '".$this->adv2."', ";
				$this->query_out_te_itm .= "tei_adv_2_remarks = '', ";
				$this->query_out_te_itm .= "tei_adv_3 = '".$this->adv3."', ";
				$this->query_out_te_itm .= "tei_adv_3_remarks = '', ";
				// $this->query_out_te_itm .= "tei_adv_4 = '".$this->adv4."', ";
				// $this->query_out_te_itm .= "tei_adv_4_remarks = '', ";
				// $this->query_out_te_itm .= "tei_adv_5 = '".$this->adv5."', ";
				// $this->query_out_te_itm .= "tei_adv_5_remarks = '', ";
				$this->query_out_te_itm .= "tei_adv_total = '".$this->te_adv_ttl."', ";
				
				$this->query_out_te_itm .= "tei_deduct_1 = '".$this->ddct1."', ";
				$this->query_out_te_itm .= "tei_deduct_1_remarks = '', ";
				$this->query_out_te_itm .= "tei_deduct_2 = '".$this->ddct2."', ";
				$this->query_out_te_itm .= "tei_deduct_2_remarks = '', ";
				$this->query_out_te_itm .= "tei_deduct_3 = '".$this->ddct3."', ";
				$this->query_out_te_itm .= "tei_deduct_3_remarks = '', ";
				// $this->query_out_te_itm .= "tei_deduct_4 = '".$this->ddct4."', ";
				// $this->query_out_te_itm .= "tei_deduct_4_remarks = '', ";
				// $this->query_out_te_itm .= "tei_deduct_5 = '".$this->ddct5."', ";
				// $this->query_out_te_itm .= "tei_deduct_5_remarks = '', ";
				
				$this->query_out_te_itm .= "tei_adv_deduct_total = '".number_format(($this->te_adv_ttl - $this->te_ddct_ttl),2)."', ";
				$this->query_out_te_itm .= "tei_adv_deduct_bal = '".number_format(($this->te_extr_ttl + ($this->te_adv_ttl - $this->te_ddct_ttl)),2)."'";
				
				if($this->update_me == "yes"){			$this->query_out_te_itm  .= " where tei_te_id = '$this->teid' ";				}					
				
				//echo "<p>trip expenses -> $this->query_out_te_itm</p>";
				//exit;
				$this->execute_te_itm 	 = $db1->query($this->query_out_te_itm);

				
				/**** check if got insert or nt 1st, thn only insert (end) ****/
							
			}
			
			
			
			

			/********** update / change driver permenantly case 03062012 (start) **********/
			if($this->logsheet_drv_change == "yes"){
				
				
				/**** get prev lorry drove. reset to available thn update new lorry info 2drv n lorry. 03062012 (start) ****/
				$this->query_out_chng_lry_drv 	= "select driver_lorry_no from ymt_driver where driver_id = '$this->logsheet_driver' and driver_status = 1";
				if($_SESSION['mychecking'] == 1){	echo "<p>change driver Q ->> $this->query_out_chng_lry_drv</p>";		}
				$this->execute_chng_lry_drv 	= $db1->query($this->query_out_chng_lry_drv);
				
				if ($db1->num_rows($this->execute_chng_lry_drv) > 0){
					$this->results_chng_lry_drv	= $db1->fetch_assoc($this->execute_chng_lry_drv);
									
					
					/**** reset old lorry to available 03062012 (start) ****/
					$this->query_out_old_lry 	= "update ymt_lorry set lorry_drv = 0, lorry_last_updated = '".$this->full_date."' where lorry_id = '".$this->results_chng_lry_drv['driver_lorry_no']."' and lorry_status = 1";
					if($_SESSION['mychecking'] == 1){	echo "<p>change driver Q ->> $this->query_out_old_lry</p>";		}
					$this->execute_old_lry 		= $db1->query($this->query_out_old_lry);
					/**** reset old lorry to available 03062012 (end) ****/
					
					
					if($this->execute_old_lry){
					
					
						/**** update prev drv of new lorry 2empty lorry 03062012 (start) ****/
						$this->query_out_prev_drv_new_lry 	= "update ymt_driver set driver_lorry_no = 0, driver_last_updated_on = '".$this->full_date."' where driver_lorry_no = '".$this->lorry_booked."' ";
						if($_SESSION['mychecking'] == 1){	echo "<p>change driver Q ->> $this->query_out_prev_drv_new_lry</p>";		}
						$this->execute_prev_drv_new_lry 	= $db1->query($this->query_out_prev_drv_new_lry);
						/**** update prev drv of new lorry 2empty lorry 03062012 (end) ****/
						
						
						if($this->execute_prev_drv_new_lry){
							
							/**** update drv info of new lorry 03062012 (start) ****/
							$this->query_out_drv_new_lry 	= "update ymt_driver set driver_lorry_no = '".$this->lorry_booked."', driver_last_updated_on = '".$this->full_date."' where driver_id = '".$this->logsheet_driver."' ";
							if($_SESSION['mychecking'] == 1){	echo "<p>change driver Q ->> $this->query_out_drv_new_lry</p>";		}
							$this->execute_drv_new_lry 		= $db1->query($this->query_out_drv_new_lry);
							/**** update drv info of new lorry 03062012 (end) ****/
							
							
						}else{
							$this->view			= "invalid_old_drv";	
							$this->log_result 	.= "Update Prev DRV of LRY - Lgsht ID : ".$this->lorry_booked." invalid.";
							$this->log_error 	= "Error";
							$this->log_desc 	= $this->query_out_prev_drv_new_lry;
						}
						
						
						
					}else{
						$this->view			= "invalid_lorry";	
						$this->log_result 	.= "Update Lorry - Lgsht ID : ".$this->results_chng_lry_drv['driver_lorry_no']." invalid.";
						$this->log_error 	= "Error";
						$this->log_desc 	= $this->query_out_old_lry;
					}
					
					
					
				}else{
					$this->view			= "invalid_drv";	
					$this->log_result 	.= "Change Drv - Lgsht ID : ".$this->logsheet_driver." invalid.";
					$this->log_error 	= "Error";
					$this->log_desc 	= $this->query_out_chng_lry_drv;
				}
				
				
				/**** get prev lorry drove. reset to available thn update new lorry info 2drv n lorry. 03062012 (end) ****/
				
			}
			/********** update / change driver permenantly case 03062012 (end) **********/

			
			$this->query_out3	= "update ymt_lorry set lorry_available = 0 where lorry_id = '$this->lorry_booked'";
			//echo "3->> $this->query_out3";
			$this->execute3		= $db1->query($this->query_out3);			
			$this->view			= "success";
			
			$this->tripno = $this->results['ls_trip_no'];
			
			$this->log_result 	= "Successfully changed logsheet : ".$this->logsheet_id. " | Trip no : ".$this->tripno. " | Lorry ID : ".$this->lorry_booked;
			$this->log_desc 	= $this->query_out2;

		}

		$this->log_result = $this->ymtt_log($this->log_action, str_replace("'","",$this->log_desc), $this->log_result, $this->log_error, $this->updated_by, $this->log_ipadd, $this->full_date);

		return $this->view;
	}
	
	
	/*
	|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
	| LOCAL TRIP PRIVATE FUNCTIONS ADDED ON 30092012 (START)						   																																			   |
	|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
	*/
	
	
	
	/*
	|--------------------------------------------------------------------------|
	| INTERNAL FNCT OF LISTING PRDCT LOG ONLY 								   |
	|--------------------------------------------------------------------------|
	*/
	public function ymtt_log($adm_action, $adm_desc, $adm_result, $adm_error, $adm_uid, $adm_ip, $adm_date){
		global $db1,$useripadd,$php_time;
		
		$this->query_out_log= $query_out_log;
		$this->execute_log 	= $execute_log;
				
		$this->adm_action 	= $adm_action;
		$this->adm_desc 	= $adm_desc;
		$this->adm_result 	= $adm_result;
		$this->adm_error 	= $adm_error;
		$this->adm_uid 		= $adm_uid;
		$this->adm_ip 		= $adm_ip;
		$this->adm_date 	= $adm_date;
				
		$this->query_out_log = "INSERT INTO ymt_logs set log_action = '".$this->adm_action."', log_desc = '".$this->adm_desc."', log_result = '".$this->adm_result."', log_error = '".$this->adm_error."', log_userid = '".$this->adm_uid."', log_ipadd = '".$this->adm_ip."', log_date = '".$this->adm_date."'";
		//echo "<p>log-> $this->query_out_log</p>";
		$this->execute_log 	 = $db1->query($this->query_out_log);
			
		return "log_recorded";
	
	}

}
?>