<?php

    class User_model extends CI_Model{
        function __construct() {
            parent::__construct();
        }

        public function form_insert($data){
            $this->db->insert('orphanages_users', $data);
            return true;
        }

        public function getAllEvents()
        {
            $query = $this->db->query("SELECT * FROM events");
            $result=$query->result();
            return array("all_data" => $result);
        }

        public function event_insert($data){
            $this->db->insert('events', $data);
            return true;
        }

        public function comments_insert($data){
            $this->db->insert('comments', $data);
            return true;
        }

        public function reply_insert($data)
        {
            $this->db->insert('reply_table', $data);
            return true;
        }

        // UPDATE `images` SET `orphanage_id` = '13' WHERE `images`.`id` = 2;
        public function getAllOrphanage()
        {
            $query = $this->db->query("SELECT orphanages_users.id, name, email, phone_number, open_for_adoption, 
                                            verified, mission_statement, country, address, boys, girls, owner, 
                                            location, cover_photo FROM orphanages_users");
            $result=$query->result();
            return array("all_data" => $result);
        }

        public function getAllOrphanageByCountry($country)
        {
            $query = $this->db->query("SELECT orphanages_users.id, name, email, phone_number, open_for_adoption, 
                                            verified, mission_statement, country, address, boys, girls, owner, 
                                            location, cover_photo FROM orphanages_users WHERE country = \"$country\"");
            $result=$query->result();
            return array("all_data" => $result);
        }

        public function update_data($id, $column_name, $field_to_be_updated)
        {
            if($this->db->query("UPDATE orphanages_users as a SET a.$column_name=\"$field_to_be_updated\" WHERE id=$id")){
                $data['success'] = 1;
                $data['message'] = "Successful";
            }
            else{
                $data['success'] = 0;
                $data['message'] = "Failed";
            }
            return $data;
        }

        public function getOneOrphanage($id)
        {
            $query = $this->db->query("SELECT * FROM orphanages_users WHERE id=$id");
            $result=$query->result();
            return $result;
        }
        public function getOneComment($id)
        {
            $query = $this->db->query("SELECT * FROM comments WHERE id=$id");
            $result=$query->result();
            foreach ($result as $key=>$value) {
                $query2 = $this->db->query("SELECT * FROM reply_table WHERE comment_id=$value->id");
                $result[$key]->replies = $query2->result();
            }
            return $result;
        }
        public function getCommentsbyId($id)
        {
            $query = $this->db->query("SELECT * FROM comments WHERE orphanage_id=$id");
            $result=$query->result();
            foreach ($result as $key=>$value) {
                $query2 = $this->db->query("SELECT * FROM reply_table WHERE comment_id=$value->id");
                $result[$key]->replies = $query2->result();
            }
            return $result;
        }

        public function getVerifiedOrphanageByCountry($country)
        {
            $query = $this->db->query("SELECT orphanages_users.id, name, email, country, phone_number, open_for_adoption, 
                                            verified, mission_statement, address, boys, girls, owner, 
                                            location, cover_photo FROM orphanages_users WHERE (verified = 1 AND country = \"$country\")");
            $result=$query->result();
            return array("all_data" => $result);
        }
        public function getVerifiedOrphanage()
        {
            $query = $this->db->query("SELECT orphanages_users.id, name, email, country, phone_number, open_for_adoption, 
                                            verified, mission_statement, address, boys, girls, owner, 
                                            location, cover_photo FROM orphanages_users WHERE verified = 1");
            $result=$query->result();
            return array("all_data" => $result);
        }

        public function getUnVerifiedOrphanage()
        {
            $query = $this->db->query("SELECT orphanages_users.id, name, email, country, phone_number, open_for_adoption, 
                                            verified, mission_statement, address, boys, girls, owner, 
                                            location, cover_photo FROM orphanages_users WHERE verified = 0");
            $result=$query->result();
            return array("all_data" => $result);
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

        public function open_for_adoption($id, $open)
        {
            $data['id'] = $id;
            $data['open_for_adoption'] = $open;
            if($this->db->query("UPDATE orphanages_users SET open_for_adoption=$open WHERE id=$id")){
                $data['success'] = 1;
                $data['message'] = "Successful";
            }
            else{
                $data['success'] = 0;
                $data['message'] = "Failed";
            }
            return $data;
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


        function verify_email($key)
        {
            $this->db->where('verification_key', $key);
            $this->db->where('email_verified', 0);
            $query = $this->db->get('orphanages_users');
            if($query->num_rows() > 0)
            {
                $this->db->query("UPDATE orphanages_users SET email_verified=1 WHERE verification_key=\"$key\"");
                return true;
            }
            else
            {
                return false;
            }
        }
    }
?>