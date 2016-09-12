<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatBantuanPenganjuranKejohananDianjurkan */

$this->title = 'Create Ref Peringkat Bantuan Penganjuran Kejohanan Dianjurkan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Peringkat Bantuan Penganjuran Kejohanan Dianjurkans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-bantuan-penganjuran-kejohanan-dianjurkan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
