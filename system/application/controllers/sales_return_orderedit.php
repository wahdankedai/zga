<?php

class sales_return_orderedit extends Controller {

	function sales_return_orderedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_return_order_id=0)
	{
		if ($sales_return_order_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $sales_return_order_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('salesreturnorder');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_return_order_id'] = $sales_return_order_id;
foreach ($q->result() as $r) {
$data['salesreturnorder__date'] = $r->date;
$data['salesreturnorder__salesreturnorderid'] = $r->salesreturnorderid;
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesreturnorder__customer_id'] = $r->customer_id;
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['salesreturnorder__currency_id'] = $r->currency_id;
$data['salesreturnorder__currencyrate'] = $r->currencyrate;
$data['salesreturnorder__notes'] = $r->notes;
$data['salesreturnorder__lastupdate'] = $r->lastupdate;
$data['salesreturnorder__updatedby'] = $r->updatedby;
$data['salesreturnorder__created'] = $r->created;
$data['salesreturnorder__createdby'] = $r->createdby;}
$this->load->view('sales_return_order_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['salesreturnorder__date']) && ($_POST['salesreturnorder__date'] == "" || $_POST['salesreturnorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['salesreturnorder__salesreturnorderid']) && ($_POST['salesreturnorder__salesreturnorderid'] == "" || $_POST['salesreturnorder__salesreturnorderid'] == null))
$error .= "<span class='error'>Return ID must not be empty"."</span><br>";

if (isset($_POST['salesreturnorder__salesreturnorderid'])) {$this->db->where("id !=", $_POST['sales_return_order_id']);
$this->db->where('salesreturnorderid', $_POST['salesreturnorder__salesreturnorderid']);
$q = $this->db->get('salesreturnorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Return ID must be unique"."</span><br>";}

if (!isset($_POST['salesreturnorder__customer_id']) || ($_POST['salesreturnorder__customer_id'] == "" || $_POST['salesreturnorder__customer_id'] == null  || $_POST['salesreturnorder__customer_id'] == 0))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['salesreturnorder__currency_id']) || ($_POST['salesreturnorder__currency_id'] == "" || $_POST['salesreturnorder__currency_id'] == null  || $_POST['salesreturnorder__currency_id'] == 0))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesreturnorder__date']))
$this->db->set('date', "str_to_date('".$_POST['salesreturnorder__date']."', '%d-%m-%Y')", false);if (isset($_POST['salesreturnorder__salesreturnorderid']))
$data['salesreturnorderid'] = $_POST['salesreturnorder__salesreturnorderid'];if (isset($_POST['salesreturnorder__customer_id']))
$data['customer_id'] = $_POST['salesreturnorder__customer_id'];if (isset($_POST['salesreturnorder__currency_id']))
$data['currency_id'] = $_POST['salesreturnorder__currency_id'];if (isset($_POST['salesreturnorder__currencyrate']))
$data['currencyrate'] = $_POST['salesreturnorder__currencyrate'];if (isset($_POST['salesreturnorder__notes']))
$data['notes'] = $_POST['salesreturnorder__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['sales_return_order_id']);
$this->db->update('salesreturnorder', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_orderedit','salesreturnorder','afteredit', $_POST['sales_return_order_id']);
			
			
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully updated.";
			}
			else
			{
				echo "<span style='background-color:red'>   </span> ".$error;
			}
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>