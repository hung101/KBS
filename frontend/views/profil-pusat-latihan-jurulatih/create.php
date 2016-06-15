<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProfilPusatLatihanJurulatih */

$this->title = 'Create Profil Pusat Latihan Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Profil Pusat Latihan Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-pusat-latihan-jurulatih-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
