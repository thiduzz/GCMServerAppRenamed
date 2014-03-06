<?php
 
// response json
$json = array();
 
/**
 * Registering a user device
 * Store reg id in users table
 */
if (isset($_REQUEST["name"]) && isset($_REQUEST["hash"]) && isset($_REQUEST["shop_id"]) && isset($_REQUEST["regId"])) {
    $name = $_REQUEST["name"];
    $hash = $_REQUEST["hash"];
    $shop_id = $_REQUEST["shop_id"];
    $gcm_regid = $_REQUEST["regId"]; // GCM Registration ID
    // Store user details in db
    include_once './db_functions.php';
    include_once './GCM.php';
 
    $db = new DB_Functions();
    $gcm = new GCM();
    $res = $db->storeUser($name, $hash, $shop_id, $gcm_regid);
 
    $registatoin_ids = array($gcm_regid);
    if(res != false)
    {
    $message = "Registered and DB inserted";
    }else{
        $message = "Fail";
    }
    $result = $gcm->send_notification($registatoin_ids, $message);
 
    echo $result;
} else {
    // user details missing
}
?>