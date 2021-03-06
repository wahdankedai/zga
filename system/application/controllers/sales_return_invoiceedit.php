<?php

class sales_return_invoiceedit extends Controller {

	function sales_return_invoiceedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_return_invoice_id=0)
	{
		if ($sales_return_invoice_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $sales_return_invoice_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('salesreturninvoice');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_return_invoice_id'] = $sales_return_invoice_id;
foreach ($q->result() as $r) {
$data['salesreturninvoice__date'] = $r->date;
$data['salesreturninvoice__salesreturninvoiceid'] = $r->salesreturninvoiceid;
$salesreturndelivery_opt = array();
$salesreturndelivery_opt[''] = 'None';
$q = $this->db->get('salesreturndelivery');
foreach ($q->result() as $row) { $salesreturndelivery_opt[$row->id] = $row->salesreturndeliveryid; }
$data['salesreturndelivery_opt'] = $salesreturndelivery_opt;
$data['salesreturninvoice__salesreturndelivery_id'] = $r->salesreturndelivery_id;
$data['salesreturninvoice__customer_id'] = $r->customer_id;
$data['salesreturninvoice__currency_id'] = $r->currency_id;
$data['salesreturninvoice__currencyrate'] = $r->currencyrate;
$data['salesreturninvoice__total'] = $r->total;
$data['salesreturninvoice__lastupdate'] = $r->lastupdate;
$data['salesreturninvoice__updatedby'] = $r->updatedby;
$data['salesreturninvoice__created'] = $r->created;
$data['salesreturninvoice__createdby'] = $r->createdby;}
$this->load->view('sales_return_invoice_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['salesreturninvoice__date']) && ($_POST['salesreturninvoice__date'] == "" || $_POST['salesreturninvoice__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['salesreturninvoice__salesreturninvoiceid']) && ($_POST['salesreturninvoice__salesreturninvoiceid'] == "" || $_POST['salesreturninvoice__salesreturninvoiceid'] == null))
$error .= "<span class='error'>Invoice No must not be empty"."</span><br>";

if (isset($_POST['salesreturninvoice__salesreturninvoiceid'])) {$this->db->where("id !=", $_POST['sales_return_invoice_id']);
$this->db->where('salesreturninvoiceid', $_POST['salesreturninvoice__salesreturninvoiceid']);
$q = $this->db->get('salesreturninvoice');
if ($q->num_rows() > 0) $error .= "<span class='error'>Invoice No must be unique"."</span><br>";}

if (!isset($_POST['salesreturninvoice__salesreturndelivery_id']) || ($_POST['salesreturninvoice__salesreturndelivery_id'] == "" || $_POST['salesreturninvoice__salesreturndelivery_id'] == null  || $_POST['salesreturninvoice__salesreturndelivery_id'] == 0))
$error .= "<span class='error'>Sales Return Delivery must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesreturninvoice__date']))
$this->db->set('date', "str_to_date('".$_POST['salesreturninvoice__date']."', '%d-%m-%Y')", false);if (isset($_POST['salesreturninvoice__salesreturninvoiceid']))
$data['salesreturninvoiceid'] = $_POST['salesreturninvoice__salesreturninvoiceid'];if (isset($_POST['salesreturninvoice__salesreturndelivery_id']))
$data['salesreturndelivery_id'] = $_POST['salesreturninvoice__salesreturndelivery_id'];if (isset($_POST['salesreturninvoice__customer_id']))
$data['customer_id'] = $_POST['salesreturninvoice__customer_id'];if (isset($_POST['salesreturninvoice__currency_id']))
$data['currency_id'] = $_POST['salesreturninvoice__currency_id'];if (isset($_POST['salesreturninvoice__currencyrate']))
$data['currencyrate'] = $_POST['salesreturninvoice__currencyrate'];if (isset($_POST['salesreturninvoice__total']))
$data['total'] = $_POST['salesreturninvoice__total'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['sales_return_invoice_id']);
$this->db->update('salesreturninvoice', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_invoiceedit','salesreturninvoice','afteredit', $_POST['sales_return_invoice_id']);
			
			
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