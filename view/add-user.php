<?php 
$title = 'Add User'; 
include_once 'header.php'; 
?>
      
<?php
require 'formclass.php';
$single = (isset($data['result']['0']))?$data['result']['0']:array();
$fields = array(
'user_id' => array(
        'name' => 'user_id', 
        'type' => 'hidden', 
        'value'=>(isset($single['user_id']))?$single['user_id']:'', 
),    
'username'=> array(
	'label' => 'Username',
	'name' => 'username', 
	'type' => 'text', 
	'value'=>(isset($single['username']))?$single['username']:'',
	'error'=> ''
), 
'password'=> array(
	'label' => 'Password',
	'name' => 'password', 
	'type' => 'text', 
	'value'=>(isset($single['email']))?$single['email']:'',
	'error'=> ''
),
'email'=> array(
	'label' => 'Email',
	'name' => 'email', 
	'type' => 'text', 
	'value'=>(isset($single['email']))?$single['email']:'',
	'error'=> ''
)
); 
?>    
<div>
    <div>
	<?php 
	$user_form = new EshopUpdateForm;
        $user_form->render_form( $fields , array('method' => 'post'));			
        ?>
    </div>
</div>
    
<?php include_once 'footer.php'; ?>
