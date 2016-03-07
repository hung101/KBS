<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPentadbiranPejabat */

$this->title = GeneralLabel::createTitle . ' Bantuan Pentadbiran Pejabat';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Pentadbiran Pejabat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-pentadbiran-pejabat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelInformasiPermohonan' => $searchModelInformasiPermohonan,
        'dataProviderInformasiPermohonan' => $dataProviderInformasiPermohonan,
        'readonly' => $readonly,
    ]) ?>

</div>
