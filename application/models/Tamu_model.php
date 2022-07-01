<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tamu_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q){
        $this->db->group_start();
        $this->db->like('tamu_nama',$q);
        $this->db->or_like('tamu_email',$q);
        $this->db->or_like('tamu_telp',$q);
        $this->db->or_like('tamu_komentar',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('idx','desc');
        return $this->db->get('trx_bukutamu a')->result();
    }
    function countData($q){
        $this->db->group_start();
        $this->db->like('tamu_nama',$q);
        $this->db->or_like('tamu_email',$q);
        $this->db->or_like('tamu_telp',$q);
        $this->db->or_like('tamu_komentar',$q);
        $this->db->group_end();
        return $this->db->get('trx_bukutamu a')->num_rows();
    }
    function getDataByid($idx){
        $this->db->where('idx',$idx);
        return $this->db->get('trx_bukutamu')->row();
    }
    function simpanData($data){
        $this->db->insert('trx_bukutamu',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$idx){
        $this->db->where('idx',$idx);
        $this->db->update('trx_bukutamu',$data);
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
        foreach ($files['name'] as $key => $image) {
            $i++;
            $_FILES['images[]']['name'] = $files['name'][$key];
            $_FILES['images[]']['type'] = $files['type'][$key];
            $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['images[]']['error'] = $files['error'][$key];
            $_FILES['images[]']['size'] = $files['size'][$key];

            $fileName = $title . '_' . $i . "_" . str_replace(' ', '_', $_FILES['images[]']['name']);
            //$ext = explode('/', $_FILES['images[]']['type']);
            //$images = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $upload_data = $this->upload->data();
                $file_name[]=$path . $upload_data["file_name"];
                $sukses++;
                // $images = array('status' => true, 'message' => $path . $upload_data["file_name"]);
            } else {
                $gagal++;
                // $images = array('status' => false, 'message' => $this->upload->display_errors());
            }
        }
        if($gagal>0){
            $message="$sukses dari $i file berhasil di upload";
            // $response= array('status'=>true,'message'=>$message,'images'=>$images);
        }else{
            $message="Berhasil upload data";
        }
        if(empty($files)) $files=array();
        return array('status'=>true,'message'=>$message,'images'=>$file_name);
    }

    function hapusData($idx){
        $this->db->where('idx',$idx);
        $this->db->delete('trx_bukutamu');
    }
}