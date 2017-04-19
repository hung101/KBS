<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianAduan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bahagian_aduan.': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bahagian_aduan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ref-bahagian-aduan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
