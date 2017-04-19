<?php
use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapAkademikPegawaiTeknikal */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tahap_akademik;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tahap_akademik, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-akademik-pegawai-teknikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
