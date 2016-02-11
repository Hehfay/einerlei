<!DOCTYPE html>
<html>
<head>
<title>Read Question Table</title>
</head>
<body>
<h1>Read Question Table</h1>
<h2>List the rows of the Question table</h2>
<?php
$host = "";
$username = "imeisner";
$password = "imeisner";
$database = "imeisner";

$mysqli = new mysqli( $host, $username, $password, $database);

if( mysqli_connect_errno())
{
  echo "Error connecting: ".mysqli_connect_errno();
}
else
{
  //do stuff with the mysqli connection
  $query = "select * from Question;";

  $result = $mysqli->query($query);

  if( $result)
  {
    //do something
    $num_rows = $result->num_rows;
    $num_cols = $result->field_count;

    echo "<p>";
    echo "num rows: ".$num_rows;
    echo "</p>";
    echo "<p>";
    echo "num cols: ".$num_cols;
    echo "</p>";

    $fields = $result->fetch_fields();

    echo "<table border='1' cellpadding='4'>";

    echo"<tr>";
    for( $i=0; $i<$num_cols; $i++)
    {
      echo "<th>";
      echo $fields[$i]->name;
      echo "</th>"; 
    }
    echo "</tr>";

    while( $row=$result->fetch_row())
    {
      echo "<tr>";
      for($i=0; $i<$num_cols; $i++)
      {
        echo "<td>";
        echo $row[$i];
        echo "</td>";
      }
      echo "</tr>";
    }
    echo "</table>"; 
  }
  else
  {
    echo "Query Error: ".$mysqli->error;
  }
  $mysqli->close();
}
?>
</body>
</html>
