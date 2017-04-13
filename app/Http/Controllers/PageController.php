<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class PageController extends Controller
{
    //home page
    public function index() {
	$viewData = [
	    'title' => 'Home page'
	];
	return view('home', $viewData);
    }

    //Page for showing all links
    public function links() {
	$viewData = [
	    'title' => 'All Links',
	    'links' => Link::all()
	];
	return view('links', $viewData);
    }
}
