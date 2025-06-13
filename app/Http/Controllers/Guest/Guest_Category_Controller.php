<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class Guest_Category_Controller extends Controller
{
    public function index($id){
        $category = Category::find($id);
        if($category){
            $newsAll = News::orderBy('id', 'desc')->limit(3)->get();
            $news = News::where('category_id',$id)->orderBy('id','desc')->get();
            $sent = [
                'category' => $category,
                'newsAll' => $newsAll,
                'news' =>  $news
            ];
            return view('guest.category.index', $sent);
        }
        else{
            return view('guest.error_page.error_404');
            // return view('error.index');
        }
    }
}
