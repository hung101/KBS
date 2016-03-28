<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianKecederaan */

$this->title = 'Create Ref Bahagian Kecederaan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Bahagian Kecederaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bahagian-kecederaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
