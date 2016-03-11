<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisSukanPersatuanPersekutuandunia */

$this->title = 'Create Ref Jenis Sukan Persatuan Persekutuandunia';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Sukan Persatuan Persekutuandunias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-sukan-persatuan-persekutuandunia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
