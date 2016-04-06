<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefNamaSukanPersatuanPersekutuandunia */

$this->title = GeneralLabel::createTitle.' '.'Ref Nama Sukan Persatuan Persekutuandunia';
$this->params['breadcrumbs'][] = ['label' => 'Ref Nama Sukan Persatuan Persekutuandunias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-nama-sukan-persatuan-persekutuandunia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
