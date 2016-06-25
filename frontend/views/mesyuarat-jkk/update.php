<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Mesyuarat */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_mesyuarat_jawatankuasa_kerja_jkk.': ' . ' ' . $model->mesyuarat_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_mesyuarat_jawatankuasa_kerja_jkk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_mesyuarat_jawatankuasa_kerja_jkk, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_mesyuarat_jawatankuasa_kerja_jkk, 'url' => ['view', 'id' => $model->mesyuarat_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
        'SNHsearchModel' => $SNHsearchModel,
        'SNHdataProvider' => $SNHdataProvider,
    ]) ?>

</div>
