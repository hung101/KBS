<?php

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutan */

$this->title = GeneralLabel::createTitle . ' Pelanjutan';
$this->params['breadcrumbs'][] = ['label' => 'Pelanjutan', 'url' => Url::to(['index', 'bsp_pemohon_id' => $bsp_pemohon_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBspPerlanjutanSebab' => $searchModelBspPerlanjutanSebab,
        'dataProviderBspPerlanjutanSebab' => $dataProviderBspPerlanjutanSebab,
        'searchModelBspPerlanjutanDokumen' => $searchModelBspPerlanjutanDokumen,
        'dataProviderBspPerlanjutanDokumen' => $dataProviderBspPerlanjutanDokumen,
        'readonly' => $readonly,
    ]) ?>

</div>
