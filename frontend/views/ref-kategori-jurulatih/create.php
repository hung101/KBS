<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
