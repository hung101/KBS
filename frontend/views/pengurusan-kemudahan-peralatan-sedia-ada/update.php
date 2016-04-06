<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanPeralatanSediaAda */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_kemudahan_peralatan_sedia_ada.': ' . ' ' . $model->pengurusan_kemudahan_peralatan_sedia_ada_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_peralatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_peralatan, 'url' => ['view', 'id' => $model->pengurusan_kemudahan_peralatan_sedia_ada_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-peralatan-sedia-ada-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
