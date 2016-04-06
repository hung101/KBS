<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPasukanPenyelidikan */

$this->title = GeneralLabel::createTitle.' '.'Ref Pasukan Penyelidikan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pasukan Penyelidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pasukan-penyelidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
