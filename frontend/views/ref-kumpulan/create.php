<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKumpulan */

$this->title = 'Create Ref Kumpulan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kumpulans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kumpulan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
