<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJawatankuasaKhasSukanMalaysia */

//$this->title = 'Update Pengurusan Jawatankuasa Khas Sukan Malaysia: ' . ' ' . $model->pengurusan_jawatankuasa_khas_sukan_malaysia_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_jawatankuasa_khas_sukan_malaysia;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_jawatankuasa_khas_sukan_malaysia, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_jawatankuasa_khas_sukan_malaysia, 'url' => ['view', 'id' => $model->pengurusan_jawatankuasa_khas_sukan_malaysia_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jawatankuasa-khas-sukan-malaysia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli' => $searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli,
        'dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli' => $dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli,
        'readonly' => $readonly,
    ]) ?>

</div>
