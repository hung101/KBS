<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PlDataKlinikal */

//$this->title = $model->pl_data_klinikal_id;
$this->title = GeneralLabel::viewTitle . ' Data Klinikal';
$this->params['breadcrumbs'][] = ['label' => 'Data Klinikal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-data-klinikal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-data-klinikal']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pl_data_klinikal_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-data-klinikal']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pl_data_klinikal_id], [
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
            'pl_data_klinikal_id',
            'atlet_id',
            'penglihatan_tanpa_cermin_mata_kiri',
            'penglihatan_tanpa_cermin_mata_kanan',
            'penglihatan_cermin_mata_kiri',
            'penglihatan_cermin_mata_kanan',
            'usia_kali_pertama_haid',
            'haid_kitaran',
            'status_haid',
            'haid_kali_terakhir_hari_pertama',
            'kali_terakhir_bersalin',
            'bilangan_kanak_kanak',
            'masalah_haid',
            'perokok_tempoh',
            'status_perokok',
            'alkohol',
            'jenis_alkohol',
            'diet_harian',
            'berat_badan_turun',
            'berat_badan_naik',
        ],
    ]);*/ ?>

</div>
