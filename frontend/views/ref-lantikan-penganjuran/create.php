<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefLantikanPenganjuran */

$this->title = GeneralLabel::createTitle.' '.'Ref Lantikan Penganjuran';
$this->params['breadcrumbs'][] = ['label' => 'Ref Lantikan Penganjurans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-lantikan-penganjuran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
