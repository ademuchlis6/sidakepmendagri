<?php

/**
 * Author Imam Teguh
 */
class Profile extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->lang->load('auth');
        $this->load->helper('language');
        if (!$this->ion_auth->logged_in()) {
           echo "<script>window.location.href='".base_url()."'</script>";
           die;
        }
	}


	function index()
	{
		$this->load->view('profile/settingProfile');
	}

	
	function profileInfo()
	{
		$this->load->view('profile/profileinfo');
	}
	public function changepass()
	{
		$user_id = $this->ion_auth->user()->row()->id;
		$passbaru1 = $this->input->post('passbaru1');
		$passbaru2 = $this->input->post('passbaru2');
		if ($passbaru1 == $passbaru2) {
			$data['password'] = $passbaru1;
			$this->ion_auth->update($user_id, $data);
			$stat = array('status' => 'ok');
			echo json_encode($stat);
		}
	}
	
	function grafik1(){
        $this->db = $this->load->database('default', true);	
		$sql = "
		select 
		sum(case when tingkat=1 then 1 else 0 end) cluster1
		,sum(case when tingkat=2 then 1 else 0 end) cluster2
		,sum(case when tingkat=3 then 1 else 0 end) cluster3
		,sum(case when tingkat=4 then 1 else 0 end) cluster4
		from users
		";
	
		$dta = array();
		$dtas = $this->db->query($sql)->result_array();
		
		$a1['name'] = "Direktorat (eselon 2)";
		$a2['name'] = "Sub Direktorat/Bagian (eselon 3)";
		$a3['name'] = "Seksi/Sub Bagian (Eselon 4)";
		$a4['name'] = "Staf";

		
		foreach ($dtas as $rows) {

		$a1['data'][] = array("name"=>'',"y"=>$rows['cluster1']);
		$a2['data'][] = array("name"=>'',"y"=>$rows['cluster2']);
		$a3['data'][] = array("name"=>'',"y"=>$rows['cluster3']);
		$a4['data'][] = array("name"=>'',"y"=>$rows['cluster4']);
	
		}
	
		$respon = array();
		array_push($respon, $a1);
		array_push($respon, $a2);
		array_push($respon, $a3);
		array_push($respon, $a4);

		
		echo json_encode($respon, JSON_NUMERIC_CHECK);
		}
}