<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanPengawaiTeknikal */

$this->title = 'Update Ref Jawatan Pengawai Teknikal: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Pengawai Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jawatan-pengawai-teknikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
