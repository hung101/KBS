<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBiasiswaPenyertaanKejohanan */

$this->title = GeneralLabel::tambah_penyertaan_kejohanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penyertaan_kejohanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebiasiswa-penyertaan-kejohanan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
