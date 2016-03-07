<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\FarmasiPermohonanLiputanPerubatanSukan */

//$this->title = 'Update Farmasi Permohonan Liputan Perubatan Sukan: ' . ' ' . $model->permohonan_liputan_perubatan_sukan_id;
$this->title = GeneralLabel::updateTitle . ' Permohonan Liputan Perubatan Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Liputan Perubatan Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Permohonan Liputan Perubatan Sukan', 'url' => ['view', 'id' => $model->permohonan_liputan_perubatan_sukan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-permohonan-liputan-perubatan-sukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
