<?php
  session_start();;
  if(!$_SESSION["train"])
  {
    header("Location: index.php");
    exit();
  }
  $_SESSION['train1'] = "on";
  require_once('mysqldb.php');
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Travelanza</title>
  <link rel="stylesheet" href="css/mainCSS.css">
  <link rel="stylesheet" href="css/responsive.css">
  </head>
  <style type="text/css">
    td{
      text-align: center;
    }
  </style>
   <style>
body {
  background-image: url('images/train.jpg');
  backdrop-filter: blur(5px);
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
        
        <h1 style="color: white;">Travelanza</h1>
      </a>
      </br></br></br>
      <nav>
        <ul>
          <li><a href="index.php">Flights</a></li>
          <li><a href="bus.php">Buses</a></li>
          <li><a href="train.php" class="selected">Train</a></li>
          <li><a href="login.php">Login/Signup</a></li>
        </ul>
      </nav>
    <center>
    </br></br></br>
          <?php
              $dfrom = $gto = $ddate = $rdate = "";
              if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $dfrom = $_POST['dfrom'];
                    $gto = $_POST['gto'];
                    $ddate = $_POST['ddate'];
                    $rdate = $_POST['rdate'];
                
              $sql = "select * from train_trips";
              if(!empty($_POST['rdate']))
                $sql = "select * from train_trips where (deptfrom like '$dfrom%' and goingto like '$gto%' and tourdate = '$ddate') or    (deptfrom like '$gto%' and goingto like '$dfrom%' and tourdate = '$rdate') order by train_id desc";

              else
               $sql = "select * from train_trips where deptfrom like '$dfrom%' and goingto like '$gto%' and tourdate = '$ddate' order by train_id desc";          
              
              
              $result = mysqli_query($conn, $sql);
              $i = 0;        
            ?>
 <form method="POST">
      <table border="1" style="border-collapse: collapse; width:100%;">
              <tr style="color: black;background-color: 728FCE;">
                <td>Route</td>
                <td>Date</td>
                <td>Time</td>
                <td>Train Name</td>
                <td>Seat Category</td>
                <td>Available Seat</td>
                <td>Fare</td>
                <td>Show Seat</td>
              </tr>

            <?php
              while($row = mysqli_fetch_array($result)) {
               $tid = $row['train_id'];
               $_SESSION["route"] =  $row['deptfrom'] ." - ". $row['goingto']?>              
               
                 <tr style="color: white;">
                 <td>
                  <?php echo $row['deptfrom'] ." - ". $row['goingto']?>
                 </td>
                 <td>
                  <?php echo $row['tourdate'] ?>
                 </td>
                 <td>
                   <?php echo $row['dept_time'] ." - ". $row['arri_time']?>
                 </td>
                 <td>
                   <?php echo $row['t_name']?>
                 </td>
                 <td>
                   <?php echo $row['category']?>
                 </td>
                 <td>
                   <?php echo $row['avai_seat']?>
                 </td>
                 <td>
                   <?php echo $row['fare_per_seat']?> 
                 </td>
                 <td onclick="document.location = 'trainSeat.php?id=<?php echo urlencode($tid);?>'" style="background-color: 728FCE; color: white; font-size: 20px; cursor:hand;">Show Seat</td>
                </tr>                
          <?php
          }
        }
        else
             echo "Please Search Your Desire Info";
          ?>
          </table>
   </form>
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