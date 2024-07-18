<?php
// require APPROOT . '/views/includes/navigation.php';
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
            font-size: 40px !important;
        }

        #imgpri {
            width: 50;
            height: 50;
        }

        #thprint {
            width: auto;
            height: auto;
            margin: 0;
            padding: 0;
            font-size: 65px !important;
        }

        .modal .modal-dialog {
            width: auto;
            max-width: none;
            height: auto;
            margin: 0;
        }

        .modal .modal-content {
            height: auto;
            border: 10;
            border-radius: 10;
            font-size: 40px !important;
        }


    }
</style>
<div class="modal-header bg-danger text-center">
                <h1 class="heading text-center text-dark" id="thprint"><?= SITENAME; ?></h1><br>

                <h4 class="heading text-dark animated flash delay-2s text-center d-print-none">CHECKOUT
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close d-print-none" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body text-uppercase">
                
                <p class="text-center">Tel: 0208173032 / 0249017952 <br>
                    Location: Makola Cowlane Accra<br>

                    <small>Printed at <?= date('H:i:s, d/m/Y'); ?></small>
                </p>
                
                <div>
                    <form action="" method="POST" id="checkoutfm" accept-charset="utf-8">
                        <table class="table" cellspacing="0" width="100%" id="tbprint">
                            <thead class="table-sm">
                                <tr>
                                    <th id="tbprint" class="th-sm">Product Bought
                                    </th>
                                    <th id="tbprint" class="th-sm">Unit Price
                                    <th id="tbprint" class="th-sm">Total Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($cart as $key) :
                                ?>
                                    <tr>
                                        <td id="tbprint"><?= $key->brand_name . '(' . $key->no_purchased . ')'; ?></td>
                                        <td id="tbprint"><?= $key->unit_amount; ?></td>
                                        <td id="tbprint"><?= $key->total_amount; ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>
                                    </th>
                                    <th id="tbprint">Total:
                                    </th>
                                    <th id="tbprint">&#8373 <?= $tot ?>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>

                        <small class="d-none d-print-block">ITEMS SOLD ARE NOT RETURNABLE
                                </small>
                        
                        <p class="text-center">
                            <img class="d-none d-print-block" id="imgpri" src="<?= URLROOT . '/public/img/lightbox/comedigitalize_barcode.png'; ?>" style="width: 100; height:auto;" alt="img">
                        </p>


                        <small class="d-none d-print-block mb-3">COMEDIGITALIZE.COM</small>

                        <div class="modal-footer justify-content-center d-print-none">
                            <!-- <button type="hidden" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit" name="submit">Checkout<i class="far fa-gem ml-1 text-white"></i></button>-->
                            <button class="btn btn-danger btn-sm waves-effect animated bounce d-print-none" data-toggle="tooltip" data-placement="top" title="Print" onclick="print()">Checkout<i class="fa fa-print " aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce d-print-none" data-dismiss="modal" onclick="closeModal('sellProduct')">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php
// require APPROOT . '/views/includes/modal.php';
// require APPROOT . '/views/ajaxmodals/post_modal.php';
require APPROOT . '/views/includes/footer.php';

?>