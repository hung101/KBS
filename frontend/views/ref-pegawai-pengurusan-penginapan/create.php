<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPegawaiPengurusanPenginapan */

$this->title = GeneralLabel::createTitle.' '.'Ref Pegawai Pengurusan Penginapan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pegawai Pengurusan Penginapans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pegawai-pengurusan-penginapan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
