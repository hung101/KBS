<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AkkSijilPertolonganCemas */

$this->title = 'Create Akk Sijil Pertolongan Cemas';
$this->params['breadcrumbs'][] = ['label' => 'Akk Sijil Pertolongan Cemas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-sijil-pertolongan-cemas-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
