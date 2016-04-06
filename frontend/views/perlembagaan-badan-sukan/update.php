<?php

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PerlembagaanBadanSukan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::perlembagaan_badan_sukan.': ' . ' ' . $model->perlembagaan_badan_sukan_id;
$this->title =  'Perlembagaan Badan Sukan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perlembagaan_badan_sukan, 'url' => Url::to(['index', 'profil_badan_sukan_id' => $model->profil_badan_sukan_id])];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->perlembagaan_badan_sukan_id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="perlembagaan-badan-sukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
