<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanPeralatanSediaAda */

//$this->title = 'Update Pengurusan Kemudahan Peralatan Sedia Ada: ' . ' ' . $model->pengurusan_kemudahan_peralatan_sedia_ada_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Peralatan';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Peralatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Peralatan', 'url' => ['view', 'id' => $model->pengurusan_kemudahan_peralatan_sedia_ada_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-peralatan-sedia-ada-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
