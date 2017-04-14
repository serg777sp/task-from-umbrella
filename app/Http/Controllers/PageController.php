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

    //Method for getting all links
    public function links() {
	try{
	    $res['errors'] = false;
	    $viewData = [
		'links' => Link::all(),
	    ];
	    $res['links'] = view('links', $viewData)->render();
	    return response()->json($res);
	} catch (Exception $e){
	    $res['errors'] = true;
	    $res['message'] = $e->getMessage();
	    return response()->json($res);
	}
    }

    //Method for getting templates
    public function getTemplate(Request $req) {
	try{
	    $res['errors'] = false;
	    $res['template'] = file_get_contents('../resources/views/templates/'.$req->template.'.blade.php');
	    return response()->json($res);
	} catch (Exception $e){
	    $res['errors'] = TRUE;
	    $res['message'][] = $e->getMessage();
	    return response()->json($res);
	}
    }
}
