<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App;
use Illuminate\Http\Request;

class bindModelController extends BaseController {

    public function __construct() {
        
    }
    
    public function show(App\Models\Todoitem $item) {
        dd($item);
    }
    public function store(App\Models\Todoitem $item) {
        return 'from Store';
    }
}