<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPeralatan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_peralatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-peralatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'searchModelPermohonanPeralatanPenggunaan' => $searchModelPermohonanPeralatanPenggunaan,
        'dataProviderPermohonanPeralatanPenggunaan' => $dataProviderPermohonanPeralatanPenggunaan,
    ]) ?>

</div>
