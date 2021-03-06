<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJaringanAntarabangsa */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_jaringan_antarabangsa.': ' . ' ' . $model->pengurusan_jaringan_antarabangsa_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_jaringan_antarabangsa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_jaringan_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_jaringan_antarabangsa, 'url' => ['view', 'id' => $model->pengurusan_jaringan_antarabangsa_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jaringan-antarabangsa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelKelayakan' => $searchModelKelayakan,
        'dataProviderKelayakan' => $dataProviderKelayakan,
        'readonly' => $readonly,
    ]) ?>

</div>
