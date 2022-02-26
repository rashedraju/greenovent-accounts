<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::paginate(10);
        return view('projects.index', ['projects' => $projects]);
    }

    public function create(){
        //
    }
}
