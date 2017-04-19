<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefSumberKewanganBantuanPenganjuranKejohanan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sumber_kewangan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sumber_kewangan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sumber-kewangan-bantuan-penganjuran-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
