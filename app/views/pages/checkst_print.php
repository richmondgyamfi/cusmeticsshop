<?php
require APPROOT . '/views/includes/navigation.php';
$stdata = $data['stockavailable'];
$cart = $data['orders'];
// var_dump($cart); die();
  $supplier = $data['supplier'];

?>

<style type="text/css">
@media print {
    #tbprint {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        float: left;
        font-size: 20px;
    }

    .modal {
        padding: 0 !important; // override inline padding-right added from js
    }

    .modal .modal-dialog {
        width: 100%;
        max-width: none;
        height: 100%;
        margin: 0;
        font-size: 20px;
    }

    .modal .modal-content {
        font-size: 20px;
        height: auto;
        border: 0;
        border-radius: 0;
    }

    .modal .modal-body {
        overflow-y: auto;
    }


}
</style>


<!--Main Navigation-->

<!--Main layout-->
<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h4 class="mb-2 mb-sm-0 pt-1">
                    <?php
          // var_dump($cart);
          if($grpid == 1): ?>
                    <span>Stock Page <i class="fa fa-check text-danger animated rotateIn"></i></span>
                    <?php elseif($grpid == 2): ?>
                    <span>Sell Page <i class="fa fa-check text-danger animated rotateIn"></i></span>
                    <?php endif; ?>

                </h4>
                <!-- <form class="d-flex justify-content-center">
            <input type="search" placeholder="Type your query" aria-label="Search" class="form-control">
            <button class="btn btn-danger btn-sm my-0 p" type="submit">
              <i class="fa fa-search"></i>
            </button>

          </form> -->
                <button class="btn btn-danger btn-sm mt-0 d-print-none" data-toggle="tooltip" data-placement="top"
                    title="Print" onclick="print()"><i class="fa fa-print fa-2x" aria-hidden="true"></i></button>
            </div>

        </div>
        <!-- Heading -->

        <!--Grid row-->
        <div class="row wow fadeIn">

            <!--Grid column-->
            <div class="col-md-12 mb-4">

                <!--Card-->
                <div class="card">

                    <!--Card content-->
                    <div class="card-body">
                        <div class="row d-print-block">
                            <div class="<?=(($grpid == 2 && !empty($cart))?'col-7':'col-12') ?>">
                                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0"
                                    width="100%">
                                    <thead class="table-sm table-dark">
                                        <tr>
                                            <th class="th-sm">Image <i class="fa fa-sort ml-1"></i></th>
                                            <th class="th-sm">Category <i class="fa fa-sort ml-1"></i></th>
                                            <th class="th-sm">Brand <i class="fa fa-sort ml-1"></i>
                                            </th>
                                            <th class="th-sm">Type <i class="fa fa-sort ml-1"></i>
                                            </th>
                                            <!-- <th class="th-sm">Buying type <i class="fa fa-sort ml-1"></i></th> -->
                                            <th class="th-sm">No Available <i class="fa fa-sort ml-1"></i>
                                            </th>
                                            <th class="th-sm">Selling Price <i class="fa fa-sort ml-1"></i>
                                            </th>
                                            <th class="th-sm">Wholesale Price <i class="fa fa-sort ml-1"></i>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php                
                foreach ($stdata as $key): 
                  ?>
                                        <tr>
                                            <td><img src="<?=(empty($key->item_pic)?URLROOT.'/public/img/lightbox/preloader.gif':URLROOT.'/public/img/products/'.$key->item_pic);?>"
                                                    width="50" height="50" alt="img">
                                            </td>
                                            <td><?=$key->cat_type_name; ?></td>
                                            <td><?=$key->brand_name; ?></td>
                                            <td><?=(empty($key->type_name)?'Sachet(s)':$key->type_name);?></td>
                                            <!-- <td><?=$key->sell_name; ?></td> -->
                                            <td><?=$key->number_added.' '.(($key->number_added < 10)?'<span class="badge badge-danger ml-2 animated flash infinite">Re-order</span>':''); ?>
                                            </td>
                                            <td><?=$key->selling_price; ?></td>
                                            <td><?=$key->wholesale_selling_price; ?></td>>

                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot class="d-print-none">
                                        <tr>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Brand
                                            </th>
                                            <th>Type
                                            </th>
                                            <!-- <th>Buying type</th> -->
                                            <th>No Available
                                            </th>
                                            <th>Selling Price
                                            </th>
                                            <th>Wholesale Price
                                            </th>
                                            <?php if($grpid == 1): ?>

                                            <?php elseif($grpid == 2): ?>
                                            <th>Action</th>
                                            <?php endif; ?>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-1"></div>
                            <?php if($grpid == 2 && !empty($cart)): ?>
                            <div class="col-4 mt-5">
                                <table class="table" cellspacing="0">
                                    <thead class="table-sm">
                                        <tr>
                                            <th class="th-sm">Product Bought(No.)
                                            </th>
                                            <th class="th-sm">Unit Price</th>
                                            <th class="th-sm">Total Price
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                $tot = 0;
                $sp = 0;
                $nb = 0;
                foreach ($cart as $key):
                  $tot += $key->total_amount;
                  $sp += $key->unit_amount;
                  $nb += $key->no_purchased;
                  ?>
                                        <tr>
                                            <td><?=$key->brand_name.'('.$key->no_purchased.')'; ?></td>
                                            <td><?=$key->unit_amount; ?></td>
                                            <td><?=$key->total_amount; ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Produuct Bought(No.)
                                            </th>
                                            <th>Total Unit Price: <?=$sp ?>
                                            </th>
                                            <th>Total Price: <?=$tot ?>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target=".checkout" data-id="<?=$key->main_id;?>"
                                        data-entry="<?=$key->selling_price; ?>">Checkout</button></td>
                            </div>
                            <?php endif; ?>
                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<?php
require APPROOT . '/views/includes/footer.php';

 ?>