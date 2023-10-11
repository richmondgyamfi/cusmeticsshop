<?php
require APPROOT . '/views/includes/navigation.php';
$newu = $data['newu'];
$brands = $data['brands'];
$selling_type = $data['selling_type']; 
$category_type = $data['category_type'];
$item_type = $data['item_type'];
$supplier = $data['supplier'];
?>
<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h4 class="mb-2 mb-sm-0 pt-1">
                    <span>Delivery List <i class="fa fa-check text-danger animated rotateIn"></i></span>
                </h4>
            </div>
        </div>

        <div class="row wow fadeIn">

            <div class="col-md-12 mb-4">

                <div class="card">

                    <!--Card content-->
                    <div class="card-body">

                        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0"
                            width="100%">
                            <thead class="table-dark">
                                <tr>
                                    <th class="th-sm">Name <i class="fa fa-sort"></i>
                                    </th>
                                    <th class="th-sm">Contact
                                    </th>
                                    <th class="th-sm">Last Delivery <i class="fa fa-sort"></i>
                                    </th>
                                    <th class="th-sm">Next Delivery In <i class="fa fa-sort"></i>
                                    </th>
                                    <th class="th-sm">Next Delivery Date <i class="fa fa-sort"></i>
                                    </th>
                                    <?php if($grpid == 1): ?>

                                    <?php elseif($grpid == 2): ?>
                                    <th class="th-sm">Action</th>
                                    <?php endif; ?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($newu)):
                  foreach ($newu as $key): ?>
                                <tr>
                                    <td><?=$key->customer_name; ?></td>
                                    <td><?=$key->phone_no; ?></td>
                                    <td><?=$key->buyorder_date; ?></td>
                                    <td><?=$key->val2.' '.'days'; ?></td>
                                    <td><?php
                    $day = date("Y-m-d");
                     $day1 = $key->val2;
                        echo date('Y-m-d',strtotime($day. ' + '.$day1.' days'));
                     ?></td>
                                    <?php if($grpid == 1): ?>

                                    <?php elseif($grpid == 2): ?>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target=".delivery" data-id="<?=$key->id;?>"
                                            data-entry="<?=$key->selling_price; ?>" data-toggle="tooltip"
                                            data-placement="right" title="Input Delivery">
                                            <i class="fa fa-pencil"></i></button>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach;
                endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name
                                    </th>
                                    <th>Contact
                                    </th>
                                    <th>Last Delivery
                                    </th>
                                    <th>Next Delivery In
                                    </th>
                                    <th>Next Delivery Date
                                    </th>
                                    <?php if($grpid == 1): ?>

                                    <?php elseif($grpid == 2): ?>
                                    <th>Action</th>
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

<div class="modal fade delivery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-sm modal-center modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Delivery Form
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="deliveryform1" accept-charset="utf-8">
                        <input type="hidden" name="cus_id" id="cus_id">
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="product_category1"><i
                                        class="fa fa-sticky-note"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control rounded"
                                onchange="yesnoCheck2(this)" name="product_category1" id="product_category1">
                                <option value="" style="color: #C3C3C3;" selected>Category of Product...</option>
                                <?php foreach($category_type as $key): ?>
                                <option value="<?php echo $key->id; ?>"><?php echo $key->cat_type_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="item_type1"><i
                                        class="fa fa-product-hunt"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control rounded" id="item_type1"
                                name="item_type1">
                                <option value="" style="color: #C3C3C3;" selected>Select Type of Item...</option>
                                <?php foreach($item_type as $key): ?>
                                <option value="<?php echo $key->id; ?>"><?php echo $key->type_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="brand_type1"><i
                                        class="fa fa-tag"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control" id="brand_type1"
                                name="brand_type1">
                                <option value="" style="color: #C3C3C3;" selected>Select Product of Item...</option>
                                <?php foreach($brands as $key): ?>
                                <option value="<?php echo $key->id; ?>"><?php echo $key->brand_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="buying_type1"><i
                                        class="fa fa-bookmark"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control" id="buying_type1"
                                name="buying_type1">
                                <option value="" style="color: #C3C3C3;" selected>Product Kind/Type...</option>
                                <?php foreach($selling_type as $key): ?>
                                <option value="<?php echo $key->id; ?>"><?php echo $key->sell_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="amount_purchased4"><i
                                        class="fa fa-mail-reply"></i></span>
                            </div>
                            <input type="number" onkeypress="checkint(event)" class="form-control"
                                placeholder="Amount Purchased" id="amount_purchased4" name="amount_purchased4"
                                aria-describedby="amount_purchased4">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="buying_price4"><i
                                        class="fa fa-money"></i></span>
                            </div>
                            <input type="number" onkeypress="checkint(event)" class="form-control"
                                placeholder="Unit Amount" id="buying_price4" onblur="calculate1()" name="buying_price4"
                                aria-describedby="buying_price4">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="total_amount4"><i
                                        class="fa fa-money"></i></span>
                            </div>
                            <input type="text" onkeypress="checkint(event)" class="form-control"
                                placeholder="Total Amount" id="total_amount4" readonly name="total_amount4"
                                aria-describedby="total_amount4">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit"
                                name="submit">Save<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce"
                                data-dismiss="modal" onclick="closeModal('delivery')">No, Cancel</button>
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
$(".delivery").on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var promo_id = button.data('id');
    var promo_stage = button.data('entry');

    var modal = $(this);
    modal.find('.modal-body #cus_id').val(promo_id);
    modal.find('.modal-body #itemname').val(promo_stage);
});

calculate1 = function() {
    var resources = document.getElementById('buying_price4').value;
    var minutes = document.getElementById('amount_purchased4').value;
    document.getElementById('total_amount4').value = parseInt(resources) * parseInt(minutes);
}

$(document).ready(function() {
    $('#deliveryform1').on('submit', function(event) {
        event.preventDefault();
        if ($('#product_category1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Select Category of Product',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#brand_type1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Select Product',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#buying_type1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Select Product Kind/Type',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#amount_purchased4').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Type Amount Purchased',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#buying_price4').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Enter Unit Amount',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#total_amount4').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Enter Total Amount',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            // alert('post')
            $.ajax({
                url: "users/ordered_sale.php",
                method: "POST",
                data: $('#deliveryform1').serialize(),
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