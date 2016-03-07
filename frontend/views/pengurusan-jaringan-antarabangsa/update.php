<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJaringanAntarabangsa */

//$this->title = 'Update Pengurusan Jaringan Antarabangsa: ' . ' ' . $model->pengurusan_jaringan_antarabangsa_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Jaringan Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Jaringan Antarabangsa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Jaringan Antarabangsa', 'url' => ['view', 'id' => $model->pengurusan_jaringan_antarabangsa_id]];
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
