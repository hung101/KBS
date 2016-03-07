<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPerhubunganDalamDanLuarNegaraMesyuarat */

$this->title = 'Tambah Pengurusan Perhubungan Dalam Dan Luar Negara Mesyuarat';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Perhubungan Dalam Dan Luar Negara Mesyuarat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-perhubungan-dalam-dan-luar-negara-mesyuarat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
