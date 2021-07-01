<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{
    public function getuser(){

        $query = "SELECT `user`.*, `user_role`.`role`
                    FROM `user` JOIN `user_role`
                    ON `user`.`role_id` = `user_role`.`id` 
                    ORDER BY `user_role`.`id` ASC";

       return $this->db->query($query)->row_array();
    }
}

?>