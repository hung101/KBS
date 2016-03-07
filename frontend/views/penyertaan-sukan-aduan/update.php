<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanAduan */

//$this->title = 'Update Penyertaan Sukan Aduan: ' . ' ' . $model->penyertaan_sukan_aduan_id;
$this->title = GeneralLabel::updateTitle . ' Aduan';
$this->params['breadcrumbs'][] = ['label' => 'Aduan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Aduan', 'url' => ['view', 'id' => $model->penyertaan_sukan_aduan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-aduan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
