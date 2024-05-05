<?php
 session_start();
if(!isset($_SESSION['user'])) header('location: homepage.php');
$_SESSION['table'] ='customer'; 
 $user = $_SESSION['user'];
 $customer = include('database/show-customer.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC View Customer</title>
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
                            <h1 class="section_header"><i class="fa-solid fa-list"></i> List of customer</h1>
                            <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                            <tr>
                                                <!-- <th>#</th> -->
                                                <th>Order Id</th>
                                                <th>Customer Name</th>
                                                <th>Customer Number</th>
                                                <th>Customer Address</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($customer as $index => $user) {?>
                                            <tr>
                                                
                                                <td class="order_id"><?= $user['order_id']?></td>
                                                <td class="customer_name"><?= $user['customer_name']?></td>
                                                <td class="phone_number"><?= $user['phone_number']?></td>
                                                <td class="address"><?= $user['address']?></td>
                                                
                                                <td>
                                                    <a href="" class="updatecustomer" data-orderid="<?= $user['order_id'] ?>"  data-cname="<?= $user['customer_name'] ?>" data-pnumber="<?= $user['phone_number'] ?>" data-address="<?= $user['address'] ?>" ><i class="fa fa-pencil"></i> Edit</a>
                                                    <a href="" class="deletecustomer" data-orderid="<?= $user['order_id'] ?>"  data-cname="<?= $user['customer_name'] ?>" data-pnumber="<?= $user['phone_number'] ?>" data-address="<?= $user['address'] ?>"><i class="fa-solid fa-user-minus"></i> Delete</a>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                        <!-- <p class="customerCount"><?= count($customer) ?> Users </p> -->
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
                if(classList.contains('deletecustomer')){
                    e.preventDefault();
                    orderid = targetElement.dataset.orderid;
                    cname = targetElement.dataset.cname;
                    pnumber = targetElement.dataset.pnumber;
                    address = targetElement.dataset.address;
                    // cid = targetElement.dataset.cid;
                    // console.log(PId);
                    
                    if(window.confirm('Are you sure to delete ' + orderid +' ' + cname + '?')){
                        $.ajax({
                            method: 'POST',
                            data : {
                                orderid : orderid,
                                cname : cname,
                                pnumber : pnumber,
                                address : address,
                                // cid : cid
                            },
                            url: 'database/delete-customer.php',
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
            
                
                if(classList.contains('updatecustomer')){
                    e.preventDefault();
                    
                    orderid = targetElement.closest('tr').querySelector('td.order_id').innerHTML;
                    cname = targetElement.closest('tr').querySelector('td.customer_name').innerHTML;
                    pnumber = targetElement.closest('tr').querySelector('td.phone_number').innerHTML;
                   address = targetElement.closest('tr').querySelector('td.address').innerHTML;
                    // cid = targetElement.closest('tr').querySelector('td.c_id').innerHTML;
                        // userId = targetElement.dataset.userid;
                    // console.log(pid,pname,cp,sp,cid);
                   BootstrapDialog.confirm({
                        title: 'Update ' + cname,
                        message: '<form>\
                                <div class="form-group">\
                                    <label for="cname"> Customer NAME </label>\
                                    <input type="text" class="form-control" id="cname" value="'+ cname +'">\
                                </div>\
                                <div class="form-group">\
                                    <label for="pnumber"> Phone Number </label>\
                                    <input type="text" class="form-control" id="pnumber" value="'+ pnumber +'">\
                                </div>\
                                <div class="form-group">\
                                    <label for="address"> Address </label>\
                                    <input type="text" class="form-control" id="address" value="'+ address +'">\
                                </div>\
                             </form>',
                             callback: function(isUpdate){
                                
                                if(isUpdate){
                                    $.ajax({
                                        method: 'POST',
                                        data : {
                                            orderid : orderid,
                                            cname : document.getElementById('cname').value,
                                            pnumber :  document.getElementById('pnumber').value,
                                            address : document.getElementById('address').value,
                                            // cid : document.getElementById('cid').value,
                                            
                                        },
                                        url: 'database/update-customer.php',
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
                                
                             }
                        

                   })
                   
                }
                
                
            });

        }
    }

    var script = new script;
    script.initialize();
</script>  
</body>
</html>