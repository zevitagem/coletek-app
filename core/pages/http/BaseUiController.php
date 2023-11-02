<?php

namespace app\pages\http;

use app\pages\http\Controller;

abstract class BaseUiController extends Controller
{
    protected array $config = [
        'assets' => [
            'css' => [],
            'js' => []
        ]
    ];

    public function __construct($config = [])
    {
        session_start();

        if (isset($config['assets']['css'])) {
            $this->config['assets']['css'] = array_merge(
                $this->config['assets']['css'], $config['assets']['css']
            );
        }
        if (isset($config['assets']['js'])) {
            $this->config['assets']['js'] = array_merge(
                $this->config['assets']['js'], $config['assets']['js']
            );
        }
        if (isset($config['assets'])) {
            unset($config['assets']);
        }

        $this->config += $config;
    }

    public function addIndexAssets()
    {
        $this->config['assets']['js'][] = 'app/' . $this->getControllerName() . '/index.js';
        $this->config['assets']['css'][] = 'app/' . $this->getControllerName() . '/index.css';
    }

    public function addShowAssets()
    {
        if (method_exists($this, 'addFormAssets')) {
            $this->addFormAssets();
        }

        $this->config['assets']['js'][] = 'app/' . $this->getControllerName() . '/show.js';
        $this->config['assets']['css'][] = 'app/' . $this->getControllerName() . '/show.css';
    }

    public function addCreateAssets()
    {
        if (method_exists($this, 'addFormAssets')) {
            $this->addFormAssets();
        }

        $this->config['assets']['js'][] = 'app/' . $this->getControllerName() . '/create.js';
        $this->config['assets']['css'][] = 'app/' . $this->getControllerName() . '/create.css';
    }

    public function addListAssets()
    {
        $this->config['assets']['js'][] = 'app/' . $this->getControllerName() . '/list.js';
        $this->config['assets']['css'][] = 'app/' . $this->getControllerName() . '/list.css';
    }

    public function view(
        string $contentPath,
        array $data = [],
        array $config = []
    )
    {
        $data = array_merge(
            (empty($this->config['view']['data']) ) ? [] : $this->config['view']['data'],
            $data
        );

        $sharedData = $this->getSharedData();

        includeWithVariables(
            template('header.php'), $this->getHeaderViewParams($sharedData)
        );
        includeWithVariables(
            (!empty($config['filled_content'])) ? $contentPath : view($contentPath),
            $data
        );
        includeWithVariables(
            template('footer.php'), $this->getFooterViewParams($sharedData)
        );

        $this->eraseErrorMessage();
        $this->eraseSuccessMessage();
    }

    protected function eraseErrorMessage()
    {
        if (isset($_SESSION['error_message'])) {
            unset($_SESSION['error_message']);
        }
    }

    protected function eraseSuccessMessage()
    {
        if (isset($_SESSION['success_message'])) {
            unset($_SESSION['success_message']);
        }
    }

    private function getHeaderViewParams(array $sharedData = [])
    {
        return array_merge($sharedData,
            [
                'assets' => $this->config['assets'] ?? [],
                'messages' => [
                    'success' => $_SESSION['success_message'] ?? '',
                    'error' => $_SESSION['error_message'] ?? '',
                ]
            ]
        );
    }

    private function getFooterViewParams(array $sharedData = [])
    {
        return array_merge(
            $sharedData, ['assets' => $this->config['assets'] ?? []]
        );
    }

    private function getSharedData()
    {
        return [
            'shared' => []
        ];
    }
}
