<?php

class open_purchase_return_invoice_for_paymentview extends Controller {

	function open_purchase_return_invoice_for_paymentview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_purchase_return_invoice_for_payment_id=0)
	{
		if ($open_purchase_return_invoice_for_payment_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $open_purchase_return_invoice_for_payment_id);
$this->db->select('*');
$q = $this->db->get('purchasereturninvoice');
if ($q->num_rows() > 0) {
$data = array();
$data['open_purchase_return_invoice_for_payment_id'] = $open_purchase_return_invoice_for_payment_id;
foreach ($q->result() as $r) {
$data['purchasereturninvoice__lastupdate'] = $r->lastupdate;
$data['purchasereturninvoice__updatedby'] = $r->updatedby;
$data['purchasereturninvoice__created'] = $r->created;
$data['purchasereturninvoice__createdby'] = $r->createdby;}
$this->load->view('open_purchase_return_invoice_for_payment_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['purchasereturninvoice__lastupdate'];
$data['updatedby'] = $_POST['purchasereturninvoice__updatedby'];
$data['created'] = $_POST['purchasereturninvoice__created'];
$data['createdby'] = $_POST['purchasereturninvoice__createdby'];
$this->db->where('id', $data['open_purchase_return_invoice_for_payment_id']);
$this->db->update('purchasereturninvoice', $data);
			validationonserver();
			
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