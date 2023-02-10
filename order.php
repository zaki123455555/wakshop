
<?php

    session_start();
   $con1 = mysqli_connect('localhost', 'root', 'root1234', 'wakshop');
   if(isset($_POST['submit']))
   {
    
    $m1=$_POST['name'];
    $m2=$_POST['Email'];
    $m3=$_POST['phonenumber'];
    $m4=$_POST['loc'];
   
    $QUERY="INSERT INTO orderdetails(Cname ,Email ,Phonenumber,Location12)VALUES('$m1','$m2','$m3','$m4')";
    
    if(mysqli_query($con1,$QUERY)){
       
       

            echo "order accepted thanks for shopping with wak";
    }
    else {
        echo "failed";
    }
   }
   

    ?>
    