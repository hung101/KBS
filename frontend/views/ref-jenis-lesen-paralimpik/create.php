<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisLesenParalimpik */

$this->title = 'Create Ref Jenis Lesen Paralimpik';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Lesen Paralimpiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-lesen-paralimpik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
