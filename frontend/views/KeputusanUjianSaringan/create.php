<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KeputusanUjianSaringan */

$this->title = 'Tambah Keputusan Ujian Saringan';
$this->params['breadcrumbs'][] = ['label' => 'Keputusan Ujian Saringan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keputusan-ujian-saringan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
