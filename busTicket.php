

<?php
  session_start();
  if($_SESSION["bus_id"] == "")
  {
    header("Location: index.php");
    exit();
  }
  $busId =  $_SESSION["bus_id"];
  $ticketNum = $_SESSION["ticket_id"];
?>


<html>
<head>
    <meta charset="utf-8">
    <title>Travelanza</title>
  <link rel="stylesheet" href="css/mainCSS.css">
  <link rel="stylesheet" href="css/responsive.css">
  </head>
<style type="text/css">
    th{
      background-color: #FFE4E1;
      }
    td{
      color: #008000;
      text-align: center;
      background-color: #FFE4E1;
    }
</style>
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
    </br></br></br></br>
    
      <table border="1" style="width: 40%">
        <tr>
          <th>Ticket#: </th>
          <td><?php echo $ticketNum ?></td>
        </tr>
        <tr>
          <th>Bus#: </th>
          <td><?php echo $_SESSION["bus_id"] ?></td>
        </tr>
        <tr>
          <th>Your Name: </th>
          <td><?php echo $_SESSION["fname"] ?></td>
        </tr>
        <tr>
          <th>Your Gender: </th>
          <td><?php echo $_SESSION["gender"] ?></td>
        </tr>
        <tr>
          <th>Your Email: </th>
          <td><?php echo $_SESSION["email"] ?></td>
        </tr>
        <tr>
          <th>Your Phone: </th>
          <td><?php echo $_SESSION["phone"] ?></td>
        </tr>
         <tr>
          <th>Bus Name: </th>
          <td><?php echo $_SESSION["v_name"] ?></td>
        </tr>
        <tr>
          <th>Journey Date: </th>
          <td><?php echo $_SESSION["jdate"] ?></td>
        </tr>
        <tr>
          <th>Time: </th>
          <td><?php echo $_SESSION["jtime"] ?></td>
        </tr>
        <tr>
          <th>Route: </th>
          <td><?php echo $_SESSION["route"] ?></td>
        </tr>
        <tr>
          <th>Your Seat: </th>
          <td><?php echo $_SESSION["seatNum"] ?></td>
        </tr>
        <tr>
          <th>Bus Type: </th>
          <td><?php echo $_SESSION["category"] ?></td>
        </tr>
        <tr>
          <th>Fare: </th>
          <td><?php echo $_SESSION["amount"] ?></td>
        </tr>
        <tr>
          <th>Payment By: </th>
          <td><?php echo $_SESSION["payment"] ?></td>
        </tr>  
      </table>
      </br></br>
      <a href="bus_t_print.php"><h3 style="background-color: green;border: none;color: white; font-size: 20px;display: inline-block;">Print Your Ticket</h3></a>

    </center>
    <br/> <br/>
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