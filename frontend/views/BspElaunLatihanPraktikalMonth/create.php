<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspElaunLatihanPraktikalMonth */

$this->title = 'Tambah Praktikal';
$this->params['breadcrumbs'][] = ['label' => 'Praktikal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-latihan-praktikal-month-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
