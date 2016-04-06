<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapPenganjuran */

$this->title = GeneralLabel::createTitle.' '.'Ref Tahap Penganjuran';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tahap Penganjurans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-penganjuran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
