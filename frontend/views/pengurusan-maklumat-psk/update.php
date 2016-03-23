<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanMaklumatPsk */

//$this->title = 'Update Pengurusan Maklumat Psk: ' . ' ' . $model->pengurusan_maklumat_psk_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_maklumat_psk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_maklumat_psk, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_maklumat_psk, 'url' => ['view', 'id' => $model->pengurusan_maklumat_psk_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-maklumat-psk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
