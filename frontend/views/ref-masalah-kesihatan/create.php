<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefMasalahKesihatan */

$this->title = GeneralLabel::createTitle.' '.'Ref Masalah Kesihatan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Masalah Kesihatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-masalah-kesihatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
