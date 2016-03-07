<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBiasiswaPenyertaanKejohanan */

$this->title = 'Update Permohonan Ebiasiswa Penyertaan Kejohanan: ' . ' ' . $model->penyertaan_kejohanan_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Ebiasiswa Penyertaan Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penyertaan_kejohanan_id, 'url' => ['view', 'id' => $model->penyertaan_kejohanan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-ebiasiswa-penyertaan-kejohanan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
