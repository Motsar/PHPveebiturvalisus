<?php
if($_SESSION['usertype']==='admin'){
    echo '
        <h2>Grant access to a new user</h2>
        <form action="" method="post" name="newUserForm">
            <label for="user_name">User name:</label><br>
            <input type="text" name="user_name" id="user_name"><br>
            <label for="user_email">User e-mail:</label><br>
            <input type="email" name="user_email" id="user_email"><br>
            <p>Select user type:</p><br>
            <input type="radio" name="user_perm" id="admin" value="admin">
            <label for="admin">Administrator</label>
            <input type="radio" name="user_perm" id="user" value="user" checked>
            <label for="user">User</label><br><br>
            <input type="submit"><br><br>
        </form>';
}else{
    header('Location: index.php');
}

if(isset($_POST['user_name']) and isset($_POST['user_email']) and isset($_POST['user_perm'])){
    $new_username = $_POST['user_name'];
    $user_t = $_POST['user_email'];
    $user_permissions = $_POST['user_perm'];
    add_user($yhendus, $new_username,$user_t,$user_permissions);
}





?>



