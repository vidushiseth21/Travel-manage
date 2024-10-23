<?php
  session_start();
  $_SESSION["flight"] = "index";
  require_once('mysqldb.php');
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
  background-image: url('images/air1.jpg');
  backdrop-filter: blur(0px);
}
</style>
<style>
  #searchForm {
    position: bottom;
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
          <li><a href="index.php" class="selected">Flights</a></li>
          <li><a href="bus.php">Buses</a></li>
          <li><a href="train.php">Train</a></li>
          <li><a href="login.php">Login/Signup</a></li>
        </ul>
      </nav>
      
      </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
    
      

		  <div id="iform">
      
         <form id="searchForm" name="searchForm" action="flight1.php" method="post">
           <table>
             <tr>
               <th style="color: white; font-size: 20px;">Depart From</th>
               <td style="color: white; font-size: 20px;"><input type="text" name="dfrom" id="dfrom" required/></td>
               <td rowspan="5"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>
               </tr>
              <tr>
               <th style="color: white; font-size: 20px;">Going To</th>
               <td style="color: white; font-size: 20px;"><input type="text" name="gto" id="gto" required/></td>
             </tr>
              <tr>
               <th style="color: white; font-size: 20px;">Departure Date</th>
               <td style="color: white; font-size: 20px;"><input type="text" name="ddate" id="ddate" required/></td> <!--We can use disabled || readonly also-->
             </tr>
             <tr>
               <th style="color: white; font-size: 20px;">Return Date</th>
               <td style="color: white; font-size: 20px;"><input type="text" name="rdate" placeholder="optional" id="rdate"/></td>
             </tr>
              <tr>
              <th colspan="2"><input type="submit" name="submit" value="Search Desire Flight" style="color: white; font-size: 20px;" /></th>
              </tr>   
            </table>
         </form>
      </div>
 
    <br/> <br/>
<div class="footer">
    <nav>
        <ul>
          <li><a href="about.php" class="selected">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          </ul>
    </nav>
</div>

<link href="date_JS/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="date_JS/jquery.js"></script>
<script src="date_JS/jquery-ui.js"></script>
  <script type="text/javascript">
      $(document).ready(function(){
        $( "#ddate" ).datepicker({
          dateFormat: 'dd/mm/yy',
          minDate: 0,
          maxDate: "+30D",
          changeMonth: true,
          onSelect: function() {
            var date = $(this).datepicker('getDate');
            if (date){
              date.setDate(date.getDate() + 0);
              $( "#rdate" ).datepicker( "option", "minDate", date );
            }
          }
        });
        $( "#rdate" ).datepicker({
          dateFormat: 'dd/mm/yy',
          maxDate: "+30D",
          changeMonth: true,
          onSelect: function() {
            var date = $(this).datepicker('getDate');
            if (date) {
              date.setDate(date.getDate() - 0);
              $( "#ddate" ).datepicker( "option", "maxDate", date );
            }
          }
        });
      });
      </script>
</body>
</html>