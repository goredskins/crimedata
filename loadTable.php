<?php
include("connect.php");
$certain_cols = false;
if(isset($_POST['certain_cols'])) {
	$certain_cols = true;
}
$table = $_POST['table_name'];
$res = $mysqli->query("SELECT * FROM $table LIMIT 1");
?>
<table class="table table-hover table-bordered table-striped" id="the_table">
<?php
print("<tr>");
$column_count = 0;
$actual_field_names = array();
while ($property = mysqli_fetch_field($res)) {
    $field_name = $property->name;
    if($certain_cols) {
        if(!in_array($column_num, $colNums)) {
            continue;
        }
    }
    $actual_field_names[] = $field_name;
    if(isset($column_naming[$field_name])) {
        $field_name = $column_naming[$field_name];
    }
    print("<th>$field_name</th>");
    $column_count++;
}
print("</tr>\n");
$query_string = "SELECT * FROM $table LIMIT 10";
if($table == "crimes") {
    $query_string = "SELECT * FROM $table ORDER BY date_time DESC LIMIT 10";
}
$res = $mysqli->query($query_string);
$res->data_seek(0);
while ($row = $res->fetch_assoc()) {
	echo "<tr>";
    foreach($actual_field_names as $key => $value) {
    	echo "<td>" . $row[$value] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>