<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\UserPeranan;

/* @var $this yii\web\View */
/* @var $model app\models\BspBendahariIpt */

//$this->title = $model->bsp_bendahari_ipt_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::profil_ppn;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::profil_ppn, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-e-bantuan-profil_ppn-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-ppn']['update']) && ((Yii::$app->user->identity->peranan && Yii::$app->user->identity->peranan == UserPeranan::PERANAN_MSN_PPN &&
                                $model->id == Yii::$app->user->identity->id) || Yii::$app->user->identity->peranan != UserPeranan::PERANAN_MSN_PPN)): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-ppn']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->id], [
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
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bsp_bendahari_ipt_id',
            'nama_pelajar',
            'no_kad_pengenalan',
            'no_uni_matrix',
            'yuran_pengajian',
        ],
    ]);*/ ?>

</div>
