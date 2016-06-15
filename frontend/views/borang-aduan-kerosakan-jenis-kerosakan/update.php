<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BorangAduanKerosakanJenisKerosakan */

$this->title = 'Update Borang Aduan Kerosakan Jenis Kerosakan: ' . $model->borang_aduan_kerosakan_jenis_kerosakan_id;
$this->params['breadcrumbs'][] = ['label' => 'Borang Aduan Kerosakan Jenis Kerosakans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->borang_aduan_kerosakan_jenis_kerosakan_id, 'url' => ['view', 'id' => $model->borang_aduan_kerosakan_jenis_kerosakan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="borang-aduan-kerosakan-jenis-kerosakan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
