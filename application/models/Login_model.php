<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

   public function cek_user($data) {
            $query = $this->db->get_where('admin', $data);
            return $query;
        }



        public function cek_mahasiswa($data_mhs) {
            $query = $this->db->get_where('mahasiswa', $data_mhs);
            return $query;
        }



 public function cek_dpam($data_dpam) {
            $query = $this->db->get_where('dpam', $data_dpam);
            return $query;
        }



}
/* End of file login_model.php */
/* Location: ./application/models/login_model.php */