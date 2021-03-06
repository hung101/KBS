<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanSediaAda */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_kemudahan_sedia_ada.': ' . ' ' . $model->pengurusan_kemudahan_sedia_ada_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_kemudahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kemudahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_kemudahan, 'url' => ['view', 'id' => $model->pengurusan_kemudahan_sedia_ada_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-sedia-ada-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
