<div class="row">
	<h1 class="page-header"><?php echo $_GET['dept'].' - sem ' . $_GET['sem']; ?></h1>
</div>
<div class="row">
    <button type="button" data-toggle="modal" data-target="#myModal">View Course Details</button>
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h5 class="modal-title">Course List</h6>
        </div>
        <div class="modal-body">
            <table id="Course" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <tr>
                    <th>Course Code</th>
                    <th>Credits</th>
                    <th>Course Name</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include '../functions.php';
                    $db = new DB;
                    $dept = $_GET['dept'];
                    $semno = $_GET['sem'];
                    $table_name = "CourseList";
                    $query_course = $db->get($table_name, "`Sem` = ".$semno." AND `Dept` = '".$dept."'");
                    while($rows = mysql_fetch_array($query_course)) {
                ?>
                    <tr>
                    <td><?php echo $rows['CourseCode']; ?></td>
                    <td><?php echo $rows['Credits']; ?></td>
                    <td><?php echo $rows['CourseName']; ?></td>
                    </tr>
                <?php
                    }


                ?>
                </tbody>
            </table>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<br>

<div id="new">

</div>

<script>

<?php
	$table_name = 'sem' . $semno . $dept;
	$query1 = $db->get($table_name, 'gpa <> 0');
?>
var dataSet = [];

<?php
while($row=mysql_fetch_array($query1)) {
?>
var temp = [];
<?php
$query = $db->cols($table_name);
while($col = mysql_fetch_array($query)) {
	if($col['Field']!='Name'&&$col['Field']!='cgpa')
	{
?>
temp.push('<?php echo $row[$col['Field']];?>');
<?php
}}
?>

dataSet.push(temp);
<?php
}
?>
$(document).ready(function(){
	$('#new').html('<table id="new1" class="table table-striped table-bordered table-hover"></table>');
	$('#new1').dataTable( {
        "data": dataSet,
        "dom": 'C<"clear">lfrtip',
        "columns": [
        <?php
        	$query = $db->cols($table_name);
        	while($col=mysql_fetch_array($query)){
        		if($col['Field']!='Name'&&$col['Field']!='cgpa')
	{
        ?>
        	{ "title": "<?php echo $col['Field'];?>" },
        <?php
        	}
        }
        ?>

        ]
    });
});
</script>