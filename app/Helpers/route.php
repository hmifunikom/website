<?php

function route_domain($statement, $clouser)
{
    $domain = '.' . env('DOMAIN');

    if (is_array($statement))
    {
        $statement['domain'] = $statement['domain'] . $domain;
    }
    else
    {
        $tmpstatement['domain'] = $statement . $domain;
        $statement = $tmpstatement;
    }

    Route::group($statement, $clouser);
}

function route_prefix($statement, $clouser)
{
    if ( ! is_array($statement))
    {
        $tmpstatement['prefix'] = $statement;
        $statement = $tmpstatement;
    }

    Route::group($statement, $clouser);
}

function route_panel($clouser)
{
    route_prefix(['prefix' => 'panel', 'middleware' => 'auth'], $clouser);
    //route_domain(['domain' => 'panel'], $clouser);
}


function route_repo($key, $class, Closure $callback = null, $hashids = null)
{
    Route::bind($key, function ($value) use ($class, $callback, $hashids)
    {
        if ($hashids != null || $hashids != false)
        {
            if (is_bool($hashids) && $hashids == true)
            {
                $hash = Hashids::decode($value);
                if (isset($hash[0]))
                {
                    $value = $hash[0];
                }
            }
            else
            {
                $hash = Hashids::connection($hashids)->decode($value);
                if (isset($hash[0]))
                {
                    $value = $hash[0];
                }
            }
        }

        if (Request::method() != \Symfony\Component\HttpFoundation\Request::METHOD_GET) return $value;

        if (is_null($value)) return;

        // For model binders, we will attempt to retrieve the models using the first
        // method on the model instance. If we cannot retrieve the models we'll
        // throw a not found exception otherwise we will return the instance.
        if ($model = (new $class(app()))->find($value))
        {
            return $model;
        }

        // If a callback was supplied to the method we will call that to determine
        // what we should do when the model is not found. This just gives these
        // developer a little greater flexibility to decide what will happen.
        if ($callback instanceof Closure)
        {
            return call_user_func($callback, $value);
        }

        throw new Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
    });
}

function route_bind_key($key, $class, $table_key)
{
    Route::bind($key, function ($value) use ($class, $table_key)
    {
        if (is_null($value)) return;

        if ($model = (new $class)->findByField($table_key, $value))
        {
            return $model;
        }
    });
}

function route_resource($resource, $controller, $suffix_name = '')
{
    if ($suffix_name != '')
        $suffix_name = $suffix_name . '.';

    $parents = explode('.', $resource);
    $path = array_pop($parents);

    $url = [];
    foreach ($parents as $res)
    {
        $url[] = $res . '/{' . $res . '}';
    }

    $urllist = implode('/', $url) . '/' . $path;
    $urlitem = implode('/', $url) . '/' . $path . '/{' . $path . '}';

    $routename = str_replace('/', '.', $resource);

    Route::get($urllist, ['as' => $suffix_name . $routename . '.index', 'uses' => $controller . '@index']);
    Route::get($urllist . '/create', ['as' => $suffix_name . $routename . '.create', 'uses' => $controller . '@create']);
    Route::get($urlitem, ['as' => $suffix_name . $routename . '.show', 'uses' => $controller . '@show']);
    Route::post($urllist, ['as' => $suffix_name . $routename . '.store', 'uses' => $controller . '@store']);
    Route::get($urlitem . '/edit', ['as' => $suffix_name . $routename . '.edit', 'uses' => $controller . '@edit']);
    Route::put($urlitem, ['as' => $suffix_name . $routename . '.update', 'uses' => $controller . '@update']);
    Route::delete($urlitem, ['as' => $suffix_name . $routename . '.destroy', 'uses' => $controller . '@destroy']);
}

function is_ajax()
{
    return Request::ajax();
}

function redirect_ajax($name, $parameters = [], $notification = false, $data = null)
{
    if (is_ajax())
    {
        $response = new stdClass();

        if ($data)
        {
            $response = object_merge($response, $data);
        }
        
        $response->success = true;
        $response->code = 200;
        $response->url = route($name, $parameters, true, null);

        if (Session::has('notification') && $notification)
        {
            $response->msg = Session::get('notification');
            Session::forget('notification');
        }

        return response(json_encode($response));
    }
    else
    {
        return app('redirect')->route($name, $parameters, true, null);
    }
}

function redirect_ajax_notification($name, $parameters = [], $data = null)
{
    return redirect_ajax($name, $parameters, true, $data);
}

function response_ajax(stdClass $data = null, $status = true)
{
    if ( ! $data)
    {
        $data = new stdClass();
    }

    if (Session::has('notification'))
    {
        $data->msg = Session::get('notification');
        Session::forget('notification');
    }

    if ($status)
    {
        $data->code = 200;
        $data->success = true;
    }
    else
    {
        $data->code = 500;
        $data->success = true;
    }

    return response(json_encode($data), $data->code);
}

function response_ajax_fail(stdClass $data = null)
{
    return response_ajax($data, false);
}

function route_append_qs($name, $parameters = array(), $only = null, $absolute = true, $route = null)
{
    $qs = ($only != null) ? Input::only($only) : Input::all();
    $parameters = $parameters + $qs;
    return route($name, $parameters, $absolute, $route);
}