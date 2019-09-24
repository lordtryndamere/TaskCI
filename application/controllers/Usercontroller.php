<?php


class Usercontroller extends CI_Controller
{
    public function profile(){
       


        if(isset($_POST['save_task'])){
            $this->form_validation->set_rules('title','Title',"required");  
            $this->form_validation->set_rules('description','Description',"required");
            if($this->form_validation->run()==TRUE){
                $data = array(
                    'title'=> $_POST['title'],
                    'description' => $_POST['description']
                );
                }

                $this->db->insert('tasks',$data);
                $_SESSION['message'] = 'Task Saved succesfully';
                $_SESSION['message_type'] = 'success';
                redirect("Usercontroller/profile" ,"refresh" );
            



        }
        
        $this->load->view('profileView');
    }
    
    public function delete(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $this->db->delete('tasks', array('id' => $id));
            $_SESSION['message'] = 'Taks Removed Successfully';
            $_SESSION ['message_type'] = 'danger';
            redirect("Usercontroller/profile","refresh");

        }
    }

    public function edit(){

        if(isset($_POST['update'])){
            $id = $_GET['id'];
            $titulo = $_POST['title'];
            $descripcion = $_POST['description'];
            $data = array('id'=>$id,'title'=>$titulo,'description'=>$descripcion);
            $this-> db->update('tasks',$data);
            $_SESSION['message'] = 'Task Updated Succesfully';
            $_SESSION['message_type'] = 'info';
            redirect('Usercontroller/profile',"refresh");
            }

           $this->load->view('EditView');
    }

}


