<?php
 session_start();
if(!isset($_SESSION['user'])) header('location: login.php');
$_SESSION['table'] ='customer'; 
 $user = $_SESSION['user'];
//  $product = include('database/show-product.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC Add order</title>
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
                            <h1 class="section_header"><i class="fa-solid fa-cart"></i> ADD Order</h1>
                            <div id="userAddFormContainer">
                                    <form action="database/add.php" method="POST" class="appForm"  >
                                        
                                        <div class="appFormInputContainer">
                                            <label for="customer_name"> Customer Name </label>
                                            <input type="text" class="appFormInput" id="customer_name" name="customer_name" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="phone_number"> Phone number </label>
                                            <input type="text" class="appFormInput" id="phone_number" name="phone_number" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="address"> ADDRESS </label>
                                            <input type="text" class="appFormInput" id="address" name="address" />
                                        </div>
                                        
                                        

                                        <!-- <input type="hidden" name="table" value="login_info" /> -->
                                        <button type="submit" class="appBTn"> <i class="fa fa-user"></i> Add Customer</button>
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