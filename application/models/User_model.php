<?php

    class User_model extends CI_Model{
        function __construct() {
            parent::__construct();
        }

        public function form_insert($data){
            $this->db->insert('orphanages_users', $data);
            return true;
        }

        public function email_exists($data){
            $this->db->where('email',$data);
            $query = $this->db->get('orphanages_users');
            if ($query->num_rows() > 0){
                return true;
            }
            else{
                return false;
            }
        }

        public function can_login($data)
        {
            $this->db->where('email', $data['email']);
            $query = $this->db->get('orphanages_users');
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $row)
                {
                    if($row->email_verified)
                    {
                        $store_password = $this->encrypt->decode($row->password);
                        if($data['password'] == $store_password)
                        {
                            $this->session->set_userdata('id', $row->id);
                        }
                        else
                        {
                            return 'Wrong Password';
                        }
                    }
                    else
                    {
                        return 'First verify your email address';
                    }
                }
            }
            else
            {
                return 'Wrong Email Address';
            }
        }
    }
?>