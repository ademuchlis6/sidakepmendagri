<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sub extends CI_Controller
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
        $this->load->model('sub/modelSub','sub');
    }

    function index()
    {
        $this->load->view('sub/viewSub');
    }

    public function subRead()
    {

        $this->load->helper('url');

        $list = $this->sub->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $sub) {
        $no++;
        $row = array();
        $row[] = $no;
        $row[] = $sub->keterangan;
        $row[] = $sub->nama_kepala;
        if($sub->status=='1'){
            $row[]='Aktif';
        }else{
            $row[]='Non Aktif';
        }
        if($this->ion_auth->user()->row()->lembaga==0){
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit"
            onclick="subEdit('."'".$sub->id_sub."'".')"><i class="fa fa-pencil"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus"
            onclick="subDelete('."'".$sub->id_sub."'".')"><i class="fa fa-trash"></i> Delete</a>';
        }else{
            $row[] ='';
        }
        
        
        $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->sub->count_all(),
            "recordsFiltered" => $this->sub->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }

    public function subEdit($id)
    {
        $data = $this->sub->get_by_id($id);
        echo json_encode($data);
    }

    public function subAdd()
    {
        $this->_validate();
        $data = array(
            'keterangan' => $this->input->post('namaSub'),
            'nama_kepala' => $this->input->post('namaKepalaSub'),
            'status' => $this->input->post('statusSub'),
         );
        $insert = $this->sub->save($data);

        echo json_encode(array("status" => TRUE));
    }

    public function subUpdate()
    {
        $this->_validate();
        $data = array(
            'keterangan' => $this->input->post('namaSub'),
            'nama_kepala' => $this->input->post('namaKepalaSub'),
            'status' => $this->input->post('statusSub'),
        );

        $this->sub->update(array('id_sub' => $this->input->post('idSub')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function subDelete($id)
    {
        $this->sub->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('namaSub') == '')
        {
            $data['inputerror'][] = 'namaSub';
            $data['error_string'][] = 'Nama sub harus diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('namaKepalaSub') == '')
        {
            $data['inputerror'][] = 'namaKepalaSub';
            $data['error_string'][] = 'Nama Kepala harus diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('statusSub') == '')
        {
            $data['inputerror'][] = 'statusSub';
            $data['error_string'][] = 'Status sub harus diisi';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    
}