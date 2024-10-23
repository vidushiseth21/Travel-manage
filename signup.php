<html>
<head>
    <title>SignUp Page || Travelanza</title>
  <link rel="stylesheet" href="css/mainCSS.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>
<style>
body {
  background-image: url('images/bg.jpg');
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
         <form action="adduser.php" method="post">
           <table>
              <tr>
                <th>Full Name: </th>
                <td><input type="text" id="fname" name="fname" pattern=".{3,15}" title="3-15 characters" size="29" placeholder="write full name, Maximum(15 Char)" required></td>
              </tr>
              <tr>
                <th>Gender: </th>
                <td><input type="radio" id="gender" name="gender" value="Male" checked="checked"> Male<input type="radio" id="gender" name="gender" value="Female"> Female<input type="radio" id="gender" name="gender" value="Other"> Other
                </td>
              </tr>
              <tr>
               <th>Email: </th>
               <td><input type="text" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required placeholder="Enter a valid email" title="Input valid email,please!" size="29"/></td>
             </tr>
              <tr>
                <th>Phone: </th> 
                <td><input type="tel" id="phone" name="phone" size="10" pattern="[789][0-9]{9}" placeholder="**********" required></td>
            </tr>
            <tr>
                <th>Address: </th> 
                <td><textarea id="address" name="address" cols=31 rows="8" required></textarea></td>
            </tr>
             <tr>
               <th>Password: </th>
               <td><input type="password" name="password" id="password" pattern=".{3,}" title="Three or more characters" size="29" required /></td>
             </tr>
              <tr>
              <th></th>
              <td><input type="submit" name="submit" value="SignUp" style="color: black; font-size: 20px;" /></td>
              </tr>   
            </table>
         </form>
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