<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PertukaranPengajian */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pertukaran_pengajian.': ' . ' ' . $model->pertukaran_pengajian_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pertukaran_pengajian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pertukaran_pengajian, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pertukaran_pengajian, 'url' => ['view', 'id' => $model->pertukaran_pengajian_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pertukaran-pengajian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
