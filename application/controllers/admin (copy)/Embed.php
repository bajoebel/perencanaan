<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Embed extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('embed_model');
    }
    function index(){
        $link='admin/embed';
        $priv=getAkses($link,$this->session->userdata('level'));
        // echo $priv->urut_menu; exit;
        if(!empty($priv)){
            $field=array('kategori_video','video_embed','video_judul','video_publish');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}})'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/embed/getdata',
                'variable'      => array('idx' => 'idx','video_embed'=>'video_embed','video_judul'=>'video_judul','video_katid'=>'video_katid','video_publish'=>'video_publish'),
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
            $data=array('kategori'=>$this->embed_model->getKategori());
            $data=array(
                'libjs'=>array('js/app/embed.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/embed_index',$data,true),
                'kategori'=>$this->embed_model->getKategori(),
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
        $link='admin/embed';
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
                'row_count' => $this->embed_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->embed_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/embed';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $idx=$this->input->post('idx');
            $embed_link=str_replace(' ','-',strtolower($this->input->post('embed')));
            $embed_link=str_replace('&','dan',$embed_link);
            $embed_link=preg_replace('~[\\\\/:*?"<>|]~', '', $embed_link);
            $row=$this->embed_model->getDataByid($idx);
            if(empty($row)){
                $video_publish=$this->input->post('video_publish');
                if($video_publish!=1) $video_publish=0;
                $data=array(
                    'video_embed'=>$this->input->post('video_embed'),
                    'video_katid'=>$this->input->post('video_katid'),
                    'video_judul'=>$this->input->post('video_judul'),
                    'video_publish'=>$video_publish
                );

                $this->form_validation->set_rules('video_embed', 'embed', 'required');
                // $this->form_validation->set_rules('video_judul', 'Status embed', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->embed_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_embed' => form_error('embed'),
                        'err_video_judul' => form_error('video_judul'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('video_embed', 'Embed', 'required');
                // $this->form_validation->set_rules('video_judul', 'Status embed', 'required');
                if($this->form_validation->run())
                {
                    $video_publish=$this->input->post('video_publish');
                    if($video_publish!=1) $video_publish=0;
                    $data=array(
                        'video_embed'=>$this->input->post('video_embed'),
                        'video_katid'=>$this->input->post('video_katid'),
                        'video_judul'=>$this->input->post('video_judul'),
                        'video_publish'=>$video_publish
                    );
                    $this->embed_model->updateData($data,$idx);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_embed' => form_error('embed'),
                        'err_video_judul' => form_error('video_judul'),
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
        $link='admin/embed';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->embed_model->hapusData($idx);
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

    function edit($idx)
    {
        $link='admin/embed';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            // $this->embed_model->getDataByid($idx);
            $response = array(
                'status'    => true,
                'data'=>$this->embed_model->getDataByid($idx),
                'message'   => "OK",
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}