<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    public function index()
    {
        $recipes = Recipe::orderBy('created_at', 'desc')->get(['id','title', 'ingredients', 'quantity', 'cooking_time','cook_img','description']);
        return view('top', ['recipes' => $recipes]);
    }
}
