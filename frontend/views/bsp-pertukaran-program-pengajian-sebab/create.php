<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspPertukaranProgramPengajianSebab */

$this->title = GeneralLabel::createTitle . ' Sebab Pertukaran Program Pengajian';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sebab_pertukaran_program_pengajian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pertukaran-program-pengajian-sebab-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
