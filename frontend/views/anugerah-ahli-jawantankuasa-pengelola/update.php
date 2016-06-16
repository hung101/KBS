<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahAhliJawantankuasaPengelola */

$this->title = 'Update Anugerah Ahli Jawantankuasa Pengelola: ' . $model->anugerah_ahli_jawantankuasa_pengelola_id;
$this->params['breadcrumbs'][] = ['label' => 'Anugerah Ahli Jawantankuasa Pengelolas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->anugerah_ahli_jawantankuasa_pengelola_id, 'url' => ['view', 'id' => $model->anugerah_ahli_jawantankuasa_pengelola_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anugerah-ahli-jawantankuasa-pengelola-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
