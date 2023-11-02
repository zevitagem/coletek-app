<?php

namespace app\pages\http;

use app\pages\http\AbstractUiController;
use app\services\UserService;
use app\exceptions\ValidatorException;
use Throwable;

class UserController extends AbstractUiController
{
    public function __construct()
    {
        parent::__construct([
            'has_auth' => false,
            'assets' => []
        ]);

        $this->setService(new UserService());
        $this->service->configure();
    }

    public function addFormAssets()
    {
        $this->config['assets']['js'][] = 'app/' . $this->getControllerName() . '/form.js';
        $this->config['assets']['css'][] = 'app/' . $this->getControllerName() . '/form.css';
    }

    public function create()
    {
        $data = [];
        $message = '';

        try {
            $data = $this->service->getCreateData();
            $this->addCreateAssets();
        } catch (Throwable $exc) {
            $message = includeWithVariables(view('components/validator-messages.php'), [
                'messages' => [$exc->getMessage()]
            ], false);
        }

        parent::view('user/create.php', compact('data', 'message'));
    }

    public function store()
    {
        $data = $_POST;
        $status = false;

        try {
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

    public function update()
    {
        $data = $_POST;
        $status = false;

        try {
            $status = $this->service->update($data);
            $message = ($status) ? 'Operação realizada com sucesso!' : 'Ocorreu uma falha durante a atualização';
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
        $data = [];

        try {
            $data = $this->service->getShowData($id);
            $this->addShowAssets();
        } catch (ValidatorException $exc) {
            $messages = $exc->getValidatorErrors();
            $message = includeWithVariables(view('components/validator-messages.php'), [
                'messages' => $messages
            ], false);
        } catch (Throwable $exc) {
            $message = includeWithVariables(view('components/validator-messages.php'), [
                'messages' => [$exc->getMessage()]
            ], false);
        }

        parent::view('user/show.php', compact('data', 'message'));
    }

    public function destroy()
    {
        $id = $_GET['id'];
        $status = false;

        try {
            $status = $this->service->destroy($id);
            $message = ($status) ? 'Operação realizada com sucesso!' : 'Ocorreu uma falha durante a exclusão';
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
        ]);
    }

    public function index()
    {
        $params = $_GET;
        $data = [];
        $message = '';

        try {
            $data = $this->service->getIndexData($params);
            $this->addIndexAssets();
        } catch (Throwable $exc) {
            $message = includeWithVariables(view('components/validator-messages.php'), [
                'messages' => [$exc->getMessage()]
            ], false);
        }

        $data['params'] = $params;
        
        parent::view('user/index.php', compact('data', 'message'));
    }
}
