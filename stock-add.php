<?php
 session_start();
if(!isset($_SESSION['user'])) header('location: login.php');
$_SESSION['table'] ='stock'; 
 $user = $_SESSION['user'];
//  $employee = include('database/show-employee.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC add Stock</title>
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
                            <h1 class="section_header"><i class="fa-solid fa-cart-plus"></i> Add Stock</h1>
                            <div id="userAddFormContainer">
                                    <form action="database/add.php" method="POST" class="appForm"  >
                                         <div class="appFormInputContainer">
                                            <label for="p_id"> Product ID </label>
                                            <input type="int" class="appFormInput" id="p_id" name="p_id" />
                                        </div>    

                                        <div class="appFormInputContainer">
                                    
                                            <label for="s_id">Shop ID </label>
                                            <input type="int" class="appFormInput" id="s_id" name="s_id" />
                                        </div>
                                        <div class="appFormInputContainer">
                                            <label for="quantity"> Quantity </label>
                                            <input type="text" class="appFormInput" id="quantity" name="quantity" />
                                        </div>
                                        <!-- <input type="hidden" name="table" value="login_info" /> -->
                                        <button type="submit" class="appBTn"> <i class="fa-solid fa-user-tie"></i> Add In Stock</button>
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
                    
                        <div class="column cloumn-7">
                            <h1 class="section_header"><i class="fa-solid fa-list"></i>List of Products</h1>
                            <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Id</th>
                                                <th>Product Name</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            // $_SESSION['table'] ='shop'; 
                                            // $user = $_SESSION['user'];
                                            $product = include('database/show-product.php');
                                            foreach($product as $index => $user) {?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td class="p_id"><?= $user['p_id']?></td>
                                                <td class="p_name"><?= $user['p_name']?></td>
                                                
                                            
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                        <!-- <p class="UserCount"><?= count($product) ?> Users </p> -->
                                </div>
                            </div>

                        </div>
                            
                        <div class="column cloumn-7">
                            <h1 class="section_header"><i class="fa-solid fa-list"></i> List of shop</h1>
                            <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Shop Id</th>
                                                <th>Shop Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            // $_SESSION['table'] ='shop'; 
                                            // $user = $_SESSION['user'];
                                            $shop = include('database/show-shop.php');
                                            foreach($shop as $index => $user) {?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td class="s_id"><?= $user['s_id']?></td>
                                                <td class="s_name"><?= $user['s_name']?></td>
                                                
                                            
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                        <!-- <p class="UserCount"><?= count($shop) ?> Users </p> -->
                                </div>
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