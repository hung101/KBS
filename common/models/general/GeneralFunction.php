<?php
namespace common\models\general;

use Yii;
// eddie (jasper)
use Jaspersoft\Client\Client;

class GeneralFunction{
    const DATE_FORMAT = 'php:d-m-Y';
    const DATETIME_FORMAT = 'php:d-m-Y H:i';
    const TIME_FORMAT = 'php:H:i:s';
    
    const TYPE_DATETIME = 'datetime';
    const TYPE_TIME = 'time';
    const TYPE_DATE = 'date';
 
    public static function convert($dateStr, $type=self::TYPE_DATE, $format = null) {
        if ($type === self::TYPE_DATETIME) {
              $fmt = ($format == null) ? self::DATETIME_FORMAT : $format;
        }
        elseif ($type === self::TYPE_TIME) {
              $fmt = ($format == null) ? self::TIME_FORMAT : $format;
        }
        else {
              $fmt = ($format == null) ? self::DATE_FORMAT : $format;
        }
        return \Yii::$app->formatter->asDatetime($dateStr, $fmt);
    }
    
    public static function getDOBfromICNo($ic){
        $dobYear = substr($ic, 0, 2);
        $dobMonth = substr($ic, 2, 2);
        $dobDay = substr($ic, 4, 2);
        
        $curYearAddOne = substr(date("Y")+1, -2); // Current Year + 1 with last 2 digits
        
        $birthFullYear = null;
        
        if($dobYear < $curYearAddOne){
            $birthFullYear = "20" . $dobYear;
        } else {
            $birthFullYear = "19" . $dobYear;
        }
        
        return $birthFullYear . "-" . $dobMonth . "-" . $dobDay;
    }
    
    public static function ageCalculator($dob){
	$dob=explode("-",$dob); 
        $curMonth = date("m");
        $curDay = date("j");
        $curYear = date("Y");
        $age = $curYear - $dob[0]; 
        if($curMonth<$dob[1] || ($curMonth==$dob[1] && $curDay<$dob[2])) 
                $age--; 
        return $age; 
    }
    
    public static function generateReport($reportURL, $format, $controls, $filename){
        $c = new Client(
            Yii::$app->params['jasperurl'],
            Yii::$app->params['jasperuser'],
            Yii::$app->params['jasperpass']
        );
            
        $report = $c->reportService()->runReport($reportURL, $format, null, null, $controls);
        
        if($format != 'html') {
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename=' . $filename . '.' . $format);
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . strlen($report));
            header('Content-Type: application/'.$format);
        }
        
        echo $report;
    }
    
    public static function getWeekDayWord($date_time){
        $week_day_no = date_format(date_create($date_time),"w");
        
	switch($week_day_no){
            case 0:
                $week_day_word = "Ahad";
                break;
            case 1:
                $week_day_word = "Isnin";
                break;
            case 2:
                $week_day_word = "Selasa";
                break;
            case 3:
                $week_day_word = "Rabu";
                break;
            case 4:
                $week_day_word = "Khamis";
                break;
            case 5:
                $week_day_word = "Jumaat";
                break;
            case 6:
                $week_day_word = "Sabtu";
                break;
            default:
                $week_day_word = "";
        }
        
        return $week_day_word; 
    }
    
    public static function getMonthWord($date_time, $type = 1){
        $month_no = date_format(date_create($date_time),"n");
        
	switch($month_no){
            case 1:
                if($type == 1){
                    $month_word = "Jan";
                } else {
                    $month_word = "Januari";
                }
                break;
            case 2:
                if($type == 1){
                    $month_word = "Feb";
                } else {
                    $month_word = "Februari";
                }
                break;
            case 3:
                if($type == 1){
                    $month_word = "Mac";
                } else {
                    $month_word = "Mac";
                }
                break;
            case 4:
                if($type == 1){
                    $month_word = "Apr";
                } else {
                    $month_word = "April";
                }
                break;
            case 5:
                if($type == 1){
                    $month_word = "Mei";
                } else {
                    $month_word = "Mei";
                }
                break;
            case 6:
                if($type == 1){
                    $month_word = "Jun";
                } else {
                    $month_word = "Jun";
                }
                break;
            case 7:
                if($type == 1){
                    $month_word = "Jul";
                } else {
                    $month_word = "Julai";
                }
                break;
            case 8:
                if($type == 1){
                    $month_word = "Ogo";
                } else {
                    $month_word = "Ogos";
                }
                break;
            case 9:
                if($type == 1){
                    $month_word = "Sep";
                } else {
                    $month_word = "September";
                }
                break;
            case 10:
                if($type == 1){
                    $month_word = "Okt";
                } else {
                    $month_word = "Oktober";
                }
                break;
            case 11:
                if($type == 1){
                    $month_word = "Nov";
                } else {
                    $month_word = "November";
                }
                break;
            case 12:
                if($type == 1){
                    $month_word = "Dis";
                } else {
                    $month_word = "Disember";
                }
                break;
            default:
                $month_word = "";
        }
        
        return $month_word; 
    }
    
    public static function getCurrentTimestamp(){
        return date('Y-m-d H:i:s');
    }
}