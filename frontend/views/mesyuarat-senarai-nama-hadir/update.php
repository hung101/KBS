<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MesyuaratSenaraiNamaHadir */

$this->title = 'Update Mesyuarat Senarai Nama Hadir: ' . ' ' . $model->senarai_nama_hadir_id;
$this->params['breadcrumbs'][] = ['label' => 'Mesyuarat Senarai Nama Hadirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->senarai_nama_hadir_id, 'url' => ['view', 'id' => $model->senarai_nama_hadir_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mesyuarat-senarai-nama-hadir-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
