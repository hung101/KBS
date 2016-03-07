<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanAduanKerosakan */

$this->title = 'Update Pengurusan Kemudahan Aduan Kerosakan: ' . ' ' . $model->pengurusan_kemudahan_aduan_kerosakan_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Kemudahan Aduan Kerosakans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_kemudahan_aduan_kerosakan_id, 'url' => ['view', 'id' => $model->pengurusan_kemudahan_aduan_kerosakan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-kemudahan-aduan-kerosakan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
