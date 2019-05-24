
<?php

require_once('../common/common.php');   

try{
    $dbh = connectDB();                            //connectDBに接続

    $sql = 'select id, name, price from mst_product where 1';      //$sqlにid,name,priceをmst_productから全部持ってくるを代入　１＝全部
    $stmt = $dbh->prepare($sql);                    //$sqlを$dbhから準備する、それを$stmtに代入する
    $stmt->execute();                               //$stmtをexecute()で出力する

    $dbh = null;                                      //接続を切る（exit)

    echo 'Shop List<br>';                                
    echo <<<EOD

EOD;
    echo '<form method="POST" action="shop_branch.php">';  
    while(true){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);          //$stmtを連想配列で$recに代入
        if($rec == false){                              //$recがfalseだったらbreakして止める
            break;
        }
        echo <<<EOD

                    <input type="radio" name="pro_code" value="$rec[id]">
                    $rec[name]
                    $rec[price]JPY
        <br>
EOD;
        //inputにvalueで$rec[id]を、記述で$rec[name],$rec[price]を、breakするまで（商品がなくなるまで）書いていく

    }
    echo <<<EOD
        <input type="submit" name="detail" value="detail">
        <input type="submit" name="cart" value="cart list">
        </form>
EOD;
        //その下にadd,detai,edit,deleteボタンをつける
}
    catch(Exceptin $e){
        echo 'I am sorry but something might be wrong on this server..';
        exit();
    }
        //tryが失敗したらこの表示をする