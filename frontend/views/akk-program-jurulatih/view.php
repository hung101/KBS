<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\AkkProgramJurulatih */

//$this->title = $model->akk_program_jurulatih_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::peningkatan_kerjaya_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peningkatan_kerjaya_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-program-jurulatih-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['akk-program-jurulatih']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->akk_program_jurulatih_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['akk-program-jurulatih']['delete'])): ?>
            <?php /*echo Html::a(GeneralLabel::delete, ['delete', 'id' => $model->akk_program_jurulatih_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]);*/ ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['akk-program-jurulatih']['update'])): ?>
            <?= Html::a(GeneralLabel::cetak, ['print', 'id' => $model->akk_program_jurulatih_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelAkkProgramJurulatihPeserta' => $searchModelAkkProgramJurulatihPeserta,
        'dataProviderAkkProgramJurulatihPeserta' => $dataProviderAkkProgramJurulatihPeserta,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'akk_program_jurulatih_id',
            'peningkatan_kerjaya_jurulatih_id',
            'nama_program',
            'tarikh_program',
            'tempat_program',
            'kod_kursus',
            'tahap',
        ],
    ]);*/ ?>

</div>
