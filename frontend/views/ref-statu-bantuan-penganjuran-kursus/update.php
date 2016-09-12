<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusBantuanPenganjuranKursus */

$this->title = 'Update Ref Status Bantuan Penganjuran Kursus: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Bantuan Penganjuran Kursuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-bantuan-penganjuran-kursus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
