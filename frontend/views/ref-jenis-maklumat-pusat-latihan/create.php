<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisMaklumatPusatLatihan */

$this->title = 'Create Ref Jenis Maklumat Pusat Latihan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Maklumat Pusat Latihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-maklumat-pusat-latihan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
