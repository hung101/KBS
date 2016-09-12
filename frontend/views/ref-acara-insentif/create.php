<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAcaraInsentif */

$this->title = 'Create Ref Acara Insentif';
$this->params['breadcrumbs'][] = ['label' => 'Ref Acara Insentifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-acara-insentif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
