<?php

namespace App\Http\Controllers\Library;

use App\Models\BCategory;
use Validator;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class BCategoryController extends CategoryController
{

    protected $dict='BCategory';
    protected $class='App\Models\BCategory';
    protected $is_descr=false;
}
