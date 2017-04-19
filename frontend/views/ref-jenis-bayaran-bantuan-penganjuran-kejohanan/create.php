<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisBayaranBantuanPenganjuranKejohanan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_bayaran;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_bayaran, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-bayaran-bantuan-penganjuran-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
