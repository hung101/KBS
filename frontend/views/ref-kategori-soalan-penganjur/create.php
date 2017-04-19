<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriSoalanPenganjur */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_soalan_penganjur;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_soalan_penganjur, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-soalan-penganjur-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
