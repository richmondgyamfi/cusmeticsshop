<?php
// $brands = $user->alldata('brands');
// $selling_type = $user->alldata('selling_type');
// $category_type = $user->alldata('category_type');
// $item_type = $user->alldata('item_type');
// $supplier = $user->alldata('suppliers_tb');

$brands = $data['brands'];
$selling_type = $data['selling_type'];
$category_type = $data['category_type'];
$item_type = $data['item_type'];
$supplier = $data['supplier'];
?>

<div class="modal fade right" id="sellProduct1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-side modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Sell Product
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="sellform" accept-charset="utf-8">
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="product_category"><i class="fa fa-sticky-note"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control rounded" onchange="yesnoCheck2(this)" name="product_category" id="product_category">
                                <option value="" style="color: #C3C3C3;" selected>Category of Product...</option>
                                <?php foreach ($category_type as $key) : ?>
                                    <option value="<?php echo $key->id; ?>"><?php echo $key->cat_type_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md-form input-group mt-1 mb-3" id="ptype">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="item_type"><i class="fa fa-product-hunt"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control rounded" id="item_type" name="item_type">
                                <option value="" style="color: #C3C3C3;" selected>Select Type of Item...</option>
                                <?php foreach ($item_type as $key) : ?>
                                    <option value="<?php echo $key->id; ?>"><?php echo $key->type_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="brand_type"><i class="fa fa-tag"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control" id="brand_type" name="brand_type">
                                <option value="" style="color: #C3C3C3;" selected>Select Product...</option>
                                <?php foreach ($brands as $key) : ?>
                                    <option value="<?php echo $key->id; ?>"><?php echo $key->brand_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="buying_type"><i class="fa fa-bookmark"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control" id="buying_type" name="buying_type">
                                <option value="" style="color: #C3C3C3;" selected>Product Kind/Type...</option>
                                <?php foreach ($selling_type as $key) : ?>
                                    <option value="<?php echo $key->id; ?>"><?php echo $key->sell_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="amount_purchased"><i class="fa fa-mail-reply"></i></span>
                            </div>
                            <input type="number" onkeypress="checkint(event)" class="form-control" placeholder="Amount Purchased" id="amount_purchased" name="amount_purchased" aria-describedby="amount_purchased">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="buying_price"><i class="fa fa-money"></i></span>
                            </div>
                            <input type="number" onkeypress="checkint(event)" class="form-control" placeholder="Unit Amount" id="buying_price" name="buying_price" aria-describedby="buying_price">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="total_amount"><i class="fa fa-money"></i></span>
                            </div>
                            <input type="number" onkeypress="checkint(event)" class="form-control" placeholder="Total Amount" id="total_amount" name="total_amount" aria-describedby="total_amount">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger animated bounce" id="submit" name="submit">Submit Data<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce" data-dismiss="modal">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade right" id="change_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Change Password <i class="fa fa-retweet ml-1 animated rotateIn"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="passform" accept-charset="utf-8">
                        <input type="hidden" name="user" id="user" value="<?php echo $userid; ?>">
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="prev_password"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="prev_password" name="prev_password" placeholder="Current Password" aria-label="prev_password" aria-describedby="prev_password">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="new_password"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="New Password" id="new_password" name="new_password" aria-describedby="new_password">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="retype_password"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Re-Enter Password" id="retype_password" name="retype_password" aria-describedby="retype_password">
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger animated bounce" id="submit" name="submit">Change</button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade right" id="add_supplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-side modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Add Supplier <i class="fa fa-shopping-basket ml-1 animated rotateIn"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="suppplierform" accept-charset="utf-8">
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="supplier_name"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Supplier Name" aria-label="supplier_name" aria-describedby="supplier_name">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="phone_no"><i class="fa fa-phone"></i></span>
                            </div>
                            <input type="text" onkeypress="checkint(event)" class="form-control" placeholder="Phone Number" id="phone_no" name="phone_no" aria-describedby="phone_no">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="email"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email Address" id="email" name="email" aria-describedby="email">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="business_name"><i class="fa fa-briefcase"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Business Name" id="business_name" name="business_name" aria-describedby="business_name">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="business_address"><i class="fa fa-address-card"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Business Address" id="business_address" name="business_address" aria-describedby="business_address">
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger animated bounce" id="submit" name="submit">Add Supplier</button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce" data-dismiss="modal">No, Cancel</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade right" id="addpt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-side modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Add Category/Product <i class="fa fa-shopping-basket ml-1 animated rotateIn"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="addform" accept-charset="utf-8">
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="phone_no"><i class="fa fa-plus"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control rounded" name="type" id="type">
                                <option value="" style="color: #C3C3C3;" selected>Select what to add...</option>
                                <option value="1">Add Product Category</option>
                                <option value="2">Add Product Type</option>
                            </select>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="pname"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Enter Name Here" id="pname" name="pname" aria-describedby="pname">
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger animated bounce" id="submit" name="submit">Add</button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce" data-dismiss="modal">No, Cancel</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade right" id="add_customer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-side modal-success" role="document">
        <!--Content-->
        <div class="modal-content" style="border-radius: 10px 10px;">
            <!--Header-->
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Add Customer <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="customerform" accept-charset="utf-8">
                    <div class="text-center">
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="customer_name"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Customer Name" aria-label="customer_name" aria-describedby="customer_name">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="cus_gender"><i class="fa fa-user"></i></span>
                                <select class="browser-default custom-select form-control rounded" name="cus_gender" id="cus_gender">
                                    <option value="" style="color: #C3C3C3;" selected>Gender...</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="phone_number"><i class="fa fa-phone"></i></span>
                            </div>
                            <input type="text" onkeypress="checkint(event)" class="form-control" placeholder="Phone Number" id="phone_number" name="phone_number" aria-describedby="phone_number">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="city_name"><i class="fa fa-bar-chart"></i></span>
                            </div>
                            <input type="text" class="form-control" id="city_name" name="city_name" placeholder="City Name" aria-label="city_name" aria-describedby="city_name">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="suburb"><i class="fa fa-square-o"></i></span>
                            </div>
                            <input type="text" class="form-control" id="suburb" name="suburb" placeholder="Suburb" aria-label="suburb" aria-describedby="suburb">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="home_address"><i class="fa fa-address-book"></i></span>
                            </div>
                            <input type="text" class="form-control" id="home_address" name="home_address" placeholder="Home Address" aria-label="home_address" aria-describedby="home_address">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="digital_address"><i class="fa fa-map-marker"></i></span>
                            </div>
                            <input type="text" class="form-control" id="digital_address" name="digital_address" placeholder="Digital Address" aria-label="digital_address" aria-describedby="digital_address">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="street_name"><i class="fa fa-street-view"></i></span>
                            </div>
                            <input type="text" class="form-control" id="street_name" name="street_name" placeholder="Street Name" aria-label="street_name" aria-describedby="street_name">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="cus_email"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control" id="cus_email" name="cus_email" placeholder="Email Address" aria-label="cus_email" aria-describedby="cus_email">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="family_size"><i class="fa fa-users"></i></span>
                            </div>
                            <input type="number" onkeypress="checkint(event)" class="form-control" id="family_size" name="family_size" placeholder="Family Size" aria-label="family_size" aria-describedby="family_size">
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="brand_type"><i class="fa fa-tag"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control" id="brand_type" name="brand_type">
                                <option value="" style="color: #C3C3C3;" selected>Select Product Bought...</option>
                                <?php foreach ($brands as $key) : ?>
                                    <option value="<?php echo $key->id; ?>"><?php echo $key->brand_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="no_bought"><i class="fa fa-calendar-plus-o"></i></span>
                            </div>
                            <input type="number" class="form-control" onkeypress="checkint(event)" id="no_bought" name="no_bought" placeholder="How Many Product Customer Buy" aria-label="no_bought" aria-describedby="no_bought">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="days_to_consume"><i class="fa fa-asterisk"></i></span>
                            </div>
                            <input type="number" class="form-control" id="days_to_consume" name="days_to_consume" placeholder="Days to Consume The Above Product" aria-label="days_to_consume" aria-describedby="days_to_consume">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="buy_order_date">Order Date</span>
                            </div>
                            <input type="date" class="form-control" id="buy_order_date" name="buy_order_date" placeholder="Last Order/Buying Date" aria-label="buy_order_date" aria-describedby="buy_order_date">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="next_order_date">Next Date</span>
                            </div>
                            <input type="date" class="form-control" id="next_order_date" name="next_order_date" placeholder="Next Order/Buying Date" aria-label="next_order_date" aria-describedby="next_order_date">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="other_details"><i class="fa fa-plus-circle"></i></span>
                            </div>
                            <input type="text" class="form-control" id="other_details" name="other_details" placeholder="Other Details" aria-label="other_details" aria-describedby="other_details">
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-sm btn-danger animated bounce">Add Customer<i class="far fa-gem ml-1 text-white"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce" data-dismiss="modal">No, Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Central Modal Medium Success-->


<!-- Central Modal Medium Success -->
<div class="modal fade right" id="add_stock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-side modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Add Stock <i class="fa fa-shopping-basket ml-1 animated rotateIn"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="stockform" accept-charset="utf-8">
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="product_category_type"><i class="fa fa-sticky-note"></i></span>
                            </div>
                            <select onchange="yesnoCheck1(this)" class="browser-default custom-select form-control rounded" name="product_category_type" id="product_category_type">
                                <option value="" style="color: #C3C3C3;" selected>Product Category Type...</option>
                                <?php foreach ($category_type as $key) : ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->cat_type_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- <div class="md-form input-group mt-1 mb-3" id="but">
              <div class="input-group-prepend">
                <span class="input-group-text md-addon" for="product_type"><i class="fa fa-product-hunt"></i></span>
              </div>
              <select class="browser-default custom-select form-control rounded" name="product_type" id="product_type">
                <option value="" style="color: #C3C3C3;" selected>Product Type...</option>
                <?php foreach ($item_type as $key) : ?>
                <option value="<?php echo $key->id; ?>"><?php echo $key->type_name; ?></option>
              <?php endforeach; ?>
              </select>
            </div> -->
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="product_type"><i class="fa fa-product-hunt"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control rounded" name="product_type" id="product_type">
                                <option value="" style="color: #C3C3C3;" selected>Product Type...</option>
                                <?php foreach ($item_type as $key) : ?>
                                    <option value="<?php echo $key->id; ?>"><?php echo $key->type_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="brand_type_name"><i class="fa fa-tag"></i></span>
                            </div>
                            <select onchange="yesnoCheck(this)" class="browser-default custom-select form-control" id="brand_type_name" name="brand_type_name">
                                <option value="" style="color: #C3C3C3;" selected>Select Product...</option>
                                <?php foreach ($brands as $key) : ?>
                                    <option value="<?php echo $key->id; ?>"><?php echo $key->brand_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md-form input-group" id="brandN">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="brand_name"><i class="fa fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="New Product Name" aria-label="brand_name" aria-describedby="brand_name">
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="buying_kind"><i class="fa fa-bookmark"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control" id="buying_kind" name="buying_kind">
                                <option value="" style="color: #C3C3C3;" selected>Product Kind/Type...</option>
                                <?php foreach ($selling_type as $key) : ?>
                                    <option value="<?php echo $key->id; ?>"><?php echo $key->sell_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="supplier"><i class="fa fa-shopping-cart"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control rounded" name="supplier" id="supplier">
                                <option value="" style="color: #C3C3C3;" selected>Supplier...</option>
                                <?php foreach ($supplier as $key) : ?>
                                    <option value="<?php echo $key->id; ?>"><?php echo $key->suppliers_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="no_added"><i class="fa fa-plus"></i></span>
                            </div>
                            <input type="number" onkeypress="checkint(event)" class="form-control" placeholder="Number Added" id="no_added" name="no_added" aria-describedby="no_added">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="unit_price"><i class="fa fa-money"></i></span>
                            </div>
                            <input type="text" class="form-control" onkeypress="checkint(event)" placeholder="Unit Cost Price" id="unit_price" name="unit_price" aria-describedby="unit_price">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="total_price"><i class="fa fa-money"></i></span>
                            </div>
                            <input type="text" class="form-control" onkeypress="checkint(event)" placeholder="Total Cost Price" id="total_price" name="total_price" aria-describedby="total_price">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="selling_price"><i class="fa fa-money"></i></span>
                            </div>
                            <input type="text" class="form-control" onkeypress="checkint(event)" placeholder="Retail Selling Price" id="selling_price" name="selling_price" aria-describedby="selling_price">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="wholesale_selling_price"><i class="fa fa-money"></i></span>
                            </div>
                            <input type="text" class="form-control" onkeypress="checkint(event)" placeholder="Wholesale Selling Price" id="wholesale_selling_price" name="wholesale_selling_price" aria-describedby="wholesale_selling_price">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon">GH&#8373;</span>
                            </div>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="expiry_date">Expiry Date</span>
                            </div>
                            <input type="date" class="form-control" placeholder="Expiry Date" id="expiry_date" name="expiry_date" aria-describedby="expiry_date">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="invoice_no"><i class="fa fa-ticket"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Invoice Number" id="invoice_no" name="invoice_no" aria-describedby="invoice_no">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="add_img">Add Image: </span>
                            </div>
                            <input type="file" class="form-control" readonly id="add_img" name="add_img" aria-describedby="add_img">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="barcode"><i class="fa fa-ticket"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Barcode" id="barcode" name="barcode" aria-describedby="barcode">
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger animated bounce">Submit Data<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce" data-dismiss="modal">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade right" id="add_expenditure" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-side modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Add Expenditure<i class="fa fa-shopping-basket ml-1 animated rotateIn"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="expenditure_form" accept-charset="utf-8">
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="exp_name"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="exp_name" name="exp_name" placeholder="Expenditure Name" aria-label="exp_name" aria-describedby="exp_name">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="amount"><i class="fa fa-money"></i></span>
                            </div>
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" aria-label="amount" aria-describedby="amount">
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" id="submit" name="submit" class="btn btn-sm btn-danger animated bounce">Add Expenditure<i class="far fa-gem ml-1 text-white"></i></button>
                            <a type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce" data-dismiss="modal">No, Cancel</a>
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
<div class="modal fade right" id="add_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-side modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Add User<i class="fa fa-shopping-basket ml-1 animated rotateIn"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="userform" accept-charset="utf-8">
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="fname"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" aria-label="fname" aria-describedby="fname">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="lname"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" aria-label="lname" aria-describedby="lname">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="othername"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="othername" name="othername" placeholder="Other Name" aria-label="othername" aria-describedby="othername">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-append">
                                <span class="input-group-text md-addon" for="birth_date"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" placeholder="Date of Birth" aria-label="birth_date" aria-describedby="birth_date">
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="Gender"><i class="fa fa-male"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control rounded" name="gender" id="gender">
                                <option value="" style="color: #C3C3C3;" selected>Gender...</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="user_phone_no"><i class="fa fa-phone"></i></span>
                            </div>
                            <input type="text" onkeypress="checkint(event)" class="form-control" placeholder="Phone Number" id="user_phone_no" name="user_phone_no" aria-describedby="user_phone_no">
                        </div>
                        <div class="md-form input-group mt-1 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="role"><i class="fa fa-drupal"></i></span>
                            </div>
                            <select class="browser-default custom-select form-control rounded" name="role" id="role">
                                <option value="" style="color: #C3C3C3;" selected>User Role...</option>
                                <option value="1">Adminstrator</option>
                                <option value="2">Shop Attendant</option>
                            </select>
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="user_email"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email Address" id="user_email" name="user_email" aria-describedby="user_email">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="user_address"><i class="fa fa-map-pin"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Address" id="user_address" name="user_address" aria-describedby="user_address">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="user_city"><i class="fa fa-map-marker"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="City" id="user_city" name="user_city" aria-describedby="user_city">
                        </div>
                        <div class="md-form input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text md-addon" for="user_suburb"><i class="fa fa-map-signs"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Suburb" id="user_suburb" name="user_suburb" aria-describedby="user_suburb">
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" id="submit" name="submit" class="btn btn-sm btn-danger animated bounce">Submit Data<i class="far fa-gem ml-1 text-white"></i></button>
                            <a type="button" class="btn btn-sm btn-outline-danger waves-effect animated bounce" data-dismiss="modal">No, Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Central Modal Medium Success-->

<div class="modal fade" id="genStock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Generate Stock
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="stgen" accept-charset="utf-8">
                        <i class="fa fa-trash-o fa-2x text-danger mb-2 animated rotateIn"></i>
                        <input type="hidden" name="st_id2" id="st_id2">
                        <input type="hidden" name="table" id="table">

                        <h5 class="text-danger">ARE YOU SURE YOU WANT TO GENERATE STOCK?</h5>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit" name="submit">Yes Generate<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-danger waves-effect animated bounce" data-dismiss="modal" onclick="closeModal('genStock')">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Delete Warning
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="deletesellform1" accept-charset="utf-8">
                        <i class="fa fa-trash-o fa-2x text-danger mb-2 animated rotateIn"></i>
                        <input type="hidden" name="st_id2" id="st_id2">
                        <input type="hidden" name="table" id="table">

                        <h5 class="text-danger">ARE YOU SURE YOU WANT TO DELETE?</h5>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit" name="submit">Yes Delete<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-danger waves-effect animated bounce" data-dismiss="modal" onclick="closeModal('deletesale')">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade freeze" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Delete Warning
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="freezesellform1" accept-charset="utf-8">
                        <i class="fa fa-trash-o fa-2x text-danger mb-2 animated rotateIn"></i>
                        <input type="hidden" name="st_id2" id="st_id2">
                        <input type="hidden" name="table" id="table">

                        <h5 class="text-danger">ARE YOU SURE YOU WANT TO FREEZE THIS ITEM?</h5>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit" name="submit">Yes freeze<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-danger waves-effect animated bounce" data-dismiss="modal" onclick="closeModal('deletesale')">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade update_expenses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-danger">
                <h4 class="heading text-white animated flash delay-2s">Delete Warning
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="update_expensessellform1" accept-charset="utf-8">
                        <i class="fa fa-trash-o fa-2x text-danger mb-2 animated rotateIn"></i>
                        <input type="hidden" name="st_id2" id="st_id2">
                        <input type="hidden" name="table" id="table">

                        <h5 class="text-danger">ARE YOU SURE YOU WANT TO UPDATE EXPENSES?</h5>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-danger waves-effect animated bounce" id="submit" name="submit">Yes Update<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-danger waves-effect animated bounce" data-dismiss="modal" onclick="closeModal('deletesale')">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade return" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="notice">
    </div>
    <div class="modal-dialog modal-dialog-scrollable modal-notify modal-center modal-sm modal-success" role="document">
        <div class="modal-content" style="border-radius: 10px 10px;">
            <div class="modal-header bg-info">
                <h4 class="heading text-white animated flash delay-2s">Sale on Return
                    <i class="fa fa-shopping-cart ml-1 animated rotateIn"></i>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="" method="POST" id="returnsellform1" accept-charset="utf-8">
                        <i class="fa fa-reply fa-2x text-danger mb-2 animated rotateIn"></i>
                        <input type="hidden" name="st_id2" id="st_id2">
                        <input type="hidden" name="table" id="table">
                        <input type="hidden" name="stock_ava_id" id="stock_ava_id">

                        <h5 class="text-danger">ARE YOU SURE YOU WANT TO RETURN?</h5>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-sm btn-info waves-effect animated bounce" id="submit" name="submit">Yes Return<i class="far fa-gem ml-1 text-white"></i></button>
                            <button type="button" class="btn btn-sm btn-danger waves-effect animated bounce" data-dismiss="modal" onclick="closeModal('return')">No, Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require APPROOT . '/views/includes/ajaxform.php';

?>
<script>
    $(document).ready(function() {
        $('#returnsellform1').on('submit', function(event) {
            event.preventDefault();
            // alert('post')
            $.ajax({
                url: "users/returnsale.php",
                method: "POST",
                data: $('#returnsellform1').serialize(),
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
                            // location.reload();
                            //windows.location.href="http://localhost:8000/report_page.php";
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
        $('#update_expensessellform1').on('submit', function(event) {
            event.preventDefault();
            // alert('post')
            $.ajax({
                url: "users/update_expenses.php",
                method: "POST",
                data: $('#update_expensessellform1').serialize(),
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
                            // location.reload();
                            //windows.location.href="http://localhost:8000/report_page.php";
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
        $('#freezesellform1').on('submit', function(event) {
            event.preventDefault();
            // alert('post')
            $.ajax({
                url: "users/freezestock.php",
                method: "POST",
                data: $('#freezesellform1').serialize(),
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
                            // location.reload();
                            //windows.location.href="http://localhost:8000/report_page.php";
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
        $('#deletesellform1').on('submit', function(event) {
            event.preventDefault();
            // alert('post')
            $.ajax({
                url: "users/updatesale.php",
                method: "POST",
                data: $('#deletesellform1').serialize(),
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
                            // location.reload();
                            //windows.location.href="http://localhost:8000/report_page.php";
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
        $('#stgen').on('submit', function(event) {
            event.preventDefault();
            // alert('post')
            $.ajax({
                url: "genstock.php",
                method: "POST",
                data: $('#stgen').serialize(),
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


    function yesnoCheck2(that) {
        if ((that.value == "1")) {
            $('#ptype').fadeIn('slow');
        } else if ((that.value == "3")) {
            $('#ptype').fadeIn('slow');
        } else if ((that.value == "4")) {
            $('#ptype').fadeIn('slow');
        } else {
            $('#ptype').fadeOut('slow');
        }
    }

    function yesnoCheck(that) {
        if ((that.value == "")) {
            $('#brandN').fadeIn('slow');
        } else {
            $('#brandN').fadeOut('slow');
        }
    }

    function yesnoCheck1(that) {
        if ((that.value == "1")) {
            $('#but').fadeIn('slow');
        } else if ((that.value == "3")) {
            $('#but').fadeIn('slow');
        } else if ((that.value == "4")) {
            $('#but').fadeIn('slow');
        } else {
            $('#but').fadeOut('slow');
        }
    }

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
</script>