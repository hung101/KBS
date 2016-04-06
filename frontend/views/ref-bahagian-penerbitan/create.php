<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianPenerbitan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::bahagian_penerbitan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bahagian_penerbitan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bahagian-penerbitan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
