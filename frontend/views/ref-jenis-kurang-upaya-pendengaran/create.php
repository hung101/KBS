<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKurangUpayaPendengaran */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Kurang Upaya Pendengaran';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Kurang Upaya Pendengarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kurang-upaya-pendengaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
