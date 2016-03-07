<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksaan */

$this->title = 'Tambah e-Laporan Pelaksaan';
$this->params['breadcrumbs'][] = ['label' => 'e-Laporan Pelaksaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
