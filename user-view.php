<?php
 session_start();
if(!isset($_SESSION['user'])) header('location: homepage.php');
$_SESSION['table'] ='login_info'; 
 $user = $_SESSION['user'];
 $login_info = include('database/show-users.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC View user</title>
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
                            <h1 class="section_header"><i class="fa-solid fa-list"></i> List of User</h1>
                            <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>ID</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($login_info as $index => $user) {?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td class="Name"><?= $user['name']?></td>
                                                <td class="Id"><?= $user['id']?></td>
                                                <td>
                                                    <a href="" class="updateuser" data-id="<?= $user['id'] ?>" ><i class="fa fa-pencil"></i> Edit</a>
                                                    <a href="" class="deleteUser" data-id="<?= $user['id'] ?>"data-name="<?= $user['name'] ?>"  ><i class="fa-solid fa-user-minus"></i> Delete</a>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                        <!-- <p class="UserCount"><?= count($login_info) ?> Users </p> -->
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
                if(classList.contains('deleteUser')){
                    e.preventDefault();
                    Id = targetElement.dataset.id;
                    Name = targetElement.dataset.name;
                    
                    if(window.confirm('Are you sure to delete ' + Name + '?')){
                        $.ajax({
                            method: 'POST',
                            data : {
                                user_id : Id,
                                name : Name
                            },
                            url: 'database/delete-user.php',
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
            
                
                if(classList.contains('updateuser')){
                    e.preventDefault();
                    

                  Name = targetElement.closest('tr').querySelector('td.Name').innerHTML;
                   Id = targetElement.closest('tr').querySelector('td.Id').innerHTML;
                    // userId = targetElement.dataset.userid;
                    // console.log(Name,Id);
                   BootstrapDialog.confirm({
                        title: 'Update ' + Name,
                        message: '<form>\
                            <div class="form-group">\
                                <label for="Name"> NAME </label>\
                                <input type="text" class="form-control" id="Name" value="'+ Name +'">\
                            </div>\
                             </form>',
                             callback: function(isUpdate){
                                
                                if(isUpdate){
                                    $.ajax({
                                        method: 'POST',
                                        data : {
                                            Id : Id,
                                            name : document.getElementById('Name').value,
                                            
                                        },
                                        url: 'database/update-user.php',
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