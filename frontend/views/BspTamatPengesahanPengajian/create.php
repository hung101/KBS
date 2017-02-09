<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspTamatPengesahanPengajian */

$this->title = 'Tambah Tamat Pengesahan Pengajian';
$this->params['breadcrumbs'][] = ['label' => 'Tamat Pengesahan Pengajian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-tamat-pengesahan-pengajian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
