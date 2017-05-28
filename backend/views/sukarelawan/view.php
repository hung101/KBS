<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\Sukarelawan */

//$this->title = $model->sukarelawan_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::sukarelawan;
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sukarelawan, 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sukarelawan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->sukarelawan_id], ['class' => 'btn btn-primary']) ?>
        <?php /*if(isset(Yii::$app->user->identity->peranan_akses['MSN']['sukarelawan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->sukarelawan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif;*/ ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sukarelawan_id',
            'nama',
            'no_kad_pengenalan',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'tarikh_lahir',
            'jantina',
            'no_tel_bimbit',
            'status',
            'emel',
            'facebook',
            'kebatasan_fizikal',
            'menyatakan_jika_ada_kebatasan_fizikal',
            'kelulusan_akademi',
            'bidang_kepakaran',
            'pekerjaan_semasa',
            'nama_majikan',
            'alamat_majikan_1',
            'alamat_majikan_2',
            'alamat_majikan_3',
            'alamat_majikan_negeri',
            'alamat_majikan_bandar',
            'alamat_majikan_poskod',
            'bidang_diminati',
            'waktu_ketika_diperlukan',
            'menyatakan_waktu_ketika_diperlukan',
            'muatnaik',
            'sukan',
            'kursus_latihan',
        ],
    ]);*/ ?>

</div>
