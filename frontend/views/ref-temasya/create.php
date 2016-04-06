<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTemasya */

$this->title = GeneralLabel::createTitle.' '.'Ref Temasya';
$this->params['breadcrumbs'][] = ['label' => 'Ref Temasyas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-temasya-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
