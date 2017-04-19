<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriKursusPenganjuranAkk */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_kursus_penganjuran." AKK";
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_kursus_penganjuran." AKK", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-kursus-penganjuran-akk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
