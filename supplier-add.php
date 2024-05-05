<?php
 session_start();
if(!isset($_SESSION['user'])) header('location: login.php');
$_SESSION['table'] ='supplier'; 
 $user = $_SESSION['user'];
//  $product = include('database/show-product.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC Add Supplier</title>
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
                            <h1 class="section_header"><i class="fa-solid fa-store"></i> ADD Supplier</h1>
                            <div id="userAddFormContainer">
                                    <form action="database/add.php" method="POST" class="appForm"  >
                                        <div class="appFormInputContainer">
                                            <label for="sup_id"> Supplier Id </label>
                                            <input type="int" class="appFormInput" id="sup_id" name="sup_id" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="sup_name"> Supplier Name </label>
                                            <input type="text" class="appFormInput" id="sup_name" name="sup_name" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="sup_number"> Supplier Phone Number </label>
                                            <input type="text" class="appFormInput" id="sup_number" name="sup_number" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="sup_loc"> Supplier Location </label>
                                            <input type="text" class="appFormInput" id="sup_loc" name="sup_loc" />
                                        </div>
                                        

                                        <!-- <input type="hidden" name="table" value="login_info" /> -->
                                        <button type="submit" class="appBTn"> <i class="fa fa-store"></i> Add Supplier</button>
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