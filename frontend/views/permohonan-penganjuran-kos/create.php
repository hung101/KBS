<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPenganjuranKos */

$this->title = 'Tambah Pengurusan Perhimpunan/Kem Kos';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Perhimpunan/Kem Kos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-penganjuran-kos-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
