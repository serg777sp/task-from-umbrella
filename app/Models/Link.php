<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //array with http codes for check url
    private static $available_http_codes = [200,302];

    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'links';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['original_url', 'short_url'];

    //Check url method
    public static function checkUrl($url) {

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Timeout in seconds
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_exec($ch);
	if(in_array(curl_getinfo($ch)['http_code'], self::$available_http_codes)){
	    return true;
	}
	return false;
    }

    //Generate short url
    public static function generateShortUrl($length = 10) {
	$shortUrl = '';
	while(true){
	    $shortUrl = self::getRandomString($length);
	    if(!Link::where(['short_url' => $shortUrl])->first()){
		break;
	    }
	}
	return $shortUrl;
    }

    //generate random string
    private static function getRandomString($length = 10){
	$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$endCharsString = strlen($chars) - 1;
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
	    $randomString .= $chars[rand(0, $endCharsString)];
	}
	return $randomString;
    }
}
