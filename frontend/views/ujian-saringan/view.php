<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\UjianSaringan */

//$this->title = $model->ujian_saringan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::maklumat_bakat;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_bakat, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ujian-saringan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['ujian-saringan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->ujian_saringan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['ujian-saringan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->ujian_saringan_id], [
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
            'ujian_saringan_id',
            'nama',
            'sekolah',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'jantina',
            'no_telefon',
            'darjah',
            'berat_badan',
            'ketinggian',
            'tinggi_duduk',
            'panjang_depa',
            'body_mass_index',
            'catatan',
        ],
    ]);*/ ?>

</div>
