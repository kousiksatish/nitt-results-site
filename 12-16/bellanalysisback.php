<?php
	include '../functions.php';
	$db = new DB;
	// if($_GET['sem']!=2)
	// 	header("location:error.php");
	$semno = $_GET['sem'];
	$dept = $_GET['dept'];
	$table = 'CourseList3y';
?>
<div class="row">
	<h1 class="page-header"><?php echo $_GET['dept'].' - sem ' . $_GET['sem']; ?></h1>
</div>
<?php
	$query1 = $db->get($table, "Sem=$semno AND Dept = '$dept'");
	while($res = mysql_fetch_array($query1))
	{
?>
<div class="row">
	<?php echo $res['CourseCode'] . ' - ' . $res['CourseName']; if($res['Nature'] == 'elec') echo ' (Elective)';?>
</div>
<div id="chart<?php echo $res['CourseCode'];?>" style="height: 250px;"></div>
<hr>
<?php
}
?>



<script>
$(function() {
<?php
$query1 = $db->get($table, "Sem=$semno AND Dept = '$dept'");
while($res = mysql_fetch_array($query1))
{
	$CC = $res['CourseCode'];
	$CCCount = 'count('.$CC.')';
?>
Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'chart<?php echo $res['CourseCode']?>',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
<?php


	$table_name = '3ysem'.$semno.$dept;
	$db = new DB;

	$query = $db->grpcnt($table_name, $CC);
	while($rows = mysql_fetch_array($query))
	{
?>
	{gpa : <?php echo $rows["$CC"];?>, value: <?php echo $rows['cnt'];?> },
<?php
	}
?>
  ],

  xkey: ['gpa'],

  ykeys: ['value'],

  labels: ['No of students'],
  parseTime: false
});
<?php
}
?>
});
</script>