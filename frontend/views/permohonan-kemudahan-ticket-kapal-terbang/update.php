<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbang */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_kemudahan_ticket_kapal_terbang.': ' . ' ' . $model->permohonan_kemudahan_ticket_kapal_terbang_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_kemudahan_ticket_kapal_terbang;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_kemudahan_ticket_kapal_terbang, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_kemudahan_ticket_kapal_terbang, 'url' => ['view', 'id' => $model->permohonan_kemudahan_ticket_kapal_terbang_id]];
//$this->params['breadcrumbs'][] = 'Update';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
