<?php

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspPertukaranProgramPengajian */

$this->title = GeneralLabel::createTitle . ' Pertukaran Program Pengajian';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pertukaran_program_pengajian, 'url' => Url::to(['index', 'bsp_pemohon_id' => $bsp_pemohon_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pertukaran-program-pengajian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBspPertukaranProgramPengajianSebab' => $searchModelBspPertukaranProgramPengajianSebab,
        'dataProviderBspPertukaranProgramPengajianSebab' => $dataProviderBspPertukaranProgramPengajianSebab,
        'searchModelBspPertukaranProgramPengajianDokumen' => $searchModelBspPertukaranProgramPengajianDokumen,
        'dataProviderBspPertukaranProgramPengajianDokumen' => $dataProviderBspPertukaranProgramPengajianDokumen,
        'readonly' => $readonly,
    ]) ?>

</div>
