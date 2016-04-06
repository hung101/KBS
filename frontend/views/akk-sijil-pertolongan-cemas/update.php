<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AkkSijilPertolonganCemas */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::akk_sijil_pertolongan_cemas.': ' . ' ' . $model->akk_sijil_pertolongan_cemas_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::akk_sijil_pertolongan_cemas, 'url' => ['index']];
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
