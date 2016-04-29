<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBeratBadan */

$this->title = 'Create Ref Berat Badan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Berat Badans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-berat-badan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
