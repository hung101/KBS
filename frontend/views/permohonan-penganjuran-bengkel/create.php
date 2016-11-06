<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPenganjuranBengkel */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_penganjuran_bengkel;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penganjuran_bengkel, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-penganjuran-bengkel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
