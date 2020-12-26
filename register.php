<?php 
    $database = new PDO('mysql:host=localhost;dbname=shopdatabase;charset=UTF8;', 'root', '');
    
    $register_name_sei = $_POST['name_sei'];
    $register_name_sei =  htmlspecialchars($register_name_sei, ENT_QUOTES, 'UTF-8');
    $register_name_mei = $_POST['name_mei'];
    $register_name_mei =  htmlspecialchars($register_name_mei, ENT_QUOTES, 'UTF-8');
    $register_age = $_POST['age'];
    $register_age =  htmlspecialchars($register_age, ENT_QUOTES, 'UTF-8');
    
    
    // 全結果表示用
    $all_sql = "SELECT * FROM customer";
    $all_statement = $database->query($all_sql);
    $customers = $all_statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>顧客情報　登録ページ</h1>
        <form method="post">
            <p>
                姓<input type="text" name="name_sei"/>
                名<input type="text" name="name_mei"/>
            </p>
            <p>
                年齢<input type="text" name="age"/>
            </p>
            <input type="submit" value="登録"/>
        </form>
        <?php
            if($register_name_sei && $register_name_mei && $register_age){
                $sql = "INSERT INTO customer (name_sei, name_mei, age) VALUES (:name_sei, :name_mei, :age)";
                $statement = $database->prepare($sql);
                $statement->bindParam(':name_sei', $register_name_sei);
                $statement->bindParam(':name_mei', $register_name_mei);
                $statement->bindParam(':age', $register_age);
                $statement->execute();
                $statement->fetchAll();
            } else {
                echo 'すべての項目を入力してください';
            }
        ?>
        
        <table>
            <tr><th>id</th><th>姓</th><th>名</th><th>年齢</th><th>作成日時</th></tr>
            <?php 
                foreach($customers as $customer){
                    $id = $customer['id'];
                    $name_sei = $customer['name_sei'];
                    $name_mei = $customer['name_mei'];
                    $age = $customer['age'];
                    $create_datetime = $customer['create_datetime'];
                    
                    echo "<tr><td>$id</td><td>$name_sei</td><td>$name_mei</td><td>$age</td><td>$create_datetime</td></tr>";
                }
            ?>
        </table>
    </body>
</html>