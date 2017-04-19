<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKursusPenganjuranAkk */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::kategori_kursus_penganjuran." AKK".': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_kursus_penganjuran." AKK", 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ref-kategori-kursus-penganjuran-akk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
