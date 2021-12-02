<?php defined('BASEPATH') or exit('No direct script access allowed');

class Seksi extends CI_Controller
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
        $this->load->model('seksi/modelSeksi','seksi');
    }

    function index()
    {
        $this->load->view('seksi/viewSeksi');
    }

    public function seksiRead()
    {

        $this->load->helper('url');

        $list = $this->seksi->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $seksi) {
        $no++;
        $row = array();
        $row[] = $no;
        $row[] = $seksi->keterangan;
        $row[] = $seksi->nama_kepala;
        if($seksi->status=='1'){
            $row[]='Aktif';
        }else{
            $row[]='Non Aktif';
        }
        if($this->ion_auth->user()->row()->lembaga==0){
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit"
            onclick="seksiEdit('."'".$seksi->id_seksi."'".')"><i class="fa fa-pencil"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus"
            onclick="seksiDelete('."'".$seksi->id_seksi."'".')"><i class="fa fa-trash"></i> Delete</a>';
        }else{
            $row[] ='';
        }
        
        
        $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->seksi->count_all(),
            "recordsFiltered" => $this->seksi->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }

    public function seksiEdit($id)
    {
        $data = $this->seksi->get_by_id($id);
        echo json_encode($data);
    }

    public function seksiAdd()
    {
        $this->_validate();
        $data = array(
            'keterangan' => $this->input->post('namaSeksi'),
            'nama_kepala' => $this->input->post('namaKepalaSeksi'),
            'status' => $this->input->post('statusSeksi'),
         );
        $insert = $this->seksi->save($data);

        echo json_encode(array("status" => TRUE));
    }

    public function seksiUpdate()
    {
        $this->_validate();
        $data = array(
            'keterangan' => $this->input->post('namaSeksi'),
            'nama_kepala' => $this->input->post('namaKepalaSeksi'),
            'status' => $this->input->post('statusSeksi'),
        );

        $this->seksi->update(array('id_seksi' => $this->input->post('idSeksi')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function seksiDelete($id)
    {
        $this->seksi->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('namaSeksi') == '')
        {
            $data['inputerror'][] = 'namaSeksi';
            $data['error_string'][] = 'Nama seksi harus diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('namaKepalaSeksi') == '')
        {
            $data['inputerror'][] = 'namaKepalaSeksi';
            $data['error_string'][] = 'Nama Kepala harus diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('statusSeksi') == '')
        {
            $data['inputerror'][] = 'statusSeksi';
            $data['error_string'][] = 'Status seksi harus diisi';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    
}