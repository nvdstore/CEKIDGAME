<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

	public function getSetting()
    {
        $q = $this->db->get_where('setting_web',['id_setting' => 1])->row();

        return $q;
    }

}
