<?php

namespace App\Http\Controllers;

use App\Models\Transactions\Template;
use Illuminate\Http\Request;
use App\Models\Transactions\Category;

class WelcomeController extends Controller
{
    public function __invoke(){
        return 'API';
    }
}
