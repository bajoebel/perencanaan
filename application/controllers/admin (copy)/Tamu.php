<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tamu extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('tamu_model');
    }
    function index(){
        $link='admin/tamu';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('tamu_tgl','tamu_nama','tamu_telp', 'tamu_email','tamu_komentar','tamu_status');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{tamu_tgl}}\\\",\\\"{{tamu_nama}}\\\",\\\"{{tamu_telp}}\\\",\\\"{{tamu_email}}\\\",\\\"{{tamu_komentar}}\\\",\\\"{{tamu_status}}\\\")'><span class='fa fa-search'></span> Lihat</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/tamu/getdata',
                'variable'      => array('idx' => 'idx','tamu_tgl' => 'tamu_tgl','tamu_nama'=>'tamu_nama','tamu_telp'=>'tamu_telp','tamu_email'=>'tamu_email','tamu_komentar'=>'tamu_komentar','tamu_status'=>'tamu_status'),
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
                'libjs'=>array('js/app/tamu.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/tamu_index','',true),
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
        $link='admin/tamu';
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
                'row_count' => $this->tamu_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->tamu_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/tamu';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $idx=$this->input->post('idx');
            
            $row=$this->tamu_model->getDataByid($idx);
            if(empty($row)){
                $tamu_status=$this->input->post('tamu_status');
                if($tamu_status!=1) $tamu_status=0;
                $data=array(
                    'tamu_nama'=>$this->input->post('tamu_nama'),
                    'tamu_email'=>$this->input->post('tamu_email'),
                    'tamu_telp'=>$this->input->post('tamu_telp'),
                    'tamu_komentar'=>$this->input->post('tamu_komentar'),
                    'tamu_status'=>$tamu_status,
                );

                $this->form_validation->set_rules('tamu_nama', 'tamu', 'required');
                // $this->form_validation->set_rules('tamu_status', 'Status tamu', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->tamu_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_tamu_nama' => form_error('tamu_nama'),
                        'err_tamu_status' => form_error('tamu_status'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('tamu_nama', 'Cara Bayar', 'required');
                // $this->form_validation->set_rules('tamu_status', 'Status tamu', 'required');
                $tamu_status=$this->input->post('tamu_status');
                    if($tamu_status!=1) $tamu_status=0;
                    $data=array(
                        'tamu_status'=>$tamu_status,
                    );
                    $this->tamu_model->updateData($data,$idx);
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
        $link='admin/tamu';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->tamu_model->hapusData($idx);
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