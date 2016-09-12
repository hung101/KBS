<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatBantuanPenganjuranKejohanan */

$this->title = 'Create Ref Peringkat Bantuan Penganjuran Kejohanan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Peringkat Bantuan Penganjuran Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-bantuan-penganjuran-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
