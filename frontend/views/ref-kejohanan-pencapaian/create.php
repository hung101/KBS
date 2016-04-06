<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKejohananPencapaian */

$this->title = GeneralLabel::createTitle.' '.'Ref Kejohanan Pencapaian';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kejohanan Pencapaians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kejohanan-pencapaian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
