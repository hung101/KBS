<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BorangAduanKerosakanJenisKerosakan */

$this->title = 'Create Borang Aduan Kerosakan Jenis Kerosakan';
$this->params['breadcrumbs'][] = ['label' => 'Borang Aduan Kerosakan Jenis Kerosakans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-aduan-kerosakan-jenis-kerosakan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
