<?php

require_once('../common/common.php');

?>

<!DOCTYPE html>
<html lang="ja">
<body>
<?php

try{

    $pro_code = $_GET['pro_code'];                                  //url上にあるidをGETする

    $pro_code = htmlspecialchars($pro_code, ENT_QUOTES, UTF-8);     //スペースやハックなどを削除するため
    
    $dbh = connectDB();

    $sql = 'select name, price, image from mst_product where id=?';        //$sqlに、name,price,imageをmst_productからidだけ持ってくる、コマンドを代入
    $stmt = $dbh->prepare($sql);                                           //$stmtに、$dbhのデータベースから$sqlのコマンドを入れる
    $data[] = $pro_code;                                                   //$pro_codeを$data[]に代入
    $stmt->execute($data);                                                 //$stmtを$dataにexecuteで出力

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);                                 //$stmtを連想配列で$recに代入
    $pro_name = $rec['name'];                                              //$rec['name']は$pro_nameに
    $pro_price = $rec['price'];
    $pro_image = $rec['image'];

    $dbh = null;                                                           //データベース接続を切る

    if($pro_image == ''){
        $desc_image = '';
    }else{
        $desc_image = 'product image : <br>'. '<image width="150" src="./image/'.$pro_image.'">';

    }  /*
        $pro_imageが空なら$desc_imageも空
        それ以外は、$desc_imageに、  product image: width=150の、image画像の$pro_imageを代入している
        画像にデータベース上に保存している訳ではないため、imgフォルダのものに指定している
        */

}catch(Exception $e){
    
    echo 'I am sorry butsomething might be wrong on this server..';
    exit();
}

?>
The imfomation of product.<br>
  product id : <?php echo $pro_code; ?>
  <br>
  product name : <?php echo $pro_name; ?>
  <br>
  product price : <?php echo $pro_price; ?>
  <br>
  <?php echo $desc_image?>
  <br>
  <input type="button" onclick="history.back()" value="Back">
    
</body>
</html>