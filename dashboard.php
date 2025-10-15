//-------------------------
// Title: sensor-data.php
//-------------------------
// Program Details:
//-------------------------
// Purpose: Used to graphically represent all my data in a tables and graphs
// Inputs:  None
// Outputs: None
// Date:  10/14/25
// Compiler: NA
// Author:  Isaac Rodriguez
// Versions:
//            V1 - collects data from database then tables and graphs
//-------------------------
// File Dependancies:
                "./sql/all_data.php"
                "./sql/registered_devices.php" 
                "./sql/average/node1.php"  
//     these files grab the data from the database.
//-------------------------

//-------------------------
// Main Program
//-------------------------



<?php require ("./sql/all_data.php");
      require ("./sql/registered_devices.php"); 
      include ("./sql/average/node1.php")?>


<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
      #chart-container {
        width: 640px;
        height: auto;
        margin: 0 auto;
      }
        body {
                background-color: beige;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
            text-align: center;
            background-color: lightblue;
        }
        .center-table {
              margin-left: auto;
              margin-right: auto;
        }
        h1, h3 {
      text-align: center;
        }
    </style>
    <h1>SSU IoT Data</h1>
</head>
<body>
    <h3>Registered Devices</h3>
        <div>
    
            <table  class="center-table">
                <thead>
                        <tr>
                            <th>Name</th>
                            <th>Manufacturer</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rd_data as $row): ?>
                            <tr>
                                <td><?php echo $row['node_name']; ?></td>
                                <td><?php echo $row['maufacturer']; ?></td>
                                <td><?php echo $row['longitude']; ?></td>
                                <td><?php echo $row['latitude']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
        </div>
                    <h3>All Data</h3>
                    
        <div style="text-align: center;">
            <pre>
                <?php   print "The Average temperature for Node-1 : " . $avg_node1[0]['AVG_Temp'];?>
            </pre>
        </div>
        <div>
            <table class="center-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Temp</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_data as $row): ?>
                        <tr>
                            <td><?php echo $row['node_name']; ?></td>
                            <td><?php echo $row['temperature']; ?></td>
                            <td><?php echo $row['time_received']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
    
        </div>
        <div id="chart-container">
            <canvas id="mycanvas"></canvas>
        </div>

        <!-- javascript -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
        <!-- This is the location of app.js file - we are assuming it is in the same folder as this file-->
        <script type="text/javascript" src="charts/app.js"></script>
        
    </body>
    </html>
