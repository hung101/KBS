<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanBeritaAntarabangsa */

//$this->title = $model->pengurusan_berita_antarabangsa_id;
$this->title = GeneralLabel::viewTitle . ' Pengurusan Berita Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Berita Antarabangsa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-berita-antarabangsa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-berita-antarabangsa']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_berita_antarabangsa_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-berita-antarabangsa']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_berita_antarabangsa_id], [
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
            'pengurusan_berita_antarabangsa_id',
            'kategori_berita',
            'nama_berita',
            'tarikh_berita',
            'muatnaik',
        ],
    ]);*/ ?>

</div>
