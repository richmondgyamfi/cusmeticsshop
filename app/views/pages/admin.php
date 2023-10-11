<?php
require APPROOT . '/views/includes/navigation.php';

$gdata = $data['data'];
$sales = (empty($data['stdata'])?'0':count($data['stdata']));
$totalsale = (empty($data['totalsale'])?'0':count($data['totalsale']));
$deli = (empty($data['newu'])?'0':count($data['newu']));
$brand = (empty($data['brands'])?'0':count($data['brands']));
$sup = (empty($data['supplier'])?'0':count($data['supplier']));
$cusdata = (empty($data['cusdata'])?'0':count($data['cusdata']));
$udata = (empty($data['users'])?'0':count($data['users']));
 ?>
<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <div class="card mb-4 wow fadeIn">
            <div class="card-body d-sm-flex justify-content-between">
                <h4 class="mb-2 mb-sm-0 pt-1">
                    <span>Admin Dashboard <i class="fa fa-check text-danger animated rotateIn"></i></span>
                </h4>
                <?php
          //var_dump($data);
          ?>
            </div>
        </div>
        <div class="row wow fadeIn">
            <div class="col-md-9 mb-4">
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="list-group list-group-flush" style="font-size: 12px;">
                            <a class="list-group-item list-group-item-action waves-effect">Today's Sales
                                <span class="badge badge-success badge-pill pull-right"><?=$sales; ?>
                                    <i class="fa fa-arrow-up ml-1"></i>
                                </span>
                            </a>
                            <a class="list-group-item list-group-item-action waves-effect">Total Sales
                                <span class="badge badge-primary badge-pill pull-right"><?=$totalsale; ?>
                                    <i class="fa fa-arrow-up ml-1"></i>
                                </span>
                            </a>
                            <a class="list-group-item list-group-item-action waves-effect">Deliveries Due
                                <span class="badge badge-danger badge-pill pull-right"><?=$deli;?></span>
                            </a>
                            <a class="list-group-item list-group-item-action waves-effect">Total Product
                                <span class="badge badge-danger badge-pill pull-right"><?=$brand;?></span>
                            </a>
                            <a class="list-group-item list-group-item-action waves-effect">Total Suppliers
                                <span class="badge badge-danger badge-pill pull-right"><?=$sup;?></span>
                            </a>
                            <a class="list-group-item list-group-item-action waves-effect">Total Customers
                                <span class="badge badge-danger badge-pill pull-right"><?=$cusdata;?></span>
                            </a>
                            <a class="list-group-item list-group-item-action waves-effect">Total Users
                                <span class="badge badge-danger badge-pill pull-right"><?=$udata;?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row wow fadeIn">
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">Months Data</div>
                    <div class="card-body">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">Summary Data Chart</div>
                    <div class="card-body">
                        <canvas id="doughnutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
<!-- # ************************************************************
# Developer Richmond Gyamfi Nketia 
# Year 2019
# Version 1.0
#
# https://www.comedigitalize.com
# https://github.com/richmondgyamfi
#
#
# ************************************************************ -->
<footer class="page-footer text-center font-small danger-color-dark darken-2 mt-4 wow fadeIn">
    <div class="footer-copyright py-3">
        © 2019 Copyright:
        <a href="" target="_blank"> Animé Studios </a>
    </div>
</footer>
<script src="../js/jquery-3.4.1.min.js" type="text/javascript" charset="utf-8" async defer></script>
<script type="text/javascript" src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js" type="text/javascript" charset="utf-8" async defer></script>
<script src="../js/mdb.min.js" type="text/javascript" charset="utf-8" async defer></script>
<!-- <script src="../js/addons/datatables-select.min.js" type="text/javascript" charset="utf-8" async defer></script>
  <script src="../js/addons/datatables.js" type="text/javascript" charset="utf-8" async defer></script> -->

<script>
$(document).ready(function() {
    showGraph();
});

function showGraph() {
    var data = <?php echo json_encode($gdata);?>;
    var ctx = document.getElementById("myChart").getContext('2d');
    var name = [];
    var marks = [];
    console.log(data);
    for (var i in data) {
        console.log(data[i].brand_name);
        name.push(data[i].brand_name);
        marks.push(data[i].number_added);
    }
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: name,
            datasets: [{
                label: 'Products In Stock',
                data: marks,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}


//line
var ctxL = document.getElementById("lineChart").getContext('2d');
var myLineChart = new Chart(ctxL, {
    type: 'line',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
        datasets: [{
                label: "Sale Per Month",
                backgroundColor: [
                    'rgba(105, 0, 132, .2)',
                ],
                borderColor: [
                    'rgba(200, 99, 132, .7)',
                ],
                borderWidth: 2,
                data: [65, 59, 80, 81, 56, 55, 40, 5, 5, 5, 5, 5]
            },
            {
                label: "Coustomers Per Month",
                backgroundColor: [
                    'rgba(0, 137, 132, .2)',
                ],
                borderColor: [
                    'rgba(0, 10, 130, .7)',
                ],
                data: [28, 48, 40, 19, 86, 27, 90, 12, 12, 12, 21, 32]
            }
        ]
    },
    options: {
        responsive: true
    }
});

//doughnut
var ctxD = document.getElementById("doughnutChart").getContext('2d');
var sales = <?php echo $sales;?>;
var totalsale = <?php echo $totalsale;?>;
var deli = <?php echo $deli; ?>;
var brand = <?php echo $brand?>;
var sup = <?php echo $sup?>;
var cusdata = <?php echo $cusdata?>;
var udata = <?php echo $udata?>;
var myLineChart = new Chart(ctxD, {
    type: 'doughnut',
    data: {
        labels: ["Sales", "Total Sale", "Delivery", "Brand", "Supliers", "Brand", "Supliers"],
        datasets: [{
            data: [sales, totalsale, deli, brand, sup, cusdata, udata],
            backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#94a2f4",
                "#8f3360"
            ],
            hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774", "#A8B3dg",
                "#6167d3"
            ]
        }]
    },
    options: {
        responsive: true
    }
});
</script>

<?php 
  //echo alert();
require APPROOT . '/views/includes/modal.php';

 ?>