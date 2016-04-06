<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefLesenKejurulatihan */

$this->title = GeneralLabel::createTitle.' '.'Ref Lesen Kejurulatihan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Lesen Kejurulatihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-lesen-kejurulatihan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
