<?php
require APPROOT . '/views/includes/navigation.php';
$stdata = $data['stdata'];
// var_dump($stdata);die();
?>

<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <div class="card mb-4 wow fadeIn d-print-none">
            <div class="card-body d-sm-flex justify-content-between row">
                <h4 class="mb-2 mb-sm-0 pt-1">
                    <span>Report Page <i class="fa fa-check text-danger animated rotateIn"></i></span>
                </h4>
                <?php
                $tot = 0;
                $sp = 0;
                $nb = 0;
                $pm = 0;
                $totalpm = 0;
                if (!empty($stdata)) {
                    foreach ($stdata as $key) {
                        $tot += $key->total_amount;
                        $sp += $key->unit_amount;
                        $nb += $key->no_purchased;
                        $pm += $key->pm;
                        $totalpm += $key->totalpm;
                    }
                    $pm = number_format((float)$pm, 2, '.', '');
                    $totalpm = number_format((float)$totalpm, 2, '.', '');
                }
                ?>
                <form action="report_page.php" method="POST" accept-charset="utf-8" class="d-print-none">
                    <div class="row">
                        <label>Select Date : </label>
                        <input type="date" name="from" id="from" class="form-control-sm ml-3">
                        <input type="date" name="to" id="to" class="form-control-sm ml-3">
                        <button type="submit" name="r_search" id="r_search" class="btn btn-sm btn-danger mt-0">Search</button>
                    </div>
                </form>
                <button class="btn btn-danger btn-sm mt-0" data-toggle="tooltip" data-placement="top" title="Print" onclick="print()"><i class="fa fa-print fa-2x" aria-hidden="true"></i></button>
            </div>
        </div>
        <?php
        if (!empty($stdata)) {
        ?>
            <div class="row wow fadeIn">
                <div class="col-md-12 mb-4">
                    <?php if ($grpid == 1) :
                    ?>

                        <div class="card">

                            <!--Card content-->
                            <div class="card-body">

                                <table id="dtBasicExample" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="th-sm">Sellers Name <i class="fa fa-sort"></i>
                                            </th>
                                            <th class="th-sm">Total Unit Price <i class="fa fa-sort"></i>
                                            </th>
                                            <th class="th-sm">Total Amount Sold <i class="fa fa-sort"></i></th>
                                            <th class="th-sm">Activity Date <i class="fa fa-sort"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $tots = 0;
                                        $units = 0;
                                        foreach ($data['saleslist_indvidual_report'] as $key1) {
                                            $tot += $key1->total_amount;
                                            $tots += $key1->totalsold;
                                            $units += $key1->total_unitamtsold;
                                        }
                                        foreach ($data['saleslist_indvidual_report'] as $key1) :
                                        ?>
                                            <tr>
                                                <td><?= $key1->name; ?></td>
                                                <td><?= $key1->total_unitamtsold; ?></td>
                                                <td><?= $key1->totalsold; ?></td>
                                                <td><?= $key1->activity_date; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name
                                            </th>
                                            <th>Total: <?= $units; ?>
                                            </th>
                                            <th>Total: <?= $tots; ?>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>

                        </div>
                    <?php endif;
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">

                                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                    <caption>Sales From <?= $data['tdate']; ?> to <?= $data['tdate1']; ?></caption>
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="th-sm">Category <i class="fa fa-sort"></i>
                                            </th>
                                            <th class="th-sm">Product <i class="fa fa-sort"></i>
                                            </th>
                                            <th class="th-sm">Type <i class="fa fa-sort"></i>
                                            </th>
                                            <!-- <th class="th-sm">Buying type <i class="fa fa-sort"></i></th> -->
                                            <th class="th-sm">Stock Available<i class="fa fa-sort"></i>
                                            </th>
                                            <th class="th-sm">Number Bought<i class="fa fa-sort"></i></th>
                                            <th class="th-sm">New Stock Available<i class="fa fa-sort"></i>
                                            </th>
                                            <th class="th-sm">Selling Price <i class="fa fa-sort"></i>
                                            </th>
                                            <th class="th-sm">Cost Price <i class="fa fa-sort"></i>
                                            </th>
                                            <th class="th-sm">Unit Profit Margin <i class="fa fa-sort"></i>
                                            </th>
                                            <th class="th-sm">Total Price <i class="fa fa-sort"></i>
                                            </th>
                                            <th class="th-sm">Total Profit Margin <i class="fa fa-sort"></i>
                                            </th>
                                            <th class="th-sm">Sold By <i class="fa fa-sort"></i>
                                            <th class="th-sm">Date <i class="fa fa-sort"></i>
                                            </th>
                                            <th class="th-sm">Action <i class="fa fa-sort"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($stdata as $key) :
                                        ?>
                                            <tr>
                                                <td><?= $key->cat_type_name; ?></td>
                                                <td><?= $key->brand_name; ?></td>
                                                <td><?= (empty($key->type_name) ? 'Sachet(s)' : $key->type_name); ?></td>
                                                <td><?= $key->num_available; ?></td>
                                                <td><?= $key->no_purchased; ?></td>
                                                <td><?= $key->num_available - $key->no_purchased; ?></td>
                                                <td>GH&#8373; <?= $key->unit_amount; ?></td>
                                                <td>GH&#8373; <?= $key->unitcost_price; ?></td>
                                                <td>GH&#8373; <?= number_format((float)$key->pm, 2, '.', ''); ?></td>
                                                <td>GH&#8373; <?= $key->total_amount; ?></td>
                                                <td>GH&#8373; <?= number_format((float)$key->totalpm, 2, '.', ''); ?></td>
                                                <td><?= $key->soldby; ?></td>
                                                <td><?= $key->activity_date; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target=".return" data-id="<?= $key->main_id; ?>" data-sta_id="<?= $key->st_id; ?>" data-entry="sales_tb" data-toggle="tooltip" data-placement="right" title="Sale On Return"><i class="fa fa-reply"></i></button>
                                                    <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".delete" data-id="<?= $key->main_id; ?>" data-entry="sales_tb" data-toggle="tooltip" data-placement="right" title="Delete Sale"><i class="fa fa-trash"></i></button> -->
                                                    <!-- <button type="button" class="btn btn-danger btn-sm"
                                                onclick="delete_sale(<?php echo $key->main_id; ?>)" data-toggle="tooltip"
                                                data-placement="right" title="Delete Sale"><i
                                                    class="fa fa-trash"></i></button> -->
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Category
                                            </th>
                                            <th>Product
                                            </th>
                                            <th>Type
                                            </th>
                                            <!-- <th>Buying type</th> -->
                                            <th>Stock Available
                                            </th>
                                            <th>Total Bought: <?= $nb; ?>
                                            </th>
                                            <th>New Stock Available
                                            </th>
                                            <th>Total S.P.: <?= $sp; ?>
                                            </th>
                                            <th>Total C.P.: <?= $sp; ?>
                                            </th>
                                            <th>Total U.P.M.: <?= $pm; ?>
                                            </th>
                                            <th>Total Sale: <?= $tot; ?>
                                            </th>
                                            <th>Total P.M: <?= $totalpm; ?>
                                            </th>
                                            <th>Sold By</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php } elseif ((isset($_POST['r_search'])) && (empty($stdata))) { ?>
            <h2 style="margin-bottom: 360px;">No Search Found/Empty</h2>
        <?php } else { ?>
            <h2 style="margin-bottom: 360px;">Search by Selecting Date</h2>
        <?php } ?>
    </div>
</main>
<?php
require APPROOT . '/views/includes/modal.php';
require APPROOT . '/views/includes/footer.php';
?>

<script>
    $(".delete").on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var promo_id = button.data('id');
        var promo_stage = button.data('entry');

        var modal = $(this);
        modal.find('.modal-body #st_id2').val(promo_id);
        modal.find('.modal-body #table').val(promo_stage);
    });

    $(".return").on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var promo_id = button.data('id');
        var promo_stage = button.data('entry');
        var sta_id = button.data('sta_id');

        var modal = $(this);
        modal.find('.modal-body #st_id2').val(promo_id);
        modal.find('.modal-body #table').val(promo_stage);
        modal.find('.modal-body #stock_ava_id').val(sta_id);
    });
</script>