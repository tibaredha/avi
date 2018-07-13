<?php
require '../../libs/config.php';
$cnx = mysql_connect(DB_HOST,DB_USER,DB_PASS)or die('I cannot connect to the database because: ' . mysql_error());
$db = mysql_select_db(DB_NAME);
mysql_query("SET NAMES 'UTF8' ");
if($_POST['id'])
{
$id=$_POST['id'];
$sql=mysql_query("select * from cim where c_chapi='$id'  ORDER BY diag_nom  asc");
while($row=mysql_fetch_array($sql))
{
echo '<option value="'.$row[0].'">'.$row[3].' ['.$row[2].'] _ ( id:'.$row[0].')</option>';
}
}
?>