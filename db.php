<html>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT *from fare";
$result = $conn->query($sql);
$thearray=array();
$id1=0;
$id2=0;
while($row = $result->fetch_assoc()){
	if($row['Pickup']==$_POST["Pickup"]){
		$id1=$row['id'];
	}
	if($row['Pickup']==$_POST["drop"]){
		$id2=$row['id'];
	}
	$row= array_values($row);
    array_push($thearray,$row);
}
$thearray= array_values($thearray);
$ka=$thearray;
for($k=0;$k<9;$k++){
	for($i=0;$i<9;$i++){
		for($j=2;$j<11;$j++){
			$thearray[$i][$j]=min($thearray[$i][$j],$thearray[$i][$k+2]+$thearray[$k][$j]);
		}
	}
}
$kb=array();
$kc=array();
if($ka[$id1-1][$id2+1]==$thearray[$id1-1][$id2+1]){
	echo"direct";
}
else{
	
	$min=$thearray[$id1-1][$id2+1];
	$max=0;
	$pic=0;
	
		for($j=0;$j<9;$j++){
			if($thearray[$j][$id2+1]<$min&&$thearray[$j][$id2+1]>$max&&$thearray[$id1-1][$id2+1]==$thearray[$j][$id2+1]+$thearray[$id1-1][$j+2]){
				if(!array_search($thearray[$j][$id2+1],$kc)){
				array_push($kb,$thearray[$j][1]);
			array_push($kc,$thearray[$j][$id2+1]);
			}
		}
	
}}
for($i=0;$i<sizeof($kb);$i++){
	echo $kb[$i];
}
echo $thearray[$id1-1][$id2+1];
$conn->close();
?>
</body>
</html>