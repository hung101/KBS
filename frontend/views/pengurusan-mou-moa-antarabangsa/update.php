<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanMouMoaAntarabangsa */

//$this->title = 'Update Pengurusan Mou Moa Antarabangsa: ' . ' ' . $model->pengurusan_mou_moa_antarabangsa_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan MOU - MOA Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan MOU - MOA Antarabangsa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan MOU - MOA Antarabangsa', 'url' => ['view', 'id' => $model->pengurusan_mou_moa_antarabangsa_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-mou-moa-antarabangsa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
