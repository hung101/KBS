<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefDokumenGeranBantuanGaji */

$this->title = 'Update Ref Dokumen Geran Bantuan Gaji: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Dokumen Geran Bantuan Gajis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-dokumen-geran-bantuan-gaji-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
