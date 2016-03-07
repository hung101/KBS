<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanAnggaranPerbelanjaan */

$this->title = 'Tambah Anggaran Perbelanjaan Program / Aktiviti Yang Dipohon';
$this->params['breadcrumbs'][] = ['label' => 'Anggaran Perbelanjaan Program / Aktiviti Yang Dipohon', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-anggaran-perbelanjaan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
