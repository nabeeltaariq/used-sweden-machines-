<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Catagories;
use App\Thumbs;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Storage;
use App\UploadedMachine;

class Products extends Controller
{
    public function Index(Request $request){
        $allProducts = Product::all();
        return view("admin.products_home",["products" => $allProducts]);
    }

    public function ViewUploads(){
        return View("admin.uploadedProducts",["products" => UploadedMachine::all()]);
    }


    //stock reporting methods
    public function GenerateReportWithPrice(){
        $mpdf = new Mpdf(['setAutoTopMargin' => 'pad']);
        $logoPath = public_path() . "\imgs\logo.png";
        $date = date("d-M-Y");
        $allProducts = Product::all();
        $mpdf->SetHTMLHeader("
        <div style='text-align: center; font-weight: bold;'>
            <img src='$logoPath' height='100px' width='140px'/>
            <h2 style='margin-top:0;font-family:calibri;margin-bottom:0'>Stock & Price List</h2>
            <h4 style='color:red;font-family:calibri;margin-top:0;'>$date</h4>
            <h4 style='text-align:left;margin-top:0;margin-bottom:-50px'>Tetra Pak Filling Machine & Processing Equipments</h4>
        </div>");
        $mpdf->SetHTMLFooter('

        <table width="100%">

            <tr>
                <td width="33%">Used Sweden Machines</td>
                <td width="33%" align="center">Tel.: +92(321)7415373 </td>
                <td width="33%" style="text-align: right;">info@usedswedenmachines.com</td>
            </tr>
        </table>');
        //writing custom html
       // $html = "";

        $html = "<table cellpadding='10' style='border-collapse:collapse;width:100%'><thead><tr style='background-color:#034375'><th style='color:white'>Sr.#</th><th color='white'>Image</th><th color='white'>Title</th><th color='white'>Specification</th><th color='white'>Delivery Status</th><th color='white'>Price</th></tr></thead>";
        $i = 1;
        foreach($allProducts as $p){
            $bgColor = ($i%2 == 0 ? 'white':'#f8f8f8');
            $imageURL = url('/') . Storage::url('app/products/' . $p->image);
            $html .= "<tr style='background-color:$bgColor'><td>$p->SKU</td><td><img src='$imageURL' style='max-height:50px'/></td><td>$p->pr_title</td><td>$p->short_des</td><td>$p->s_status</td><td>$p->salesPrice</td></tr>";
            $i++;
        }



        $html .= "</table>";
        //end of writing custom html
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function GenerateReportWithoutPrice(){
        $mpdf = new Mpdf(['setAutoTopMargin' => 'pad']);
        $logoPath = public_path() . "\imgs\logo.png";
        $date = date("d-M-Y");
        $allProducts = Product::all();
        $mpdf->SetHTMLHeader("
        <div style='text-align: center; font-weight: bold;'>
            <img src='$logoPath' height='100px' width='140px'/>
            <h2 style='margin-top:0;font-family:calibri;margin-bottom:0'>Stock List</h2>
            <h4 style='color:red;font-family:calibri;margin-top:0;'>$date</h4>
            <h4 style='text-align:left;margin-top:0;margin-bottom:-50px'>Tetra Pak Filling Machine & Processing Equipments</h4>
        </div>");
        $mpdf->SetHTMLFooter('

        <table width="100%">

            <tr>
                <td width="33%">Used Sweden Machines</td>
                <td width="33%" align="center">Tel.: +92(321)7415373 </td>
                <td width="33%" style="text-align: right;">info@usedswedenmachines.com</td>
            </tr>
        </table>');
        //writing custom html
       // $html = "";

        $html = "<table cellpadding='10' style='border-collapse:collapse;width:100%'><thead><tr style='background-color:#034375'><th style='color:white'>Sr.#</th><th color='white'>Image</th><th color='white'>Title</th><th color='white'>Specification</th><th color='white'>Delivery Status</th></tr></thead>";
        $i = 1;
        foreach($allProducts as $p){
            $bgColor = ($i%2 == 0 ? 'white':'#f8f8f8');
            $imageURL = url('/') . Storage::url('app/products/' . $p->image);
            $html .= "<tr style='background-color:$bgColor'><td>$p->SKU</td><td><img src='$imageURL' style='max-height:50px'/></td><td>$p->pr_title</td><td>$p->short_des</td><td>$p->s_status</td></tr>";
            $i++;
        }



        $html .= "</table>";
        //end of writing custom html
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
    //end of stock reporting methods

    public function ShowReportPerforma(){
        return view("admin.reportPerforma");
    }

    public function GenerateReport(Request $request){
        if($request->input("format") == 1){
            $this->GenerateReportWithPrice();
        }else{
            $this->GenerateReportWithoutPrice();
        }
    }


    public function AddProductForm(){

        return view("admin.productForm",["categories" => Catagories::all()]);
    }

    public function Save(Request $request){
        //creating new sku
        $lastProduct = Product::where("id",">=",1)->orderBy("id","desc")->first();
        $lastSKU = $lastProduct->SKU;
        $skuTokens = explode("-",$lastSKU);
        $skuNumber = $skuTokens[1];
        $skuNumber++;


        //setting up database row
        $product = new Product();
        $product->pr_title = $request->input("title");
        $product->is_feature = ($request->input("isFeatured") == null ? 0 : 1);
        $product->cat_id = $request->input("category");
        $product->status = $request->input("status");
        $product->s_status = $request->input("stockStatus");
        $product->short_des = $request->input("shortDescription");
        $product->long_des =  htmlentities($request->input("description"));
        $product->meta_key = $request->input("metaKeywords");
        $product->meta_des = $request->input("metaDescription");
        $product->SKU = "Usm-$skuNumber";
        $product->salesPrice= $request->input("salesPrice");
        $product->machineCondition = $request->input("condition");
        $product->price = $request->input("purchasePrice");
        $product->location = $request->input("location");
        $product->deliveryTime = $request->input("deliveryTime");
        $product->deliveryTerms = $request->input("deliveryTerms");
        $product->paymentTerms = $request->input("paymentTerms");
        $product->waysOfPayments = $request->input("waysOfPayments");
        $product->termsAndCondition = $request->input("terms");
        //uploading featured image
        $path = $request->file("fileToUpload")->store("products");
        $pathTokens = explode("/",$path);
        $fileName = $pathTokens[1];
        $product->image = $fileName;
        $product->save();
        //upload other images


            foreach($request->file("filesToUpload") as $file){
                $path = $file->store("products");
                $pathTokens = explode("/",$path);
                $fileName = $pathTokens[1];
                $thumb = new Thumbs();
                $thumb->file_name = $fileName;
                $thumb->org_id = $product->id;
                $thumb->save();
            }





        return view("admin.productForm",["categories" => Catagories::all(),"message" => "Product Saved Successfully at sku $product->SKU"]);
    }

    public function Remove($id){
        $product = Product::find($id);
        $thumbs = Thumbs::where("org_id",$id)->get();
        foreach($thumbs as $thumb){
            $thumb->delete();
        }

        $product->delete();
        return redirect("/admin/products");
    }

    public function EditForm($id){
        $product = Product::find($id);
        $thumbs =  Thumbs::where("org_id",$id)->get();
        return view("admin.ProductEditForm",["categories" => Catagories::all(),"product" => $product,"thumbs" => $thumbs]);

    }

    public function DeleteImages($id,Request $request){
        foreach($request->input("imageToDelete") as $image){
            $image = Thumbs::find($image);
            $image->delete();
        }

        return redirect("/admin/products/edit/" . $id);
    }

    public function SaveChanges(Request $request){

         //setting up database row
         $product = Product::find($request->input("id"));
         $product->pr_title = $request->input("title");
         $product->is_feature = ($request->input("isFeatured") == null ? 0 : 1);
         $product->cat_id = $request->input("category");
         $product->status = $request->input("status");
         $product->s_status = $request->input("stockStatus");
         $product->short_des = $request->input("shortDescription");
         $product->long_des =  htmlentities($request->input("description"));
         $product->meta_key = $request->input("metaKeywords");
         $product->meta_des = $request->input("metaDescription");
        // $product->SKU = "Usm-$skuNumber";
         $product->salesPrice= $request->input("salesPrice");
         $product->machineCondition = $request->input("condition");
         $product->price = $request->input("purchasePrice");
         $product->location = $request->input("location");
         $product->deliveryTime = $request->input("deliveryTime");
         $product->deliveryTerms = $request->input("deliveryTerms");
         $product->paymentTerms = $request->input("paymentTerms");
         $product->waysOfPayments = $request->input("waysOfPayments");
         $product->termsAndCondition = $request->input("terms");
         //uploading featured image
        if($request->file("fileToUpload") != null){
            $path = $request->file("fileToUpload")->store("products");
            $pathTokens = explode("/",$path);
            $fileName = $pathTokens[1];
            $product->image = $fileName;
        }
         //upload other images
        foreach($request->file("filesToUpload") as $file){
            $path = $file->store("products");
            $pathTokens = explode("/",$path);
            $fileName = $pathTokens[1];
            $thumb = new Thumbs();
            $thumb->file_name = $fileName;
            $thumb->org_id = $product->id;
            $thumb->save();
        }
         $product->save();
         $thumbs = Thumbs::where("org_id",$product->id)->get();
         return view("admin.ProductEditForm",["categories" => Catagories::all(),"product" => $product,"thumbs" => $thumbs,"message" => "Product Edit Successfully"]);


    }
}
