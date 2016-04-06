<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutanDokumen */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp_perlanjutan_dokumen.': ' . ' ' . $model->bsp_perlanjutan_dokumen_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bsp_perlanjutan_dokumens, 'url' => ['index']];
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
