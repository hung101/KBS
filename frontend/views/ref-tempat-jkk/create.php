<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTempatJkk */

$this->title = 'Create Ref Tempat Jkk';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tempat Jkks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tempat-jkk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
