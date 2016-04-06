<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanSenaraiSemak */

//$this->title = $model->senarai_semak_id;
$this->title = GeneralLabel::viewTitle . ' Senarai Semak';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_semak, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-senarai-semak-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->senarai_semak_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->senarai_semak_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'senarai_semak_id',
            'permohonan_e_bantuan_id',
            'kertas_kerja_projek_program',
            'salinan_sijil_pendaftaran_persatuan_pertubuhan',
            'salinan_perlembagaan_persatuan_pertubuhan',
            'salinan_buku_bank',
        ],
    ]);*/ ?>

</div>
