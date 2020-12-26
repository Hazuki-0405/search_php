<?php 
    $database = new PDO('mysql:host=localhost;dbname=shopdatabase;charset=UTF8;', 'root', '');
    
    $search_id = $_GET['s_id'];
    $search_id =  htmlspecialchars($search_id, ENT_QUOTES, 'UTF-8');
    $search_name_sei = $_GET['s_name_sei'];
    $search_name_sei =  htmlspecialchars($search_name_sei, ENT_QUOTES, 'UTF-8');
    $search_name_mei = $_GET['s_name_mei'];
    $search_name_mei =  htmlspecialchars($search_name_mei, ENT_QUOTES, 'UTF-8');
    $search_age = $_GET['s_age'];
    $search_age =  htmlspecialchars($search_age, ENT_QUOTES, 'UTF-8');
    
    $edit_name_sei = $_POST['name_sei'];
    $edit_name_sei =  htmlspecialchars($edit_name_sei, ENT_QUOTES, 'UTF-8');
    $edit_name_mei = $_POST['name_mei'];
    $edit_name_mei =  htmlspecialchars($edit_name_mei, ENT_QUOTES, 'UTF-8');
    $edit_age = $_POST['age'];
    $edit_age =  htmlspecialchars($edit_age, ENT_QUOTES, 'UTF-8');
    $edit_datetime = $_POST['datetime'];
    $edit_datetime =  htmlspecialchars($edit_datetime, ENT_QUOTES, 'UTF-8');
    
    
    // 検索条件
    $search_sql = " where 1 ";
    if($search_id){
        $search_sql .= "and id=:search_id ";
    }
    if($search_name_sei){
        $search_sql .= "and name_sei=:search_name_sei ";
    }
    if($search_name_mei){
        $search_sql .= "and name_mei=:search_name_mei ";
    }
    if($search_age){
        $search_sql .= "and age=:search_age ";
    }
    
    // 新しい値
    $sql = "UPDATE customer SET ";
    if($edit_id){
        $sql .= "id=:id, ";
    }
    if($edit_name_sei){
        $sql .= "name_sei=:name_sei, ";
    }
    if($edit_name_mei){
        $sql .= "name_mei=:name_mei, ";
    }
    if($edit_age){
        $sql .= "age=:age, ";
    }
    
    $sql .= $search_sql;
    $statement = $database->prepare($sql);
    var_dump($sql);
    
    // 検索の値をバインド
    if($search_id){
        $statement->bindParam(':search_id', $search_id);
    }
    if($search_name_sei){
        $statement->bindParam(':search_name_sei', $search_name_sei);
    }
    if($search_name_mei){
        $statement->bindParam(':search_name_mei', $search_name_mei);
    }
    if($search_age){
        $statement->bindParam(':search_age', $search_age);
    }
    
    // 修正の値をバインド
    if($search_name_sei){
        $statement->bindParam(':name_sei', $search_name_sei);
    }
    if($search_name_mei){
        $statement->bindParam(':name_mei', $search_name_mei);
    }
    if($search_age){
        $statement->bindParam(':age', $search_age);
    }
    if($search_datetime){
        $statement->bindParam(':datetime', $search_age);
    }
    
    // SQL実行（更新）
    $statement->execute();
    
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
        <h1>顧客情報　編集ページ</h1>
        <form method="post">
            <h2>検索条件</h2>
            <p>id<input type="text" name="s_id"/></p>
            <p>
                姓<input type="text" name="s_name_sei"/>
                名<input type="text" name="s_name_mei"/>
            </p>
            <p>
                年齢<input type="text" name="s_age"/>
            </p>
            <h2>新しい値</h2>
            <p>
                姓<input type="text" name="name_sei"/>
                名<input type="text" name="name_mei"/>
            </p>
            <p>
                年齢<input type="text" name="age"/>
                作成日時<input type="text" name="datetime"/>
            </p>
            <input type="submit" value="修正内容登録"/>
        </form>
        <?php 
            $q = "yanagi";
            $y = "da";
            echo $q . $y;
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