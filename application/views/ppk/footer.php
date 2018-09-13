 <footer class="footer footer-static footer-light navbar-border">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <a class="text-bold-800 grey darken-2" href=""
        target="_blank">PT. Tegar Digital Solution </a>, All rights reserved. </span>
    </p>
  </footer>
 <!-- BEGIN VENDOR JS-->
  <script src="<?php echo base_url('app-assets/vendors/js/vendors.min.js') ?>" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="<?php echo base_url('app-assets/vendors/js/charts/chart.min.js') ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('app-assets/vendors/js/tables/datatable/datatables.min.js') ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('app-assets/vendors/js/forms/icheck/icheck.min.js') ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('app-assets/vendors/js/extensions/sweetalert.min.js') ?>" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN STACK JS-->
  <script src="<?php echo base_url('app-assets/js/core/app-menu.js') ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('app-assets/js/core/app.js') ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('app-assets/js/scripts/customizer.js') ?>" type="text/javascript"></script>
  <!-- END STACK JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="<?php echo base_url('app-assets/js/scripts/charts/chartjs/pie-doughnut/pie.js') ?>" type="text/javascript"></script>
  <!-- <script src="<?php echo base_url('app-assets/js/scripts/charts/chartjs/pie-doughnut/pie-simple.js') ?>"
  type="text/javascript"></script> -->
  <script src="<?php echo base_url('app-assets/js/scripts/charts/chartjs/pie-doughnut/doughnut.js') ?>"
  type="text/javascript"></script>
  <script src="<?php echo base_url('app-assets/js/scripts/charts/chartjs/pie-doughnut/doughnut-simple.js') ?>"
  type="text/javascript"></script>
  <script src="<?php echo base_url('app-assets/js/scripts/tables/datatables/datatable-basic.js') ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('app-assets/js/scripts/extensions/sweet-alerts.js') ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('app-assets/js/scripts/forms/checkbox-radio.js') ?>" type="text/javascript"></script>

  <script type="text/javascript" src="<?php echo base_url('app-assets/css/validator/bootstrapValidator.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('app-assets/css/validator/jquery-1.10.2.min.js') ?>"></script>
  <!-- END PAGE LEVEL JS-->
  <script type="text/javascript">
 function startTime()
    {
    var today=new Date();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();
    // add a zero in front of numbers<10<br>
    m=checkTime(m);
    s=checkTime(s);
    document.getElementById('txt').innerHTML=h+":"+m+":"+s;
    t=setTimeout(function(){startTime()},500);
    }

    function checkTime(i)
    {
    if (i<10)
      {
      i="0" + i;
      }
    return i;
    }
  </script>

  <!-- Bar Chart -->
  <script type="text/javascript">
    $(window).on("load", function(){

    //Get the context of the Chart canvas element we want to select
    var ctx = $("#column-chart");

    // Chart Options
    var chartOptions = {
        // Elements options apply to all of the options unless overridden in a dataset
        // In this case, we are setting the border of each bar to be 2px wide and green
        elements: {
            rectangle: {
                borderWidth: 2,
                borderColor: 'rgb(0, 255, 0)',
                borderSkipped: 'bottom'
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        responsiveAnimationDuration:500,
        legend: {
            position: 'top',
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    color: "#f3f3f3",
                    drawTicks: false,
                },
                scaleLabel: {
                    display: true,
                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                    color: "#f3f3f3",
                    drawTicks: false,
                },
                scaleLabel: {
                    display: true,
                }
            }]
        },
        title: {
            display: false,
            text: 'Chart.js Bar Chart'
        },
        legend: { 
          display:false
        }
    };

    // Chart Data
    var chartData = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [{
            label: "Data",
            data: [0, 59, 80, 81, 56,100],
            backgroundColor: "#16D39A",
            hoverBackgroundColor: "rgba(22,211,154,.9)",
            borderColor: "transparent"
        }]
    };

    var config = {
        type: 'bar',

        // Chart Options
        options : chartOptions,

        data : chartData
    };

    // Create the chart
    var lineChart = new Chart(ctx, config);
});
  </script>
</body>
</html>