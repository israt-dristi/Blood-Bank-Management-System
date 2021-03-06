<?php
session_start();
include('include/conn.php');
if(strlen($_SESSION['alogin'])==0)
{
header('location:login.php');
}
else{
$message="";
if(isset($dbh)){
//connection check
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM doner WHERE id = :id";
    $statement = $dbh->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();
    $course = $statement->fetch(PDO::FETCH_ASSOC);
    extract($course);
}
include_once('include/header.php');
include_once('include/sidebar.php');
?>
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-edit"></i> Delete Doner</h1>
			<p>Delete a  Doner</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item">Doner</li>
			<li class="breadcrumb-item"><a href="#">Delete Doner</a></li>
		</ul>
	</div>
	<div class="row">
		
		<div class="col-md-6 m-auto">
			<div class="tile">
				<h3 class="tile-title">Delete Doner</h3>
				<div class="tile-body">
					<form action="action/update.php" method="post" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $id ?>">
						<div class="form-group row">
							<label class="control-label col-md-3" for="dname">Doner Title <span class="text-danger">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control"  placeholder="Doner name" id="dname" name="dname" value="<?php echo $dname ?>">
							</div>
						</div>
						
						</div>
						<div class="form-group row">
							<label class="control-label col-md-3" for="ddunation">Doner Dunation <span class="text-danger">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control"  placeholder="Doner Dunation" id="ddunation" name="ddunation" value="<?php echo $ddunation ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-md-3" for="ddescription">Doner Description <span class="text-danger">*</span></label>
							<div class="col-md-9">
								<textarea name="ddescription" id="ddescription" cols="30" rows="10" class="form-control"><?php echo $ddescription ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-md-3" for="dimage">Doner Image <span class="text-danger">*</span></label>
							<div class="col-md-9">
								<input type="file" class="form-control" id="dimage" name="dimage">
								<img src="assets/<?php echo $cimage ?>" alt="!" style="max-height: 100px;margin-top: 10px;">
								<input type="hidden" name="oldfile" value="<?php echo $cimage ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-md-3" for="is_active">Doner Status <span class="text-danger">*</span></label>
							<div class="col-md-9">
								<select name="is_active" id="is_active" class="form-control">
									<option value="0" <?php echo $is_active?'selected': ''?>>Deactive</option>
									<option value="1" <?php echo $is_active?'selected': ''?>>Active</option>
								</select>
							</div>
						</div>
					</div>
					<div class="tile-footer text-center">
						
						<button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Doner</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="viewdoner.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
						
					</div>
				</form>
			</div>
		</div>
		
	</div>
</main>
<?php
include_once('include/footer.php');
}
}
?>