<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaanGambar */

$this->title = 'Tambah Gambar';
$this->params['breadcrumbs'][] = ['label' => 'Gambar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-gambar-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
