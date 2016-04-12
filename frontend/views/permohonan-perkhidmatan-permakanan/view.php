<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPerkhidmatanPermakanan */

//$this->title = $model->permohonan_perkhidmatan_permakanan_id;
$this->title = GeneralLabel::viewTitle .' '.GeneralLabel::permohonan_perkhidmatan_permakanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_perkhidmatan_permakanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-perkhidmatan-permakanan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-permakanan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_perkhidmatan_permakanan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['permohonan-perkhidmatan-permakanan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_perkhidmatan_permakanan_id], [
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
            'permohonan_perkhidmatan_permakanan_id',
            'atlet_id',
            'tarikh',
            'sukan',
            'tujuan',
            'kategori_permohonan',
            'jenis_perkhidmatan',
            'kelulusan',
        ],
    ]);*/ ?>

</div>
