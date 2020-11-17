<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

/*Establishing database connection*/
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);


$context= filter_input(INPUT_GET,"context",FILTER_SANITIZE_STRING);

/* Query for getting countries*/
if (!isset($context)){
  /* Query for getting countries*/
  $statement = $conn->prepare("SELECT * FROM countries WHERE name LIKE :condition");
  $statement->bindParam(":condition",$condition,PDO::PARAM_STR);
  $myquery = filter_input(INPUT_GET,"country",FILTER_SANITIZE_STRING);
  $condition = "%$myquery%";
  $statement->execute();
  $results = $statement->fetchAll(PDO::FETCH_ASSOC);
}
else{
  /*Query for getting citites*/
  $statement1 = $conn->prepare("SELECT cities.name, cities.district, cities.population 
                            FROM cities join countries on cities.country_code=countries.code 
                            WHERE countries.name= :myquery1");
  $statement1->bindParam(":myquery1",$myquery1,PDO::PARAM_STR);
  $myquery1 = filter_input(INPUT_GET,"country",FILTER_SANITIZE_STRING);
  $statement1->execute();
  $results1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
}

?>

<?php if(isset($context)):?>
  <table class="displaytable">
      <caption><h2>Table showing a list of Cities and corresponding information for a Country entered </h2></caption>
      <thead>
        <tr>
          <th class="th1">Name</th>
          <th class="th2">District</th>
          <th class="th3">Population</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($results1 as $city): ?>
          <tr>
            <td><?php echo $city['name']; ?></td>
            <td><?php echo $city['district']; ?></td>
            <td><?php echo $city['population']; ?></td>
          </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
<?php endif;?>
<?php if(!isset($context)):?>
  <table class="displaytable">
      <caption><h2>Table showing a list of Countries, the continent on which they are located, their date of independence and head of state</h2></caption>
      <thead>
        <tr>
          <th class="th1">Name</th>
          <th class="th2">Continent</th>
          <th class="th3">Independence</th>
          <th class="th4">Head Of State</th>
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
<?php endif;?>





<!--Query for countries table heading*/
/*$table_headdings = $conn->query("SELECT * FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='world' AND `TABLE_NAME`='countries' ");
$headings = $table_headdings->fetchAll(PDO::FETCH_ASSOC);
echo (var_dump($headings));*/-->