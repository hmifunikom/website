<?php namespace HMIF\Modules\Panel\Http\Controllers;

use App;
use Event;
use Efficiently\AuthorityController\ControllerAdditions;
use HMIF\Http\Controllers\Controller;

class PanelController extends Controller {

    use ControllerAdditions;

    public function __construct()
    {
        $this->middleware('auth');
        head_norobot();
    }

    //public function authorizeResource($args = null)
    //{
    //    $args = is_array($args) ? $args : func_get_args();
    //    $this->addBeforeFilter($this, __METHOD__, $args);
    //}

    public static function addBeforeFilter($controller, $method, $args)
    {
        $method = last(explode('::', $method));
        $resourceName = array_key_exists(0, $args) ? snake_case(array_shift($args)) : null;

        $lastArg = last($args);
        if (is_array($lastArg)) {
            $args = array_merge($args, array_extract_options($lastArg));
        }
        $options = array_extract_options($args);

        if (array_key_exists('prepend', $options) && $options['prepend'] === true) {
            $beforeFilterMethod = "prependBeforeFilter";
            unset($options['prepend']);
        } else {
            $beforeFilterMethod =  "beforeFilter";
        }

        $resourceOptions = array_except($options, ['only', 'except']);
        $filterPrefix = "router.filter: ";
        $filterName = "controller.".$method.".".get_classname($controller)."(".md5(json_encode($args)).")";

        $router = App::make('router');
        if (! Event::hasListeners($filterPrefix.$filterName)) {
            $router->filter($filterName, function () use ($controller, $method, $resourceOptions, $resourceName) {
                $params = $controller->getParams();
                $action = null;
                $model = null;

                if(array_key_exists($resourceOptions['key'], $params))
                {
                    $action = $params['action'];
                    $model = $params[ $resourceOptions['key'] ];
                }

                if(is_object($model))
                {
                    $controller->authorize($action, $model);
                }
                else
                {
                    $controllerResource = App::make('Efficiently\AuthorityController\ControllerResource', [
                        $controller, $resourceName, $resourceOptions
                    ]);
                    $controllerResource->$method();
                }
            });

            call_user_func_array([$controller, $beforeFilterMethod], [$filterName, array_only($options, ['only', 'except'])]);
        }

    }

}