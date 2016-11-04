<?php
 
namespace console\controllers;
  
use yii\console\Controller;

use app\models\PenilaianPestasi;
use app\models\UserPeranan;
use app\models\PerancanganProgram;
use common\models\User;

use common\models\general\GeneralFunction;
  
/**
 * DailyCron controller
 */
class DailyCronController extends Controller {
  
    public function actionReminderPenilaianPrestasi() {
        echo "Hello i'm index\n";
        
        $modelUsers = null;
        
        if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'peringatan_emel'])->groupBy('id')->all()) !== null) {
        
            if (($modelPenilaianPestasiReminders = PenilaianPestasi::find()->where('tarikh_nilai_mula >= :today', [':today' => GeneralFunction::getCurrentDate()])
                ->andWhere('tarikh_nilai_mula <= :today', [':today' => date()])->all()) !== null) {
                foreach($modelPenilaianPestasiReminders as $modelPenilaianPestasi){
                    foreach($modelUsers as $modelUser){

                        if($modelUser->email && $modelUser->email != ""){
                            $ref = PerancanganProgram::findOne(['perancangan_program_id' => $modelPenilaianPestasi->kejohanan]);
        
                            Yii::$app->mailer->compose()
                            ->setTo($modelUser->email)
                            ->setFrom('noreply@spsb.com')
                            ->setSubject('Peringatan: Penilaian Prestasi Atlet')
                            ->setTextBody("Salam Sejahtera,

Sila membuat penilaian prestasi atlet untuk kejohanan: " . $ref['nama_program'] . ".
sebelum tarikh berikut: " . $modelPenilaianPestasi->tarikh_nilai_tamat . '


"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
        ')->send();
                        }
                    }
                }
            }
        }
    }
     
    public function actionUpdate() {
        echo "Hello i'm update\n";
    }
     
    public function actionGet($name, $address) {
        echo "I'm " . $name . " and live in " . $address . "\n";
    }
     
    public function actionArithmetic($a, $b){
        $c = ($a+$b);
        echo "a + b = " . $c . "\n";
    }
}