<?php

$pro_code = $_POST['pro_code'];             //pro_list.phpのinputのnameの『pro_code』(つまりvalueのidである)を$pro_codeに代入


if(isset($_POST['cart']) == true){
    header('Location:shop_cart_list.php');
    exit();                                 
}

elseif ($pro_code == null){

    header('Location:shop_ng.php');              //選択してなかったら、pro_ng.phpに飛ばす
    exit();
}
else{
    if(isset($_POST['detail']) == true){
        header('Location:shop_detail.php?pro_code='.$pro_code);
        exit();                                 //選択がnullでもなく、detailが選択されていたら・・・
    }

}