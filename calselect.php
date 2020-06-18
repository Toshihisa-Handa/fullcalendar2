<?php
include('funcs.php');//別の階層にfuncs.phpがある場合は「betukaisou/funcs.php」などパスを変えてincludesする


//1. DB接続します
$pdo= dbcon();



//2．データ登録SQL作成
//prepare("")の中にはmysqlのSQLで入力したINSERT文を入れて修正すれば良いイメージ
$stmt = $pdo->prepare("SELECT* FROM calendar_table");
$status = $stmt->execute();


//3．データ登録処理後（基本コピペ使用でOK)
$view='';
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);//エラーが起きたらエラーの2番目の配列から取ります。ここは考えず、これを使えばOK
                             // SQLEErrorの部分はエラー時出てくる文なのでなんでもOK
}else{
 //selectデータの数だけ自動でループしてくれる
 while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
  //  $view.='<p>'.$r['id'].$r['name'].$r['author'].$r['kan'].$r['kansou'].$r['indate'].'</p>';

  //更新用リンクを埋め込んだ表示コード(元のselect.phpから修正する箇所)
  $view .='<p>';
  // $view .='<a href="u_view.php? id='.$r["id"].'">';
  $view .=$r["day"].":".$r["time"].":".$r["title"].":".$r["description"].":".$r["color"].":".$r["textColor"];
  // $view .='</a>';
//以下はupdateのリンクタグの記述
  $view .='  ';
  $view .='<a href="u_view.php? id='.$r["id"].'">';
  $view .='[更新]';
  $view .='</a>';
//以下はdeleteのリンクタグの記述
  $view .='  ';
  $view .='<a href="delete.php? id='.$r["id"].'">';
  $view .='[削除]';
  $view .='</a>';
  $view .='</p>';
 }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>DB登録状況
  </h1>
  <a href="cal.php">登録へ戻る</a>
  <p><a href="logout.php">ログアウト</a></p>

 <p><?=$view?></p>
</body>
</html>