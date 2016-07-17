<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\ProfilKonsultan */

//$this->title = $model->profil_konsultan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::profil_kaunselor;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_kaunselor, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-konsultan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-konsultan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->profil_konsultan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-konsultan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->profil_konsultan_id], [
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
        'searchModelProfilKonsultanKontrak' => $searchModelProfilKonsultanKontrak,
        'dataProviderProfilKonsultanKontrak' => $dataProviderProfilKonsultanKontrak,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'profil_konsultan_id',
            'nama_konsultan',
            'ic_no',
            'emel',
            'no_bimbit',
            'bidang_konsultansi',
        ],
    ]);*/ ?>

</div>
