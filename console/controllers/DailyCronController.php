<?php
 
namespace console\controllers;
  
use Yii;
use yii\console\Controller;

use app\models\PenilaianPestasi;
use app\models\UserPeranan;
use app\models\PerancanganProgram;
use app\models\JurulatihSukan;
use app\models\Jurulatih;
use common\models\User;

use common\models\general\GeneralFunction;
  
/**
 * DailyCron controller
 */
class DailyCronController extends Controller {
  
    public function actionReminderPenilaianPrestasi() { 
        $modelUsers = null;
        
        if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'peringatan_emel_penilaian-pestasi'])->groupBy('id')->all()) !== null) {
        
            if (($modelPenilaianPestasiReminders = PenilaianPestasi::find()->where('tarikh_nilai_mula >= :today', [':today' => GeneralFunction::getCurrentDate()])
                ->andWhere('tarikh_nilai_mula <= :today', [':today' => GeneralFunction::getCurrentDate()])->all()) !== null) {
                foreach($modelPenilaianPestasiReminders as $modelPenilaianPestasi){
                    foreach($modelUsers as $modelUser){

                        if($modelUser->email && $modelUser->email != ""){
                            $ref = PerancanganProgram::findOne(['perancangan_program_id' => $modelPenilaianPestasi->kejohanan]);
                            echo "Penilaian Prestasi E-mail: " . $modelUser->email . "\n";
                            Yii::$app->mailer->compose()
                            ->setTo($modelUser->email)
                            ->setFrom('noreply@spsb.com')
                            ->setSubject('Peringatan: Penilaian Prestasi Atlet')
                            ->setTextBody("Salam Sejahtera,

Sila membuat penilaian prestasi atlet untuk kejohanan berikut: " . $ref['nama_program'] . ".
Sebelum tarikh berikut: " . GeneralFunction::getDatePrintFormat($modelPenilaianPestasi->tarikh_nilai_tamat) . '


"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
        ')->send();
                        }
                    }
                }
            }
        }
        
        // call - send reminder if kontrak jurulatih left less than or equal 30 days function
        $this->reminderKontrakJurulatih();
    }
     
    protected function reminderKontrakJurulatih()
    {
        //send reminder if kontrak jurulatih left less than or equal 30 days
        if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'peringatan_emel_kontrak-jurulatih'])->groupBy('id')->all()) !== null) {
        
            if (($modelJurulatihSukans = JurulatihSukan::find()->orderBy(['tarikh_tamat_lantikan' => SORT_DESC])->groupBy('jurulatih_id')->all()) !== null) {
                foreach($modelJurulatihSukans as $modelJurulatihSukan){
                    $dateMinus = new \DateTime($modelJurulatihSukan->tarikh_tamat_lantikan);
                    $dateMinus->modify('-30 day'); // 30 days before kontrak reminder
                    
                    if($modelJurulatihSukan->tarikh_tamat_lantikan >= GeneralFunction::getCurrentDate() && $dateMinus->format('Y-m-d') <= GeneralFunction::getCurrentDate()){
                    
                        if (($modelJurulatih = Jurulatih::findOne($modelJurulatihSukan->jurulatih_id)) !== null) {
                            foreach($modelUsers as $modelUser){

                                if($modelUser->email && $modelUser->email != ""){
                                    echo "Jurulatih Kontrak E-mail: " . $modelUser->email . "\n";
                                    Yii::$app->mailer->compose()
                                    ->setTo($modelUser->email)
                                    ->setFrom('noreply@spsb.com')
                                    ->setSubject('Peringatan: Jurulatih Yang Akan Tamat Kontrak')
                                    ->setTextBody("Salam Sejahtera,

Jurulatih berikut akan tamat kontrak: 

Nama: " . $modelJurulatih->nama . '
No. K/P: ' . $modelJurulatih->ic_no . '
No. Passport: ' . $modelJurulatih->passport_no . '
Tarikh Tamat Kontrak: ' . GeneralFunction::getDatePrintFormat($modelJurulatihSukan->tarikh_tamat_lantikan) . '


"KE ARAH KECEMERLANGAN SUKAN"
Majlis Sukan Negara Malaysia.
                ')->send();
                                }
                            }
                        }
                    }
                }
            }
            }
    }
     
    public function actionGet($name, $address) {
        echo "I'm " . $name . " and live in " . $address . "\n";
    }
     
    public function actionArithmetic($a, $b){
        $c = ($a+$b);
        echo "a + b = " . $c . "\n";
    }
}