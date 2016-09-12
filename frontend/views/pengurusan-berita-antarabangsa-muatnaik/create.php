<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanBeritaAntarabangsaMuatnaik */

$this->title = 'Create Pengurusan Berita Antarabangsa Muatnaik';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Berita Antarabangsa Muatnaiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-berita-antarabangsa-muatnaik-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
