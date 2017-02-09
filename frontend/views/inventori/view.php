<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\Inventori */

$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::inventori;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::inventori, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventori-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['inventori']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->inventori_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['inventori']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->inventori_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?= Html::button(GeneralLabel::print_pdf, [ 'class' => 'btn btn-info',
            'onclick' => 'if(confirm("'.GeneralMessage::confirmPrint.'")){window.print();}' ]); ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelInventoriPeralatan' => $searchModelInventoriPeralatan,
        'dataProviderInventoriPeralatan' => $dataProviderInventoriPeralatan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'inventori_id',
            'tarikh',
            'program',
            'sukan',
            'no_co',
            'alamat_pembekal_1',
            'alamat_pembekal_2',
            'alamat_pembekal_3',
            'alamat_pembekal_negeri',
            'alamat_pembekal_bandar',
            'alamat_pembekal_poskod',
            'perkara:ntext',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
