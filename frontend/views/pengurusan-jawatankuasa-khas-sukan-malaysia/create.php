<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJawatankuasaKhasSukanMalaysia */

$this->title =  GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_jawatankuasa_khas_sukan_malaysia;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_jawatankuasa_khas_sukan_malaysia, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jawatankuasa-khas-sukan-malaysia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli' => $searchModelPengurusanJawatankuasaKhasSukanMalaysiaAhli,
        'dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli' => $dataProviderPengurusanJawatankuasaKhasSukanMalaysiaAhli,
        'readonly' => $readonly,
    ]) ?>

</div>
