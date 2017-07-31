<?php
use app\models\JurulatihSukan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefJantina;
use app\models\RefSukan;
use app\models\RefBahagianJurulatih;

$model->tarikh = date('d F Y',strtotime($model->tarikh));
$parentModel->jantina = RefJantina::findOne(['id' => $parentModel->jantina])->desc;
$preName = "EN.";
$aftDear = "Tuan";
if($parentModel->jantina != 'Lelaki'){
   $preName = "PN."; 
   $aftDear = "Puan";
}
$sukan = null;
$bahagian = null;
$tarikhMula = null;
$tarikhTamat = null;
$gajiBulanan = null;
$sukanList = JurulatihSukan::find()->where(['jurulatih_id' => $parentModel->jurulatih_id])->orderBy(['tarikh_mula_lantikan' => SORT_DESC])->one();
if(count($sukanList) > 0)
{
    $ref = RefSukan::findOne(['id' => $sukanList->sukan]);
    $sukan = $ref['desc'];
    $ref = RefBahagianJurulatih::findOne(['id' => $sukanList->bahagian]);
    $bahagian = $ref['desc'];
    $gajiBulanan = $sukanList->jumlah;
    
    if(isset($sukanList->tarikh_mula_lantikan)){
       //$tarikhMula = date('j<\s\u\p>S</\s\u\p> F Y',strtotime($sukanList->tarikh_mula_lantikan)); 
        $tarikhMula = date('d', strtotime($sukanList->tarikh_mula_lantikan)).' '.GeneralFunction::getMonthWord($sukanList->tarikh_mula_lantikan, $type = 2).' '.date('Y', strtotime($sukanList->tarikh_mula_lantikan));       
    }
    if(isset($sukanList->tarikh_tamat_lantikan)){
       //$tarikhTamat = date('j<\s\u\p>S</\s\u\p> F Y',strtotime($sukanList->tarikh_tamat_lantikan));
       $tarikhTamat = date('d', strtotime($sukanList->tarikh_tamat_lantikan)).' '.GeneralFunction::getMonthWord($sukanList->tarikh_tamat_lantikan, $type = 2).' '.date('Y', strtotime($sukanList->tarikh_tamat_lantikan)); 
    }
    
}
?>
<table align="right">
    <tr>
        <td>Rujukan MSN</td>
        <td>:</td>
        <td><?= $model->bil_msnm ?></td>
    </tr>
    <tr>
        <td>Tarikh</td>
        <td>:</td>
        <td><?= $model->tarikh ?></td>
    </tr>
</table>

<p class="text-bold">
    <?= $preName.' '.strtoupper($parentModel->nama) ?><br />
    No. K/P: <?= $parentModel->ic_no ?>
</p>
<br />
<?= $aftDear ?>,

<p class="text-bold">
    TAWARAN PELANTIKAN SECARA KONTRAK SEBAGAI <?php echo (($model->jurulatih_status_desc)?$model->jurulatih_status_desc:'JURULATIH');?> DI MAJLIS SUKAN NEGARA MALAYSIA<br />
    - <?= $sukan ?>
</p>

<p>
Dengan hormatnya saya diarah merujuk kepada perkara di atas.
</p>

<p style="text-align:justify">
2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sukacita dimaklumkan bahawa pengurusan Majlis bersetuju melantik <?= strtolower($aftDear) ?> sebagai <b>Jurulatih Sukan <?= $sukan ?></b> secara kontrak sepenuh masa dengan gaji sebanyak <b>RM <?= $gajiBulanan ?></b> sebulan berkuatkuasa mulai <b><?= $tarikhMula ?> hingga <?= $tarikhTamat ?></b>. Syarat kontrak dan kelayakan perkhidmatan <?= strtolower($aftDear) ?> adalah seperti perjanjian kepada surat ini yang disertakan.
</p>

<p style="text-align:justify">
3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sila maklumkan sama ada <?= strtolower($aftDear) ?> menerima atau tidak tawaran ini dalam tempoh <b>empat belas (14)</b> hari dari tarikh surat tawaran ini dengan melengkapkan dan mengembalikan <b>Borang Persetujuan Terima Tawaran (Lampiran A)</b>, <b>Borang AM 402 </b> dan <b>Borang Perjanjian Jurulatih (Coach Agreement)</b>. Tawaran ini dianggap batal jika tiada jawapan diterima daripada <?= strtolower($aftDear) ?> dalam tempoh tersebut.
</p>

<p>Sekian, terima kasih.</p>

<p>'<b>KE ARAH KECEMERLANGAN SUKAN</b>'</p>

<p>Yang Benar,</p>
<br /><br /><br />
.........................................................<br />
<b>(ARRIFIN MOHD GHANI)</b><br />
Pengarah<br />
Bahagian Khidmat Pengurusan<br />
b.p Ketua Pengarah<br />
Majlis Sukan Negara Malaysia<br />
s.k<br />
<ol style="list-style-type: decimal;">
    <li>Pemangku Pengarah Bahagian Pengurusan Sukan</li>
    <li>Pengarah Bahagian Atlet</li>
    <li>Sispen/Gaji</li>
    <?php if($parentModel->no_fail != ""):  ?>
    <li><?=$parentModel->no_fail?></li>
    <?php endif;  ?>
</ol>