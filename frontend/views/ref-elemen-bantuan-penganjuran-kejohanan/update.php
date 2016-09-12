<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefElemenBantuanPenganjuranKejohanan */

$this->title = 'Update Ref Elemen Bantuan Penganjuran Kejohanan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Elemen Bantuan Penganjuran Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-elemen-bantuan-penganjuran-kejohanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
