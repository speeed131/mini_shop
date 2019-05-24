<?php

session_start();

try{

    $pro_code = $_GET['pro_code'];                                  //url上にあるidをGETする

    $pro_code = htmlspecialchars($pro_code, ENT_QUOTES, UTF-8);     //スペースやハックなどを削除するため
    
    $_SESSION['id'] = $pro_code;

    echo "Added item to the cart";

}catch(Exception $e){
    
    echo 'I am sorry butsomething might be wrong on this server..';
    exit();
}

?>

