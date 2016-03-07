<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSukan */

$this->title = 'Tambah Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Admin - Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
