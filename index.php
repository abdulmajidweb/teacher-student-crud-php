<?php
	spl_autoload_register(function($class){
		include 'classes/'.$class.'.php';
	});
?>
<?php
	$user = new Student();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Result Sheet</title>
	<!--bootstrap css-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="container alert alert-success">
	<div class="row">
		<div class="col-sm col-12">
			<span class="h4">Student Database</span>
		</div>
		<div class="col-sm col-12 text-right">
			<span class="h4"><a href="index.php">For Student</a></span><span class="h4"> || </span>
			<span class="h4"><a href="teacher.php">For Teacher</a></span>
		</div>


		<div class="col-12"><hr/></div>

		<div class="col">

<?php
	if (isset($_POST['create'])) {
		$name = $_POST['name'];
		$dep  = $_POST['dep'];
		$age  = $_POST['age'];

		$user->setName($name);
		$user->setDep($dep);
		$user->setAge($age);
		
		if($user->insert()){
			echo "<span class='text-success'>Data inserted successfully...</span>";
		}
	}

?>

<?php
	if (isset($_POST['update'])) {
		$name = $_POST['name'];
		$dep  = $_POST['dep'];
		$age  = $_POST['age'];
		$id  = $_POST['id'];

		$user->setName($name);
		$user->setDep($dep);
		$user->setAge($age);
		
		if($user->update($id)){
			echo "<span class='text-success'>Data updated successfully...</span>";
		}
	}

?>

<?php
//delete data
	if(isset($_GET['action']) && $_GET['action'] == 'delete'){

		$id = (int)$_GET['id'];
		if ($user->delete($id)) {
			echo "<span class='text-success'>Data deleted successfully...</span>";
		}
	}
?>


<?php
	if(isset($_GET['action']) && $_GET['action'] == 'update'){

		$id = (int)$_GET['id'];
		$result = $user->readById($id);
?>
<!--update data-->
<form action="" method="post">
	<input type="hidden" name="id" value="<?php echo $result['id'];?>" class="form-control">
				<table>
					<tr>
						<td>Name:</td>
						<td><input type="text" name="name" value="<?php echo $result['name'];?>" class="form-control"></td>
					</tr>
					<tr>
						<td>Department:</td>
						<td><input type="text" name="dep" value="<?php echo $result['dep'];?>" class="form-control"></td>
					</tr>
					<tr>
						<td>Age:</td>
						<td><input type="number" name="age" value="<?php echo $result['age'];?>" class="form-control"></td>
					</tr>
					<tr>
						<td></td>
						<td><button type="submit" name="update" class="btn btn-primary">Update</button></td>
					</tr>
				</table>
				
			</form>

<?php } else{ ?>


				<form action="" method="post">
				<table>
					<tr>
						<td>Name:</td>
						<td><input type="text" name="name" placeholder="Your Name" class="form-control" required="1"></td>
					</tr>
					<tr>
						<td>Department:</td>
						<td><input type="text" name="dep" placeholder="Your Department" class="form-control" required="1"></td>
					</tr>
					<tr>
						<td>Age:</td>
						<td><input type="number" name="age" placeholder="Your Age" class="form-control" required="1"></td>
					</tr>
					<tr>
						<td></td>
						<td><button type="submit" name="create" class="btn btn-primary">Create</button></td>
					</tr>
				</table>
				
			</form>

<?php } ?>



		</div>
		<div class="col">
			<table class="table table-bordered table-danger">
				<thead>
					<tr>
						<td>No</td>
						<td>Name</td>
						<td>Department</td>
						<td>Age</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 0;
						foreach ($user->readAll() as $key => $value) {
							$i++;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $value['name']; ?></td>
						<td><?php echo $value['dep']; ?></td>
						<td><?php echo $value['age']; ?></td>
						<td>

<?php echo "<a href='index.php?action=update&id=".$value['id']."'>Edit</a>";?> || 

<?php echo "<a href='index.php?action=delete&id=".$value['id']."' onClick='return confirm(\"Are you sure to delete data?...\")'>delete</a>";?>

						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>


	</div>
</div>

<!--bootstrap js-->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
</body>
</html>