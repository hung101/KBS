<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriSoalanPeserta */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_soalan_peserta;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_soalan_peserta, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-soalan-peserta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
