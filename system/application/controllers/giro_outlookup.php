<?php

class giro_outlookup extends Controller {

	function giro_outlookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('giroout');
$this->db->join('supplier', 'supplier.id = giroout.supplier_id', 'left');
$this->db->join('currency', 'currency.id = giroout.currency_id', 'left');
$this->db->join('coa', 'coa.id = giroout.coa_id', 'left');
$this->db->where('giroout.disabled = 0');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('giroout.supplier_id as giroout__supplier_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('giroout.currency_id as giroout__currency_id', false);
$this->db->select('coa.name as coa__name', false);
$this->db->select('giroout.coa_id as giroout__coa_id', false);
$this->db->select('giroout.id as id', false);
$this->db->select('giroout.girooutid as giroout__girooutid', false);
$this->db->select('DATE_FORMAT(giroout.createdate, "%d-%m-%Y") as giroout__createdate', false);
$this->db->select('giroout.amount as giroout__amount', false);
$this->db->select('giroout.amountused as giroout__amountused', false);
$this->db->select('giroout.notes as giroout__notes', false);
$this->db->select('giroout.usedflag as giroout__usedflag', false);
$this->db->select('giroout.lastupdate as giroout__lastupdate', false);
$this->db->select('giroout.updatedby as giroout__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "giroout.girooutid like '%".$_POST['searchtext']."%'";$where .= " || giroout.createdate like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || giroout.amount like '%".$_POST['searchtext']."%'";$where .= " || giroout.amountused like '%".$_POST['searchtext']."%'";$where .= " || coa.name like '%".$_POST['searchtext']."%'";$where .= " || giroout.notes like '%".$_POST['searchtext']."%'";$where .= " || giroout.usedflag like '%".$_POST['searchtext']."%'";$where .= " || giroout.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || giroout.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('giroout__girooutid', 'asc');
$this->db->order_by('giroout__lastupdate', 'desc');
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
		$data['perpage'] = 10000;
		
		$data['sortby'] = array();$data['sortdirection'] = array();
		if (isset($_POST['sortby'])) $data['sortby'] = $_POST['sortby'];
		if (isset($_POST['sortdirection'])) $data['sortdirection'] = $_POST['sortdirection'];
		
		$data['fields'] = array('giroout__girooutid' => 'Giro ID', 'giroout__createdate' => 'Creation Date', 'supplier__firstname' => 'Supplier', 'currency__name' => 'Currency', 'giroout__amount' => 'Amount', 'giroout__amountused' => 'Amount Used', 'coa__name' => 'Account', 'giroout__notes' => 'Notes', 'giroout__usedflag' => 'Used', 'giroout__lastupdate' => 'Last Update', 'giroout__updatedby' => 'Last Update By');
		
		if (count($_POST) == 0)
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
		$this->load->view('giro_out_lookup_view', $data);
	}
}

?>