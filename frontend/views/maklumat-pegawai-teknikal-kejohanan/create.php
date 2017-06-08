<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MaklumatPegawaiTeknikalKejohanan */

$this->title = 'Create Maklumat Pegawai Teknikal Kejohanan';
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Pegawai Teknikal Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-pegawai-teknikal-kejohanan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
