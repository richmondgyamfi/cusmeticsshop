<!--Footer-->
<footer class="page-footer text-center fixed-bottom font-small danger-color-dark darken-2 mt-4 wow fadeIn d-print-none">
    <!--Copyright-->
    <div class="footer-copyright py-3">
        &copy; <script>
        document.write(new Date().getFullYear());
        </script> Copyright:
        <a href="" target="_blank"> Animé Studios </a>
    </div>
    <!--/.Copyright-->

</footer>

<script src="/public/js/jquery-3.4.1.min.js" type="text/javascript" charset="utf-8" async defer></script>
<script type="text/javascript" src="/public/js/popper.min.js"></script>
<script src="/public/js/bootstrap.min.js" type="text/javascript" charset="utf-8" async defer></script>
<script src="/public/js/mdb.min.js" type="text/javascript" charset="utf-8" async defer></script>
<script type="text/javascript" src="/public/vendor/js/sweetalert2.js"></script>
<script src="/public/js/addons/datatables.js" type="text/javascript" charset="utf-8" async defer></script>
<script src="/public/js/addons/datatables-select.min.js" type="text/javascript" charset="utf-8" async defer></script>
<script type="text/javascript" charset="utf-8" async defer>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).ready(function() {
    $('#sellform1').on('submit', function(event) {
        event.preventDefault();
        if ($('#amount_purchased1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Number of Items Being Purchased',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            // alert('post')
            $.ajax({
                url: "users/sellproduct.php",
                method: "POST",
                data: $('#sellform1').serialize(),
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



$(document).ready(function() {
    $('#sellform1_price').on('submit', function(event) {
        event.preventDefault();
        // alert('post')
        $.ajax({
            url: "users/change_product_price.php",
            method: "POST",
            data: $('#sellform1_price').serialize(),
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

    });
});

$(document).ready(function() {
    $('#checkoutfm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: "users/checkout.php",
            method: "POST",
            data: $('#checkoutfm').serialize(),
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

    });
});

function edit_user(id) {
    var data = {
        "id": id
    };
    jQuery.ajax({
        url: '../ajaxmodals/post_modal.php',
        method: "post",
        data: data,
        success: function(data) {
            jQuery('body').append(data);
            jQuery('#edituser').modal('toggle');
        },
        error: function() {
            alert("Something went wrong");
        }
    });
}

function sell_st(id) {
    var data = {
        "id": id
    };
    jQuery.ajax({
        url: '../ajaxmodals/post_modal.php',
        method: "post",
        data: data,
        success: function(data) {
            jQuery('body').append(data);
            jQuery('#sellProduct').modal('toggle');
        },
        error: function() {
            alert("Something went wrong");
        }
    });
}

function checkout(id) {
    var data = {
        "id": id
    };
    jQuery.ajax({
        url: '../ajaxmodals/post_modal.php',
        method: "post",
        data: data,
        success: function(data) {
            jQuery('body').append(data);
            jQuery('#checkout').modal('toggle');
        },
        error: function() {
            alert("Something went wrong");
        }
    });
}

function delete_user(id) {
    var data = {
        "id": id
    };
    jQuery.ajax({
        url: '../ajaxmodals/post_modal.php',
        method: "post",
        data: data,
        success: function(data) {
            jQuery('body').append(data);
            jQuery('#deleteuser').modal('toggle');
        },
        error: function() {
            alert("Something went wrong");
        }
    });
}

function delete_sale(id) {
    var data = {
        "id": id
    };
    jQuery.ajax({
        url: '../ajaxmodals/post_modal.php',
        method: "post",
        data: data,
        success: function(data) {
            jQuery('body').append(data);
            jQuery('#deletesale').modal('toggle');
        },
        error: function() {
            alert("Something went wrong");
        }
    });
}

function branddelete(id) {
    var data = {
        "id": id
    };
    jQuery.ajax({
        url: '../ajaxmodals/post_modal.php',
        method: "post",
        data: data,
        success: function(data) {
            jQuery('body').append(data);
            jQuery('#branddelete').modal('toggle');
        },
        error: function() {
            alert("Something went wrong");
        }
    });
}

function delete_sup(id) {
    var data = {
        "id": id
    };
    jQuery.ajax({
        url: '../ajaxmodals/post_modal.php',
        method: "post",
        data: data,
        success: function(data) {
            jQuery('body').append(data);
            jQuery('#supdelete').modal('toggle');
        },
        error: function() {
            alert("Something went wrong");
        }
    });
}


function delete_cus(id) {
    var data = {
        "id": id
    };
    jQuery.ajax({
        url: '../ajaxmodals/post_modal.php',
        method: "post",
        data: data,
        success: function(data) {
            jQuery('body').append(data);
            jQuery('#cusdelete').modal('toggle');
        },
        error: function() {
            alert("Something went wrong");
        }
    });
}


function edit_customer(id) {
    var data = {
        "id": id
    };
    jQuery.ajax({
        url: '../ajaxmodals/post_modal.php',
        method: "post",
        data: data,
        success: function(data) {
            jQuery('body').append(data);
            jQuery('#editcustomer').modal('toggle');
        },
        error: function() {
            alert("Something went wrong");
        }
    });
}

function edit_supplier(id) {
    var data = {
        "id": id
    };
    jQuery.ajax({
        url: '../ajaxmodals/post_modal.php',
        method: "post",
        data: data,
        success: function(data) {
            jQuery('body').append(data);
            jQuery('#editsupplier').modal('toggle');
        },
        error: function() {
            alert("Something went wrong");
        }
    });
}

function edit_sale(id) {
    var data = {
        "id": id
    };
    jQuery.ajax({
        url: '../ajaxmodals/post_modal.php',
        method: "post",
        data: data,
        success: function(data) {
            jQuery('body').append(data);
            jQuery('#editsale').modal('toggle');
        },
        error: function() {
            alert("Something went wrong");
        }
    });
}

function brandedit(id) {
    var data = {
        "id": id
    };
    jQuery.ajax({
        url: '../ajaxmodals/post_modal.php',
        method: "post",
        data: data,
        success: function(data) {
            jQuery('body').append(data);
            jQuery('#editbrand').modal('toggle');
        },
        error: function() {
            alert("Something went wrong");
        }
    });
}

function delivery(id) {
    var data = {
        "id": id
    };
    jQuery.ajax({
        url: '../ajaxmodals/post_modal.php',
        method: "post",
        data: data,
        success: function(data) {
            jQuery('body').append(data);
            jQuery('#delivery').modal('toggle');
        },
        error: function() {
            alert("Something went wrong");
        }
    });
}


$(document).ready(function() {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
});
</script>
</body>

</html>