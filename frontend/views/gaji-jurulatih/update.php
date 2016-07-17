<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GajiJurulatih */

$this->title = 'Update Gaji Jurulatih: ' . $model->gaji_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Gaji Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gaji_jurulatih_id, 'url' => ['view', 'id' => $model->gaji_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gaji-jurulatih-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
