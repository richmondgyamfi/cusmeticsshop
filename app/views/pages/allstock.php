<?php
require APPROOT . '/views/includes/navigation.php';
$stdata = $data['stdata'];
 ?>

<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <div class="card mb-4 wow fadeIn d-print-none">
            <div class="card-body d-sm-flex justify-content-between row">
                <h4 class="mb-2 mb-sm-0 pt-1">
                    <span>All Stock Page <i class="fa fa-check text-danger animated rotateIn"></i></span>
                </h4>
                <?php 
          $tot = 0;
          $stot = 0;
          $sp = 0;
          $usp = 0;
          $nb = 0;

          if(!empty($stdata)){
          foreach ($stdata as $key) {
            $ts = $key->selling_price*$key->number_added;
            $tot += $key->totalcost_price;
            $sp += $key->unitcost_price;
            $usp += $key->selling_price;
            $nb += $key->number_added; 
            $stot += $ts;            
           }
          }
          // var_dump($stdata);
          // die();
           ?>
                <form action="" method="POST" accept-charset="utf-8" class="d-print-none">
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

                            <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0"
                                width="100%">
                                <thead class="table-sm table-dark">
                                    <tr>
                                        <th class="th-sm">Category <i class="fa fa-sort ml-1"></i>
                                        </th>
                                        <th class="th-sm">Product <i class="fa fa-sort ml-1"></i>
                                        </th>
                                        <th class="th-sm">Type <i class="fa fa-sort ml-1"></i>
                                        </th>
                                        <!-- <th class="th-sm">Buying type <i class="fa fa-sort ml-1"></i></th> -->
                                        <th class="th-sm">Number Added <i class="fa fa-sort ml-1"></i></th>
                                        <th class="th-sm">Supplier <i class="fa fa-sort ml-1"></i></th>
                                        <th class="th-sm">Invoice Number <i class="fa fa-sort ml-1"></i>
                                        </th>
                                        <th class="th-sm">Unit Cost Price <i class="fa fa-sort ml-1"></i></th>
                                        <th class="th-sm">Unit Selling Price <i class="fa fa-sort ml-1"></i></th>
                                        <th class="th-sm">Wholesale Price <i class="fa fa-sort ml-1"></i></th>
                                        <th class="th-sm">Total Cost Price <i class="fa fa-sort ml-1"></i></th>
                                        <!-- <th class="th-sm">Total Selling Price <i class="fa fa-sort ml-1"></i></th> -->
                                        <th class="th-sm">Added By <i class="fa fa-sort ml-1"></i></th>
                                        <th class="th-sm">Date Added <i class="fa fa-sort ml-1"></i></th>
                                        <th class="th-sm">Expiry Date<i class="fa fa-sort ml-1"></i></th>
                                        <?php if($grpid == 1): ?>

                                        <th class="th-sm">Action <i class="fa fa-sort ml-1"></i></th>
                                        <?php endif;?>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php                
                foreach ($stdata as $key):
                  $ts = $key->selling_price*$key->number_added;
                  ?>
                                    <tr>
                                        <td><?=$key->cat_type_name; ?></td>
                                        <td><?=$key->brand_name; ?></td>
                                        <td><?=(empty($key->type_name)?'Sachet(s)':$key->type_name);?></td>
                                        <!-- <td><?=$key->sell_name; ?></td> -->
                                        <td><?=$key->number_added; ?></td>
                                        <td><?=$key->suppliers_name; ?></td>
                                        <td><?=$key->invoice_no; ?></td>
                                        <td><?=$key->unitcost_price; ?></td>
                                        <td><?=$key->selling_price; ?></td>
                                        <td><?=$key->wholesale_selling_price; ?></td>
                                        <td><?=$key->totalcost_price; ?></td>
                                        <!-- <td><?=$ts; ?> GH&#8373;</td> -->
                                        <td><?=$key->username; ?></td>
                                        <td><?=$key->activity_date; ?></td>
                                        <td><?php
                   echo $key->expiry_date; 
                   echo ($key->expiredays<365)?' <span class="badge badge-danger animated flash infinite">'.$key->expiredays.' Days to Expiry</span>':'';
                   ?></td>
                                        <?php if($grpid == 1): ?>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm wave-effect"
                                                data-toggle="modal" data-target=".editstock"
                                                data-id="<?=$key->main_id;?>" data-cat="<?=$key->itemcat_type_id; ?>"
                                                data-brand="<?=$key->brand_id; ?>" data-type="<?=$key->item_type_id; ?>"
                                                data-number="<?=$key->number_added; ?>"
                                                data-supplier="<?=$key->suppliers_name; ?>"
                                                data-invoice="<?=$key->invoice_no; ?>"
                                                data-unitcost="<?=$key->unitcost_price; ?>"
                                                data-totalcost="<?=$key->totalcost_price; ?>"
                                                data-sell_name="<?=$key->selling_type_id; ?>"
                                                data-selling="<?=$key->selling_price; ?>"
                                                data-wholesale="<?=$key->wholesale_selling_price; ?>"
                                                data-toggle="tooltip" data-placement="left" title="Edit Stock"><i
                                                    class="fa fa-pencil"></i>
                                            </button>
                                            <!--<button type="button" class="btn btn-danger btn-sm wave-effect" data-toggle="modal" 
                    data-target=".delete" data-id="<?=$key->main_id;?>" data-entry="stock_tb" 
                    data-toggle="tooltip" data-placement="right" title="Delete Brand">
                    <i class="fa fa-trash"></i></button>-->
                                        </td>
                                        <?php endif;?>
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
                                        <!-- <th>Buying type</th> -->
                                        <th>Total Added: <?= $nb?>
                                        </th>
                                        <th>Supplier</th>
                                        <th>Invoice Number</i>
                                        </th>
                                        <th>Total Unit C.P: <?= $sp ?>
                                        </th>
                                        <th class="th-sm">Total Unit S.P: <?=$usp;?></th>
                                        <th class="th-sm"></th>
                                        <!-- <th>Total C.P: <?=$tot?></th> -->
                                        <th class="th-sm">Total S.P: <?=$stot;?></th>
                                        <th>Added By</th>
                                        <th>Date Added</th>
                                        <?php if($grpid == 1): ?>
                                        <th>Action</th>
                                        <?php endif;?>
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

<div class="modal fade right editstock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-side modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Update Stock <i
                        class="fa fa-shopping-basket ml-1 animated rotateIn"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="updatestock" accept-charset="utf-8">
                        <input type="hidden" class="form-control" id="st_id2" name="stockid">
                        <input type="hidden" class="form-control" id="product_category_type"
                            name="product_category_type">
                        <input type="hidden" class="form-control" id="product_type" name="product_type">
                        <input type="hidden" class="form-control" id="brand_type_name" name="brand_type_name">
                        <input type="hidden" class="form-control" id="buying_kind" name="buying_kind">
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="no_added">Number of Item Added</span>
                            </div>
                            <input type="number" onkeypress="checkint(event)" class="form-control"
                                placeholder="Number Added" id="no_added" name="no_added" aria-describedby="no_added">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="unit_price">Unit Price </span>
                            </div>
                            <input type="text" class="form-control" onkeypress="checkint(event)"
                                placeholder="Unit Cost Price" id="unit_price" name="unit_price"
                                aria-describedby="unit_price">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="total_price">Cost Price </span>
                            </div>
                            <input type="text" class="form-control" onkeypress="checkint(event)"
                                placeholder="Total Cost Price" id="total_price" name="total_price"
                                aria-describedby="total_price">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="selling_price">Selling Price</span>
                            </div>
                            <input type="text" class="form-control" onkeypress="checkint(event)"
                                placeholder="Selling Price" id="selling_price" name="selling_price"
                                aria-describedby="selling_price">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="wholesale_selling_price">Wholesale Selling
                                    Price</span>
                            </div>
                            <input type="text" class="form-control" onkeypress="checkint(event)"
                                placeholder="Wholesale Selling Price" id="wholesale_selling_price"
                                name="wholesale_selling_price" aria-describedby="wholesale_selling_price">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="invoice_no">Invoice Number</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Invoice Number" id="invoice_no"
                                name="invoice_no" aria-describedby="invoice_no">
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger animated bounce">Update Data<i
                                    class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce"
                                data-dismiss="modal">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#updatestock').on('submit', function(event) {
        event.preventDefault();
        // alert('post')
        $.ajax({
            url: "users/updatestocks.php",
            method: "POST",
            data: $('#updatestock').serialize(),
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

$(".editstock").on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var promo_id = button.data('id');
    var cat = button.data('cat');
    var brand = button.data('brand');
    var type = button.data('type');
    var number = button.data('number');
    var supplier = button.data('supplier');
    var invoice = button.data('invoice');
    var unitcost = button.data('unitcost');
    var totalcost = button.data('totalcost');
    var sell_name = button.data('sell_name');
    var selling = button.data('selling');
    var wholesale = button.data('wholesale');

    var modal = $(this);
    modal.find('.modal-body #st_id2').val(promo_id);
    modal.find('.modal-body #product_category_type').val(cat);
    modal.find('.modal-body #product_type').val(brand);
    modal.find('.modal-body #brand_type_name').val(type);
    modal.find('.modal-body #no_added').val(number);
    modal.find('.modal-body #supplier').val(supplier);
    modal.find('.modal-body #invoice_no').val(invoice);
    modal.find('.modal-body #unit_price').val(unitcost);
    modal.find('.modal-body #total_price').val(totalcost);
    modal.find('.modal-body #buying_kind').val(sell_name);
    modal.find('.modal-body #selling_price').val(selling);
    modal.find('.modal-body #wholesale_selling_price').val(wholesale);
});

$(".delete").on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var promo_id = button.data('id');
    var promo_stage = button.data('entry');

    var modal = $(this);
    modal.find('.modal-body #st_id2').val(promo_id);
    modal.find('.modal-body #table').val(promo_stage);
});
</script>