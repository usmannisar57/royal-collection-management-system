<?php
 session_start();
if(!isset($_SESSION['user'])) header('location: login.php');
$_SESSION['table'] ='shop'; 
 $user = $_SESSION['user'];
//  $product = include('database/show-product.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC Add SHOP</title>
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
                            <h1 class="section_header"><i class="fa-solid fa-store"></i> ADD shop</h1>
                            <div id="userAddFormContainer">
                                    <form action="database/add.php" method="POST" class="appForm"  >
                                        <div class="appFormInputContainer">
                                            <label for="s_id"> Shop Id </label>
                                            <input type="int" class="appFormInput" id="s_id" name="s_id" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="s_name"> Shop Name </label>
                                            <input type="text" class="appFormInput" id="s_name" name="s_name" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="s_number"> Shop Phone Number </label>
                                            <input type="int" class="appFormInput" id="s_number" name="s_number" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="s_loc"> Shop Location </label>
                                            <input type="text" class="appFormInput" id="s_loc" name="s_loc" />
                                        </div>
                                        

                                        <!-- <input type="hidden" name="table" value="login_info" /> -->
                                        <button type="submit" class="appBTn"> <i class="fa fa-store"></i> Add Shop</button>
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