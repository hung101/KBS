<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSoalanPeserta */

$this->title = 'Update Ref Soalan Peserta: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Soalan Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-soalan-peserta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
