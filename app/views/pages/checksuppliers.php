<?php
require APPROOT . '/views/includes/navigation.php';
$supplier = $data['supplier'];
 ?>
<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h4 class="mb-2 mb-sm-0 pt-1">
                    <span>Suppliers List <i class="fa fa-check text-danger animated rotateIn"></i></span>
                </h4>
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

                        <table id="dtBasicExample" class="table table-striped table-sm table-bordered" cellspacing="0"
                            width="100%">
                            <thead class="table-dark">
                                <tr>
                                    <th class="th-sm">Suppliers<i class="fa fa-sort"></i>
                                    </th>
                                    <th class="th-sm">Contacts<i class="fa fa-sort"></i>
                                    </th>
                                    <th class="th-sm">Email<i class="fa fa-sort"></i>
                                    </th>
                                    <th class="th-sm">Address<i class="fa fa-sort"></i>
                                    </th>
                                    <th class="th-sm">Business Name<i class="fa fa-sort"></i>
                                    </th>
                                    <th class="th-sm">Date Added<i class="fa fa-sort"></i>
                                    </th>
                                    <?php if($grpid == 1): ?>
                                    <th class="th-sm">Action<i class="fa fa-sort"></i></th>
                                    <?php elseif($grpid == 2): ?>

                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($supplier as $key): ?>
                                <tr>
                                    <td><?=$key->suppliers_name; ?></td>
                                    <td><?=$key->phone_no; ?></td>
                                    <td><?=$key->email; ?></td>
                                    <td><?=$key->address; ?></td>
                                    <td><?=$key->business_name; ?></td>
                                    <td><?=$key->submitting_date; ?></td>
                                    <?php if($grpid == 1): ?>
                                    <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target=".editsupplier" data-id="<?=$key->id;?>"
                                            data-entry="<?=$key->suppliers_name; ?>" data-phone="<?=$key->phone_no; ?>"
                                            data-email="<?=$key->email; ?>" data-address="<?=$key->address; ?>"
                                            data-business="<?=$key->business_name; ?>" data-toggle="tooltip"
                                            data-placement="left" title="Edit Supplier">
                                            <i class="fa fa-pencil"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target=".delete" data-id="<?=$key->id;?>" data-entry="suppliers_tb"
                                            data-toggle="tooltip" data-placement="right" title="Delete Supplier">
                                            <i class="fa fa-trash"></i></button>
                                    </td>
                                    <?php elseif($grpid == 2): ?>

                                    <?php endif; ?>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Suppliers
                                    </th>
                                    <th>Contacts
                                    </th>
                                    <th>Email
                                    </th>
                                    <th>Address
                                    </th>
                                    <th>Business Name
                                    </th>
                                    <th>Date Added
                                    </th>
                                    <?php if($grpid == 1): ?>
                                    <th>Action</th>
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
</main>

<div class="modal fade editsupplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-sm modal-center modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Supplier Form
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
                <?php
          // $sup_data = $user->finddata('id','suppliers_tb',$coming_id);
          // // var_dump($sup_data);
          // foreach ($sup_data as $key) {
          //   $st_available_id = $key->id;
          //   $sup_name = $key->suppliers_name;
          //   $sup_phone = $key->phone_no;
          //   $sup_email = $key->email;
          //   $bus_name = $key->business_name;
          //   $bus_address = $key->address;
          //   $submiting_date = $key->submitting_date;
          // }
          ?>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="supplierform1" accept-charset="utf-8">
                        <input type="hidden" name="sup_id" id="sup_id">
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="supplier_name1"><i
                                        class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="supplier_name1" name="supplier_name1"
                                placeholder="Supplier Name" aria-label="supplier_name1" value="<?=$sup_name; ?>"
                                aria-describedby="supplier_name1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="phone_no1"><i
                                        class="fa fa-phone"></i></span>
                            </div>
                            <input type="text" onkeypress="checkint(event)" class="form-control"
                                placeholder="Phone Number" id="phone_no1" name="phone_no1" value="<?=$sup_phone; ?>"
                                aria-describedby="phone_no1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="email1"><i
                                        class="fa fa-envelope"></i></span>
                            </div>
                            <input type="email1" class="form-control" value="<?=$sup_email; ?>"
                                placeholder="Email Address" id="email1" name="email1" aria-describedby="email1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="business_name1"><i
                                        class="fa fa-briefcase"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Business Name" id="business_name1"
                                name="business_name1" value="<?=$bus_name; ?>" aria-describedby="business_name1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="business_address1"><i
                                        class="fa fa-address-card"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Business Address"
                                id="business_address1" name="business_address1" value="<?=$bus_address; ?>"
                                aria-describedby="business_address1">
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit"
                                name="submit">Save<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce"
                                data-dismiss="modal" onclick="closeModal('editsupplier')">No, Cancel</button>
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
$(".editsupplier").on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var promo_id = button.data('id');
    var promo_stage = button.data('entry');
    var phone_no = button.data('phone');
    var email = button.data('email');
    var address = button.data('address');
    var business = button.data('business');

    var modal = $(this);
    modal.find('.modal-body #sup_id').val(promo_id);
    modal.find('.modal-body #supplier_name1').val(promo_stage);
    modal.find('.modal-body #phone_no1').val(phone_no);
    modal.find('.modal-body #email1').val(email);
    modal.find('.modal-body #business_name1').val(address);
    modal.find('.modal-body #business_address1').val(business);
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
    $('#supplierform1').on('submit', function(event) {
        event.preventDefault();
        if ($('#supplier_name1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Name of Supplier',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#phone_no1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Phone Number of Supplier',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#email1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Email of Supplier',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#business_name1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Business Name',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#business_address1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Business Address of Supplier',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            // alert('post')
            $.ajax({
                url: "users/supplieredit.php",
                method: "POST",
                data: $('#supplierform1').serialize(),
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