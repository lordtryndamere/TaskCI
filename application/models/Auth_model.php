<?php

class Auth_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }
    public function getUser () 
    {
        return $this->db->query("SELECT  email,password FROM users")->result();
    }
    
}