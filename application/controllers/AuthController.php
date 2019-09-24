<?php

class AuthController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function logout(){
        unset($_SESSION);
        session_destroy();
        redirect('AuthController/login' ,"refresh");
    }

    public function login()
    {   
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required|min_length[5]');
        if($this->form_validation->run()==TRUE){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $this->db->select("*"); 
            $this->db->from("users");
            $this->db->where(array('email'=>$email,'password'=>$password));
            $query = $this->db->get();
            $resul  = $query->row();
            if($resul->email) {     
                $this->session->set_flashdata('success',"You are logged in");
                $_SESSION['usser_logged'] = TRUE;
                $_SESSION['username'] = $resul->email;
                redirect("Usercontroller/profile", "refresh");          
            }else {
                $this->session->set_flashdata('error',"no such acoount exists in database");
                    redirect("Authcontroller/login","refresh");
                }


        }      

        $this->load->view('login');
      

    }
    public function register()
    {
        if(isset($_POST['register'])){
            $this->form_validation->set_rules('name','Name','required');
            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('password','Password','required|min_length[5]');
            if($this->form_validation->run()==TRUE){
                $data = array(
                    'Name' => $_POST['name'],
                    'email' =>$_POST['email'],
                    'password' => $_POST['password']
                );
                $this->db->insert('users',$data);
                $_SESSION['message_type']  = 'success';
                $this->session->set_flashdata('success','Your account has been registered.');
                redirect('AuthController/register',"refresh");
            }
        }
        $this->load->view('register');
    }
}   