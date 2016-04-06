<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanBantuanPentadbiranPejabat */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_permohonan_bantuan_pentadbiran_pejabat;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_permohonan_bantuan_pentadbiran_pejabat, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-bantuan-pentadbiran-pejabat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
