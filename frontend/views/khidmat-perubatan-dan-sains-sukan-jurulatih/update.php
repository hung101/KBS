<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KhidmatPerubatanDanSainsSukanJurulatih */

$this->title = 'Update Khidmat Perubatan Dan Sains Sukan Jurulatih: ' . $model->khidmat_perubatan_dan_sains_sukan_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Khidmat Perubatan Dan Sains Sukan Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->khidmat_perubatan_dan_sains_sukan_jurulatih_id, 'url' => ['view', 'id' => $model->khidmat_perubatan_dan_sains_sukan_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="khidmat-perubatan-dan-sains-sukan-jurulatih-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
