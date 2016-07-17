<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihKesihatanMasalah */

$this->title = 'Update Jurulatih Kesihatan Masalah: ' . $model->jurulatih_kesihatan_kesihatan_id;
$this->params['breadcrumbs'][] = ['label' => 'Jurulatih Kesihatan Masalahs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jurulatih_kesihatan_kesihatan_id, 'url' => ['view', 'id' => $model->jurulatih_kesihatan_kesihatan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurulatih-kesihatan-masalah-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
