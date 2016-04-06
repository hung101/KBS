<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\MuatNaikDokumen */

//$this->title = $model->muat_naik_dokumen_id;
$this->title = GeneralLabel::viewTitle . ' Muat Naik Dokumen';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::muat_naik_dokumen, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muat-naik-dokumen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['muat-naik-dokumen']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->muat_naik_dokumen_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['muat-naik-dokumen']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->muat_naik_dokumen_id], [
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
            'muat_naik_dokumen_id',
            'kategori_muat_naik',
            'muat_naik_dokumen',
            'tarikh_muat_naik',
        ],
    ]);*/ ?>

</div>
