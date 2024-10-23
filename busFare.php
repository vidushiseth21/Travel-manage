<?php
  session_start();
  if($_SESSION["bus_id"] == "")
  {
    header("Location: index.php");
    exit();
  }
  $route = $_SESSION["route"];
  $busId =  $_SESSION["bus_id"];
  $seats = $_SESSION["seats"]; 
  $disabled = $err = $seatNum = "";
  $fare = 0;
  $count = 0;
  require_once('mysqldb.php');
  if($_SERVER['REQUEST_METHOD'] != "POST")
  {
    $sql = "select fare_per_seat,tourdate, b_name, dept_time, category, arri_time from bus_trips where bus_id = '$busId';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $fare = $row["fare_per_seat"];
    $_SESSION["perfare"] = $fare;
    $_SESSION["jdate"] = $row["tourdate"];
    $_SESSION["jtime"] = $row["dept_time"]." - ".$row["arri_time"];
    $_SESSION["v_name"] = $v_name = $row["b_name"];
    $_SESSION["category"] = $category = $row["category"];
    $seatNum = "";
    $first = true;
    foreach($seats as $seat) 
    {
      if($first)
      {
        $seatNum = $seat;
        $first = false;
      }
      else
        $seatNum .= ", ".$seat;
      $count++;
      $_SESSION["seatNum"] = $seatNum;
    } $_SESSION["fare"] = $count*$_SESSION["perfare"];
  } 
 else{ 
    $first = true;
    foreach($seats as $seat)
    {
      if($first)
      {
        $seatNum = $seat;
        $first = false;
      }
      else
        $seatNum .= ", ".$seat;
      $_SESSION["seatNum"] = $seatNum;
      $count++;
    }
  }
  if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['submit']))
  { 
    if($_POST["amount"] == $_SESSION["fare"])
    {
      foreach ($seats as $seat) {
      $sql = "insert into seat_info_bus (seat_num, bus_id, status) values ('$seat', '$busId', 'checked')";
      if(!mysqli_query($conn, $sql))
      {
        echo mysqli_error($conn);
      }
    }
    $sql = "update bus_trips set avai_seat = avai_seat-$count where bus_id = '$busId';";
     if(!mysqli_query($conn, $sql))
        $err = mysqli_error($conn);
     
     //*****************//
      $_SESSION["fname"] = $fname = $_REQUEST['fname'];
      $_SESSION["gender"] = $gender = $_REQUEST['gender'];
      $_SESSION["email"] = $email = $_REQUEST['email'];
      $_SESSION["phone"] = $phone = $_REQUEST['phone'];
      $_SESSION["payment"] = $payment = $_REQUEST['payMethod'];
      $_SESSION["amount"] = $amount = $_REQUEST['amount'];
      $_SESSION["jdate"] = $jdate = $_SESSION["jdate"];
      $_SESSION["jtime"] = $jtime = $_SESSION["jtime"];
      $v_name = $_SESSION["v_name"];
      $category = $_SESSION["category"];
      $busId =  $_SESSION["bus_id"];
      $sql1 = "insert into ticket_invoice_bus (user_name, email, phone, gender,bus_id,vehicle_name, pay_method, amount, seats, category, route, jdate, jtime) values ('$fname', '$email','$phone','$gender','$busId','$v_name','$payment','$amount','$seatNum','$category','$route','$jdate','$jtime');";
      if(!mysqli_query($conn, $sql1))
        echo mysqli_error($conn);
      else
        {
          $sql = "SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'ticketmanagement' AND TABLE_NAME = 'ticket_invoice';";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($result);
          $_SESSION["ticket_id"] = $row[0]-1;        
        
          //****************//
         header('Location: busTicket.php');
         exit(); 
       }
    }
    else
    {
      $err = "Give Equal Amount of Money, Please!";
    }
    
  }
  
  if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["checkcoupon"]))
  {
    $coupon = $_POST["coupon"];
    $sql = "select * from coupon_info where coupon_num = '$coupon'";
    $result = mysqli_query($sql);
    $isvalid = false;
    while($row = mysqli_fetch_array($result)){
      $discount = $row["discount"];
      $f = $count * $_SESSION["perfare"];
      $_SESSION["fare"] = $f-($f * ($discount/100));    
      $disabled = "disabled";
      $isvalid = true;
      $err = "";
    }
    if(!$isvalid)
      $err = "Invalid coupon";
  }

?>

</html>
<head>
    <meta charset="utf-8">
    <title>Travelanza</title>
  <link rel="stylesheet" href="css/mainCSS.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>
<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  color: black;
  text-align: right;
}
</style>
<body>
</br>
      <a href="index.php" id="logo">
        
        <h1>Travelanza</h1>
      </a>
      </br></br></br>
      <nav>
        <ul>
          <li><a href="index.php">Flights</a></li>
          <li><a href="bus.php" class="selected">Buses</a></li>
          <li><a href="train.php">Train</a></li>
          <li><a href="login.php">Login/Signup</a></li>
        </ul>
      </nav>
  
     <center>
     </br></br></br>
     <div id="iform">
     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
     <table>
       <tr>
         <th>Your Seat#: </th>
         <td><?php echo $seatNum; ?></td>
       </tr>
       <tr>
         <th>Total Fare: </th>
         <td> <?php echo $_SESSION["fare"]; ?></td>
       </tr>
     </table>
     </form>
     <span style="color:red"> <?php echo $err; ?> </span>
<h3 style="color: coral;"><u>Please Provide Your Details</u></h3>
       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
           <table>
              <tr>
                <th>Full Name: </th>
                <td><input type="text" id="fname" name="fname" pattern=".{3,15}" title="3-15 characters" size="35" placeholder="write full name, Maximum(15 Char)" required></td>
              </tr>
              <tr>
                <th>Gender: </th>
                <td><input type="radio" id="gender" name="gender" value="Male" checked="checked"> Male<input type="radio" id="gender" name="gender" value="Female"> Female<input type="radio" id="gender" name="gender" value="Other"> Other
                </td>
              </tr>
              <tr>
               <th>Email: </th>
               <td><input type="text" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required placeholder="Enter a valid email" title="Input valid email,please!"/></td>
             </tr>
              <tr>
                <th>Phone: </th> 
                <td><input type="tel" id="phone" name="phone" size="10" pattern="[789][0-9]{9}" placeholder="**********" title="valid phone number" required></td>
            </tr>
            <tr>
                <th>Payment By: </th> 
                <td>
                  <select name="payMethod" required>
                      <option value="" disabled="disabled" selected="selected">Select PaymentGetway</option>
                      <option value="InternetBanking">Internet Banking</option>
                      <option value="Card">Debit/Credit Card</option>
                      <option value="UPI">UPI</option>
                  </select>
                </td>
            </tr>
            <tr>
                <th>Enter Amount: </th> 
                <td><input type="text" id="amount" name="amount" size="35" required></td>
            </tr>
            <tr>
              <th></th>
              <td><input type="submit" name="submit" value="Continue" style="background-color: 728FCE; color: white; font-size: 20px;" /></td>
              </tr>
        </table>
        </form>
     </center>
<div class="footer">
    <nav>
        <ul>
          <li><a href="about.php" class="selected">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          </ul>
    </nav>
</div>
</body>
</html>