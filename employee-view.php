<?php
 session_start();
if(!isset($_SESSION['user'])) header('location: homepage.php');
$_SESSION['table'] ='employee'; 
 $user = $_SESSION['user'];
 $employee = include('database/show-employee.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC View Employee</title>
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
                            <h1 class="section_header"><i class="fa-solid fa-list"></i> List of employee</h1>
                            <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Employee Id</th>
                                                <th>Employee Name</th>
                                                <th>Shop Id</th>
                                                <th>Employee Number</th>
                                                <th>Salary</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($employee as $index => $user) {?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td class="e_id"><?= $user['e_id']?></td>
                                                <td class="e_name"><?= $user['e_name']?></td>
                                                <td class="s_id"><?= $user['s_id']?></td>
                                                <td class="e_number"><?= $user['e_number']?></td>
                                                <td class="salary"><?= $user['salary']?></td>
                                                
                                                <td>
                                                    <a href="" class="updateemployee" data-eid="<?= $user['e_id'] ?>"  data-ename="<?= $user['e_name'] ?>" data-sid="<?= $user['s_id'] ?>"   data-enumber="<?= $user['e_number'] ?>" data-salary="<?= $user['salary'] ?>" ><i class="fa fa-pencil"></i> Edit</a>
                                                    <a href="" class="deleteemployee" data-eid="<?= $user['e_id'] ?>"  data-ename="<?= $user['e_name'] ?>" data-sid="<?= $user['s_id'] ?>"   data-enumber="<?= $user['e_number'] ?>" data-salary="<?= $user['salary'] ?>"><i class="fa-solid fa-user-minus"></i> Delete</a>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                        <!-- <p class="UserCount"><?= count($employee) ?> Users </p> -->
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
                if(classList.contains('deleteemployee')){
                    e.preventDefault();
                    eid = targetElement.dataset.eid;
                    ename = targetElement.dataset.ename;
                    sid = targetElement.dataset.sid
                    enumber = targetElement.dataset.enumber;
                    salary = targetElement.dataset.salary;
                    // cid = targetElement.dataset.cid;
                    // console.log(PId);
                    
                    if(window.confirm('Are you sure to delete ' + ename + '?')){
                        $.ajax({
                            method: 'POST',
                            data : {
                                eid : eid,
                                ename : ename,
                                sid : sid,
                                enumber : enumber,
                                salary : salary,
                                // cid : cid
                            },
                            url: 'database/delete-employee.php',
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
            
                
                if(classList.contains('updateemployee')){
                    e.preventDefault();
                    
                    eid = targetElement.closest('tr').querySelector('td.e_id').innerHTML;
                    ename = targetElement.closest('tr').querySelector('td.e_name').innerHTML;
                    sid = targetElement.closest('tr').querySelector('td.s_id').innerHTML;
                    enumber = targetElement.closest('tr').querySelector('td.e_number').innerHTML;
                    salary = targetElement.closest('tr').querySelector('td.salary').innerHTML;
                    // cid = targetElement.closest('tr').querySelector('td.c_id').innerHTML;
                        // userId = targetElement.dataset.userid;
                    // console.log(pid,pname,cp,sp,cid);
                   BootstrapDialog.confirm({
                        title: 'Update ' + ename,
                        message: '<form>\
                                <div class="form-group">\
                                    <label for="ename"> Employee NAME </label>\
                                    <input type="text" class="form-control" id="ename" value="'+ ename +'">\
                                </div>\
                                <div class="form-group">\
                                    <label for="sid"> Shop Id </label>\
                                    <input type="text" class="form-control" id="sid" value="'+ sid +'">\
                                </div>\
                                <div class="form-group">\
                                    <label for="enumber"> Employee Number </label>\
                                    <input type="text" class="form-control" id="enumber" value="'+ enumber +'">\
                                </div>\
                                <div class="form-group">\
                                    <label for="salary"> Salary </label>\
                                    <input type="int" class="form-control" id="salary" value="'+ salary +'">\
                                </div>\
                             </form>',
                             callback: function(isUpdate){
                                
                                if(isUpdate){
                                    $.ajax({
                                        method: 'POST',
                                        data : {
                                            eid : eid,
                                            ename : document.getElementById('ename').value,
                                            sid : document.getElementById('sid').value,
                                            enumber :  document.getElementById('enumber').value,
                                            salary : document.getElementById('salary').value,
                                            // cid : document.getElementById('cid').value,
                                            
                                        },
                                        url: 'database/update-employee.php',
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