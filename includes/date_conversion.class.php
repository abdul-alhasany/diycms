<?php
/*
+===============================================================================+
|      	Some or all this file's contents were created by ArabPortal Team   		|
|						Web: http://www.arab-portal.info						|
|   	--------------------------------------------------------------   		|
|      					DIY-CMS V1.1 Copyright © 2011   						|
|   	--------------------------------------------------------------   		|
|                    				BY                    						|
|              				ABDUL KAHHAR AL-HASANY            					|
|   																	   		|
|      					Web: http://www.diy-cms.com      						|
|   	--------------------------------------------------------------   		|
|	This file is part of DiY-CMS.												|
|   DiY-CMS is free software: you can redistribute it and/or modify				|
|   it under the terms of the GNU General Public License as published by		|
|   the Free Software Foundation, either version 3 of the License, or			|
|   (at your option) any later version.											|
|   DiY-CMS is distributed in the hope that it will be useful,					|
|   but WITHOUT ANY WARRANTY; without even the implied warranty of				|
|   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the				|
|   GNU General Public License for more details.								|
|   You should have received a copy of the GNU General Public License			|
|   along with DiY-CMS.  If not, see <http://www.gnu.org/licenses/>.			|
+===============================================================================+
*/

/* Module:	date_conversion class
Author:	VisualMind (visualmind@php.net)
Homepage:	http://www.php4arab.info   
*/

/**
 * This class convert all date in the DiY-CMS to a hijri (lunar) date if the hijri date type is selected
 * 
 * @package Global
 * @subpackage Classes
 * @author Abdul Al-Hasany
 * @copyright Abdul Al-hasany (c) 2010
 * @version 2010
 * @access public
 */
class date_conversion
{
   /**
    * date_conversion::_ardInt()
    * 
    * @param mixed $float
    * @return
    */
   function _ardInt($float)
   {
      return ($float < -0.0000001) ? ceil($float - 0.0000001) : floor($float + 0.0000001);
   }
   
   
   /**
    * date_conversion::date()
    * 
    * @param mixed $type
    * @param mixed $format
    * @param mixed $timestamp
    * @return
    */
   function date($type, $format, $timestamp)
   {
   
	check_hook_function('date_start', $timestamp);
	
      $format = trim($format);
      
      $days = array(
         'Monday',
         'Tuesday',
         'Wednesday',
         'Thursday',
         'Friday',
         'Saturday',
         'Sunday'
      );
      
      $newdays = array(
         DAY_MONDAY,
         DAY_TUESDAY,
         DAY_WEDNESDAY,
         DAY_THURSDAY,
         DAY_FRIDAY,
         DAY_SATURDAY,
         DAY_SUNDAY
      );
      
      $ampm = array(
         'am' => 'TIME_AM',
         'pm' => 'TIME_PM'
      );
      
      list($d, $m, $y, $dayname, $monthname, $am) = explode(' ', date('d m Y D M a', $timestamp));
      
      if ($type == 'hijri') {
         if (($y > 1582) || (($y == 1582) && ($m > 10)) || (($y == 1582) && ($m == 10) && ($d > 14))) {
            $jd = date_conversion::_ardInt((1461 * ($y + 4800 + date_conversion::_ardInt(($m - 14) / 12))) / 4);
            $jd += date_conversion::_ardInt((367 * ($m - 2 - 12 * (date_conversion::_ardInt(($m - 14) / 12)))) / 12);
            $jd -= date_conversion::_ardInt((3 * (date_conversion::_ardInt(($y + 4900 + date_conversion::_ardInt(($m - 14) / 12)) / 100))) / 4);
            $jd += $d - 32075;
         } else {
            $jd = 367 * $y - date_conversion::_ardInt((7 * ($y + 5001 + date_conversion::_ardInt(($m - 9) / 7))) / 4) + date_conversion::_ardInt((275 * $m) / 9) + $d + 1729777;
         }
         $l = $jd - 1948440 + 10632;
         $n = date_conversion::_ardInt(($l - 1) / 10631);
         $l = $l - 10631 * $n + 355; // Correction: 355 instead of 354
         $j = (date_conversion::_ardInt((10985 - $l) / 5316)) * (date_conversion::_ardInt((50 * $l) / 17719)) + (date_conversion::_ardInt($l / 5670)) * (date_conversion::_ardInt((43 * $l) / 15238));
         $l = $l - (date_conversion::_ardInt((30 - $j) / 15)) * (date_conversion::_ardInt((17719 * $j) / 50)) - (date_conversion::_ardInt($j / 16)) * (date_conversion::_ardInt((15238 * $j) / 43)) + 29;
         $m = date_conversion::_ardInt((24 * $l) / 709);
         $d = $l - date_conversion::_ardInt((709 * $m) / 24);
         $y = 30 * $n + $j - 30;
         
         $months = array(
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
         );
         
         $newHjriMonth = array(
            HIJRI_MONTH_MUHARRAM,
            HIJRI_MONTH_SAFAR,
            HIJRI_MONTH_RABI_AL - AWWAL,
            HIJRI_MONTH_RABI_AL - THANI,
            HIJRI_MONTH_JUMADA_AL - AWWAL,
            HIJRI_MONTH_JUMADA_AL - THANI,
            HIJRI_MONTH_RAJAB,
            HIJRI_MONTH_SHAABAN,
            HIJRI_MONTH_RAMADAN,
            HIJRI_MONTH_SHAWWAL,
            HIJRI_MONTH_DHU_AL - QIDAH,
            HIJRI_MONTH_DHU_AL - HIJJAH
         );
         
         $format = str_replace('j', $d, $format);
         $format = str_replace('d', str_pad($d, 2, 0, STR_PAD_LEFT), $format);
         $format = str_replace('m', str_pad($m, 2, 0, STR_PAD_LEFT), $format);
         $format = str_replace('n', $m, $format);
         $format = str_replace('Y', $y, $format);
         $format = str_replace('y', substr($y, 2), $format);
         $format = str_replace('a', substr($ampm[$am], 0, 1), $format);
         $format = str_replace('A', $ampm[$am], $format);
         
         
      } elseif ($type == 'gregorian') {
         $months = array(
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
         );
         
         $newMonths = array(
            MONTH_JANUARY,
            MONTH_FEBRUARY,
            MONTH_MARCH,
            MONTH_APRIL,
            MONTH_MAY,
            MONTH_JUNE,
            MONTH_JULY,
            MONTH_AUGUST,
            MONTH_SEPTEMBER,
            MONTH_OCTOBER,
            MONTH_NOVEMBER,
            MONTH_DECEMBER
         );
         
         $format = str_replace('a', substr($ampm[$am], 0, 1), $format);
         $format = str_replace('A', $ampm[$am], $format);
      }
      
      $date = date($format, $timestamp);
      $date = str_replace($days, $newdays, $date);
      $date = str_replace($months, $newHjriMonth, $date);
      $date = str_replace($months, $newMonths, $date);
      
      check_hook_function('date_end', $date);
	  
     
         return $date;
   }
   
   /**
    * date_conversion::dateHejri2Geo()
    * 
    * @param mixed $date_formatDate
    * @return
    */
   function dateHejri2Geo($date_formatDate)
   {
      // date_formatDate must be dd/mm/yyyy
      list($d, $m, $y) = explode('/', $date_formatDate);
      $jd = date_conversion::_ardInt((11 * $y + 3) / 30) + 354 * $y + 30 * $m - date_conversion::_ardInt(($m - 1) / 2) + $d + 1948440 - 386;
      if ($jd > 2299160) {
         $l = $jd + 68569;
         $n = date_conversion::_ardInt((4 * $l) / 146097);
         $l = $l - date_conversion::_ardInt((146097 * $n + 3) / 4);
         $i = date_conversion::_ardInt((4000 * ($l + 1)) / 1461001);
         $l = $l - date_conversion::_ardInt((1461 * $i) / 4) + 31;
         $j = date_conversion::_ardInt((80 * $l) / 2447);
         $d = $l - date_conversion::_ardInt((2447 * $j) / 80);
         $l = date_conversion::_ardInt($j / 11);
         $m = $j + 2 - 12 * $l;
         $y = 100 * ($n - 49) + $i + $l;
      } else {
         $j = $jd + 1402;
         $k = date_conversion::_ardInt(($j - 1) / 1461);
         $l = $j - 1461 * $k;
         $n = date_conversion::_ardInt(($l - 1) / 365) - date_conversion::_ardInt($l / 1461);
         $i = $l - 365 * $n + 30;
         $j = date_conversion::_ardInt((80 * $i) / 2447);
         $d = $i - date_conversion::_ardInt((2447 * $j) / 80);
         $i = date_conversion::_ardInt($j / 11);
         $m = $j + 2 - 12 * $i;
         $y = 4 * $k + $n + $i - 4716;
      }
      
      return "$d-$m-$y";
   }
   
}

?>