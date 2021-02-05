<?php include('config.php'); ?>


<?php
session_start();
$string= '';
$info="";
if (!empty($_POST['login']) && !empty($_POST['pass'])) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $paring = "SELECT * FROM users WHERE e_mail=:login AND password=:pass";
    $query = $db_connection->prepare($paring);
    $query->bindParam(':login', $login);
    $query->bindParam(':pass', $pass);
    $query->execute();
    //getting the result
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $result = $query->fetchall();
    if ($result) {
        $_SESSION['user'] = $result[0]['user_name'];
        $_SESSION['usertype'] =$result[0]['user_type'];
        $_SESSION['userID'] =$result[0]['user_id'];
        $info= "You are logged in  as ". $_SESSION['user'] . ". <br> And user type is " . $_SESSION['usertype'];
        header('Location: index.php');
    } else {
        $string= "kasutaja või parool on vale<hr>";
        $info= $paring;
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>My Awesome Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<body>
<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="d-flex justify-content-center form_container">
                <form  action="" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="login" class="form-control input_user" value="" placeholder="email">
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="pass" class="form-control input_pass" value="" placeholder="password">
                    </div>
                    <div class="d-flex justify-content-center mt-3 login_container">
                        <button type="submit" name="button" class="btn login_btn">Login</button>
                    </div>
                </form>
            </div>

            <div class="mt-4">
                <div class="d-flex justify-content-center links">
                    <span><?php echo $info ."<hr>" . $string?><span/>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>


