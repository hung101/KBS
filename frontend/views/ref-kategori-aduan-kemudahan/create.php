<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriAduanKemudahan */

$this->title = 'Create Ref Kategori Aduan Kemudahan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategori Aduan Kemudahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-aduan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
