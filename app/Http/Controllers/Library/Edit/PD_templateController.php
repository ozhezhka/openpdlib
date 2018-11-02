<?php

namespace App\Http\Controllers\Library\Edit;

use App\Models;
use Validator;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class PD_templateController extends DictionaryController
{
    protected $dict='PD_template';
    protected $class='App\Models\PD_template';
    protected $is_descr=true;
}
