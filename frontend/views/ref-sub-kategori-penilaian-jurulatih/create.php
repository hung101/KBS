<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSubKategoriPenilaianJurulatih */

$this->title = 'Create Ref Sub Kategori Penilaian Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sub Kategori Penilaian Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sub-kategori-penilaian-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
