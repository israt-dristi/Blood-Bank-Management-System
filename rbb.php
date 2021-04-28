<?php
	//sleep(3);
    require_once('sql.php');
	$name = $_REQUEST['name'];

	$con = mysqli_connect('localhost', 'root', '', 'b_bms');
	$sql = "select * from users where name like '%{$name}%'";
	$result = mysqli_query($con, $sql);

	$response = "<table border=1>
					<tr>

						<td>Name</td>
					
						<td>Email</td>

						<td> Mobile </td> 
					
				
					</tr>";

	while ($row = mysqli_fetch_assoc($result)) {
		$response .= 	"<tr>
							
							
							<td>{$row['name']}</td>
							<td>{$row['email']}</td>
							<td>{$row['mobile']}</td>
								
						
						</tr>";
	}

	$response .= "</table>";

	echo $response;

?>