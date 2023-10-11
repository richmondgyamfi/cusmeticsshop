<?php
require APPROOT . '/views/includes/navigation.php';
$cusdata = $data['cusdata'];
 ?>

<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <div class="card mb-4 wow fadeIn">
            <div class="card-body d-sm-flex justify-content-between">
                <h4 class="mb-2 mb-sm-0 pt-1">
                    <span>Customers List <i class="fa fa-check text-danger animated rotateIn"></i></span>
                </h4>
            </div>
        </div>
        <div class="row wow fadeIn">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                                cellspacing="0" width="100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="th-sm">Name <i class="fa fa-sort"></i>
                                        </th>
                                        <th class="th-sm">Gender <i class="fa fa-sort"></i>
                                        </th>
                                        <th class="th-sm">Contact <i class="fa fa-sort"></i>
                                        </th>
                                        <th class="th-sm">Email <i class="fa fa-sort"></i>
                                        </th>
                                        <th class="th-sm">Address <i class="fa fa-sort"></i>
                                        </th>
                                        <th class="th-sm">Order Date <i class="fa fa-sort"></i>
                                        </th>
                                        <?php if($grpid == 1): ?>
                                        <th class="th-sm">Action
                                        </th>
                                        <?php elseif($grpid == 2): ?>

                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cusdata as $key): ?>
                                    <tr>
                                        <td><?=$key->customer_name; ?></td>
                                        <td><?=$key->gender; ?></td>
                                        <td><?=$key->phone_no; ?></td>
                                        <td><?=$key->email; ?></td>
                                        <td><?=$key->address.' '.$key->city.' '.$key->suburb.'-'.$key->street_name ?>
                                        </td>
                                        <td><?=$key->submitting_date ?></td>
                                        <?php if($grpid == 1): ?>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target=".editcustomer" data-id="<?=$key->id;?>"
                                                data-customer_name1="<?=$key->customer_name;?>"
                                                data-cus_gender1="<?=$key->gender;?>"
                                                data-phone_number1="<?=$key->phone_no;?>"
                                                data-city_name1="<?=$key->city;?>" data-suburb1="<?=$key->suburb;?>"
                                                data-home_address1="<?=$key->address;?>"
                                                data-digital_address1="<?=$key->digital_address;?>"
                                                data-street_name1="<?=$key->street_name;?>"
                                                data-cus_email1="<?=$key->email;?>"
                                                data-family_size1="<?=$key->family_size;?>"
                                                data-no_bought1="<?=$key->amount_bought;?>"
                                                data-days_to_consume1="<?=$key->days_to_consume;?>"
                                                data-buy_order_date1="<?=$key->buyorder_date;?>"
                                                data-other_details1="<?=$key->other_details;?>" data-toggle="tooltip"
                                                data-placement="left" title="Edit Customers">
                                                <i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target=".delete" data-id="<?=$key->id;?>" data-entry="customer_tb"
                                                data-toggle="tooltip" data-placement="right" title="Delete Customers">
                                                <i class="fa fa-trash"></i></button>
                                        </td>
                                        <?php elseif($grpid == 2): ?>

                                        <?php endif; ?>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Customer Name
                                        </th>
                                        <th>Gender
                                        </th>
                                        <th>Contact
                                        </th>
                                        <th>Email
                                        </th>
                                        <th>Address
                                        </th>
                                        <th>Order Date
                                        </th>
                                        <?php if($grpid == 1): ?>
                                        <th>Action
                                        </th>
                                        <?php elseif($grpid == 2): ?>

                                        <?php endif; ?>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
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
<div class="modal fade editcustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Supplier Form
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="customerform1" accept-charset="utf-8">
                        <input type="hidden" name="cus_id" id="cus_id">
                        <div class="text-center">
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="customer_name1"><i
                                            class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" id="customer_name1" name="customer_name1"
                                    placeholder="Customer Name" aria-label="customer_name1"
                                    aria-describedby="customer_name1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="cus_gender1"><i
                                            class="fa fa-user"></i></span>
                                    <select class="browser-default custom-select form-control rounded"
                                        name="cus_gender1" id="cus_gender1">
                                        <option style="color: #C3C3C3;" selected></option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text md-addon" for="phone_number1"><i
                                            class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" onkeypress="checkint(event)" class="form-control"
                                    placeholder="Phone Number" id="phone_number1" name="phone_number1"
                                    aria-describedby="phone_number1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="city_name1"><i
                                            class="fa fa-bar-chart"></i></span>
                                </div>
                                <input type="text" class="form-control" id="city_name1" name="city_name1"
                                    placeholder="City Name" aria-label="city_name1" aria-describedby="city_name1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="suburb1"><i
                                            class="fa fa-square-o"></i></span>
                                </div>
                                <input type="text" class="form-control" id="suburb1" name="suburb1"
                                    placeholder="Suburb1" aria-label="suburb1" aria-describedby="suburb1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="home_address1"><i
                                            class="fa fa-address-book"></i></span>
                                </div>
                                <input type="text" class="form-control" id="home_address1" name="home_address1"
                                    placeholder="Home Address" aria-label="home_address1"
                                    aria-describedby="home_address1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="digital_address1"><i
                                            class="fa fa-map-marker"></i></span>
                                </div>
                                <input type="text" class="form-control" id="digital_address1" name="digital_address1"
                                    placeholder="Digital Address" aria-label="digital_address1"
                                    aria-describedby="digital_address1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="street_name1"><i
                                            class="fa fa-street-view"></i></span>
                                </div>
                                <input type="text" class="form-control" id="street_name1" name="street_name1"
                                    placeholder="Street Name" aria-label="street_name1" aria-describedby="street_name1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="cus_email1"><i
                                            class="fa fa-envelope"></i></span>
                                </div>
                                <input type="text" class="form-control" id="cus_email1" name="cus_email1"
                                    placeholder="Email Address" aria-label="cus_email1" aria-describedby="cus_email1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="family_size1"><i
                                            class="fa fa-users"></i></span>
                                </div>
                                <input type="number" onkeypress="checkint(event)" class="form-control" id="family_size1"
                                    name="family_size1" placeholder="Family Size" aria-label="family_size1"
                                    aria-describedby="family_size1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="no_bought1"><i
                                            class="fa fa-calendar-plus-o"></i></span>
                                </div>
                                <input type="number" class="form-control" onkeypress="checkint(event)" id="no_bought1"
                                    name="no_bought1" placeholder="How Many Water Customer Buy" aria-label="no_bought1"
                                    aria-describedby="no_bought1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="days_to_consume1"><i
                                            class="fa fa-asterisk"></i></span>
                                </div>
                                <input type="number" class="form-control" id="days_to_consume1" name="days_to_consume1"
                                    placeholder="Days to Consume The Above Bags" aria-label="days_to_consume1"
                                    aria-describedby="days_to_consume1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="buy_order_date1"><i
                                            class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date" class="form-control" id="buy_order_date1" name="buy_order_date1"
                                    placeholder="Last Order/Buying Date" aria-label="buy_order_date1"
                                    aria-describedby="buy_order_date1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="other_details1"><i
                                            class="fa fa-plus-circle"></i></span>
                                </div>
                                <input type="text" class="form-control" id="other_details1" name="other_details1"
                                    placeholder="Other Details" aria-label="other_details1"
                                    aria-describedby="other_details1">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit"
                                name="submit">Update<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce"
                                data-dismiss="modal" onclick="closeModal('editcustomer')">No, Cancel</button>
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
$(".editcustomer").on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var promo_id = button.data('id');
    var customer_name1 = button.data('customer_name1')
    var cus_gender1 = button.data('cus_gender1')
    var phone_number1 = button.data('phone_number1')
    var city_name1 = button.data('city_name1')
    var suburb1 = button.data('suburb1')
    var home_address1 = button.data('home_address1')
    var digital_address1 = button.data('digital_address1')
    var street_name1 = button.data('street_name1')
    var cus_email1 = button.data('cus_email1')
    var family_size1 = button.data('family_size1')
    var no_bought1 = button.data('no_bought1')
    var days_to_consume1 = button.data('days_to_consume1')
    var buy_order_date1 = button.data('buy_order_date1')
    var other_details1 = button.data('other_details1')

    var modal = $(this);
    modal.find('.modal-body #cus_id').val(promo_id);
    modal.find('.modal-body #customer_name1').val(customer_name1);
    modal.find('.modal-body #cus_gender1').val(cus_gender1);
    modal.find('.modal-body #phone_number1').val(phone_number1);
    modal.find('.modal-body #city_name1').val(city_name1);
    modal.find('.modal-body #suburb1').val(suburb1);
    modal.find('.modal-body #home_address1').val(home_address1);
    modal.find('.modal-body #digital_address1').val(digital_address1);
    modal.find('.modal-body #street_name1').val(street_name1);
    modal.find('.modal-body #cus_email1').val(cus_email1);
    modal.find('.modal-body #family_size1').val(family_size1);
    modal.find('.modal-body #no_bought1').val(no_bought1);
    modal.find('.modal-body #days_to_consume1').val(days_to_consume1);
    modal.find('.modal-body #buy_order_date1').val(buy_order_date1);
    modal.find('.modal-body #other_details1').val(other_details1);
});


$(".delete").on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var promo_id = button.data('id');
    var promo_stage = button.data('entry');

    var modal = $(this);
    modal.find('.modal-body #st_id2').val(promo_id);
    modal.find('.modal-body #table').val(promo_stage);
});

$(document).ready(function() {
    $('#customerform1').on('submit', function(event) {
        event.preventDefault();
        if ($('#customer_name1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Type Customers Name',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#phone_number1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Customers Phone Number',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#city_name1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Input City Where Customer Lives',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#home_address1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Type Address Where Customer Lives',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#street_name1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Street Name of Where Customer Resides',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#family_size1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Customers Family Size',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#no_bought1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter How Many Bags of Water Customer Buys',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#days_to_consume1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter How Long it Takes For Customer To Consume Bags Bought',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#buy_order_date1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Select Date Last Ordered/Bought',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            // alert('post')
            $.ajax({
                url: "users/customeredit.php",
                method: "POST",
                data: $('#customerform1').serialize(),
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