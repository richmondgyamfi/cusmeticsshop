<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->userFunctions = $this->model('Functions');
    }

    public function index()
    {
        $tdate = $this->userModel->todaydate();
        foreach ($tdate as $nowdate) {
            $tdate = $nowdate->nowdate;
        }
        $value = explode('-', $tdate);
        $val = $value[0] . $value[1] . $value[2];
        $stockavailable = $this->userModel->stockavailable();
        // $orderno = $this->userFunctions->orderno();
        if (!empty($_SESSION['order_no'])) {
            $orders = $this->userModel->orders($_SESSION['order_no']);
            $orderno = $_SESSION['order_no'];
        } else {
            $orderno = $this->userFunctions->orderno();
            $_SESSION['order_no'] = $orderno;
            $orders = $this->userModel->orders($_SESSION['order_no']);
        }
        // echo $_SESSION['order_no'];die();
        $newu = $this->userModel->cusdata($val);
        $gdata = $this->userModel->getbrands();
        $data = [
            'tdate' => trim($tdate),
            'tdate1' => trim($tdate)
        ];
        $stdata = $this->userModel->getreport($data);
        $totalsale = $this->userModel->totalsale();
        $brands = $this->userModel->totalbrand();
        $supplier = $this->userModel->totalsupplier();
        $cusdata = $this->userModel->totalcustomer();
        $users = $this->userModel->totalusers();
        $selling_type = $this->userModel->selling_type();
        $category_type = $this->userModel->category_type();
        $item_type = $this->userModel->item_type();
        // var_dump($selling_type);die();
        if (isset($_SESSION['user_id'])) {
            $data = [
                'title' => 'Home page',
                'page' => 'admin',
                'stockavailable' => $stockavailable,
                'orders' => $orders,
                'data' => $gdata,
                'stdata' => $stdata,
                'totalsale' => $totalsale,
                'newu' => $newu,
                'brands' => $brands,
                'supplier' => $supplier,
                'cusdata' => $cusdata,
                'selling_type' => $selling_type,
                'category_type' => $category_type,
                'item_type' => $item_type,
                'users' => $users
            ];
            // var_dump($_SESSION);die();

            $stockavailable = $this->userModel->stockavailable();


            $totalstr = 0;
            $totalno = 0;
            foreach ($stockavailable as $stockava) {
                $totalno += $stockava->number_added;
                $totalstr += $stockava->totalsp;
            }
            $data1 = [
                'totalno' => $totalno,
                'totalstr' => $totalstr
            ];
            $this->userModel->insertstockdaily($data1);

            if ($_SESSION['group_id'] == 1) {
                $activity = 'Sold item user_id ' . $_POST['user_id'] . ' data: ' .
                    ' stockavailable: ' . $stockavailable .
                    ' orders: ' . $orders .
                    ' data: ' . $gdata .
                    ' stdata: ' . $stdata .
                    ' totalsale: ' . $totalsale .
                    ' newu: ' . $newu .
                    ' brands: ' . $brands .
                    ' supplier: ' . $supplier .
                    ' cusdata: ' . $cusdata .
                    ' selling_type: ' . $selling_type .
                    ' category_type: ' . $category_type .
                    ' item_type: ' . $item_type .
                    ' cusdata: ' . $cusdata .
                    ' users: ' . $users;
                $data2 = [
                    'activity' => $activity,
                    'username' => trim($_SESSION['username']),
                    'table' => trim('stock_available')
                ];
                $logdata = $this->userModel->log_activity($data2);
                $this->view('/pages/admin', $data);
            } else {
                $this->view('/pages/checkst', $data);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function barcode()
    {
        $tdate = $this->userModel->todaydate();
        foreach ($tdate as $nowdate) {
            $tdate = $nowdate->nowdate;
        }
        $value = explode('-', $tdate);
        $val = $value[0] . $value[1] . $value[2];
        $stockavailable = $this->userModel->stockavailable();
        // $orderno = $this->userFunctions->orderno();
        if (!empty($_SESSION['order_no'])) {
            $orders = $this->userModel->orders($_SESSION['order_no']);
            $orderno = $_SESSION['order_no'];
        } else {
            $orderno = $this->userFunctions->orderno();
            $_SESSION['order_no'] = $orderno;
            $orders = $this->userModel->orders($_SESSION['order_no']);
        }
        // echo $_SESSION['order_no'];die();
        $newu = $this->userModel->cusdata($val);
        $gdata = $this->userModel->getbrands();
        $data = [
            'tdate' => trim($tdate),
            'tdate1' => trim($tdate)
        ];
        $stdata = $this->userModel->getreport($data);
        $totalsale = $this->userModel->totalsale();
        $brands = $this->userModel->totalbrand();
        $supplier = $this->userModel->totalsupplier();
        $cusdata = $this->userModel->totalcustomer();
        $users = $this->userModel->totalusers();
        $selling_type = $this->userModel->selling_type();
        $category_type = $this->userModel->category_type();
        $item_type = $this->userModel->item_type();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // var_dump($_POST);
            // die();
            $data1 = [
                'title' => 'Barcode page',
                'page' => 'barpage',
                'barcode' => $_POST['barcode']
            ];
            $checkbarcode = $this->userModel->checkbarcode($data1);
            foreach ($checkbarcode as $kaya) {
            };
            $data = [
                'brand_name' => $kaya->brand_name,
                'barcode_data' => $checkbarcode
            ];
            echo json_encode($data);
        } elseif (isset($_SESSION['user_id'])) {
            $data = [
                'title' => 'Barcode page',
                'page' => 'barpage',
                'stockavailable' => $stockavailable,
                'orders' => $orders,
                'data' => $gdata,
                'stdata' => $stdata,
                'totalsale' => $totalsale,
                'newu' => $newu,
                'brands' => $brands,
                'supplier' => $supplier,
                'cusdata' => $cusdata,
                'selling_type' => $selling_type,
                'category_type' => $category_type,
                'item_type' => $item_type,
                'users' => $users
            ];
            // var_dump($_SESSION);die();

            $stockavailable = $this->userModel->stockavailable();


            $totalstr = 0;
            $totalno = 0;
            foreach ($stockavailable as $stockava) {
                $totalno += $stockava->number_added;
                $totalstr += $stockava->totalsp;
            }
            $data1 = [
                'totalno' => $totalno,
                'totalstr' => $totalstr
            ];
            $this->userModel->insertstockdaily($data1);
            $activity = 'Sold item user_id with barcode ' . $_POST['user_id'] . ' data: ' .
                ' stockavailable: ' . $stockavailable .
                ' orders: ' . $orders .
                ' data: ' . $gdata .
                ' stdata: ' . $stdata .
                ' totalsale: ' . $totalsale .
                ' newu: ' . $newu .
                ' brands: ' . $brands .
                ' supplier: ' . $supplier .
                ' cusdata: ' . $cusdata .
                ' selling_type: ' . $selling_type .
                ' category_type: ' . $category_type .
                ' item_type: ' . $item_type .
                ' users: ' . $users;
            $data2 = [
                'activity' => $activity,
                'username' => trim($_SESSION['username']),
                'table' => trim('stock_available')
            ];
            $logdata = $this->userModel->log_activity($data2);

            $this->view('/pages/barcode', $data);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function genstock()
    {
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
    }

    public function print_item()
    {
        if (isset($_SESSION['user_id'])) {
            $stockavailable = $this->userModel->stockavailable();
            // var_dump($stockavailable);die();
            $brands = $this->userModel->totalbrand();
            $supplier = $this->userModel->totalsupplier();
            $selling_type = $this->userModel->selling_type();
            $category_type = $this->userModel->category_type();
            $item_type = $this->userModel->item_type();
            $orderno = $this->userFunctions->orderno();
            $_SESSION['order_no'] = $orderno;
            $orders = $this->userModel->orders($orderno);
            // var_dump($orders);die();
            $data = [
                'stockavailable' => $stockavailable,
                'orders' => $orders,
                'brands' => $brands,
                'supplier' => $supplier,
                'selling_type' => $selling_type,
                'category_type' => $category_type,
                'item_type' => $item_type,
                'title' => 'Home page',
                'page' => 'print_item'
            ];
            $this->view('/pages/checkoutprint', $data);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function checkst()
    {
        if (isset($_SESSION['user_id'])) {
            $tdate = $this->userModel->todaydate();
            foreach ($tdate as $nowdate) {
                $tdate = $nowdate->nowdate;
            }
            $value = explode('-', $tdate);
            $val = $value[0] . $value[1] . $value[2];
            $stockavailable = $this->userModel->stockavailable();
            // $orderno = $this->userFunctions->orderno();
            if (!empty($_SESSION['order_no'])) {
                $orders = $this->userModel->orders($_SESSION['order_no']);
                $orderno = $_SESSION['order_no'];
            } else {
                $orderno = $this->userFunctions->orderno();
                $_SESSION['order_no'] = $orderno;
                $orders = $this->userModel->orders($_SESSION['order_no']);
            }
            // echo $_SESSION['order_no'];die();
            $newu = $this->userModel->cusdata($val);
            $gdata = $this->userModel->getbrands();
            $data = [
                'tdate' => trim($tdate),
                'tdate1' => trim($tdate)
            ];
            $stdata = $this->userModel->getreport($data);
            $totalsale = $this->userModel->totalsale();
            $brands = $this->userModel->totalbrand();
            $supplier = $this->userModel->totalsupplier();
            $cusdata = $this->userModel->totalcustomer();
            $users = $this->userModel->totalusers();
            $selling_type = $this->userModel->selling_type();
            $category_type = $this->userModel->category_type();
            $item_type = $this->userModel->item_type();
            $cusdata = $this->userModel->totalcustomer();
            // var_dump($selling_type);die();
            // if (isset($_SESSION['user_id'])) {
            $data = [
                'title' => 'Home page',
                'page' => 'stocks',
                'stockavailable' => $stockavailable,
                'orders' => $orders,
                'data' => $gdata,
                'stdata' => $stdata,
                'totalsale' => $totalsale,
                'newu' => $newu,
                'brands' => $brands,
                'supplier' => $supplier,
                'selling_type' => $selling_type,
                'category_type' => $category_type,
                'item_type' => $item_type,
                'cusdata' => $cusdata,
                'users' => $users
            ];
            $this->view('/pages/checkst', $data);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function printpage_new()
    {
        if (isset($_SESSION['user_id'])) {
            $tdate = $this->userModel->todaydate();
            foreach ($tdate as $nowdate) {
                $tdate = $nowdate->nowdate;
            }
            $value = explode('-', $tdate);
            $val = $value[0] . $value[1] . $value[2];
            $stockavailable = $this->userModel->stockavailable();
            // $orderno = $this->userFunctions->orderno();
            if (!empty($_SESSION['order_no'])) {
                $orders = $this->userModel->orders($_SESSION['order_no']);
                $orderno = $_SESSION['order_no'];
            } else {
                $orderno = $this->userFunctions->orderno();
                $_SESSION['order_no'] = $orderno;
                $orders = $this->userModel->orders($_SESSION['order_no']);
            }
            // echo $_SESSION['order_no'];die();
            $newu = $this->userModel->cusdata($val);
            $gdata = $this->userModel->getbrands();
            $data = [
                'tdate' => trim($tdate),
                'tdate1' => trim($tdate)
            ];
            $stdata = $this->userModel->getreport($data);
            $totalsale = $this->userModel->totalsale();
            $brands = $this->userModel->totalbrand();
            $supplier = $this->userModel->totalsupplier();
            $cusdata = $this->userModel->totalcustomer();
            $users = $this->userModel->totalusers();
            $selling_type = $this->userModel->selling_type();
            $category_type = $this->userModel->category_type();
            $item_type = $this->userModel->item_type();
            $cusdata = $this->userModel->totalcustomer();
            // var_dump($selling_type);die();
            // if (isset($_SESSION['user_id'])) {
            $data = [
                'title' => 'Home page',
                'page' => 'stocks',
                'stockavailable' => $stockavailable,
                'orders' => $orders,
                'data' => $gdata,
                'stdata' => $stdata,
                'totalsale' => $totalsale,
                'newu' => $newu,
                'brands' => $brands,
                'supplier' => $supplier,
                'selling_type' => $selling_type,
                'category_type' => $category_type,
                'item_type' => $item_type,
                'cusdata' => $cusdata,
                'users' => $users
            ];
            $this->view('/pages/printpage_new', $data);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function stock_statement()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                $tdate = $this->userModel->todaydate();
                foreach ($tdate as $nowdate) {
                    $tdate = $nowdate->nowdate;
                }
                $dateval = explode('-', $tdate);
                $dateget = $dateval[0] . $dateval[1] . $dateval[2];
                $data = [
                    'from' => trim($_POST['from']),
                    // 'to' =>trim($_POST['to']),
                    'product' => trim($_POST['product']),
                    'item_type' => trim($_POST['item_type']),
                    'brand_type' => trim($_POST['brand_type']),
                    'tdate' => $tdate,
                    'dateval' => $dateget
                ];
                $stockavailable1 = $this->userModel->stockavailablesearchdaily($data);
                $stockavailable2 = $this->userModel->stockavailablesearchdailyclosing($data);
                $stockavailable = $this->userModel->stockavailablesearch($data);
                $checkstocktoday = $this->userModel->checkstocksearch($data);
                $todaysales = $this->userModel->salessearch($data);
                $brands = $this->userModel->totalbrand();
                $supplier = $this->userModel->totalsupplier();
                $selling_type = $this->userModel->selling_type();
                $category_type = $this->userModel->category_type();
                $item_type = $this->userModel->item_type();
                // var_dump($stockavailable);die();
                $stockavailableattoday = $this->userModel->stockavailabledaily();
                $data = [
                    'stockavailable1' => $stockavailable1,
                    'stockavailable2' => $stockavailable2,
                    'stockavailable' => $stockavailable,
                    'stockavailableattoday' => $stockavailableattoday,
                    // 'orders' => $orders,
                    'brands' => $brands,
                    'supplier' => $supplier,
                    'selling_type' => $selling_type,
                    'category_type' => $category_type,
                    'checkstocktoday' => $checkstocktoday,
                    'todaysales' => $todaysales,
                    'item_type' => $item_type,
                    'title' => 'Home page',
                    'page' => 'stocks_stat'
                ];
            } else {
                $stockavailable = $this->userModel->stockavailable();
                $brands = $this->userModel->totalbrand();
                $supplier = $this->userModel->totalsupplier();
                $selling_type = $this->userModel->selling_type();
                $category_type = $this->userModel->category_type();
                $item_type = $this->userModel->item_type();

                $tdate = $this->userModel->todaydate();
                foreach ($tdate as $nowdate) {
                    $tdate = $nowdate->nowdate;
                }
                $dateval = explode('-', $tdate);
                $dateget = $dateval[0] . $dateval[1] . $dateval[2];
                $data = [
                    'tdate' => $tdate,
                    'dateval' => $dateget
                ];

                //   $totalstr = 0;
                //   $totalno = 0;
                //   foreach ($stockavailable as $stockava) {
                //     $totalno += $stockava->number_added;
                //     $totalstr += $stockava->totalsp;
                //   }
                //   $data1 = [
                //     'totalno' => $totalno,
                //     'totalstr' => $totalstr
                //   ];
                // $this->userModel->insertstockdaily($data1);
                // var_dump($data);
                $data2 = [
                    'from' => $tdate
                ];
                $stockavailable1 = $this->userModel->stockavailablesearchdaily($data2);
                $stockavailable2 = $this->userModel->stockavailablesearchdailyclosing($data2);
                $checkstocktoday = $this->userModel->checkstocktodayall($data);
                // var_dump($checkstocktoday);die();
                $todaysales = $this->userModel->todaysales($tdate);

                $data = [
                    'stockavailable' => $stockavailable,
                    'stockavailable1' => $stockavailable1,
                    'stockavailable2' => $stockavailable2,
                    // 'orders' => $orders,
                    'checkstocktoday' => $checkstocktoday,
                    'todaysales' => $todaysales,
                    'brands' => $brands,
                    'supplier' => $supplier,
                    'selling_type' => $selling_type,
                    'category_type' => $category_type,
                    'item_type' => $item_type,
                    'title' => 'Home page',
                    'page' => 'stocks_stat'
                ];
            }
            $this->view('/pages/stock_statement', $data);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function checksale()
    {
        // var_dump($_SESSION);
        // die();
        if (isset($_SESSION['user_id'])) {
            $tdate = $this->userModel->todaydate();
            foreach ($tdate as $nowdate) {
                $tdate = $nowdate->nowdate;
            }
            if ($_SESSION['group_id'] == 2) {
                $todaysaleslist_indvidual = $this->userModel->todaysaleslist_indvidual($tdate);
                $todaysales = $this->userModel->todaysaleslist_seller($tdate, $_SESSION['username']);
            } else {
                $todaysaleslist_indvidual = $this->userModel->todaysaleslist_indvidual($tdate);
                $todaysales = $this->userModel->todaysaleslist($tdate);
            }
            $brands = $this->userModel->totalbrand();
            $supplier = $this->userModel->totalsupplier();
            $selling_type = $this->userModel->selling_type();
            $category_type = $this->userModel->category_type();
            $item_type = $this->userModel->item_type();
            // var_dump($todaysaleslist_indvidual);
            // die();
            $data = [
                'todaysaleslist_indvidual' => $todaysaleslist_indvidual,
                'todaysales' => $todaysales,
                'brands' => $brands,
                'supplier' => $supplier,
                'selling_type' => $selling_type,
                'category_type' => $category_type,
                'item_type' => $item_type,
                'title' => 'Home page',
                'page' => 'sales'
            ];
            $this->view('/pages/checksale', $data);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function delivery()
    {
        $tdate = $this->userModel->todaydate();
        foreach ($tdate as $nowdate) {
            $tdate = $nowdate->nowdate;
        }
        $value = explode('-', $tdate);
        $val = $value[0] . $value[1] . $value[2];
        $newu = $this->userModel->cusdata($val);
        $data = $this->userModel->getbrands();
        $data = [
            'tdate' => trim($tdate),
            'tdate1' => trim($tdate)
        ];
        $stdata = $this->userModel->getreport($data);
        $totalsale = $this->userModel->totalsale();
        $brands = $this->userModel->totalbrand();
        $supplier = $this->userModel->totalsupplier();
        $cusdata = $this->userModel->totalcustomer();
        $users = $this->userModel->totalusers();
        $selling_type = $this->userModel->selling_type();
        $category_type = $this->userModel->category_type();
        $item_type = $this->userModel->item_type();
        // var_dump($newu);die();
        if (isset($_SESSION['user_id'])) {
            $data = [
                'title' => 'Home page',
                'page' => 'delivery',
                'data' => $data,
                'stdata' => $stdata,
                'totalsale' => $totalsale,
                'newu' => $newu,
                'brands' => $brands,
                'supplier' => $supplier,
                'cusdata' => $cusdata,
                'selling_type' => $selling_type,
                'category_type' => $category_type,
                'item_type' => $item_type,
                'users' => $users
            ];
            // var_dump($_SESSION);die();
            $this->view('/pages/delivery', $data);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function checkbrand()
    {
        $brands = $this->userModel->totalbrand();
        $supplier = $this->userModel->totalsupplier();
        $selling_type = $this->userModel->selling_type();
        $category_type = $this->userModel->category_type();
        $item_type = $this->userModel->item_type();
        // var_dump($newu);die();
        if (isset($_SESSION['user_id'])) {
            $data = [
                'title' => 'Home page',
                'page' => 'brands',
                'brands' => $brands,
                'supplier' => $supplier,
                'selling_type' => $selling_type,
                'category_type' => $category_type,
                'item_type' => $item_type
            ];
            // var_dump($_SESSION);die();
            $this->view('/pages/checkbrand', $data);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
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

    public function checksuppliers()
    {
        $brands = $this->userModel->totalbrand();
        $supplier = $this->userModel->totalsupplier();
        $selling_type = $this->userModel->selling_type();
        $category_type = $this->userModel->category_type();
        $item_type = $this->userModel->item_type();
        // var_dump($newu);die();
        if (isset($_SESSION['user_id'])) {
            $data = [
                'title' => 'Home page',
                'page' => 'suppliers',
                'brands' => $brands,
                'supplier' => $supplier,
                'selling_type' => $selling_type,
                'category_type' => $category_type,
                'item_type' => $item_type
            ];
            // var_dump($_SESSION);die();
            $this->view('/pages/checksuppliers', $data);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function checkusers()
    {
        $brands = $this->userModel->totalbrand();
        $supplier = $this->userModel->totalsupplier();
        $selling_type = $this->userModel->selling_type();
        $users = $this->userModel->totalusers();
        $category_type = $this->userModel->category_type();
        $item_type = $this->userModel->item_type();
        // var_dump($users);die();
        if (isset($_SESSION['user_id'])) {
            $data = [
                'title' => 'Home page',
                'page' => 'users',
                'users' => $users,
                'brands' => $brands,
                'supplier' => $supplier,
                'selling_type' => $selling_type,
                'category_type' => $category_type,
                'item_type' => $item_type
            ];
            // var_dump($_SESSION);die();
            $this->view('/pages/checkusers', $data);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function checkcustomers()
    {
        $brands = $this->userModel->totalbrand();
        $supplier = $this->userModel->totalsupplier();
        $selling_type = $this->userModel->selling_type();
        $cusdata = $this->userModel->totalcustomer();
        // $users = $this->userModel->totalusers();
        $category_type = $this->userModel->category_type();
        $item_type = $this->userModel->item_type();
        // var_dump($users);die();
        if (isset($_SESSION['user_id'])) {
            $data = [
                'title' => 'Home page',
                'page' => 'customers',
                'cusdata' => $cusdata,
                'brands' => $brands,
                'supplier' => $supplier,
                'selling_type' => $selling_type,
                'category_type' => $category_type,
                'item_type' => $item_type
            ];
            // var_dump($_SESSION);die();
            $this->view('/pages/checkcustomers', $data);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function report_page()
    {
        $brands = $this->userModel->totalbrand();
        $supplier = $this->userModel->totalsupplier();
        $selling_type = $this->userModel->selling_type();
        $category_type = $this->userModel->category_type();
        $item_type = $this->userModel->item_type();
        // var_dump($users);die();
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'tdate' => trim($_POST['from']),
                    'tdate1' => trim($_POST['to'])
                ];
                $stdata = $this->userModel->getreport($data);
                $saleslist_indvidual_report = $this->userModel->saleslist_indvidual_report($data);
                // var_dump($saleslist_indvidual_report);
                // die();
                $data = [
                    'tdate' => trim($_POST['from']),
                    'tdate1' => trim($_POST['to']),
                    'title' => 'Home page',
                    'page' => 'report',
                    'saleslist_indvidual_report' => $saleslist_indvidual_report,
                    'brands' => $brands,
                    'supplier' => $supplier,
                    'stdata' => $stdata,
                    'selling_type' => $selling_type,
                    'category_type' => $category_type,
                    'item_type' => $item_type
                ];
                // var_dump($_SESSION);die();
                $this->view('/pages/report_page', $data);
            } else {
                $data = [
                    'title' => 'Home page',
                    'page' => 'report',
                    'brands' => $brands,
                    'supplier' => $supplier,
                    'selling_type' => $selling_type,
                    'category_type' => $category_type,
                    'item_type' => $item_type
                ];
                // var_dump($_SESSION);die();
                $this->view('/pages/report_page', $data);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function check_attendance()
    {
        $brands = $this->userModel->totalbrand();
        $supplier = $this->userModel->totalsupplier();
        $selling_type = $this->userModel->selling_type();
        $category_type = $this->userModel->category_type();
        $item_type = $this->userModel->item_type();
        // var_dump($users);die();
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'tdate' => trim($_POST['from']),
                    'tdate1' => trim($_POST['to'])
                ];
                $stdata = $this->userModel->logSearch($data);
                // var_dump($_POST);die();
                $data = [
                    'tdate' => trim($_POST['from']),
                    'tdate1' => trim($_POST['to']),
                    'title' => 'Home page',
                    'page' => 'check_attendance',
                    'brands' => $brands,
                    'supplier' => $supplier,
                    'stdata' => $stdata,
                    'selling_type' => $selling_type,
                    'category_type' => $category_type,
                    'item_type' => $item_type
                ];
                // var_dump($_SESSION);die();
                $this->view('/pages/check_attendance', $data);
            } else {
                $data = [
                    'title' => 'Home page',
                    'page' => 'check_attendance',
                    'brands' => $brands,
                    'supplier' => $supplier,
                    'selling_type' => $selling_type,
                    'category_type' => $category_type,
                    'item_type' => $item_type
                ];
                // var_dump($_SESSION);die();
                $this->view('/pages/check_attendance', $data);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function allstocks()
    {
        $brands = $this->userModel->totalbrand();
        $supplier = $this->userModel->totalsupplier();
        $selling_type = $this->userModel->selling_type();
        $category_type = $this->userModel->category_type();
        $item_type = $this->userModel->item_type();
        // var_dump($users);die();
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $tdate = $this->userModel->todaydate();
                foreach ($tdate as $nowdate) {
                    $tdate = $nowdate->nowdate;
                }
                $dateval = explode('-', $tdate);
                $dateget = $dateval[0] . $dateval[1] . $dateval[2];

                $data = [
                    'dateval' => trim($dateget),
                    'tdate' => trim($_POST['from']),
                    'tdate1' => trim($_POST['to'])
                ];
                $stdata = $this->userModel->stockSearch($data);
                // var_dump($_POST);die();
                $data = [
                    'tdate' => trim($_POST['from']),
                    'tdate1' => trim($_POST['to']),
                    'title' => 'Home page',
                    'page' => 'allstocks',
                    'brands' => $brands,
                    'supplier' => $supplier,
                    'stdata' => $stdata,
                    'selling_type' => $selling_type,
                    'category_type' => $category_type,
                    'item_type' => $item_type
                ];
                // var_dump($_SESSION);die();
                $this->view('/pages/allstock', $data);
            } else {
                $data = [
                    'title' => 'Home page',
                    'page' => 'allstocks',
                    'brands' => $brands,
                    'supplier' => $supplier,
                    'selling_type' => $selling_type,
                    'category_type' => $category_type,
                    'item_type' => $item_type
                ];
                // var_dump($_SESSION);die();
                $this->view('/pages/allstock', $data);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function allcash()
    {
        $brands = $this->userModel->totalbrand();
        $supplier = $this->userModel->totalsupplier();
        $selling_type = $this->userModel->selling_type();
        $category_type = $this->userModel->category_type();
        $item_type = $this->userModel->item_type();
        // var_dump($users);die();
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $stdata = $this->userModel->stockSearch($data);
                $tsell = $this->userModel->totalsell();
                $tcost = $this->userModel->totalcost();
                // var_dump($_POST);die();
                $data = [
                    'tsell' => $tsell,
                    'tcost' => $tcost,
                    'title' => 'Home page',
                    'page' => 'cashst',
                    'brands' => $brands,
                    'supplier' => $supplier,
                    'selling_type' => $selling_type,
                    'category_type' => $category_type,
                    'item_type' => $item_type
                ];
                // var_dump($_SESSION);die();
                $this->view('/pages/cashst', $data);
            } else {
                $tsell = $this->userModel->totalsell();
                $tcost = $this->userModel->totalcost();
                // var_dump($tsell);die();
                $data = [
                    'tsell' => $tsell,
                    'tcost' => $tcost,
                    'title' => 'Home page',
                    'page' => 'cashst',
                    'brands' => $brands,
                    'supplier' => $supplier,
                    'selling_type' => $selling_type,
                    'category_type' => $category_type,
                    'item_type' => $item_type
                ];
                // var_dump($_SESSION);die();
                $this->view('/pages/cashst', $data);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function stocks()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_FILES['add_img']);die();
                $stdate = date("Y-m-d");
                $add_img = $this->userFunctions->single_fileupload($_FILES['add_img']);

                if ($_POST['product_category_type'] == 2) {
                    $_POST['product_type'] = '0';
                }
                $data = [
                    'itemcat_type_id' => trim($_POST['product_category_type']),
                    'item_type_id' => trim($_POST['product_type']),
                    'brand_name' => trim($_POST['brand_name']),
                    'selling_type_id' => trim($_POST['buying_kind']),
                    'number_added' => trim($_POST['no_added']),
                    'unitcost_price' => trim($_POST['unit_price']),
                    'totalcost_price' => trim($_POST['total_price']),
                    'selling_price' => trim($_POST['selling_price']),
                    'wholesale_selling_price' => trim($_POST['wholesale_selling_price']),
                    'invoice_no' => trim($_POST['invoice_no']),
                    'supplier_id' => trim($_POST['supplier']),
                    'expiry_date' => trim($_POST['expiry_date']),
                    'barcode' => trim($_POST['barcode']),
                    'submitting_date' => $stdate,
                    'item_pic' => $add_img,
                    'brand_id' => trim($_POST['brand_type_name']),
                    'username' => $_SESSION['username']
                ];



                // if (($data['itemcat_type_id'] == 1) && !empty($data['item_type_id'])) {
                $checkbarcode = $this->userModel->checkbarcode($data);

                if ($checkbarcode) {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'BARCODE ALREADY EXIST!!!'
                    ];
                } elseif (!empty($data['brand_id'])) {
                    //find and insert with pro_type
                    $stdata = $this->userModel->checkdata($data);
                    $feetb_update = $this->userModel->insertstock($data);
                    // var_dump($data);die();

                    // $selectavailablestock = $this->userModel->selectavailablestock($data);

                    // var_dump($selectavailablestock);die();
                    if ($stdata) {
                        foreach ($stdata as $key) {
                            $stid = $key->id;
                            $cat1 = $key->itemcat_type_id;
                            $itempro_type = $key->item_type_id;
                            $sell_type = $key->selling_type_id;
                            $brandst = $key->brand_id;
                            $added = $key->number_added;
                        }
                        $total = $data['number_added'] + $added;
                        $data2 = [
                            'stid' => $stid,
                            'totaladded' => $total
                        ];
                        // die();
                        $feetb_update = $this->userModel->updateavailstock($data, $data2);
                        // var_dump($feetb_update);die();
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
                            'message' => 'STOCK ADDED SUCCESSFULLY!!!'
                        ];
                    } else {
                        $feetb_update = $this->userModel->insertavailstock($data);
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
                        $activity = 'Added item with data: ' .
                            ' itemcat_type_id: ' . trim($_POST['product_category_type']) .
                            ' item_type_id: ' . trim($_POST['product_type']) .
                            ' brand_name: ' . trim($_POST['brand_name']) .
                            ' selling_type_id: ' . trim($_POST['buying_kind']) .
                            ' number_added: ' . trim($_POST['no_added']) .
                            ' unitcost_price: ' . trim($_POST['unit_price']) .
                            ' totalcost_price: ' . trim($_POST['total_price']) .
                            ' selling_price: ' . trim($_POST['selling_price']) .
                            ' wholesale_selling_price: ' . trim($_POST['wholesale_selling_price']) .
                            ' invoice_no: ' . trim($_POST['invoice_no']) .
                            ' supplier_id: ' . trim($_POST['supplier']) .
                            ' expiry_date: ' . trim($_POST['expiry_date']) .
                            ' barcode: ' . trim($_POST['barcode']) .
                            ' submitting_date: ' . $stdate .
                            ' item_pic: ' . $add_img .
                            ' brand_id: ' . trim($_POST['brand_type_name']) .
                            ' username: ' . $_SESSION['username'];
                        $data2 = [
                            'activity' => $activity,
                            'username' => trim($_SESSION['username']),
                            'table' => trim('stock_tb')
                        ];
                        $logdata = $this->userModel->log_activity($data2);

                        $data1 = [
                            'status' => 'success',
                            'message' => 'STOCK ADDED SUCCESSFULLY!!!'
                        ];
                    }
                } elseif (empty($data['brand_id']) && !empty($data['brand_name'])) {
                    //insert, find, insert
                    $sup_brand = $this->userModel->brandinsert($data);

                    if (!empty($sup_brand)) {

                        foreach ($sup_brand as $key) {
                            $newbrandid = $key->id;
                        }
                        $data = [
                            'itemcat_type_id' => trim($_POST['product_category_type']),
                            'item_type_id' => trim($_POST['product_type']),
                            'brand_name' => trim($_POST['brand_name']),
                            'selling_type_id' => trim($_POST['buying_kind']),
                            'number_added' => trim($_POST['no_added']),
                            'unitcost_price' => trim($_POST['unit_price']),
                            'totalcost_price' => trim($_POST['total_price']),
                            'selling_price' => trim($_POST['selling_price']),
                            'wholesale_selling_price' => trim($_POST['wholesale_selling_price']),
                            'invoice_no' => trim($_POST['invoice_no']),
                            'expiry_date' => trim($_POST['expiry_date']),
                            'barcode' => trim($_POST['barcode']),
                            'supplier_id' => trim($_POST['supplier']),
                            'submitting_date' => $stdate,
                            'item_pic' => $add_img,
                            'brand_id' => trim($newbrandid),
                            'username' => $_SESSION['username']
                        ];
                        $feetb_update = $this->userModel->insertstock($data);

                        $feetb_update = $this->userModel->insertavailstock($data);

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

                        $activity = 'Added item with data: ' .
                            ' itemcat_type_id: ' . trim($_POST['product_category_type']) .
                            ' item_type_id: ' . trim($_POST['product_type']) .
                            ' brand_name: ' . trim($_POST['brand_name']) .
                            ' pcs_in_ctn: ' . trim($_POST['pcs_in_ctn']) .
                            ' number_added: ' . trim($_POST['no_added']) .
                            ' unitcost_price: ' . trim($_POST['unit_price']) .
                            ' totalcost_price: ' . trim($_POST['total_price']) .
                            ' selling_price: ' . trim($_POST['selling_price']) .
                            ' wholesale_selling_price: ' . trim($_POST['wholesale_selling_price']) .
                            ' invoice_no: ' . trim($_POST['invoice_no']) .
                            ' supplier_id: ' . trim($_POST['supplier']) .
                            ' expiry_date: ' . trim($_POST['expiry_date']) .
                            ' barcode: ' . trim($_POST['barcode']) .
                            ' submitting_date: ' . $stdate .
                            ' item_pic: ' . $add_img .
                            ' brand_id: ' . trim($_POST['brand_type_name']) .
                            ' username: ' . $_SESSION['username'];
                        $data2 = [
                            'activity' => $activity,
                            'username' => trim($_SESSION['username']),
                            'table' => trim('stock_tb')
                        ];
                        $logdata = $this->userModel->log_activity($data2);
                        $data1 = [
                            'status' => 'success',
                            'message' => 'STOCK ADDED SUCCESSFULLY!!!'
                        ];
                    } else {
                        $data1 = [
                            'status' => 'error',
                            'message' => 'PRODUCT ALREADY EXIST!!!'
                        ];
                    }
                } else {
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
                        'message' => 'STOCK ADDED SUCCESSFULLY!!!'
                    ];
                }
                // }else{
                //     $errorpop = $user->err_mode("PLEASE SELECT PRODUCT TYPE!!!");
                //     echo $errorpop;
                // }
                echo json_encode($data1);
            } else {
                $data = [
                    'title' => 'Home page',
                    'page' => 'allstocks',
                    'brands' => $brands,
                    'supplier' => $supplier,
                    'selling_type' => $selling_type,
                    'category_type' => $category_type,
                    'item_type' => $item_type
                ];
                // var_dump($_SESSION);die();
                $this->view('/pages/allstock', $data);
            }

            // echo json_encode($data1);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function stockupdate()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_FILES['add_img']);die();
                $stdate = date("Y-m-d");
                $add_img = $this->userFunctions->single_fileupload($_FILES['add_img']);

                if ($_POST['product_category_type'] == 2) {
                    $_POST['product_type'] = '0';
                }
                $data = [
                    'itemcat_type_id' => trim($_POST['product_category_type']),
                    'st_id' => trim($_POST['st_id']),
                    'item_type_id' => trim($_POST['product_type']),
                    'brand_name' => trim($_POST['brand_name']),
                    'selling_type_id' => trim($_POST['buying_kind']),
                    'number_added' => trim($_POST['no_added']),
                    'unitcost_price' => trim($_POST['unit_price']),
                    'totalcost_price' => trim($_POST['total_price']),
                    'selling_price' => trim($_POST['selling_price']),
                    'wholesale_selling_price' => trim($_POST['wholesale_selling_price']),
                    'invoice_no' => trim($_POST['invoice_no']),
                    'expiry_date' => trim($_POST['expiry_date']),
                    'supplier_id' => trim($_POST['supplier']),
                    'barcode' => trim($_POST['barcode']),
                    'submitting_date' => $stdate,
                    'item_pic' => $add_img,
                    'brand_id' => trim($_POST['brand_type_name']),
                    'username' => $_SESSION['username']
                ];

                $stdata = $this->userModel->singlecheckdata($data);

                if ($stdata) {

                    $feetb_update = $this->userModel->insertstock2($data);
                    foreach ($stdata as $key) {
                        $stid = $key->id;
                        $cat1 = $key->itemcat_type_id;
                        $itempro_type = $key->item_type_id;
                        $sell_type = $key->selling_type_id;
                        $brandst = $key->brand_id;
                        $added = $key->number_added;
                    }
                    $total = $data['number_added'] + $added;
                    $data2 = [
                        'stid' => trim($_POST['st_id']),
                        'totaladded' => $total
                    ];
                    $feetb_update = $this->userModel->updateavailstock($data, $data2);
                    if ($feetb_update) {
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
                        $activity = 'Updates item with data: ' .
                            ' itemcat_type_id: ' . trim($_POST['product_category_type']) .
                            ' st_id: ' . trim($_POST['st_id']) .
                            ' item_type_id: ' . trim($_POST['product_type']) .
                            ' brand_name: ' . trim($_POST['brand_name']) .
                            ' selling_type_id: ' . trim($_POST['buying_kind']) .
                            ' number_added: ' . trim($_POST['no_added']) .
                            ' unitcost_price: ' . trim($_POST['unit_price']) .
                            ' totalcost_price: ' . trim($_POST['total_price']) .
                            ' selling_price: ' . trim($_POST['selling_price']) .
                            ' wholesale_selling_price: ' . trim($_POST['wholesale_selling_price']) .
                            ' invoice_no: ' . trim($_POST['invoice_no']) .
                            ' expiry_date: ' . trim($_POST['expiry_date']) .
                            ' supplier_id: ' . trim($_POST['supplier']) .
                            ' barcode: ' . trim($_POST['barcode']) .
                            ' submitting_date: ' . $stdate .
                            ' item_pic: ' . $add_img .
                            ' brand_id: ' . trim($_POST['brand_type_name']) .
                            ' username: ' . $_SESSION['username'];
                        $data2 = [
                            'activity' => $activity,
                            'username' => trim($_SESSION['username']),
                            'table' => trim('stock_tb')
                        ];
                        $logdata = $this->userModel->log_activity($data2);
                        $data1 = [
                            'status' => 'success',
                            'message' => 'STOCK ADDED SUCCESSFULLY!!!'
                        ];
                    } else {
                        $data1 = [
                            'status' => 'error',
                            'message' => 'PRODUCT ALREADY EXIST!!!'
                        ];
                    }
                }



                echo json_encode($data1);
            } else {
                $data = [
                    'title' => 'Home page',
                    'page' => 'allstocks',
                    'brands' => $brands,
                    'supplier' => $supplier,
                    'selling_type' => $selling_type,
                    'category_type' => $category_type,
                    'item_type' => $item_type
                ];
                // var_dump($_SESSION);die();
                $this->view('/pages/allstock', $data);
            }

            // echo json_encode($data1);
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }

    public function suppliers()
    {
        // var_dump($users);die();
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                $stdate = date("Y-m-d");
                $data = [
                    'suppliers_name' => trim($_POST['supplier_name']),
                    'business_name' => trim($_POST['business_name']),
                    'phone_no' => trim($_POST['phone_no']),
                    'email' => trim($_POST['email']),
                    'address' => trim($_POST['business_address']),
                    'submitting_date' => $stdate
                ];
                $stdata = $this->userModel->supplierquery($data);
                // var_dump($stdata);die();
                if ($stdata == TRUE) {
                    $activity = 'Added Supplier with data: ' .
                        ' suppliers_name: ' . trim($_POST['supplier_name']) .
                        ' business_name: ' . trim($_POST['business_name']) .
                        ' phone_no: ' . trim($_POST['phone_no']) .
                        ' email: ' . trim($_POST['email']) .
                        ' address: ' . trim($_POST['business_address']) .
                        ' submitting_date: ' . $stdate;
                    $data2 = [
                        'activity' => $activity,
                        'username' => trim($_SESSION['username']),
                        'table' => trim('suppliers_tb')
                    ];
                    $logdata = $this->userModel->log_activity($data2);
                    $data1 = [
                        'status' => 'success',
                        'message' => 'SUPPLIER ADDED SUCCESSFULLY!!!'
                    ];
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'SUPPLIER ALREADY EXIST!!!'
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

    public function addpro()
    {
        // var_dump($users);die();
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                $stdate = date("Y-m-d");
                $data = [
                    'type' => trim($_POST['type']),
                    'pname' => trim($_POST['pname'])
                ];
                if ($data['type'] == 1) {
                    $stdata = $this->userModel->addpro($data);
                } else {
                    $stdata = $this->userModel->addpro1($data);
                }
                // var_dump($stdata);die();
                if ($stdata == TRUE) {
                    $activity = 'Added product with data: ' .
                        'type' . trim($_POST['type']) .
                        'pname' . trim($_POST['pname']);
                    $data2 = [
                        'activity' => $activity,
                        'username' => trim($_SESSION['username']),
                        'table' => trim('suppliers_tb')
                    ];
                    $logdata = $this->userModel->log_activity($data2);
                    $data1 = [
                        'status' => 'success',
                        'message' => 'NAME ADDED SUCCESSFULLY!!!'
                    ];
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'NAME ALREADY EXIST!!!'
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

    public function addcustomer()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                $stdate = date("Y-m-d");
                $data = [
                    'customer_name' => trim($_POST['customer_name']),
                    'gender' => trim($_POST['cus_gender']),
                    'phone_no' => trim($_POST['phone_number']),
                    'address' => trim($_POST['home_address']),
                    'digital_address' => trim($_POST['digital_address']),
                    'email' => trim($_POST['cus_email']),
                    'family_size' => trim($_POST['family_size']),
                    'brand_type' => trim($_POST['brand_type']),
                    'amount_bought' => trim($_POST['no_bought']),
                    'city' => trim($_POST['city_name']),
                    'suburb' => trim($_POST['suburb']),
                    'street_name' => trim($_POST['street_name']),
                    'days_to_consume' => trim($_POST['days_to_consume']),
                    'buyorder_date' => trim($_POST['buy_order_date']),
                    'next_order_date' => trim($_POST['next_order_date']),
                    'other_details' => trim($_POST['other_details']),
                    'submitting_date' => $stdate
                ];
                $stdata = $this->userModel->customerquery($data);
                // var_dump($stdata);die();
                if ($stdata == TRUE) {
                    $activity = 'Added customer with data: ' .
                        ' customer_name: ' . trim($_POST['customer_name']) .
                        ' gender: ' . trim($_POST['cus_gender']) .
                        ' phone_no: ' . trim($_POST['phone_number']) .
                        ' address: ' . trim($_POST['home_address']) .
                        ' digital_address: ' . trim($_POST['digital_address']) .
                        ' email: ' . trim($_POST['cus_email']) .
                        ' family_size: ' . trim($_POST['family_size']) .
                        ' brand_type: ' . trim($_POST['brand_type']) .
                        ' amount_bought: ' . trim($_POST['no_bought']) .
                        ' city: ' . trim($_POST['city_name']) .
                        ' suburb: ' . trim($_POST['suburb']) .
                        ' street_name: ' . trim($_POST['street_name']) .
                        ' days_to_consume: ' . trim($_POST['days_to_consume']) .
                        ' buyorder_date: ' . trim($_POST['buy_order_date']) .
                        ' next_order_date: ' . trim($_POST['next_order_date']) .
                        ' other_details: ' . trim($_POST['other_details']) .
                        ' submitting_date: ' . $stdate;
                    $data2 = [
                        'activity' => $activity,
                        'username' => trim($_SESSION['username']),
                        'table' => trim('suppliers_tb')
                    ];
                    $logdata = $this->userModel->log_activity($data2);
                    $data1 = [
                        'status' => 'success',
                        'message' => 'CUSTOMER ADDED SUCCESSFULLY!!!'
                    ];
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'CUSTOMER ALREADY EXIST!!!'
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

    public function expenses()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                $stdate = date("Y-m-d");
                $data = [
                    'exp_name' => trim($_POST['exp_name']),
                    'amount' => trim($_POST['amount']),
                    'userid' => trim($_SESSION['user_id'])
                ];
                $addexpenses = $this->userModel->addexpenses($data);
                // var_dump($addexpenses);die();
                if ($addexpenses == TRUE) {
                    $activity = 'Added expenses with data: ' .
                        ' exp_name: ' . trim($_POST['exp_name']) .
                        ' amount: ' . trim($_POST['amount']) .
                        ' userid: ' . trim($_SESSION['user_id']);
                    $data2 = [
                        'activity' => $activity,
                        'username' => trim($_SESSION['username']),
                        'table' => trim('expenses')
                    ];
                    $logdata = $this->userModel->log_activity($data2);
                    $data1 = [
                        'status' => 'success',
                        'message' => 'EXPENSES ADDED SUCCESSFULLY!!!'
                    ];
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'ERROR ADDING EXPENSES!!!'
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

    public function checkexpenses()
    {
        $bring_expenses = $this->userModel->bring_expenses();
        // var_dump($bring_expenses);
        // die();
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                $data = [
                    'title' => 'Home page',
                    'page' => 'expenses',
                    'bring_expenses' => $bring_expenses
                ];
                // var_dump($_SESSION);die();
                $this->view('/pages/expensespage', $data);
            } else {
                $data = [
                    'title' => 'Home page',
                    'page' => 'expenses',
                    'bring_expenses' => $bring_expenses
                ];
                // var_dump($_SESSION);die();
                $this->view('/pages/expensespage', $data);
            }
        } else {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['group_id']);
            unset($_SESSION['name']);
            header('location:' . URLROOT . '/users/login.php');
        }
    }


    public function adduser()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();
                $stdate = date("Y-m-d");
                $dob = trim($_POST['birth_date']);
                $pass = explode('-', $dob);
                $name = trim($_POST['fname']) . ' ' . trim($_POST['lname']) . ' ' . trim($_POST['othername']);
                //username is firstname and last name combined
                $username = trim($_POST['fname']) . trim($_POST['lname']);
                $password = password_hash('123456', PASSWORD_DEFAULT);

                $data = [
                    'fname' => trim($_POST['fname']),
                    'lname' => trim($_POST['lname']),
                    'other_name' => trim($_POST['othername']),
                    'dob' => trim($_POST['birth_date']),
                    'phone_no' => trim($_POST['user_phone_no']),
                    'group_id' => trim($_POST['role']),
                    'email' => trim($_POST['user_email']),
                    'address' => trim($_POST['user_address']),
                    'city_name' => trim($_POST['user_city']),
                    'suburb' => trim($_POST['user_suburb']),
                    'gender' => trim($_POST['gender']),
                    'username' => $username,
                    'password' => $password,
                    'name' => $name,
                    'submitting_date' => $stdate
                ];
                $stdata = $this->userModel->userquery($data);
                // var_dump($stdata);die();
                if ($stdata == TRUE) {
                    $activity = 'Added a user data: ' .
                        ' fname: ' . trim($_POST['fname']) .
                        ' lname: ' . trim($_POST['lname']) .
                        ' other_name: ' . trim($_POST['othername']) .
                        ' dob: ' . trim($_POST['birth_date']) .
                        ' phone_no: ' . trim($_POST['user_phone_no']) .
                        ' group_id: ' . trim($_POST['role']) .
                        ' email: ' . trim($_POST['user_email']) .
                        ' address: ' . trim($_POST['user_address']) .
                        ' city_name: ' . trim($_POST['user_city']) .
                        ' suburb: ' . trim($_POST['user_suburb']) .
                        ' gender: ' . trim($_POST['gender']) .
                        ' username: ' . $username .
                        ' password: ' . $password .
                        ' name: ' . $name .
                        ' submitting_date: ' . $stdate;
                    $data2 = [
                        'activity' => $activity,
                        'username' => trim($_SESSION['username']),
                        'table' => trim('users_tb')
                    ];
                    $logdata = $this->userModel->log_activity($data2);
                    $data1 = [
                        'status' => 'success',
                        'message' => 'USER ADDED SUCCESSFULLY!!!'
                    ];
                } else {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'ERROR ADDING USER!!!'
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

    public function passwordreset()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // var_dump($_POST);die();

                $data = [
                    'p_pass' => trim($_POST['prev_password']),
                    'password' => trim($_POST['new_password']),
                    're_pass' => trim($_POST['retype_password']),
                    'userid' => trim($_POST['user'])
                ];
                $log_data = $this->userModel->checkuser($data);
                foreach ($log_data as $key) {
                    $pass = $key->password;
                }
                if (!password_verify($data['p_pass'], $pass)) {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'Current Password Incorrect!!!'
                    ];
                } elseif ($data['password'] != $data['re_pass']) {
                    $data1 = [
                        'status' => 'error',
                        'message' => 'New Password And Re-Enter Password Does Not Match!!!'
                    ];
                } else {
                    $password = password_hash($data['password'], PASSWORD_DEFAULT);
                    $data = [
                        'password' => $password,
                        'userid' => trim($_POST['user'])
                    ];
                    $stdata = $this->userModel->changepasswordquery($data);
                    if ($stdata) {
                        $data1 = [
                            'status' => 'success',
                            'message' => 'PASSWORD CHANGED SUCCESSFULLY!!!'
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

    public function about()
    {
        $this->view('/pages/about');
    }
}
