<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPenganjurJkk */

$this->title = 'Create Ref Penganjur Jkk';
$this->params['breadcrumbs'][] = ['label' => 'Ref Penganjur Jkks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-penganjur-jkk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
