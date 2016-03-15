<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriProgramLiputanPerubatanSukan */

$this->title = 'Create Ref Kategori Program Liputan Perubatan Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Program Liputan Perubatan Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-program-liputan-perubatan-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
