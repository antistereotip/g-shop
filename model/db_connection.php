<?php


include_once('settings.php');
 class updateMainModel extends PDO { 
    
    private $engine; 
    private $host; 
    private $database; 
    private $user; 
    private $pass; 
    public  $packages;
    public  $package;
    public function __construct(){ 
    
    global $settings;
    if(!isset($settings['db_database']) && !isset($settings['db_user']) && !isset($settings['db_pass'])){
	echo 'no database parameters set!';
	exit;
	}
        $this->packages = array();
	    $this->users = array();
        $this->engine = (isset($settings['db_engine']))?$settings['db_engine']:'mysql'; 
        $this->host = (isset($settings['db_host']))?$settings['db_host']:'localhost'; 
        $this->database = $settings['db_database']; 
        $this->user = $settings['db_user']; 
        $this->pass = $settings['db_pass']; 
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host; 
        try{
            parent::__construct( $dns, $this->user, $this->pass ); 	
            }catch(PDOException $ex) {
		echo "An Error occured!"; //user friendly message
		echo $ex->getMessage();
		return false;
		}
       
    }  
}

global $mainModel;
$mainModel = new updateMainModel;
$mainModel->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
