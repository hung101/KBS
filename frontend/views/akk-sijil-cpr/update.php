<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AkkSijilCpr */

$this->title = 'Update Akk Sijil Cpr: ' . ' ' . $model->akk_sijil_cpr_id;
$this->params['breadcrumbs'][] = ['label' => 'Akk Sijil Cprs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->akk_sijil_cpr_id, 'url' => ['view', 'id' => $model->akk_sijil_cpr_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akk-sijil-cpr-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
