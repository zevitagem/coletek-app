<?php

namespace app\pages\http;

use app\pages\http\BaseUiController;
use app\services\ProcessService;
use app\exceptions\ValidatorException;
use app\requesters\HttpRequester;

class ProcessController extends BaseUiController
{
    public function __construct()
    {
        parent::__construct([
            'has_auth' => false,
            'assets' => []
        ]);

        connectMYSQL();

        $this->setMainService(new ProcessService());
    }

    public function create()
    {
        $this->addCreateAssets();

        $data = $this->service->getDataToCreate();

        parent::view('process/create.php', compact('data'));
    }

    public function store()
    {
        $data = $_POST;
        $status = false;

        try {
            $this->service->handle($data, __FUNCTION__);
            $this->service->validate($data, __FUNCTION__);
            $status = $this->service->store($data);
        } catch (ValidatorException $exc) {
            $message = $exc->getMessage();
        } catch (\Throwable $ex) {
            $message = $ex->getMessage();
        }

        echo json_encode([
            'status' => $status,
            'message' => ($status) ? 'Operação realizada com sucesso!' : $message
        ]);
    }

    public function token()
    {
        $testApi = new HttpRequester();
        $result = $testApi->generateToken();

        dd($result, true);
    }

    public function show()
    {
        $id = $_GET['id'];
        $message = '';

        try {
            $data = $this->service->getDataToShow($id);

            if (!empty($data)) {
                $message = 'Dados encontrados com sucesso.';
                $_SESSION['success_message'] = $message;
            }
        } catch (\Throwable $ex) {
            $data = [];

            $message = $ex->getMessage();
            $_SESSION['error_message'] = $message;
        }

        $data['message'] = $message;

        parent::view('process/show.php', ['data' => $data]);
    }

    public function index()
    {
        $this->addIndexAssets();

        $list = $this->service->getValidObjects();

        parent::view('process/index.php', ['rows' => $list]);
    }
}
