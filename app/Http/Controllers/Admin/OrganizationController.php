<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['name'=>'Home', 'link'=>'/admin'], ['name'=>'Organization Management', 'link'=>'#']];
        return view('admin/organizations')->with('breadcrumbs', $breadcrumbs);; //
    }

}
