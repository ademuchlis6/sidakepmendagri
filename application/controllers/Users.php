<?php defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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
        $this->load->model('users/modelUsers','users');
    }

    function index()
    {
        $this->db = $this->load->database('default', true);
        $queryGetLembaga = "select id_lembaga,nama_lembaga from lembaga where status_lembaga = '1' order by id_lembaga asc";
        $arrLembaga = $this->db->query($queryGetLembaga)->result_array();

        if($this->ion_auth->user()->row()->tingkat=='4'){
            $queryGetTingkat = "select id_tingkat,keterangan from tingkat where status = '1' order by id_tingkat asc";
            $arrTingkat = $this->db->query($queryGetTingkat)->result_array();    
        }else{
            $queryGetTingkat = "select id_tingkat,keterangan from tingkat where status = '1' order by id_tingkat asc";
            $arrTingkat = $this->db->query($queryGetTingkat)->result_array();    
        }

        $queryGetSeksi = "select id_seksi,keterangan from seksi where status = '1' order by id_seksi asc";
        $arrSeksi = $this->db->query($queryGetSeksi)->result_array();

        $querySub = "select id_sub,keterangan from subdirektorat where status = '1' order by id_sub asc";
        $arrSub = $this->db->query($querySub)->result_array();

        $lembagaUserId = $this->ion_auth->user()->row()->lembaga;
        
        if($lembagaUserId){
            $qLembagaUserNama = "select nama_lembaga from lembaga where id_lembaga = $lembagaUserId";
            $getLembagaUserNama = $this->db->query($qLembagaUserNama)->row();
            $lembagaUserNama = $getLembagaUserNama->nama_lembaga;
        }
        $tingkatUserId = $this->ion_auth->user()->row()->tingkat;
        if($tingkatUserId){        
            $qTingkatUserNama = "select keterangan from tingkat where id_tingkat = $tingkatUserId";
            $getTingkatUserNama = $this->db->query($qTingkatUserNama)->row();
            $tingkatUserNama = $getTingkatUserNama->keterangan;
        }
        $subUserId = $this->ion_auth->user()->row()->subdirektorat;
        if($subUserId){        
            $qSubUserNama = "select keterangan from subdirektorat where id_sub = $subUserId";
            $getSubUserNama = $this->db->query($qSubUserNama)->row();
            $subUserNama = $getSubUserNama->keterangan;
        }      
        $seksiUserId = $this->ion_auth->user()->row()->seksi;
        if($seksiUserId){
            $qSeksiUserNama = "select keterangan from seksi where id_seksi = $seksiUserId";
            $getSeksiUserNama = $this->db->query($qSeksiUserNama)->row();
            $seksiUserNama = $getSeksiUserNama->keterangan;
        }

        $data = array(
            'lembagas'=>$arrLembaga,
            'tingkats'=>$arrTingkat,
            'subDirektorat'=>$arrSub,
            'seksi'=>$arrSeksi,
            'lembagaUser'=>$lembagaUserId,
            'lembagaUserNama'=>$lembagaUserNama,
            'tingkatUser'=>$tingkatUserId,
            'tingkatUserNama'=>$tingkatUserNama,
            'subUser'=>$subUserId,
            'subUserNama'=>$subUserNama,
            'seksiUser'=>$seksiUserId,
            'seksiUserNama'=>$seksiUserNama,
        );
        if($this->ion_auth->user()->row()->lembaga==0){
            $this->load->view('users/viewUsers',$data);
        }else{
            $this->load->view('users/viewUsersOpr',$data);
        }
    }

    public function usersRead()
    {
        $this->db = $this->load->database('default', true);
        $this->load->helper('url');
        $idLembaga=$_GET['idLembaga'];
        $idTingkat=$_GET['idTingkat'];
        $idSub=$_GET['sub'];
        $idSeksi=$_GET['seksi'];
        $list = $this->users->get_datatables($idLembaga,$idTingkat,$idSub,$idSeksi);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $users) {
        $no++;
        $row = array();
        $row[] = $no;
        $row[] = $users->nama_pegawai;
        $row[] = $users->username;

        $idTingkat = $users->tingkat;
        $qnamaTingkat = "select keterangan from tingkat where id_tingkat ='$idTingkat'";
        $arrNamaTingkat = $this->db->query($qnamaTingkat)->result_array();
        foreach ($arrNamaTingkat as $dataTingkat){
            $namaTingkat = $dataTingkat['keterangan'];
        }
        $row[] = $namaTingkat;
        
        $idLembaga = $users->lembaga;
        $qnamaLembaga = "select nama_lembaga from lembaga where id_lembaga ='$idLembaga'";
        $arrNamaLembaga = $this->db->query($qnamaLembaga)->result_array();
        foreach ($arrNamaLembaga as $dataLembaga){
            $namaLembaga = $dataLembaga['nama_lembaga'];
        }
        $row[] = $namaLembaga;

        $idSubDirektorat = $users->subdirektorat;
        $qSubDirektorat = "select keterangan from subdirektorat where id_sub ='$idSubDirektorat'";
        $arrSubDirektorat = $this->db->query($qSubDirektorat)->result_array();
        foreach ($arrSubDirektorat as $dataSubDirektorat){
            $namaSubDirektorat = $dataSubDirektorat['keterangan'];
        }
        $row[] = $namaSubDirektorat;
        
        $idSeksi = $users->seksi;
        $qSeksi = "select keterangan from seksi where id_seksi ='$idSeksi'";
        $arrSeksi = $this->db->query($qSeksi)->result_array();
        foreach ($arrSeksi as $dataSeksi){
            $namaSeksi = $dataSeksi['keterangan'];
        }
        $row[] = $namaSeksi;


        if($users->tingkat==0||$users->tingkat<=(int)$this->ion_auth->user()->row()->tingkat){
            $row[] = '';
        }else{
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit"
            onclick="userEdit('."'".$users->id."'".')"><i class="fa fa-pencil"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus"
            onclick="userDelete('."'".$users->id."'".')"><i class="fa fa-trash"></i> Delete</a>';
        }
        

        $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->users->count_all($idLembaga,$idTingkat),
            "recordsFiltered" => $this->users->count_filtered($idLembaga,$idTingkat),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }

    public function userEdit($id)
    {
        $data = $this->users->get_by_id($id);

        $datas = array(
            'idPegawai'=>$data->id,
            'namaPegawai'=>$data->nama_pegawai,
            'nip'=>$data->username,
            'email'=>$data->email,
            'phone'=>$data->phone,
            'subDirektorat'=>$data->subdirektorat,
            'seksi'=>$data->seksi,
            
        );
        echo json_encode($datas);
    }

    function generate_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
    
    public function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    
    public function userAdd()
    {
        $this->_validate();
        $this->db = $this->load->database('default', true);
        $passBcrypt = $this->bcrypt->hash($this->input->post('password'));
        $created = time();
        $ip = $this->getUserIpAddr();
        $namaPegawai = $this->input->post('namaPegawai');
        $nip = $this->input->post('nip');
        $jabatan = $this->input->post('jabatan');
        $lembaga = $this->input->post('lembaga');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');

        if($this->input->post('subDirektorat')==""){
            $subDirektorat = 'null';
        }else{
            $subDirektorat = $this->input->post('subDirektorat');
        }
        
        if($this->input->post('seksi')==""){
            $seksi='null';
        }else{
            $seksi = $this->input->post('seksi');
        }
        

        $queryInsUser = "insert into users
        (ip_address,username,nama_pegawai,password,email,phone,created_on,last_login,active,tingkat,lembaga,seksi,subdirektorat) values
        ('$ip','$nip','$namaPegawai','$passBcrypt','$email','$phone','$created','$created','1','$jabatan','$lembaga',$seksi,$subDirektorat)
        ";
        $this->db->query($queryInsUser);

        echo json_encode(array("status" => TRUE));
    }

    public function userUpdate()
    {
        $this->_validate();
        $data = array(
            'nama_pegawai' => $this->input->post('namaPegawai'),
            'username' => $this->input->post('nip'),
            'tingkat' => $this->input->post('jabatan'),
            'lembaga' => $this->input->post('lembaga'),
            'subdirektorat' => $this->input->post('subDirektorat'),
            'seksi' => $this->input->post('seksi'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
        );

        $this->users->update(array('id' => $this->input->post('idPegawai')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function userDelete($id)
    {
        $this->users->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('namaPegawai') == '')
        {
            $data['inputerror'][] = 'namaPegawai';
            $data['error_string'][] = 'Nama Pegawai harus diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('nip') == '')
        {
            $data['inputerror'][] = 'nip';
            $data['error_string'][] = 'NIP harus diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('lembaga') == '')
        {
            $data['inputerror'][] = 'lembaga';
            $data['error_string'][] = 'Lembaga harus diisi';
            $data['status'] = FALSE;
        }
        if($this->input->post('jabatan') == '')
        {
            $data['inputerror'][] = 'jabatan';
            $data['error_string'][] = 'Jabatan harus diisi';
            $data['status'] = FALSE;
        }
        if($this->input->post('jabatan') == '3'||$this->input->post('jabatan') == '4'){
            if($this->input->post('subDirektorat') == '')
            {
                $data['inputerror'][] = 'subDirektorat';
                $data['error_string'][] = 'Sub Direktorat harus diisi';
                $data['status'] = FALSE;
            }
            if($this->input->post('seksi') == '')
            {
                $data['inputerror'][] = 'seksi';
                $data['error_string'][] = 'Seksi harus diisi';
                $data['status'] = FALSE;
            }
        }

        if($this->input->post('jabatan') == '2'){
            if($this->input->post('subDirektorat') == '')
            {
                $data['inputerror'][] = 'subDirektorat';
                $data['error_string'][] = 'Sub Direktorat harus diisi';
                $data['status'] = FALSE;
            }
        }
        if($this->input->post('phone') == '')
        {
            $data['inputerror'][] = 'phone';
            $data['error_string'][] = 'Nomor HP harus diisi';
            $data['status'] = FALSE;
        }
        if($this->input->post('email') == '')
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email harus diisi';
            $data['status'] = FALSE;
        }
        if($this->input->post('password') == '')
        {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password harus diisi';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    
}