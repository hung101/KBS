<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PlDiagnosisPreskripsiPemeriksaanPenyiasatan */

$this->title = GeneralLabel::tambah_diagnosispreskripsipemeriksaanpenyiasatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::diagnosispreskripsipemeriksaanpenyiasatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-diagnosis-preskripsi-pemeriksaan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
