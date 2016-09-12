<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanAnjuran */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_anjuran.': ' . ' ' . $model->pengurusan_anjuran_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_anjuran;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_anjuran, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_anjuran, 'url' => ['view', 'id' => $model->pengurusan_anjuran_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-anjuran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanAnjuranNegara' => $searchModelPengurusanAnjuranNegara,
        'dataProviderPengurusanAnjuranNegara' => $dataProviderPengurusanAnjuranNegara,
        'readonly' => $readonly,
    ]) ?>

</div>
