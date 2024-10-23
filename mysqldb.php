<?php
 $conn = mysqli_connect('localhost',"root",'Musk@2Set1', 'ticketmanagement');
    if($conn == null)
    {
        die('error connecting database');
        return;
    }
    mysqli_select_db( $conn, 'ticketmanagement');

?>
