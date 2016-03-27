<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AkkSijilPertolonganCemas */

$this->title = 'Update Akk Sijil Pertolongan Cemas: ' . ' ' . $model->akk_sijil_pertolongan_cemas_id;
$this->params['breadcrumbs'][] = ['label' => 'Akk Sijil Pertolongan Cemas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->akk_sijil_pertolongan_cemas_id, 'url' => ['view', 'id' => $model->akk_sijil_pertolongan_cemas_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akk-sijil-pertolongan-cemas-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
