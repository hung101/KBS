<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspDokumenSokongan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp_dokumen_sokongan.': ' . ' ' . $model->bsp_dokumen_sokongan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bsp_dokumen_sokongans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_dokumen_sokongan_id, 'url' => ['view', 'id' => $model->bsp_dokumen_sokongan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-dokumen-sokongan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
