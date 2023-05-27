
<?php
$sname= "localhost";
$unmae= "root";
$password= "";
    $telephone = $_POST['telephone'];
    $cakeType = $_POST['pizzaType'];
    $topping = $_POST['topping'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];

    $toppingPrice = 0;
    for ($i=0; $i< count($topping); $i++) {
        $toppingPrice += $topping[$i];
    }
$price = ($pizzaType * $size + $toppingPrice) * $quantity;

$db_name = "test_db";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}
    ?>
<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="utf-8">
        <meta name="viewpoint" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        
        <title>Cris Cakes| Every bite a piece of heaven</title>
    </head>
    <body>
        <script type="text/javascript" src="file.js"></script>
        <div class="menu">
        <img src="logo.png" id="logo">
        </div>
        <div id="myNav" class="overlay">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="overlay-content">
                <a href="main.php">Home</a>
                <a href="about.php">About</a>
                <a href="services.php">Services</a>
                <a href="contact.php">Contact</a>
            </div>
        </div>
        <div class="menu">
            <span style="font-size:35px;float:left;cursor:pointer; margin-top:-17px;" onclick="openNav()">&#9776;</span>
        <h2 id="slogan1">CRIS CAKES</h2>
            <p id="user"><?php echo "Hello"." ".$_SESSION['name'];}else{ header("Location: index.php"); exit();}?></p>
            <div class="userImg">
                <a href="index.php"><img src="account.png"></a>
                <a href="logout.php" id="logout">Logout</a>
            </div>
        <br>
            <h6 id="slogan2">Every bite tastes like heaven</h6>
        </div>
        <div class="line"></div>
        <div class="page">
            <h2>ORDER</h2>
        </div>
        <br>
        <?php
        $name = $_POST['name'];
            $crust = $_POST['crust'];
            $topping = $_POST['topping'];
        $telephone = $_POST['telephone'];
    $cakeType = $_POST['pizzaType'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];
        if(isset($name)){
        $sql = "INSERT INTO `order`(`name`, 'telephone', 'cakeType `crust`, `topping`, 'size', 'quantity') VALUES ('$name','$crust', '$topping')";
        mysqli_query($conn, $sql);
        }
        ?>
        <?php
        mysqli_select_db($conn, $db_name);
        $database_query = "SELECT * FROM `order`";
         $query_result = mysqli_query($conn, $database_query);
        echo "<table style='border-collapse: collapse;border-spacing: 0;border: 1px solid #eaccae;float: left; margin: 5px 5px 5px 5px;'>";
        echo "<tr style='background-color: #f2f2f2;'><td style='padding:16px;'><b>ID</b></td><td></td><td style='padding:16px;'><b>Name</b></td><td></td><td style='padding:16px;'><b>Crust</b></td><td></td><td style='padding:16px;';><b>Topping</b></td><td></td><td style='padding:16px;'><b>Product</b></td></tr>";
        while($line = mysqli_fetch_array($query_result)){
            echo "<tr style='background-color: #ffffff;border: 1px solid grey'><td style='text-align:center; padding:16px;'>" . $line["id"] . "</td><td></td><td style='text-align:center; padding:16px;'>" . $line["name"] . "</td><td></td><td style='text-align:center; padding:16px;' id='cake'>" . $line["crust"] . "</td><td></td><td style='text-align:center; padding:16px;' id='topp'>" . $line["topping"] . "</td><td></td><td style='text-align:center; padding:16px;'><button id='product' style='height: 30px;border: 1px solid ;background:  #e0b385; border-radius: 15px; font-size: 16px; color: #e9f4fb; font-weight: 500; cursor: pointer; outline: none;'>Product</button></td></tr>"; 
        }
        echo "</table>";
        mysqli_close($conn);
        ?>
        <div id="displayCake"></div>
        <div id="displayText"></div>
        <div id="pay" style="color: #ffffff; background-color:#e0b385; margin-right: 250px; border-radius: 7px; text-align: center; margin: 5px 1400px 2px 10px;">Pay</div>
        <div class="footer-basic">
        <footer>
            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="main.php">Home</a></li>
                <li class="list-inline-item"><a href="about.php">About</a></li>
                <li class="list-inline-item"><a href="services.php">Services</a></li>
                <li class="list-inline-item"><a href="contact.php">Contact</a></li>
            </ul>
            <p class="copyright">Cris Cakes © 2022</p>
            </footer>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
        <script>
            let displayCake = document.getElementById("displayCake");
            let displayText = document.getElementById("displayText");
            let submit = document.getElementById("product");
            let cake = document.getElementById("cake");
            let topp = document.getElementById("topp");
            
            function show_image(src){
                let img = "<img src='" + src + "' style='position:absolute; float:left; width: 400px; height: 300px; border-radius: 300px;'>";
                displayCake.innerHTML += img;
            }
            function display(){
                let array= ['cstrawberry.png', 'cbirthday.png', 'vstrawberry.png', 'vbirthday.png'];
                
                if(cake.innerHTML==="chocolate" && topp.innerHTML==="strawberry"){
                    show_image(array[0]);
                    displayText.innerHTML="Price: 50 RON";
                }else if(cake.innerHTML==="chocolate" && topp.innerHTML==="birthday"){
                    show_image(array[1]);
                    displayText.innerHTML="Price: 70 RON";
                }else if(cake.innerHTML==="vanilla" && topp.innerHTML==="strawberry"){
                    show_image(array[2]);
                    displayText.innerHTML="Price: 50 RON";
                }else if(cake.innerHTML==="vanilla" && topp.innerHTML==="birthday"){
                    show_image(array[3]);
                    displayText.innerHTML="Price: 50 RON";
                }
            }
            
            submit.addEventListener('click', display);
        </script>
        </body>
</html>