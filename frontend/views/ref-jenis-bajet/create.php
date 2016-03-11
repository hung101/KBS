<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisBajet */

$this->title = 'Create Ref Jenis Bajet';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Bajets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-bajet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
