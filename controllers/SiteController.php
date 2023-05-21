<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\form\Field;
use app\core\Request;
use app\core\Response;
use app\models\Products;
use app\models\Book;
use app\models\Furniture;
use app\models\DVD;

class SiteController extends Controller
{
    public  function plp()
    {
        $product = new Products();
        $allModels = $product->fetchModels();

        return $this->render('product_list', ['allModels' =>  $allModels]);
    }

    public  function addProduct(Request $request)
    {
        $product = new Products();
        if ($request->isPost()) {
            $allModels = [
                'DVD' => new DVD(),
                'Furniture' => new Furniture(),
                'Book' => new Book(),
            ];

            $type = $request->getBody()['type']; //Book
            $product->loadData($request->getBody());
            $product->validate();
            if ($product->hasError('type')) {
                return $this->render('add-product', [
                    'model' => $product
                ]);
            }

            $model = $allModels[$type];
            $model->loadData($request->getBody());

            if ($model->validate() && $model->save()) {
                Application::$app->response->redirect('/');
                exit;
            }

            return $this->render('add-product', [
                'model' => $model
            ]);
        }

        return $this->render('add-product', [
            'model' => $product
        ]);
    }

    public function addAttributeSection(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $allModels = [
                'DVD' => new DVD(),
                'Furniture' => new Furniture(),
                'Book' => new Book(),
            ];
            $type = $request->getBody()['type']; //Book

            $model = $allModels[$type]; //new 'Book'()
            $attributes = $model->spesificAttributes(); // ['weight']
            $field = new Field($model, '');
            $formSection =  $field->getInputs($attributes); // <label> <div class=""></div>
            $data = ['form' => $formSection];
            $response->setStatusCode(200);
            header('Content-type: application/json');
            echo json_encode($data);
        } else {
            $response->setStatusCode(403);
            header('Content-type: application/json');
            $data = ['form' => ''];
            echo json_encode($data);
        }
    }

    public function massDelete(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->getBody();
            $ids = [];
            foreach ($data as $key => $value) {
                if ($value == '0') {
                    continue;
                }
                array_push($ids, $key);
            }
            $product = new Products();
            $product->deleteModels($ids);
            header("Location: /",TRUE);
        }
    }
}
