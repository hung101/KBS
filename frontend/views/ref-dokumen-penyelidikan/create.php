<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefDokumenPenyelidikan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::dokumen_penyelidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::dokumen_penyelidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-dokumen-penyelidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
