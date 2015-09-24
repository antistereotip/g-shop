<?php

class MainController {
    
    public $settings;
    function __construct() {
        global $settings;
        $this->settings = $settings;

    }
    
    function render($template = '', $data = ''){
        include_once  $template.'.php';
    }
    
    function submit(){
        
    }
    
    function submit_validate(&$fields,$values){
        $found_error = false; 
        foreach($fields as $key=>$field) {
           if(isset($values[$key])) {
              $fields[$key]['value'] = $values[$key];
           }else{
                if(isset($fields[$key]['required']) && $fields[$key]['required']==true){
                  $found_error = true;
                   $fields[$key]['error'] = 'this field is required';
                }    
            }
   
        }
        if($found_error==true){
                return false;
           }else{
           return true;
        }
        if($found_error == false){
           return true;  
        }
    }
    

    function get_message(){
        if(isset($_SESSION['message'])){
            $this->data['message'] = $_SESSION['message'];
            unset($_SESSION['message']);
        }
    }


    function set_message($message, $type = 'info'){
        $this->data['message'][]['message'] = $message;
        $this->data['message'][]['type'] = $type;
        $_SESSION['message'][] = array(
            'message' => $message,
            'type' => $type
               
        );
    }
    
    
}
