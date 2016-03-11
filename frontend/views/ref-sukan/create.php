<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSukan */

$this->title = 'Create Ref Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
