<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPertandinganTemasya */

$this->title = 'Create Ref Pertandingan Temasya';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pertandingan Temasyas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pertandingan-temasya-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
