<?php 
    $database = new PDO('mysql:host=localhost;dbname=shopdatabase;charset=UTF8;', 'root', '');
    
    $search_id = $_GET['id'];
    $search_id =  htmlspecialchars($search_id, ENT_QUOTES, 'UTF-8');
    $search_name_sei = $_GET['name_sei'];
    $search_name_sei =  htmlspecialchars($search_name_sei, ENT_QUOTES, 'UTF-8');
    $search_name_mei = $_GET['name_mei'];
    $search_name_mei =  htmlspecialchars($search_name_mei, ENT_QUOTES, 'UTF-8');
    $search_age = $_GET['age'];
    $search_age =  htmlspecialchars($search_age, ENT_QUOTES, 'UTF-8');
    
    $sql = "SELECT * FROM customer where 1 ";
    // 検索条件が入っているか
    if($search_id){
        $sql.= "and id=:id ";
    }
    if($search_name_sei){
        $sql.= "and name_sei=:name_sei ";
    }
    if($search_name_mei){
        $sql.= "and name_mei=:name_mei ";
    }
    if($search_age){
        $sql.= "and age=:age ";
    }
    $statement = $database->prepare($sql);
    
    // 入ってたら値をバインドする
    if($search_id){
        $statement->bindParam(':id', $search_id);
    }
    if($search_name_sei){
        $statement->bindParam(':name_sei', $search_name_sei);
    }
    if($search_name_mei){
        $statement->bindParam(':name_mei', $search_name_mei);
    }
    if($search_age){
        $statement->bindParam(':age', $search_age);
    }
    $statement->execute();
    $customers = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>顧客情報</h1>
        <form method="get">
            <p>id<input type="text" name="id"/></p>
            <p>
                姓<input type="text" name="name_sei"/>
                名<input type="text" name="name_mei"/>
            </p>
            <p>
                年齢<input type="text" name="age"/>
            </p>
            <input type="submit" value="検索"/>
        </form>
        
        <table>
            <tr><th>id</th><th>姓</th><th>名</th><th>年齢</th><th>作成日時</th></tr>
            <?php 
                if($search_id || $search_name_sei || $search_name_mei || $search_age){
                    foreach($customers as $customer){
                        $id = $customer['id'];
                        $name_sei = $customer['name_sei'];
                        $name_mei = $customer['name_mei'];
                        $age = $customer['age'];
                        $create_datetime = $customer['create_datetime'];
                        
                        echo "<tr><td>$id</td><td>$name_sei</td><td>$name_mei</td><td>$age</td><td>$create_datetime</td></tr>";
                    }
                }
            ?>
        </table>
    </body>
</html>