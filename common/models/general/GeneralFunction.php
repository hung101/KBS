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
}