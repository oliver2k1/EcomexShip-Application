<?php 
  include_once "../../Model/order.php";
  $order = new order();
  if ($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
    
    $update_order = $order->update_order($_POST);
  }
?>
