<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefRatingSoalanPenilaianPeserta */

$this->title = 'Update Ref Rating Soalan Penilaian Peserta: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Rating Soalan Penilaian Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-rating-soalan-penilaian-peserta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
