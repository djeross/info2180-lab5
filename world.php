<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :condition");
$stmt->bindParam(":condition",$condition,PDO::PARAM_STR);

$myquery=filter_input(INPUT_GET,"country",FILTER_SANITIZE_STRING);
$condition="%$myquery%";
$stmt->execute();
$results =$stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
