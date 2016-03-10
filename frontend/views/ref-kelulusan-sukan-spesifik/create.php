<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanSukanSpesifik */

$this->title = 'Create Ref Kelulusan Sukan Spesifik';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kelulusan Sukan Spesifiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-sukan-spesifik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
