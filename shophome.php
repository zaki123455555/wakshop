<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root1234","wakshop");
if(isset($_POST["add"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
          $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
          if(!in_array($_GET["id"], $item_array_id)){
             $count = count($_SESSION["shopping_cart"]);
             $item_array = array(
                'item_id'  => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'item_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
          }
          else{
            echo '<script>alert("item already added")</script>';
          }
        }  
    else{
        $item_array = array(
            'item_id'  => $_GET["id"],
            'item_name' => $_POST["hidden_name"],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"],
            'now'=>$_POST["_template"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}


?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <title>shopping wak page</title>
        <link rel="stylesheet" type="text/css" href="wakstylehm9" />
        <link href="all.css" rel="stylesheet" />
        <script src="js1.js" type="text/javascript"></script>
        
       
    
    </head>
    <body>
      <div class="head1"><h2>WAK ONLINE SHOP</h2></div>
      <div class="head3">
        <a href="home1.php"><img src="homeicon.jpg" alt="" width="45px" height="45px" class="h3"></a></div>
        <?php
        $query = "SELECT * FROM shop ORDER BY shopid ASC";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result)>0) {
            while ($row = mysqli_fetch_array($result)) {
        ?>
       <div class="container">
        <form class="form-container" action="shophome.php" method="POST" ><br/><br/>
   

          <input type="hidden" name="_captcha" value="false">
    <input type="hidden" name="_template" value="table">
   
    
     <div class="solar"><h1><?php echo $row["name"]; ?></h1></div>
     <div class="ct"> <img src="./shopping_cart/<?php echo $row["image"]; ?> " width="500px" height="500px" id="productpic" name="img"></div>
      <br/><br/>
      <input type="hidden" id="productname" name="product_name" value="<?php echo $row["name"]; ?>" /><br>

      <br>
     <br><br><br>
      <div class="product-info">
      <div class="tt"></div><br>   
        <div class="product-price"><br/>
   <div class="t1"> <h4>ugx <?php echo $row["price"]; ?></h4></div>
        <input type="hidden"  class="new" id="productprice" name="product_price" value="<?php echo $row["price"]; ?>" /></div>
        
       
        <div class="t3"><button class="product-button" onclick="openForm()">BUY</button></div>
        
       <div class="logout"><a href="login.php"><img src="logouticon.jpg" alt="" width="50px" height="50px" class="h4" ></a></div>
      </div>
    </div>
            </div>
 
   

<div class="form-popup" id="myForm" >
<?php

    
   $con1 = mysqli_connect('localhost', 'root', 'root1234', 'wakshop');
   if(isset($_POST['submit']))
   {
    
    $m1=$_POST['name'];
    $m2=$_POST['Email'];
    $m3=$_POST['phonenumber'];
    $m4=$_POST['loc'];
   
    $QUERY="INSERT INTO orderdetails(Cname ,Email ,Phonenumber,Location12)VALUES('$m1','$m2','$m3','$m4')";
    if(mysqli_query($con1,$QUERY)){



            echo "thanks for shopping with us";
}
else {
  echo "failed";
}
    
    
   }
   

    ?>
    
    <h1>Contact Details</h1>

    <label for="name"><b>name</b></label><br/>
    <input type="text" placeholder="enter your full names hear" id="clientname" name="name" required><br/>
    <label for="Email"><b>Email</b></label><br/>
    <input type="email" placeholder="enter your email address here" id="clientemail" name="Email" id="Email" required><br/>

    <label for="phonenumber"><b>Phone Number</b></label>
    <input type="text" placeholder="Enter phone number" id="clientphonenumber" name="phonenumber" required><br/>
    <label for="loc"><b>Location</b></label>
    <input type="text" placeholder="please enter location" id="clientlocation" name="location" required><br/>
   

    <button type="submit"  value="submit" onclick="message1()" id="btn" class="btn">BUY</button>
    <button type="button" class="btn cancel" onclick="closeForm()" >Cancel Product</button>

  </form>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

</script>

 </div>
</form>
<?php
            }
        }
?>

    <?php

    ?>


    </body>
    <script src="https://smtpjs.com/v3/smtp.js">
</script>


<script>
var btn = document.getelemgetElementById('btn');
btn.addaddEventListener('click', function(e)){
          e.preventDefault()
          var pp = document.getElementById('productpic').value;
          var pn  = document.getElementById('productname').value;
          var pprice = document.getElementById('productprice').value;
          var cn = document.getElementById('clientname').value;
          var ce = document.getElementById('clientemail').value;
          var cp = document.getElementById('clientphonenumber').value;
          var cl = document.getElementById('clientlocation').value;
          var body = 'pp: '+pp + '<br/> pn: '+pn + '<br/> pprice: '+pprice + '<br/> cn: '+cn + '<br/> ce: '+ce + '<br/> cp: '+cp + '<br/> cl: '+cl ;
          Email.send({
    Host : "smtp.gmail.com",
    Username : "isaacetyono@gmail.com",
    Password : "gmocncixlkgphjtj",
    To : 'isaacetyono@gmail.com',
    From : ce,
    Subject : "NEW ORDER DETAILS",
    Body : body
}).then(
  message => alert(message)
);
}

</script>
</html>