<?php
// echo 'pal';
// die();
require APPROOT . '/views/includes/navigation.php';
var_dump($data['barcode_data']);
$stdata = $data['barcode_data'];
foreach ($stdata as $key) {
}
$cart = $data['orders'];


?>
<script>
    var barcode = '';
    var interval;
    document.addEventListener('keydown', function(evt) {
        if (interval)
            clearInterval(interval);
        if (evt.code == 'Enter') {
            if (barcode)
                // document.getElementById('last-barcode').value = barcode;
                handleBarcode(barcode);
            barcode = '';
            return;
        }
        if (evt.key != 'Shift')
            barcode += evt.key;
        interval = setInterval(() => barcode = '', 20);
    });

    function handleBarcode(scanned_barcode) {
        //     // document.querySelectorAll("#last-barcode input[name='last-barcode']");
        //     // document.querySelector('#last-barcode').innerHTML = scanned_barcode;
        //     // document.getElementById('last-barcode').value = scanned_barcode;
        //     console.log(scanned_barcode);
    }

    // handleBarcode = function(scanned_barcode) {
    //     // document.querySelectorAll("#last-barcode input[name='last-barcode']");
    //     // document.querySelector('#last-barcode').innerHTML = scanned_barcode;
    //     document.getElementById('last-barcode').value = scanned_barcode;
    //     console.log(scanned_barcode);
    // }

    // calculate = function() {
    //     var resources = document.getElementById('itemname').value;
    //     var minutes = document.getElementById('amount_purchased1').value;
    //     document.getElementById('total_amount1').value = parseFloat(resources) * parseFloat(minutes);
    // }
    // $(document).ready(function(scanned_barcode) {
    //     // $('#category1').change(function() {
    //     // var parentID = $(this).val();
    //     document.getElementById('last-barcode').value = scanned_barcode;

    //     // $.ajax({
    //     //     url: 'parsers/parser_category.php',
    //     //     method: 'POST',
    //     //     data: {
    //     //         parentID: parentID
    //     //     },
    //     //     success: function(data) {
    //     //         // window.alert(parentID);
    //     //         $('#type_of_item3').html(data);
    //     //     },
    //     //     error: function() {
    //     //         alert("Something went wrong with the child option.")
    //     //     }
    //     // });
    //     // });
    // });
</script>
<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5 mb-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 d-print-none">
                        <div class="mt-5">
                            <h4 class="heading  animated flash delay-2s">Barcode SellPage</i></h4>
                        </div>
                        <form action="" method="POST" id="barcodesale" accept-charset="utf-8">
                            <div class="md-form input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text md-addon" for="barcode">Place curser here:</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Click here..." id="barcode" name="barcode" aria-describedby="barcode">
                            </div>
                        </form>
                        <form action="" method="POST" id="sellform1" accept-charset="utf-8">
                            <div class="row">
                                <div id="course_sel" class="course_sel" name="course_sel">

                                </div>

                                <!-- <div class="md-form input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text md-addon" for="barcode">Total Amount:</span>
                                    </div>
                                    <input type="text" class="form-control" value="' . $itemdata->brand_name . '" id="barcode" name="barcode" aria-describedby="barcode">
                                </div> -->
                            </div>

                        </form>
                    </div>
                    <div class="col-6 d-print-none">
                        <?php if (!empty($cart)) : ?>
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
                                        foreach ($cart as $key) :
                                            $tot += $key->total_amount;
                                            $sp += $key->unit_amount;
                                            $nb += $key->no_purchased;
                                        ?>
                                            <tr>
                                                <td><?= $key->brand_name . '(' . $key->no_purchased . ')'; ?></td>
                                                <td><?= $key->unit_amount; ?></td>
                                                <td><?= $key->total_amount; ?></td>
                                                <th>
                                                    <button type="button" class="text-danger" data-toggle="modal" data-target=".delete_order" data-id="<?= $key->id; ?>" data-entry="sales_tb" data-toggle="tooltip" data-sale_ava_id="<?= $key->st_id; ?>" data-order_no="<?= $key->order_no; ?>" data-placement="right" title="Delete Order">X</button>

                                                </th>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Produuct Bought(No.)
                                            </th>
                                            <th>Total Unit Price: <?= $sp ?>
                                            </th>
                                            <th>Total Price: <?= $tot ?>
                                            </th>

                                        </tr>
                                    </tfoot>
                                </table>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".checkout" data-id="<?= $key->main_id; ?>" data-entry="<?= $key->selling_price; ?>">Checkout</button>
                                    <!-- <a href="print_item.php?<?= 'saleid=' . $key->id . '&orderno=' . $_SESSION['order_no'] . '&sta_id=' . $key->st_id; ?>"
                                        class="btn btn-danger btn-sm" data-id="<?= $key->id; ?>"
                                        data-entry="<?= $key->selling_price; ?>">Checkout</a> -->
                                </td>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
<div class="modal fade delete_order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Delete Order
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="del_order" accept-charset="utf-8">
                        <input type="hidden" name="table" id="table">
                        <input type="hidden" name="saleid" id="saleid">
                        <input type="hidden" name="sale_ava_id" id="sale_ava_id">
                        <input type="hidden" name="order_no" id="order_no">
                        ARE YOU SURE YOU WANT TO DELETE?
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit" name="submit">Delete<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce" data-dismiss="modal" onclick="closeModal('sellProduct')">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade checkout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-lg modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h1 class="heading text-center text-dark" id="thprint"><?= SITENAME; ?></h1><br>

                <h4 class="heading text-dark animated flash delay-2s text-center d-print-none">CHECKOUT
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close d-print-none" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body text-uppercase">
                <hr>
                <p class="text-center">Tel: 0208173032 / 0249017952 <br>
                Location: Makola Cowlane Accra<br>

                    Printed at <?= date('H:i:s, d/m/Y'); ?>
                </p>
                <hr>
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

                        <p class="d-none d-print-block"><br><br> ITEMS SOLD ARE NOT RETURNABLE
                        </p>
                        <br>
                        <p class="text-center">
                            <img class="d-none d-print-block" id="imgpri" src="<?= URLROOT . '/public/img/lightbox/comedigitalize_barcode.png'; ?>" width="200" height="200" alt="img">
                        </p>

                        <br>

                        <p class="d-none d-print-block mb-3">COMEDIGITALIZE.COM</p>

                        <div class="modal-footer justify-content-center d-print-none">
                            <!-- <button type="hidden" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit" name="submit">Checkout<i class="far fa-gem ml-1 text-white"></i></button>-->
                            <button class="btn btn-danger btn-sm waves-effect animated bounce d-print-none" data-toggle="tooltip" data-placement="top" title="Print" onclick="print()">Checkout<i class="fa fa-print " aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce d-print-none" data-dismiss="modal" onclick="closeModal('sellProduct')">No, Cancel</button>
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
    // $(document).ready(function() {
    //     $('#barcodesale').on('submit', function(event) {
    //         event.preventDefault();
    //         var form_data = new FormData(this);
    //         if ($('#barcode').val() == '') {
    //             Swal.fire({
    //                 position: 'top-left',
    //                 type: 'error',
    //                 title: 'Ooops!!!',
    //                 text: 'Please Scan Barcode',
    //                 showConfirmButton: false,
    //                 timer: 2000
    //             });
    //         } else {
    //             // alert('post')
    //             $.ajax({
    //                 url: "barcode.php",
    //                 method: "POST",
    //                 dataType: 'text',
    //                 cache: false,
    //                 contentType: false,
    //                 processData: false,
    //                 data: form_data,
    //                 success: function(data) {
    //                     console.log(data);
    //                     var response = JSON.parse(data);
    //                     console.log(response.brand_name);
    //                     if (response.status == 'success') {
    //                         $('#fm_bar').html(data);
    //                         // $('#fm_bar').html('<input type="text" value="nal">');
    //                         // document.getElementById('brand_name').value = response.brand_name;
    //                         vardata = document.getElementById('brand_name');
    //                         // Swal.fire({
    //                         //     type: 'success',
    //                         //     title: 'Hey Nice One!!!',
    //                         //     html: '<span class="text-danger">' + response.brand_name +
    //                         //         '</span>',
    //                         //     showConfirmButton: false,
    //                         //     width: 400,
    //                         //     timer: 3000
    //                         // }).then(function() {
    //                         //     $("#barcodesale")[0].reset();
    //                         //     location.reload();
    //                         // });
    //                     } else if (response.status == 'error') {
    //                         // Swal.fire({
    //                         //     type: 'error',
    //                         //     title: 'Oooops!!!',
    //                         //     html: '<span class="text-danger">' + response.message +
    //                         //         '</span>',
    //                         //     showConfirmButton: false,
    //                         //     width: 400,
    //                         //     timer: 3000
    //                         // })
    //                     }
    //                     // $('#notice').html(data);
    //                 }
    //             });
    //         }

    //     });
    // });

    $(document).ready(function() {
        // $('#barcode').on('change', function() {
        $('#barcodesale').on('submit', function(event) {
            var rid = $('#barcode').val();
            // alert(rid);
            event.preventDefault();
            // if (rid) {
            $.ajax({
                method: "POST",
                url: '<?php echo URLROOT; ?>/ajaxmodals/courses.php',
                cache: false,
                data: 'rid=' + rid,
                success: function(data) {
                    // alert(data);
                    $('.course_sel').html(data);
                },
                error: function() {
                    alert("Something went wrong with the child option.")
                }
            });
            // }
            // else{
            //     $('#course_sel').html('<option value="">Select option</option>'); 
            // }            
        })
    });

    $(document).ready(function() {
        $('#del_order').on('submit', function(event) {
            event.preventDefault();
            if ($('#saleid').val() == '') {
                Swal.fire({
                    position: 'top-left',
                    type: 'error',
                    title: 'Ooops!!!',
                    text: 'Error please contact admin',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else {
                // alert('post')
                $.ajax({
                    url: "users/del_order.php",
                    method: "POST",
                    data: $('#del_order').serialize(),
                    success: function(data) {
                        var response = JSON.parse(data);
                        // console.log(response.status);
                        if (response.status == 'success') {
                            // Swal.fire({
                            //     type: 'success',
                            //     title: 'Hey Nice One!!!',
                            //     html: '<span class="text-danger">' + response.message +
                            //         '</span>',
                            //     showConfirmButton: false,
                            //     width: 400,
                            //     timer: 3000
                            // }).then(function() {
                            location.reload();
                            // });
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

    $(".delete_order").on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var promo_id = button.data('id');
        var promo_stage = button.data('entry');
        var sale_ava_id = button.data('sale_ava_id');
        var order_no = button.data('order_no');

        var modal = $(this);
        modal.find('.modal-body #saleid').val(promo_id);
        modal.find('.modal-body #table').val(promo_stage);
        modal.find('.modal-body #order_no').val(order_no);
        modal.find('.modal-body #sale_ava_id').val(sale_ava_id);
    });

    $(".checkout").on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var promo_id = button.data('id');
        var promo_stage = button.data('entry');

        var modal = $(this);
        modal.find('.modal-body #recipientid').val(promo_id);
        modal.find('.modal-body #itemname').val(promo_stage);
    });

    function checkint(evt) {
        var ch = String.fromCharCode(evt.which);

        if (!(/[0-9,.+/]/.test(ch))) {
            $(document).ready(function() {
                Swal.fire({
                    position: 'top-left',
                    type: 'error',
                    title: 'ALPHABETS ARE NOT ALLOWED',
                    showConfirmButton: false,
                    timer: 2000

                })
            });
            evt.preventDefault()
        }
    }

    calculate = function() {
        var resources = document.getElementById('itemname').value;
        var minutes = document.getElementById('amount_purchased1').value;
        document.getElementById('total_amount1').value = parseFloat(resources) * parseFloat(minutes);
    }
</script>