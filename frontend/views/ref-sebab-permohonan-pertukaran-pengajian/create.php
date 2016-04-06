<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSebabPermohonanPertukaranPengajian */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sebab_permohonan_pertukaran_pengajian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sebab_permohonan_pertukaran_pengajian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sebab-permohonan-pertukaran-pengajian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
