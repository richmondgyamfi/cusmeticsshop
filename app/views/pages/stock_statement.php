<?php
require APPROOT . '/views/includes/navigation.php';
$stockavailable = $data['stockavailable'];
$stockavailable1 = $data['stockavailable1'];
$stockavailable2 = $data['stockavailable2'];
// var_dump($stockavailable1);
$todaysales = $data['todaysales'];
$todaysales1 = $data['todaysales'];
$checkstocktoday = $data['checkstocktoday'];
$checkstocktoday1 = $data['checkstocktoday'];
$brands = $data['brands'];
$selling_type = $data['selling_type'];
$category_type = $data['category_type'];
$item_type = $data['item_type'];
$supplier = $data['supplier'];

$totalstr = 0;
$totalno = 0;
foreach ($stockavailable1 as $stockava) {
    $totalno = $stockava->total_stock;
    $totalstr = $stockava->total_amount;
}

$totalstr1 = 0;
$totalno1 = 0;
foreach ($stockavailable2 as $stockava1) {
    $totalno1 = $stockava1->total_stock;
    $totalstr1 = $stockava1->total_amount;
}

$totalsttoday = 0;
$totalnotoday = 0;
$totalstselling_price = 0;
if (!empty($checkstocktoday)) {
    # code...
    foreach ($checkstocktoday as $stockava1) {
        $totalnotoday += $stockava1->number_added;
        $totalsttoday += $stockava1->totalcost_price;
        $totalstselling_price += $stockava1->totalsp;
        // $totalstunitcost_price += $stockava1->unitcost_price;
        // $totalsttoday += $stockava1->totalsp;
    }
}

$totalsaletoday = 0;
$totalnosaletoday = 0;
if (!empty($todaysales)) {
    # code...
    foreach ($todaysales as $stockava2) {
        $totalnosaletoday += $stockava2->no_purchased;
        $totalsaletoday += $stockava2->total_amount;
    }
}

$cat = empty($stockava2->cat_type_name) ? $stockava1->cat_type_name : $stockava2->cat_type_name;
$brand = empty($stockava2->brand_name) ? $stockava1->brand_name : $stockava2->brand_name;
$t_name = empty($stockava2->type_name) ? $stockava1->type_name : $stockava2->type_name;
?>
<main class="pt-5 mx-lg-5 d-print-none">
    <div class="container-fluid mt-5">

        <div class="card">
            <div class="card-body p-5">
                <form action="stock_statement.php" method="POST" accept-charset="utf-8" class="d-print-none">
                    <div class="row">
                        <label>Select Date : </label>
                        <input type="date" name="from" id="from" class="form-control-sm ml-3">
                        <!-- <input type="date" name="to" id="to" class="form-control-sm ml-3"> -->
                        <select name="product" id="product" class="form-control-sm ml-3">
                            <option>Select Product Category</option>
                            <option value="All">All Categories</option>
                            <?php foreach ($category_type as $category) : ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->cat_type_name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <select class="ml-3 form-control-sm" id="item_type" name="item_type">
                            <option value="" style="color: #C3C3C3;" selected>Select Type of Item...</option>
                            <option value="All">All Items</option>
                            <?php foreach ($item_type as $key) : ?>
                                <option value="<?php echo $key->id; ?>"><?php echo $key->type_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select class="form-control-sm ml-3" id="brand_type" name="brand_type">
                            <option value="" style="color: #C3C3C3;" selected>Select Product...</option>
                            <option value="All">All Products</option>
                            <?php foreach ($brands as $key) : ?>
                                <option value="<?php echo $key->id; ?>"><?php echo $key->brand_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" name="r_search" id="r_search" class="btn btn-sm btn-danger mt-0">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">
                <h4 class="animated flash delay-2s">
                    <?= ((!empty($_POST['product']) && $_POST['product'] != 'All') ? 'Category: ' . $cat : '') ?>
                    <?= ((!empty($_POST['brand_type']) && $_POST['brand_type'] != 'All') ? ' Name: ' . $brand : '') ?>
                    <?= ((!empty($_POST['item_type']) && $_POST['item_type'] != 'All') ? ' Type: ' . $t_name : '') ?>
                    <br>Stock Statement Available <?= (!empty($_POST) ? 'On : ' . $_POST['from'] : 'Today') ?>
                </h4>
            </div>
            <div class="p-5">
                <div class="body">
                    <div class="row">
                        <!-- <div class="col-3">
                        <div class="card p-2">
                            <h5>Total Stock Available</h5><br>
                            
                            <p class="text-danger text-right"><?= $totalno; ?></p>
                        </div>
                    </div> -->
                        <div class="col-3">
                            <div class="card p-2">
                                <h5>Opening Stock</h5><br>

                                <p class="text-danger text-right"><?= 'GHC ' . number_format((float)$totalstr, 2, '.', ''); ?></p>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card p-2">
                                <h5>Total Sale</h5><br>

                                <p class="text-danger text-right"><?= 'GHC ' . $totalsaletoday; ?></p>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card p-2">
                                <h5>Stock Added</h5><br>

                                <p class="text-danger text-right"><?= 'GHC ' . $totalstselling_price; ?></p>
                            </div>
                        </div>
                        <!-- <div class="col-3">
                        <div class="card p-2">
                            <h5>Stock </h5><br>

                            <p class="text-danger text-right"><?php
                                                                $stleft = ($totalstr - $totalsaletoday) + $totalsttoday;
                                                                echo 'GHC ' . $stleft; ?></p>
                        </div>
                    </div>                                         
                </div>
                <hr>
                <div class="row">
                    <div class="col-3">
                        <div class="card p-2">
                            <h5>Total Selling Price</h5><br>

                            <p class="text-danger text-right"><?php
                                                                echo 'GHC ' . $totalstselling_price; ?></p>
                        </div>
                    </div> -->
                        <div class="col-3">
                            <div class="card p-2">
                                <h5>Closing Stock</h5><br>

                                <p class="text-danger text-right"><?php
                                                                    echo 'GHC ' . number_format((float)$totalstr1, 2, '.', ''); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h5>Sale Details</h5>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Price Type </th>
                                    <th>Sale Type </th>
                                    <th>Number Available</th>
                                    <th>Number Purchased</th>
                                    <th>Selling Price</th>
                                    <th>Total SP</th>
                                    <th>Sold By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($todaysales1)) {

                                    foreach ($todaysales1 as $salemain) : ?>
                                        <tr>
                                            <td><?= $salemain->activity_date; ?></td>
                                            <td><?= $salemain->cat_type_name; ?></td>
                                            <td><?= $salemain->brand_name; ?></td>
                                            <td><?= $salemain->type_name; ?></td>
                                            <td><?= $salemain->price_type; ?></td>
                                            <td><?= $salemain->sold_in; ?></td>
                                            <td><?= $salemain->num_available; ?></td>
                                            <td><?= $salemain->no_purchased; ?></td>
                                            <td><?= $salemain->unit_amount; ?></td>
                                            <td><?= $salemain->total_amount; ?></td>
                                            <td><?= $salemain->soldby; ?></td>
                                        </tr>
                                <?php endforeach;
                                } ?>
                            </tbody>
                        </table><br><br>
                        <h5>Stock Details</h5>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Number Added</th>
                                    <th>Inoice Number</th>
                                    <th>Unit Cost</th>
                                    <th>Selling Price</th>
                                    <th>Total Selling</th>
                                    <th>Total Cost</th>
                                    <th>Expiry Date</th>
                                    <th>Added By</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($checkstocktoday1)) {

                                    foreach ($checkstocktoday1 as $stmain) : ?>
                                        <tr>
                                            <td><?= $stmain->activity_date; ?></td>
                                            <td><?= $stmain->cat_type_name; ?></td>
                                            <td><?= $stmain->brand_name; ?></td>
                                            <td><?= $stmain->type_name; ?></td>
                                            <td><?= $stmain->number_added; ?></td>
                                            <td><?= $stmain->invoice_no; ?></td>
                                            <td><?= $stmain->unitcost_price; ?></td>
                                            <td><?= $stmain->selling_price; ?></td>
                                            <td><?= $stmain->selling_price * $stmain->number_added; ?></td>
                                            <td><?= $stmain->totalcost_price; ?></td>
                                            <td><?php
                                                echo $stmain->expiry_date;
                                                echo ($stmain->expiredays < 365) ? ' <span class="badge badge-danger animated flash infinite">' . $stmain->expiredays . ' Days to Expiry</span>' : '';
                                                ?></td>
                                            <td><?= $stmain->username; ?></td>
                                            <!-- <td>
                                   
                               </td> -->
                                        </tr>
                                <?php endforeach;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
<?php
require APPROOT . '/views/includes/modal.php';
// require APPROOT . '/views/ajaxmodals/post_modal.php';
require APPROOT . '/views/includes/footer.php';

?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#statsfm').on('submit', function(event) {
            event.preventDefault();
            var form_data = new FormData(this);
            // alert('post')
            $.ajax({
                url: "stock_statement.php",
                method: "POST",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function(data) {
                    // console.log(data);
                    var response = JSON.parse(data);
                    // console.log(response.status);
                    if (response.status == 'success') {
                        Swal.fire({
                            type: 'success',
                            title: 'Hey Nice One!!!',
                            html: '<span class="text-danger">' + response.message +
                                '</span>',
                            showConfirmButton: false,
                            width: 400,
                            timer: 3000
                        }).then(function() {
                            $("#statsfm")[0].reset();
                            location.reload();
                        });
                    } else if (response.status == 'error') {
                        Swal.fire({
                            type: 'error',
                            title: 'Oooops!!!',
                            html: '<span class="text-danger">' + response.message +
                                '</span>',
                            showConfirmButton: false,
                            width: 400,
                            timer: 3000
                        })
                    }
                    // $('#notice').html(data);
                }
            });

        });
    });
</script>