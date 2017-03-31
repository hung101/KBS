<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahAhliJawantankuasaPengelola */

//$this->title = 'Update Anugerah Ahli Jawantankuasa Pengelola: ' . $model->anugerah_ahli_jawantankuasa_pengelola_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::anugerah_ahli_jawantankuasa_pengelola;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_ahli_jawantankuasa_pengelola, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::anugerah_ahli_jawantankuasa_pengelola, 'url' => ['view', 'id' => $model->anugerah_ahli_jawantankuasa_pengelola_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-ahli-jawantankuasa-pengelola-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
        'searchModelAnugerahAhliJawantankuasaPengelolaItem' => $searchModelAnugerahAhliJawantankuasaPengelolaItem,
        'dataProviderAnugerahAhliJawantankuasaPengelolaItem' => $dataProviderAnugerahAhliJawantankuasaPengelolaItem,
    ]) ?>

</div>
