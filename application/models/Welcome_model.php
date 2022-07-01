<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Welcome_model extends CI_Model
{
    function cekuser($username,$password){
        $this->db->where('username',$username);
        $this->db->where('userpass',md5($password));
        $this->db->where('userstatus',1);
        return $this->db->get('users')->row();
    }
    function getMenuinduk(){
		$this->db->order_by('menu_idxutama');
		$this->db->order_by('menu_idxanak');
		$this->db->order_by('menu_idxsub');
		$this->db->where('menu_idxanak',0);
		$this->db->where('menu_status',1);
		return $this->db->get('stx_menu')->result();
	}

	function getMenuanak($idxutama){
		//$this->db->order_by('menu_idxutama');
		$this->db->order_by('menu_idxanak');
		$this->db->order_by('menu_idxsub');
		//$this->db->group_by('menu_idxanak');
		$this->db->where('menu_status',1);
		$this->db->where('menu_idxanak >',0);
		$this->db->where('menu_idxutama', $idxutama);
		return $this->db->get('stx_menu')->result();
	}
	function getSubmenu($idxutama,$idxanak){
		$this->db->order_by('menu_idxutama');
		$this->db->order_by('menu_idxanak');
		$this->db->order_by('menu_idxsub');
		$this->db->where('menu_status',1);
		$this->db->where('menu_idxutama', $idxutama);
		$this->db->where('menu_idxanak',$idxanak);
		$this->db->where('menu_idxsub >',0);
		return $this->db->get('stx_menu')->result();
	}
    function getSlider(){
        $this->db->where('slider_status',1);
        return $this->db->get('stx_slider')->result();
    }
    function getDokter(){
        $this->db->where('dokter_status','Aktif');
        $this->db->where('dokter_jenis','SPESIALIS');
        $this->db->where('dokter_fhoto IS NOT NULL');
        return $this->db->get('stx_dokter')->result();
    }
    function getBlog($limit){
        $this->db->where('post_status','Publish');
        $this->db->where('post_jenis','Halaman Dinamis');
        $this->db->where('post_tglpublish < ',date('Y-m-d'));
        $this->db->join('stx_kategori b','a.post_kategori_id=b.kategori_id');
        $this->db->order_by('post_tanggal','DESC');
        $this->db->limit($limit);
        return $this->db->get('trx_post a')->result();
    }

    function terbaru($limit,$post_id=""){
        $this->db->select("*,CONCAT(DATE_FORMAT(`post_tanggal`,'%d'),'/',DATE_FORMAT(`post_tanggal`,'%m'),'/',DATE_FORMAT(`post_tanggal`,'%Y'),'/',post_link)  AS post_link");
        if(!empty($post_id)) $this->db->where('post_id !=',$post_id);
        $this->db->where('post_status','Publish');
        $this->db->where('post_jenis','Halaman Dinamis');
        $this->db->where('post_tglpublish < ',date('Y-m-d'));
        $this->db->join('stx_kategori b','a.post_kategori_id=b.kategori_id');
        $this->db->order_by('post_tanggal','DESC');
        $this->db->limit($limit);
        return $this->db->get('trx_post a')->result();
    }

    function terkait($limit,$kategori,$post_id=""){
        $this->db->select("*,CONCAT(DATE_FORMAT(`post_tanggal`,'%d'),'/',DATE_FORMAT(`post_tanggal`,'%m'),'/',DATE_FORMAT(`post_tanggal`,'%Y'),'/',post_link)  AS post_link");
        if(!empty($post_id)) $this->db->where('post_id !=',$post_id);
        $this->db->where('post_kategori_id',$kategori);
        $this->db->where('post_status','Publish');
        $this->db->where('post_jenis','Halaman Dinamis');
        $this->db->where('post_tglpublish < ',date('Y-m-d'));
        $this->db->join('stx_kategori b','a.post_kategori_id=b.kategori_id');
        $this->db->order_by('post_tanggal','DESC');
        $this->db->limit($limit);
        return $this->db->get('trx_post a')->result();
    }
    function getPartner(){
        return $this->db->get("stx_partner")->result();
    }

    
    function hitPost($tgl,$link){
		$this->db->query("UPDATE trx_post SET post_statistik=post_statistik+1 WHERE DATE_FORMAT(post_tanggal,'%Y-%m-%d')='$tgl' AND post_link='$link'");
	}
    function hitPage($link){
		$this->db->query("UPDATE trx_post SET post_statistik=post_statistik+1 WHERE post_link='$link'");
	}
    function addHits(){
		$ipaddress = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'IP tidak dikenali';
	    $sekarang=date('Y-m-d');
	    $this->db->where('hit_ip',$ipaddress);
	    $this->db->where('hit_tgl',$sekarang);
	    $row=$this->db->get('trx_hits')->num_rows();
	    if($row>0){
	    	//update jumlah hittrx_hits
	    	$this->db->query("UPDATE trx_hits SET hit_jml=hit_jml+1 WHERE hit_ip='$ipaddress' AND hit_tgl='$sekarang'");
	    }else{
	    	$data=array(
	    		'hit_ip'	=> $ipaddress,
	    		'hit_tgl'	=> $sekarang,
	    		'hit_jml'	=> 1
	    	);
	    	$this->db->insert('trx_hits',$data);
	    	//Insert jml Hits
	    }
	}
    function get_post($post_tgl, $link){
        $sekarang=date('Y-m-d');
        
        $this->db->where("DATE_FORMAT(post_tanggal, '%Y-%m-%d')='$post_tgl'");
        $this->db->where('post_link',$link);
        $this->db->where('post_status','Publish');
        $this->db->where('post_jenis','Halaman Dinamis');
        $this->db->where('post_tglpublish <=',$sekarang);
        return $this->db->get('trx_post')->row();
    }
    function get_halaman($link){
        $this->db->where("post_link",$link);
        $this->db->where('post_status','Publish');
        $this->db->where('post_jenis','Halaman Statis');
        return $this->db->get('trx_post')->row();
    }
    function getBanner(){
		$this->db->where('banner_status',1);
		$this->db->order_by('banner_urut');
		return $this->db->get('stx_banner')->result();
	}
    function getDirectori(){
		$this->db->where('dir_status',1);
		$this->db->where('dir_galery',1);
		$this->db->order_by('dir_id','desc');
		return $this->db->get('stx_direktori')->result();
    }
    function getGalery($direktori=""){
        $this->db->where('media_dirid',$direktori);
		// $this->db->select('media_namafile');
		$this->db->join('stx_direktori','media_dirid=dir_id');
		$this->db->where('dir_status',1);
		$this->db->where('dir_galery',1);
		$this->db->order_by('media_id','desc');
		return $this->db->get('stx_media')->result();
	} 
    function getVideo($direktori=""){
        $this->db->where('video_katid',$direktori);
		// $this->db->select('media_namafile');
		$this->db->join('stx_kategori_video','video_katid=stx_kategori_video.idx');
		$this->db->order_by('stx_video.idx','desc');
		return $this->db->get('stx_video')->result();
	}
    function getKomentar($post_id){
    	$this->db->where('komentar_status',1);
    	$this->db->where('komentar_postid', $post_id);
    	return $this->db->get('trx_komentar')->result();
    }
    function getPpid($limit, $start = 0, $q = NULL){
        $this->db->join('stx_direktori','dir_id=media_dirid');
            $this->db->order_by('media_id','desc');
            $this->db->where('dir_ppid',1);
            $this->db->group_start();
            $this->db->like('media_keterangan',$q);
            $this->db->or_like('media_namafile',$q);
            $this->db->group_end();
            $this->db->limit($limit, $start);
            return $this->db->get('stx_media')->result();
    }
    
    function countPpid($q){
        $this->db->join('stx_direktori','dir_id=media_dirid');
            $this->db->where('dir_ppid',1);
            $this->db->group_start();
            $this->db->like('media_keterangan',$q);
            $this->db->or_like('media_namafile',$q);
            $this->db->group_end();
            $this->db->from('stx_media');
            return $this->db->count_all_results();
    }

    function getKategori(){
        $this->db->where('post_jenis','Halaman Dinamis');
        $this->db->select("stx_kategori.*");
        $this->db->join('stx_kategori','post_kategori_id=kategori_id');
        $this->db->group_by('post_kategori_id');
        return $this->db->get('trx_post')->result();
    }

    function getKategoriVideo(){
        $this->db->where('kategori_status',1);
        return $this->db->get('stx_kategori_video')->result();
    }
    function getTerbaru($limit=5){
    	$this->db->where('post_jenis','Halaman Dinamis');
    	$this->db->where('post_status','Publish');
    	$this->db->order_by('post_tglpublish','desc');
    	$this->db->limit($limit);
    	return $this->db->get('trx_post')->result();
    }
    function getDownload($limit, $start = 0, $q = NULL, $direktori=""){
        if(!empty($direktori)) {
            $this->db->join('stx_direktori','dir_id=media_dirid');
            $this->db->order_by('media_id','desc');
            $this->db->where('media_dirid',$direktori);
            $this->db->where('dir_download',1);
            $this->db->group_start();
            $this->db->like('media_keterangan',$q);
            $this->db->or_like('media_namafile',$q);
            $this->db->group_end();
            $this->db->limit($limit, $start);
            return $this->db->get('stx_media')->result();
        }else{
            $this->db->where('dir_download',1);
            $this->db->order_by('dir_id','desc');
            $this->db->where('dir_status',1);
            $this->db->like('dir_nama',$q);
            $this->db->limit($limit, $start);
            return $this->db->get('stx_direktori')->result();
        }
    }
    
    function countDownload($q=null,$direktori=""){
        if(!empty($direktori)){
            $this->db->join('stx_direktori','dir_id=media_dirid');
            $this->db->where('dir_download',1);
            $this->db->where('media_dirid',$direktori);
            $this->db->group_start();
            $this->db->like('media_keterangan',$q);
            $this->db->or_like('media_namafile',$q);
            $this->db->group_end();
            $this->db->from('stx_media');
            return $this->db->count_all_results();
        }else{
            $this->db->where('dir_download',1);
            $this->db->where('dir_status',1);
            $this->db->like('dir_nama',$q);
            $this->db->from('stx_direktori');
            return $this->db->count_all_results();
        }
    }
    function getProfile(){
        return $this->db->get('profile')->row();
    }
    function getPostByKategori($id,$limit=4){
        $this->db->where('post_kategori_id',$id);
        $this->db->where('post_status','Publish');
        $this->db->where('post_jenis','Halaman Dinamis');
        $this->db->where('post_tglpublish <= ',date('Y-m-d'));
        $this->db->join('stx_kategori b','a.post_kategori_id=b.kategori_id');
        $this->db->order_by('post_tanggal','DESC');
        $this->db->limit($limit);
        return $this->db->get('trx_post a')->result();
    }
    function jenisZakat(){
        return $this->db->get('stx_jeniszakat')->result();
    }
    function insertKomentar($data){
        $this->db->insert('trx_komentar',$data);
        return $this->db->insert_id();
    }
    function getPostlimit($limit, $start = 0, $q = NULL,$jenis='Halaman Dinamis'){
        $sekarang=date('Y-m-d');
        $this->db->select('post_judul,kategori_nama,post_isi,post_status_komen,post_tanggal,post_link,post_image,post_statistik,post_status,COUNT(komentar_id) AS jml_komentar,post_tglpublish');
        $this->db->join('stx_kategori','kategori_id=post_kategori_id');
        $this->db->join('trx_komentar','komentar_postid=post_id','left');
        $this->db->group_start();
        $this->db->order_by('post_tglpublish', 'DESC');
        $this->db->like('post_judul', $q);
        $this->db->or_like('kategori_nama', $q);
        $this->db->or_like('post_isi', $q);
        $this->db->group_end();
        $this->db->where('post_jenis',$jenis);
        $this->db->where('post_status','Publish');
        $this->db->where('post_tglpublish <=',$sekarang);
        $this->db->group_by('post_id');
        $this->db->limit($limit, $start);
        return $this->db->get('trx_post')->result();
    }
    function countPost($q,$jenis="Halaman Dinamis"){
        $this->db->join('stx_kategori','kategori_id=post_kategori_id');
        $this->db->join('trx_komentar','komentar_postid=post_id','left');
        $this->db->group_start();
        $this->db->order_by('post_id', 'DESC');
        $this->db->like('post_judul', $q);
        $this->db->or_like('kategori_nama', $q);
        $this->db->or_like('post_isi', $q);
        $this->db->group_end();
        $this->db->where('post_jenis',$jenis);
        $this->db->where('post_status','Publish');
        $this->db->group_by('post_id');
        return $this->db->get('trx_post')->num_rows();
    }

    function getKategoriByLink($link){
        $this->db->where('kategori_link',$link);
        return $this->db->get('stx_kategori')->row();
    }
}