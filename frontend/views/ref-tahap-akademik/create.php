<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapAkademik */

$this->title = 'Create Ref Tahap Akademik';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tahap Akademiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-akademik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
