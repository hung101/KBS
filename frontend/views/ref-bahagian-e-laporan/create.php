<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianELaporan */

$this->title = 'Create Ref Bahagian Elaporan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Bahagian Elaporans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bahagian-elaporan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
