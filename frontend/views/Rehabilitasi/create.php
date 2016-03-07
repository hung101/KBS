<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rehabilitasi */

$this->title = 'Tambah Rehabilitasi';
$this->params['breadcrumbs'][] = ['label' => 'Rehabilitasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rehabilitasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
