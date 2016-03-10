<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefWaktuKetikaDiperlukanSukarelawan */

$this->title = 'Update Ref Waktu Ketika Diperlukan Sukarelawan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Waktu Ketika Diperlukan Sukarelawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-waktu-ketika-diperlukan-sukarelawan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
