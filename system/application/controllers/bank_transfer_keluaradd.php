<?php

class bank_transfer_keluaradd extends Controller {

	function bank_transfer_keluaradd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['banktransferkeluar__idstring'] = '';$this->load->library('generallib');
$data['banktransferkeluar__idstring'] = $this->generallib->genId('Bank Transfer Keluar');
$data['banktransferkeluar__date'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['banktransferkeluar__currency_id'] = '';
$data['banktransferkeluar__amount'] = '';
$data['banktransferkeluar__notes'] = '';
$data['banktransferkeluar__transferedflag'] = '';
$data['banktransferkeluar__lastupdate'] = '';
$data['banktransferkeluar__updatedby'] = '';
$data['banktransferkeluar__created'] = '';
$data['banktransferkeluar__createdby'] = '';
		

		$this->load->view('bank_transfer_keluar_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['banktransferkeluar__idstring']) && ($_POST['banktransferkeluar__idstring'] == "" || $_POST['banktransferkeluar__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['banktransferkeluar__idstring'])) {
$this->db->where('idstring', $_POST['banktransferkeluar__idstring']);
$q = $this->db->get('banktransferkeluar');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['banktransferkeluar__date']) && ($_POST['banktransferkeluar__date'] == "" || $_POST['banktransferkeluar__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['banktransferkeluar__currency_id']) || ($_POST['banktransferkeluar__currency_id'] == "" || $_POST['banktransferkeluar__currency_id'] == null  || $_POST['banktransferkeluar__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['banktransferkeluar__idstring']))
$data['idstring'] = $_POST['banktransferkeluar__idstring'];if (isset($_POST['banktransferkeluar__date']))
$this->db->set('date', "str_to_date('".$_POST['banktransferkeluar__date']."', '%d-%m-%Y')", false);if (isset($_POST['banktransferkeluar__currency_id']))
$data['currency_id'] = $_POST['banktransferkeluar__currency_id'];if (isset($_POST['banktransferkeluar__amount']))
$data['amount'] = $_POST['banktransferkeluar__amount'];if (isset($_POST['banktransferkeluar__notes']))
$data['notes'] = $_POST['banktransferkeluar__notes'];if (isset($_POST['banktransferkeluar__transferedflag']))
$data['transferedflag'] = $_POST['banktransferkeluar__transferedflag'];
else $data['transferedflag'] = false;
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('banktransferkeluar', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$banktransferkeluar_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('bank_transfer_keluaradd','banktransferkeluar','aftersave', $banktransferkeluar_id);
			
		
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
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