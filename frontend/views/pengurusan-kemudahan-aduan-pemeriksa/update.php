<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanAduanPemeriksa */

//$this->title = 'Update Pengurusan Kemudahan Aduan Pemeriksa: ' . ' ' . $model->pengurusan_kemudahan_aduan_pemeriksa_id;
$this->title = GeneralLabel::updateTitle . ' Pengurusan Kemudahan Aduan Pemeriksa';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Kemudahan Aduan Pemeriksa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pengurusan Kemudahan Aduan Pemeriksa', 'url' => ['view', 'id' => $model->pengurusan_kemudahan_aduan_pemeriksa_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-aduan-pemeriksa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
