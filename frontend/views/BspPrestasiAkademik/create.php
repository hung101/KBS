<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspPrestasiAkademik */

$this->title = 'Tambah Prestasi Akademik';
$this->params['breadcrumbs'][] = ['label' => 'Prestasi Akademik', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-prestasi-akademik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
