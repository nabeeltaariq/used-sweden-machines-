<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class Pages extends Controller
{
    public function Index(){

        return view("admin.pages",["pages" => Page::all()]);
    }

    public function EditForm($id){
        $pageToEdit = Page::find($id);
        return view("admin.editPage",["page" => $pageToEdit]);
    }

    public function SaveChanges($id,Request $request){
        $pageToEdit = Page::find($id);
        $pageToEdit->page_title = $request->input("page_title");
        $pageToEdit->page_contents = $request->input("description");
        $pageToEdit->meta_key = $request->input("keywords");
        $pageToEdit->meta_des = $request->input("meta_description");
        $pageToEdit->save();
        return view("admin.editPage",["page" => $pageToEdit,"message" => "Page Updated Successfully"]);
    }
}
