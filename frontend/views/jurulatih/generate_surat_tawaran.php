<?php
use app\models\JurulatihSukan;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

// table reference
use app\models\RefJantina;
use app\models\RefSukan;
use app\models\RefBahagianJurulatih;

$model->tarikh = date('d F Y',strtotime($model->tarikh));
$parentModel->jantina = RefJantina::findOne(['id' => $parentModel->jantina])->desc;
$preName = "MR.";
$aftDear = "Sir";
if($parentModel->jantina != 'Lelaki'){
   $preName = "MS."; 
   $aftDear = "Madam";
}
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

<div class="float-left" style="width:14%">
    <img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/kbs-logo2.png" alt="" width="80">
</div>
<div class="float-left" style="width:54%; padding-left:10px">
    <span class="text-bold">MAJLIS SUKAN NEGARA MALAYSIA</span><br />
    <span class="text-bold">NATIONAL SPORTS COUNCIL OF MALAYSIA</span><br />
    (Agensi di bawah Kementerian Belia dan Sukan Malaysia)<br />
    Kompleks Suan Negara, Bukit Jalil, Sri Petaling<br />
    Peti Surat 10440<br />
    57014 KUALA LUMPUR<br />
    MALAYSIA
</div>
<div class="float-left" style="text-align:right">
    <img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="80">
    <div style="text-align:left">
    Tel: 03-89929000/9600/9800<br />
    Faks: 03-89964741<br />
    Laman Web: www.nsc.gov.my
    </div>
</div>
<div class="clear" style="border-bottom:1px solid #000;margin:5px 0px 30px"></div>
<div style="float:right; width:30%">
    <i>MSNM Ref</i> : <?= $model->bil_msnm ?><br />
    <i>Date</i> : <?= $model->tarikh ?>
</div>
<div class="clear" style=""></div>

<div class="text-bold" style="margin:5px 0px 20px">
    <?= $preName.' '.strtoupper($parentModel->nama); ?><br />
    <?= strtoupper($sukan); ?><br />
    <?= strtoupper($bahagian); ?> DIVISION<br />
</div>
Dear <?= $aftDear ?>,<br /><br />
<div class="text-bold" style="text-transform: uppercase; margin-bottom:20px">Appointment As <?= $sukan ?> Coach for athlete training programme</div>

<p style="text-align:justify">
The National Sports Council of Malaysia is pleased to offer you the position as <b>COACH</b> for the sports of <b><?= strtoupper($sukan) ?></b>. This appointment will commence from <b><?= $tarikhMula ?></b> till <b><?= $tarikhTamat ?></b>. This appointment and renewal thereof is subject to the terms and conditions attached and marked as "Standard Terms and Conditions of Appointment".
</p>
<p style="text-align:justify">
2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You are required to undergo a medical examination at any local government or private hospital/clinics using the Medical Examination Report Form herewith attached. All medical expenses incurred shall be borne by you.
</p>
<p style="text-align:justify">
3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Should you decide to accept our offer kindly return the Medical Examination Report Form and the original copy of the Standard Terms and Conditions of Appointment attached herewith duly signed and dated to the National Sports Council of Malaysia within 21 days as the date above.
</p>
<p>Thank you.</p>
<p><b>"TOWARD SPORTS EXCELLENCE"<b/></p>
Yours faithfully,
<br /><br /><br /><br /><br />
.........................................................<br />
<b>(ARRIFIN MOHD GHANI)</b><br />
Director<br />
Management Division<br />
for Director General<br />
National Sports Council of Malaysia