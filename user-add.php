<?php
 session_start();
if(!isset($_SESSION['user'])) header('location: homepage.php');
$_SESSION['table'] ='login_info'; 
 $user = $_SESSION['user'];
 $login_info = include('database/show-users.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC add User</title>
    <?php include('partials/app-header-script.php'); ?>
</head>
<body>
    <div id="dashboardMainContainer">
       <?php include('partials/app-sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
         <?php include('partials/app-topnav.php') ?>          
         <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <div class="row">
                        <div class="column column-5">
                            <h1 class="section_header"><i class="fa-solid fa-user-plus"></i> Create User</h1>
                            <div id="userAddFormContainer">
                                    <form action="database/add.php" method="POST" class="appForm"  >
                                        <div class="appFormInputContainer">
                                            <label for="name"> NAME </label>
                                            <input type="text" class="appFormInput" id="name" name="name" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="id"> ID </label>
                                            <input type="text" class="appFormInput" id="id" name="id" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="password_"> PASSWORD </label>
                                            <input type="password" class="appFormInput" id="password_" name="password_" />
                                        </div>

                                        <!-- <input type="hidden" name="table" value="login_info" /> -->
                                        <button type="submit" class="appBTn"> <i class="fa-solid fa-user-tie"></i> Add User</button>
                                    </form>
                                    <?php
                                    if(isset($_SESSION['response'] ))
                                    {
                                        $response_message = $_SESSION['response']['message'];
                                        $is_success = $_SESSION['response']['success'];
                                    ?>
                                    <div class="responseMessage">
                                        <p class="responseMessage <?= $is_success ? 'responseMessage_success' : 'responseMessage_error' ?>">
                                        <?= $response_message ?>
                                    </p>
                                    </div>
                                    <?php unset($_SESSION['response']);}?>


                            </div>                    
                        </div>
                    </div>
                    
                </div>
         </div>
        </div>
    </div>
    <?php include('partials/app-script.php'); ?>

</body>
</html>