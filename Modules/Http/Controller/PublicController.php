<?php

namespace App\Modules\Http\Controller;

class PublicController extends BaseController
{
    public function homepage()
    {
        return view('welcome');
    }
}
