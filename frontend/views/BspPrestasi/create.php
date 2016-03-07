<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspPrestasi */

$this->title = 'Tambah Prestasi Semester';
$this->params['breadcrumbs'][] = ['label' => 'Prestasi Semester', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-prestasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
