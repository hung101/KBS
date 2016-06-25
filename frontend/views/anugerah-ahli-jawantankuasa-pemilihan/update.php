<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahAhliJawantankuasaPemilihan */

//$this->title = 'Update Anugerah Ahli Jawantankuasa Pemilihan: ' . $model->anugerah_ahli_jawantankuasa_pemilihan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::anugerah_ahli_jawantankuasa_pemilihan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_ahli_jawantankuasa_pemilihan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::anugerah_ahli_jawantankuasa_pemilihan, 'url' => ['view', 'id' => $model->anugerah_ahli_jawantankuasa_pemilihan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-ahli-jawantankuasa-pemilihan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
