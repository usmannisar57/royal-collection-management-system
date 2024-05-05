<?php
 session_start();
if(!isset($_SESSION['user'])) header('location: login.php');
$_SESSION['table'] ='product'; 
 $user = $_SESSION['user'];
//  $product = include('database/show-product.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC Add Product</title>
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
                            <h1 class="section_header"><i class="fa-solid fa-tag"></i> ADD Product</h1>
                            <div id="userAddFormContainer">
                                    <form action="database/add.php" method="POST" class="appForm"  >
                                        <div class="appFormInputContainer">
                                            <label for="p_id"> Product Id </label>
                                            <input type="int" class="appFormInput" id="p_id" name="p_id" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="p_name"> product Name </label>
                                            <input type="text" class="appFormInput" id="p_name" name="p_name" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="cost_price"> Cost Price </label>
                                            <input type="int" class="appFormInput" id="cost_price" name="cost_price" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="selling_price"> Selling Price </label>
                                            <input type="int" class="appFormInput" id="selling_price" name="selling_price" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="c_id"> Category Id </label>
                                            <select name="c_id" id="c_id" style=" color : black">
                                                <option value="">Select Category</option>
                                                
                                                <option value="1">Living Room Furniture</option>
                                                <option value="2">Bedroom Furniture</option>
                                                <option value="3">Dining Room Furniture</option>
                                                <option value="4">Home Office Furniture</option>
                                                <option value="5">Garden Furniture</option>
                                                <option value="6">Kids' Furniture</option>
                                                <option value="7">Antique Furniture</option>
                                                <option value="8">Custom Furniture</option>
                                                <option value="9">Furniture Accessories</option>
                                                <option value="10">Office Furniture</option>
                                                <option value="11">Storage Furniture</option>
                                                <option value="12">Mattresses and Bedding</option>
                                            </select>
                                            <!-- <input type="int" class="appFormInput" id="c_id" name="c_id" /> -->
                                        </div>
                                        

                                        <!-- <input type="hidden" name="table" value="login_info" /> -->
                                        <button type="submit" class="appBTn"> <i class="fa fa-tag"></i> Add product</button>
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