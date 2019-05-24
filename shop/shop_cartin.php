<?php

require_once('../common/common.php');

session_start();
session_regenerate_id(true);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Shop</title>
</head>

<body>

<?php

try {

$pro_code = $_GET['pro_code'];

if(isset($_SESSION['cart'])){       

  $cart = $_SESSION['cart'];
  $kazu = $_SESSION['kazu'];

  if(in_array($pro_code, $cart) == true) {    //配列に$pro_codeと$cartがあるなら・・・
    echo 'This item has already been in the cart

          <br>

          <a href="../index.php">Back to shop list</a>';

    exit();
  }
}

$cart[] = $pro_code;
$kazu[] = 1;                    //ここで、$pro_codeを$cart[]にわかりやすいように代入
                                //$kazuはカートに入れる個数
$_SESSION['cart'] = $cart;

$_SESSION['kazu'] = $kazu;
                                //$cartと$kazuを$_SESSIONで記憶させる
}catch(Exeption $e) {
  echo 'I am sorry but something might be wrong on this server..';

  exit();
}

?>

カートに追加しました。<br>
<a href="../index.php">商品一覧に戻る</a>
</body>
</html>