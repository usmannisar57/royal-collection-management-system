<?php
session_start();
if(isset($_SESSION['user'])) header('location: dashboard.php');
$error_message = '';
  if($_POST){
    include('database/connection.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    $query ='SELECT * FROM login_info A WHERE A.id="'. $username .'" AND A.password_="'. $password .'"LIMIT 1';
    $stmt = $conn->prepare($query);
    $stmt->execute();
 //   var_dump($stmt->fetchAll());
   // die;
    if($stmt->rowCount() > 0)
    {
         $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user =$stmt->fetchall()[0];

        
        $_SESSION['user'] =$user;

        header('Location: dashboard.php');
        
    } else $error_message = 'Please Make sure that entered password and username is correct';
       # var_dump($stmt->rowCount());
   # die;
  }

?>
<!DOCTYPE html>
<html>
<head>
    <title>ROYAL COLLECTION</title>
    <link rel="stylesheet" type="text/css" href="css/login.css" >
    <script src="https://kit.fontawesome.com/dbe319d96d.js" crossorigin="anonymous"></script>
</head>
<body id="loginBody">
    <div id="loginBody">
<?php if(!empty($error_message)) { ?>
    <p>Error: <?= $error_message?></p>
    <?php }?>
    <div class="header">
        <div class="homepagecontainerx">
            <a href="homepage.php"><i class="fa-solid fa-house"></i></a>
        </div>
</div>
     <div class="container">
        <div class="loginheader">
            <h1>RCMS</h1>
            <h3>ROYAL COLLECTION MANAGEMENT SYSTEM </h3>
        </div>
        <div class="loginbody">
            <form action="login.php" method="POST">
                <div class="logininput">
                    <label for="">Username</label>
                    <input placeholder="username" name="username" type="text" />
                </div>
                <div class="logininput" >
                    <label for="">password</label>
                    <input placeholder="password" name="password" type="password" />
                </div>
                <div class="loginButton">
                    <button>login</button>
                </div>
            </form>
        </div>
    <!-- </div> -->
</body>

</html>