<?php

require_once('../common/common.php');   

try{
    $dbh = connectDB();                            //connectDBに接続

    $sql = 'select id, name, price from mst_product where 1';      //$sqlにid,name,priceをmst_productから全部持ってくるを代入　１＝全部
    $stmt = $dbh->prepare($sql);                    //$sqlを$dbhから準備する、それを$stmtに代入する
    $stmt->execute();                               //$stmtをexecute()で出力する

    $dbh = null;                                      //接続を切る（exit)

    echo 'product list<br>';                                

    echo '<form method="POST" action="pro_branch.php">';  //formメソッドだと、一つしかアクション先を指定できないため、pro_branch.phpに渡してから、それぞれ飛ばす
    while(true){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);          //$stmtを連想配列で$recに代入
        if($rec == false){                              //$recがfalseだったらbreakして止める
            break;
        }
        echo <<<EOD
        <input type="radio" name="pro_code" value="$rec[id]">               
        $rec[name]:$rec[price]JPY
        <br>
EOD;
        //inputにvalueで$rec[id]を、記述で$rec[name],$rec[price]を、breakするまで（商品がなくなるまで）書いていく

    }
    echo <<<EOD
        <input type="submit" name="add" value="add">
        <input type="submit" name="detail" value="detail">
        <input type="submit" name="edit" value="edit">
        <input type="submit" name="delete" value="delete">
        </form>
EOD;
        //その下にadd,detai,edit,deleteボタンをつける
}
    catch(Exceptin $e){
        echo 'I am sorry but something might be wrong on this server..';
        exit();
    }
        //tryが失敗したらこの表示をする