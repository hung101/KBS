<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusBantuanPenganjuranKejohanan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_bantuan_penganjuran_kejohanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_bantuan_penganjuran_kejohanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-bantuan-penganjuran-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
