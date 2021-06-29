<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Modal\PageID;

class SocialController extends Controller
{
    //
    public function post(Request $request){
        // return $request->token;
        //get page list and page access token 
        $url=env('FAPI').$request->id."/accounts"."?access_token=".$request->token;
        $available_page = HTTP::get($url)->json();
        $page_list=[];
        foreach ($available_page["data"]as $key => $value) {
            $getDomain =env('FAPI')."/me/messenger_profile?"."fields=whitelisted_domains"."&access_token=".$value["access_token"] ;
            $domains= Http::get($getDomain)->json();

            $page_details=array(
            "name"=>$value["name"],
            "id"=>$value["id"],
            "domain_list"=>$domains["data"][0]["whitelisted_domains"],
            );
            $page_list[$key]=$page_details;
        }
        return $page_list;
    }

    // public function domainWhitelistQuery ($token){
      
    //     return $domains["data"];
    // }
    
    public function updateDomains(Request $request){ //require user id & token, page id, domain name, remove_action
        //get page list and page access token
        $url=env('FAPI').$request->id."/accounts"."?access_token=".$request->token;
        $available_page = HTTP::get($url)->json();
        // dd($available_page);
        $page_access_token=null;
        foreach ($available_page["data"]as $key => $value) {
            // dd($value,$request->id,$value["id"]);
           if($value["id"] == $request["page_id"]){
                $page_access_token= $value["access_token"];
                break;
           }
        }
        //get respective page token and check domain name 
        $getDomain =env('FAPI')."/me/messenger_profile?"."fields=whitelisted_domains"."&access_token=".$page_access_token;
        $domains= Http::get($getDomain)->json();
        $domains= $domains["data"][0]["whitelisted_domains"];
        $domain_present= false;
        foreach ($domains as $key => $value){
            if(rtrim($value,"/") == rtrim($request->domain_name,"/")){
                $domain_present=!$domain_present;
            }
            $whitelist_domians[]=rtrim($value,"/");
        }

        $update_domain_call=null;
        $whitelist_url= env("FAPI")."me/messenger_profile"."?access_token=".$page_access_token;
       
        if(!$domain_present && $request->remove_action=="false" && $request->domain_name!=null){
 
            $whitelist_domians[]=$request->domain_name;

            $update_domain_call= HTTP::withHeaders([
                "Content-Type"=> "application/json",
                "charset"=> "UTF-8"
            ])->post($whitelist_url,[
                "whitelisted_domains"=> $whitelist_domians, 
            ]);
            self::updateMerchantPageID($request->remove_action=="true", $request->page_id);
//            return $updte_domain_call;
        }
        else if($domain_present && $request->remove_action=="true" && $request->domain_name!=null){
 
            $whitelist_domians=array_diff( $whitelist_domians, array($request->domain_name));
    
            $update_domain_call= HTTP::withHeaders([
                "Content-Type"=> "application/json",
                "charset"=> "UTF-8"
            ])->post($whitelist_url,[
                "whitelisted_domains"=> $whitelist_domians, 
            ]);
           self::updateMerchantPageID($request->remove_action=="true", $request->page_id);
//            return $updte_domain_call;
        }
        // dd($update_domain_call);

 	
    }

    static function updateMerchantPageID($remove, $page_id){
        
        $merchantPage_ID=PageID::where("page_id", "!=", null)->first();
        // dd($merchantPage_ID, "why null");
        if($remove){
            $merchantPage_ID->update(["page_id"=>$page_id]);
        }
        else{
            $merchantPage_ID->update(["page_id"=>null]);
        }
    
        dd($merchantPage_ID,$remove, $page_id);

    }
}
