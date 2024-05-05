<?php
 session_start();
if(!isset($_SESSION['user'])) header('location: homepage.php');
$_SESSION['table'] ='stock'; 
 $user = $_SESSION['user'];
 $stock = include('database/show-stock.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC View Stock</title>
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
                            <h1 class="section_header"><i class="fa-solid fa-list"></i> stock list</h1>
                            <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Id</th>
                                                <th>Shop Id</th>
                                                <th>Quantity</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($stock as $index => $user) {?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td class="p_id"><?= $user['p_id']?></td>
                                                <td class="s_id"><?= $user['s_id']?></td>
                                                <td class="quantity"><?= $user['quantity']?></td> 
                                                <td>
                                                    <a href="" class="updatestock" data-pid="<?= $user['p_id'] ?>"  data-sid="<?= $user['s_id'] ?>" data-quantity="<?= $user['quantity'] ?>"  ><i class="fa fa-pencil"></i> Edit</a>
                                                    <a href="" class="deletestock" data-pid="<?= $user['p_id'] ?>"  data-sid="<?= $user['s_id'] ?>" data-quantity="<?= $user['quantity'] ?>" ><i class="fa-solid fa-user-minus"></i> Delete</a>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                        <!-- <p class="UserCount"><?= count($stock) ?> Users </p> -->
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
                if(classList.contains('deletestock')){
                    e.preventDefault();
                    pid = targetElement.dataset.pid;
                    sid = targetElement.dataset.sid;
                    quantity = targetElement.dataset.quantity;
                   // sloc = targetElement.dataset.sloc;
                    // cid = targetElement.dataset.cid;
                    // console.log(PId);
                    
                    if(window.confirm('Are you sure to delete ' + pid + '?')){
                        $.ajax({
                            method: 'POST',
                            data : {
                                pid : pid,
                                sid : sid,
                                quantity : quantity,
                                //sloc : sloc,
                                // cid : cid
                            },
                            url: 'database/delete-stock.php',
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
            
                
                if(classList.contains('updatestock')){
                    e.preventDefault();
                    
                    pid = targetElement.closest('tr').querySelector('td.p_id').innerHTML;
                    sid = targetElement.closest('tr').querySelector('td.s_id').innerHTML;
                    quantity = targetElement.closest('tr').querySelector('td.quantity').innerHTML;
                    // sloc = targetElement.closest('tr').querySelector('td.s_loc').innerHTML;
                    // cid = targetElement.closest('tr').querySelector('td.c_id').innerHTML;
                        // userId = targetElement.dataset.userid;
                    // console.log(pid,pname,cp,sp,cid);
                   BootstrapDialog.confirm({
                        title: 'Update ' + pid  ,
                        message: '<form>\
                                <div class="form-group">\
                                    <label for="quantity"> Quantity </label>\
                                    <input type="text" class="form-control" id="quantity" value="'+ quantity +'">\
                                </div>\
                             </form>',
                             callback: function(isUpdate){
                                
                                if(isUpdate){
                                    $.ajax({
                                        method: 'POST',
                                        data : {
                                            pid : pid,
                                            sid : sid,
                                            // quantity : quantity,
                                           quantity : document.getElementById('quantity').value,
                                          //  snumber :  document.getElementById('snumber').value,
                                           // sloc : document.getElementById('sloc').value,
                                            // cid : document.getElementById('cid').value,
                                            
                                        },
                                        url: 'database/update-stock.php',
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