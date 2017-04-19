<?php
use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefAcara */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_pegawai_teknikal;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_pegawai_teknikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pengawai-teknikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
