<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriGeranJurulatih */

$this->title = GeneralLabel::createTitle.' '.'Ref Kategori Geran Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Geran Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-geran-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
