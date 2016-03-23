<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\Kursus */

//$this->title = $model->kursus_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::cce;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::akademi_kejurulatihan_kebangsaan_akk, 'url' => ['akademi-akk/index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::cce, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kursus-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['kursus']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->kursus_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['kursus']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->kursus_id], [
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
            'kursus_id',
            'nama_kursus',
            'tempat',
            'tarikh',
            'penganjur',
            'kod_kursus',
            'pengkhususan',
        ],
    ]);*/ ?>

</div>
