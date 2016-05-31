<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;

use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\Atlet */

$disabledTabs = '';

if($this->context->action->id == "create"){
    $disabledTabs = 'disabled';
}

$this->title = GeneralLabel::jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-create">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="panel panel-danger">
        <div class="panel-body">
            <strong>Semak Dokumen</strong>
        </div>
        <ul >
            <li >Surat sokongan daripada PSK atau kelulusan Mesyuarat Jawatan Kuasa Kerja (JKK).</li>
            <li >Surat Permohonan rasmi daripada jurulatih.</li>
            <li >Resume Jurulatih.</li>
            <li >Gambar berwarna ukuran passport.</li>
            <li >Salinan kad pengenalan / passport.</li>
            <li >Salinan Sijil Akademik Jurulatih.</li>
            <li >Salinan Sijil Pendidikan Kejurulatihan.</li>
            <li >Salinan Sijil Skim Persijilan Kejurulatihan Kebangsaan (SPKK) terkini. (Kursus Sains Sukan dan Kursus Sukan Spesifik)</li>
          </ul>
    </div>
    
    <?php
 
    $items = [
        [
            'label'=>'<i class="glyphicon glyphicon-user"></i> Peribadi',
            'content'=>$this->render('_form', [
                'model' => $model,
                'readonly' => $readonly,
            ]),
            'active'=>true,
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-bookmark"></i> Kelayakan',
            'options' => ['id' => GeneralVariable::tabKelayakanID],
            'linkOptions'=>['data-url'=>Url::to(['/jurulatih-spkk','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-tasks"></i> Pengalaman',
            'options' => ['id' => GeneralVariable::tabPengalamanID],
            'linkOptions'=>['data-url'=>Url::to(['/jurulatih-pengalaman','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-education"></i> Pendidikan',
            'options' => ['id' => GeneralVariable::tabPendidikanJurulatihID],
            'linkOptions'=>['data-url'=>Url::to(['/jurulatih-pendidikan','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-certificate"></i> Kelayakan Kursus Tertinggi',
            'options' => ['id' => GeneralVariable::tabKelayakanKursusTertinggiID],
            'linkOptions'=>['data-url'=>Url::to(['/jurulatih-kursus-tertinggi','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-tint"></i> Maklumat Kesihatan',
            'options' => ['id' => GeneralVariable::tabKesihatanID],
            'linkOptions'=>['data-url'=>Url::to(['/jurulatih-kesihatan','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-heart"></i> Maklumat Keluarga',
            'options' => ['id' => GeneralVariable::tabKeluargaJurulatihID],
            'linkOptions'=>['data-url'=>Url::to(['/jurulatih-keluarga','typeJson'=>'1'])],
            'headerOptions' => ['class'=>$disabledTabs]
        ],
    ];

// Above
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_ABOVE,
    'bordered'=>true,
    'encodeLabels'=>false,
]);

?>

</div>
