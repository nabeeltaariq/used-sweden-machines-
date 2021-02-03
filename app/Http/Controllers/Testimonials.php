<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;

class Testimonials extends Controller
{
    public function Index(){
        return view("admin.browseTestimonials",["testimonials" => Testimonial::all()]);
    }

    public function AddForm(Request $request){
        return view("admin.addTestimonialForm");
    }

    public function Save(Request $request){
        $testimonial = new Testimonial();
        $testimonial->companyName = $request->input("companyName");
        $testimonial->personName = $request->input("personName");
        $testimonial->testimonial = $request->input("testimonial");
        $testimonial->personDesignation = $request->input("personDesignation");
        $testimonial->sentDate = $request->input("sentDate");
        
        if($request->file("fileToUpload") != null){

           $path = $request->file("fileToUpload")->store("companyLogo");
           $testimonial->brandLogo = $path;
        }
            
        
        $testimonial->save();




        return view("admin.addTestimonialForm",["message" => "New Testimonial saved successfully"]);
    }

    public function SaveChanges(Request $request,$id){
        $testimonial = Testimonial::find($id);
        $testimonial->companyName = $request->companyName;
        $testimonial->personName = $request->input("personName");
        $testimonial->testimonial = $request->input("testimonial");
        $testimonial->personDesignation = $request->input("personDesignation");
        if($request->sentDate != null){
            $testimonial->sentDate = $request->input("sentDate");
        }

        if($request->file("fileToUpload") != null){

            $path = $request->file("fileToUpload")->store("companyLogo");
            $testimonial->brandLogo = $path;
         }

         $testimonial->save();


         return view("admin/editTestimonialForm",["test" => $testimonial,"message" => "Updated successfully"]);
    }

    public function EditForm($id){
        $test = Testimonial::find($id);
        return view("admin/editTestimonialForm",["test" => $test]);
    }

    public function Remove($id){
      $testimonial =  Testimonial::find($id);
      $testimonial->delete();
      return redirect("/admin/news/testimonials");
    }
}
