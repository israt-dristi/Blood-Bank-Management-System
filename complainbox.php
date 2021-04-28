<?php
require('include/conn.php');

if($_SERVER['REQUEST_METHOD']=="POST")
{
	$c=$_POST['msg'];

	
	//$SELECT="SELECT * from complain";
	$stmt = $dbh->prepare("insert into complain (complain) VALUES (:msg)");
	$stmt->bindParam(':msg', $c);
    
    $stmt->execute();
    
 
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form name="ajax" onsubmit="submitForm(event)">
		<level>complain</level>
		<input type="text"id="msg"name="msg">
		<br>
		
		<input type="submit" value="submit">
	</form>
	<p id="tag"></p>

	<script>
          function submitForm(e)
          {
          	console.log(e);
			e.preventDefault();
			console.log("form submitted");

			var msg = document.forms["ajax"]["msg"].value;

			if(msg == "") 
			{
				document.getElementById("tag").innerHTML = "<b>Please fill up the copplain properly.</b>";
				document.getElementById("tag").style.color = "red";

			}

			else {

				var xhttp = new XMLHttpRequest();
	            xhttp.onreadystatechange = function() {
	              if(this.readyState == 4 && this.status == 200) {
	                document.getElementById("tag").innerHTML = "<b>Complain sent Successfully</b>";
	                document.getElementById("tag").style.color = "green";

	              }
	            }

	            xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>", true);
	            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	            xhttp.send("msg="+msg);

				
			}
		}

    </script>





</body>
</html>