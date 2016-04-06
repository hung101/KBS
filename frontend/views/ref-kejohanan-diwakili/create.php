<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKejohananDiwakili */

$this->title = GeneralLabel::createTitle.' '.'Ref Kejohanan Diwakili';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kejohanan Diwakilis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kejohanan-diwakili-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
