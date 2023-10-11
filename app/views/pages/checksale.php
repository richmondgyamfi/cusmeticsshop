<?php
require APPROOT . '/views/includes/navigation.php';
// $tdate =date("Y-m-d");
// $stdata = $data['todaysaleslist_indvidual'];
// die();
$stdata = $data['todaysales'];

?>


<!--Main Navigation-->

<!--Main layout-->
<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h4 class="mb-2 mb-sm-0 pt-1">
                    <span>Sales List <i class="fa fa-check text-danger animated rotateIn"></i></span>
                </h4>
                <?php
                // var_dump($stdata);
                //echo date("Y-m-d"); 
                ?>
            </div>

        </div>
        <!-- Heading -->

        <!--Grid row-->
        <div class="row wow fadeIn">

            <!--Grid column-->
            <div class="col-md-12 mb-4">

                <!--Card-->
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
                                    foreach ($data['todaysaleslist_indvidual'] as $key1) {
                                        $tot += $key1->total_amount;
                                        $tots += $key1->totalsold;
                                        $units += $key1->total_unitamtsold;
                                    }
                                    foreach ($data['todaysaleslist_indvidual'] as $key1) :
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

                    <!--Card content-->
                    <div class="card-body">

                        <table id="dtBasicExample" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
                            <thead class="table-dark">
                                <tr>
                                    <th class="th-sm">Category <i class="fa fa-sort"></i>
                                    </th>
                                    <th class="th-sm">Product <i class="fa fa-sort"></i>
                                    </th>
                                    <th class="th-sm">Type <i class="fa fa-sort"></i>
                                    </th>
                                    <th class="th-sm">Price Type <i class="fa fa-sort"></i></th>
                                    <th class="th-sm">Sale Type <i class="fa fa-sort"></i></th>
                                    <th class="th-sm">No. Bought<i class="fa fa-sort"></i>
                                    </th>
                                    <th class="th-sm">Selling P. <i class="fa fa-sort"></i>
                                    </th>
                                    <th class="th-sm">Total P. <i class="fa fa-sort"></i>
                                    </th>
                                    <th class="th-sm">Sold By <i class="fa fa-sort"></i>
                                        <?php if ($grpid == 1) : ?>
                                    <th class="th-sm">Action <i class="fa fa-sort"></i></th>
                                <?php elseif ($grpid == 2) : ?>

                                <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tot = 0;
                                $sp = 0;
                                $nb = 0;
                                foreach ($stdata as $key) {
                                    $tot += $key->total_amount;
                                    $sp += $key->unit_amount;
                                    $nb += $key->no_purchased;
                                }
                                foreach ($stdata as $key) :
                                ?>
                                    <tr>
                                        <td><?= $key->cat_type_name; ?></td>
                                        <td><?= $key->brand_name; ?></td>
                                        <td><?= (empty($key->type_name) ? 'Sachet(s)' : $key->type_name); ?></td>
                                        <td><?= $key->price_type; ?></td>
                                        <td><?= $key->sold_in; ?></td>
                                        <td><?= $key->no_purchased; ?></td>
                                        <td><?= $key->unit_amount; ?></td>
                                        <td><?= $key->total_amount; ?></td>
                                        <td><?= $key->soldby; ?></td>
                                        <?php if ($grpid == 1) : ?>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".editsale" data-id="<?= $key->main_id; ?>" data-entry="<?= $key->no_purchased; ?>" data-unitamount="<?= $key->unit_amount; ?>" data-totalamount="<?= $key->total_amount; ?>" data-toggle="tooltip" data-placement="left" title="Edit Sale"><i class="fa fa-pencil"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".delete" data-id="<?= $key->main_id; ?>" data-entry="sales_tb" data-toggle="tooltip" data-placement="right" title="Delete Sale"><i class="fa fa-trash"></i></button>
                                            </td>
                                        <?php elseif ($grpid == 2) : ?>

                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Category
                                    </th>
                                    <th>Product
                                    </th>
                                    <th>Type
                                    </th>
                                    <th>Price Type</th>
                                    <th>Sale Type</th>
                                    <th>Total Bought: <?= $nb; ?>
                                    </th>
                                    <th>Total S.P.: <?= $sp; ?>
                                    </th>
                                    <th>Total Sale: <?= $tot; ?>
                                    </th>
                                    <?php if ($grpid == 1) : ?>
                                        <th>Action</th>
                                    <?php elseif ($grpid == 2) : ?>

                                    <?php endif; ?>

                                </tr>
                            </tfoot>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade editsale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Edit Sale
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="editsellform1" accept-charset="utf-8">
                        <input type="hidden" name="st_id" id="st_id">
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="buying_price2">Selling Price: </span>
                            </div>
                            <input type="text" onkeypress="checkint(event)" class="form-control" placeholder="Selling Price" id="buying_price2" value="" name="buying_price2" aria-describedby="buying_price2">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="amount_purchased2">No Bought: </span>
                            </div>
                            <input type="text" onkeypress="checkint(event)" class="form-control" placeholder="Number Bought" autocomplete="off" id="amount_purchased2" value="<?= $nopurchased; ?>" onblur="calculate()" name="amount_purchased2" aria-describedby="amount_purchased2">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="total_amount2">Total Amount: </span>
                            </div>
                            <input type="text" onkeypress="checkint(event)" class="form-control" id="total_amount2" name="total_amount2" value="<?= $totalamt; ?>" aria-describedby="total_amount2">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit" name="submit">Update Sale<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce" data-dismiss="modal" onclick="closeModal('editsale')">Cancel Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require APPROOT . '/views/includes/modal.php';
require APPROOT . '/views/includes/footer.php';

?>

<script>
    $(".editsale").on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var promo_id = button.data('id');
        var promo_stage = button.data('entry');
        var unitamount = button.data('unitamount');
        var totalamount = button.data('totalamount');

        var modal = $(this);
        modal.find('.modal-body #st_id').val(promo_id);
        modal.find('.modal-body #amount_purchased2').val(promo_stage);
        modal.find('.modal-body #buying_price2').val(unitamount);
        modal.find('.modal-body #total_amount2').val(totalamount);
    });

    $(".delete").on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var promo_id = button.data('id');
        var promo_stage = button.data('entry');

        var modal = $(this);
        modal.find('.modal-body #st_id2').val(promo_id);
        modal.find('.modal-body #table').val(promo_stage);
    });

    calculate = function() {
        var resources = document.getElementById('buying_price2').value;
        var minutes = document.getElementById('amount_purchased2').value;
        document.getElementById('total_amount2').value = parseInt(resources) * parseInt(minutes);
    }

    $(document).ready(function() {
        $('#editsellform1').on('submit', function(event) {
            event.preventDefault();
            if ($('#amount_purchased2').val() == '') {
                Swal.fire({
                    position: 'top-left',
                    type: 'error',
                    title: 'Ooops!!!',
                    text: 'Please Enter Number of Items That Was Purchased',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if ($('#buying_price2').val() == '') {
                Swal.fire({
                    position: 'top-left',
                    type: 'error',
                    title: 'Ooops!!!',
                    text: 'Selling Price Cannot Be Empty',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if ($('#total_amount2').val() == '') {
                Swal.fire({
                    position: 'top-left',
                    type: 'error',
                    title: 'Ooops!!!',
                    text: 'Total Price Cannot Be Empty',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else {
                // alert('post')
                $.ajax({
                    url: "users/sellproductupdate.php",
                    method: "POST",
                    data: $('#editsellform1').serialize(),
                    success: function(data) {
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
                    }
                });
            }

        });
    });
</script>