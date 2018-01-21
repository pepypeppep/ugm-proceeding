<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Subjects;
use App\Http\Resources\SubjectsCollection;
use App\Subject;
use App\Repositories\Api\SubjectsRepository as Repository;

class SubjectController extends Controller
{
    // public function index()
    // {
    // 	return Subjects::collection(Subject::get());
    // }

    public function index(Repository $repository)
    {
    	$queries = request()->validate([
            'name' => 'string',
        ]);

    	return new SubjectsCollection($repository->getAll($queries));
    }

    public function show(Subject $subject)
    { 
        return new Subjects($subject);
    }
    
} 
