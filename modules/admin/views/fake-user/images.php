<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Fake Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['/admin/fake-user/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => 'Manage images'];

?>
    <div class="fake-user-view">
        <div>
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => '/admin/fake-user/add-image']); ?>

            <div class="form-group">
                <?= $form->field($model, 'upload[]')
                    ->fileInput(['multiple' => true, 'accept' => 'image/*', 'style'])
                    ->label('') ?>
            </div>
            <div style="display: none;">
                <?= $form->field($model, 'id')->hiddenInput()->label(''); ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            <div style="clear: both">
                <?
                if (!empty($model->images)) {
                    foreach ($model->getImagesArr() as $image) {
                        echo '<div style="float: left; width: 33%">';
                        echo '<form action="/admin/fake-user/delete-image" method="post" style="">';
                        echo '<input type="hidden" value='.$model->id.' name="id">';
                        echo '<input type="hidden" value='.$image.' name="image">';
                        echo '<input id="form-token" type="hidden" name='.Yii::$app->request->csrfParam.' value='.Yii::$app->request->csrfToken.'/>';
                        echo '<button class="btn btn-danger" style="width: 100%">Delete</button>';
                        echo '</form>';
                        echo Html::img(
                            Yii::getAlias('@web') . '/' . $image,
                            [
                                'height' => '350',
                                'width' => '100%',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'title' => $image,
                                'style' =>
                                    [
                                        'padding' => '0 10px',
                                    ],
                            ]
                        );

                        echo '</div>';
                    }
                }
                ?>
                <!--        --><? //
                //        foreach ($model->getImagesArr() as $image){
                //            echo Html::img(Yii::getAlias('@web') . '/' . $image, ['height' => '200', 'width' => '150', 'style' => ['float' => 'right']]);
                //        }
                //        ?>
                <!--        <div>-->
                <!--            <h1>--><? //= Html::encode($this->title) ?><!--</h1>-->
                <!---->
                <!--            <p>-->
                <!--                --><? //= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <!--                --><? //= Html::a('Create account', ['/admin/fake-account/create', 'user_id' => $model->id], ['class' => 'btn btn-success']); ?>
                <!--                --><? //= Html::a('Manage images', ['images', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                <!--                --><? //= Html::a('Delete', ['delete', 'id' => $model->id], [
                //                    'class' => 'btn btn-danger',
                //                    'data' => [
                //                        'confirm' => 'Are you sure you want to delete this item?',
                //                        'method' => 'post',
                //                    ],
                //                ]) ?>
                <!--            </p>-->
                <!--        </div>-->
            </div>
        </div>

    </div>

<?php //$this->registerJsFile(Yii::$app->request->baseUrl . '/js/manageFiles.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
