
<h2>Change your password!</h2>
<?php
$errMess='';
if(isset($_POST['newPassword1']) and isset($_POST['newPassword2'])){
    if(checkNewPassword($_POST['newPassword1'], $_POST['newPassword2'])==true){
        $newPass = htmlspecialchars(trim($_POST['newPassword1']));
        if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST['newPassword1']) === 0) {
            $errMess = '<span style="color: red">Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit</span>';
        }else{
            $password = $_POST['newPassword1'];
            changePassword($yhendus, $newPass);
        }
    }else{
        $errMess = '<span style="color: red">Password are not equal!</span>';;
    }
}
?>

<form action="" method="post">
    <label for="newPassword1">Enter new password:</label><br>
    <input type="password" name="newPassword1" id="newPassword1"><br>
    <label for="newPassword2">Enter new password:</label><br>
    <input type="password" name="newPassword2" id="newPassword2"><br><br>
    <input type="submit"><br><br>
</form>
<?php echo $errMess ?>

<hr>s