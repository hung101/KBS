<?php
 
namespace console\controllers;
  
use Yii;
use yii\console\Controller;

use app\models\PenilaianPestasi;
use app\models\UserPeranan;
use app\models\PerancanganProgram;
use app\models\JurulatihSukan;
use app\models\Jurulatih;
use app\models\PengurusanPemantauanDanPenilaianJurulatih;
use app\models\PengurusanPemantauanDanPenilaianJurulatihKetua;
use common\models\User;

use common\models\general\GeneralFunction;
  
/**
 * DailyCron controller
 */
class DailyCronController extends Controller {
  
    public function actionDaily() { 
        // call - send reminder to inform penilaian prestasi need to do via email
        $this->reminderPenilaianPrestasi();
        
        // call - send reminder if kontrak jurulatih left less than or equal 30 days function via email
        $this->reminderKontrakJurulatih();
    }
    
    public function actionMonthly() { 
        // call - send reminder penilaian jurulatih if jurulatih tarikh tamat kontrak left less than 6 months and not yet nilai via email
        $this->reminderPenilaianJurulatih();
    }
    
    protected function reminderPenilaianPrestasi()
    {
        $modelUsers = null;
        
        if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'peringatan_emel_penilaian-pestasi'])->groupBy('id')->all()) !== null) {
        
            if (($modelPenilaianPestasiReminders = PenilaianPestasi::find()->where('tarikh_nilai_tamat >= :today', [':today' => GeneralFunction::getCurrentDate()])
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
    
    protected function reminderPenilaianJurulatih()
    {
        //send reminder penilaian jurulatih if jurulatih tarikh tamat kontrak left less than 6 months and not yet nilai
        if (($modelUsers = User::find()->joinWith('refUserPeranan')->andFilterWhere(['like', 'tbl_user_peranan.peranan_akses', 'peringatan_emel_penilaian-jurulatih'])->groupBy('id')->all()) !== null) {
        
            if (($modelJurulatihSukans = JurulatihSukan::find()->orderBy(['tarikh_tamat_lantikan' => SORT_DESC])->groupBy('jurulatih_id')->all()) !== null) {
                foreach($modelJurulatihSukans as $modelJurulatihSukan){
                    $dateMinus = new \DateTime($modelJurulatihSukan->tarikh_tamat_lantikan);
                    $dateMinus->modify('-6 month'); // 6 months before kontrak reminder
                    
                    echo '\noutside DATE: ' . $dateMinus->format('Y-m-d') . ' - ' . $modelJurulatihSukan->tarikh_tamat_lantikan . ' : ' . $modelJurulatihSukan->jurulatih_id;
                    
                    if($modelJurulatihSukan->tarikh_tamat_lantikan >= GeneralFunction::getCurrentDate() && $dateMinus->format('Y-m-d') <= GeneralFunction::getCurrentDate()){
                        
                        $nilaiYesNo = false;
                        if (($modelJurulatih = PengurusanPemantauanDanPenilaianJurulatih::find()->where('YEAR(tarikh_dinilai) = YEAR(:tarikh_tamat_lantikan)', [':tarikh_tamat_lantikan' => $modelJurulatihSukan->tarikh_tamat_lantikan])->one()) !== null) {
                            $nilaiYesNo = true;
                        }
                        
                        echo 'inside DATE: ' . $dateMinus->format('Y-m-d') . ' - ' . $modelJurulatihSukan->tarikh_tamat_lantikan . ' : ' . $modelJurulatihSukan->jurulatih_id . ' Dinilai: ' . $nilaiYesNo;
                        
                        if (($modelJurulatih = Jurulatih::findOne($modelJurulatihSukan->jurulatih_id)) !== null && $nilaiYesNo == false) {
                            foreach($modelUsers as $modelUser){

                                if($modelUser->email && $modelUser->email != ""){
                                    echo "Jurulatih Penilaian E-mail: " . $modelUser->email . "\n";
                                    Yii::$app->mailer->compose()
                                    ->setTo($modelUser->email)
                                    ->setFrom('noreply@spsb.com')
                                    ->setSubject('Peringatan: Jurulatih Yang Belum Dinilai')
                                    ->setTextBody("Salam Sejahtera,


Jurulatih berikut belum dinilai: 

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