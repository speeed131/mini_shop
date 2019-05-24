<?php

$pro_code = $_POST['pro_code'];             //pro_list.phpのinputのnameの『pro_code』(つまりvalueのidである)を$pro_codeに代入

if(isset($_POST['add']) == true){              
    
    header('Location:pro_add.php');        
    exit();                                      //addが選択していれば、pro_add.phpに飛ばす

}elseif ($pro_code == null){

    header('Location:pro_ng.php');              //選択してなかったら、pro_ng.phpに飛ばす
    exit();
}
else{
    if(isset($_POST['detail']) == true){
        header('Location:pro_detail.php?pro_code='.$pro_code);
        exit();                                 //選択がnullでもなく、detailが選択されていたら・・・
    }

    elseif(isset($_POST['edit']) == true){
        header('Location:pro_edit.php?pro_code='.$pro_code);
        exit();                                 //選択がnullでもなく、editが選択されていたら・・・
    }
    elseif(isset($_POST['delete']) == true){
        header('Location:pro_delete.php?pro_code='.$pro_code);
        exit();                                 //選択がnullでもなく、deleteが選択されていたら・・・
    }
}