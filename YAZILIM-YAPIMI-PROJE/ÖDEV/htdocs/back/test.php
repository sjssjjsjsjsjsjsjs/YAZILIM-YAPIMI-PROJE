<?php

require_once "helper.php";

$myPW = createPassword("utku");
echo checkPassword("utku", $myPW);
echo checkPassword("utkuu", $myPW);