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
?>

<table border="0" align="center">
    <tr>
        <td style="padding-right:10px"><img align="right" src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="100"></td>
        <td valign="top" style="padding-top:10px; text-align:center"><div class="form-title" style="text-decoration:underline">NATIONAL SPORTS COUNCIL OF MALAYSIA</div><br />
        EMPLOYMENT ACCEPTANCE LETTER<br />(FOREIGN COCH)
        </td>
    </tr>
</table>
<br /><br /><br />
<table border="0" align="left" cellspacing="8">
    <tr>
        <td>Name</td>
        <td>:</td>
        <td><?= $parentModel->nama ?></td>
    </tr>
    <tr>
        <td valign="top">Postal Address</td>
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
        <td>Date</td>
        <td>:</td>
        <td><?= date('d F Y') ?></td>
    </tr>
    <tr>
        <td valign="top">To</td>
        <td>:</td>
        <td>
            DIRECTOR<br />
            MANAGEMENT DIVISION<br />
            NATIONAL SPORTS COUNCIL OF MALAYSIA<br />
            BUKIT JALIL,<br />
            <span style="text-decoration:underline">57000 KUALA LUMPUR</span>
        </td>
    </tr>
</table>

<br />
Dear Sir,
<p>
    I hereby accept your employment offer as <b>COACH</b> and agree to the terms and conditions as mentioned in your letter Reference No: <b><?= $model->bil_msnm ?></b> dated <b><?= $model->tarikh ?></b>. I will report for duty effective from <b><?= $tarikhMula ?></b> - <b><?= $tarikhTamat ?></b>.
</p>
<p>
2.&nbsp;&nbsp;&nbsp;&nbsp;Enclosed herewith the following documents for your further action:-
<table cellspacing="0" cellpadding="5">
    <tr>
        <td>i)</td>
        <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
        <td>Original copy of completed Medical Report Form (attached)</td>
    <tr>
    <tr>
        <td>ii)</td>
        <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
        <td>An original copy of Foreign Coach's Agreement duly signed by the employee and Sports Association (attached)</td>
    <tr>
</table>
</p>
<p>Thank you.</p>
<p>Regards,</p>
<br /><br /><br />
_____________________________________________<br /><br />
Name : <br />
Date : 
