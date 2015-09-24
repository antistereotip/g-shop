<?php
include_once ('model/users.model.php');
include_once ('main_controller.php');

class UsersController extends MainController {
    public  $users_model;
    public  $data;
    function __construct() {
        parent::__construct();
        $this->users_model = new UsersModel;
        $this->fields = $this->users_model->fields;
        $this->submit(); 
        $this->delete();
        $this->view();  
        $this->edit(); 
        $this->add();
    }

    function create (){
        $package = array();
        foreach($this->fields as $key => $field){
            if(!empty(filter_input(INPUT_POST,$key))){
              $package[$key] = filter_input(INPUT_POST,$key);    
            }
        }
        if($this->submit_validate($this->fields, $package)){
         $this->users_model->create($package);   
        }
        
    }
    
    function view (){
        $list_type = filter_input(INPUT_GET,'list');
        if (!empty($list_type) && $list_type=='users') {
            $this->data['result'] = $this->users_model->getUsers();	
            if ($this->data['result'])
            $this->render( 'view/users-list', $this->data);
        }	
    }
    
    function update(){
        $package = array();
        foreach($this->fields as $key => $field){
            if(!empty(filter_input(INPUT_POST,$key))){
              $package[$key] = filter_input(INPUT_POST,$key);    
            }
        }
        if($this->submit_validate($this->fields, $package)){
         $this->users_model->update($package);   
        }
    }
    
    function submit(){
        $id = filter_input(INPUT_POST,'user_id');
        if(!empty($id)){
            $this->update();
        }
        if(empty($id)) {
            $this->create();
        }
    }
    
    function add(){
        $add = filter_input(INPUT_GET,'add'); 
        if(!empty($add) && $add == 'user'){                 
              $this->render( 'view/add-user', $this->data);   
        }
    }
    

    function edit(){
        $id = filter_input(INPUT_GET,'id');
        $edit = filter_input(INPUT_GET,'edit');
        $name = filter_input(INPUT_GET,'username');
        if(!empty($edit) && $edit == 'user'){
   	    $result = $this->data['result']; 
        if(!empty($name)) {
            $result = $this->users_model->get_single($name,'username');            
        } elseif (!empty($id)) {
            $result = $this->users_model->get_single($id);  
        }
        if (isset($result) && $result) {
                $this->data['result'] = $result;
                $this->render( 'view/edit-user', $this->data);
            }    
        }
    }
    

 
    function delete (){
	$action = filter_input(INPUT_GET,'action');
	$type = filter_input(INPUT_GET,'type');
	$user_id = filter_input(INPUT_GET,'id');
	if($action=='delete' && $type == 'user' && !empty($user_id)){
		$this->users_model->delete($user_id);
                header('Location: users.php?list=users');
	}
        
    }
    
    
    
}

$users = new UsersController;
