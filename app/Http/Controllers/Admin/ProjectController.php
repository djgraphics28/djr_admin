<?php

namespace App\Http\Controllers\Admin;

use App\Model\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\CentralLogics\Helpers;
use App\Model\Translation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    public function __construct(
        private Project $project
    ){}

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    function list(Request $request): View|Factory|Application
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $projects = $this->project->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('title', 'like', "%{$value}%");
                }
            })->orderBy('id');
            $query_param = ['search' => $request['search']];
        } else {
            $projects = $this->project->orderBy('id');
        }
        $projects = $projects->latest()->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.project.index', compact('projects', 'search'));
    }

    public function create()
    {
        return view('admin-views.project.create');
    }
}
