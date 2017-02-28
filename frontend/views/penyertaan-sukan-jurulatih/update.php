<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanJurulatih */

$this->title = 'Update Penyertaan Sukan Jurulatih: ' . $model->penyertaan_sukan_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Penyertaan Sukan Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penyertaan_sukan_jurulatih_id, 'url' => ['view', 'id' => $model->penyertaan_sukan_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penyertaan-sukan-jurulatih-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
