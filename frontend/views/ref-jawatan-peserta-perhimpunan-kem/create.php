<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanPesertaPerhimpunanKem */

$this->title = 'Create Ref Jawatan Peserta Perhimpunan Kem';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Peserta Perhimpunan Kems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-peserta-perhimpunan-kem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
