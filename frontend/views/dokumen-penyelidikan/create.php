<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DokumenPenyelidikan */

$this->title = GeneralLabel::tambah_dokumen_penyelidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::dokumen_penyelidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dokumen-penyelidikan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
