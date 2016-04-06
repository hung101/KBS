<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPasukanPenyelidikan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::pasukan_penyelidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pasukan_penyelidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pasukan-penyelidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
