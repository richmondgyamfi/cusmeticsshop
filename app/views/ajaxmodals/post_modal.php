<?php 
  // include '../core/init.php';
  // $user = new User;
  // $coming_id = $_POST['id'];
  // $coming_id = (int)$coming_id;

  // $brands = $user->alldata('brands');
  // $selling_type = $user->alldata('selling_type');
  // $category_type = $user->alldata('category_type');
  // $item_type = $user->alldata('item_type');
  // $supplier = $user->alldata('suppliers_tb');
  # ************************************************************
# Developer Richmond Gyamfi Nketia 
# Year 2019
# Version 1.0
#
# https://www.comedigitalize.com
# https://github.com/richmondgyamfi
#
#
# ************************************************************
 ?>

<div class="modal fade" id="checkout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-lg modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">CHECKOUT
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
                <?php 
          // $sup_data = $user->finddata('id','stock_available',$coming_id);
          // echo $coming_id;
          $cart = $user->finddata4($coming_id);

          ?>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="checkoutfm" accept-charset="utf-8">
                        <table class="table" cellspacing="0" width="100%">
                            <thead class="table-sm">
                                <tr>
                                    <th class="th-sm">Product Bought
                                    </th>
                                    <th class="th-sm">Unit Price
                                    <th class="th-sm">Total Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
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
                                    <th>Product Bought
                                    </th>
                                    <th>Total Unit Price: <?=$sp ?>
                                    </th>
                                    <th>Total Price: <?=$tot ?>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="modal-footer justify-content-center d-print-none">
                            <!-- <button type="hidden" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit" name="submit">Checkout<i class="far fa-gem ml-1 text-white"></i></button>-->
                            <button class="btn btn-danger btn-sm waves-effect animated bounce" data-toggle="tooltip"
                                data-placement="top" title="Print" onclick="print()">Checkout<i class="fa fa-print "
                                    aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce"
                                data-dismiss="modal" onclick="closeModal('sellProduct')">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="editsale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Edit Sale
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
                <?php
          $sup_data = $user->finddata('id','sales_tb',$coming_id);
          foreach ($sup_data as $key) {            
            $unitamt = $key->unit_amount;
            $unitamt = $key->unit_amount;
            $nopurchased = $key->no_purchased;
            $totalamt = $key->total_amount;
            $st_available_id = $key->id;
          }
          ?>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="editsellform1" accept-charset="utf-8">
                        <input type="hidden" name="st_id" id="st_id" value="<?=$st_available_id; ?>">
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="buying_price2">Selling Price: </span>
                            </div>
                            <input type="text" onkeypress="checkint(event)" class="form-control"
                                placeholder="Selling Price" id="buying_price2" value="<?=$unitamt; ?>"
                                name="buying_price2" aria-describedby="buying_price2">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="amount_purchased2">No Bought: </span>
                            </div>
                            <input type="text" onkeypress="checkint(event)" class="form-control"
                                placeholder="Number Bought" autocomplete="off" id="amount_purchased2"
                                value="<?=$nopurchased; ?>" onblur="calculate()" name="amount_purchased2"
                                aria-describedby="amount_purchased2">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="total_amount2">Total Amount: </span>
                            </div>
                            <input type="text" onkeypress="checkint(event)" class="form-control" id="total_amount2"
                                name="total_amount2" value="<?=$totalamt; ?>" aria-describedby="total_amount2">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit"
                                name="submit">Update Sale<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce"
                                data-dismiss="modal" onclick="closeModal('editsale')">Cancel Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editbrand" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <?php
          $sup_data = $user->finddata('id','brands',$coming_id);
          foreach ($sup_data as $key) {            
            $brandname = $key->brand_name;
            $brandid = $key->id;
          }
          ?>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="editbrandform1" accept-charset="utf-8">
                        <input type="hidden" name="st_id" id="st_id" value="<?=$brandid; ?>">
                        <div class="md-form input-group" style="font-size: 12px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="brandname">Name: </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Product Name" id="brandname"
                                value="<?=$brandname; ?>" name="brandname" aria-describedby="brandname">
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


<div class="modal fade" id="editcustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <?php
          $sup_data = $user->finddata('id','customer_tb',$coming_id);
          // var_dump($sup_data);
          foreach ($sup_data as $key) {
            $st_available_id = $key->id;
          }
          ?>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="customerform1" accept-charset="utf-8">
                        <input type="hidden" name="cus_id" id="cus_id" value="<?=$st_available_id; ?>">
                        <div class="text-center">
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="customer_name1"><i
                                            class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" id="customer_name1" name="customer_name1"
                                    placeholder="Customer Name" value="<?=$key->customer_name;?>"
                                    aria-label="customer_name1" aria-describedby="customer_name1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="cus_gender1"><i
                                            class="fa fa-user"></i></span>
                                    <select class="browser-default custom-select form-control rounded"
                                        name="cus_gender1" id="cus_gender1">
                                        <option value="<?=$key->gender;?>" style="color: #C3C3C3;" selected>
                                            <?=(($key->gender == 'M')?'Male':'Female');?></option>
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
                                    placeholder="Phone Number" id="phone_number1" value="<?=$key->phone_no;?>"
                                    name="phone_number1" aria-describedby="phone_number1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="city_name1"><i
                                            class="fa fa-bar-chart"></i></span>
                                </div>
                                <input type="text" class="form-control" id="city_name1" name="city_name1"
                                    placeholder="City Name" aria-label="city_name1" value="<?=$key->city;?>"
                                    aria-describedby="city_name1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="suburb1"><i
                                            class="fa fa-square-o"></i></span>
                                </div>
                                <input type="text" class="form-control" id="suburb1" name="suburb1"
                                    value="<?=$key->suburb;?>" placeholder="Suburb1" aria-label="suburb1"
                                    aria-describedby="suburb1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="home_address1"><i
                                            class="fa fa-address-book"></i></span>
                                </div>
                                <input type="text" class="form-control" id="home_address1" name="home_address1"
                                    placeholder="Home Address" value="<?=$key->address;?>" aria-label="home_address1"
                                    aria-describedby="home_address1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="digital_address1"><i
                                            class="fa fa-map-marker"></i></span>
                                </div>
                                <input type="text" class="form-control" id="digital_address1" name="digital_address1"
                                    placeholder="Digital Address" value="<?=$key->digital_address;?>"
                                    aria-label="digital_address1" aria-describedby="digital_address1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="street_name1"><i
                                            class="fa fa-street-view"></i></span>
                                </div>
                                <input type="text" class="form-control" id="street_name1" name="street_name1"
                                    placeholder="Street Name" aria-label="street_name1" value="<?=$key->street_name;?>"
                                    aria-describedby="street_name1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="cus_email1"><i
                                            class="fa fa-envelope"></i></span>
                                </div>
                                <input type="text" class="form-control" id="cus_email1" name="cus_email1"
                                    placeholder="Email Address" value="<?=$key->email;?>" aria-label="cus_email1"
                                    aria-describedby="cus_email1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="family_size1"><i
                                            class="fa fa-users"></i></span>
                                </div>
                                <input type="number" onkeypress="checkint(event)" class="form-control" id="family_size1"
                                    name="family_size1" placeholder="Family Size" value="<?=$key->family_size;?>"
                                    aria-label="family_size1" aria-describedby="family_size1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="no_bought1"><i
                                            class="fa fa-calendar-plus-o"></i></span>
                                </div>
                                <input type="number" class="form-control" onkeypress="checkint(event)" id="no_bought1"
                                    name="no_bought1" placeholder="How Many Water Customer Buy" aria-label="no_bought1"
                                    value="<?=$key->amount_bought;?>" aria-describedby="no_bought1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="days_to_consume1"><i
                                            class="fa fa-asterisk"></i></span>
                                </div>
                                <input type="number" class="form-control" id="days_to_consume1" name="days_to_consume1"
                                    placeholder="Days to Consume The Above Bags" value="<?=$key->days_to_consume;?>"
                                    aria-label="days_to_consume1" aria-describedby="days_to_consume1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="buy_order_date1"><i
                                            class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date" class="form-control" id="buy_order_date1" name="buy_order_date1"
                                    placeholder="Last Order/Buying Date" aria-label="buy_order_date1"
                                    value="<?=$key->buyorder_date;?>" aria-describedby="buy_order_date1">
                            </div>
                            <div class="md-form input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text md-addon" for="other_details1"><i
                                            class="fa fa-plus-circle"></i></span>
                                </div>
                                <input type="text" class="form-control" id="other_details1" name="other_details1"
                                    placeholder="Other Details" value="<?=$key->other_details;?>"
                                    aria-label="other_details1" aria-describedby="other_details1">
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


<div class="modal fade" id="editsupplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
          $sup_data = $user->finddata('id','suppliers_tb',$coming_id);
          // var_dump($sup_data);
          foreach ($sup_data as $key) {
            $st_available_id = $key->id;
            $sup_name = $key->suppliers_name;
            $sup_phone = $key->phone_no;
            $sup_email = $key->email;
            $bus_name = $key->business_name;
            $bus_address = $key->address;
            $submiting_date = $key->submitting_date;
          }
          ?>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="supplierform1" accept-charset="utf-8">
                        <input type="hidden" name="sup_id" id="sup_id" value="<?=$st_available_id; ?>">
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


<div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <?php
          $sup_data = $user->finddata('id','users_tb',$coming_id);
          // var_dump($sup_data);
          foreach ($sup_data as $key) {
            $st_available_id = $key->id;
            $first_name = $key->fname;
            $last_name = $key->lname;
            $other_name = $key->other_name;
            $date_birth = $key->dob;
            $user_phone = $key->phone_no;
            $user_group = $key->group_id;
            $user_email = $key->email;
            $address = $key->address;
            $city_name = $key->city_name;
            $suburb = $key->suburb;
            $gender = $key->gender;
            $submiting_date = $key->submitting_date;
          }
          ?>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="edituserform1" accept-charset="utf-8">
                        <input type="hidden" name="user_id" id="user_id" value="<?=$st_available_id; ?>">
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="fname1"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?=$first_name; ?>" id="fname1" name="fname1"
                                placeholder="First Name" aria-label="fname1" aria-describedby="fname1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="lname1"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="lname1" value="<?=$last_name; ?>" name="lname1"
                                placeholder="Last Name" aria-label="lname1" aria-describedby="lname1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="othername1"><i
                                        class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="othername1" name="othername1"
                                value="<?=$other_name;?>" placeholder="Other Name" aria-label="othername1"
                                aria-describedby="othername1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="birth_date1"><i
                                        class="fa fa-calendar"></i></span>
                            </div>
                            <input type="date" class="form-control" id="birth_date1" name="birth_date1"
                                value="<?=$date_birth;?>" placeholder="Date of Birth" aria-label="birth_date1"
                                aria-describedby="birth_date1">
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="Gender1"><i class="fa fa-male"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control rounded" name="gender1"
                                id="gender1">
                                <option value="<?=$gender; ?>" style="color: #C3C3C3;" selected>
                                    <?=(($gender == 'M')?'Male':'Female'); ?></option>
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
                                placeholder="Phone Number" value="<?=$user_phone; ?>" id="user_phone_no1"
                                name="user_phone_no1" aria-describedby="user_phone_no1">
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="role1"><i class="fa fa-drupal"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control rounded" name="role1" id="role1">
                                <option style="color: #C3C3C3;" value="<?=$user_group; ?>" selected>
                                    <?=(($user_group == '1')? 'Adminstrator':'Shop Attendant'); ?></option>
                                <option value="1">Adminstrator</option>
                                <option value="2">Shop Attendant</option>
                            </select>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="user_email1"><i
                                        class="fa fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email Address"
                                value="<?=$user_email; ?>" id="user_email1" name="user_email1"
                                aria-describedby="user_email1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="user_address1"><i
                                        class="fa fa-map-pin"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Address" id="user_address1"
                                name="user_address1" value="<?=$address;?>" aria-describedby="user_address1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="user_city1"><i
                                        class="fa fa-map-marker"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="City" id="user_city1" name="user_city1"
                                value="<?=$city_name;?>" aria-describedby="user_city1">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="user_suburb1"><i
                                        class="fa fa-map-signs"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?=$suburb;?>" placeholder="Suburb"
                                id="user_suburb1" name="user_suburb1" aria-describedby="user_suburb1">
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


<div class="modal fade" id="delivery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <?php
          $sup_data = $user->finddata('id','customer_tb',$coming_id);
          // var_dump($sup_data);
          foreach ($sup_data as $key) {
            $st_available_id = $key->id;
          }
          ?>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="deliveryform1" accept-charset="utf-8">
                        <input type="hidden" name="cus_id" id="cus_id" value="<?=$st_available_id; ?>">
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
                        <div class="md-form input-group mt-1 mb-3" id="ptype">
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


<div class="modal fade" id="cusdelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Delete Supplier
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
                <?php 
          $sup_data = $user->finddata('id','brands',$coming_id);
          foreach ($sup_data as $key) {  
            $st_available_id = $key->id;
          }
          ?>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="deletecusform1" accept-charset="utf-8">
                        <i class="fa fa-trash-o fa-2x text-danger mb-2 animated rotateIn"></i>
                        <input type="hidden" name="st_id2" id="st_id2" value="<?=$st_available_id; ?>">

                        <h5 class="text-danger">ARE YOU SURE YOU WANT TO REMOVE PRODUCT?</h5>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit"
                                name="submit">Yes Remove<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-danger waves-effect animated bounce"
                                data-dismiss="modal" onclick="closeModal('cusdelete')">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="supdelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Delete Supplier
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
                <?php 
          $sup_data = $user->finddata('id','brands',$coming_id);
          foreach ($sup_data as $key) {  
            $st_available_id = $key->id;
          }
          ?>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="deletesupform1" accept-charset="utf-8">
                        <i class="fa fa-trash-o fa-2x text-danger mb-2 animated rotateIn"></i>
                        <input type="hidden" name="st_id2" id="st_id2" value="<?=$st_available_id; ?>">

                        <h5 class="text-danger">ARE YOU SURE YOU WANT TO REMOVE PRODUCT? </h5>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit"
                                name="submit">Yes Remove<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-danger waves-effect animated bounce"
                                data-dismiss="modal" onclick="closeModal('supdelete')">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="branddelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Delete Product
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
                <?php 
          $sup_data = $user->finddata('id','brands',$coming_id);
          foreach ($sup_data as $key) {  
            $st_available_id = $key->id;
          }
          ?>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="deletebrandform1" accept-charset="utf-8">
                        <i class="fa fa-trash-o fa-2x text-danger mb-2 animated rotateIn"></i>
                        <input type="hidden" name="st_id2" id="st_id2" value="<?=$st_available_id; ?>">

                        <h5 class="text-danger">ARE YOU SURE YOU WANT TO REMOVE PRODUCT?</h5>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit"
                                name="submit">Yes Remove<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-danger waves-effect animated bounce"
                                data-dismiss="modal" onclick="closeModal('branddelete')">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Delete User
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
                <?php 
          $sup_data = $user->finddata('id','users_tb',$coming_id);
          foreach ($sup_data as $key) {  
            $st_available_id = $key->id;
          }
          ?>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="deleteuserform1" accept-charset="utf-8">
                        <i class="fa fa-trash-o fa-2x text-danger mb-2 animated rotateIn"></i>
                        <input type="hidden" name="st_id2" id="st_id2" value="<?=$st_available_id; ?>">

                        <h5 class="text-danger">ARE YOU SURE YOU WANT TO REMOVE SALE?</h5>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit"
                                name="submit">Yes Remove<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-danger waves-effect animated bounce"
                                data-dismiss="modal" onclick="closeModal('deleteuser')">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deletesale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Delete Sale
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
                <?php 
          $sup_data = $user->finddata('id','sales_tb',$coming_id);
          foreach ($sup_data as $key) {  
            $st_available_id = $key->id;
          }
          ?>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="deletesellform1" accept-charset="utf-8">
                        <i class="fa fa-trash-o fa-2x text-danger mb-2 animated rotateIn"></i>
                        <input type="hidden" name="st_id2" id="st_id2" value="<?=$st_available_id; ?>">

                        <h5 class="text-danger">ARE YOU SURE YOU WANT TO REMOVE SALE?</h5>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit"
                                name="submit">Yes Remove<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-danger waves-effect animated bounce"
                                data-dismiss="modal" onclick="closeModal('deletesale')">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function yesnoCheck2(that) {
    if ((that.value == "1")) {
        $('#ptype').fadeIn('slow');
    } else {
        $('#ptype').fadeOut('slow');
    }
}


function closeModal(id) {
    var modalid = document.getElementById(id);
    jQuery(modalid).modal('hide');
    setTimeout(function() {
        jQuery(modalid).remove();
        jQuery('.modal_backdrop').remove();
    }, 300);
}

calculate = function() {
    var resources = document.getElementById('buying_price1').value;
    var minutes = document.getElementById('amount_purchased1').value;
    document.getElementById('total_amount1').value = parseInt(resources) * parseInt(minutes);
}
calculate1 = function() {
    var resources = document.getElementById('buying_price4').value;
    var minutes = document.getElementById('amount_purchased4').value;
    document.getElementById('total_amount4').value = parseInt(resources) * parseInt(minutes);
}


$(document).ready(function() {
    $('#editform1').on('submit', function(event) {
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
                url: "../includes/sellproduct.php",
                method: "POST",
                data: $('#editform1').serialize(),
                success: function(data) {
                    $('#notice').html(data);
                }
            });
        }

    });
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
                url: "../includes/sellproduct.php",
                method: "POST",
                data: $('#sellform1').serialize(),
                success: function(data) {
                    $('#notice').html(data);
                }
            });
        }

    });
});

$(document).ready(function() {
    $('#checkoutfm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: "../includes/checkout.php",
            method: "POST",
            data: $('#checkoutfm').serialize(),
            success: function(data) {
                $('#notice').html(data);
            }
        });

    });
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
                url: "../includes/customeredit.php",
                method: "POST",
                data: $('#customerform1').serialize(),
                success: function(data) {
                    $('#notice').html(data);
                }
            });
        }

    });
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
                url: "../includes/useredit.php",
                method: "POST",
                data: $('#edituserform1').serialize(),
                success: function(data) {
                    $('#notice').html(data);
                }
            });
        }

    });
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
                url: "../includes/supplieredit.php",
                method: "POST",
                data: $('#supplierform1').serialize(),
                success: function(data) {
                    $('#notice').html(data);
                }
            });
        }

    });
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
                url: "../includes/brandedit.php",
                method: "POST",
                data: $('#editbrandform1').serialize(),
                success: function(data) {
                    $('#notice').html(data);
                }
            });
        }

    });
});


$(document).ready(function() {
    $('#deletecusform1').on('submit', function(event) {
        event.preventDefault();
        // alert('post')
        $.ajax({
            url: "../includes/updatecus.php",
            method: "POST",
            data: $('#deletecusform1').serialize(),
            success: function(data) {
                $('#notice').html(data);
            }
        });

    });
});


$(document).ready(function() {
    $('#deletesupform1').on('submit', function(event) {
        event.preventDefault();
        // alert('post')
        $.ajax({
            url: "../includes/updatesup.php",
            method: "POST",
            data: $('#deletesupform1').serialize(),
            success: function(data) {
                $('#notice').html(data);
            }
        });

    });
});


$(document).ready(function() {
    $('#deletebrandform1').on('submit', function(event) {
        event.preventDefault();
        // alert('post')
        $.ajax({
            url: "../includes/updatebrand.php",
            method: "POST",
            data: $('#deletebrandform1').serialize(),
            success: function(data) {
                $('#notice').html(data);
            }
        });

    });
});

$(document).ready(function() {
    $('#deletesellform1').on('submit', function(event) {
        event.preventDefault();
        // alert('post')
        $.ajax({
            url: "../includes/updatesale.php",
            method: "POST",
            data: $('#deletesellform1').serialize(),
            success: function(data) {
                $('#notice').html(data);
            }
        });

    });
});


$(document).ready(function() {
    $('#deleteuserform1').on('submit', function(event) {
        event.preventDefault();
        // alert('post')
        $.ajax({
            url: "../includes/updateuser.php",
            method: "POST",
            data: $('#deleteuserform1').serialize(),
            success: function(data) {
                $('#notice').html(data);
            }
        });

    });
});


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
                url: "../includes/ordered_sale.php",
                method: "POST",
                data: $('#deliveryform1').serialize(),
                success: function(data) {
                    $('#notice').html(data);
                }
            });
        }

    });
});


$(document).ready(function() {
    $('#editsellform1').on('submit', function(event) {
        event.preventDefault();
        if ($('#amount_purchased2').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Please Enter Number of Items That Was Purchased',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#buying_price2').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Selling Price Cannot Be Empty',
                showConfirmButton: false,
                timer: 2000
            });
        } else if ($('#total_amount2').val() == '') {
            Swal.fire({
                position: 'top-left',
                type: 'error',
                title: 'Ooops!!!',
                text: 'Total Price Cannot Be Empty',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            // alert('post')
            $.ajax({
                url: "../includes/sellproductupdate.php",
                method: "POST",
                data: $('#editsellform1').serialize(),
                success: function(data) {
                    $('#notice').html(data);
                }
            });
        }

    });
});
</script>