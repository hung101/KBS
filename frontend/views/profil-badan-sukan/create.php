<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\ProfilBadanSukan */

$this->title = GeneralLabel::profil_badan_sukan;
$this->params['breadcrumbs'][] = (Yii::$app->user->identity->jabatan_id!=app\models\RefJabatanUser::MSN) ? ['label' => GeneralLabel::profil_badan_sukan, 'url' => ['index']] : ['label' => GeneralLabel::pengurusan_maklumat_psk, 'url' => ['index-msn']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-badan-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
