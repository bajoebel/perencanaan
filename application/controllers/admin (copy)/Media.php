<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Media_model');
    }
    function index(){
        $link='admin/media';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            
            $data=array(
                'libjs'=>array('js/app/media.js'),
                'content'=> $this->load->view('admin/media_index','',true),
                'aktif'=>$priv->urut_menu
            );
            $this->load->view('admin/layout',$data);
        }else{
            $data=array(
                'content'=> $this->load->view('403','',true),
                'aktif'=>3
            );
            $this->load->view('admin/layout',$data);
        }
        
    }
    
    function getdata()
    {
        $link='admin/media';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $q = urldecode($this->input->get('keyword', TRUE));
            $start = intval($this->input->get('start'));
            $limit = intval($this->input->get('limit'));
            $mulai = ($start * $limit) - $limit;
            $response = array(
                'status'    => true,
                'message'   => "OK",
                'start'     => $mulai,
                'row_count' => $this->Media_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->Media_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/media';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $media_id=$this->input->post('media_id');
            $media_keterangan=$this->input->post('media_keterangan');
            
            $row=$this->Media_model->getMediaByid($media_id);
            if(empty($row)){
                
                $data=array(
                    'media_dirid'=>$this->input->post('media_dirid'),
                    'media_keterangan'=>$media_keterangan,
                );

                $this->form_validation->set_rules('media_dirid', 'Keterangan', 'required');
                // $this->form_validation->set_rules('media_status', 'Status media', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->Media_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_media_dirid' => form_error('media_dirid'),
                        'err_media_keterangan' => form_error('err_media_keterangan'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('media_keterangan', 'Keterangan File', 'required');
                // $this->form_validation->set_rules('media_status', 'Status media', 'required');
                if($this->form_validation->run())
                {
                    $media_status=$this->input->post('media_status');
                    if($media_status!='Aktif') $media_status="Non Aktif";
                    $data=array(
                        'media_dirid'=>$this->input->post('media_dirid'),
                        'media_keterangan'=>$media_keterangan,
                    );
                    $this->Media_model->updateDataMedia($data,$media_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_media_keterangan' => form_error('media_keterangan'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }
        }else{
            header('Content-Type: application/json');
            echo json_encode(array("status" => FALSE,'error'=>TRUE, "message"=> "Anda tidak berhak untuk mengakases halaman ini"));
        }
    }

    function updatedir(){
        $link='admin/media';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $dir_id=$this->input->post('dir_id');
            $dir_status=$this->input->post('dir_status');
            $dir_galery=$this->input->post('dir_galery');
            $dir_download=$this->input->post('dir_download');
            $dir_ppid=$this->input->post('dir_ppid');
            if($dir_status!=1) $dir_status=0;
            if($dir_galery!=1) $dir_galery=0;
            if($dir_download!=1) $dir_download=0;
            if($dir_ppid!=1) $dir_ppid=0;

            $curdir=$this->input->post('curent_dir');
            $newfolder=$this->input->post('dir_nama');
            $oldfolder=$this->input->post('old_dir');
            $old_dir = $curdir."/".$oldfolder;
            $create_dir = $curdir."/".$newfolder;
            rename($old_dir,$create_dir);
            $dir=array(
                'dir_nama'=>$this->input->post('dir_nama'),
                'dir_status'=>$dir_status,
                'dir_galery'=>$dir_galery,
                'dir_download'=>$dir_download,
                'dir_ppid'=>$dir_ppid
            );
            $this->db->where('dir_id',$dir_id);
            $this->db->update('stx_direktori',$dir);
            header('Content-Type: application/json');
            echo json_encode(array("status" => true,"message"=> "Berhasil udate direktori"));
        }else{
            header('Content-Type: application/json');
            echo json_encode(array("status" => FALSE,'error'=>TRUE, "message"=> "Anda tidak berhak untuk mengakases halaman ini"));
        }
    }
    function hapus($idx)
    {
        $link='admin/media';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Media_model->hapusData($idx);
            $response = array(
                'status'    => true,
                'message'   => "Data berhasil dihapus",
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function hapusfile($idx)
    {
        $link='admin/media';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Media_model->hapusFile($idx);
            $response = array(
                'status'    => true,
                'message'   => "Data berhasil dihapus",
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function files($idx)
    {
        $link='admin/media';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $data=$this->Media_model->getFiles($idx);
            $dir=$this->Media_model->getDir($idx);
            $response = array(
                'status'    => true,
                'message'   => "OK",
                'data'=>$data,
                'dir'=>$dir
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function filemanager(){
        $dir_path=$this->input->get("dir");
        $directories = scandir($dir_path);
        $urut=0;
        echo "<div class='row'>";
        foreach($directories as $entry) {
            $urut++;
            if (is_dir($dir_path . "/" . $entry) && !in_array($entry, array('.','..'))) {
                echo "<div class='col-md-1 col-xs-3' style='text-align:center;font-weight:bold'><a href='#' onmousedown='cekAction(event,\"".$entry."\")'><img src='".base_url() ."img/icon/folder.png"."' class='img img-responsive' /></a>".$entry."</div>";
                // echo "<a href=?directory=" . $dir_path . "" . $entry . "/" . "><li>" . $entry . "</li></a>";
            }
            else {
                $e=array('doc','docx','xls','xlsx','pdf','zip','rar','txt','js','css','html');
                $e1=array('jpg','jpeg','gif','tiff','png');
                $ex=explode(".",$entry);
                // print_r($ex);
                $ext=end($ex);
                if(in_array($ext,$e)) $file_link=base_url() ."img/icon/$ext.png";
                // elseif(in_array($ext,$e1)) $file_link=base_url() .$dir_path.$entry;
                elseif(in_array($ext,$e1)) $file_link=str_replace('./',base_url(),$dir_path) ."/".$entry;
                else $file_link=base_url() ."img/icon/txt.png";;
                if($entry!="." && $entry!=".." && $entry!="")
                echo "<div class='col-md-2 col-xs-3' style='text-align:center;font-weight:bold' ><a href='".base_url() .$dir_path.$entry."' onclick='openDir(\"".$entry."\")'>
                <img src='$file_link' class='img img-responsive' /></a>".$entry."</div>";
            }
        }
        echo "</div>";
    }
    function createfolder(){
        $link='admin/media';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $curdir=$this->input->post('curent_dir');
            $newfolder=$this->input->post('newfolder');
            // echo "CUR DIR ".$curdir; exit;
            $create_dir = $curdir."/".$newfolder;

            $dir_galery=$this->input->post('dir_galery');
                $dir_download=$this->input->post('dir_download');
                $dir_ppid=$this->input->post('dir_ppid');
                if(empty($dir_galery)) $dir_galery=0;
                if(empty($dir_download)) $dir_download=0;
                if(empty($dir_ppid)) $dir_ppid=0;
                $data=array(
                    'dir_nama'=>$newfolder,
                    'dir_status'=>1,
                    'dir_galery'=>$dir_galery,
                    'dir_download'=>$dir_download,
                    'dir_ppid'=>$dir_ppid
                );
                $this->db->insert('stx_direktori',$data);

            if (!file_exists($create_dir)) {
                mkdir($create_dir, 0777, true);
                

                $response = array(
                    'status'    => true,
                    'message'   => "OK",
                );
            }else{
                $response = array(
                    'status'    => false,
                    'message'   => "Gagal Membuat Folder",
                );
            }

            
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function uploadfile(){
        $link='admin/media';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $create_dir=$this->input->post('curent_dir1');
            $galery=$this->input->post('gelery');
            $download=$this->input->post('download');
            $ppid=$this->input->post('ppid');
            if($galery==1) $file_type="jpg|jpeg|gif|tiff|png";
            if($download==1) $file_type="jpg|jpeg|gif|tiff|png|pdf|doc|docx|xls|xlsx|zip|rar|odt|avi|mp4";
            if($ppid==1){
                if($galery==1) $file_type.="|pdf|doc|docx|xls|xlsx|zip|rar|odt";
                else $file_type="pdf|doc|docx|xls|xlsx|zip|rar|odt";
            }
            // $file_type="jpg|jpeg|gif|tiff|png|pdf|doc|docx|xls|xlsx|zip|rar|odt|avi|mp4";
            $res = $this->Media_model->upload_files($create_dir, '', $_FILES['userfile'], $file_type);
            if($res['status']==true) {
                $data=array(
                    'media_dirid'=>$this->input->post('media_dirid'),
                    'media_namafile'=>$res['images'][0],
                    'media_keterangan'=>$this->input->post('media_keterangan')
                );
                $this->db->insert('stx_media',$data);
                $response=array('status'=>true,'message'=>'OK');
            }else{
                $response=array('status'=>false,'message'=>$res["message"]);
            }
            
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function openfile($id){
        $this->db->where('media_id',$id);
        $this->db->join('stx_direktori','dir_id=media_dirid');
        $response=$this->db->get('stx_media')->row();
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}