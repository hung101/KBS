<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BorangPermohonanKem */

$this->title = GeneralLabel::tambah_borang_permohonan_kem;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_permohonan_kem, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-permohonan-kem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
