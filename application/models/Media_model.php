<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Media_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q){
        $this->db->group_start();
        $this->db->like('dir_nama',$q);
        $this->db->or_like('dir_status',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('dir_id','desc');
        return $this->db->get('stx_direktori a')->result();
    }
    function countData($q){
        $this->db->group_start();
        $this->db->like('dir_nama',$q);
        $this->db->or_like('dir_status',$q);
        $this->db->group_end();
        return $this->db->get('stx_direktori a')->num_rows();
    }
    function getDataByid($dir_id){
        $this->db->where('dir_id',$dir_id);
        return $this->db->get('stx_direktori')->row();
    }
    function getMediaByid($dir_id){
        $this->db->where('media_id',$dir_id);
        return $this->db->get('stx_media')->row();
    }
    function simpanData($data){
        $this->db->insert('stx_direktori',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$dir_id){
        $this->db->where('dir_id',$dir_id);
        $this->db->update('stx_direktori',$data);
    }
    function updateDataMedia($data,$dir_id){
        $this->db->where('media_id',$dir_id);
        $this->db->update('stx_media',$data);
    }
    function getFiles($idx){
        $this->db->where('media_dirid',$idx);
        return $this->db->get('stx_media')->result();
    }
    function getDir($idx){
        $this->db->where('dir_id',$idx);
        return $this->db->get('stx_direktori')->row();
    }
    function upload_files($path, $title, $files, $allow_types)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => $allow_types,
            'overwrite'     => 1,
        );
        $this->load->library('upload', $config);
        $images = array();
        $i = 0;
        $sukses=0;
        $gagal=0;
        $error="";
        $izinfile=str_replace('|',',',$allow_types);
        foreach ($files['name'] as $key => $image) {
            $i++;
            $_FILES['images[]']['name'] = $files['name'][$key];
            $_FILES['images[]']['type'] = $files['type'][$key];
            $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['images[]']['error'] = $files['error'][$key];
            $_FILES['images[]']['size'] = $files['size'][$key];

            $fileName = str_replace(' ', '_', $_FILES['images[]']['name']);
            //$ext = explode('/', $_FILES['images[]']['type']);
            //$images = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $upload_data = $this->upload->data();
                $file_name[]=$upload_data["file_name"];
                $sukses++;
                // $images = array('status' => true, 'message' => $path . $upload_data["file_name"]);
            } else {
                $gagal++;
                // $images = array('status' => false, 'message' => $this->upload->display_errors());
                $error=$this->upload->display_errors();
            }
        }
        if($gagal>0){
            $message="$gagal dari $i file gagal di upload karena " .$error. " File yang dizinkan adalah $izinfile";
            // $response= array('status'=>true,'message'=>$message,'images'=>$images);
        }else{
            $message="Berhasil upload data";
        }
        if(empty($file_name)) return array('status'=>false,'message'=>$message);
        else return array('status'=>true,'message'=>$message, 'path'=>$path,'images'=>$file_name);
    }
    function hapusData($dir_id){
        $this->db->where('dir_id',$dir_id);
        $this->db->delete('stx_direktori');
    }
    function hapusfile($dir_id){
        $this->db->where('media_id',$dir_id);
        $this->db->delete('stx_media');
    }
}