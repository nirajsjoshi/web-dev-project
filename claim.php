<?php
$room = $_POST['room'];

if(strlen($room)>20 or strlen($room)<2)
{
	$message = "Please choose a name between 2 to 20 characters";
	echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';
    echo '</script>';
}
else if(!ctype_alnum($room))
{
	$message = "Please choose a alphanumeric room name";
	echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';
    echo '</script>';
}

else
{   
	include 'db_connect.php';
}
  //checking whether the room is already existing in db
$sql = "SELECT * FROM `rooms` WHERE roomname = '$room'";
$result = mysqli_query($con, $sql);
if($result)
{
	if(mysqli_num_rows($result)>0)
	{
		$message = "Please choose a different roomname";
	echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';
    echo '</script>';
	}
	else
	{
		$sql = "INSERT INTO `rooms` ( `roomname`, `ctime`) VALUES ( '$room', current_timestamp()); ";
		if (mysqli_query($con,$sql))//give msg to user that the room is ready
		{
            	$message = "Your room is ready";
	echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom/rooms.php?roomname='.$room.'";';//we will send the user to his room
    echo '</script>';
		}
	}

}
else
{
	echo "error: ".mysqli_error($con);
}

?>