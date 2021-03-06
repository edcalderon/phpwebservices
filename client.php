<?php
require 'lib/nusoap.php';

$client = new nusoap_client("http://localhost/phpwebservices/service.php?wsdl"); // Create a instance for nusoap client

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SOAP Web Service Client Side Demo for a TTS call</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>SOAP Web Service Client Side Demo for a TTS call</h2>
  <form class="form-inline" action="" method="POST">
    <div class="form-group">
      <label for="name">Extention:</label>
      <input type="text" name="ext" class="form-control"  placeholder="Enter Extension number" />
    </div>
    <div class="form-group">
      <label for="msg">Message:</label>
      <input type="text" name="msg" class="form-control"  placeholder="Enter Message" />
    </div>
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
  </form>
  <p>&nbsp;</p>
  <h3>
  <?php
	if(isset($_POST['submit']))
	{
		$ext = $_POST['ext'];
    $msg = $_POST['msg'];
    

		$response = $client->call('make_call',array("ext"=>$ext,"msg"=>$msg));

		if(empty($response))
			echo "Call not available";
		else
			echo $response . "to the extension: " . $ext . " whit the message: " . $msg;
	}
   ?>
  </h3>
	
   <h4>Please wait almost 30 seconds between calls, it work with tears, thanks.</h4>
   <div id='seconds-counter'> </div>

  <script>
    var seconds = 0;
    var el = document.getElementById('seconds-counter');
    function incrementSeconds() {
      seconds += 1;
      el.innerText = "You have been here for " + seconds + " seconds.";
    }
    var cancel = setInterval(incrementSeconds, 1000);
  </script>


	
	
	
</div>
</body>
</html>
