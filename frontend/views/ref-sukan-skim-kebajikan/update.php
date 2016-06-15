<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSukanSkimKebajikan */

$this->title = 'Update Ref Sukan Skim Kebajikan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Sukan Skim Kebajikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-sukan-skim-kebajikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
