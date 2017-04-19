<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanAcara */

$this->title = GeneralLabel::program;
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pelan, 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-acara-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update-jkk', 'id' => $model->perancangan_program_id], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <?= $this->render('_form_jkk', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'penyertaan_sukan_acara_id',
            'penyertaan_sukan_id',
            'nama_acara',
            'tarikh_acara',
            'keputusan_acara',
            'jumlah_pingat',
            'rekod_baru',
            'catatan_rekod_baru',
        ],
    ]);*/ ?>

</div>
