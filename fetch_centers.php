<?php
include_once("includes/dbconn.php");




$selectedRegion = $_POST['region'];


$query = "SELECT * FROM centers WHERE region = '$selectedRegion'";
$result = mysqli_query($conn, $query);


$options = '<option value="الرجاء اختيار اسم المركز" disabled selected>الرجاء اختيار اسم المركز</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $options .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
}


echo $options;

echo "<script> window.location.href='signup.php';</script>";
?>
