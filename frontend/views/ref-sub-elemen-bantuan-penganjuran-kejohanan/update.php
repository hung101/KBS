<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefSubElemenBantuanPenganjuranKejohanan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::sub_elemen_bantuan_penganjuran_kejohanan.': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sub_elemen_bantuan_penganjuran_kejohanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ref-sub-elemen-bantuan-penganjuran-kejohanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
