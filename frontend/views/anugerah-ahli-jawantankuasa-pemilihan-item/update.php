<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanAtlet */

$this->title = 'Update Anugerah Ahli Jawatankuasa Pemilihan Item: ' . $model->anugerah_ahli_jawantankuasa_pemilihan_item_id;
$this->params['breadcrumbs'][] = ['label' => 'Anugerah Ahli Jawatankuasa Pemilihan Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->anugerah_ahli_jawantankuasa_pemilihan_item_id, 'url' => ['view', 'id' => $model->anugerah_ahli_jawantankuasa_pemilihan_item_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anugerah-ahli-jawantankuasa-pemilihan-item-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
