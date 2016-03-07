<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ElaunJurulatih */

$this->title = 'Update Elaun Jurulatih: ' . ' ' . $model->elaun_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Elaun Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->elaun_jurulatih_id, 'url' => ['view', 'id' => $model->elaun_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elaun-jurulatih-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
