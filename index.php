<?php include('config.php'); ?>
<?php include('functions.php'); ?>
<?php
session_start();
$logiV = "";
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
if(isset($_POST['mySubmit'])){
    session_destroy();
    header('Location: login.php');
    exit();
}


?>
    <!doctype html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Stat API Report">
        <meta name="author" content="Martin Mõtsar">
        <title>Stat api report</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    <header id="pais">
        <h1>Veebirakenduste turvalisus!</h1>
        <menu>
            <a href="index.php">Avaleht</a> |
            <a href="index.php?leht=seaded">Seaded</a> |
            <?php if($_SESSION['usertype']==='admin'){echo '<a href="index.php?leht=admin">Admin</a>';}?>
            <form action="" method="post">
                <input id="mySubmit" name="mySubmit" type="submit" value="LogOff" class="btn btn-default navbar-btn"/>
            </form>
        </menu>
        <?php echo 'You are logged in as :'.$_SESSION['usertype'];?>
    </header>

    <div id="sisu">


        <?php
        $dirName = dirname(dirname(__FILE__) . ".." . DIRECTORY_SEPARATOR);
        $dirName = str_replace('\\', "/", $dirName);
        $base = str_replace($_SERVER['DOCUMENT_ROOT'], "", $dirName);
        echo $base;

        if(!empty($_GET['leht'])){
            $leht = htmlspecialchars($_GET['leht']);
            $lubatud = array('seaded','admin');
            $kontroll = in_array($leht, $lubatud);
            if(is_file($leht.'.php')){
                include($leht.'.php');
            } else {
                echo 'Valitud lehte ei eksisteeri!';
            }
        } else {

            if(isset($_POST['Add_Comment'])){
                $comment =$_POST['Add_Comment'];
                $userName = $_SESSION['user'];
                $userId = $_SESSION['userID'];
                $insertCommentReq = "INSERT INTO comments (text,user_name,user_id) VALUES ('$comment','$userName','$userId')";
                $sendCommentToDB = mysqli_query($yhendus, $insertCommentReq);
            }

            $getCommentsReq = "SELECT * FROM comments";
            $valjund = mysqli_query($yhendus, $getCommentsReq);
            ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="comments">
                        <div class="comment-box add-comment">
                            <span class="commenter-pic">
                              <img src="https://www.flaticon.com/svg/static/icons/svg/21/21104.svg" class="img-fluid">
                            </span>
                            <span class="commenter-name">
                                <form id="commentForm" action="" method="post">
                                    <textarea form="commentForm" placeholder="Sisesta siia tekst" name="Add_Comment"></textarea>
                                    <button type="submit" class="btn btn-default">Comment</button>
                                </form>
                            </span>
                        </div>
                        <?php while($rida = mysqli_fetch_assoc($valjund)){
                            echo '<div class="comment-box">
                                <span class="commenter-pic">
                                    <img src="https://www.flaticon.com/svg/static/icons/svg/21/21104.svg" class="img-fluid">
                                </span>
                                <span class="commenter-name">
                                    <a href="#">'.htmlspecialchars($rida['user_name']).'</a> <span class="comment-time">'.htmlspecialchars($rida['time']).'</span>
                                </span>
                                <p class="comment-txt more">'.htmlspecialchars($rida['text']).'</p>
                                <div class="comment-meta">
                                    <button class="comment-like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>'?><?php if($rida["likes"]!=NULL){echo $rida["likes"];} echo '</button>
                                    <button class="comment-dislike"><i class="fa fa-thumbs-o-down" aria-hidden="true">'?><?php if($rida["dislikes"]!=NULL){echo $rida["dislikes"];} echo'</i></button>
                                </div>
                            </div>';
                        }?>

                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        ?>
    </div>
    <div class="push"></div>
    </body>
    <footer id="jalus">
        <p>No kopirait</p>
    </footer>
    <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
        crossorigin="anonymous"></script>
    </html>
<?php
