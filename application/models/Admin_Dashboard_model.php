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



        function cat_exists($data){
            $this->db->where('cat_name',$data);
            $query = $this->db->get('categories');
            if ($query->num_rows() > 0){
                return true;
            }
            else{
                return false;
            }
        }


        public function getCat()
        {
            $query = $this->db->query("SELECT * FROM categories");
            $result=$query->result();
            return array("all_data" => $result);
        }

        public function getAllBlog()
        {
            $query = $this->db->query("SELECT * FROM blog_table");
            $result=$query->result();
            return array("all_data" => $result);
        }
        public function getByCat($cat_name)
        {
            $query = $this->db->query("SELECT * FROM blog_table WHERE category=\"$cat_name\"");
            $result=$query->result();
            return array("all_data" => $result);
        }

        public function getById($id)
        {
            $query = $this->db->query("SELECT * FROM blog_table WHERE id=\"$id\"");
            $result=$query->result();
            return array("all_data" => $result);
        }


        public function insert_blog_post($data, $pin)
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
                        $this->db->insert('blog_table', $data);
                    }
                    else
                    {
                        return "You're not authorized to post blog!";
                    }
                }
            }
            else
            {
                return 'Invalid';
            }
        }

        public function insert_category($data, $pin)
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
                        if ($this->cat_exists($data['cat_name'])){
                            return 'Category Already Exists, Enter another!';
                        }
                        else{
                            $this->db->insert('categories', $data);
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