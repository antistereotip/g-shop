<?php
include_once('db_connection.php');
//never include_once ('controller');


class UsersModel extends updateMainModel {
       
    public function __construct(){ 
        parent::__construct();
        $this->fields = $this->fields();
    }
    public function fields(){
        return array(
            'user_id' => array(
                    'user_id' => 'user_id', 
                    'type' => 'hidden', 
                    'value'=> '',   
            ),
            'username'=> array(
                    'username' => 'UserName',
                    'name' => 'username', 
                    'type' => 'text', 
                    'error'=> ''
            ),   
            'password'=> array(
                    'label' => 'Password',
                    'password' => 'password', 
                    'type' => 'text', 
                    'error'=> ''
            ),   
            'email'=> array(
                    'label' => 'Email',
                    'email' => 'email', 
                    'type' => 'text',                   
                    'error'=> ''
            )
        ); 
        
    }


    public function getUsers(){				
	   $q = $this->query("SELECT * FROM eusers");
	   $q->execute();
	   return $q->fetchAll();
    }
    
    public function create($user){
	   if(empty($user))
	   return false;
	   $sql = "INSERT INTO eusers (username, password, email) VALUES (:username, :password, :email)";
            try {
            $q = $this->prepare($sql);
            $q->execute(array(
		      ':username'=> $user['username'], 
		      ':password'=> $user['password'], 
              ':email'=> $user['email']
            )
            );
        return;
        }catch(PDOException $ex) {
		echo "An Error occured!"; //user friendly message
		echo $ex->getMessage();
		return false;
		}
    }

   
    public function delete($user_id){                
  	    $q = $this->prepare("DELETE FROM eusers WHERE user_id = :user_id");
        $q->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        return $q->execute();
    }
	
    public function update($user) {
        $sql= "UPDATE eusers SET username = :username, password = :password, email = :email WHERE user_id = :user_id";
        $q = $this->prepare($sql);
	    $q->bindParam(':username', $user['username'], PDO::PARAM_STR);
        $q->bindParam(':password', $user['password'], PDO::PARAM_STR);
        $q->bindParam(':email', $user['email'], PDO::PARAM_STR);
           
        $q->bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
        $q->execute();
    }
        
        
    public function get_single($value , $type = 'id') {
        if($type == 'id'){
            $sql= "SELECT * FROM eusers WHERE user_id = $value";
        }
        if($type == 'username'){
            $sql = "SELECT * FROM eusers WHERE username = '$value'";            
        }
        $q = $this->query($sql);
        $row = $q->fetchAll();
            return $row;
    }        
        
 


}
