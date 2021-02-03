<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catagories;
use App\Product;

class Catagory extends Controller
{
    public function Index(){
        $allCatagories = Catagories::where("id",">=",1)->orderBy("order","asc")->get();
        return view("admin.catagories_home",["catagories"=>$allCatagories]);
    }

    public function AddNew(){
        $lastCategory = Catagories::where("id",">=",1)->orderBy("order","desc")->first();
        $lastOrder = $lastCategory->order;
        $lastOrder++;
        return view("admin.addCatagoryForm",["suggestedOrder" => $lastOrder]);
    }

    public function Save(Request $request){
        
        $category = new Catagories();
        $category->name = $request->input("categoryName");
        $category->status = $request->input("status");
        $category->order = $request->input("orderNo");
        $category->save();
        $lastCategory = Catagories::where("id",">=",1)->orderBy("order","desc")->first();
        $lastOrder = $lastCategory->order;
        $lastOrder++;
        return view("admin.addCatagoryForm",["suggestedOrder" => $lastOrder,"message" => "Category Saved Successfully"]);
    
    }

    public function EditForm($id){
       $catagoryToEdit = Catagories::find($id);
       return view("admin.editCatagoryForm",["category"=>$catagoryToEdit]);
    }

    public function SaveChanges($id,Request $request){
        $category = Catagories::find($id);
        $category->order = $request->input("orderNo");
        $category->name = $request->input("categoryName");
        $category->status = $request->input("status");
        $category->save();    
        return view("admin.editCatagoryForm",["category"=>$category,"message" => "Saved"]);
    }


    public function Remove($id){
        //deleting all products
        $allProducts = Product::where("cat_id",$id)->get();
        foreach($allProducts as $product){
            $product->delete();
        }

        //deleting catagory;
        $catToDelete = Catagories::find($id);
        $catToDelete->delete();
        return redirect("/admin/products/catagories");
    }
}
