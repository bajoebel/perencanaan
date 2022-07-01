<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasboard extends CI_Controller {
	function __construct()
    {
        parent::__construct();
    }
    function index(){
        if($this->session->userdata('id')){
            $data=array();
            $data=array(
                'libjs'=>array('js/app/home.js','js/app/online.js'),
                'content'=> $this->load->view('admin/home_index',$data,true),
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