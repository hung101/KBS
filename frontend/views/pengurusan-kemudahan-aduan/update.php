<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanAduan */

//$this->title = 'Update Pengurusan Kemudahan Aduan: ' . ' ' . $model->pengurusan_kemudahan_aduan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::kemudahan_aduan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kemudahan_aduan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::kemudahan_aduan, 'url' => ['view', 'id' => $model->pengurusan_kemudahan_aduan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-aduan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
