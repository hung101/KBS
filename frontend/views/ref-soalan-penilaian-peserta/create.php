<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSoalanPenilaianPeserta */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::soalan_penilaian_peserta;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::soalan_penilaian_peserta, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-soalan-penilaian-peserta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
