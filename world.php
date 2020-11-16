<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

/* Query for getting countries*/
$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :condition");
$stmt->bindParam(":condition",$condition,PDO::PARAM_STR);
$myquery = filter_input(INPUT_GET,"country",FILTER_SANITIZE_STRING);
$condition = "%$myquery%";
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


/* Query for countries table heading*/
/*$table_headdings = $conn->query("SELECT * FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='world' AND `TABLE_NAME`='countries' ");

$headings = $table_headdings->fetchAll(PDO::FETCH_ASSOC);
echo (var_dump($headings));*/
?>

<style>
  #table1 th {padding-top: 12px;padding-bottom: 12px;text-align: left;background-color:#a79344 ;color: white;}
  #table1{border-collapse: collapse;width: 100%;}
  #table1 td, #table1 th {border: 1px solid rgb(202, 201, 201);padding: 10px;}
  #table1 tr:nth-child(even){background-color: #d6d4d4;}
</style>

<table id="table1">
    <caption><h2>Table showing a list of Countries, the continent on which they are located, their date of independence and head of state</h2></caption>
    <thead>
      <tr>
        <th>Name</th>
        <th>Continent</th>
        <th>Independence</th>
        <th>Head Of State</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($results as $country): ?>
        <tr>
          <td><?php echo $country['name']; ?></td>
          <td><?php echo $country['continent']; ?></td>
          <td><?php echo $country['independence_year']; ?></td>
          <td><?php echo $country['head_of_state'];?>
        </tr>
      <?php endforeach; ?>
  </tbody>
</table>