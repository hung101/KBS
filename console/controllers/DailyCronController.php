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
use app\models\RefSukan;
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
                ->andWhere('tarikh_nilai_mula <= :today', [':today' => GeneralFunction::getCurrentDate()])->groupBy('penilaian_pestasi_id')->all()) !== null) {
                foreach($modelPenilaianPestasiReminders as $modelPenilaianPestasi){
                    foreach($modelUsers as $modelUser){

                        if($modelUser->email && $modelUser->email != ""){
                            $ref = PerancanganProgram::findOne(['perancangan_program_id' => $modelPenilaianPestasi->kejohanan]);
                            //echo "Penilaian Prestasi E-mail: " . $modelUser->email . "\n";
                            Yii::$app->mailer->compose()
                            ->setTo($modelUser->email)
                            ->setFrom('noreply@spsb.com')
                            ->setSubject('Peringatan: Penilaian Prestasi Atlet')
                            ->setHtmlBody("Salam Sejahtera,<br><br><br>

Sila membuat penilaian prestasi atlet untuk kejohanan berikut: " . $ref['nama_program'] . ". <br>
Sebelum tarikh berikut: " . GeneralFunction::getDatePrintFormat($modelPenilaianPestasi->tarikh_nilai_tamat) . '<br>
<br><br>

"KE ARAH KECEMERLANGAN SUKAN"<br>
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
        //echo "reminderKontrakJurulatih()\n";
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
                                    //echo "Jurulatih Kontrak E-mail: " . $modelUser->email . "\n";

                                    if($modelJurulatihSukan->sukan){
                                        $refSukan = RefSukan::findOne(['id' => $modelJurulatihSukan->sukan]);
                                    }

                                    Yii::$app->mailer->compose()
                                    ->setTo($modelUser->email)
                                    ->setFrom('noreply@spsb.com')
                                    ->setSubject('Peringatan: Jurulatih Yang Akan Tamat Kontrak')
                                    ->setHtmlBody("Assalamualaikum dan Salam Sejahtera,<br><br><br>
<u><b>Penamatan Kontrak Jurulatih</b></u> <br>
     Perkara diatas dirujuk. <br><br>

Berikut merupakan senarai jurulatih yang akan menamatkan kontrak. <br>
<br>
Nama Jurulatih:: " . $modelJurulatih->nama . '<br>
No. Kad Pengenalan: ' . $modelJurulatih->ic_no . '<br>
No. Fail: ' . $modelJurulatih->no_fail . '<br>
Sukan: ' . (isset($refSukan['desc'])?$refSukan['desc']:'') . '<br>
Tarikh Mula Kontrak: ' . GeneralFunction::getDatePrintFormat($modelJurulatihSukan->tarikh_mula_lantikan) . '<br>
Tarikh Tamat Kontrak: ' . GeneralFunction::getDatePrintFormat($modelJurulatihSukan->tarikh_tamat_lantikan) . '
<br><br><br>

"KE ARAH KECEMERLANGAN SUKAN"<br>
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
                    
                    //echo "\n\n outside DATE: " . $dateMinus->format('Y-m-d') . " - " . $modelJurulatihSukan->tarikh_tamat_lantikan . " : " . $modelJurulatihSukan->jurulatih_id;
                    
                    if($modelJurulatihSukan->tarikh_tamat_lantikan >= GeneralFunction::getCurrentDate() && $dateMinus->format('Y-m-d') <= GeneralFunction::getCurrentDate()){
                        
                        $nilaiYesNo = false;
                        if (($modelJurulatih = PengurusanPemantauanDanPenilaianJurulatih::find()->where('YEAR(tarikh_dinilai) = YEAR(:tarikh_tamat_lantikan)', [':tarikh_tamat_lantikan' => $modelJurulatihSukan->tarikh_tamat_lantikan])
                                ->andWhere('nama_jurulatih_dinilai = :jurulatih_id', [':jurulatih_id' => $modelJurulatihSukan->jurulatih_id])->one()) !== null) {
                            $nilaiYesNo = true;
                        }
                        
                        //echo "\n inside DATE: " . $dateMinus->format('Y-m-d') . " - " . $modelJurulatihSukan->tarikh_tamat_lantikan . " : " . $modelJurulatihSukan->jurulatih_id . " Dinilai: " . $nilaiYesNo;
                        
                        if (($modelJurulatih = Jurulatih::findOne($modelJurulatihSukan->jurulatih_id)) !== null && $nilaiYesNo == false) {
                            foreach($modelUsers as $modelUser){

                                if($modelUser->email && $modelUser->email != ""){
                                    //echo "Jurulatih Penilaian E-mail: " . $modelUser->email . "\n";
                                    Yii::$app->mailer->compose()
                                    ->setTo($modelUser->email)
                                    ->setFrom('noreply@spsb.com')
                                    ->setSubject('Peringatan: Jurulatih Yang Belum Dinilai')
                                    ->setHtmlBody("Salam Sejahtera,<br><br>


Jurulatih berikut belum dinilai: <br>
<br>
Nama: " . $modelJurulatih->nama . '<br>
No. K/P: ' . $modelJurulatih->ic_no . '<br>
No. Passport: ' . $modelJurulatih->passport_no . '<br>
Tarikh Tamat Kontrak: ' . GeneralFunction::getDatePrintFormat($modelJurulatihSukan->tarikh_tamat_lantikan) . '<br>
<br><br>

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
}