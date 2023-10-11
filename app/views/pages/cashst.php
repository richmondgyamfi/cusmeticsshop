<?php
require APPROOT . '/views/includes/navigation.php';
foreach($data['tcost'] as $tcost){}
foreach($data['tsell'] as $tsell){}
 ?>
<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <div class="card mb-4 wow fadeIn">
            <div class="card-body d-sm-flex justify-content-between">
                <h4 class="mb-2 mb-sm-0 pt-1">
                    <span>Total Cash Stats <i class="fa fa-check text-danger animated rotateIn"></i></span>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 wow fadeIn">
                    <div class="card-body">
                        <h4 class="mb-2 mb-sm-0 pt-1">
                            <span>Total Amount Spent</span>
                        </h4><br>
                        <div class="text-center">
                            <h1><?=round($tcost->tcost,1); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 wow fadeIn">
                    <div class="card-body">
                        <h4 class="mb-2 mb-sm-0 pt-1">
                            <span>Total Amount Sold </span>
                        </h4><br>
                        <div class="text-center">
                            <h1><?=round($tsell->tsell,1) ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 wow fadeIn">
                    <div class="card-body">
                        <h4 class="mb-2 mb-sm-0 pt-1">
                            <span>Total Amount Left</span>
                        </h4><br>
                        <div class="text-center">
                            <h1><?=round($tcost->tcost,1) - round($tsell->tsell,1) ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
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

<?php 
  //echo alert();
require APPROOT . '/views/includes/modal.php';

 ?>
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