<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_duser extends CI_Model
{
    public function jmldel($user)
    {


        $query = $this->db->get_where('lpj', array('show_item' => 0, 'created_by' => $user));
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function jmladd($user)
    {

        $query = $this->db->get_where('lpj', array('show_item' => 1, 'created_by' => $user));
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
}
