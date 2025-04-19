 <?php
function contacth(){
    return $contacths=\App\Models\ContactInfo::where('id',1)->first();
    //declear view
    //contacth()->phone;
}
function categoryh(){
    return $categoryh=\App\Models\Category::orderBy('orders','ASC')->where('parent_id',0)->where('type','Regular')->where('status','Active')->get();
}

function brandh(){
    return $brandh=\App\Models\Brand::where('status','Active')->get();
}
 function sizeh(){
     return $sizeh=\App\Models\Atribute::where('parent_id',3)->get();
 }

 function colorh(){
     return $colorh=\App\Models\Atribute::where('parent_id',1)->get();
 }

function socialh(){
    return $socialh=\App\Models\SocialMedia::where('id',1)->first();
}

function topbrand(){
    return $topbrand=\App\Models\Brand::orderBy('id','ASC')->where('status','Active')->limit(5)->get();
}