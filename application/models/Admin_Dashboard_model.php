<?php

    class Admin_Dashboard_model extends CI_Model{
        function __construct() {
            parent::__construct();
        }

        // public function form_insert($data){
        //     $this->db->insert('admin', $data);
        //     return true;
        // }

        function admin_exists($data){
            $this->db->where('username',$data);
            $query = $this->db->get('admin');
            if ($query->num_rows() > 0){
                return true;
            }
            else{
                return false;
            }
        }

        public function verify_orphanage($id, $verify)
        {
            $data['id'] = $id;
            $data['verify'] = $verify;
            if($this->db->query("UPDATE orphanages_users SET verified=$verify WHERE id=$id")){
                $data['success'] = 1;
                $data['message'] = "Successful";
            }
            else{
                $data['success'] = 0;
                $data['message'] = "Failed";
            }
            return $data;
        }

        public function getAllAdmin()
        {
            $query = $this->db->query("SELECT id, username FROM admin WHERE type=0");
            $result=$query->result();
            return array("all_data" => $result);
        }

        public function deleteOneAdmin($data)
        {
            $adminId = $this->session->userdata('adminId');
            if (!$adminId){
                return "You have to re-login to perform this task!";
            }
            else{
                $this->db->where('id', $adminId);
                $query = $this->db->get('admin');
    
                if($query->num_rows() > 0)
                {
                    foreach($query->result() as $row)
                    {
                        $store_pin = $this->encrypt->decode($row->pin);
    
                        if($data['pin'] == $store_pin && $row->type)
                        {
                            // if ($this->admin_exists($data['username'])){
                            //     return 'Username Already Exists, Try another!';
                            // }
                            // else{
                            //     $this->db->insert('admin', $data);
                            // }
                            $id = $data['id'];
                            $query = $this->db->query("DELETE FROM admin WHERE id=$id");
                        }
                        else
                        {
                            return "You're not authorized to delete an admin!";
                        }
                    }
                }
                else
                {
                    return 'Invalid';
                }
    
            }

        }

        public function insert_admin($data, $pin)
        {
            $adminId = $this->session->userdata('adminId');

            $this->db->where('id', $adminId);
            $query = $this->db->get('admin');

            if($query->num_rows() > 0)
            {
                foreach($query->result() as $row)
                {
                    $store_pin = $this->encrypt->decode($row->pin);
                    if($pin == $store_pin && $row->type)
                    {
                        if ($this->admin_exists($data['username'])){
                            return 'Username Already Exists, Try another!';
                        }
                        else{
                            $this->db->insert('admin', $data);
                        }
                    }
                    else
                    {
                        return "You're not authorized to do this!";
                    }
                }
            }
            else
            {
                return 'Invalid';
            }
        }
    }
?>