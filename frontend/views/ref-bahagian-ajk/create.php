<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianAjk */

$this->title = 'Create Ref Bahagian Ajk';
$this->params['breadcrumbs'][] = ['label' => 'Ref Bahagian Ajks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bahagian-ajk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
