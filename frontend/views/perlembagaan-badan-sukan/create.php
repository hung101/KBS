<?php

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PerlembagaanBadanSukan */

$this->title = GeneralLabel::perlembagaan_badan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perlembagaan_badan_sukan, 'url' => Url::to(['index', 'profil_badan_sukan_id' => $profil_badan_sukan_id])];
$this->params['breadcrumbs'][] = GeneralLabel::createTitle;
?>
<div class="perlembagaan-badan-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
