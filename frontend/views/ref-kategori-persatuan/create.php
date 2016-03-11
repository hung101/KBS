<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPersatuan */

$this->title = 'Create Ref Kategori Persatuan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Persatuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-persatuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
