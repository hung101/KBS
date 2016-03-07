<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BiomekanikUjian */

$this->title = 'Tambah Ujian Biomekanik';
$this->params['breadcrumbs'][] = ['label' => 'Ujian Biomekanik', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biomekanik-ujian-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
