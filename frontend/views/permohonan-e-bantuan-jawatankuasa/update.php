<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanJawatankuasa */

$this->title = 'Update Permohonan Ebantuan Jawatankuasa: ' . ' ' . $model->jawatankuasa_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Ebantuan Jawatankuasas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jawatankuasa_id, 'url' => ['view', 'id' => $model->jawatankuasa_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-ebantuan-jawatankuasa-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
