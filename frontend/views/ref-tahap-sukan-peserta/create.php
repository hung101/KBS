<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapSukanPeserta */

$this->title = GeneralLabel::createTitle.' '.'Ref Tahap Sukan Peserta';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tahap Sukan Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-sukan-peserta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
