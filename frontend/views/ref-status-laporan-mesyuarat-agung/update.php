<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusLaporanMesyuaratAgung */

$this->title = 'Update Ref Status Laporan Mesyuarat Agung: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Laporan Mesyuarat Agungs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-laporan-mesyuarat-agung-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
