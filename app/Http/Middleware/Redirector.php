<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Link;

class Redirector
{

    private $exeptions = [ 'link'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	if(in_array($request->path(), $this->exeptions)) return $next($request);

	$link = Link::where(['short_url' => $request->path()])->first();
	if($link){
	    return redirect($link->original_url);
	}
	return redirect('/');
    }
}
