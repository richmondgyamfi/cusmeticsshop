<?php
class Functions {
    private $db;
	private $file_type = ['image/jpg','image/png','image/jpeg','image/gif', 'audio/mp3', 'video/mp4', 'audio/wma'];

    public function __construct() {
        $this->db = new Database;
    }

    public function getUserIP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }


    
    public function single_fileupload($staff_files){
        // echo 'asdn';die();
        $files = preg_replace('/\s+/', '', $staff_files['name']);
        $tempfile = $staff_files['tmp_name'];
        $typefile = $staff_files['type'];
        $sizefile = $staff_files['size'];
        $timestamp = time()+date("Z");
        if(empty($tempfile)){
            $newfilePath = '';
        }
        elseif($sizefile < 2000 || $sizefile > 500000){
            $newfilePath = 'sizeerror';
        }elseif(!in_array($typefile, $this->file_type)){
            $newfilePath = 'typeerror';
        }elseif(empty($tempfile)){
            $newfilePath = 'temperror';
        }else{
            $newfilePath = APPROOT2."/public/img/products/".$timestamp.$files;
                // echo $newfilePath;
                // echo $tempfile;
                // die();
                $file1 = move_uploaded_file($tempfile, $newfilePath);
                // var_dump($file1);
                // die();
                if($file1){
                $newfilePath = $timestamp.$files;
                // return $newfilePath;
                }else{
                    $newfilePath = 'error';
            }
        }
        return $newfilePath;
    }

    public function orderno(){
		$rn1 = rand(100000, 999909);
		$rn2 = rand(10000, 99999);
		$rn = $rn1.$rn2;
		$order_no = $rn;
		return $order_no;
	}


}
