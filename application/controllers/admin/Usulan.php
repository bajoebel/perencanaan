<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usulan extends CI_Controller {
	function __construct()
    {
        parent::__construct();
    }
    function buat($index){
        if($this->session->userdata('id')){
            $periode=$this->db->where('kode_periode',$index)->get('periode_usulan')->row();
            $jenis=$this->db->where('status_usulan',1)->where("kode=kode_induk")->get("jenis_usulan")->result();
            $data=array(
                'periode'=>$periode,
                'jenis'=>$jenis
            );
            $data=array(
                'libjs'=>array('js/app/home.js','js/app/online.js'),
                'content'=> $this->load->view('admin/usulan_buat',$data,true),
                'aktif'=>1
            );
            $this->load->view('admin/layout',$data);
        }else{
            $data=array(
                'content'=> $this->load->view('403','',true),
                'aktif'=>1
            );
            $this->load->view('admin/layout',$data);
        }
    }
}