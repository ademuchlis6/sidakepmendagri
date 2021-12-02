<?php defined('BASEPATH') or exit('No direct script access allowed');

class Lembaga extends CI_Controller
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
        $this->load->model('lembaga/modelLembaga','lembaga');
    }

    function index()
    {
        $this->load->view('lembaga/viewLembaga');
    }

    public function lembagaRead()
    {

        $this->load->helper('url');

        $list = $this->lembaga->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $lembaga) {
        $no++;
        $row = array();
        $row[] = $no;
        $row[] = $lembaga->nama_lembaga;
        $row[] = $lembaga->nama_kepala;
        if($lembaga->status_lembaga=='1'){
            $row[]='Aktif';
        }else{
            $row[]='Non Aktif';
        }
        if($this->ion_auth->user()->row()->lembaga==0){
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit"
            onclick="lembagaEdit('."'".$lembaga->id_lembaga."'".')"><i class="fa fa-pencil"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus"
            onclick="lembagaDelete('."'".$lembaga->id_lembaga."'".')"><i class="fa fa-trash"></i> Delete</a>';
        }else{
            $row[] ='';
        }
        
        
        $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->lembaga->count_all(),
            "recordsFiltered" => $this->lembaga->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }

    public function lembagaEdit($id)
    {
        $data = $this->lembaga->get_by_id($id);
        echo json_encode($data);
    }

    public function lembagaAdd()
    {
        $this->_validate();
        $data = array(
            'nama_lembaga' => $this->input->post('namaLembaga'),
            'nama_kepala' => $this->input->post('namaKepalaLembaga'),
            'status_lembaga' => $this->input->post('statusLembaga'),
         );
        $insert = $this->lembaga->save($data);

        echo json_encode(array("status" => TRUE));
    }

    public function lembagaUpdate()
    {
        $this->_validate();
        $data = array(
            'nama_lembaga' => $this->input->post('namaLembaga'),
            'nama_kepala' => $this->input->post('namaKepalaLembaga'),
            'status_lembaga' => $this->input->post('statusLembaga'),
        );

        $this->lembaga->update(array('id_lembaga' => $this->input->post('idLembaga')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function lembagaDelete($id)
    {
        $this->lembaga->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('namaLembaga') == '')
        {
            $data['inputerror'][] = 'namaLembaga';
            $data['error_string'][] = 'Nama Lembaga harus diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('namaKepalaLembaga') == '')
        {
            $data['inputerror'][] = 'namaKepalaLembaga';
            $data['error_string'][] = 'Nama Kepala harus diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('statusLembaga') == '')
        {
            $data['inputerror'][] = 'statusLembaga';
            $data['error_string'][] = 'Status Lembaga harus diisi';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    
}