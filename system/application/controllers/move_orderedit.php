<?php

class move_orderedit extends Controller {

	function move_orderedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($move_order_id=0)
	{
		if ($move_order_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $move_order_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('moveorder');
if ($q->num_rows() > 0) {
$data = array();
$data['move_order_id'] = $move_order_id;
foreach ($q->result() as $r) {
$data['moveorder__orderid'] = $r->orderid;
$data['moveorder__date'] = $r->date;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['moveorder__from_warehouse_id'] = $r->from_warehouse_id;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['moveorder__to_warehouse_id'] = $r->to_warehouse_id;
$data['moveorder__notes'] = $r->notes;
$data['moveorder__lastupdate'] = $r->lastupdate;
$data['moveorder__updatedby'] = $r->updatedby;
$data['moveorder__created'] = $r->created;
$data['moveorder__createdby'] = $r->createdby;}
$this->load->view('move_order_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['moveorder__orderid']) && ($_POST['moveorder__orderid'] == "" || $_POST['moveorder__orderid'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['moveorder__orderid'])) {$this->db->where("id !=", $_POST['move_order_id']);
$this->db->where('orderid', $_POST['moveorder__orderid']);
$q = $this->db->get('moveorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['moveorder__date']) && ($_POST['moveorder__date'] == "" || $_POST['moveorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['moveorder__from_warehouse_id']) || ($_POST['moveorder__from_warehouse_id'] == "" || $_POST['moveorder__from_warehouse_id'] == null  || $_POST['moveorder__from_warehouse_id'] == 0))
$error .= "<span class='error'>From Location must not be empty"."</span><br>";

if (!isset($_POST['moveorder__to_warehouse_id']) || ($_POST['moveorder__to_warehouse_id'] == "" || $_POST['moveorder__to_warehouse_id'] == null  || $_POST['moveorder__to_warehouse_id'] == 0))
$error .= "<span class='error'>To Location must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['moveorder__orderid']))
$data['orderid'] = $_POST['moveorder__orderid'];if (isset($_POST['moveorder__date']))
$this->db->set('date', "str_to_date('".$_POST['moveorder__date']."', '%d-%m-%Y')", false);if (isset($_POST['moveorder__from_warehouse_id']))
$data['from_warehouse_id'] = $_POST['moveorder__from_warehouse_id'];if (isset($_POST['moveorder__to_warehouse_id']))
$data['to_warehouse_id'] = $_POST['moveorder__to_warehouse_id'];if (isset($_POST['moveorder__notes']))
$data['notes'] = $_POST['moveorder__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['move_order_id']);
$this->db->update('moveorder', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('move_orderedit','moveorder','afteredit', $_POST['move_order_id']);
			
			
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