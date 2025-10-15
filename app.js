//-------------------------
// Title: app.js
//-------------------------
// Program Details:
//-------------------------
// Purpose: outline used to create the graphs on my data dashboard.
// Inputs:  None
// Outputs: None
// Date:  10/14/25
// Compiler: NA
// Author:  Isaac Rodriguez
// Versions:
//            V1 - collects data from database and creates foundation for charts.
//-------------------------
// File Dependancies: 
//     https://isaacr.org/charts/data.php
//-------------------------

//-------------------------
// Main Program
//-------------------------
$(document).ready(function(){
  $.ajax({
    url: "https://isaacr.org/charts/data.php", // location of the datafile
    method: "GET",
    success: function(data) {
      console.log(data);
      var x_axis = []; // a generic variable
      var y_axis = [];

      for(var i in data) {
        x_axis.push("N:" + data[i].time_received); // must match your dBase columns
        y_axis.push(data[i].temperature);
      }

      var chartdata = {
        labels: x_axis,
        datasets : [
          {
            label: 'Sensor Node-1', //Title
            // Change colors: https://www.w3schools.com/css/tryit.asp?filename=trycss3_color_rgba 
            backgroundColor: 'rgba(0, 255, 0, 1)', 
            borderColor: 'rgba(200, 200, 200, 0.75)', 
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: y_axis
          }
        ],
};

      var ctx = $("#mycanvas");

      var barGraph = new Chart(ctx, {
        type: 'line',   //Chart Type 
        data: chartdata,
        options:{
            scales: {
                x: { // Configuration for the X-axis
                        title: {
                            display: true, // Set to true to display the title
                            text: 'Time' // The text for your X-axis label
                                }
                        },
                    y: { // Configuration for the Y-axis (optional)
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Temperature'
                                }
                        }
            }
        }
        

      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});
