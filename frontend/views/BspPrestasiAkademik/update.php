<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspPrestasiAkademik */

$this->title = 'Update Bsp Prestasi Akademik: ' . ' ' . $model->bsp_prestasi_akademik_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Prestasi Akademiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_prestasi_akademik_id, 'url' => ['view', 'id' => $model->bsp_prestasi_akademik_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-prestasi-akademik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
