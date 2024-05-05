<?php
 session_start();
if(!isset($_SESSION['user'])) header('location: homepage.php');
$_SESSION['table'] ='shop'; 
 $user = $_SESSION['user'];
 $shop = include('database/show-shop.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC View Shop</title>
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
                            <h1 class="section_header"><i class="fa-solid fa-list"></i> List of shop</h1>
                            <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Shop Id</th>
                                                <th>Shop Name</th>
                                                <th>Shop Number</th>
                                                <th>Shop Location</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($shop as $index => $user) {?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td class="s_id"><?= $user['s_id']?></td>
                                                <td class="s_name"><?= $user['s_name']?></td>
                                                <td class="s_number"><?= $user['s_number']?></td>
                                                <td class="s_loc"><?= $user['s_loc']?></td>
                                                
                                                <td>
                                                    <a href="" class="updateshop" data-sid="<?= $user['s_id'] ?>"  data-sname="<?= $user['s_name'] ?>" data-snumber="<?= $user['s_number'] ?>" data-sloc="<?= $user['s_loc'] ?>" ><i class="fa fa-pencil"></i> Edit</a>
                                                    <a href="" class="deleteshop" data-sid="<?= $user['s_id'] ?>"  data-sname="<?= $user['s_name'] ?>" data-snumber="<?= $user['s_number'] ?>" data-sloc="<?= $user['s_loc'] ?>"><i class="fa-solid fa-user-minus"></i> Delete</a>
                                                </td>
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

<script>
    function script(){
           
        this.initialize = function(){
            this.registerEvents();
        }

        this.registerEvents = function(){
            document.addEventListener('click',function(e){
                targetElement = e.target;
                classList = targetElement.classList;
                if(classList.contains('deleteshop')){
                    e.preventDefault();
                    sid = targetElement.dataset.sid;
                    sname = targetElement.dataset.sname;
                    snumber = targetElement.dataset.snumber;
                    sloc = targetElement.dataset.sloc;
                    // cid = targetElement.dataset.cid;
                    // console.log(PId);
                    
                    if(window.confirm('Are you sure to delete ' + sname + '?')){
                        $.ajax({
                            method: 'POST',
                            data : {
                                sid : sid,
                                sname : sname,
                                snumber : snumber,
                                sloc : sloc,
                                // cid : cid
                            },
                            url: 'database/delete-shop.php',
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
            
                
                if(classList.contains('updateshop')){
                    e.preventDefault();
                    
                    sid = targetElement.closest('tr').querySelector('td.s_id').innerHTML;
                    sname = targetElement.closest('tr').querySelector('td.s_name').innerHTML;
                    snumber = targetElement.closest('tr').querySelector('td.s_number').innerHTML;
                    sloc = targetElement.closest('tr').querySelector('td.s_loc').innerHTML;
                    // cid = targetElement.closest('tr').querySelector('td.c_id').innerHTML;
                        // userId = targetElement.dataset.userid;
                    // console.log(pid,pname,cp,sp,cid);
                   BootstrapDialog.confirm({
                        title: 'Update ' + sname,
                        message: '<form>\
                                <div class="form-group">\
                                    <label for="sname"> Shop NAME </label>\
                                    <input type="text" class="form-control" id="sname" value="'+ sname +'">\
                                </div>\
                                <div class="form-group">\
                                    <label for="snumber"> Shop Number </label>\
                                    <input type="int" class="form-control" id="snumber" value="'+ snumber +'">\
                                </div>\
                                <div class="form-group">\
                                    <label for="sloc"> Shop Location </label>\
                                    <input type="text" class="form-control" id="sloc" value="'+ sloc +'">\
                                </div>\
                             </form>',
                             callback: function(isUpdate){
                                
                                if(isUpdate){
                                    $.ajax({
                                        method: 'POST',
                                        data : {
                                            sid : sid,
                                            sname : document.getElementById('sname').value,
                                            snumber :  document.getElementById('snumber').value,
                                            sloc : document.getElementById('sloc').value,
                                            // cid : document.getElementById('cid').value,
                                            
                                        },
                                        url: 'database/update-shop.php',
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