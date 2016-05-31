<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilDelegasiTeknikal */

$this->title = GeneralLabel::profil_delegasi_teknikal;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_delegasi_teknikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::viewTitle . ' ' . GeneralLabel::profil_delegasi_teknikal;
?>
<div class="profil-delegasi-teknikal-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-delegasi-teknikal']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->profil_delegasi_teknikal_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-delegasi-teknikal']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->profil_delegasi_teknikal_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelProfilDelegasiTeknikalAhli' => $searchModelProfilDelegasiTeknikalAhli,
        'dataProviderProfilDelegasiTeknikalAhli' => $dataProviderProfilDelegasiTeknikalAhli,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'profil_delegasi_teknikal_id',
            'temasya',
            'negeri',
            'tarikh_mula',
            'tarikh_tamat',
            'sukan',
            'peringkat',
            'nama_badan_sukan',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
