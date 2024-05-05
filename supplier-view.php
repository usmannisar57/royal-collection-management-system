<?php
 session_start();
if(!isset($_SESSION['user'])) header('location: homepage.php');
$_SESSION['table'] ='supplier'; 
 $user = $_SESSION['user'];
 $supplier = include('database/show-supplier.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC View Supplier</title>
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
                            <h1 class="section_header"><i class="fa-solid fa-list"></i> List of supplier</h1>
                            <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>supplier Id</th>
                                                <th>supplier Name</th>
                                                <th>supplier Number</th>
                                                <th>supplier Location</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($supplier as $index => $user) {?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td class="sup_id"><?= $user['sup_id']?></td>
                                                <td class="sup_name"><?= $user['sup_name']?></td>
                                                <td class="sup_number"><?= $user['sup_number']?></td>
                                                <td class="sup_loc"><?= $user['sup_loc']?></td>
                                                
                                                <td>
                                                    <a href="" class="updatesupplier" data-supid="<?= $user['sup_id'] ?>"  data-supname="<?= $user['sup_name'] ?>" data-supnumber="<?= $user['sup_number'] ?>" data-suploc="<?= $user['sup_loc'] ?>" ><i class="fa fa-pencil"></i> Edit</a>
                                                    <a href="" class="deletesupplier" data-supid="<?= $user['sup_id'] ?>"  data-supname="<?= $user['sup_name'] ?>" data-supnumber="<?= $user['sup_number'] ?>" data-suploc="<?= $user['sup_loc'] ?>"><i class="fa-solid fa-user-minus"></i> Delete</a>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                        <!-- <p class="UserCount"><?= count($supplier) ?> Users </p> -->
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
                if(classList.contains('deletesupplier')){
                    e.preventDefault();
                    supid = targetElement.dataset.supid;
                    supname = targetElement.dataset.supname;
                    supnumber = targetElement.dataset.supnumber;
                    suploc = targetElement.dataset.suploc;
                    // cid = targetElement.dataset.cid;
                    // console.log(PId);
                    
                    if(window.confirm('Are you sure to delete ' + supname + '?')){
                        $.ajax({
                            method: 'POST',
                            data : {
                                supid : supid,
                                supname : supname,
                                supnumber : supnumber,
                                suploc : suploc,
                                // cid : cid
                            },
                            url: 'database/delete-supplier.php',
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
            
                
                if(classList.contains('updatesupplier')){
                    e.preventDefault();
                    
                    supid = targetElement.closest('tr').querySelector('td.sup_id').innerHTML;
                    supname = targetElement.closest('tr').querySelector('td.sup_name').innerHTML;
                    supnumber = targetElement.closest('tr').querySelector('td.sup_number').innerHTML;
                    suploc = targetElement.closest('tr').querySelector('td.sup_loc').innerHTML;
                    // cid = targetElement.closest('tr').querySelector('td.c_id').innerHTML;
                        // userId = targetElement.dataset.userid;
                    // console.log(pid,pname,cp,sp,cid);
                   BootstrapDialog.confirm({
                        title: 'Update ' + supname,
                        message: '<form>\
                                <div class="form-group">\
                                    <label for="supname"> supplier NAME </label>\
                                    <input type="text" class="form-control" id="supname" value="'+ supname +'">\
                                </div>\
                                <div class="form-group">\
                                    <label for="supnumber"> supplier Number </label>\
                                    <input type="int" class="form-control" id="supnumber" value="'+ supnumber +'">\
                                </div>\
                                <div class="form-group">\
                                    <label for="suploc"> supplier Location </label>\
                                    <input type="int" class="form-control" id="suploc" value="'+ suploc +'">\
                                </div>\
                             </form>',
                             callback: function(isUpdate){
                                
                                if(isUpdate){
                                    $.ajax({
                                        method: 'POST',
                                        data : {
                                            supid : supid,
                                            supname : document.getElementById('supname').value,
                                            supnumber :  document.getElementById('supnumber').value,
                                            suploc : document.getElementById('suploc').value,
                                            // cid : document.getElementById('cid').value,
                                            
                                        },
                                        url: 'database/update-supplier.php',
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