<?php
 session_start();
if(!isset($_SESSION['user'])) header('location: homepage.php');
$_SESSION['table'] ='transsaction'; 
 $user = $_SESSION['user'];
 $transsaction = include('database/show-transaction.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC View Transaction</title>
    <?php include('partials/app-header-script.php'); ?></head>
<body>
    <div id="dashboardMainContainer">
       <?php include('partials/app-sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
         <?php include('partials/app-topnav.php') ?>          
         <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <div class="row">
                    
                        <div class="column cloumn-7">
                            <h1 class="section_header"><i class="fa-solid fa-list"></i> List of transactions</h1>
                            <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order Id</th>
                                                <th>Product Id</th>
                                                <th>Shop Id</th>
                                                <th>Emloyee Id</th>
                                                <th>Profit</th>
                                                <th>Remaining Quantity</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($transsaction as $index => $user) {?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td class="order_id"><?= $user['order_id']?></td>
                                                <td class="p_id"><?= $user['p_id']?></td>
                                                <td class="s_id"><?= $user['s_id']?></td>
                                                <td class="emp_id"><?= $user['emp_id']?></td>
                                                <td class="profit"><?= $user['profit']?></td>
                                                <td class="r_quantity"><?= $user['r_quantity']?></td>

                                                <td>
                                                   
                                                    <a href="" class="deletetransaction" data-orderid="<?= $user['order_id'] ?>"  data-pid="<?= $user['p_id'] ?>" data-sid="<?= $user['s_id'] ?>" data-empid="<?= $user['emp_id'] ?>" data-profit="<?= $user['profit'] ?>" data-rquantity="<?= $user['r_quantity'] ?>" ><i class="fa-solid fa-user-minus"></i> Delete</a>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                        <!-- <p class="UserCount"><?= count($transsaction) ?> Users </p> -->
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>
         </div>
        </div>
    </div>
    <?php include('partials/app-script.php'); ?>

<script>
    function script(){
           
        this.initialize = function(){
            this.registerEvents();
        }

        this.registerEvents = function(){
            document.addEventListener('click',function(e){
                targetElement = e.target;
                classList = targetElement.classList;
                if(classList.contains('deletetransaction')){
                    e.preventDefault();
                    orderid = targetElement.dataset.orderid;
                    pid = targetElement.dataset.pid;
                    sid = targetElement.dataset.sid;
                    empid = targetElement.dataset.empid;
                    profit = targetElement.dataset.profit;
                    rquantity = targetElement.dataset.rquantity;
                    // cid = targetElement.dataset.cid;
                    // console.log(PId);
                    
                    if(window.confirm('Are you sure to delete ' + orderid + '?')){
                        $.ajax({
                            method: 'POST',
                            data : {
                                orderid : orderid,
                                pid : pid,
                                sid : sid,
                                empid : empid,
                                // cid : cid
                            },
                            url: 'database/delete-transaction.php',
                            dataType: 'json',
                            success: function(data){//error idahr hai
                                            console.log(data);
                                            
                                            if(data.success){
                                                
                                                if(window.confirm(data.message)){
                                                    location.reload();
                                                }
                                                else window.alert(data.message);
                                            }
                            }
                        });
                        

                
                    }
                    else{
                        console.log('will not delete');
                    }
                    
                }
            
                
                
                
                
            });

        }
    }

    var script = new script;
    script.initialize();
</script>  
</body>
</html>