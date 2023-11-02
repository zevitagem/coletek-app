<?php

namespace app\pages\http;

use app\pages\http\BaseUiController;
use app\services\UserService;
use app\exceptions\ValidatorException;
use Throwable;

class UserController extends BaseUiController
{
    public function __construct()
    {
        parent::__construct([
            'has_auth' => false,
            'assets' => []
        ]);

        connectMYSQL();

        $this->setMainService(new UserService());
    }

    public function addFormAssets()
    {
        $this->config['assets']['js'][] = 'app/' . $this->getControllerName() . '/form.js';
        $this->config['assets']['css'][] = 'app/' . $this->getControllerName() . '/form.css';
    }

    public function create()
    {
        $this->addCreateAssets();

        $data = $this->service->getDataToCreate();

        parent::view('user/create.php', compact('data'));
    }

    public function store()
    {
        $data = $_POST;
        $status = false;

        try {
            $this->service->handle($data, __FUNCTION__);
            $this->service->validate($data, __FUNCTION__);
            $status = $this->service->store($data);
            $message = ($status) ? 'Operação realizada com sucesso!' : 'Ocorreu uma falha durante a inserção';
        } catch (ValidatorException $exc) {
            $message = $exc->getMessage();
        } catch (Throwable $exc) {
            $message = includeWithVariables(view('components/validator-messages.php'), [
                'messages' => [$exc->getMessage()]
            ], false);
        }

        echo json_encode([
            'status' => $status,
            'message' => $message,
            'url_callback' => ($status) ? route('user.php') : null
        ]);
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

        parent::view('user/show.php', ['data' => $data]);
    }

    public function index()
    {
        $this->addIndexAssets();

        $list = $this->service->getValidObjects();

        parent::view('user/index.php', ['rows' => $list]);
    }
}
