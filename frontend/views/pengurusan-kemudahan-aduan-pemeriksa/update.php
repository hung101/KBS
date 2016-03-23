<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanAduanPemeriksa */

//$this->title = 'Update Pengurusan Kemudahan Aduan Pemeriksa: ' . ' ' . $model->pengurusan_kemudahan_aduan_pemeriksa_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pengurusan_kemudahan_aduan_pemeriksa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kemudahan_aduan_pemeriksa, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_kemudahan_aduan_pemeriksa, 'url' => ['view', 'id' => $model->pengurusan_kemudahan_aduan_pemeriksa_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-aduan-pemeriksa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
