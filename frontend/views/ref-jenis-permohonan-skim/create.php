<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPermohonanSkim */

$this->title = 'Create Ref Jenis Permohonan Skim';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Permohonan Skims', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-permohonan-skim-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
