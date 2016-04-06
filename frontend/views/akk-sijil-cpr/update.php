<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AkkSijilCpr */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::akk_sijil_cpr.': ' . ' ' . $model->akk_sijil_cpr_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::akk_sijil_cpr, 'url' => ['index']];
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
