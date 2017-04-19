<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefSubElemenBantuanPenganjuranKejohanan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sub_elemen_bantuan_penganjuran_kejohanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sub_elemen_bantuan_penganjuran_kejohanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sub-elemen-bantuan-penganjuran-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
