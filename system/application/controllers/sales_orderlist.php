<?php

class sales_orderlist extends Controller {

	function sales_orderlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('salesorder');
$this->db->join('marketingofficer', 'marketingofficer.id = salesorder.marketingofficer_id', 'left');
$this->db->join('customer', 'customer.id = salesorder.customer_id', 'left');
$this->db->join('currency', 'currency.id = salesorder.currency_id', 'left');
$this->db->where('salesorder.disabled = 0');
$this->db->where('salesorder.status = "Approved"');
$this->db->select('marketingofficer.name as marketingofficer__name', false);
$this->db->select('salesorder.marketingofficer_id as salesorder__marketingofficer_id', false);
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('salesorder.customer_id as salesorder__customer_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('salesorder.currency_id as salesorder__currency_id', false);
$this->db->select('salesorder.id as id', false);
$this->db->select('salesorder.orderid as salesorder__orderid', false);
$this->db->select('DATE_FORMAT(salesorder.date, "%d-%m-%Y") as salesorder__date', false);
$this->db->select('salesorder.nopenawaran as salesorder__nopenawaran', false);
$this->db->select('salesorder.customerponumber as salesorder__customerponumber', false);
$this->db->select('salesorder.notes as salesorder__notes', false);
$this->db->select('salesorder.currencyrate as salesorder__currencyrate', false);
$this->db->select('salesorder.status as salesorder__status', false);
$this->db->select('salesorder.modulename as salesorder__modulename', false);
$this->db->select('salesorder.total as salesorder__total', false);
$this->db->select('salesorder.totaldiscount as salesorder__totaldiscount', false);
$this->db->select('salesorder.totaltax as salesorder__totaltax', false);
$this->db->select('salesorder.lastupdate as salesorder__lastupdate', false);
$this->db->select('salesorder.updatedby as salesorder__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesorder.orderid like '%".$_POST['searchtext']."%'";$where .= " || salesorder.date like '%".$_POST['searchtext']."%'";$where .= " || salesorder.nopenawaran like '%".$_POST['searchtext']."%'";$where .= " || salesorder.customerponumber like '%".$_POST['searchtext']."%'";$where .= " || marketingofficer.name like '%".$_POST['searchtext']."%'";$where .= " || salesorder.notes like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || salesorder.currencyrate like '%".$_POST['searchtext']."%'";$where .= " || salesorder.total like '%".$_POST['searchtext']."%'";$where .= " || salesorder.totaldiscount like '%".$_POST['searchtext']."%'";$where .= " || salesorder.totaltax like '%".$_POST['searchtext']."%'";$where .= " || salesorder.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesorder.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesorder__orderid', 'asc');
$this->db->order_by('salesorder__date', 'desc');
$this->db->order_by('salesorder__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($edit_module_id=0)
	{
		$data = array();
		
		
		
		$data['pageno'] = 0;
		if (isset($_POST['pageno'])) 
		{
			$data['pageno'] = $_POST['pageno'];
		}
		//echo $data['pageno'];
		$data['perpage'] = 20;
		
		$data['sortby'] = array();$data['sortdirection'] = array();
		if (isset($_POST['sortby'])) $data['sortby'] = $_POST['sortby'];
		if (isset($_POST['sortdirection'])) $data['sortdirection'] = $_POST['sortdirection'];
		
		$data['fields'] = array('salesorder__orderid' => 'SO ID', 'salesorder__date' => 'Date', 'salesorder__nopenawaran' => 'No Penawaran', 'salesorder__customerponumber' => 'No PO', 'marketingofficer__name' => 'Marketing Officer', 'salesorder__notes' => 'Description', 'customer__firstname' => 'Customer', 'currency__name' => 'Currency', 'salesorder__currencyrate' => 'Currency Rate', 'salesorder__total' => 'Gross Amount', 'salesorder__totaldiscount' => 'Total Discount', 'salesorder__totaltax' => 'Total Tax', 'salesorder__lastupdate' => 'Last Update', 'salesorder__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('sales_order_list_view', $data);
	}
}

?>