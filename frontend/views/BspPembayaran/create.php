<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspPembayaran */

$this->title = 'Tambah Pembayaran Biasiswa Sukan Persekutuan';
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Biasiswa Sukan Persekutuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pembayaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
