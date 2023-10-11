<?php
require APPROOT . '/views/includes/navigation.php';
$brands = $data['brands'];
 ?>

<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h4 class="mb-2 mb-sm-0 pt-1">
                    <span>Product List <i class="fa fa-check text-danger animated rotateIn"></i></span>
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

                        <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead class="table-dark">
                                <tr>
                                    <th class="th-sm">Product Name <i class="fa fa-sort ml-1"></i>
                                    </th>
                                    <th class="th-sm">Date Added <i class="fa fa-sort ml-1"></i>
                                    </th>
                                    <?php if($grpid == 1): ?>
                                    <th class="th-sm">Action <i class="fa fa-sort ml-1"></i></th>
                                    <?php elseif($grpid == 2): ?>

                                    <?php endif; ?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($brands as $key): ?>
                                <tr>
                                    <td><?=$key->brand_name; ?></td>
                                    <td><?=$key->activity_date; ?></td>
                                    <?php if($grpid == 1): ?>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm wave-effect"
                                            data-toggle="modal" data-target=".editbrand" data-id="<?=$key->id;?>"
                                            data-entry="<?=$key->brand_name; ?>" data-toggle="tooltip"
                                            data-placement="left" title="Edit Brand"><i
                                                class="fa fa-pencil"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm wave-effect"
                                            data-toggle="modal" data-target=".delete" data-id="<?=$key->id;?>"
                                            data-entry="brands" data-toggle="tooltip" data-placement="right"
                                            title="Delete Brand">
                                            <i class="fa fa-trash"></i></button>
                                    </td>
                                    <?php elseif($grpid == 2): ?>

                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Product Name
                                    </th>
                                    <th>Date Added </th>
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

<div class="modal fade editbrand" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Edit Product
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="editbrandform1" accept-charset="utf-8">
                        <input type="hidden" name="st_id" id="st_id">
                        <div class="md-form input-group" style="font-size: 12px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="brandname">Name: </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Product Name" id="brandname"
                                name="brandname" aria-describedby="brandname">
                        </div>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit"
                                name="submit">Save<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce"
                                data-dismiss="modal" onclick="closeModal('editbrand')">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
<?php 
require APPROOT . '/views/includes/modal.php';
require APPROOT . '/views/includes/footer.php';
 ?>

<script>
$(".editbrand").on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var promo_id = button.data('id');
    var promo_stage = button.data('entry');

    var modal = $(this);
    modal.find('.modal-body #st_id').val(promo_id);
    modal.find('.modal-body #brandname').val(promo_stage);
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
    $('#editbrandform1').on('submit', function(event) {
        event.preventDefault();
        if ($('#brandname').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Product Name',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            // alert('post')
            $.ajax({
                url: "users/brandedit.php",
                method: "POST",
                data: $('#editbrandform1').serialize(),
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