<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanKemudahanTicketKapalTerbang */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_kemudahan_ticket_kapal_terbang;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_kemudahan_ticket_kapal_terbang, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-kemudahan-ticket-kapal-terbang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPermohonanKemudahanTicketKapalTerbangSukan' => $searchModelPermohonanKemudahanTicketKapalTerbangSukan,
        'dataProviderPermohonanKemudahanTicketKapalTerbangSukan' => $dataProviderPermohonanKemudahanTicketKapalTerbangSukan,
        'searchModelPermohonanKemudahanTicketKapalTerbangAtlet' => $searchModelPermohonanKemudahanTicketKapalTerbangAtlet,
        'dataProviderPermohonanKemudahanTicketKapalTerbangAtlet' => $dataProviderPermohonanKemudahanTicketKapalTerbangAtlet,
        'searchModelPermohonanKemudahanTicketKapalTerbangJurulatih' => $searchModelPermohonanKemudahanTicketKapalTerbangJurulatih,
        'dataProviderPermohonanKemudahanTicketKapalTerbangJurulatih' => $dataProviderPermohonanKemudahanTicketKapalTerbangJurulatih,
        'searchModelPermohonanKemudahanTicketKapalTerbangPegawai' => $searchModelPermohonanKemudahanTicketKapalTerbangPegawai,
        'dataProviderPermohonanKemudahanTicketKapalTerbangPegawai' => $dataProviderPermohonanKemudahanTicketKapalTerbangPegawai,
        'searchModelPermohonanKemudahanTicketKapalTerbangPengurusSukan' => $searchModelPermohonanKemudahanTicketKapalTerbangPengurusSukan,
        'dataProviderPermohonanKemudahanTicketKapalTerbangPengurusSukan' => $dataProviderPermohonanKemudahanTicketKapalTerbangPengurusSukan,
        'readonly' => $readonly,
    ]) ?>

</div>
