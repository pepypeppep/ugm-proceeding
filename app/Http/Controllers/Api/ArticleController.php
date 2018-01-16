<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Articles;
use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
    	return Articles::collection(Article::with('author')->paginate(5));
    }
    
} 
