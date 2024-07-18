<?php
class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');

        //Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function loginlog($data)
    {
        $this->db->query('INSERT INTO login_log (username) VALUES(:username)');

        //Bind values
        $this->db->bind(':username', $data['username']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password)
    {
        $this->db->query('select *, t1.id as lid from login as t1
        left join grouptb as t3 on t1.group_id = t3.id
        where t1.username = :username');

        //Bind value
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email)
    {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        //Check if email is already registered
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getbrands()
    {
        try {
            $itemlist = $this->db->query('select * FROM brands AS t1 
            JOIN stock_available AS t2 ON t1.id = t2.brand_id ORDER BY t1.id');

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function totalsale()
    {
        try {
            $itemlist = $this->db->query('select * FROM sales_tb where status = 0 ORDER BY id');

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function totalbrand()
    {
        try {
            $itemlist = $this->db->query('select * FROM brands where status = 0 ORDER BY brand_name');

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function totalsupplier()
    {
        try {
            $itemlist = $this->db->query('select * FROM suppliers_tb where status = 0 ORDER BY suppliers_name');

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function selling_type()
    {
        try {
            $itemlist = $this->db->query('select * FROM selling_type ORDER BY sell_name');

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function category_type()
    {
        try {
            $itemlist = $this->db->query('select * FROM category_type ORDER BY cat_type_name');

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function item_type()
    {
        try {
            $itemlist = $this->db->query('select * FROM item_type');

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function checkuser($data)
    {
        try {
            $itemlist = $this->db->query('select * FROM login where id = :userid');

            $this->db->bind(':userid', $data['userid']);

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function totalcustomer()
    {
        try {
            $itemlist = $this->db->query('select * FROM customer_tb where status = 0 ORDER BY id');

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function totalusers()
    {
        try {
            $itemlist = $this->db->query('select * FROM login as t1 left join users_tb as t2 on t1.uid =  t2.id where t1.id != 1 and t2.status = 0 ORDER BY t1.id');

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function cusdata($dateval1)
    {
        try {
            $itemlist = $this->db->query("SELECT *, ({$dateval1} - DATE_FORMAT(buyorder_date, '%Y%m%d')) AS val1, (days_to_consume - ({$dateval1} - DATE_FORMAT(buyorder_date, '%Y%m%d'))) AS val2 FROM customer_tb WHERE (days_to_consume - ({$dateval1} - DATE_FORMAT(buyorder_date, '%Y%m%d'))) < 10 AND status = 0");

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function stockavailable()
    {
        try {
            $itemlist = $this->db->query("select *, t1.id as main_id, (t1.number_added * t1.selling_price) as totalsp, (t1.number_added * t1.unitcost_price) as total_unit_cost,DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date FROM stock_available AS t1 LEFT JOIN category_type AS t2 ON t1.itemcat_type_id = t2.id LEFT JOIN brands AS t3 ON t1.brand_id = t3.id LEFT JOIN item_type AS t4 ON t1.item_type_id = t4.id LEFT JOIN selling_type AS t5 ON t1.selling_type_id = t5.id");

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function stockavailabledaily()
    {
        try {
            $itemlist = $this->db->query("select *, t1.id as main_id, (t1.number_added * t1.selling_price) as totalsp,DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date FROM stock_available AS t1");

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function stockavailable_return($data)
    {
        try {
            $itemlist = $this->db->query("select *, t1.id as main_id, (t1.number_added * t1.selling_price) as totalsp,DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date 
            FROM stock_available AS t1 where t1.id = :stock_ava_id");
            $this->db->bind(':stock_ava_id', $data['stock_ava_id']);

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function stockavailablesearch($data)
    {
        try {
            $from = $data['from'];
            // $to = $data['to'];
            $procat = $data['product'] == 'All' ? '%' : $data['product'];
            $item_type = $data['item_type'] == 'All' ? '%' : $data['item_type'];
            $brand_type = $data['brand_type'] == 'All' ? '%' : $data['brand_type'];

            $itemlist = $this->db->query("select *, t1.id as main_id, (t1.number_added * t1.selling_price) as totalsp,DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date FROM stock_available AS t1 
            LEFT JOIN category_type AS t2 ON t1.itemcat_type_id = t2.id LEFT JOIN brands AS t3 ON t1.brand_id = t3.id 
            LEFT JOIN item_type AS t4 ON t1.item_type_id = t4.id LEFT JOIN selling_type AS t5 ON t1.selling_type_id = t5.id
            WHERE t1.itemcat_type_id like '{$procat}' and t1.item_type_id like '{$item_type}' and t1.brand_id like '{$brand_type}' and left(t1.activity_date, 10) between '{$from}'");

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function stockavailablesearchdaily($data)
    {
        try {
            $from = $data['from'];

            $itemlist = $this->db->query("select *,DATE_FORMAT(left(activity_date, 10), '%D %M, %Y') as activity_date FROM stocks_daily  
            WHERE left(activity_date, 10) = '{$from}' limit 1");

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function stockavailablesearchdailyclosing($data)
    {
        try {
            $from = $data['from'];

            $itemlist = $this->db->query("select *,DATE_FORMAT(left(activity_date, 10), '%D %M, %Y') as activity_date FROM stocks_daily  
            WHERE left(activity_date, 10) = '{$from}' order by id desc limit 1");

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function orders($orderno)
    {
        try {
            $itemlist = $this->db->query("select *,t1.id,t1.st_id from sales_tb as t1
            left join brands as t2 on t1.brand_id = t2.id
            left join category_type as t3 on t1.itemcat_type_id = t3.id
            left join item_type as t4 on t1.item_type_id = t4.id
            left join selling_type as t5 on t1.selling_type_id = t5.id
            where order_no = '{$orderno}'");

            $items = $this->db->resultSet();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function todaysales($date)
    {
        try {
            $itemlist = $this->db->query("select *, t1.id AS main_id, DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date FROM sales_tb AS t1 
            LEFT JOIN category_type AS t2 ON t1.itemcat_type_id = t2.id
            LEFT JOIN brands AS t3 ON t1.brand_id = t3.id 
            LEFT JOIN item_type AS t4 ON t1.item_type_id = t4.id 
            LEFT JOIN selling_type AS t5 ON t1.selling_type_id = t5.id 
            WHERE left(t1.activity_date, 10) = '{$date}' AND t1.status = 0");

            $items = $this->db->resultSet();
            return $items;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function todaysaleslist_seller($date, $username)
    {
        try {
            $itemlist = $this->db->query("select *, t1.id AS main_id, DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date FROM sales_tb AS t1 
            LEFT JOIN category_type AS t2 ON t1.itemcat_type_id = t2.id
            LEFT JOIN brands AS t3 ON t1.brand_id = t3.id 
            LEFT JOIN item_type AS t4 ON t1.item_type_id = t4.id 
            LEFT JOIN selling_type AS t5 ON t1.selling_type_id = t5.id 
            WHERE left(t1.activity_date, 10) = '{$date}' AND t1.status = 0 and t1.soldby = '{$username}'");

            $items = $this->db->resultSet();
            return $items;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function todaysaleslist($date)
    {
        try {
            $itemlist = $this->db->query("select cat_type_name,brand_name,type_name,price_type,sold_in,no_purchased,unit_amount,total_amount, t1.id AS main_id, DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date, t1.soldby FROM sales_tb AS t1 
            LEFT JOIN category_type AS t2 ON t1.itemcat_type_id = t2.id
            LEFT JOIN brands AS t3 ON t1.brand_id = t3.id 
            LEFT JOIN item_type AS t4 ON t1.item_type_id = t4.id 
            LEFT JOIN selling_type AS t5 ON t1.selling_type_id = t5.id 
            WHERE left(t1.activity_date, 10) = '{$date}' AND t1.status = 0
						GROUP BY t1.soldby, cat_type_name,brand_name,type_name,price_type,sold_in,no_purchased,unit_amount,total_amount,t1.id");

            $items = $this->db->resultSet();
            return $items;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function todaysaleslist_indvidual($date)
    {
        try {
            $itemlist = $this->db->query("select t6.name,ROUND(sum(unit_amount),2) as total_unitamtsold,ROUND(sum(total_amount),2) as totalsold, DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date, t1.soldby FROM sales_tb AS t1 
            LEFT JOIN category_type AS t2 ON t1.itemcat_type_id = t2.id
            LEFT JOIN brands AS t3 ON t1.brand_id = t3.id 
            LEFT JOIN item_type AS t4 ON t1.item_type_id = t4.id 
            LEFT JOIN selling_type AS t5 ON t1.selling_type_id = t5.id
			left join login as t6 on t1.soldby = t6.username 
            WHERE left(t1.activity_date, 10) = '{$date}' AND t1.status = 0
						GROUP BY t1.soldby, t6.name, activity_date");

            $items = $this->db->resultSet();
            return $items;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function saleslist_indvidual_report($data)
    {
        try {
            $itemlist = $this->db->query("select t6.name,ROUND(sum(unit_amount),2) as total_unitamtsold,ROUND(sum(total_amount),2) as totalsold, DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date, t1.soldby FROM sales_tb AS t1 
            LEFT JOIN category_type AS t2 ON t1.itemcat_type_id = t2.id
            LEFT JOIN brands AS t3 ON t1.brand_id = t3.id 
            LEFT JOIN item_type AS t4 ON t1.item_type_id = t4.id 
            LEFT JOIN selling_type AS t5 ON t1.selling_type_id = t5.id
			left join login as t6 on t1.soldby = t6.username
            WHERE left(t1.activity_date, 10) BETWEEN :tdate AND :tdate1 AND t1.status = 0
						GROUP BY t1.soldby, t6.name, activity_date");

            $this->db->bind(':tdate', $data['tdate']);
            $this->db->bind(':tdate1', $data['tdate1']);

            $items = $this->db->resultSet();
            return $items;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function salessearch($data)
    {
        try {
            $from = $data['from'];
            // $to = $data['to'];
            $procat = $data['product'] == 'All' ? '%' : $data['product'];
            $item_type = $data['item_type'] == 'All' ? '%' : $data['item_type'];
            $brand_type = $data['brand_type'] == 'All' ? '%' : $data['brand_type'];

            $itemlist = $this->db->query("select *, t1.id AS main_id, DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date FROM sales_tb AS t1 
            LEFT JOIN category_type AS t2 ON t1.itemcat_type_id = t2.id
            LEFT JOIN brands AS t3 ON t1.brand_id = t3.id 
            LEFT JOIN item_type AS t4 ON t1.item_type_id = t4.id 
            LEFT JOIN selling_type AS t5 ON t1.selling_type_id = t5.id 
            WHERE t1.status = 0 and t1.itemcat_type_id like '{$procat}' and t1.item_type_id like '{$item_type}' and t1.brand_id like '{$brand_type}' and left(t1.activity_date, 10) = '{$from}'");

            $items = $this->db->resultSet();
            return $items;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function todaydate()
    {
        try {
            $itemlist = $this->db->query("select left(NOW(), 10) as nowdate");

            $items = $this->db->resultSet();
            return $items;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getreport($data)
    {
        try {
            $itemlist = $this->db->query('Select *, (t1.unit_amount - t6.unitcost_price) as pm,
            (t1.total_amount - (t1.no_purchased * t6.unitcost_price)) as totalpm,
            DATE_FORMAT(left(t1.activity_date, 10), "%D %M, %Y") as subdate, t1.id as main_id FROM sales_tb AS t1 
            LEFT JOIN category_type AS t2 ON t1.itemcat_type_id = t2.id 
            LEFT JOIN brands AS t3 ON t1.brand_id = t3.id 
            LEFT JOIN item_type AS t4 ON t1.item_type_id = t4.id
            LEFT JOIN selling_type AS t5 ON t1.selling_type_id = t5.id
            left join stock_available as t6 on t1.st_id = t6.id 
            WHERE left(t1.activity_date, 10) BETWEEN :tdate AND :tdate1 AND t1.status = 0');

            $this->db->bind(':tdate', $data['tdate']);
            $this->db->bind(':tdate1', $data['tdate1']);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return $items;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function logSearch($data)
    {
        try {
            $itemlist = $this->db->query('select * from login_log as t1 
            left join login as t2 on t1.username = t2.username
            left join users_tb as t3 on t2.uid = t3.id
            where left(t1.logintime, 10) BETWEEN :tdate AND :tdate1');

            $this->db->bind(':tdate', $data['tdate']);
            $this->db->bind(':tdate1', $data['tdate1']);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return $items;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function stockSearch($data)
    {
        try {
            $dateval = $data['dateval'];
            $itemlist = $this->db->query("select *, t1.id as main_id,DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date, DATEDIFF(left(expiry_date,10), '{$dateval}') as expiredays from stock_tb as t1
			left join brands as t2 on t1.brand_id = t2.id
			left join item_type as t3 on t1.item_type_id = t3.id
			left join category_type as t4 on t1.itemcat_type_id = t4.id
			left join selling_type as t5 on t1.selling_type_id = t5.id
			left join suppliers_tb as t6 on t1.supplier_id = t6.id
            where left(t1.activity_date, 10) BETWEEN :tdate AND :tdate1 and t1.status = 0");

            $this->db->bind(':tdate', $data['tdate']);
            $this->db->bind(':tdate1', $data['tdate1']);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return $items;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function checkdata($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('select * FROM stock_available 
            WHERE itemcat_type_id = :itemcat_type_id AND brand_id = :brand_id AND 
            item_type_id = :item_type_id');

            $this->db->bind(':itemcat_type_id', $data['itemcat_type_id']);
            $this->db->bind(':brand_id', $data['brand_id']);
            $this->db->bind(':item_type_id', $data['item_type_id']);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function checkalldata($data)
    {
        // var_dump($data);die();
        try {
            $dateval = $data['dateval'];
            $itemlist = $this->db->query("select *, DATEDIFF(left(expiry_date,10), '{$dateval}') as expiredays FROM stock_tb 
            WHERE itemcat_type_id = :itemcat_type_id AND brand_id = :brand_id AND 
            item_type_id = :item_type_id");

            $this->db->bind(':itemcat_type_id', $data['itemcat_type_id']);
            $this->db->bind(':brand_id', $data['brand_id']);
            $this->db->bind(':item_type_id', $data['item_type_id']);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function checkstocktodayall($data)
    {
        // var_dump($data);die();
        try {
            $tdate = $data['tdate'];
            $dateval = $data['dateval'];
            $itemlist = $this->db->query("SELECT *,(t1.number_added * t1.selling_price) as totalsp, DATEDIFF(left(expiry_date,10), '{$dateval}') as expiredays, DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date FROM stock_tb as t1
            left join category_type as t2 on t1.itemcat_type_id = t2.id
            left join item_type as t3 on t1.item_type_id = t3.id
            LEFT JOIN brands AS t4 ON t1.brand_id = t4.id WHERE left(t1.activity_date, 10) = '{$tdate}'
            ");

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function checkstocksearch($data)
    {
        // var_dump($data);die();
        try {
            $from = $data['from'];
            // $to = $data['to'];
            $procat = $data['product'] == 'All' ? '%' : $data['product'];
            $item_type = $data['item_type'] == 'All' ? '%' : $data['item_type'];
            $brand_type = $data['brand_type'] == 'All' ? '%' : $data['brand_type'];
            $tdate = $data['tdate'];
            $dateval = $data['dateval'];

            $itemlist = $this->db->query("SELECT *,(t1.number_added * t1.selling_price) as totalsp, DATEDIFF(left(expiry_date,10), '{$dateval}') as expiredays, DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date FROM stock_tb as t1
            left join category_type as t2 on t1.itemcat_type_id = t2.id
            left join item_type as t3 on t1.item_type_id = t3.id
            LEFT JOIN brands AS t4 ON t1.brand_id = t4.id 
            WHERE t1.itemcat_type_id like '{$procat}' and t1.item_type_id like '{$item_type}' and t1.brand_id like '{$brand_type}' and left(t1.activity_date, 10) = '{$from}'");

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function checkstocktoday($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query("SELECT *,(t1.number_added * t1.selling_price) as totalsp, DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date FROM stock_tb as t1
            left join category_type as t2 on t1.itemcat_type_id = t2.id
            left join item_type as t3 on t1.item_type_id = t3.id
            LEFT JOIN brands AS t4 ON t1.brand_id = t4.id 
            WHERE itemcat_type_id = 1 AND brand_id = 1 AND 
            item_type_id = 3 and left(t1.activity_date,10) = DATE(now())");

            $this->db->bind(':itemcat_type_id', $data['itemcat_type_id']);
            $this->db->bind(':brand_id', $data['brand_id']);
            $this->db->bind(':item_type_id', $data['item_type_id']);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function checkstockyesti($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query("SELECT *, DATE_FORMAT(left(t1.activity_date, 10), '%D %M, %Y') as activity_date FROM stock_tb as t1
            left join category_type as t2 on t1.itemcat_type_id = t2.id
            left join item_type as t3 on t1.item_type_id = t3.id
            WHERE itemcat_type_id = 1 AND brand_id = 1 AND 
            item_type_id = 3 and left(t1.activity_date,10) = adddate(DATE(now()), INTERVAL -1 DAY)");

            $this->db->bind(':itemcat_type_id', $data['itemcat_type_id']);
            $this->db->bind(':brand_id', $data['brand_id']);
            $this->db->bind(':item_type_id', $data['item_type_id']);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function checkallsale($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('SELECT * FROM sales_tb where st_id = :sid');

            $this->db->bind(':sid', $data);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function checkspecificsale($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('SELECT * FROM sales_tb where st_id = :sid');

            $this->db->bind(':sid', $data);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function itemleft($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('SELECT * FROM sales_tb where st_id = :sid order by id desc limit 1');

            $this->db->bind(':sid', $data);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function yestisales($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('SELECT * from sales_tb where st_id = :sid AND left(activity_date,10) = adddate(DATE(now()), INTERVAL -1 DAY) order by id desc limit 1');

            $this->db->bind(':sid', $data);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function yestisalesft($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('SELECT * from sales_tb where st_id = :sid AND left(activity_date,10) = adddate(DATE(now()), INTERVAL -1 DAY) order by id asc limit 1');

            $this->db->bind(':sid', $data);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function todaysalesft($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('SELECT * from sales_tb where st_id = :sid AND left(activity_date,10) = DATE(now()) order by id asc limit 1');

            $this->db->bind(':sid', $data);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function todaysalesst($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('SELECT * from sales_tb where st_id = :sid AND left(activity_date,10) = DATE(now()) order by id asc limit 1');

            $this->db->bind(':sid', $data);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function twodaysagosales($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('SELECT * from sales_tb where st_id = :sid AND left(activity_date,10) = adddate(DATE(now()), INTERVAL -2 DAY) order by id asc limit 1');

            $this->db->bind(':sid', $data);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function allyestisales($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('SELECT * from sales_tb where st_id = :sid AND left(activity_date,10) = adddate(DATE(now()), INTERVAL -1 DAY)');

            $this->db->bind(':sid', $data);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function allyestibacksales($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('SELECT * from sales_tb where st_id = :sid AND left(activity_date,10) = adddate(DATE(now()), INTERVAL -2 DAY)');

            $this->db->bind(':sid', $data);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function todaysinglesales($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('SELECT * from sales_tb where st_id = :sid AND left(activity_date,10) = DATE(now())');

            $this->db->bind(':sid', $data);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function selectstock($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('select * FROM stock_available 
            WHERE id = :stid');

            $this->db->bind(':stid', $data);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function singlecheckdata($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('select * FROM stock_available 
            WHERE id = :stid');

            $this->db->bind(':stid', $data['st_id']);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function sel_sale($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('select * FROM sales_tb 
            WHERE id = :stid');

            $this->db->bind(':stid', $data['st_id']);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function totalsell()
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('select sum(total_amount) as tsell from sales_tb where status = 0');

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function totalcost()
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('select sum(totalcost_price) as tcost from stock_tb where status = 0');

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function supplierquery($data)
    {
        try {
            $itemlist = $this->db->query('select * FROM suppliers_tb 
            WHERE suppliers_name = :suppliers_name');

            $this->db->bind(':suppliers_name', $data['suppliers_name']);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            if (empty($items)) {
                // var_dump($data);die();
                $this->db->query('INSERT INTO suppliers_tb 
                (suppliers_name,business_name,phone_no,email,address,submitting_date) 
                VALUES(:suppliers_name,:business_name,:phone_no,:email,:address,:submitting_date)');

                //Bind values
                $this->db->bind(':suppliers_name', $data['suppliers_name']);
                $this->db->bind(':business_name', $data['business_name']);
                $this->db->bind(':phone_no', $data['phone_no']);
                $this->db->bind(':email', $data['email']);
                $this->db->bind(':address', $data['address']);
                $this->db->bind(':submitting_date', $data['submitting_date']);
                //Execute function
                // var_dump($this->db->execute());die();
                if ($this->db->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
            // return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function addpro($data)
    {
        try {
            $itemlist = $this->db->query('select * FROM category_type 
            WHERE cat_type_name = :pname');

            $this->db->bind(':pname', $data['pname']);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            if (empty($items)) {
                // var_dump($data);die();
                $this->db->query('INSERT INTO category_type 
                (cat_type_name) 
                VALUES(:pname)');

                //Bind values
                $this->db->bind(':pname', $data['pname']);
                //Execute function
                // var_dump($this->db->execute());die();
                if ($this->db->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
            // return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function addpro1($data)
    {
        try {
            $itemlist = $this->db->query('select * FROM item_type 
            WHERE type_name = :pname');

            $this->db->bind(':pname', $data['pname']);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            if (empty($items)) {
                // var_dump($data);die();
                $this->db->query('INSERT INTO item_type 
                (type_name) 
                VALUES(:pname)');

                //Bind values
                $this->db->bind(':pname', $data['pname']);
                //Execute function
                // var_dump($this->db->execute());die();
                if ($this->db->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
            // return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function customerquery($data)
    {
        try {
            $itemlist = $this->db->query('select * FROM customer_tb 
            WHERE customer_name = :customer_name');

            $this->db->bind(':customer_name', $data['customer_name']);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            if (empty($items)) {
                // var_dump($data);die();
                $this->db->query('INSERT INTO customer_tb 
                (customer_name,gender,phone_no,address,digital_address
                ,email,family_size,brand_type,amount_bought,city,suburb
                ,street_name,days_to_consume,buyorder_date,next_order_date,other_details,submitting_date) 
                VALUES(:customer_name,:gender,:phone_no,:address,:digital_address
                ,:email,:family_size,:brand_type,:amount_bought,:city,:suburb
                ,:street_name,:days_to_consume,:buyorder_date,:next_order_date,:other_details,:submitting_date)');

                //Bind values
                $this->db->bind(':customer_name', $data['customer_name']);
                $this->db->bind(':gender', $data['gender']);
                $this->db->bind(':phone_no', $data['phone_no']);
                $this->db->bind(':address', $data['address']);
                $this->db->bind(':digital_address', $data['digital_address']);
                $this->db->bind(':email', $data['email']);
                $this->db->bind(':family_size', $data['family_size']);
                $this->db->bind(':brand_type', $data['brand_type']);
                $this->db->bind(':amount_bought', $data['amount_bought']);
                $this->db->bind(':city', $data['city']);
                $this->db->bind(':suburb', $data['suburb']);
                $this->db->bind(':street_name', $data['street_name']);
                $this->db->bind(':days_to_consume', $data['days_to_consume']);
                $this->db->bind(':buyorder_date', $data['buyorder_date']);
                $this->db->bind(':next_order_date', $data['next_order_date']);
                $this->db->bind(':other_details', $data['other_details']);
                $this->db->bind(':submitting_date', $data['submitting_date']);
                //Execute function
                // var_dump($this->db->execute());die();
                if ($this->db->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
            // return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function addexpenses($data)
    {
        try {
            // var_dump($data);die();
            $this->db->query('INSERT INTO expenses(ex_name,amount,login_id) VALUES(:exp_name,:amount,:userid)');

            //Bind values
            $this->db->bind(':exp_name', $data['exp_name']);
            $this->db->bind(':amount', $data['amount']);
            $this->db->bind(':userid', $data['userid']);
            //Execute function
            // var_dump($this->db->execute());die();
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
            // return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function userquery($data)
    {
        // var_dump($data);die();
        try {
            $this->db->query('INSERT INTO users_tb 
                (fname,lname,other_name,dob,phone_no,group_id,email,address
                ,city_name,suburb,gender,submitting_date) 
                VALUES(:fname, :lname, :other_name, :dob, :phone_no, :group_id, :email, :address
                , :city_name, :suburb, :gender, :submitting_date)');

            //Bind values
            $this->db->bind(':fname', $data['fname']);
            $this->db->bind(':lname', $data['lname']);
            $this->db->bind(':other_name', $data['other_name']);
            $this->db->bind(':dob', $data['dob']);
            $this->db->bind(':phone_no', $data['phone_no']);
            $this->db->bind(':group_id', $data['group_id']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':city_name', $data['city_name']);
            $this->db->bind(':suburb', $data['suburb']);
            $this->db->bind(':gender', $data['gender']);
            $this->db->bind(':submitting_date', $data['submitting_date']);
            //Execute function
            // var_dump($this->db->execute());die();
            if ($this->db->execute()) {
                $itemlist = $this->db->query('select max(id) as add_max FROM users_tb');

                $items = $this->db->resultSet();
                // var_dump($items);die();
                if ($items) {
                    foreach ($items as $key) {
                        $uid = $key->add_max;
                    }
                    $this->db->query('INSERT INTO login 
                        (group_id,username,password,name,uid) 
                        VALUES(:group_id, :username, :password, :name, :uid)');

                    //Bind values
                    $this->db->bind(':group_id', $data['group_id']);
                    $this->db->bind(':username', $data['username']);
                    $this->db->bind(':password', $data['password']);
                    $this->db->bind(':name', $data['name']);
                    $this->db->bind(':uid', $uid);
                    //Execute function
                    // var_dump($this->db->execute());die();
                    if ($this->db->execute()) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
            // return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function insertstock($data)
    {
        $this->db->query('INSERT INTO stock_tb (itemcat_type_id
        ,item_type_id
        ,brand_id
        ,selling_type_id
        ,number_added
        ,unitcost_price
        ,totalcost_price
        ,selling_price
        ,invoice_no
        ,supplier_id
        ,submitting_date
        ,item_pic
        ,expiry_date
        ,wholesale_selling_price
        ,username) 
        VALUES(:itemcat_type_id
        ,:item_type_id
        ,:brand_id
        ,:selling_type_id
        ,:number_added
        ,:unitcost_price
        ,:totalcost_price
        ,:selling_price
        ,:invoice_no
        ,:supplier_id
        ,:submitting_date
        ,:item_pic
        ,:expiry_date
        ,:wholesale_selling_price
        ,:username)');

        //Bind values
        $this->db->bind(':itemcat_type_id', $data['itemcat_type_id']);
        $this->db->bind(':item_type_id', $data['item_type_id']);
        $this->db->bind(':brand_id', $data['brand_id']);
        $this->db->bind(':selling_type_id', $data['selling_type_id']);
        $this->db->bind(':number_added', $data['number_added']);
        $this->db->bind(':unitcost_price', $data['unitcost_price']);
        $this->db->bind(':totalcost_price', $data['totalcost_price']);
        $this->db->bind(':selling_price', $data['selling_price']);
        $this->db->bind(':invoice_no', $data['invoice_no']);
        $this->db->bind(':supplier_id', $data['supplier_id']);
        $this->db->bind(':expiry_date', $data['expiry_date']);
        $this->db->bind(':submitting_date', $data['submitting_date']);
        $this->db->bind(':wholesale_selling_price', $data['wholesale_selling_price']);
        $this->db->bind(':item_pic', $data['item_pic']);
        $this->db->bind(':username', $data['username']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertstock2($data)
    {
        $this->db->query('INSERT INTO stock_tb (itemcat_type_id
        ,brand_id
        ,item_type_id
        ,selling_type_id
        ,number_added
        ,unitcost_price
        ,totalcost_price
        ,selling_price
        ,invoice_no
        ,supplier_id
        ,submitting_date
        ,item_pic
        ,expiry_date
        ,wholesale_selling_price
        ,username) 
        VALUES(:itemcat_type_id
        ,:item_type_id
        ,:brand_id
        ,:selling_type_id
        ,:number_added
        ,:unitcost_price
        ,:totalcost_price
        ,:selling_price
        ,:invoice_no
        ,:supplier_id
        ,:submitting_date
        ,:item_pic
        ,:expiry_date
        ,:wholesale_selling_price
        ,:username)');

        //Bind values
        $this->db->bind(':itemcat_type_id', $data['itemcat_type_id']);
        $this->db->bind(':item_type_id', $data['item_type_id']);
        $this->db->bind(':brand_id', $data['brand_id']);
        $this->db->bind(':selling_type_id', $data['selling_type_id']);
        $this->db->bind(':number_added', $data['number_added']);
        $this->db->bind(':unitcost_price', $data['unitcost_price']);
        $this->db->bind(':totalcost_price', $data['totalcost_price']);
        $this->db->bind(':selling_price', $data['selling_price']);
        $this->db->bind(':invoice_no', $data['invoice_no']);
        $this->db->bind(':supplier_id', $data['supplier_id']);
        $this->db->bind(':expiry_date', $data['expiry_date']);
        $this->db->bind(':submitting_date', $data['submitting_date']);
        $this->db->bind(':wholesale_selling_price', $data['wholesale_selling_price']);
        $this->db->bind(':item_pic', $data['item_pic']);
        $this->db->bind(':username', $data['username']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertavailstock($data)
    {
        $this->db->query('INSERT INTO stock_available 
        (itemcat_type_id,item_type_id,brand_id,selling_type_id,number_added,unitcost_price,totalcost_price,selling_price,submitting_date,expiry_date,item_pic,wholesale_selling_price,barcode) 
        VALUES(:itemcat_type_id,:item_type_id,:brand_id,:selling_type_id,:number_added,:unitcost_price,:totalcost_price,:selling_price,:submitting_date,:expiry_date,:item_pic,:wholesale_selling_price,:barcode)');

        //Bind values
        $this->db->bind(':itemcat_type_id', $data['itemcat_type_id']);
        $this->db->bind(':item_type_id', $data['item_type_id']);
        $this->db->bind(':brand_id', $data['brand_id']);
        $this->db->bind(':selling_type_id', $data['selling_type_id']);
        $this->db->bind(':number_added', $data['number_added']);
        $this->db->bind(':unitcost_price', $data['unitcost_price']);
        $this->db->bind(':totalcost_price', $data['totalcost_price']);
        $this->db->bind(':selling_price', $data['selling_price']);
        $this->db->bind(':item_pic', $data['item_pic']);
        $this->db->bind(':expiry_date', $data['expiry_date']);
        $this->db->bind(':barcode', $data['barcode']);
        $this->db->bind(':wholesale_selling_price', $data['wholesale_selling_price']);
        $this->db->bind(':submitting_date', $data['submitting_date']);
        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertstockdaily($data)
    {
        $this->db->query('INSERT INTO stocks_daily 
        (total_stock, total_amount) 
        VALUES(:total_stock,:total_amount)');

        //Bind values
        $this->db->bind(':total_stock', $data['totalno']);
        $this->db->bind(':total_amount', $data['totalstr']);
        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getstdaily()
    {
        try {
            $itemlist = $this->db->query('select * FROM stocks_daily order by id desc limit 1');

            $items = $this->db->resultSet();

            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function brandinsert($data)
    {
        try {
            $itemlist = $this->db->query('select * FROM brands where brand_name = :brandname ORDER BY id');

            $this->db->bind(':brandname', $data['brand_name']);
            $items = $this->db->resultSet();

            if (empty($items)) {
                $this->db->query('INSERT INTO brands (brand_name) VALUES(:brandname)');
                $this->db->bind(':brandname', $data['brand_name']);

                if ($this->db->execute()) {
                    $itemlist = $this->db->query('select * FROM brands where brand_name = :brandname ORDER BY id');

                    $this->db->bind(':brandname', $data['brand_name']);
                    $items = $this->db->resultSet();
                    return (int) $items > 0 ? $items : false;
                } else {
                    return false;
                }
            } else {
                return (int) $items > 0 ? $items : false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function selectstockadded($data)
    {
        try {
            $itemlist = $this->db->query('select * FROM stock_tb where id = :sid');

            $this->db->bind(':sid', $data['st_id']);
            $items = $this->db->resultSet();

            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function selectavailablestock($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('select * FROM stock_available where itemcat_type_id = :itemcat_type_id
            and brand_id = :brand_id and item_type_id = :item_type_id');

            $this->db->bind(':itemcat_type_id', $data['itemcat_type_id']);
            $this->db->bind(':item_type_id', $data['item_type_id']);
            $this->db->bind(':brand_id', $data['brand_id']);
            $items = $this->db->resultSet();

            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function bring_expenses()
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('select t1.*, t2.*, t1.id as main_id FROM expenses as t1 left join login as t2 on t1.login_id = t2.id');

            $items = $this->db->resultSet();

            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }


    public function sellquery($data)
    {
        try {
            $this->db->query('update stock_available set number_added = number_added - :no_purchased where id = :st_id ');
            $this->db->bind(':no_purchased', $data['no_purchased']);
            $this->db->bind(':st_id', $data['st_id']);
            // $this->db->bind(':unit_amount', $data['unit_amount']);

            if ($this->db->execute()) {
                if ($data['pagetype'] == 1) {
                    // var_dump($data);die();
                    // echo 'pla';die();
                    $this->db->query('INSERT INTO sales_tb 
                    (itemcat_type_id ,item_type_id ,brand_id ,selling_type_id
                    ,num_available ,no_purchased ,unit_amount ,total_amount ,submitting_date
                    ,customer_id, sale_type, st_id, soldby) 
                    VALUES
                    (:itemcat_type_id, :item_type_id, :brand_id, :selling_type_id
                    , :num_available, :no_purchased, :unit_amount, :total_amount, :submitting_date
                    , :customer_id, :sale_type, :st_id, :username)');

                    $this->db->bind(':sale_type', $data['sale_type']);
                    $this->db->bind(':itemcat_type_id', $data['itemcat_type_id']);
                    $this->db->bind(':item_type_id', $data['item_type_id']);
                    $this->db->bind(':brand_id', $data['brand_id']);
                    $this->db->bind(':selling_type_id', $data['selling_type_id']);
                    $this->db->bind(':num_available', $data['num_available']);
                    $this->db->bind(':no_purchased', $data['no_purchased']);
                    $this->db->bind(':unit_amount', $data['unit_amount']);
                    $this->db->bind(':total_amount', $data['total_amount']);
                    $this->db->bind(':submitting_date', $data['submitting_date']);
                    $this->db->bind(':customer_id', $data['customer_id']);
                    $this->db->bind(':st_id', $data['st_id']);
                    $this->db->bind(':username', $_SESSION['username']);
                    if ($this->db->execute()) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    $this->db->query('INSERT INTO sales_tb 
                    (st_id ,itemcat_type_id ,item_type_id ,brand_id ,selling_type_id
                    ,num_available ,no_purchased ,unit_amount ,total_amount ,submitting_date
                    ,order_no ,soldby, sold_in, price_type) 
                    VALUES
                    (:st_id, :itemcat_type_id, :item_type_id, :brand_id, :selling_type_id
                    , :num_available, :no_purchased, :unit_amount, :total_amount, :submitting_date
                    , :order_no, :username, :sold_in, :ptype)');

                    $this->db->bind(':sold_in', $data['saletype']);
                    $this->db->bind(':st_id', $data['st_id']);
                    $this->db->bind(':itemcat_type_id', $data['itemcat_type_id']);
                    $this->db->bind(':item_type_id', $data['item_type_id']);
                    $this->db->bind(':brand_id', $data['brand_id']);
                    $this->db->bind(':selling_type_id', $data['selling_type_id']);
                    $this->db->bind(':num_available', $data['num_available']);
                    $this->db->bind(':no_purchased', $data['no_purchased']);
                    $this->db->bind(':unit_amount', $data['unit_amount']);
                    $this->db->bind(':total_amount', $data['total_amount']);
                    $this->db->bind(':submitting_date', $data['submitting_date']);
                    $this->db->bind(':order_no', $data['order_no']);
                    $this->db->bind(':ptype', $data['ptype']);
                    $this->db->bind(':username', $_SESSION['username']);
                    if ($this->db->execute()) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updatesell_price($data)
    {
        try {
            $this->db->query('update stock_available set selling_price = :new_price where id = :st_id ');
            $this->db->bind(':new_price', $data['new_price']);
            $this->db->bind(':st_id', $data['st_id']);
            // $this->db->bind(':unit_amount', $data['unit_amount']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updatebarcode($data)
    {
        try {
            $this->db->query('update stock_available set barcode = :barcode where id = :st_id ');
            $this->db->bind(':barcode', $data['barcode']);
            $this->db->bind(':st_id', $data['st_id']);
            // $this->db->bind(':unit_amount', $data['unit_amount']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function gettotal_courses($sid)
    {
        $this->db->query("select * from brands
        WHERE id='$sid' ORDER BY brand_name");

        $result = $this->db->resultSet();

        return $result;
    }

    public function checkbarcode($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('select *,t1.id FROM stock_available as t1 left join brands as t2 on t1.brand_id = t2.id
            WHERE barcode = :barcode');

            $this->db->bind(':barcode', $data['barcode']);

            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function update_return($data)
    {
        try {
            $this->db->query('update stock_available set total_sp = :total_sp, number_added = :total_no where id = :stock_ava_id ');
            $this->db->bind(':total_no', $data['total_no']);
            $this->db->bind(':total_sp', $data['total_sp']);
            $this->db->bind(':stock_ava_id', $data['stock_ava_id']);
            // $this->db->bind(':unit_amount', $data['unit_amount']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updatesell_wholesale_price($data)
    {
        try {
            $this->db->query('update stock_available set wholesale_selling_price = :new_price where id = :st_id ');
            $this->db->bind(':new_price', $data['new_price']);
            $this->db->bind(':st_id', $data['st_id']);
            // $this->db->bind(':unit_amount', $data['unit_amount']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updateavailstock($data, $data2)
    {
        // echo 'sk';
        // var_dump($data2);
        // die();
        try {
            $itemlist = $this->db->query('update stock_available 
            set number_added = :number_added, unitcost_price = :unitcost_price, 
            totalcost_price = :totalcost_price, selling_price = :selling_price, item_pic = :item_pic, expiry_date = :expiry_date, wholesale_selling_price = :wholesale_selling_price, barcode =:barcode where id = :sid');

            $this->db->bind(':number_added', $data2['totaladded']);
            $this->db->bind(':unitcost_price', $data['unitcost_price']);
            $this->db->bind(':totalcost_price', $data['totalcost_price']);
            $this->db->bind(':selling_price', $data['selling_price']);
            $this->db->bind(':sid', $data2['stid']);
            $this->db->bind(':item_pic', $data['item_pic']);
            $this->db->bind(':wholesale_selling_price', $data['wholesale_selling_price']);
            $this->db->bind(':barcode', $data['barcode']);
            $this->db->bind(':expiry_date', $data['expiry_date']);

            $items = $this->db->execute();
            // var_dump($items);
            // die();
            return (int) $items ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function changepasswordquery($data)
    {
        // echo 'sk';
        // var_dump($data2);
        // die();
        try {
            $itemlist = $this->db->query('update login 
            set password = :password where id = :userid');

            $this->db->bind(':password', $data['password']);
            $this->db->bind(':userid', $data['userid']);
            $items = $this->db->execute();
            // var_dump($items);
            // die();
            return (int) $items ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updatecustomer($data)
    {
        // echo 'sk';
        // var_dump($data2);
        // die();
        try {
            $itemlist = $this->db->query('update customer_tb 
            set amount_bought = :no_purchased, buyorder_date = :buyorder_date, brand_type = :brand_id where id = :customer_id');

            $this->db->bind(':brand_id', $data['brand_id']);
            $this->db->bind(':customer_id', $data['customer_id']);
            $this->db->bind(':no_purchased', $data['no_purchased']);
            $this->db->bind(':buyorder_date', $data['buyorder_date']);
            $items = $this->db->execute();
            // var_dump($items);
            // die();
            return (int) $items ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updatesale($data)
    {
        // var_dump($data2);die();
        try {
            $itemlist = $this->db->query('update sales_tb 
            set no_purchased = :no_purchased, unit_amount = :unit_amount, 
            total_amount = :total_amount where id = :st_id');

            $this->db->bind(':st_id', $data['st_id']);
            $this->db->bind(':no_purchased', $data['no_purchased']);
            $this->db->bind(':unit_amount', $data['unit_amount']);
            $this->db->bind(':total_amount', $data['total_amount']);
            $items = $this->db->execute();
            // var_dump($items);
            // die();
            return (int) $items ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updatestock($data)
    {
        // var_dump($data2);die();
        try {
            $itemlist = $this->db->query('update stock_tb 
            set number_added = :no_added, unitcost_price = :unit_price, totalcost_price = :total_price,
            selling_price = :selling_price,invoice_no = :invoice_no, wholesale_selling_price = :wholesale_selling_price where id = :stockid');

            $this->db->bind(':stockid', $data['st_id']);
            $this->db->bind(':no_added', $data['no_added']);
            $this->db->bind(':unit_price', $data['unit_price']);
            $this->db->bind(':total_price', $data['total_price']);
            $this->db->bind(':selling_price', $data['selling_price']);
            $this->db->bind(':wholesale_selling_price', $data['wholesale_selling_price']);
            $this->db->bind(':invoice_no', $data['invoice_no']);
            // var_dump($items);
            // die();
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updateavailablestock($data, $st_available_id)
    {
        // var_dump($st_available_id);die();
        try {
            $itemlist = $this->db->query('update stock_available 
            set number_added = :no_added, unitcost_price = :unit_price, totalcost_price = :total_price,
            selling_price = :selling_price, wholesale_selling_price=:wholesale_selling_price where id = :stockid');

            $this->db->bind(':stockid', $st_available_id);
            $this->db->bind(':no_added', $data['no_added']);
            $this->db->bind(':unit_price', $data['unit_price']);
            $this->db->bind(':total_price', $data['total_price']);
            $this->db->bind(':selling_price', $data['selling_price']);
            $this->db->bind(':wholesale_selling_price', $data['wholesale_selling_price']);
            // var_dump($items);
            // die();
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function brandedit($data)
    {
        // var_dump($data2);die();
        try {
            $itemlist = $this->db->query('update brands 
            set brand_name = :brandname where id = :st_id');

            $this->db->bind(':st_id', $data['st_id']);
            $this->db->bind(':brandname', $data['brandname']);
            $items = $this->db->execute();
            // var_dump($items);
            // die();
            return (int) $items ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function supplieredit($data)
    {
        // var_dump($data2);die();
        try {
            $itemlist = $this->db->query('update suppliers_tb 
            set suppliers_name = :suppliers_name,phone_no = :phone_no,
            email = :email,business_name = :business_name,address = :address where id = :sid');

            $this->db->bind(':sid', $data['sid']);
            $this->db->bind(':suppliers_name', $data['suppliers_name']);
            $this->db->bind(':phone_no', $data['phone_no']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':business_name', $data['business_name']);
            $this->db->bind(':address', $data['address']);
            $items = $this->db->execute();
            // var_dump($items);
            // die();
            return (int) $items ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function useredit($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('update users_tb 
            set fname = :fname, lname = :lname, other_name = :other_name, dob = :dob,
            phone_no = :phone_no,group_id = :group_id,email = :email,address = :address,
            city_name = :city_name, suburb = :suburb,
            gender = :gender where id = :user_id');

            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':fname', $data['fname']);
            $this->db->bind(':lname', $data['lname']);
            $this->db->bind(':other_name', $data['other_name']);
            $this->db->bind(':dob', $data['dob']);
            $this->db->bind(':phone_no', $data['phone_no']);
            $this->db->bind(':group_id', $data['group_id']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':city_name', $data['city_name']);
            $this->db->bind(':suburb', $data['suburb']);
            $this->db->bind(':gender', $data['gender']);

            $items = $this->db->execute();
            // var_dump($items);
            // die();
            return (int) $items ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function cusedit($data)
    {
        // var_dump($data);die();
        try {
            $itemlist = $this->db->query('update customer_tb 
            set 
            customer_name = :customer_name,
            gender = :gender,
            phone_no = :phone_no,
            address = :address,
            digital_address = :digital_address,
            email = :email,
            family_size = :family_size,
            amount_bought = :amount_bought,
            city = :city,
            suburb = :suburb,
            street_name = :street_name,
            days_to_consume = :days_to_consume,
            buyorder_date = :buyorder_date,
            other_details = :other_details
            where id = :cusid');

            $this->db->bind(':cusid', $data['cusid']);
            $this->db->bind(':customer_name', $data['customer_name']);
            $this->db->bind(':gender', $data['gender']);
            $this->db->bind(':phone_no', $data['phone_no']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':digital_address', $data['digital_address']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':family_size', $data['family_size']);
            $this->db->bind(':amount_bought', $data['amount_bought']);
            $this->db->bind(':city', $data['city']);
            $this->db->bind(':suburb', $data['suburb']);
            $this->db->bind(':street_name', $data['street_name']);
            $this->db->bind(':days_to_consume', $data['days_to_consume']);
            $this->db->bind(':buyorder_date', $data['buyorder_date']);
            $this->db->bind(':other_details', $data['other_details']);

            $items = $this->db->execute();
            // var_dump($items);
            // die();
            return (int) $items ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($data)
    {
        // var_dump($data);die();
        $table = $data['table'];
        try {
            $itemlist = $this->db->query('delete from ' . $table . ' where id = :st_id2');

            $this->db->bind(':st_id2', $data['st_id2']);
            $items = $this->db->execute();
            // var_dump($items);
            // die();
            return (int) $items ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function freeze($data)
    {
        // var_dump($data);die();
        $table = $data['table'];
        try {
            $itemlist = $this->db->query('update ' . $table . ' set flag = 1 where id = :st_id2');

            $this->db->bind(':st_id2', $data['st_id2']);
            $items = $this->db->execute();
            // var_dump($items);
            // die();
            return (int) $items ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }



    public function salesel($data)
    {
        // var_dump($data);die();
        $table = $data['table'];
        try {
            $itemlist = $this->db->query('select * from ' . $table . ' where id = :st_id2');

            $this->db->bind(':st_id2', $data['st_id2']);
            $items = $this->db->resultSet();
            // var_dump($items);die();
            return (int) $items > 0 ? $items : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function log_activity($data)
    {
        // var_dump($data);die();
        $table = $data['table'];
        try {
            $itemlist = $this->db->query('INSERT into activity_log(username,activity) VALUES (:username,:activity)');

            $this->db->bind(':username', $data['username']);
            $this->db->bind(':activity', $data['activity']);
            $items = $this->db->execute();
            // var_dump($items);
            // die();
            return (int) $items ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
