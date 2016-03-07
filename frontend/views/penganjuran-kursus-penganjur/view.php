<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursusPenganjur */

//$this->title = $model->penganjuran_kursus_penganjur_id;
$this->title = GeneralLabel::viewTitle . ' Penganjuran Kursus : Penganjur';
$this->params['breadcrumbs'][] = ['label' => 'Penganjuran Kursus : Penganjur', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-penganjur-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus-penganjur']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->penganjuran_kursus_penganjur_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penganjuran-kursus-penganjur']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->penganjuran_kursus_penganjur_id], [
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
            'penganjuran_kursus_penganjur_id',
            'kategori_kursus',
            'nama_kursus',
            'kod_kursus',
            'tarikh',
            'tempat',
        ],
    ]);*/ ?>

</div>
