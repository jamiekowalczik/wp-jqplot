<?php
   $myarray = array(array(13,70),array(14,72),array(15,72),array(16,73));
   $myarray1 = array(array(13,32),array(14,30),array(15,31),array(16,32));
   $myarray2 = array(array(13,79),array(14,80),array(15,84),array(16,84));
   echo json_encode(array($myarray,$myarray1,$myarray2));
?>
