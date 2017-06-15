<?php defined('BASEPATH') OR exit('No direct script access allowed');

	if ( ! function_exists('convertDate')) {
		
		function convertDate ($date) {
			
			$date=explode("-",$date);
			$date=$date[2]."/".$date[1]."/".$date[0];
			
			return $date;
			
		}
		
	}
	
	if ( ! function_exists('revertDate')) {
		
		function revertDate ($date) {
			
			$date=explode("/",$date);
			$date=$date[2]."-".$date[1]."-".$date[0];
			
			return $date;
			
		}
		
	}
	
	if ( ! function_exists('cleanDate')) {
		
		// tolgo orario
		
		function cleanDate ($date) {
			
			$date=explode(" ",$date);
			$date=$date[0];
			
			return $date;
			
		}
		
	}	
	
	if ( ! function_exists('cleanDateSeconds')) {
		
		// tolgo secondi da orario
		
		function cleanDateSeconds ($date) {
			
			$date=explode(" ",$date);
			$time=explode(":",$date[1]);
			$time=$time[0].":".$time[1];
			
			return $date[0]." ".$time;
			
		}
		
	}	
	
	if ( ! function_exists('convertDateTime')) {
		
		function convertDateTime ($datetime,$cleanseconds=FALSE) {
			$datetime=explode(" ",$datetime);
			$date=convertDate($datetime[0]);
			$time=$datetime[1];
			if ($cleanseconds) $time=substr($datetime[1],0,-3);
			
			return $date." ".$time;			
		}
		
	}	
	
	if ( ! function_exists('revertDateTime')) {
		
		function revertDateTime ($datetime,$cleanseconds=FALSE) {
			$datetime=explode(" ",$datetime);
			$date=revertDate($datetime[0]);
			$time=$datetime[1];
			if ($cleanseconds) $time=substr($time,0,-3);
			
			return $date." ".$time;			
		}
		
	}	
	
	
	if ( ! function_exists('calcWeekDays')) {
		
		function calcWeekDays($days) {
			
			$days=explode(",",$days);		
			$c=0;
			
			foreach ($days as $key=>$val) {
				if ($val==1) $c+=pow(2,$key);
			}
			
			return $c;
			
		}
		
	}
	
	if ( ! function_exists('daysToBin')) {
		
		function daysToBin($days) {
	
			$week_days=(string) decbin($days);
			$l=strlen($week_days);
			$zeri="";
			if ($l<7) {
				for ($x=0;$x<(7-$l);$x++) {
					$zeri.="0";
				}
			}
			return strrev($zeri.$week_days);
			
		}
		
	}
				
?>