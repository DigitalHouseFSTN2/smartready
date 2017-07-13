<?php
  session_start();
  session_unset();
  $_SESSION = array();

  session_destroy();

  echo ("<SCRIPT LANGUAJE='JavaScript')>window.location.href='home.php'; </SCRIPT>");
?>
