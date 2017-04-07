<?php
namespace common\models\general;

use Yii;
// eddie (jasper)
use Jaspersoft\Client\Client;

use app\models\RefSukan;
use app\models\Atlet;
use app\models\RefNegeri;
use app\models\ProfilBadanSukan;
use app\models\Jurulatih;
use app\models\RefStatusTawaran;


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
    
    public static function getCurrentDate(){
        return date('Y-m-d');
    }
    
    public static function getFormatIc($ic_no){
        return substr($ic_no,0,6) . '-' . substr($ic_no,6,2) . '-' . substr($ic_no,8,4);
    }
    
    public static function getUpperCaseWords($word){
        return strtoupper($word);
    }
    
    public static function getDatePrintFormat($date){
        return date("d.m.Y", strtotime($date));
    }
    
    public static function getDateTimePrintFormat($date){
        return date("d.m.Y G.i", strtotime($date));
    }
    
    public static function joinAddress($address_1, $address_2, $address_3){
        return strtoupper($address_1) . ' ' . strtoupper($address_2) . ' ' . strtoupper($address_3);
    }
    
    public static function getWeightHeight($value){
        return ceil($value);
    }
    
    public static function getNumberFormatPrint($value){
        return number_format($value, 2, '.', '');
    }
    
    public static function getPhoneFormat($value){
        if(strlen($value) > 9 && strlen($value) <= 11 && substr($value,1,1) == '1'){
            // mobile number
            return substr($value,0,3) . '-' . substr($value,3);
        } else if(strlen($value) > 11){
            return $value;
        } else {
            //local number
            return substr($value,0,2) . '-' . substr($value,2);
        }
    }
    
    public static function getSukan($param = null){
        
        $sukan_dd_list = RefSukan::find()->where(['=', 'aktif', 1]); // defauilt show all the sukan
        
        // add filter base on sukan access role in tbl_user->sukan - START
        if(Yii::$app->user->identity->sukan){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('id'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            $sukan_dd_list = RefSukan::find()->where(['=', 'aktif', 1])->andFilterWhere(['id'=>$arr_sukan_filter]);
        }
        // add filter base on sukan access role in tbl_user->sukan - END
        
        if(isset($param['cacat']) && $param['cacat'] == 0){
            $sukan_dd_list = $sukan_dd_list->andWhere(['=', 'cacat', 0]);
        } elseif(isset($param['cacat']) && $param['cacat'] == 1){
            $sukan_dd_list = $sukan_dd_list->andWhere(['=', 'cacat', 1]);
        }
        
        $sukan_dd_list = $sukan_dd_list->all();
        
        return $sukan_dd_list;
    }
    
    
    public static function getCawangan($param = null){
        
        $cawangan_dd_list = RefSukan::find()->where(['=', 'aktif', 1])->groupBy('ref_cawangan_id'); // defauilt show all the cawangan
        
        // add filter base on sukan access role in tbl_user->sukan - START
        if(Yii::$app->user->identity->sukan){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('id'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            $cawangan_dd_list = RefSukan::find()->where(['=', 'aktif', 1])->andFilterWhere(['id'=>$arr_sukan_filter])->groupBy('ref_cawangan_id');
        }
        // add filter base on sukan access role in tbl_user->sukan - END
        
        if(isset($param['cacat']) && $param['cacat'] == 0){
            $cawangan_dd_list = $cawangan_dd_list->andWhere(['=', 'cacat', 0]);
        } elseif(isset($param['cacat']) && $param['cacat'] == 1){
            $cawangan_dd_list = $cawangan_dd_list->andWhere(['=', 'cacat', 1]);
        }
        
        $cawangan_dd_list = $cawangan_dd_list->all();
        
        return $cawangan_dd_list;
    }
    
    public static function getAtlet($param = null){
        
        $atlet_dd_list = Atlet::find(); // defauilt show all the cawangan
        
        // add filter base on sukan access role in tbl_user->sukan - START
        if(Yii::$app->user->identity->sukan){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('tbl_atlet_sukan.nama_sukan'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            $atlet_dd_list = Atlet::find()->joinWith(['refAtletSukan' => function($query) {
                                                    $query->orderBy(['tbl_atlet_sukan.created' => SORT_DESC])->one();
                                                },
                                            ])->andFilterWhere(['tbl_atlet_sukan.nama_sukan'=>$arr_sukan_filter]);
        }
        // add filter base on sukan access role in tbl_user->sukan - END
        
        if(isset($param['cacat']) && $param['cacat'] == 0){
            $atlet_dd_list = $atlet_dd_list->andWhere(['=', 'cacat', 0]);
        } elseif(isset($param['cacat']) && $param['cacat'] == 1){
            $atlet_dd_list = $atlet_dd_list->andWhere(['=', 'cacat', 1]);
        }
        
        $atlet_dd_list = $atlet_dd_list->all();
        
        return $atlet_dd_list;
    }
    
    
    public static function getNegeri($param = null){
        
        $negeri_dd_list = RefNegeri::find()->where(['=', 'aktif', 1]); // defauilt show all the cawangan
        
        // add filter base on negeri access role in tbl_user->negeri - START
        if(Yii::$app->user->identity->negeri){
            $negeri_access=explode(',',Yii::$app->user->identity->negeri);
            
            $arr_negeri_filter = array();
            
            for($i = 0; $i < count($negeri_access); $i++){
                $arr_negeri = null;
                $arr_negeri = array('id'=>$negeri_access[$i]); 
                    array_push($arr_negeri_filter,$arr_negeri);
            }
            
            $negeri_dd_list = RefNegeri::find()->where(['=', 'aktif', 1])->andFilterWhere(['id'=>$arr_negeri_filter]);
        }
        // add filter base on negeri access role in tbl_user->negeri - END
        
        $negeri_dd_list = $negeri_dd_list->all();
        
        return $negeri_dd_list;
    }
    
    public static function getProfilBadanSukan($param = null){
        
        $bandan_sukan_dd_list = ProfilBadanSukan::find(); // defauilt show all the cawangan
        
        // add filter base on negeri access role in tbl_user->negeri - START
        if(Yii::$app->user->identity->sukan){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('tbl_profil_badan_sukan.jenis_sukan'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            $bandan_sukan_dd_list = ProfilBadanSukan::find()->andFilterWhere(['tbl_profil_badan_sukan.jenis_sukan'=>$arr_sukan_filter]);
        }
        // add filter base on negeri access role in tbl_user->negeri - END
        
        $bandan_sukan_dd_list = $bandan_sukan_dd_list->all();
        
        return $bandan_sukan_dd_list;
    }
	
	public static function getJurulatih($param = null){
        
        $jurulatih_dd_list = Jurulatih::find()->where(['=', 'status_tawaran_mpj', RefStatusTawaran::LULUS_TAWARAN])->andWhere(['=', 'status_tawaran_jkb', RefStatusTawaran::LULUS_TAWARAN]); // defauilt show all lulus mpj and jkb
        
        $jurulatih_dd_list = $jurulatih_dd_list->all();
        
        return $jurulatih_dd_list;
    }
}