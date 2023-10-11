<?php
require APPROOT . '/views/includes/navigation.php';
$stdata = $data['stdata'];
 ?>

<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <div class="card mb-4 wow fadeIn d-print-none">
            <div class="card-body d-sm-flex justify-content-between row">
                <h4 class="mb-2 mb-sm-0 pt-1">
                    <span>Attendance Page <i class="fa fa-check text-danger animated rotateIn"></i></span>
                </h4>
                <form action="check_attendance.php" method="POST" accept-charset="utf-8" class="d-print-none">
                    <div class="row">
                        <label>Select Date : </label>
                        <input type="date" name="from" id="from" class="form-control-sm ml-3">
                        <input type="date" name="to" id="to" class="form-control-sm ml-3">
                        <button type="submit" name="r_search" id="r_search"
                            class="btn btn-sm btn-danger mt-0">Search</button>
                    </div>
                </form>
                <button class="btn btn-danger btn-sm mt-0" data-toggle="tooltip" data-placement="top" title="Print"
                    onclick="print()"><i class="fa fa-print fa-2x" aria-hidden="true"></i></button>
            </div>
        </div>
        <?php 
        if(!empty($stdata)){
      ?>
        <div class="row wow fadeIn">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">

                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                                cellspacing="0" width="100%">
                                <caption>Login Data From <?=$data['tdate']; ?> to <?=$data['tdate1']; ?></caption>
                                <thead class="table-dark">
                                    <tr>
                                        <th class="th-sm">Staff Name <i class="fa fa-sort"></i>
                                        </th>
                                        <th class="th-sm">Username <i class="fa fa-sort"></i>
                                        </th>
                                        <th class="th-sm">Login Time <i class="fa fa-sort"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                foreach ($stdata as $key):
                 ?>
                                    <tr>
                                        <td><?=$key->name; ?></td>
                                        <td><?=$key->username; ?></td>
                                        <td><?=$key->logintime; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Staff Name
                                        </th>
                                        <th>Username
                                        </th>
                                        <th>Login Time
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php } elseif((isset($_POST['r_search'])) && (empty($stdata))){?>
        <h2 style="margin-bottom: 360px;">No Search Found/Empty</h2>
        <?php }else{?>
        <h2 style="margin-bottom: 360px;">Search by Selecting Date</h2>
        <?php }?>
    </div>
</main>
<?php 
require APPROOT . '/views/includes/modal.php';
require APPROOT . '/views/includes/footer.php';
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