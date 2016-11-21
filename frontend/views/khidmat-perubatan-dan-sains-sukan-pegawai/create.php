<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KhidmatPerubatanDanSainsSukanPegawai */

$this->title = 'Create Khidmat Perubatan Dan Sains Sukan Pegawai';
$this->params['breadcrumbs'][] = ['label' => 'Khidmat Perubatan Dan Sains Sukan Pegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khidmat-perubatan-dan-sains-sukan-pegawai-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
