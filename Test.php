<?php
include_once("GregorianToJalali.php");
$jalali = GregorianToJalali::Convert(1992,10,8);
echo $jalali[0]."/".$jalali[1]."/".$jalali[2]; // yyyy/mm/dd