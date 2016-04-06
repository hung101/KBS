<?php

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsAhliJawatankuasaKecil */

$this->title =  'Ahli Jawatankuasa Kecil / Biro ';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::ahli_jawatankuasa_kecil_biro_, 'url' => Url::to(['index', 'profil_badan_sukan_id' => $profil_badan_sukan_id])];
$this->params['breadcrumbs'][] = GeneralLabel::createTitle;
?>
<div class="ltbs-ahli-jawatankuasa-kecil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
