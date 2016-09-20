<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBilJkk */

$this->title = 'Create Ref Bil Jkk';
$this->params['breadcrumbs'][] = ['label' => 'Ref Bil Jkks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bil-jkk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
