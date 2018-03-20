<?php

class GregorianToJalali
{
    /***
    * @param g_y: year in Gregorian
    * @param g_m: month in Gregorian
    * @param g_d: day in Gregorian
    * @return [$jy,$jm,$jd]: an array that contains year, month and day in Jalali
    */
static function Convert($g_y, $g_m, $g_d)
{
    $g_days = array(31,28,31,30,31,30,31,31,30,31,30,31);
    $j_days= array(31,31,31,31,31,31,30,30,30,30,30,29);
    $g_y = (int)$g_y;
    $g_m = (int)$g_m;
    $g_d = (int)$g_d;
    $gy = $g_y-1600;
    $gm = $g_m-1;
    $gd = $g_d-1;
    $g_day_no = 365*$gy+(int)(($gy+3) / 4)-(int)(($gy+99)/100)+(int)(($gy+399)/400);
    for ($i=0; $i < $gm; ++$i)
        $g_day_no += $g_days[$i];
    if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0)))
        ++$g_day_no;
    $g_day_no += $gd;
    $j_day_no = $g_day_no-79;
    $j_np = (int)($j_day_no/ 12053);
    $j_day_no %= 12053;
    $jy = 979+33*$j_np+4*(int)($j_day_no/1461);
    $j_day_no %= 1461;
    if($j_day_no >= 366)
    {
        $jy += (int)(($j_day_no-1)/ 365);
        $j_day_no = ($j_day_no-1)%365;
    }
    for($i = 0; $i < 11 && $j_day_no >= $j_days[$i]; ++$i)
        $j_day_no -= $j_days[$i];
    $jm = $i+1;
    $jd = $j_day_no+1;
    return [$jy,$jm,$jd];
}
}
