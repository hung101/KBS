<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriGeranJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_geran_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_geran_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-geran-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
