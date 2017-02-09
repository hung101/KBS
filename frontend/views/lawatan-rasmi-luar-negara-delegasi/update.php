<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LawatanRasmiLuarNegaraDelegasi */

$this->title = 'Update Lawatan Rasmi Luar Negara Delegasi: ' . $model->lawatan_rasmi_luar_negara_delegasi_id;
$this->params['breadcrumbs'][] = ['label' => 'Lawatan Rasmi Luar Negara Delegasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->lawatan_rasmi_luar_negara_delegasi_id, 'url' => ['view', 'id' => $model->lawatan_rasmi_luar_negara_delegasi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lawatan-rasmi-luar-negara-delegasi-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
