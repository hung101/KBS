<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspPenjamin */

$this->title = 'Tambah Penjamin Biasiswa Sukan Persekutuan';
$this->params['breadcrumbs'][] = ['label' => 'Penjamin Biasiswa Sukan Persekutuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-penjamin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
