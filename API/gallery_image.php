<?php 

include 'DeviceConnection.php';



$query="SELECT * FROM gallery_image";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $image[]=$row;

}

}
else
{
   $image[]="No image";
}




$output['image']=$image;





$pass=$output;


print_r(json_encode($pass));





?>