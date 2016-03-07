<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PertukaranPengajian */

//$this->title = $model->pertukaran_pengajian_id;
$this->title = GeneralLabel::viewTitle . ' Pertukaran Pengajian';
$this->params['breadcrumbs'][] = ['label' => 'Pertukaran Pengajian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pertukaran-pengajian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pertukaran-pengajian']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pertukaran_pengajian_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pertukaran-pengajian']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pertukaran_pengajian_id], [
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
            'pertukaran_pengajian_id',
            'atlet_id',
            'sebab_pemohonan',
            'kategori_pengajian',
            'nama_pengajian_sekarang',
            'nama_pertukaran_pengajian',
            'sebab_pertukaran',
            'sebab_penangguhan',
        ],
    ]);*/ ?>

</div>
