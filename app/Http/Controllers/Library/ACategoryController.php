<?php

namespace App\Http\Controllers\Library;

use App\Models;
use Validator;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ACategoryController extends CategoryController
{

    protected $dict='ACategory';
    protected $class='App\Models\ACategory';
    protected $is_descr=false;

}
