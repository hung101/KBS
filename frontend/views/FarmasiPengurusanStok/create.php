<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FarmasiPengurusanStok */

$this->title = 'Tambah Pengurusan Stok';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Stok', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-pengurusan-stok-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
