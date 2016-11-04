<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\Mesyuarat */

//$this->title = $model->mesyuarat_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_mesyuarat_jawatankuasa_kerja_jkk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_mesyuarat_jawatankuasa_kerja_jkk, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['mesyuarat-jkk']['update']) || isset(Yii::$app->user->identity->peranan_akses['ISN']['mesyuarat']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->mesyuarat_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['mesyuarat-jkk']['delete']) || isset(Yii::$app->user->identity->peranan_akses['ISN']['mesyuarat']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->mesyuarat_id], [
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
        'SNHsearchModel' => $SNHsearchModel,
        'SNHdataProvider' => $SNHdataProvider,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'mesyuarat_id',
            'bil_mesyuarat',
            'tarikh',
            'masa',
            'tempat',
            'pengurusi',
            'pencatat_minit',
            'perkara_perkara_dan_tindakan',
            'mesyuarat_tamat',
            'mesyuarat_seterusnya',
            'disedia_oleh',
            'disemak_oleh',
            'minit_mesyuarat',
        ],
    ])*/ ?>

</div>
