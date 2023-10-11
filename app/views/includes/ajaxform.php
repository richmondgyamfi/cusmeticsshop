<script>
$(document).ready(function() {
    $('#passform').on('submit', function(event) {
        var new_password = document.getElementById("new_password");
        var new_password = new_password.value.length;
        var retype_password = document.getElementById("retype_password");
        var retype_password = retype_password.value.length;
        event.preventDefault();
        if ($('#prev_password').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Current Password',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#new_password').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter New Password',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#retype_password').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Re-Enter Password',
                showConfirmButton: false,
                timer: 2000
            });
        } else if (new_password < 6) {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Password Cannot Be Less Than 6',
                showConfirmButton: false,
                timer: 2000
            });
        } else if (retype_password < 6) {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Re-Enter Password Cannot Be Less Than 6',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            // alert('post')
            $.ajax({
                url: "passwordreset.php",
                method: "POST",
                data: $('#passform').serialize(),
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
    $('#addform').on('submit', function(event) {
        event.preventDefault();
        if ($('#type').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Select type to add',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#pname').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Enter name of product to add',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            // alert('post')
            $.ajax({
                url: "addpro.php",
                method: "POST",
                data: $('#addform').serialize(),
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
    $('#suppplierform').on('submit', function(event) {
        event.preventDefault();
        if ($('#supplier_name').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Name of Supplier',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#phone_no').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Phone Number of Supplier',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#email').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Email of Supplier',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#business_name').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Business Name',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#business_address').val() == '') {
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
                url: "suppliers.php",
                method: "POST",
                data: $('#suppplierform').serialize(),
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
    $('#sellform').on('submit', function(event) {
        event.preventDefault();
        if ($('#product_category').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Select The Category of Product',
                showConfirmButton: false,
                timer: 2000
            });
        }
        // else if ($('#item_type').val() == '') {
        //   Swal.fire({
        //         position: 'top-left',
        //         type: 'error',
        //         title: 'Ooops!!!',
        //         text: 'Please Select Type of Item',
        //         showConfirmButton: false,
        //         timer: 2000
        //       });
        // }
        else if ($('#brand_type').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Select Brand of Item',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#buying_type').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Select Buying Type',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#amount_purchased').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Number Purchased',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#buying_price').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Unit Price',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#total_amount').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Total Amount',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            // alert('post')
            $.ajax({
                url: "../includes/sellproduct.php",
                method: "POST",
                data: $('#sellform').serialize(),
                success: function(data) {
                    $('#notice').html(data);
                }
            });
        }

    });
});


$(document).ready(function() {
    $('#customerform').on('submit', function(event) {
        event.preventDefault();
        if ($('#customer_name').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Type Customers Name',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#phone_number').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Customers Phone Number',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#city_name').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Input City Where Customer Lives',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#home_address').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Type Address Where Customer Lives',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#street_name').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Street Name of Where Customer Resides',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#family_size').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Customers Family Size',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#no_bought').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter How Many Bags of Water Customer Buys',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#days_to_consume').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter How Long it Takes For Customer To Consume Bags Bought',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#buy_order_date').val() == '') {
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
                url: "addcustomer.php",
                method: "POST",
                data: $('#customerform').serialize(),
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
    $('#stockform').on('submit', function(event) {
        event.preventDefault();
        var form_data = new FormData(this);
        if ($('#product_category_type').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Select Category Product',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#buying_kind').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Brand Type',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#supplier').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Select Supplier',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#no_added').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Number of Items Added',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#unit_price').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter The Unit Price',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#total_price').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Total Price',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#selling_price').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Selling Price',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#invoice_no').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Invoice Number',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            // alert('post')
            $.ajax({
                url: "stocks.php",
                method: "POST",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
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
                            $("#stockform")[0].reset();
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
        }

    });
});

$(document).ready(function() {
    $('#stockupdate').on('submit', function(event) {
        event.preventDefault();
        var form_data = new FormData(this);
        if ($('#product_cat').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Select Category Product',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#buying_kd').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Brand Type',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#supplier1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Select Supplier',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#no_added1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Number of Items Added',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#unit_price1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter The Unit Price',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#total_price1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Total Price',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#selling_price1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Selling Price',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#invoice_no1').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Invoice Number',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            // alert('post')
            $.ajax({
                url: "stockupdate.php",
                method: "POST",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
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
                            $("#stockupdate")[0].reset();
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
        }

    });
});


$(document).ready(function() {
    $('#userform').on('submit', function(event) {
        event.preventDefault();
        if ($('#fname').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'First Name Cannot be Empty',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#lname').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Last Name Cannot be Empty',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#birth_date').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Select Date of Birth',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#gender').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Select Gender',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#user_phone_no').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Phone Number of User',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#role').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter User Role',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#user_address').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Users Address',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#user_city').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter City User Stays',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#user_suburb').val() == '') {
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
                url: "adduser.php",
                method: "POST",
                data: $('#userform').serialize(),
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
    $('#expenditure_form').on('submit', function(event) {
        event.preventDefault();
        if ($('#exp_name').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'First Name Cannot be Empty',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#amount').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Amount Cannot be Empty',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            // alert('post')
            $.ajax({
                url: "expenses.php",
                method: "POST",
                data: $('#expenditure_form').serialize(),
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