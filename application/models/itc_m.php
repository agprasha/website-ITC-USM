<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Itc_m extends CI_Model {
		private $t_user = 'user';
		
		private $add_soal = 'soal';
		
		function __construct() {
			parent ::__construct();
			//$this->load->library(array('database'));
			
		}
		
		
		function register($data){
        $this->db->insert($this->t_user, $data);
    	}
 		
 		
 		function ujian($soal){
			$this->db->insert($this->add_soal, $soal);
		}
	    function login($username, $password, $status){
	        $data = $this->db
	        		->where(array('username' => $username, 'password' => md5($password),'status' => $status))
	                ->get($this->t_user);
	 		
				
	        //dicek
	        
	        if ($data->num_rows() > 0){
	            $user = $data->row();
					
				
	            //data hasil seleksi dimasukkan ke dalam $session
	            $session = array(
	                
	                'logged_in' => 1,
	                'id_user' => $user->id_user,
	                'username' => $user->username,
	                'nama' => $user->nama,
	                'nim' => $user->nim,
	                'hp' => $user->hp,
	                'bbm' => $user->bbm,
	                'level' => $user->level
	            );
	 
	            //data dari $session akhirnya dimasukkan ke dalam session (menggunakan library CI)
	            $this->session->set_userdata($session);
	            return true;
	            
	        }
	        else{
	            $this->session->set_flashdata('notification', 'Username dan Password tidak cocok/ belum di konfirmasi Admin');
	            return false;
	        }
	    }
	
	function member($nama, $nim, $tmp_lhr, $tgl_tgl, $tmp_skg, $slamat, $hp, $bbm, $email){
	        $list = $this->db->where(array('nama' => $nama, 'nim' => $nim, 'tmp_lhr' =>  $tmp_lhr, 'tgl_lhr' =>  $tgl_tgl, 'tmp_skg' =>  $tmp_skg, 'alamat' =>  $alamat, 'hp' =>  $hp, 'bbm' =>  $bbm, 'email' =>  $email))
	        		
	                ->get($this->t_user);
	                return $list;
	                }
	 
	 function cekmember($where = ''){
	// $list = array('nama'=>'testttt nama');
	 //$list = $this->db->query("select * from user");
	 //$data = mysql_fetch_array($list);
	          	        
	 return $this->db->query("select * from user $where");
	 
	 }
	 
    function logout(){
        $this->session->sess_destroy();
    }
	}
	

	