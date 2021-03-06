<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPegawaiPengurusanPenginapan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::pegawai_pengurusan_penginapan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pegawai_pengurusan_penginapan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pegawai-pengurusan-penginapan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
