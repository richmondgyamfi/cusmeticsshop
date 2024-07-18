<?php
# ************************************************************
# Developer Richmond Gyamfi Nketia 
# Year 2019
# Version 1.0
#
# https://www.comedigitalize.com
# https://github.com/richmondgyamfi
#
#
# ************************************************************
class Ajaxmodals extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
        $this->userFunctions = $this->model('Functions');
    }

    public function courses()
    {

        if ($_POST['rid']) {
            // var_dump($_POST);
            // die();
            $data = [
                'barcode' => trim($_POST['rid'])
            ];

            $cosdata = $this->userModel->checkbarcode($data);
            // $cosdata = $this->userModel->gettotal_courses(10);
            // var_dump($cosdata);
            foreach ($cosdata as $itemdata) {
            }
            // die();
            echo '<div class="md-form input-group">';
            echo '<div class="input-group-prepend">';
            echo '<span class="input-group-text md-addon" for="brand_name">Product Name:</span>';
            echo '</div>';
            echo '<input type="hidden" name="ptype" id="sale" value="Retail">';
            echo '<input type="text" class="form-control" value="' . $itemdata->brand_name . '" readonly id="brand_name" name="brand_name" aria-describedby="brand_name">';
            echo '<input type="hidden" class="form-control" value="' . $itemdata->id . '" readonly id="recipientid" name="st_id" aria-describedby="st_id">';
            echo '</div>';
            echo '<div class="md-form input-group">';
            echo '<div class="input-group-prepend">';
            echo '<span class="input-group-text md-addon" for="no_available">Quantity Available:</span>';
            echo '</div>';
            echo '<input type="text" class="form-control" value="' . $itemdata->number_added . '" readonly id="no_available" name="no_available" aria-describedby="no_available">';
            echo '</div>';
            echo '<div class="md-form input-group">';
            echo '<div class="input-group-prepend">';
            echo '<span class="input-group-text md-addon" for="amount_purchased1">Quantity:</span>';
            echo '</div>';
            echo '<input type="text" class="form-control" value="" onkeypress="checkint(event)" id="amount_purchased1" required onkeyup="calculate()" name="amount_purchased1" aria-describedby="amount_purchased1">';
            echo '</div>';
            echo '<div class="md-form input-group">';
            echo '<div class="input-group-prepend">';
            echo '<span class="input-group-text md-addon" for="buying_price1">Selling Price:</span>';
            echo '</div>';
            echo '<input type="text" class="form-control" value="' . $itemdata->selling_price . '" id="itemname" name="buying_price1" aria-describedby="buying_price1">';
            echo '</div>';
            echo '<div class="md-form input-group">';
            echo '<div class="input-group-prepend">';
            echo '<span class="input-group-text md-addon" for="total_amount1">Total Amount:</span>';
            echo '</div>';
            echo '<input type="text" class="form-control" value="" id="total_amount1" name="total_amount1" aria-describedby="total_amount1">';
            echo '</div>';
            echo '<div class="md-form input-group mt-1 mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text md-addon" for="saletype"><i class="fa fa-shopping-cart"></i></span>
        </div>
        <select class="browser-default custom-select form-control rounded" name="saletype" id="saletype">
            <option value="" style="color: #C3C3C3;" selected>Sale Type...</option>
            <option value="Singles">Singles</option>
            <option value="Pack">Pack</option>
        </select>
    </div>';
            echo '<div class="justify-content-center">
            <button type="submit" class="btn btn-sm btn-success">Submit<i class="far fa-gem ml-1 text-white"></i></button>
            <button type="button" class="btn btn-sm btn-outline-danger waves-effect" onClick="window.location.reload();" data-dismiss="modal">No, Cancel</button>
        </div>';
        }
    }


    public function itemdetails() {
        // echo "string";
        // var_dump($_POST['promo_id']);die();
        if(!empty($_POST['promo_id'])){
            $stid = $_POST['promo_id'];
            $stdata = $this->userModel->selectstock($stid);
            // var_dump($stdata);
            if ($stdata) {
                foreach ($stdata as $key) {
                    $cat1 = $key->itemcat_type_id;
                    $itempro_type = $key->item_type_id;
                    $sell_type = $key->selling_type_id;
                    $brandst = $key->brand_id;
                    $added = $key->number_added;
                }
                $tdate = $this->userModel->todaydate();
                $tdate = $tdate[0]->nowdate;
                $value = explode('-', $tdate);
                $val = $value[0].$value[1].$value[2];
                // echo $val;
                $data = [
                    'itemcat_type_id' => trim($cat1),
                    'item_type_id' => trim($itempro_type),
                    'brand_id' => trim($brandst),
                    'tdate' => trim($tdate),
                    'dateval' => $val
                ];
                // echo "<br>";
                // echo "<br>";
                // var_dump($data);
                // echo "<br>";
                // echo "<br>";
                $checkalldata = $this->userModel->checkalldata($data);
                $checkstocktoday = $this->userModel->checkstocktoday($data);
                $checkstockyesti = $this->userModel->checkstockyesti($data);
                $totaladded = 0;
                $totaladdedamt = 0;
                foreach ($checkstocktoday as $key3) {
                    $totaladded += $key3->number_added;
                    $totaladdedamt += $key3->totalcost_price;
                }

                $totaladdedyesti = 0;
                $totaladdedamtyesti = 0;
                foreach ($checkstockyesti as $key4) {
                    $totaladdedyesti += $key4->number_added;
                    $totaladdedamtyesti += $key4->totalcost_price;
                }
                // var_dump($checkalldata);
                // echo "<br>";
                // echo "<br>";
                $checkallsale = $this->userModel->checkallsale($stid);
                // var_dump($checkallsale);
                $totalsold = 0;
                $totalamt = 0;
                foreach ($checkallsale as $key) {
                    $totalsold += $key->no_purchased;
                    $totalamt += $key->total_amount;
                }

                //get total sale of particular item
                // $checkspecificsale = $this->userModel->checkspecificsale($stid);

                //get the highest and willl help get the difference
                $itemleft = $this->userModel->itemleft($stid);
                //get yesterdays last sale so we can get items we sold today
                $yestisales = $this->userModel->yestisales($stid);
                $todaysalesft = $this->userModel->todaysalesft($stid);
                $todaysalesst = $this->userModel->todaysalesst($stid);
                $yestisalesft = $this->userModel->yestisalesft($stid);

                //get yesterdays last sale so we can get items we sold today
                $twodaysagosales = $this->userModel->twodaysagosales($stid);
                //get allyesti sales
                $allyestisales = $this->userModel->allyestisales($stid);
                $totalsoldyesti = 0;
                $totalamtyesti = 0;
                foreach ($allyestisales as $key2) {
                    $totalsoldyesti += $key2->no_purchased;
                    $totalamtyesti += $key2->total_amount;
                }
                //get allyesti back sales
                $allyestibacksales = $this->userModel->allyestibacksales($stid);
                $todaysinglesales = $this->userModel->todaysinglesales($stid);
                $totalsoldtoday = 0;
                $totalamttoday = 0;
                foreach ($todaysinglesales as $key1) {
                    $totalsoldtoday += $key1->no_purchased;
                    $totalamttoday += $key1->total_amount;
                }
            }

?>
            <div class="modal fade detail_modal" id="detail_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-lg modal-success" role="document">
                    <div class="modal-content" style="border-radius: 10px 10px;">
                        <div class="modal-header bg-danger">
                            <h4 class="heading text-white animated flash delay-2s">Item Details
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal1()">
                                <span aria-hidden="true" class="text-white btn-sm btn-danger">Close</span>
                            </button>
                        </div>
                        <div class="modal-body bg-light">
                            <div class="body">
                                <div class="row">
                                    <!--<div class="col-4">
                            <div class="card bg-light">
                                <h5>All Statistics</h5><br>
                                <p class="text-danger text-right"><?='Sold : '.$totalsold.' Amount : GHC '.$totalamt ?></p>
                            </div>
                        </div>-->
                                    <div class="col-6">
                                        <div class="card bg-light p-2">
                                            <h5>Statistics Today</h5><br>

                                            <p class="text-danger text-right">
                                                <?='Number Existed : '.$todaysalesft[0]->num_available; ?></p>

                                            <p class="text-danger text-right"><?='Total Added : '.$totaladded; ?></p>

                                            <p class="text-danger text-right"><?='Number Sold : '.$totalsoldtoday ?></p>


                                            <p class="text-danger text-right"><?php
                                                                                echo 'Number Left : '.$todaysalesst[0]->num_available;
                                                                                // $left = $yes-$totalsoldtoday;
                                                                                // echo 'Number Left : '.$left; 
                                                                                ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card bg-light p-2">
                                            <h5>Statistics Yesterday</h5><br>

                                            <p class="text-danger text-right">
                                                <?= 'Number Existed : ' . $yestisalesft[0]->num_available; ?></p>
                                            <p class="text-danger text-right"><?= 'Total Added : ' . $totaladdedyesti; ?></p>


                                            <p class="text-danger text-right"><?= 'Number Sold : ' . $totalsoldyesti; ?></p>

                                            <p class="text-danger text-right"><?php
                                                                                echo 'Number Left : ' . $yes = $yestisales[0]->num_available;
                                                                                // $left = $yes-$totalsoldyesti;
                                                                                // echo 'Number Left : '.$left; 
                                                                                ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h5>Sale Details</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Number Available</th>
                                                <th>Number Purchased</th>
                                                <th>Total Cost</th>
                                                <th>Unit Cost</th>
                                                <th>Date Sold</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($checkallsale as $salemain) : ?>
                                                <tr>
                                                    <td><?= $salemain->num_available; ?></td>
                                                    <td><?= $salemain->no_purchased; ?></td>
                                                    <td><?= $salemain->total_amount; ?></td>
                                                    <td><?= $salemain->unit_amount; ?></td>
                                                    <td><?= $salemain->activity_date; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table><br><br>
                                    <h5>Stock Details</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Number Added</th>
                                                <th>Inoice Number</th>
                                                <th>Total Cost</th>
                                                <th>Unit Cost</th>
                                                <th>Expiry Date</th>
                                                <th>Date Added</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($checkalldata as $stmain) : ?>
                                                <tr>
                                                    <td><?= $stmain->number_added; ?></td>
                                                    <td><?= $stmain->invoice_no; ?></td>
                                                    <td><?= $stmain->totalcost_price; ?></td>
                                                    <td><?= $stmain->unitcost_price; ?></td>
                                                    <td><?php
                                                        echo $stmain->unitcost_price . ' ' . ($stmain->expiredays < 10) ? '<span class="badge badge-danger ml-2 animated flash infinite">' . $stmain->expiredays . ' Days to Expiry</span>' : '';
                                                        ?></td>
                                                    <td><?= $stmain->activity_date; ?></td>
                                                    <!-- <td>
                                       
                                   </td> -->
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <script>
                function closeModal() {
                    jQuery('#detail_modal').modal('hide');
                    setTimeout(function() {
                        jQuery('#detail_modal').remove();
                        jQuery('.modal_backdrop').remove();
                    }, 300);
                }

                $('#detail_modal').on('hidden.bs.modal', function() {
                    setTimeout(function() {
                        jQuery('#detail_modal').remove();
                        jQuery('.modal_backdrop').remove();
                    }, 300);
                });

                function closeModal() {
                    jQuery('#detail_modal').modal('hide');
                    setTimeout(function() {
                        jQuery('#detail_modal').remove();
                        jQuery('.modal_backdrop').remove();
                    }, 300);
                }

                $('#detail_modal').on('hidden.bs.modal', function() {
                    setTimeout(function() {
                        jQuery('#detail_modal').remove();
                        jQuery('.modal_backdrop').remove();
                    }, 300);
                });
            </script>

<?php
        }
    }
}



?>