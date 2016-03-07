<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspPrestasiSukan */

$this->title = 'Tambah Prestasi Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Prestasi Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-prestasi-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
