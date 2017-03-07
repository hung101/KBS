<?php
use app\models\JurulatihSukan;

use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefJantina;
use app\models\RefSukan;
use app\models\RefBahagianJurulatih;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

if(isset($parentModel->alamat_surat_menyurat_bandar) && $parentModel->alamat_surat_menyurat_bandar != null){
    $ref = RefBandar::findOne(['id' => $parentModel->alamat_surat_menyurat_bandar]);
    $parentModel->alamat_surat_menyurat_bandar = $ref['desc'];
}
if(isset($parentModel->alamat_surat_menyurat_negeri) && $parentModel->alamat_surat_menyurat_negeri != null){
    $ref = RefNegeri::findOne(['id' => $parentModel->alamat_surat_menyurat_negeri]);
    $parentModel->alamat_surat_menyurat_negeri = $ref['desc'];
}
$model->tarikh = date('d F Y',strtotime($model->tarikh));

$sukan = null;
$bahagian = null;
$tarikhMula = null;
$tarikhTamat = null;
$sukanList = JurulatihSukan::find()->where(['jurulatih_id' => $parentModel->jurulatih_id])->orderBy(['tarikh_mula_lantikan' => SORT_DESC])->one();
if(count($sukanList) > 0)
{
    $ref = RefSukan::findOne(['id' => $sukanList->sukan]);
    $sukan = $ref['desc'];
    $ref = RefBahagianJurulatih::findOne(['id' => $sukanList->bahagian]);
    $bahagian = $ref['desc'];
    
    if(isset($sukanList->tarikh_mula_lantikan)){
       $tarikhMula = date('j<\s\u\p>S</\s\u\p> F Y',strtotime($sukanList->tarikh_mula_lantikan));   
    }
    if(isset($sukanList->tarikh_tamat_lantikan)){
       $tarikhTamat = date('j<\s\u\p>S</\s\u\p> F Y',strtotime($sukanList->tarikh_tamat_lantikan));   
    }
}

$selectedDate = null;
if(isset($model->tarikh) && $model->tarikh != null)
{
    $selectedDate = date('d', strtotime($model->tarikh)).' '.GeneralFunction::getMonthWord($model->tarikh, $type = 2).' '.date('Y', strtotime($model->tarikh));
}
?>

<table border="0" align="center">
    <tr>
        <td style="padding-right:10px"><img align="right" src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="100"></td>
        <td valign="top" style="padding-top:10px; text-align:center"><div class="form-title" style="text-decoration:underline">MAJLIS SUKAN NEGARA MALAYSIA</div><br />
        SURAT PERSETUJUAN TERIMA TAWARAN PELANTIKAN SEMULA / KENAIKAN GAJI JURULATIH SEPENUH MASA
        </td>
    </tr>
</table>
<br /><br /><br />
<table border="0" align="left" cellspacing="8">
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td><?= $parentModel->nama ?></td>
    </tr>
    <tr>
        <td valign="top">Alamat Tetap</td>
        <td>:</td>
        <td>
            <?= ($parentModel->alamat_surat_menyurat_1)?$parentModel->alamat_surat_menyurat_1.'<br />':null ?>
            <?= ($parentModel->alamat_surat_menyurat_2)?$parentModel->alamat_surat_menyurat_2.'<br />':null ?>
            <?= ($parentModel->alamat_surat_menyurat_3)?$parentModel->alamat_surat_menyurat_3.'<br />':null ?>
            <?= ($parentModel->alamat_surat_menyurat_poskod)?$parentModel->alamat_surat_menyurat_poskod.'<br />':null ?>
            <?= ($parentModel->alamat_surat_menyurat_bandar)?$parentModel->alamat_surat_menyurat_bandar.'<br />':null ?>
            <?= ($parentModel->alamat_surat_menyurat_negeri)?$parentModel->alamat_surat_menyurat_negeri.'<br />':null ?>
        </td>
    </tr>
        <tr>
        <td>No. Telefon</td>
        <td>:</td>
        <td><?= $parentModel->no_telefon_bimbit ?></td>
    </tr>
    </tr>
        <tr>
        <td>Tarikh</td>
        <td>:</td>
        <td><?= date('d').' '.GeneralFunction::getMonthWord(date('d F Y'), $type = 2).' '.date('Y') ?></td>
    </tr>
    <tr>
        <td valign="top">Kepada</td>
        <td>:</td>
        <td>
            PENGARAH BAHAGIAN KHIDMAT PENGURUSAN<br />
            MAJLIS SUKAN NEGARA MALAYSIA<br />
            KOMPLEKS SUKAN NEGARA<br />
            BUKIT JALIL, SRI PETALING<br />
            57000 KUALA LUMPUR<br />
            <span class="text-bold">(U/P: CAWANGAN SUMBER MANUSIA)</span>
        </td>
    </tr>
</table>

<br />
Tuan,
<p>
    Saya bersetuju menerima Tawaran Pelantikan Semula / Kenaikan Gaji sebagai Jurulatih Sepenuh Masa Sukan <b><?= $sukan ?></b> beserta dengan syarat-syarat lantikan seperti yang dinyatakan di dalam surat rujukan tuan Bil MSNM: <b><?= $model->bil_msnm ?></b> bertarikh <b><?= $selectedDate ?></b>.
</p>

<p>Sekian, terima kasih.</p>
<div class="float-left" style="width:40%">
<p>Yang benar,</p>
<br /><br /><br />
_____________________________________<br /><br />
Tarikh : 
</div>
<div class="float-left" style="width:56%; padding-left:20px">
    <div style="width:100%; border:1px solid">
        <div style="text-align:center;padding:10px 0px 10px">Untuk Kegunaan<br />Cawangan Sumber Manusia</div>
        <div style="border-top:1px solid">
            <table border="0" align="left" cellspacing="8">
                <tr>
                    <td>Diterima Oleh:-</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Nama pegawai</td>
                    <td>:</td>
                    <td>.....................................................</td>
                </tr>
                <tr>
                    <td>Jawatan</td>
                    <td>:</td>
                    <td>.....................................................</td>
                </tr>
                <tr>
                    <td>Tarikh</td>
                    <td>:</td>
                    <td>.....................................................</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="clear"></div>


