<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutanDokumen */

$this->title = 'Update Bsp Perlanjutan Dokumen: ' . ' ' . $model->bsp_perlanjutan_dokumen_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Perlanjutan Dokumens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_perlanjutan_dokumen_id, 'url' => ['view', 'id' => $model->bsp_perlanjutan_dokumen_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-perlanjutan-dokumen-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
