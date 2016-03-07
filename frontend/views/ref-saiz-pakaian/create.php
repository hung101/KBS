<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSaizPakaian */

$this->title = 'Create Ref Saiz Pakaian';
$this->params['breadcrumbs'][] = ['label' => 'Ref Saiz Pakaians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-saiz-pakaian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
