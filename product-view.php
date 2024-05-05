<?php
 session_start();
if(!isset($_SESSION['user'])) header('location: homepage.php');
$_SESSION['table'] ='product'; 
 $user = $_SESSION['user'];
 $product = include('database/show-product.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC View Product</title>
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
                            <h1 class="section_header"><i class="fa-solid fa-list"></i> List of Products</h1>
                            <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Id</th>
                                                <th>Product Name</th>
                                                <th>Cost Price</th>
                                                <th>Selling Price</th>
                                                <th>Category Id</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($product as $index => $user) {?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td class="p_id"><?= $user['p_id']?></td>
                                                <td class="p_name"><?= $user['p_name']?></td>
                                                <td class="cost_price"><?= $user['cost_price']?></td>
                                                <td class="selling_price"><?= $user['selling_price']?></td>
                                                <td class="c_id"><?= $user['c_id']?></td>
                                                
                                                <td>
                                                    <a href="" class="updateproduct" data-pid="<?= $user['p_id'] ?>"  data-pname="<?= $user['p_name'] ?>" data-cp="<?= $user['cost_price'] ?>" data-sp="<?= $user['selling_price'] ?>" data-cid="<?= $user['c_id'] ?>" ><i class="fa fa-pencil"></i> Edit</a>
                                                    <a href="" class="deleteproduct" data-pid="<?= $user['p_id'] ?>"  data-pname="<?= $user['p_name'] ?>" data-cp="<?= $user['cost_price'] ?>" data-sp="<?= $user['selling_price'] ?>" data-cid="<?= $user['c_id'] ?>"><i class="fa-solid fa-user-minus"></i> Delete</a>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                        <!-- <p class="UserCount"><?= count($product) ?> Users </p> -->
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
                if(classList.contains('deleteproduct')){
                    e.preventDefault();
                    pid = targetElement.dataset.pid;
                    pname = targetElement.dataset.pname;
                    cp = targetElement.dataset.cp;
                    sp = targetElement.dataset.sp;
                    cid = targetElement.dataset.cid;
                    // console.log(PId);
                    
                    if(window.confirm('Are you sure to delete ' + pname + '?')){
                        $.ajax({
                            method: 'POST',
                            data : {
                                pid : pid,
                                pname : pname,
                                cp : cp,
                                sp : sp,
                                cid : cid
                            },
                            url: 'database/delete-product.php',
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
            
                
                if(classList.contains('updateproduct')){
                    e.preventDefault();
                    
                    pid = targetElement.closest('tr').querySelector('td.p_id').innerHTML;
                    pname = targetElement.closest('tr').querySelector('td.p_name').innerHTML;
                    cp = targetElement.closest('tr').querySelector('td.cost_price').innerHTML;
                    sp = targetElement.closest('tr').querySelector('td.selling_price').innerHTML;
                    cid = targetElement.closest('tr').querySelector('td.c_id').innerHTML;
                        // userId = targetElement.dataset.userid;
                    // console.log(pid,pname,cp,sp,cid);
                   BootstrapDialog.confirm({
                        title: 'Update ' + pname,
                        message: '<form>\
                                <div class="form-group">\
                                    <label for="pname"> Product NAME </label>\
                                    <input type="text" class="form-control" id="pname" value="'+ pname +'">\
                                </div>\
                                <div class="form-group">\
                                    <label for="cp"> Cost Price </label>\
                                    <input type="int" class="form-control" id="cp" value="'+ cp +'">\
                                </div>\
                                <div class="form-group">\
                                    <label for="sp"> Selling Price </label>\
                                    <input type="int" class="form-control" id="sp" value="'+ sp +'">\
                                </div>\
                                <div class="form-group">\
                                    <label for="cid"> Category Id </label>\
                                    <input type="int" class="form-control" id="cid" value="'+ cid +'">\
                                </div>\
                             </form>',
                             callback: function(isUpdate){
                                
                                if(isUpdate){
                                    $.ajax({
                                        method: 'POST',
                                        data : {
                                            pid : pid,
                                            pname : document.getElementById('pname').value,
                                            cp :  document.getElementById('cp').value,
                                            sp : document.getElementById('sp').value,
                                            cid : document.getElementById('cid').value,
                                            
                                        },
                                        url: 'database/update-product.php',
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