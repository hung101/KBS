<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSijilSpkk */

$this->title = 'Create Ref Sijil Spkk';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sijil Spkks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sijil-spkk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
