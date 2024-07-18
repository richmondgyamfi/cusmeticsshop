<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->userFunctions = $this->model('Functions');
    }

    public function register()
    {
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            //Validate username on letters/numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username.';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Name can only contain letters and numbers.';
            }

            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email address.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter the correct format.';
            } else {
                //Check if email exists.
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email is already taken.';
                }
            }

            // Validate password on length, numeric values,
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter password.';
            } elseif (strlen($data['password']) < 6) {
                $data['passwordError'] = 'Password must be at least 8 characters';
            } elseif (preg_match($passwordValidation, $data['password'])) {
                $data['passwordError'] = 'Password must be have at least one numeric value.';
            }

            //Validate confirm password
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
                }
            }

            // Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user from model function
                if ($this->userModel->register($data)) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Something went wrong.');
                }
            }
        }
        $this->view('users/register', $data);
    }
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

    public function login()
    {
        $data = [
            'title' => 'Login page',
            'username' => '',
            'password' => '',
            't_error' => '',
            'p_error' => ''
        ];

        //Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // var_dump($_POST);die();
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                't_error' => '',
                'p_error' => ''
            ];
            //Validate username
            if (empty($data['username'])) {
                $data = [
                    't_error' => 'error',
                    'p_error' => 'Please enter a username.'
                ];
                $this->view('users/login', $data);
            }

            //Validate password
            if (empty($data['password'])) {
                $data = [
                    't_error' => 'error',
                    'p_error' => 'Please enter a password.'
                ];
                $this->view('users/login', $data);
            }

            //Check if all errors are empty
            $exp_date = date("Y-m-d");
            if ($exp_date < '2036-01-02') {
                if (empty($data['t_error']) && empty($data['p_error'])) {
                    $loggedInUser = $this->userModel->login($data['username'], $data['password']);
                    // echo 'pal';
                    // var_dump($loggedInUser);die();  

                    if ($loggedInUser) {
                        $activity = 'Login from user ' . ' with username ' . $_POST['username'] . ' username: ' . $data['username'];
                        $data1 = [
                            'user_id' => trim('1'),
                            'activity' => $activity,
                            'username' => trim($_POST['username']),
                            'table' => trim('users_tb')
                        ];
                        $logdata = $this->userModel->log_activity($data1);
                        $logUser = $this->userModel->loginlog($data);
                        if ($logUser) {
                            $this->createUserSession($loggedInUser);
                        }
                    } else {
                        $data = [
                            't_error' => 'error',
                            'p_error' => 'Password or username is incorrect. Please try again.'
                        ];

                        $this->view('users/login', $data);
                    }
                }
            } else {
                $data = [
                    't_error' => 'error',
                    'p_error' => 'Software Update Needed. Report issue to admin'
                ];

                $this->view('users/login', $data);
            }
        } else {
            $data = [
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
        }
        $this->view('users/login', $data);
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->lid;
        $_SESSION['username'] = $user->username;
        $_SESSION['group_id'] = $user->group_id;
        $_SESSION['name'] = $user->name;
        $_SESSION['gname'] = $user->gname;
        $_SESSION['permissions'] = $user->permissions;
        header('location:' . URLROOT . '/index.php');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['group_id']);
        unset($_SESSION['name']);
        unset($_SESSION['gname']);
        unset($_SESSION['permissions']);
        header('location:' . URLROOT . '/users/login.php');
    }

    public function del_order()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();             
                $data = [
                    'st_id' => trim($_POST['saleid']),
                    'sale_ava_id' => trim($_POST['sale_ava_id']),
                    'table' => trim($_POST['table']),
                    'order_no' => trim($_POST['order_no'])
                ];
                $sel_sale = $this->userModel->sel_sale($data);
                $selectstock = $this->userModel->selectstock($data['sale_ava_id']);
                // var_dump($sel_sale);
                // var_dump($selectstock);die();
                if (!empty($sel_sale)) {
                    foreach ($sel_sale as $sel_salekey) {
                        $no_purchased = $sel_salekey->no_purchased;
                    }

                    foreach ($selectstock as $key) {
                        $u_price = $key->unitcost_price;
                        $s_price = $key->selling_price;
                        $num_added = $key->number_added;
                        $selling_type_id = $key->selling_type_id;
                        $item_type_id = $key->item_type_id;
                        $brand_id = $key->brand_id;
                        $itemcat_type_id = $key->itemcat_type_id;
                        $st_available_id = $key->id;
                    }

                    $no_left = $num_added + $no_purchased;
                    $totalsell_sp = $s_price * $no_left;
                    //   var_dump($no_left);die();
                    if ($no_left < 0) {
                        $data1 = [
                            'status' => 'error',
                            'message' => 'STOCK LEFT IS LESS THAN NUMBER OF ITEM PURCHASED!!!'
                        ];
                    } else {
                        $data = [
                            'st_id2' => trim($_POST['saleid']),
                            'stock_ava_id' => trim($_POST['sale_ava_id']),
                            'table' => trim($_POST['table']),
                            'order_no' => trim($_POST['order_no']),
                            'total_sp' => $totalsell_sp,
                            'total_no' => $no_left
                        ];
                        $log_data = $this->userModel->delete($data);
                        if ($log_data) {
                            $update_return = $this->userModel->update_return($data);
                            $stockavailable = $this->userModel->stockavailabledaily();

                            $totalstr = 0;
                            $totalno = 0;
                            foreach ($stockavailable as $stockava) {
                                $totalno += $stockava->number_added;
                                // $totalstr += $stockava->totalsp;
                                $totalstr += $stockava->total_sp;
                                // $totalstr += $stockava->totalsp;
                            }
                            $data1 = [
                                'totalno' => $totalno,
                                'totalstr' => $totalstr
                            ];
                            $this->userModel->insertstockdaily($data1);
                            $activity = 'Updated item from table stock_tb with id ' . $_POST['saleid'] . ' data: ' . 'saleid: ' . trim($_POST['saleid']) .
                                ' stock_ava_id: ' . trim($_POST['sale_ava_id']) .
                                ' table: ' . trim($_POST['table']) .
                                ' order_no: ' . trim($_POST['order_no']);
                            $data2 = [
                                'st_id2' => trim($_POST['st_id2']),
                                'activity' => $activity,
                                'username' => trim($_SESSION['username']),
                                'table' => trim('stock_tb')
                            ];
                            $logdata = $this->userModel->log_activity($data2);
                            $data1 = [
                                'status' => 'success',
                                'message' => 'DONE SUCCESSFULLY!!!'
                            ];
                        } else {
                            $data1 = [
                                'status' => 'error',
                                'message' => 'ERROR TRY AGAIN!!!'
                            ];
                        }
                    }
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'ERROR PLEASE TRY AGAIN!!!'
                    ];
                }


                echo json_encode($data1);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function barcodeproduct()
    {
        if (isset($_SESSION['user_id'])) {
            // echo 'pal';
            // var_dump($_POST);
            $data = [
                'st_id' => trim($_POST['st_id']),
                'barcode' => trim($_POST['barcode'])
            ];
            $checkbarcode = $this->userModel->checkbarcode($data);
            if ($checkbarcode) {
                $data1 = [
                    'status' => 'error',
                    'message' => 'Barcode already exist'
                ];
            } else {
                $updatebarcode = $this->userModel->updatebarcode($data);
                if ($updatebarcode) {
                    $data1 = [
                        'status' => 'success',
                        'message' => 'UPDATED SUCCESSFULLY!!!'
                    ];
                }
            }
            echo json_encode($data1);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function sellproduct()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                if (!empty($_SESSION['order_no'])) {
                    $orders = $this->userModel->orders($_SESSION['order_no']);
                    $orderno = $_SESSION['order_no'];
                } else {
                    $orderno = $this->userFunctions->orderno();
                    $_SESSION['order_no'] = $orderno;
                    $orders = $this->userModel->orders($_SESSION['order_no']);
                }
                $stdate = date("Y-m-d");
                $data = [
                    'orders' => $orderno,
                    'st_id' => trim($_POST['st_id']),
                    'buying_price1' => trim($_POST['buying_price1']),
                    'amount_purchased1' => trim($_POST['amount_purchased1']),
                    'total_amount1' => trim($_POST['total_amount1']),
                    'saletype' => trim($_POST['saletype']),
                    'ptype' => trim($_POST['ptype']),
                    'submitting_date' => trim($stdate)
                ];
                $selectstock = $this->userModel->selectstock($data['st_id']);
                // var_dump($selectstock);die();
                if (!empty($selectstock)) {
                    
                    foreach ($selectstock as $key) {
                        $u_price = $key->unitcost_price;
                        $s_price = $key->selling_price;
                        $t_price = $key->totalcost_price;
                        $num_added = $key->number_added;
                        $selling_type_id = $key->selling_type_id;
                        $item_type_id = $key->item_type_id;
                        $brand_id = $key->brand_id;
                        $itemcat_type_id = $key->itemcat_type_id;
                        $st_available_id = $key->id;
                    }

                    $no_left = $num_added - $data['amount_purchased1'];
                    //   var_dump($no_left);die();
                    if ($no_left < 0) {
                        $data1 = [
                            'status' => 'error',
                            'message' => 'STOCK LEFT IS LESS THAN NUMBER OF ITEM PURCHASED!!!'
                        ];
                    } else {
                        $data = [
                            'order_no' => $orderno,
                            'st_id' => trim($_POST['st_id']),
                            'unit_amount' => trim($_POST['buying_price1']),
                            'no_purchased' => trim($_POST['amount_purchased1']),
                            'total_amount' => trim($_POST['total_amount1']),
                            'saletype' => trim($_POST['saletype']),
                            'ptype' => trim($_POST['ptype']),
                            'itemcat_type_id' => $itemcat_type_id,
                            'item_type_id' => $item_type_id,
                            'brand_id' => $brand_id,
                            'selling_type_id' => $selling_type_id,
                            'num_available' => $num_added,
                            'sale_type' => '1',
                            'pagetype' => '0',
                            'submitting_date' => trim($stdate)
                        ];
                        $log_data = $this->userModel->sellquery($data);
                        if ($log_data) {
                            $stockavailable = $this->userModel->stockavailabledaily();

                            $totalstr = 0;
                            $totalno = 0;
                            foreach ($stockavailable as $stockava) {
                                $totalno += $stockava->number_added;
                                // $totalstr += $stockava->totalsp;
                                $totalstr += $stockava->total_sp;
                                // $totalstr += $stockava->totalsp;
                            }
                            $data1 = [
                                'totalno' => $totalno,
                                'totalstr' => $totalstr
                            ];
                            $this->userModel->insertstockdaily($data1);
                            $activity = 'Updated item from table sells with id ' . $_POST['st_id'] . ' data: ' .
                                ' order_no: ' . $orderno .
                                ' st_id: ' . trim($_POST['st_id']) .
                                ' unit_amount: ' . trim($_POST['buying_price1']) .
                                ' no_purchased: ' . trim($_POST['amount_purchased1']) .
                                ' no_ctn_sold ' . trim($_POST['no_ctn_sold']) .
                                ' pcs_in_ctn_sel ' . trim($_POST['pcs_in_ctn_sel']) .
                                ' total_amount: ' . trim($_POST['total_amount1']) .
                                ' saletype: ' . trim($_POST['saletype']) .
                                ' ptype: ' . trim($_POST['ptype']) .
                                ' itemcat_type_id: ' . $itemcat_type_id .
                                ' item_type_id: ' . $item_type_id .
                                ' brand_id: ' . $brand_id .
                                ' selling_type_id: ' . $selling_type_id .
                                ' num_available: ' . $num_added .
                                ' sale_type: ' . '1' .
                                ' pagetype: ' . '0' .
                                ' submitting_date: ' . trim($stdate);
                            $data2 = [
                                'st_id2' => trim($_POST['st_id']),
                                'activity' => $activity,
                                'username' => trim($_SESSION['username']),
                                'table' => trim('stock_tb')
                            ];
                            $logdata = $this->userModel->log_activity($data2);
                            $data1 = [
                                'status' => 'success',
                                'message' => 'SALES ADDED SUCCESSFULLY!!!'
                            ];
                        } else {
                            $data1 = [
                                'status' => 'error',
                                'message' => 'ERROR POSTING SALE TRY AGAIN!!!'
                            ];
                        }
                    }
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'ERROR POSTING SALES PLEASE TRY AGAIN!!!'
                    ];
                }


                echo json_encode($data1);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function change_product_price()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();               
                $stdate = date("Y-m-d");
                $data = [
                    'st_id' => trim($_POST['st_id']),
                    'buying_price1' => trim($_POST['buying_price1']),
                    'new_price' => trim($_POST['new_price']),
                    'saletype' => trim($_POST['saletype'])
                ];
                if ($data['saletype'] == 'Retail Price') {
                    $log_data = $this->userModel->updatesell_price($data);
                } else {
                    $log_data = $this->userModel->updatesell_wholesale_price($data);
                }
                if ($log_data) {
                    $activity = 'Updated price of item with id ' . $_POST['st_id'] . ' data: ' .
                        ' st_id: ' . trim($_POST['st_id']) .
                        ' buying_price1: ' . trim($_POST['buying_price1']) .
                        ' new_price: ' . trim($_POST['new_price']) .
                        ' saletype: ' . trim($_POST['saletype']);
                    $data2 = [
                        'st_id2' => trim($_POST['st_id']),
                        'activity' => $activity,
                        'username' => trim($_SESSION['username']),
                        'table' => trim('stock_available')
                    ];
                    $logdata = $this->userModel->log_activity($data2);
                    $data1 = [
                        'status' => 'success',
                        'message' => 'PRICE UPDATED SUCCESSFULLY!!!'
                    ];
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'ERROR UPDATING PLEASE TRY AGAIN!!!'
                    ];
                }
                echo json_encode($data1);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }


    public function updatestocks()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                $data = [
                    'itemcat_type_id' => trim($_POST['product_category_type']),
                    'item_type_id' => trim($_POST['brand_type_name']),
                    'brand_id' => trim($_POST['product_type']),
                    'selling_type_id' => trim($_POST['buying_kind']),
                    'st_id' => trim($_POST['stockid']),
                    'no_added' => trim($_POST['no_added']),
                    'unit_price' => trim($_POST['unit_price']),
                    'total_price' => trim($_POST['total_price']),
                    'selling_price' => trim($_POST['selling_price']),
                    'wholesale_selling_price' => trim($_POST['wholesale_selling_price']),
                    'invoice_no' => trim($_POST['invoice_no'])
                ];
                $selectstockadded = $this->userModel->selectstockadded($data);
                // var_dump($selectstockadded);die();
                foreach ($selectstockadded as $key) {
                    $num_added1 = $key->number_added;
                }
                $updatestock = $this->userModel->updatestock($data);
                $selectavailablestock = $this->userModel->selectavailablestock($data);
                // var_dump($selectavailablestock);die();
                if ($selectavailablestock) {
                    foreach ($selectavailablestock as $key) {
                        $u_price = $key->unitcost_price;
                        $s_price = $key->selling_price;
                        $t_price = $key->totalcost_price;
                        $num_added = $key->number_added;
                        $selling_type_id = $key->selling_type_id;
                        $item_type_id = $key->item_type_id;
                        $brand_id = $key->brand_id;
                        $itemcat_type_id = $key->itemcat_type_id;
                        $st_available_id = $key->id;
                    }
                    $noadded = $_POST['no_added'] - $num_added1;

                    $num_added = $num_added + $noadded;

                    $data = [
                        'itemcat_type_id' => trim($_POST['product_category_type']),
                        'item_type_id' => trim($_POST['brand_type_name']),
                        'brand_id' => trim($_POST['product_type']),
                        'selling_type_id' => trim($_POST['buying_kind']),
                        'st_id' => trim($_POST['stockid']),
                        'no_added' => trim($num_added),
                        'unit_price' => trim($_POST['unit_price']),
                        'total_price' => trim($_POST['total_price']),
                        'selling_price' => trim($_POST['selling_price']),
                        'wholesale_selling_price' => trim($_POST['wholesale_selling_price']),
                        'invoice_no' => trim($_POST['invoice_no'])
                    ];
                    $selectstock = $this->userModel->updateavailablestock($data, $st_available_id);
                    // var_dump($selectstock);die();
                    if ($selectstock) {
                        $stockavailable = $this->userModel->stockavailabledaily();

                        $totalstr = 0;
                        $totalno = 0;
                        foreach ($stockavailable as $stockava) {
                            $totalno += $stockava->number_added;
                            // $totalstr += $stockava->totalsp;
                            $totalstr += $stockava->total_sp;
                            // $totalstr += $stockava->totalsp;
                        }
                        $data1 = [
                            'totalno' => $totalno,
                            'totalstr' => $totalstr
                        ];
                        $this->userModel->insertstockdaily($data1);
                        $activity = 'Updated item from table stock_tb with id ' . $_POST['stockid'] . ' data: ' . ' product_category_type: ' . trim($_POST['product_category_type']) .
                            ' brand_type_name: ' . trim($_POST['brand_type_name']) .
                            ' product_type: ' . trim($_POST['product_type']) .
                            ' buying_kind: ' . trim($_POST['buying_kind']) .
                            ' stockid: ' . trim($_POST['stockid']) .
                            ' unit_price: ' . trim($_POST['unit_price']) .
                            ' total_price: ' . trim($_POST['total_price']) .
                            ' selling_price: ' . trim($_POST['selling_price']) .
                            ' wholesale_selling_price: ' . trim($_POST['wholesale_selling_price']) .
                            ' invoice_no: ' . trim($_POST['invoice_no']);
                        $data = [
                            'st_id2' => trim($_POST['st_id2']),
                            'activity' => $activity,
                            'username' => trim($_SESSION['username']),
                            'table' => trim('stock_tb')
                        ];
                        $logdata = $this->userModel->log_activity($data);

                        $data1 = [
                            'status' => 'success',
                            'message' => 'STOCKS UPDATED SUCCESSFULLY!!!'
                        ];
                    } else {
                        $data1 = [
                            'status' => 'error',
                            'message' => 'ERROR POSTING UPDATE TRY AGAIN!!!'
                        ];
                    }
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'PLEASE TRY AGAIN dX1!!!'
                    ];
                }


                echo json_encode($data1);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function ordered_sale()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();                
                $stdate = date("Y-m-d");
                if (empty($_POST['item_type1'])) {
                    $_POST['item_type1'] = '0';
                }
                $data = [
                    'itemcat_type_id' => trim($_POST['product_category1']),
                    'item_type_id' => trim($_POST['item_type1']),
                    'brand_id' => trim($_POST['brand_type1']),
                    'selling_type_id' => trim($_POST['buying_type1'])
                ];

                $selectstock = $this->userModel->checkdata($data);
                // var_dump($selectstock);die();
                if (!empty($selectstock)) {

                    foreach ($selectstock as $key) {
                        $u_price = $key->unitcost_price;
                        $s_price = $key->selling_price;
                        $t_price = $key->totalcost_price;
                        $num_added = $key->number_added;
                        $selling_type_id = $key->selling_type_id;
                        $item_type_id = $key->item_type_id;
                        $brand_id = $key->brand_id;
                        $itemcat_type_id = $key->itemcat_type_id;
                        $st_available_id = $key->id;
                    }
                    $no_left = $num_added - $_POST['amount_purchased4'];
                    //   var_dump($no_left);die();
                    if ($no_left < 0) {
                        $data1 = [
                            'status' => 'error',
                            'message' => 'STOCK LEFT IS LESS THAN NUMBER OF ITEM PURCHASED!!!'
                        ];
                    } else {
                        $data = [
                            'st_id' => trim($st_available_id),
                            'customer_id' => trim($_POST['cus_id']),
                            'itemcat_type_id' => trim($itemcat_type_id),
                            'item_type_id' => trim($_POST['item_type1']),
                            'brand_id' => trim($brand_id),
                            'selling_type_id' => trim($selling_type_id),
                            'no_purchased' => trim($_POST['amount_purchased4']),
                            'unit_amount' => trim($_POST['buying_price4']),
                            'total_amount' => trim($_POST['total_amount4']),
                            'num_available' => $num_added,
                            'sale_type' => '1',
                            'pagetype' => '1',
                            'submitting_date' => trim($stdate)
                        ];
                        $log_data = $this->userModel->sellquery($data);
                        if ($log_data) {
                            $data = [
                                'customer_id' => trim($_POST['cus_id']),
                                'brand_id' => trim($brand_id),
                                'no_purchased' => trim($_POST['amount_purchased4']),
                                'buyorder_date' => trim($stdate)
                            ];
                            $updatecustomer = $this->userModel->updatecustomer($data);
                            if ($updatecustomer) {
                                $stockavailable = $this->userModel->stockavailabledaily();

                                $totalstr = 0;
                                $totalno = 0;
                                foreach ($stockavailable as $stockava) {
                                    $totalno += $stockava->number_added;
                                    // $totalstr += $stockava->totalsp;
                                    $totalstr += $stockava->total_sp;
                                    // $totalstr += $stockava->totalsp;
                                }
                                $data1 = [
                                    'totalno' => $totalno,
                                    'totalstr' => $totalstr
                                ];
                                $this->userModel->insertstockdaily($data1);
                                $activity = 'Sale of item with id ' . $st_available_id . ' data: ' .
                                    ' st_id: ' . trim($st_available_id) .
                                    ' customer_id: ' . trim($_POST['cus_id']) .
                                    ' itemcat_type_id: ' . trim($itemcat_type_id) .
                                    ' item_type_id: ' . trim($_POST['item_type1']) .
                                    ' brand_id: ' . trim($brand_id) .
                                    ' selling_type_id: ' . trim($selling_type_id) .
                                    ' no_purchased: ' . trim($_POST['amount_purchased4']) .
                                    ' unit_amount: ' . trim($_POST['buying_price4']) .
                                    ' total_amount: ' . trim($_POST['total_amount4']) .
                                    ' num_available: ' . $num_added .
                                    ' sale_type: ' . '1' .
                                    ' pagetype: ' . '1' .
                                    ' submitting_date: ' . trim($stdate);
                                $data2 = [
                                    'st_id2' => trim($st_available_id),
                                    'activity' => $activity,
                                    'username' => trim($_SESSION['username']),
                                    'table' => trim('stock_available')
                                ];
                                $logdata = $this->userModel->log_activity($data2);
                                $data1 = [
                                    'status' => 'success',
                                    'message' => 'SALES DELIVERY ADDED SUCCESSFULLY!!!'
                                ];
                            } else {
                                $data1 = [
                                    'status' => 'error',
                                    'message' => 'UNABLE TO UPDATE CUSTOMERS DATA TRY AGAIN LATER!!!'
                                ];
                            }
                        } else {
                            $data1 = [
                                'status' => 'error',
                                'message' => 'ERROR POSTING SALE TRY AGAIN!!!'
                            ];
                        }
                    }
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'ITEM NOT IN STOCK!!!'
                    ];
                }


                echo json_encode($data1);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function checkout()
    {
        if (isset($_SESSION['user_id'])) {
            // echo $_SESSION['order_no'];die();
            unset($_SESSION['order_no']);
            // if($out){
            $data1 = [
                'status' => 'success',
                'message' => 'CHECKOUT SUCCESSFULLY!!!'
            ];
            // }else{
            // $data1 = [
            // 'status' => 'error',
            // 'message' => 'REFRESH THE PAGE AND TRY AGAIN!!!'
            // ];
            // }           
            echo json_encode($data1);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function sellproductupdate()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                $_POST['total_amount2'] = $_POST['amount_purchased2'] * $_POST['buying_price2'];
                // var_dump($_POST['total_amount2']);die();
                $data = [
                    'st_id' => trim($_POST['st_id']),
                    'no_purchased' => trim($_POST['amount_purchased2']),
                    'unit_amount' => trim($_POST['buying_price2']),
                    'total_amount' => trim($_POST['total_amount2'])
                ];
                $updatesale = $this->userModel->updatesale($data);
                // var_dump($selectstock);die();
                if ($updatesale) {
                    $stockavailable = $this->userModel->stockavailabledaily();

                    $totalstr = 0;
                    $totalno = 0;
                    foreach ($stockavailable as $stockava) {
                        $totalno += $stockava->number_added;
                        // $totalstr += $stockava->totalsp;
                        $totalstr += $stockava->total_sp;
                        // $totalstr += $stockava->totalsp;
                    }
                    $data1 = [
                        'totalno' => $totalno,
                        'totalstr' => $totalstr
                    ];
                    $this->userModel->insertstockdaily($data1);
                    $activity = 'Update sale and stock_available of item with id ' . $st_available_id . ' data: ' .
                        ' st_id: ' . trim($_POST['st_id']) .
                        ' no_purchased: ' . trim($_POST['amount_purchased2']) .
                        ' unit_amount: ' . trim($_POST['buying_price2']) .
                        ' total_amount: ' . trim($_POST['total_amount2']);
                    $data2 = [
                        'st_id2' => trim($st_available_id),
                        'activity' => $activity,
                        'username' => trim($_SESSION['username']),
                        'table' => trim('stock_available')
                    ];
                    $logdata = $this->userModel->log_activity($data2);
                    $data1 = [
                        'status' => 'success',
                        'message' => 'SALES UPDATED SUCCESSFULLY!!!'
                    ];
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'FAILED TO UPDATE REFRESH AND TRY AGAIN!!!'
                    ];
                }
                echo json_encode($data1);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function updatesale()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                $sales = $this->userModel->sel_sale($_POST['st_id2']);
                if ($sales) {
                    $activity = 'Deleted item from table ' . $_POST['table'] . '(' . $sales . ')' . ' with id ' . $_POST['st_id2'];
                    $data = [
                        'st_id2' => trim($_POST['st_id2']),
                        'activity' => $activity,
                        'username' => trim($_SESSION['username']),
                        'table' => trim($_POST['table'])
                    ];
                } else {
                    $activity = 'Deleted item from table ' . $_POST['table'] . ' with id ' . $_POST['st_id2'];
                    $data = [
                        'st_id2' => trim($_POST['st_id2']),
                        'activity' => $activity,
                        'username' => trim($_SESSION['username']),
                        'table' => trim($_POST['table'])
                    ];
                }

                $updatesale = $this->userModel->delete($data);
                $logdata = $this->userModel->log_activity($data);
                // var_dump($updatesale);die();
                if ($updatesale) {
                    $stockavailable = $this->userModel->stockavailabledaily();

                    $totalstr = 0;
                    $totalno = 0;
                    foreach ($stockavailable as $stockava) {
                        $totalno += $stockava->number_added;
                        // $totalstr += $stockava->totalsp;
                        $totalstr += $stockava->total_sp;
                        // $totalstr += $stockava->totalsp;
                    }
                    $data1 = [
                        'totalno' => $totalno,
                        'totalstr' => $totalstr
                    ];
                    $this->userModel->insertstockdaily($data1);
                    $data1 = [
                        'status' => 'success',
                        'message' => 'DELETED SUCCESSFULLY!!!'
                    ];
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'FAILED TO DELETE REFRESH AND TRY AGAIN!!!'
                    ];
                }
                echo json_encode($data1);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function returnsale()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);
                // die();
                $activity = 'Returned item from table ' . $_POST['table'] . ' with id ' . $_POST['st_id2'] . ' activity: ' . $activity .
                    ' username: ' . trim($_SESSION['username']) .
                    ' stock_ava_id: ' . trim($_POST['stock_ava_id']);
                $data = [
                    'st_id2' => trim($_POST['st_id2']),
                    'activity' => $activity,
                    'username' => trim($_SESSION['username']),
                    'table' => trim($_POST['table']),
                    'stock_ava_id' => trim($_POST['stock_ava_id'])
                ];

                $stockavailable_return = $this->userModel->salesel($data);
                // $stockavailable_return = $this->userModel->stockavailable_return($data);
                // var_dump($stockavailable_return);
                foreach ($stockavailable_return as $stockavailable_return) {
                    $totalno_purchase = $stockavailable_return->no_purchased;
                }
                $stockavailable_get = $this->userModel->stockavailable_return($data);
                // var_dump($stockavailable_get);
                // die();

                foreach ($stockavailable_get as $stockavailable_get) {
                    $totalnumber_added = $stockavailable_get->number_added;
                    $selling_price = $stockavailable_get->selling_price;
                    $total_sp = $stockavailable_get->total_sp;
                }
                $total_no = $totalnumber_added + $totalno_purchase;
                $total_sp = $total_no * $selling_price;

                $data = [
                    'st_id2' => trim($_POST['st_id2']),
                    'activity' => $activity,
                    'username' => trim($_SESSION['username']),
                    'table' => trim($_POST['table']),
                    'total_no' => trim($total_no),
                    'total_sp' => trim($total_sp),
                    'stock_ava_id' => trim($_POST['stock_ava_id'])
                ];
                $update_return = $this->userModel->update_return($data);
                if ($update_return) {
                    $updatesale = $this->userModel->delete($data);
                    $logdata = $this->userModel->log_activity($data);
                    // var_dump($updatesale);die();
                    if ($updatesale) {
                        $stockavailable = $this->userModel->stockavailabledaily();

                        $totalstr = 0;
                        $totalno = 0;
                        foreach ($stockavailable as $stockava) {
                            $totalno += $stockava->number_added;
                            // $totalstr += $stockava->totalsp;
                            $totalstr += $stockava->total_sp;
                            // $totalstr += $stockava->totalsp;
                        }
                        $data1 = [
                            'totalno' => $totalno,
                            'totalstr' => $totalstr
                        ];
                        $this->userModel->insertstockdaily($data1);
                        $data1 = [
                            'status' => 'success',
                            'message' => 'RETURNED SUCCESSFULLY!!!'
                        ];
                    } else {
                        $data1 = [
                            'status' => 'error',
                            'message' => 'FAILED TO RETURNED REFRESH AND TRY AGAIN!!!'
                        ];
                    }
                }

                echo json_encode($data1);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function brandedit()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                $data = [
                    'st_id' => trim($_POST['st_id']),
                    'brandname' => trim($_POST['brandname'])
                ];
                $brandedit = $this->userModel->brandedit($data);
                // var_dump($brandedit);die();
                if ($brandedit) {
                    $activity = 'Edited name of item with id ' . $_POST['st_id'] . ' data: ' .
                        ' st_id: ' . trim($_POST['st_id']) .
                        ' brandname: ' . trim($_POST['brandname']);
                    $data2 = [
                        'st_id2' => trim($_POST['st_id']),
                        'activity' => $activity,
                        'username' => trim($_SESSION['username']),
                        'table' => trim('brands')
                    ];
                    $logdata = $this->userModel->log_activity($data2);
                    $data1 = [
                        'status' => 'success',
                        'message' => 'PRODUCT UPDATED SUCCESSFULLY!!!'
                    ];
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'FAILED REFRESH AND TRY AGAIN!!!'
                    ];
                }
                echo json_encode($data1);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function supplieredit()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                $data = [
                    'sid' => trim($_POST['sup_id']),
                    'suppliers_name' => trim($_POST['supplier_name1']),
                    'phone_no' => trim($_POST['phone_no1']),
                    'email' => trim($_POST['email1']),
                    'business_name' => trim($_POST['business_name1']),
                    'address' => trim($_POST['business_address1'])
                ];
                $supplieredit = $this->userModel->supplieredit($data);
                // var_dump($supplieredit);die();
                if ($supplieredit) {
                    $activity = 'Edited suppliers details id ' . $_POST['sup_id'] . ' data: ' .
                        ' sid: ' . trim($_POST['sup_id']) .
                        ' suppliers_name: ' . trim($_POST['supplier_name1']) .
                        ' phone_no: ' . trim($_POST['phone_no1']) .
                        ' email: ' . trim($_POST['email1']) .
                        ' business_name: ' . trim($_POST['business_name1']) .
                        ' address: ' . trim($_POST['business_address1']);
                    $data2 = [
                        'st_id2' => trim($_POST['sup_id']),
                        'activity' => $activity,
                        'username' => trim($_SESSION['username']),
                        'table' => trim('suppliers_tb')
                    ];
                    $logdata = $this->userModel->log_activity($data2);
                    $data1 = [
                        'status' => 'success',
                        'message' => 'PRODUCT UPDATED SUCCESSFULLY!!!'
                    ];
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'FAILED REFRESH AND TRY AGAIN!!!'
                    ];
                }
                echo json_encode($data1);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function useredit()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                $data = [
                    'user_id' => trim($_POST['user_id']),
                    'fname' => trim($_POST['fname1']),
                    'lname' => trim($_POST['lname1']),
                    'other_name' => trim($_POST['othername1']),
                    'dob' => trim($_POST['birth_date1']),
                    'phone_no' => trim($_POST['user_phone_no1']),
                    'group_id' => trim($_POST['role1']),
                    'email' => trim($_POST['user_email1']),
                    'address' => trim($_POST['user_address1']),
                    'city_name' => trim($_POST['user_city1']),
                    'suburb' => trim($_POST['user_suburb1']),
                    'gender' => trim($_POST['gender1'])
                ];
                $activity = 'Edited User from table ' . 'users_tb' . ' with id ' . $_POST['user_id'] . ' user_id: ' . trim($_POST['user_id']) .
                    ' fname: ' . trim($_POST['fname1']) .
                    ' lname: ' . trim($_POST['lname1']) .
                    ' other_name: ' . trim($_POST['othername1']) .
                    ' dob: ' . trim($_POST['birth_date1']) .
                    ' phone_no: ' . trim($_POST['user_phone_no1']) .
                    ' group_id: ' . trim($_POST['role1']) .
                    ' email: ' . trim($_POST['user_email1']) .
                    ' address: ' . trim($_POST['user_address1']) .
                    ' city_name: ' . trim($_POST['user_city1']) .
                    ' suburb: ' . trim($_POST['user_suburb1']) .
                    ' gender: ' . trim($_POST['gender1']);
                $data1 = [
                    'user_id' => trim($_POST['user_id']),
                    'activity' => $activity,
                    'username' => trim($_SESSION['username']),
                    'table' => trim('users_tb')
                ];
                $logdata = $this->userModel->log_activity($data1);

                $useredit = $this->userModel->useredit($data);
                // var_dump($useredit);die();
                if ($useredit) {
                    $data1 = [
                        'status' => 'success',
                        'message' => 'USER UPDATED SUCCESSFULLY!!!'
                    ];
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'FAILED REFRESH AND TRY AGAIN!!!'
                    ];
                }
                echo json_encode($data1);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function customeredit()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                $data = [
                    'cusid' => trim($_POST['cus_id']),
                    'customer_name' => trim($_POST['customer_name1']),
                    'gender' => trim($_POST['cus_gender1']),
                    'phone_no' => trim($_POST['phone_number1']),
                    'address' => trim($_POST['home_address1']),
                    'digital_address' => trim($_POST['digital_address1']),
                    'email' => trim($_POST['cus_email1']),
                    'family_size' => trim($_POST['family_size1']),
                    'amount_bought' => trim($_POST['no_bought1']),
                    'city' => trim($_POST['city_name1']),
                    'suburb' => trim($_POST['suburb1']),
                    'street_name' => trim($_POST['street_name1']),
                    'days_to_consume' => trim($_POST['days_to_consume1']),
                    'buyorder_date' => trim($_POST['buy_order_date1']),
                    'other_details' => trim($_POST['other_details1'])
                ];
                $useredit = $this->userModel->cusedit($data);
                // var_dump($useredit);die();
                if ($useredit) {
                    $activity = 'Edited Customers details id ' . $_POST['sup_id'] . ' data: ' .
                        ' cusid: ' . trim($_POST['cus_id']) .
                        ' customer_name: ' . trim($_POST['customer_name1']) .
                        ' gender: ' . trim($_POST['cus_gender1']) .
                        ' phone_no: ' . trim($_POST['phone_number1']) .
                        ' address: ' . trim($_POST['home_address1']) .
                        ' digital_address: ' . trim($_POST['digital_address1']) .
                        ' email: ' . trim($_POST['cus_email1']) .
                        ' family_size: ' . trim($_POST['family_size1']) .
                        ' amount_bought: ' . trim($_POST['no_bought1']) .
                        ' city: ' . trim($_POST['city_name1']) .
                        ' suburb: ' . trim($_POST['suburb1']) .
                        ' street_name: ' . trim($_POST['street_name1']) .
                        ' days_to_consume: ' . trim($_POST['days_to_consume1']) .
                        ' buyorder_date: ' . trim($_POST['buy_order_date1']) .
                        ' other_details: ' . trim($_POST['other_details1']);
                    $data2 = [
                        'st_id2' => trim($_POST['cus_id']),
                        'activity' => $activity,
                        'username' => trim($_SESSION['username']),
                        'table' => trim('customer_tb')
                    ];
                    $logdata = $this->userModel->log_activity($data2);
                    $data1 = [
                        'status' => 'success',
                        'message' => 'CUSTOMER UPDATED SUCCESSFULLY!!!'
                    ];
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'FAILED REFRESH AND TRY AGAIN!!!'
                    ];
                }
                echo json_encode($data1);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }
}
