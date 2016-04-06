<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKejohanan */

$this->title = GeneralLabel::createTitle.' '.'Ref Kejohanan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
