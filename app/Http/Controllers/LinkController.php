<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Link;

class LinkController extends Controller
{

    //page with form for creating new a link
    public function addLink() {
	$viewData = [
	    'title' => 'Addding new link'
	];
	return view('addLink', $viewData);
    }

    //method for saving in the database a new link
    public function storeLink(Request $req) {
	$this->validate($req, $this->rules());
	if(!Link::checkUrl($req->original_url)) return redirect('/link/add');
	$data['original_url'] = $req->original_url;
	$data['short_url'] = $req->short_url ? $req->short_url : Link::generateShortUrl();
	Link::create($data);
	return redirect('/links');
    }

    //method for saving in the database a new link through api
    public function storeLinkApi(Request $req) {
	try{
	    $res = ['errors' => false ];
	    $validateRes = $this->getValidateResult($req->all(),[
		'original_url' => 'required|url',
		'short_url' => 'unique:links,short_url'
	    ]);
	    if($validateRes){
		$res['errors'] = true;
		$res['messages'] = $validateRes;
	    } elseif (!Link::checkUrl($req->original_url)){
		$res['errors'] = true;
		$res['messages'][] = 'Url not available or answered with error! Please, enter a correct url';
	    }

	    if($res['errors']) return response()->json($res);

	    $data['original_url'] = $req->original_url;
	    $data['short_url'] = $req->short_url ? $req->short_url : Link::generateShortUrl();
	    Link::create($data);
	    $res['success'] = true;
	    return response()->json($res);

	} catch (Exception $e){
	    dd($e);
	}
    }

    //method for checking url
    public function checkLink(Request $req) {
	try{
	    $res = ['errors' => false ];
	    $validateRes = $this->getValidateResult($req->all());
	    if($validateRes){
		$res['errors'] = true;
		$res['messages'] = $validateRes;
	    } elseif (!Link::checkUrl($req->original_url)){
		$res['errors'] = true;
		$res['messages'][] = 'Url not available or answered with error! Please, enter a correct url';
	    }
	    return response()->json($res);
	} catch(Exception $e){
	    dd($e);
	}
    }

    //method for checking short url
    public function checkShortUrl(Request $req) {
	try{
	    $res = ['errors' => false ];
	    $validateRes = $this->getValidateResult($req->all());
	    if($validateRes){
		$res['errors'] = true;
		$res['messages'] = $validateRes;
	    }
	    return response()->json($res);
	} catch(Exception $e){
	    dd($e);
	}
    }

    //validations rules
    private function rules() {
	return [
	    'original_url' => 'url',
	    'short_url' => 'unique:links,short_url'
	];
    }

    //method for getting a validations errors messages array
    private function getValidateResult($arrayData, $rules = []) {
	$validator = Validator::make($arrayData, empty($rules) ? $this->rules() : $rules);
        if ($validator->fails()) {
	    return $validator->errors()->messages();
        }
	return false;
    }

}
