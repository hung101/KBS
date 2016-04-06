<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapSainsSukan */

$this->title = GeneralLabel::createTitle.' '.'Ref Tahap Sains Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tahap Sains Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-sains-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
