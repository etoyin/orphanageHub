<?php

    class Admin_model extends CI_Model{
        function __construct() {
            parent::__construct();
        }

        public function form_insert($data){
            $this->db->insert('admin', $data);
            return true;
        }

        public function can_login($data)
        {
            $this->db->where('username', $data['username']);
            $query = $this->db->get('admin');
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $row)
                {
                    $store_password = $this->encrypt->decode($row->password);
                    if($data['password'] == $store_password)
                    {
                        $this->session->set_userdata('adminId', $row->id);
                    }
                    else
                    {
                        return 'Wrong Password';
                    }
                }
            }
            else
            {
                return 'Wrong username';
            }
        }
    }
?>