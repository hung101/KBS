<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsuran */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_insuran.': ' . ' ' . $model->pengurusan_insuran_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_insurans;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_insurans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_insurans, 'url' => ['view', 'id' => $model->pengurusan_insuran_id]];
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="pengurusan-insuran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanInsuranLampiran' => $searchModelPengurusanInsuranLampiran,
        'dataProviderPengurusanInsuranLampiran' => $dataProviderPengurusanInsuranLampiran,
        'readonly' => $readonly,
    ]) ?>

</div>
