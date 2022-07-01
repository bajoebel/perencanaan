<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct()
    {
        parent::__construct();
		$this->load->model('Welcome_model');
    }
	function index(){
        $profile=$this->Welcome_model->getProfile();
		$data=array(
			'resource_url'=>RESOURCE_URL,
			'slider'=>$this->Welcome_model->getSlider(),
			'kategori'=>$this->Welcome_model->getKategori(),
            'profile'=>$profile
		);
		$data=array(
            'profile'=>$profile,
			'libjs'=>array('component/inputmask/dist/jquery.inputmask.bundle.js',
            'component/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
            'js/app/home.js','js/app/online.js'),
			'content'=> $this->load->view('public/index',$data,true)
		);
		$this->load->view('public/view_layout',$data);
	}
	function detail($tglpost,$link){
        $this->Welcome_model->hitPost($tglpost,$link);
        $post=$this->Welcome_model->get_post($tglpost,$link);
        if(!empty($post)) {
            $kategori=$post->post_kategori_id;
            $post_id=$post->post_id;
        }
        else {
            $kategori="";
            $post_id="";
        }
        $data=array(
            'halaman'  => $post,
            'profile'=>$this->Welcome_model->getProfile(),
            'terbaru'=> $this->Welcome_model->terbaru(5,$post->post_id),
            'terkait'=> $this->Welcome_model->terkait(5,$kategori,$post->post_id)
        );
        $data["isi"]    = $this->load->view('public/blog/post_detail',$data,true);
        $view=array(
            'content'   => $this->load->view('public/blog/kontent',$data,true),
			'resource_url'=>RESOURCE_URL,
        );
        $this->load->view('public/view_layout', $view);
    }
	function page($link){
        $this->Welcome_model->hitPage($link);
        $data=array(
            'halaman'  => $this->Welcome_model->get_halaman($link),
            'profile'=>$this->Welcome_model->getProfile(),
        );
        $data["isi"]    = $this->load->view('public/blog/post_detail',$data,true);
        $view=array(
            'content'   => $this->load->view('public/blog/page',$data,true),
			'resource_url'=>RESOURCE_URL,
        );
        $this->load->view('public/view_layout', $view);
    }
    function profile(){
        // $this->Welcome_model->hitPage($link);
        $data=array(
            'profile'=>$this->Welcome_model->getProfile(),
        );
        $data["isi"]    = $this->load->view('public/blog/post_profile',$data,true);
        $view=array(
            'content'   => $this->load->view('public/blog/page',$data,true),
			'resource_url'=>RESOURCE_URL,
        );
        $this->load->view('public/view_layout', $view);
    }
    function mitra(){
        // $this->Welcome_model->hitPage($link);
        $data=array(
            'profile'=>$this->Welcome_model->getProfile(),
            'partner'=>$this->Welcome_model->getPartner(),
        );
        $data["isi"]    = $this->load->view('public/blog/post_partner',$data,true);
        $view=array(
            'content'   => $this->load->view('public/blog/page',$data,true),
			'resource_url'=>RESOURCE_URL,
        );
        $this->load->view('public/view_layout', $view);
    }
    function kalkulator(){
        $data=array(
            'profile'=>$this->Welcome_model->getProfile(),
            'jenis'=>$this->Welcome_model->jenisZakat(),
        );
        $data["isi"]    = $this->load->view('public/blog/kalkulator',$data,true);
        $view=array(
            'content'   => $this->load->view('public/blog/page',$data,true),
			'resource_url'=>RESOURCE_URL,
            'libjs'=>array('js/app/kalkulator.js'),
        );
        $this->load->view('public/view_layout', $view);
    }
    function bentukharta($jeniszakat){
        $this->db->where('jeniszakatidx',$jeniszakat);
        $this->db->select("b.*,a.idx,a.nishab,a.persentase,c.satuan,b.perkiraanharga");
        $this->db->join('stx_jenisharta b','jenishartaidx=b.idx');
        $this->db->join('stx_satuan c','b.satuan=c.idx');
        $jenis=$this->db->get('stx_nisab a')->result();

        $this->db->where('jeniszakatidx',$jeniszakat);
        $this->db->where('variabelpenambah',1);
        $variabel=$this->db->get('stx_variabel')->result();

        $this->db->where('jeniszakatidx',$jeniszakat);
        $this->db->where('variabelpenambah',0);
        $pengurang=$this->db->get('stx_variabel')->result();
        $response=array(
            'jeniszakat'=>$jenis,
            'penambah'=>$variabel,
            'pengurang'=>$pengurang
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function getbentukharta($id=0){
        if($id>0) $this->db->where('a.idx',$id);
        $this->db->select("b.*,a.idx,a.nishab,a.persentase,c.satuan,b.perkiraanharga");
        $this->db->join('stx_jenisharta b','jenishartaidx=b.idx');
        $this->db->join('stx_satuan c','b.satuan=c.idx');
        $data=$this->db->get('stx_nisab a')->row();
        header('Content-Type: application/json');
        echo json_encode($data);
    }
	public function ppid($dir=""){
        // $this->load->model("Welcome_model");
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        if(empty($dir)) $dir = intval($this->input->get('dir'));
        $limit = 10;
        //echo $dir; exit;
        $data=array(
            'dir'   => $dir,
            'media'  => $this->Welcome_model->getPpid($limit,$start,$q,$dir),
            'profile'=>$this->Welcome_model->getProfile(),
        );
        //$data["isi"]=$this->load->view('admin/media/view_tabel', $data, true);
        $data["isi"]=$this->load->view('public/blog/ppid', $data, true);
        $view=array(
            'content'   => $this->load->view('public/blog/page',$data,true),
			'libjs'=>array('js/app/ppid.js'),
			'resource_url'=>RESOURCE_URL,
        );
        $this->load->view('public/view_layout', $view);
    }
	public function data_ppid(){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $dir = intval($this->input->get('dir'));
        $limit = 20;
        $row_count=$this->Welcome_model->countPpid($q,$dir);
        $tabel= $this->Welcome_model->getPpid($limit,$start,$q,$dir);
        $list=array(
            'start'     => $start,
            'row_count' => $row_count,
            'limit'     => $limit,
            'data'     => $tabel,
        );
        echo json_encode($list);
    }
	
	function login(){
		$data=array();
		$data=array(
			'libjs'=>array('js/app/home.js','js/app/login.js'),
            'profile'=>$this->Welcome_model->getProfile(),
			'content'=> $this->load->view('public/login',$data,true)
		);
		$this->load->view('public/view_layout',$data);
	}
	function cekuser(){
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$cek=$this->Welcome_model->cekUser($username,$password);
		if($cek){
			if($cek->userstatus==1){
				$sess_data=array(
					'id'=>$cek->username,
					'nama_lengkap'=>$cek->usernamalengkap,
					'bagian'=>$cek->userbagian,
					'photo'=>$cek->photo,
                    'administrator'=>$cek->administrator
				);
				$this->session->set_userdata($sess_data);
				$response=array('status'=>true,'message'=>'Anda Berhasil Login');
			}else $response=array('status'=>true,'message'=>'Username Atau Password Anda Salah');
		}else{
			$response=array('status'=>false,'message'=>'Username Atau Password Anda Salah');
		}
		header('Content-Type: application/json');
        echo json_encode($response);
	}
	
	function qr($id){
		// $data=$this->input->get('qrdata');
		// $data=array(
		// 	'nama'=>'Wanhar Azri',
		// 	'umur'=>35,
		// 	'pekerjaan'=>"THL"
		// );
		// $data=$this->input->get('qrdata');
		$data=QRLINK."online/pendaftaran/".$id;
		// echo $data;exit;
		QRcode::png($id,false,QR_ECLEVEL_H,5,2);
	}
	
	function blog(){
        $link='';
        // $post=$this->Welcome_model->get_post($tglpost,$link);
        $data=array(
            'profile'=>$this->Welcome_model->getProfile(),
            'kategori'=>$this->Welcome_model->getKategori()
        );
        $data["isi"]    = $this->load->view('public/blog/utama',$data,true);
        $view=array(
            'content'   => $this->load->view('public/blog/page',$data,true),
			'resource_url'=>RESOURCE_URL,
        );
        $this->load->view('public/view_layout', $view);
    }
    function kategori($link=""){
        // $link='';
        $kat=$this->Welcome_model->getKategoriByLink($link);
        if(!empty($kat)){
            if(!empty($kat)) $post=$this->Welcome_model->getPostByKategori($kat->kategori_id,8);
            else $post=array();
        }else{
            $post=array();
        }
        // print_r($kat); exit;
        $data=array(
            'profile'=>$this->Welcome_model->getProfile(),
            'kategori'=>$kat,
            'post'=>$post
        );
        $data["isi"]    = $this->load->view('public/blog/kategori',$data,true);
        $view=array(
            'content'   => $this->load->view('public/blog/page',$data,true),
			'resource_url'=>RESOURCE_URL,
        );
        $this->load->view('public/view_layout', $view);
    }
    public function download($dir=""){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        if(empty($dir)) $dir = intval($this->input->get('dir'));
        $limit = 10;
        //echo $dir; exit;
        $data=array(
            'dir'   => $dir,
            'profile'=>$this->Welcome_model->getProfile(),
            'media'  => $this->Welcome_model->getDownload($limit,$start,$q,$dir),
        );
        //$data["isi"]=$this->load->view('admin/media/view_tabel', $data, true);
        $data["isi"]=$this->load->view('public/blog/download', $data, true);
        $view=array(
            'content'   => $this->load->view('public/blog/page',$data,true),
            'libjs'=>array('js/app/download.js'),
        );
        $this->load->view('public/view_layout', $view);
    }
    public function data_download(){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $dir = intval($this->input->get('dir'));
        $limit = 20;
        $row_count=$this->Welcome_model->countDownload($q,$dir);
        $tabel= $this->Welcome_model->getDownload($limit,$start,$q,$dir);
        $list=array(
            'start'     => $start,
            'row_count' => $row_count,
            'limit'     => $limit,
            'data'     => $tabel,
        );
        echo json_encode($list);
    }
    function galeri(){
        $folder=$this->input->get('dir');
        $dir = $this->Welcome_model->getDirectori();
        
        if(empty($folder)) {
            if(empty($dir)) $folder="";
            else $folder=$dir[0]->dir_id; 
        }
        $limit = 10;
        //echo $dir; exit;
        $data=array(
            'dir'   => $dir,
            'profile'=>$this->Welcome_model->getProfile(),
            'media'  => $this->Welcome_model->getGalery($folder)
        );
        //$data["isi"]=$this->load->view('admin/media/view_tabel', $data, true);
        $data["isi"]=$this->load->view('public/blog/galeri', $data, true);
        $view=array(
            'content'   => $this->load->view('public/blog/kontent_galeri',$data,true),
            'libjs'=>array('js/app/galeri.js'),
        );
        $this->load->view('public/view_layout', $view);
    }
    function video(){
        $folder=$this->input->get('kat');
        $dir = $this->Welcome_model->getKategoriVideo();
        
        if(empty($folder)) {
            if(empty($dir)) $folder="";
            else $folder=$dir[0]->idx; 
        }
        $limit = 10;
        //echo $dir; exit;
        $data=array(
            'dir'   => $dir,
            'profile'=>$this->Welcome_model->getProfile(),
            'media'  => $this->Welcome_model->getVideo($folder)
        );
        //$data["isi"]=$this->load->view('admin/media/view_tabel', $data, true);
        $data["isi"]=$this->load->view('public/blog/video', $data, true);
        $view=array(
            'content'   => $this->load->view('public/blog/kontent_vidio',$data,true),
            'libjs'=>array('js/app/galeri.js'),
        );
        $this->load->view('public/view_layout', $view);
    }
    function pengaduan(){
        $data=array(
            'profile'=>$this->Welcome_model->getProfile(),
        );
        //$data["isi"]=$this->load->view('admin/media/view_tabel', $data, true);
        $data["isi"]=$this->load->view('public/blog/pengaduan', $data, true);
        $view=array(
            'content'   => $this->load->view('public/blog/page',$data,true)
        );
        $this->load->view('public/view_layout', $view);
    }

    function kritik(){
        $view=array(
            'content'   => $this->load->view('public/blog/kritik','',true),
            'profile'=>$this->Welcome_model->getProfile(),
        );
        $this->load->view('public/view_layout', $view);
    }
    function simpankritik(){
        $data=array(
            'kritik_desc'=>$this->security->xss_clean($this->input->post('kritik_desc')),
            'kritik_penilaian'=>$this->security->xss_clean($this->input->post('kritik_penilaian')),
            'kritik_tanggal'=>date('Y-m-d'),
            
        );
        $this->db->insert('trx_kritik',$data);
        $id=$this->db->insert_id();
        if($id){
            echo json_encode(array('status'=>true,'message'=>'Terima kasih atas saran dan kritiknya, kritik dan saran anda akan kami pertimbangkan demi peningkatan palayanan kami'));
        }else{
            echo json_encode(array('status'=>false,'message'=>'Maaf terjadi kesalahan '));
        }
    }
    
    function kirimpengaduan(){
        $data=array(
            'tamu_email'=>$this->security->xss_clean($this->input->post('tamu_email')),
            'tamu_telp'=>$this->security->xss_clean($this->input->post('tamu_telp')),
            'tamu_tgl' => date('Y-m-d'),
            'tamu_nama'=>$this->security->xss_clean($this->input->post('tamu_nama')),
            'tamu_telp'=>$this->security->xss_clean($this->input->post('tamu_telp')),
            'tamu_komentar'=>$this->security->xss_clean($this->input->post('tamu_komentar')),
        );
        $this->db->insert('trx_bukutamu',$data);
        $id=$this->db->insert_id();
        if($id){
            echo json_encode(array('status'=>true,'message'=>'Terima kasih atas pengaduannya, Pengaduan anda sudah kami terima dan akan segera kami proses '));
        }else{
            echo json_encode(array('status'=>false,'message'=>'Maaf terjadi kesalahan '));
        }
    }

    function komentar($post_id){
        $data=$this->Welcome_model->getKomentar($post_id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    function insertkomentar(){
        /*$data = array(
            'komentar_postid'   => $this->security->xss_clean($this->input->post('post_id')),
            'komentar_email'    => $this->security->xss_clean($this->input->post('email')),
            'komentar_nama'     => $this->security->xss_clean($this->input->post('nama')),
            'komentar_isi'      => $this->security->xss_clean($this->input->post('komentar'))
        );*/
        $data = array(
            'komentar_postid'   => $_POST['post_id'],
            'komentar_email'    => $_POST['email'],
            'komentar_nama'     => $_POST['nama'],
            'komentar_isi'      => $_POST['komentar']
        );
        $id= $this->Welcome_model->insertKomentar($data);
        if($id){
            $response=array('status'=>true,'message'=>"OK");
        }else{
            $response=array('status'=>false,'message'=>"Gagal");
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function list_berita(){
        $x['q'] = urldecode($this->input->get('q', TRUE));
        $x['start'] = intval($this->input->get('start'));
        $x['limit'] = 5;
        $x['row_count']=$this->Welcome_model->countPost($x['q']);
        $x["data"]=$this->Welcome_model->getPostlimit($x['limit'],$x['start'],$x['q']);
        $list=array(
            'status'    => true,
            'message'   => "OK",
            'start'     => $x['start'],
            'row_count' => $x['row_count'],
            'limit'     => $x['limit'],
            'data'      => $this->load->view('blog/isi',$x,true),
        );
        header('Content-Type: application/json');
        echo json_encode($list);
    }

    public function logout(){
		$this->session->sess_destroy();
		header('location:'.base_url().'login');

	}
    
}
