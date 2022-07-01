<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kritik extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('kritik_model');
    }
    function index(){
        $link='admin/kritik';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('kritik_tanggal','kritik_desc','kritik_penilaian');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{kritik_tanggal}}\\\",\\\"{{kritik_desc}}\\\",\\\"{{kritik_penilaian}}\\\")'><span class='fa fa-search'></span> Lihat</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/kritik/getdata',
                'variable'      => array('idx' => 'kritik_id','kritik_tanggal' => 'kritik_tanggal','kritik_desc'=>'kritik_desc','kritik_penilaian'=>'kritik_penilaian'),
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
                'libjs'=>array('js/app/kritik.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/kritik_index','',true),
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
        $link='admin/kritik';
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
                'row_count' => $this->kritik_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->kritik_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/kritik';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $idx=$this->input->post('idx');
            
            $row=$this->kritik_model->getDataByid($idx);
            if(empty($row)){
                $kritik_status=$this->input->post('kritik_status');
                if($kritik_status!=1) $kritik_status=0;
                $data=array(
                    'kritik_desc'=>$this->input->post('kritik_desc'),
                    'kritik_penilaian'=>$this->input->post('kritik_penilaian'),
                    'kritik_telp'=>$this->input->post('kritik_telp'),
                    'kritik_komentar'=>$this->input->post('kritik_komentar'),
                    'kritik_status'=>$kritik_status,
                );

                $this->form_validation->set_rules('kritik_desc', 'kritik', 'required');
                // $this->form_validation->set_rules('kritik_status', 'Status kritik', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->kritik_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_kritik_desc' => form_error('kritik_desc'),
                        'err_kritik_status' => form_error('kritik_status'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('kritik_desc', 'Cara Bayar', 'required');
                // $this->form_validation->set_rules('kritik_status', 'Status kritik', 'required');
                $kritik_status=$this->input->post('kritik_status');
                    if($kritik_status!=1) $kritik_status=0;
                    $data=array(
                        'kritik_status'=>$kritik_status,
                    );
                    $this->kritik_model->updateData($data,$idx);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
            }
        }else{
            header('Content-Type: application/json');
            echo json_encode(array("status" => FALSE,'error'=>TRUE, "message"=> "Anda tidak berhak untuk mengakases halaman ini"));
        }
    }

    function hapus($idx)
    {
        $link='admin/kritik';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->kritik_model->hapusData($idx);
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