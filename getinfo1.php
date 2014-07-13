<?php
   $myarray = array(array(5,1),array(6,3),array(7,4),array(3,5));
   $myarray1 = array(array(2,3),array(5,6),array(7,4),array(9,5));
   $myarray2 = array(array(4,6),array(5,6),array(7,7),array(8,5));
   echo json_encode(array($myarray,$myarray1,$myarray2));
?>
