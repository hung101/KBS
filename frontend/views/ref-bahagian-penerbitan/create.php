<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianPenerbitan */

$this->title = 'Create Ref Bahagian Penerbitan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Bahagian Penerbitans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bahagian-penerbitan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
