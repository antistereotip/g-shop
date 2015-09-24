<?php 
$title = 'Users List'; 
include_once 'header.php'; 
?>

<table>
<thead>
<tr>
<th>User ID</th>
<th>Username</th>
<th>Password</th>
<th>Email</th>           
<th>Actions</th>
</tr>
</thead>
    
<tbody>
<?php 
$list = $data['result'];
    foreach ($list as $item) {
	$item = (array)$item;
	echo '<tr>';
	echo '<td>' . $item['user_id'] . '</td>'; 
	echo '<td>' . $item['username'] . '</td>'; 
    echo '<td>' . $item['password'] . '</td>'; 
    echo '<td>' . $item['email'] . '</td>';    
    echo '<td width=250>';
	echo '<a class="btn" href="users-list.php?id='.$item['user_id'].'">Read</a>';
    echo '&nbsp;';
    echo '<a class="btn btn-success" href="users.php?edit=user&id='.$item['user_id'].'">Update</a>';
	echo '&nbsp;';
	echo '<a class="btn btn-danger" href="users.php?list=user&action=delete&id='.$item['user_id'].'&type=user">Delete</a>';
	echo '</td>';
	echo '</tr>';
    }		 
?>
</tbody>
</table>
      
<?php include_once 'footer.php'; ?>
