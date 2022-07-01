<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instansi extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
	}
    function index(){
        $link='admin/instansi';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            
            
            $data=array(
                'instansi'=>$this->db->get('profile')->row()
            );
            // $view = array(
            //     'header' => $this->load->view('themplate/header', '', true),
            //     'nav_sidebar' => $this->load->view('themplate/nav_sidebar', array('indukid' => $priv->idx,'mainidx'=>$priv->main_idx), true),
            //     'content' => $this->load->view('admin/instansi_index', $data, true),
            //     'lib'        => array('assets/bower_components/ckeditor/ckeditor.js','lib/instansi.js')
            // );

            $view=array(
                'libjs'=>array('js/app/instansi.js'),
                'ajaxdata' => array(),
                'content'=> $this->load->view('admin/instansi_index',$data,true),
                'aktif'=>$priv->urut_menu
            );
            $this->load->view('admin/layout', $view);
        }else{
            $data=array(
                'content'=> $this->load->view('403','',true),
                'aktif'=>6
            );
            $this->load->view('admin/layout',$data);
        }
    }
    function simpan(){
        $link='admin/instansi';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->load->model('Slider_model');
            $create_dir = "files/profile/";
            
            $res1 = $this->Slider_model->upload_files($create_dir,'logo_', $_FILES['logo'], 'jpg|jpeg|gif|tiff|png');
            if($res1['status']==true){
                $logo = $res1['images'][0];
            }else $logo=$this->input->post('logosekolah');
            // echo $foto; 
            // echo $logo; 
            // exit;
            $data=array(
                'nama_instansi'=>$this->input->post('nama_instansi'),
                'alamat'=>$this->input->post('alamat'),
                'notelp'=>$this->input->post('notelp'),
                'fax'=>$this->input->post('fax'),
                'email'=>$this->input->post('email'),
                'facebook'=>$this->input->post('facebook'),
                'twitter'=>$this->input->post('twitter'),
                'instagram'=>$this->input->post('instagram'),
                'youtube'=>$this->input->post('youtube'),
                'sasaran'=>$this->input->post('sasaran'),
                'indikator_sasaran'=>$this->input->post('indikator_sasaran'),
                'visi'=>$this->input->post('visi'),
                'misi'=>$this->input->post('misi'),
                'tujuan'=>$this->input->post('tujuan'),
                'moto'=>$this->input->post('moto'),
                'tentang'=>$this->input->post('tentang'),
                'sekilas'=>$this->input->post('sekilas'),
                'logo'=>$logo
            );
            $cek=$this->db->get('profile')->row();
            if($cek){
                if(empty($logo)) $logo=$cek->logo;
                // if(empty($foto)) $foto=$cek->foto;
                $data=array(
                    'nama_instansi'=>$this->input->post('nama_instansi'),
                    'alamat'=>$this->input->post('alamat'),
                    'notelp'=>$this->input->post('notelp'),
                    'fax'=>$this->input->post('fax'),
                    'email'=>$this->input->post('email'),
                    'facebook'=>$this->input->post('facebook'),
                    'twitter'=>$this->input->post('twitter'),
                    'instagram'=>$this->input->post('instagram'),
                    'youtube'=>$this->input->post('youtube'),
                    'sasaran'=>$this->input->post('sasaran'),
                    'indikator_sasaran'=>$this->input->post('indikator_sasaran'),
                    'visi'=>$this->input->post('visi'),
                    'misi'=>$this->input->post('misi'),
                    'tujuan'=>$this->input->post('tujuan'),
                    'moto'=>$this->input->post('moto'),
                    'tentang'=>$this->input->post('tentang'),
                    'sekilas'=>$this->input->post('sekilas'),
                    'logo'=>$logo
                );
                // print_r($data);exit;
                $this->db->update('profile',$data);
            }else{
                $this->db->insert('profile',$data);
            }
            header("location:".base_url()."admin/instansi");
        }else{
            $data=array(
                'content'=> $this->load->view('403','',true),
                'aktif'=>3
            );
            $this->load->view('admin/layout',$data);
        }
    }
}