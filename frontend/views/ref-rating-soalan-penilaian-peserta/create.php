<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefRatingSoalanPenilaianPeserta */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::rating_soalan_penilaian_peserta;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::rating_soalan_penilaian_peserta, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-rating-soalan-penilaian-peserta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
