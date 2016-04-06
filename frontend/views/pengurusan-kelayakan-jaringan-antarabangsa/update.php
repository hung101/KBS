<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKelayakanJaringanAntarabangsa */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_kelayakan_jaringan_antarabangsa.': ' . ' ' . $model->pengurusan_kelayakan_jaringan_antarabangsa_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kelayakan_jaringan_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_kelayakan_jaringan_antarabangsa_id, 'url' => ['view', 'id' => $model->pengurusan_kelayakan_jaringan_antarabangsa_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-kelayakan-jaringan-antarabangsa-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
