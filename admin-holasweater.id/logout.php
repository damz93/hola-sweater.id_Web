<?php
   session_start();
   if(session_destroy()) {	   
      header("Location:index.php?pesan=logout");
	  header("Refresh:0");
   }
?>