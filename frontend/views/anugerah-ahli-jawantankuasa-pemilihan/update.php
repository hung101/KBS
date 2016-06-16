<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahAhliJawantankuasaPemilihan */

$this->title = 'Update Anugerah Ahli Jawantankuasa Pemilihan: ' . $model->anugerah_ahli_jawantankuasa_pemilihan_id;
$this->params['breadcrumbs'][] = ['label' => 'Anugerah Ahli Jawantankuasa Pemilihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->anugerah_ahli_jawantankuasa_pemilihan_id, 'url' => ['view', 'id' => $model->anugerah_ahli_jawantankuasa_pemilihan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anugerah-ahli-jawantankuasa-pemilihan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
