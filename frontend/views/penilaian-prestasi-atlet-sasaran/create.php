<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPrestasiAtletSasaran */

$this->title = 'Create Penilaian Prestasi Atlet Sasaran';
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Prestasi Atlet Sasarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-prestasi-atlet-sasaran-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
