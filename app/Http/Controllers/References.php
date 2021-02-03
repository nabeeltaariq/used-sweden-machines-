<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reference;

class References extends Controller
{
    public function Index(Request $request){
        return view("admin.browseReferences",["references" => Reference::all()]);
    }

    public function New(Request $request){
        return view("admin.newReferenceForm");
    }

    public function Save(Request $request){
        $newReference = new Reference();
        $newReference->customerName = $request->customerName;
        $newReference->deliveryScope = $request->deliveryScope;
        $newReference->contactPerson = $request->contactPerson;
        $newReference->projectStatus = $request->projectStatus;
        

        if($request->file("fileToUpload") != null){
          $path =  $request->file("fileToUpload")->store("references");
          $newReference->referenceLetter = $path;
        }

        $newReference->save();
       return view("admin.newReferenceForm",["message" => "Reference saved successfully"]);
    }

    public function EditForm($id){
        $newReference = Reference::find($id);

        return view("admin.editReferenceForm",["reference" => $newReference]);
    }

    public function SaveChanges(Request $request,$id){
        $newReference = Reference::find($id);
        $newReference->customerName = $request->customerName;
        $newReference->deliveryScope = $request->deliveryScope;
        $newReference->contactPerson = $request->contactPerson;
        $newReference->projectStatus = $request->projectStatus;
        if($request->file("fileToUpload") != null){
            $path =  $request->file("fileToUpload")->store("references");
            $newReference->referenceLetter = $path;
          }
  
          $newReference->save();
         return view("admin.editReferenceForm",["reference"=>$newReference,"message" => "Reference Updated Successfully"]);
    }

    public function RemoveReference($id){
        $newReference = Reference::find($id);
        $newReference->delete();
        return redirect("admin/news/references/");
    }
}
