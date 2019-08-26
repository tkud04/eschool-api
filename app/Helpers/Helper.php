<?php
namespace App\Helpers;

use App\Helpers\Contracts\HelperContract; 
use Crypt;
use Carbon\Carbon; 
use Mail;
use Auth;
use \Swift_Mailer;
use \Swift_SmtpTransport;
use App\Tokens;
use GuzzleHttp\Client;

class Helper implements HelperContract
{
                        
             public $signals = ['okays'=> ["login-status" => "Sign in successful",
                     "cobra-deal-status" => "Deal updated.",
                     "update-deal-status" => "Deal updated.",
                     "cobra-user-status" => "User info updated.",
                     "cobra-comment-status" => "Comment updated.",
                     "cobra-coupon-status" => "Coupon updated.",
                     "cobra-approve-rating-status" => "User rating updated.",
                     "forgot-password-status" => "A link to reset your password has been sent to your email.",
                     "cobra-forgot-password-status" => "A link to reset your password has been sent to your email.",
                     "reset-status" => "Password updated! You can now login.",
                     "add-deal-status" => "Deal added!",
                     "add-post-status" => "New post added!",
                     "delete-deal-status" => "Deal deleted .",
                     "delete-auction-status" => "Auction deleted.",
                     "delete-store-status" => "Store removed.",
                     "update-post-status" => "Post updated!",
                     "update-store-status" => "Store info updated!",
                     "add-coupon-status" => "Coupon added!",
                     "rate-deal-status" => "Thank you for your input!",
                     "no-bid-status" => "Insufficient funds to place bid. Please make a deposit and try again.",
                     "bid-status" => "Bid has been placed.",
                     "comment-deal-status" => "Thank you, your comment has been sent. ",
                     "remove-cart-status" => "Deal removed from cart.",
                     "kloudpay-withdraw-status" => "Withdrawal request has been submitted and is pending review",
                     "kloudpay-transfer-status" => "Transfer successful!",
                     "cobra-approve-withdrawal-status" => "Withdrawal request approved. Go to PayStack Dashboard to make the transfer",
                     "cobra-auction-status" => "New auction created!",
                     "cobra-settings-status" => "Settings updated. ",
                     "cobra-end-auction-status" => "Auction ended! Deal has been added to the highest bidder's cart",
                     "cloud-image-deleted" => "Image(s) deleted",
                     "cloud-image-not_found" => "Image(s) not found",
                     "vendor-signup-status" => "Your store has been created! Import your products and start selling :)",
                     ],
                     'errors'=> ["login-status-error" => "There was a problem signing in, please contact support.",
                     "cobra-user-status-error" => "There was an error updating info for this user. Please try again.",
                     "cobra-settings-status-error" => "There was an error updating site configuration. Please try again. ",
                     "cobra-post-status-error" => "There was an unknown error fetching that post.",
                     "bid-status-error" => "There was an error placing your bid.",
                     "cobra-deal-status-error" => "There was an error updating this deal. Please try again.",
                     "kloudpay-withdraw-status-error" => "Insufficient funds in KloudPay wallet",
                     "comment-deal-status-error" => "There was an error submitting your comment. Please try again. ",
                     "rate-deal-status-error" => "There was an error submitting your rating. Please try again. ",
                     "cobra-auction-status-error" => "There was an error creating the auction. Please try again.",
                     "cobra-end-auction-status-error" => "There were no bidders for this auction.",
                     "cobra-store-status" => "Store info updated!",
                     "kloudpay-transfer-status-error" => "Transfer request denied. This could be because you have insufficient funds or the transfer amount has exceeded our limit of &#8358;200,000.00"]
                   ];

       
           
           function tokenExists($dt)
		   {
			   $ret = false;
			   $t = Tokens::where('token',$dt['token'])
			              ->where('class_id',$dt['cid'])
			              ->where('school_code',$dt['sc'])
			              ->where('student_id',$dt['student_id'])->first();
			   
			   if($t != null)
			   {
				   $ret = true;
			   }
			   
			   return $ret;
		   }
		   
           function createToken($data)
           {
			 $te = $this->tokenExists($data);
			 $ret = "Token already exists";
			 
			 if(!$te){
           	$ret = Tokens::create(['student_id' => $data['student_id'], 
                                                      'token' => $data['token'],                                                                                                            
                                                      'class_id' => $data['cid'],                                                                                                            
                                                      'school_code' => $data['sc'],                                                                                                            
                                                      'status' => "ok"                                                                                                            
                                                      ]);                                                     
                $ret = "Token created";
			 }
			 
			 return $ret;
           }	

            function getTokens($type)
           {
           	$temp = [];
               if($type == "all") $ts = Tokens::where('id','>','0')->get();
               else $ts = Tokens::where('class_id',$type)->get();
 
              if($ts != null)
               {
				   foreach($ts as $t)
				   {
					  $ret = [];
                   	  $ret['id'] = $t->id; 
                      $ret['student_id'] = $t->student_id; 
                      $ret['token'] = $t->token; 
                      $ret['class_id'] = $t->class_id; 
                      $ret['status'] = $t->status; 
                      $ret['date'] = $t->created_at->format("jS F, Y h:i A"); 
					  array_push($temp,$ret);
                   }                      
               }			   
                                                      
                return $temp;
           }		

		   function getToken($student)
           {
           	$ret = [];
               $t = Tokens::where('student_id',$student)->first();
 
              if($t != null)
               {
               	$ret['id'] = $t->id; 
                   $ret['student_id'] = $t->student_id; 
                   $ret['token'] = $t->token; 
				   $ret['class_id'] = $t->class_id; 
                   $ret['status'] = $t->status; 
                   $ret['date'] = $t->created_at->format("jS F, Y h:i A"); 
               }                                 
                                                      
                return $ret;
           }				   
          
           
           
}
?>