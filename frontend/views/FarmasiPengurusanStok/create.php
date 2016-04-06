<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FarmasiPengurusanStok */

$this->title = GeneralLabel::tambah_pengurusan_stok;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_stok, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-pengurusan-stok-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
