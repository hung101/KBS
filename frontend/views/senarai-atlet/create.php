<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SenaraiAtlet */

$this->title = 'Tambah Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Senarai Atlet', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="senarai-atlet-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
