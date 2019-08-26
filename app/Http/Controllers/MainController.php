<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class MainController extends Controller {

	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;                     
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getIndex(Request $request)
    {
        $user = null;
		
		
		$req = $request->all();
        //dd($req);
		$ret = ["status" => "error","data" => "Connection failed."];
        
             //$schoolCode = $this->helpers->getSchoolCode($req);
			 $tokens = $this->helpers->getTokens("all");
			 
             if($tokens == null || count($tokens) < 1)
             {
             	$ret = ["status" => "error","data" => "No tokens"];
             }
             else
             {
             	$ret = ["status" => "ok","data" => $tokens];
             }        
         
         return json_encode($ret);		 
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPushToken(Request $request)
    {
       
		$req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'student_id' => 'required',
                             'token' => 'required',
                             'sc' => 'required',
                             'cid' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             $ret = ["status" => "error","data" => $messages];
         }
         
         else
         {
             $dt = $this->helpers->createToken($req);
             
             	$ret = ["status" => "ok","data" => $dt];       
         }
         return json_encode($ret);		 
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getTokens(Request $request)
    {
        $user = null;
		
		
		$req = $request->all();
        //dd($req);
		$ret = ["status" => "error","data" => "Connection failed."];
        
		  $validator = Validator::make($req, [
                             'cid' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             $ret = ["status" => "error","data" => $messages];
         }
         
         else
         {
			 $tokens = $this->helpers->getTokens($req['cid']);
			 
             if($tokens == null || count($tokens) < 1)
             {
             	$ret = ["status" => "error","data" => "No tokens"];
             }
             else
             {
             	$ret = ["status" => "ok","data" => $tokens];
             }           
         }
                
         
         return json_encode($ret);		 
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getToken(Request $request)
    {
        $user = null;
		
		
		$req = $request->all();
        //dd($req);
		$ret = ["status" => "error","data" => "Connection failed."];
        
		  $validator = Validator::make($req, [
                             'student_id' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             $ret = ["status" => "error","data" => $messages];
         }
         
         else
         {
			 $token = $this->helpers->getToken($req['student_id']);
			 
             if($token == null || count($token) < 1)
             {
             	$ret = ["status" => "error","data" => "No tokens"];
             }
             else
             {
             	$ret = ["status" => "ok","data" => $token];
             }           
         }
                
         
         return json_encode($ret);		 
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getVersion()
    {
       $ret = ["version" => "1.0","status" => "beta","data" => "ESchool API 1.0. See documentation for help on usage"];
	   return json_encode($ret);
    }


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getBundle(Request $request)
    {
               $user = null;
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$req = $request->all();
		$category = "";
		$bundleProducts = [];
		if(isset($req['q']))
		{
			$bundleProducts = $this->helpers->getDeals("bundle",$req['q']);
			$category = $this->helpers->categories[$req['q']];
		} 
        else
        {
        	$bundleProducts = $this->helpers->getDeals("bundle");
        }     
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$mainClass = "amado_product_area section-padding-100 clearfix";
		
    	return view('bundle',compact(['user','cart','bundleProducts','category','c','signals','mainClass']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPractice()
    {
    	return $this->helpers->deleteDeal("62");
    }   


}