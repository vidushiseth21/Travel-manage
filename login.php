<?php
session_start();
  
require_once('mysqldb.php');
$err = "";
  if($_SERVER["REQUEST_METHOD"] == "POST")
    {
   $email = $_POST['email'];
   $password = $_POST['pass'];

  $sql = "SELECT * FROM login";
  $result = mysqli_query($conn, $sql);
     
    while($row = mysqli_fetch_array($result))
    {
       $un= $row['email'];
       $up= $row['pass'];
       $acctype = $row['acctype'];
       
       if($un == $email && $up == $password && $acctype=="Admin")
      {
        $_SESSION["admin"] = $email;
        header('Location: adminpanel/index.php');
        exit;
      }
      else if($un == $email && $up == $password && $acctype=="User")
      {
        $_SESSION["user"] = $email;
        header('Location: userpanel/user.php');
        exit;      
      }
       else
      {
        $err = 'Invalid Email or Pass';
      }
    }
  }
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Travelanza</title>
  <link rel="stylesheet" href="css/mainCSS.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>
<style>
body {
  background-image: url('images/login.jpg');
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
        
        <h1>Travelanza</h1>
      </a>
      </br></br></br>
      <nav>
        <ul>
          <li><a href="index.php">Flights</a></li>
          <li><a href="bus.php">Buses</a></li>
          <li><a href="train.php">Train</a></li>
          <li><a href="login.php" class="selected">Login/Signup</a></li>
        </ul>
      </nav>
<center>
</br> </br></br> </br></br> </br>
      <div>
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
           <table>
              <tr>
               <th>Email: </th>
               <td><input type="text" name="email" id="email" required /></td>
             </tr>
             <tr>
               <th>Password: </th>
               <td><input type="password" name="pass" id="pass" required /></td>
             </tr>
              <tr>
              <th></th>
              <td>
              <input type="submit" name="submit" value="Login" style="color: black; font-size: 20px;" />
              </td>
              </tr>   
            </table>
            <p style="color:red"><?php echo $err; ?></p>
         </form>
      </div>
      <div>
        <h2 style="color: black;"><u>Not Registered Yet?</u></h2> &nbsp <a href="signup.php" style="background-color: transparent;color: black; font-size:20px;">SignUp Here.</a>
      </div>
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