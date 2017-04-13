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
	Link::create($req->all());
	return redirect('/links');
    }

    //method for checking url
    public function checkLink(Request $req) {
	try{
	    $res = ['errors' => false ];
	    $validateRes = $this->getValidateResult($req->all());
	    if($validateRes){
		$res['errors'] = true;
		$res['messages'] = $validateRes;
	    } elseif (!$this->checkUrl($req->original_url)){
		$res['errors'] = true;
		$res['messages'][] = 'Url not available or redirectable! Please, enter a correct url';
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

    private function checkUrl($url) {

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Timeout in seconds
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_exec($ch);
	if(curl_getinfo($ch)['http_code'] == 200){
	    return true;
	}
	return false;
    }

    private function rules() {
	return [
	    'original_url' => 'url',
	    'short_url' => 'unique:links,short_url'
	];
    }

    private function getValidateResult($arrayData) {
	$validator = Validator::make($arrayData, $this->rules());
        if ($validator->fails()) {
	    return $validator->errors()->messages();
        }
	return false;
    }

}
