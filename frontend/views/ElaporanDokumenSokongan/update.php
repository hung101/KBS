<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanDokumenSokongan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::elaporan_dokumen_sokongan.': ' . ' ' . $model->elaporan_dokumen_sokongan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaporan_dokumen_sokongans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->elaporan_dokumen_sokongan_id, 'url' => ['view', 'id' => $model->elaporan_dokumen_sokongan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elaporan-dokumen-sokongan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
