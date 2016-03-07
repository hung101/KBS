<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanSediaAda */

//$this->title = 'Update Pengurusan Kemudahan Sedia Ada: ' . ' ' . $model->pengurusan_kemudahan_sedia_ada_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Kemudahan';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Kemudahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Kemudahan', 'url' => ['view', 'id' => $model->pengurusan_kemudahan_sedia_ada_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-sedia-ada-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
