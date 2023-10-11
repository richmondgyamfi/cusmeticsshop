<?php
require APPROOT . '/views/includes/navigation.php';
$users = $data['users'];
 ?>

<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h4 class="mb-2 mb-sm-0 pt-1">
                    <span>Users List <i class="fa fa-check text-danger animated rotateIn"></i></span>
                </h4>

                <!-- <form class="d-flex justify-content-center">
            <input type="search" placeholder="Type your query" aria-label="Search" class="form-control">
            <button class="btn btn-danger btn-sm my-0 p" type="submit">
              <i class="fa fa-search"></i>
            </button>

          </form> -->

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

                        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0"
                            width="100%">
                            <thead class="table-dark">
                                <tr>
                                    <th class="th-sm">Full Name <i class="fa fa-sort"></i></th>
                                    <th class="th-sm">Gender<i class="fa fa-sort"></i></th>
                                    <th class="th-sm">Contact<i class="fa fa-sort"></i></th>
                                    <th class="th-sm">Username<i class="fa fa-sort"></i></th>
                                    <th class="th-sm">Email <i class="fa fa-sort"></i></th>
                                    <th class="th-sm">Position <i class="fa fa-sort"></i></th>
                                    <th class="th-sm">Date Added<i class="fa fa-sort"></i></th>
                                    <?php if($grpid == 1): ?>
                                    <th class="th-sm">Action</th>
                                    <?php elseif($grpid == 2): ?>

                                    <?php endif; ?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $key): ?>
                                <tr>
                                    <td><?=$key->fname.' '.$key->lname.' '.$key->other_name; ?></td>
                                    <td><?=$key->gender; ?></td>
                                    <td><?=$key->phone_no; ?></td>
                                    <td><?=$key->fname.$key->lname; ?></td>
                                    <td><?=$key->email; ?></td>
                                    <td><?=(($key->group_id == 2)? 'Shop Attendant':'Adminstrator'); ?></td>
                                    <td><?=$key->submitting_date; ?></td>
                                    <?php if($grpid == 1): ?>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target=".edituser" data-id="<?=$key->id;?>"
                                            data-fname1="<?=$key->fname;?>" data-lname1="<?=$key->lname?>"
                                            data-othername1="<?=$key->other_name;?>" data-birth_date1="<?=$key->dob;?>"
                                            data-gender1="<?=$key->gender;?>" data-user_phone_no1="<?=$key->phone_no;?>"
                                            data-role1="<?=$key->group_id;?>" data-user_email1="<?=$key->email;?>"
                                            data-user_address1="<?=$key->address;?>"
                                            data-user_city1="<?=$key->city_name;?>"
                                            data-user_suburb1="<?=$key->suburb;?>" data-toggle="tooltip"
                                            data-placement="left" title="Edit User">
                                            <i class="fa fa-pencil"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target=".delete" data-id="<?=$key->id;?>" data-entry="users_tb"
                                            data-toggle="tooltip" data-placement="right" title="Delete User">
                                            <i class="fa fa-trash"></i></button>
                                    </td>
                                    <?php elseif($grpid == 2): ?>

                                    <?php endif; ?>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Full Name
                                    </th>
                                    <th>Gender
                                    </th>
                                    <th>Contact
                                    </th>
                                    <th>Username
                                    </th>
                                    <th>Email
                                    </th>
                                    <th>Position
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

<div class="modal fade edituser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">User Form
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" onclick="closeModal('edituser')"
                    aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="edituserform1" accept-charset="utf-8">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="fname1"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="fname1" name="fname1" placeholder="First Name"
                                aria-label="fname1" aria-describedby="fname1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="lname1"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="lname1" name="lname1" placeholder="Last Name"
                                aria-label="lname1" aria-describedby="lname1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="othername1"><i
                                        class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="othername1" name="othername1"
                                placeholder="Other Name" aria-label="othername1" aria-describedby="othername1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="birth_date1"><i
                                        class="fa fa-calendar"></i></span>
                            </div>
                            <input type="date" class="form-control" id="birth_date1" name="birth_date1"
                                placeholder="Date of Birth" aria-label="birth_date1" aria-describedby="birth_date1">
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="Gender1"><i class="fa fa-male"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control rounded" name="gender1"
                                id="gender1">
                                <option style="color: #C3C3C3;" selected></option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="user_phone_no1"><i
                                        class="fa fa-phone"></i></span>
                            </div>
                            <input type="text" onkeypress="checkint(event)" class="form-control"
                                placeholder="Phone Number" id="user_phone_no1" name="user_phone_no1"
                                aria-describedby="user_phone_no1">
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="role1"><i class="fa fa-drupal"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control rounded" name="role1" id="role1">
                                <option style="color: #C3C3C3;" selected></option>
                                <option value="1">Adminstrator</option>
                                <option value="2">Shop Attendant</option>
                            </select>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="user_email1"><i
                                        class="fa fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email Address" id="user_email1"
                                name="user_email1" aria-describedby="user_email1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="user_address1"><i
                                        class="fa fa-map-pin"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Address" id="user_address1"
                                name="user_address1" aria-describedby="user_address1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="user_city1"><i
                                        class="fa fa-map-marker"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="City" id="user_city1" name="user_city1"
                                aria-describedby="user_city1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="user_suburb1"><i
                                        class="fa fa-map-signs"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Suburb" id="user_suburb1"
                                name="user_suburb1" aria-describedby="user_suburb1">
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit"
                                name="submit">Save<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce"
                                data-dismiss="modal" onclick="closeModal('edituser')">No, Cancel</button>
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
$(".edituser").on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var promo_id = button.data('id');
    var fname1 = button.data('fname1');
    var lname1 = button.data('lname1');
    var othername1 = button.data('othername1');
    var birth_date1 = button.data('birth_date1');
    var gender1 = button.data('gender1');
    var user_phone_no1 = button.data('user_phone_no1');
    var role1 = button.data('role1');
    var user_email1 = button.data('user_email1');
    var user_address1 = button.data('user_address1');
    var user_city1 = button.data('user_city1');
    var user_suburb1 = button.data('user_suburb1');

    var modal = $(this);
    modal.find('.modal-body #user_id').val(promo_id);
    modal.find('.modal-body #fname1').val(fname1)
    modal.find('.modal-body #lname1').val(lname1)
    modal.find('.modal-body #othername1').val(othername1)
    modal.find('.modal-body #birth_date1').val(birth_date1)
    modal.find('.modal-body #gender1').val(gender1)
    modal.find('.modal-body #user_phone_no1').val(user_phone_no1)
    modal.find('.modal-body #role1').val(role1)
    modal.find('.modal-body #user_email1').val(user_email1)
    modal.find('.modal-body #user_address1').val(user_address1)
    modal.find('.modal-body #user_city1').val(user_city1)
    modal.find('.modal-body #user_suburb1').val(user_suburb1)
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
    $('#edituserform1').on('submit', function(event) {
        event.preventDefault();
        if ($('#fname1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'First Name Cannot be Empty',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#lname1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Last Name Cannot be Empty',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#birth_date1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Select Date of Birth',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#gender1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Select Gender',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#user_phone_no1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Phone Number of User',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#role1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter User Role',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#user_address1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Users Address',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#user_city1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter City User Stays',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#user_suburb1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Suburb Cannot be Empty',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            // alert('post')
            $.ajax({
                url: "users/useredit.php",
                method: "POST",
                data: $('#edituserform1').serialize(),
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