<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_video extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('kategori_video_model');
    }
    function index(){
        $link='admin/kategori_video';
        $priv=getAkses($link,$this->session->userdata('level'));
        // echo $priv->urut_menu; exit;
        if(!empty($priv)){
            $field=array('kategori_video','kategori_status');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{kategori_video}}\\\",\\\"{{kategori_status}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/kategori_video/getdata',
                'variable'      => array('idx' => 'idx','kategori_video'=>'kategori_video','kategori_status'=>'kategori_status'),
                'field'         => $field,
                'function'      => 'getData',
                'keyword_id'    => 'q',
                'param_id'      => array(),
                'limit_id'      => 'limit',
                'data_id'       => 'data',
                'page_id'       => 'pagination',
                'number'        => true,
                'action'        => true,
                'load'          => true,
                'action_button' => $action,
            );
            $data=array(
                'libjs'=>array('js/app/kategori_video.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/kategori_video_index','',true),
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
        $link='admin/kategori_video';
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
                'row_count' => $this->kategori_video_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->kategori_video_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/kategori_video';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $idx=$this->input->post('idx');
            $kategori_video_link=str_replace(' ','-',strtolower($this->input->post('kategori_video')));
            $kategori_video_link=str_replace('&','dan',$kategori_video_link);
            $kategori_video_link=preg_replace('~[\\\\/:*?"<>|]~', '', $kategori_video_link);
            $row=$this->kategori_video_model->getDataByid($idx);
            if(empty($row)){
                $kategori_status=$this->input->post('kategori_status');
                if($kategori_status!=1) $kategori_status=0;
                $data=array(
                    'kategori_video'=>$this->input->post('kategori_video'),
                    'kategori_status'=>$kategori_status,
                );

                $this->form_validation->set_rules('kategori_video', 'kategori_video', 'required');
                // $this->form_validation->set_rules('kategori_status', 'Status kategori_video', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->kategori_video_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_kategori_video' => form_error('kategori_video'),
                        'err_kategori_status' => form_error('kategori_status'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('kategori_video', 'Cara Bayar', 'required');
                // $this->form_validation->set_rules('kategori_status', 'Status kategori_video', 'required');
                if($this->form_validation->run())
                {
                    $kategori_status=$this->input->post('kategori_status');
                    if($kategori_status!=1) $kategori_status=0;
                    $data=array(
                        'kategori_video'=>$this->input->post('kategori_video'),
                        'kategori_status'=>$kategori_status,
                    );
                    $this->kategori_video_model->updateData($data,$idx);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_kategori_video' => form_error('kategori_video'),
                        'err_kategori_status' => form_error('kategori_status'),
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

    function hapus($idx)
    {
        $link='admin/kategori_video';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->kategori_video_model->hapusData($idx);
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
}