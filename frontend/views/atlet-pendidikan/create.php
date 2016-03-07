<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AtletPendidikan */

$this->title = 'Tambah Pendidikan';
//$this->params['breadcrumbs'][] = ['label' => 'Atlet Pendidikans', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pendidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
