<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAgensiJkk */

$this->title = 'Create Ref Agensi Jkk';
$this->params['breadcrumbs'][] = ['label' => 'Ref Agensi Jkks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agensi-jkk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
