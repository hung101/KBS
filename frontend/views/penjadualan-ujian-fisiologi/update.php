<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenjadualanUjianFisiologi */

//$this->title = 'Update Penjadualan Ujian Fisiologi: ' . ' ' . $model->penjadualan_ujian_fisiologi_id;
$this->title = GeneralLabel::updateTitle . ' Penjadualan Ujian Fisiologi';
$this->params['breadcrumbs'][] = ['label' => 'Penjadualan Ujian Fisiologi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Penjadualan Ujian Fisiologi', 'url' => ['view', 'id' => $model->penjadualan_ujian_fisiologi_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjadualan-ujian-fisiologi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
