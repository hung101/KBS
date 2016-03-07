<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanSoalanMaklumBalasPeserta */

$this->title = 'Tambah Penilaian Prestasi Kejohanan';
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Prestasi Kejohanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-soalan-maklum-balas-peserta-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
