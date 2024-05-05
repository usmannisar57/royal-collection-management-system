<?php
  session_start();
  if (!isset($_SESSION['user'])) header('location: homepage.php');
  $_SESSION['table'] ='stock'; 
 $user = $_SESSION['user'];
 $stock = include('database/show-stock.php'); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>RC Dashboard</title>
    <?php include('partials/app-header-script.php'); ?>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div id="dashboardMainContainer">
        <?php include('partials/app-sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('partials/app-topnav.php') ?>
            <div class="dashboard_content">
                <div class="dashboard_content_main"> 
                    <!-- Add your pie chart and bar graph here -->
                    <canvas id="myPieChart"></canvas>
                    <canvas id="myBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <?php include('partials/app-script.php'); ?>
    <script>
        // Dummy data for demonstration
        var pieChartData = {
            labels: ['Label 1', 'Label 2', 'Label 3'],
            datasets: [{
                data: [30, 50, 20],
                backgroundColor: ['#ff6384', '#36a2eb', '#ffce56'],
            }]
        };

        var barChartData = {
            labels: ['Label 1', 'Label 2', 'Label 3'],
            datasets: [{
                label: 'Dataset Label',
                data: [10, 20, 30],
                backgroundColor: ['#ff6384', '#36a2eb', '#ffce56'],
                borderColor: ['#ff6384', '#36a2eb', '#ffce56'],
                borderWidth: 1
            }]
        };

        // Get the context of the canvas elements
        var ctxPie = document.getElementById('myPieChart').getContext('2d');
        var ctxBar = document.getElementById('myBarChart').getContext('2d');

        // Create the charts
        var myPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: pieChartData
        });

        var myBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: barChartData
        });
    </script>
</body>
</html>
