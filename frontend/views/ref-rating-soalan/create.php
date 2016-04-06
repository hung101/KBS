<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefRatingSoalan */

$this->title = GeneralLabel::createTitle.' '.'Ref Rating Soalan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Rating Soalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-rating-soalan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
