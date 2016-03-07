<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanAcara */

$this->title = 'Tambah Penyertaan Acara Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Penyertaan Acara Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-acara-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
