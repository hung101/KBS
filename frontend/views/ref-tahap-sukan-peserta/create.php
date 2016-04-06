<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapSukanPeserta */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tahap_sukan_peserta;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tahap_sukan_peserta, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-sukan-peserta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
