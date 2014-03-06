<?php
if (isset($_GET["regId"]) && isset($_GET["order_num"]) && isset($_GET["order_val"]) && isset($_GET["order_items"])&& isset($_GET["order_customer"])) {
    $regId = $_GET["regId"];
    $order_num = $_GET["order_num"];
    $order_val = $_GET["order_val"];
    $order_items = $_GET["order_items"];
    $order_customer = $_GET["order_customer"];
     
    include_once './GCM.php';
     
    $gcm = new GCM();
    $message = array("type"=>"order", "order_num" => $order_num, "order_val" => $order_val, "order_items" => $order_items, "order_customer" => $order_customer);
    $registatoin_ids = array($regId);    
    $result = $gcm->send_notification($registatoin_ids, $message);
    echo $result;
}
?>