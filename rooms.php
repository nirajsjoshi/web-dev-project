<?php

$roomname = $_GET['roomname'];

include 'db_connect.php';


//check whether the room exist
$sql = "SELECT * FROM `rooms` where roomname = '$roomname'";

$result = mysqli_query($con,$sql);
if($result)
{
   if(mysqli_num_rows($result)==0)//if no such row is present
   {
     	$message = "This room does not exist";
	echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';//direct it to home page
    echo '</script>';
   }
}

else
{
	echo "Error :" .mysqli_error($con);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <!-- Custom styles for this template -->
    <link href="css/product.css" rel="stylesheet">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyclass {
  height : 350px;
  overflow-y: scroll; /*scrollable div class*/
}
</style>
</head>
<body>

 <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
     
        <span class="fs-4">Connect.com</span>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="#">Home</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="#">About us</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="#">Contact</a>
        
      </nav>
    </div>
<h2>Chat Messages -<?php echo $roomname; ?></h2>

<div class="container">
  <div class="anyclass">
 
  </div>
</div>



<input type="text" class ="form-control" name="usermsg"  id = "usermsg" placeholder = "Type your message"><br>
<button class="btn btn-default" name ="submitmsg" id="submitmsg">Send</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>


<script type="text/javascript">


  setInterval(runFunction,1000);
function runFunction()
{
  $.post("htcont.php", {room:'<?php echo $roomname ?>'},
        function(data,status)
        {
          document.getElementsByClassName('anyclass')[0].innerHTML = data;
        }

    )
}

  var input = document.getElementById("usermsg");
input.addEventListener("keyup", function(event) {
   if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("submitmsg").click();
  }
});
  
  $("#submitmsg").click(function(){     
  var clientmsg = $("#usermsg").val();         
  $.post("postmsg.php", {text: clientmsg, room:'<?php echo $roomname ?>',ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
  function(data,status)
  {
    document.getElementsByClassName('anyclass')[0].innerHTML = data;});
   $("#usermsg").val("");
    return false;
  

});




</script>

</body>
</html>

