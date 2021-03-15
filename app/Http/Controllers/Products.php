<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Product;
use App\Catagories;
use App\Thumbs;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Storage;
use App\UploadedMachine;
use Illuminate\Support\Facades\URL;
use App\ContactHead;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Session\Session;
use Image;

class Products extends Controller
{

    public function machine($machine_name, $id)
    {

        // $img = Image::make(public_path('imgs/0_HICLyAdNSIyT0ODU.jpg'));
        // $watermark = public_path('imgs/confetti.png');

        // $img->insert($watermark, 'bottom-right', 10, 10);
        // $img->save(public_path('imgs/main-new.png'));


        $pre = '';
        $next = '';
        $name='';
        if (session()->get("mode") == "all") {
            $machine = Product::find($id);
            $nextmachine = Product::where('id', '>', $machine->id)->orderBy('id', 'asc')->first();
            $next = '';
            if ($nextmachine) {
                $next = $nextmachine->id;
                $name = $nextmachine->pr_title;

            } else {
                $nextmachine = Product::where('id', '<', $machine->id)->orderBy('id', 'asc')->first();
                $next = $nextmachine->id;
                $name = $nextmachine->pr_title;

            }
            $pre = Product::where('id', '<', $id)->where('cat_id', $machine->cat_id)->orderBy('id', 'desc')->first();
            if ($pre) {
                $pre = $pre->id;
            } else {
                $pre = $id;
            }

            $allThumbs = Thumbs::where('org_id', $machine->id)->get();
            return view("displayProduct", ["product" => $machine, "allThumbs" => $allThumbs, "next" => $next, "name" => $name,"selectedCat" => 'all', "pre" => $pre]);
        }

        $machine = Product::find($id);
        $nextmachineid = Product::where('id', '>', $machine->id)->where('cat_id', $machine->cat_id)->orderBy('id', 'desc')->first();
        if (empty($nextmachineid)) {
            $nextmachineid = Product::where('id', '<', $machine->id)->where('cat_id', $machine->cat_id)->orderBy('id', 'asc')->first();
            if ($nextmachineid) {
                $next = $nextmachineid->id;
                $name = $nextmachineid->pr_title;


            } else {
                $next = '';
            }
        } else {
            $next = $nextmachineid->id;
                $name = $nextmachineid->pr_title;
            
        }
        $pre = Product::where('id', '<', $id)->where('cat_id', $machine->cat_id)->orderBy('id', 'desc')->first();
        if ($pre) {
            $pre = $pre->id;
        } else {
            $pre = $id;
        }
        $allThumbs = Thumbs::where('org_id', $machine->id)->get();
        return view("displayProduct", ["product" => $machine, "allThumbs" => $allThumbs, "next" => $next, "name" => $name, "selectedCat" => $machine->cat_id, "pre" => $pre]);
    }

    public function machineMobile($machine_name, $id)
    {

        $pre = '';
        $next = '';
        $machine = Product::find($id);
        $nextmachineid = Product::where('id', '>', $machine->id)->where('cat_id', $machine->cat_id)->orderBy('id', 'asc')->first();
        $pre = Product::where('id', '<', $id)->where('cat_id', $machine->cat_id)->orderBy('id', 'desc')->first();
        if ($nextmachineid) {
            $next = $nextmachineid->id;
        } else {
            $next = $id;
        }
        if ($pre) {
            $pre = $pre->id;
        } else {
            $pre = $id;
        }
        $allThumbs = Thumbs::where('org_id', $machine->id)->get();
        return view("displayProduct", ["product" => $machine, "allThumbs" => $allThumbs, "next" => $next, "selectedCat" => $machine->cat_id, "pre" => $pre]);
    }



    public function Index(Request $request)
    {

        $allProducts = Product::where("id", ">=", 1)->orderBy("id", "desc")->get();

        return view("admin.products_home", ["products" => $allProducts]);
    }
    public function viewProduct($id, Request $request)
    {
        $productFind = Product::where('id', $id)->get();

        return view("admin.product_view", ["product" => $productFind]);
    }
    public function sendMailOfProduct($id, Request $request)
    {
        $request = request()->all();
        /*return dd($this->sendEmailFuction($request,$id));*/
        $data = $this->sendEmailFuction($request, $id);
        return redirect()->back();
    }
    public function sendEmailFuction($getData, $id)
    {
        $product = Product::find($id);
        /*return $getData;*/
        $all_contents = "<table width='80%' border='0' align='center'>
					<tr>
					<td align='left'><a href='https://usedswedenmachines.com/'><img src='http://www.usedswedenmachines.com/public/imgs/logo.png' height='75' style='height: 144px;'></a></td>
					<td width='60%' align='right'>
					<p ><span style='color:#034375;font-weight:bold;font-size: 19px;'>Used Sweden Machines</span><br>
D.O.H.S 290, Phase 1 Gujranwala, Pakistan<br>
Company Registration No: <span style='color:#034375;font-weight:bold;'>4015134-4</span><br>
Tel.: +92(321)7415373<br>
 E-Mail: <a href='mailto:info@usedswedenmachines.com'>info@usedswedenmachines.com</a><br>
</p>
					</td>
					</tr>
					<tr>
					<td colspan='2' >
						<p align='center'><strong>" . $product->pr_title . "</strong></p><hr>
					</td>
					</tr>
					<tr>
						<td colspan='2'  align='left'>
						<a href='http://usedswedenmachines.com/machineView/" . $product->id . "' ><img src=" . URL::to('/') . '/storage/app/products/' . $product->image . " height='250' ></a>
						</td>
					</tr>
					<tr>
						<td  colspan='2' align='left'>
						<div class='st_div'>" . "Title: " . $product->pr_title . "<br>" . "SKU:  " . $product->SKU . "<br>" . "Specifications:" . html_entity_decode($product->long_des) . "</div>
						</td>
					</tr>";



        $all_contents .= "
                </table>";
        $all_contents .= '<table border="1" width="80%" align="center">';
        $all_contents .= '<tr><th align="left">Condition: </th><td>' .        $getData['condition'] . '</td></tr>';
        $all_contents .= '<tr><th align="left">Price: </th><td>' .            $getData['price'] . '</td></tr>';
        $all_contents .=    '<tr><th align="left">Terms & conditions:  </th><td>' .        $getData['tandc'] . '</td></tr>';
        $all_contents .=    '<tr><th align="left">Delivery time:  </th><td>' .        $getData['dt'] . '</td></tr>';
        $all_contents .=    '<tr><th align="left">Delivery Terms:  </th><td>' .        $getData['dtt'] . '</td></tr>';
        $all_contents .=    '<tr><th align="left">Payment terms:  </th><td>' .        $getData['pt'] . '</td></tr>';
        $all_contents .=    '<tr><th align="left">Way of Payment:  </th><td>' .        $getData['wop'] . '</td></tr>';
        $all_contents .= "<tr>
					<td colspan='2' align='center' width='80%'>
					<p style='padding-top: 10px;'> <span style='color:red;font-weight:bold;'>* CONDITION RATING </span><br>
<span style='color:red;font-weight:bold;'>1 = very good 2 = good 3 = fair 4 = poor 5 = very poor</span><br>
Tel +92-321-7415373  Fax +92-55-3845997     <a href='mailto:info@usedswedenmachines.com'>info@usedswedenmachines.com</a><br>
<a href='http://usedswedenmachines.com'>www.usedswedenmachines.com</a><br>

</p>
					</td>
					</tr>";

        $all_contents .= '</table>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <info@usedswedenmachines.com>' . "\r\n";

        $subject = $product->pr_title . " - Used Sweden Machines";
        mail("{$getData['receiver_id']}", $subject, "$all_contents", $headers);
    }


    public function SendMultipleEmail($id, Request $request)
    {
        $r = request()->all();

        foreach ($request->personEmail as $email) {
            $r["receiver_id"] = $email;
            $this->sendEmailFuction($r, $id);
        }
        $productFind = Product::where('id', $id)->get();
        $contactType = [
            ["id" => -1, "Name" => "Subscribed Emails"]
        ];
        $allContacts = ContactHead::all();
        foreach ($allContacts as $head) {
            array_push($contactType, ["id" => $head->id, "Name" => $head->name]);
        }


        return view('admin.sendMultipleView', ['product' => $productFind, "heads" => $contactType, "message" => "Email to multiple clients sent successfully"]);
    }


    public function sendToMultipleView($id)
    {
        $productFind = Product::where('id', $id)->get();
        $contactType = [
            ["id" => -1, "Name" => "Subscribed Emails"]
        ];
        $allContacts = ContactHead::all();
        foreach ($allContacts as $head) {
            array_push($contactType, ["id" => $head->id, "Name" => $head->name]);
        }


        return view('admin.sendMultipleView', ['product' => $productFind, "heads" => $contactType]);
    }




    public function ViewUploads()
    {
        return View("admin.uploadedProducts", ["products" => UploadedMachine::all()]);
    }


    //stock reporting methods
    public function GenerateReportWithPrice()
    {
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
        foreach ($allProducts as $p) {
            $bgColor = ($i % 2 == 0 ? 'white' : '#f8f8f8');
            $imageURL = url('/') . Storage::url('app/products/' . $p->image);
            $html .= "<tr style='background-color:$bgColor'><td>$p->SKU</td><td><img src='$imageURL' style='max-height:50px'/></td><td>$p->pr_title</td><td>$p->short_des</td><td>$p->s_status</td><td>$p->salesPrice</td></tr>";
            $i++;
        }



        $html .= "</table>";
        //end of writing custom html
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function GenerateReportWithoutPrice()
    {
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
        foreach ($allProducts as $p) {
            $bgColor = ($i % 2 == 0 ? 'white' : '#f8f8f8');
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

    public function ShowReportPerforma()
    {
        return view("admin.reportPerforma");
    }

    public function GenerateReport(Request $request)
    {
        if ($request->input("format") == 1) {
            $this->GenerateReportWithPrice();
        } else {
            $this->GenerateReportWithoutPrice();
        }
    }


    public function AddProductForm()
    {

        return view("admin.productForm", ["categories" => Catagories::all()]);
    }

    public function Save(Request $request)
    {


        //creating new sku
        $lastProduct = Product::where("id", ">=", 1)->orderBy("id", "desc")->first();
        if ($lastProduct != NULL) {
            $lastSKU = $lastProduct->SKU;
            $skuTokens = explode("-", $lastSKU);
            $skuNumber = $skuTokens[1];
            $skuNumber++;
        } else {
            $skuNumber = "SKU-1";
            $skuNumber++;
        }


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
        $product->salesPrice = $request->input("salesPrice");
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
        $pathTokens = explode("/", $path);
        $fileName = $pathTokens[1];
        $product->image = $fileName;
        $product->save();
        //upload other images

        if ($request->file("filesToUpload") != null) {

            foreach ($request->file("filesToUpload") as $file) {
                $path = $file->store("products");
                $pathTokens = explode("/", $path);
                $fileName = $pathTokens[1];
                $thumb = new Thumbs();
                $thumb->file_name = $fileName;
                $thumb->org_id = $product->id;
                $thumb->save();
            }
        }





        return view("admin.productForm", ["categories" => Catagories::all(), "message" => "Product Saved Successfully at sku $product->SKU"]);
        //
        //creating new sku
        //        $lastProduct = Product::where("id",">=",1)->orderBy("id","desc")->first();
        //        $lastSKU = $lastProduct->SKU;
        //        $skuTokens = explode("-",$lastSKU);
        //        $skuNumber="";
        ////        $skuNumber = $skuTokens[1];
        ////        $skuNumber++;
        //
        //
        //        //setting up database row
        //        $product = new Product();
        //        $product->pr_title = $request->input("title");
        //        $product->is_feature = ($request->input("isFeatured") == null ? 0 : 1);
        //        $product->cat_id = $request->input("category");
        //        $product->status = $request->input("status");
        //        $product->s_status = $request->input("stockStatus");
        //        $product->short_des = $request->input("shortDescription");
        //        $product->long_des =  htmlentities($request->input("description"));
        //        $product->meta_key = $request->input("metaKeywords");
        //        $product->meta_des = $request->input("metaDescription");
        //        $product->SKU = "Usm-$skuNumber";
        //        $product->salesPrice= $request->input("salesPrice");
        //        $product->machineCondition = $request->input("condition");
        //        $product->price = $request->input("purchasePrice");
        //        $product->location = $request->input("location");
        //        $product->deliveryTime = $request->input("deliveryTime");
        //        $product->deliveryTerms = $request->input("deliveryTerms");
        //        $product->paymentTerms = $request->input("paymentTerms");
        //        $product->waysOfPayments = $request->input("waysOfPayments");
        //        $product->termsAndCondition = $request->input("terms");
        //        //uploading featured image
        //        $image = time().'.'.$request->fileToUpload->extension();
        //        $request->fileToUpload->move('app/products', $image);
        //        $product->image = $image;
        //        $product->save();
        //upload other images

        //        if($request->file("filesToUpload") != null){
        //
        //            foreach($request->file("filesToUpload") as $file){
        //                $imagename=time().'.'.$file->extension();
        //                $path =$file->move(public_path('imgs/products',$imagename));
        //
        //               $thumb = new Thumbs();
        //                $thumb->file_name = $imagename;
        //                $thumb->org_id = $product->id;
        //                $thumb->save();
        //            }
        //        }





        //return view("admin.productForm",["categories" => Catagories::all(),"message" => "Product Saved Successfully at sku $product->SKU"]);
    }

    public function Remove($id)
    {
        $product = Product::find($id);
        $thumbs = Thumbs::where("org_id", $id)->get();
        foreach ($thumbs as $thumb) {
            $thumb->delete();
        }

        $product->delete();
        return redirect("/admin/products");
    }

    public function EditForm($id)
    {
        $product = Product::find($id);
        $thumbs =  Thumbs::where("org_id", $id)->get();
        return view("admin.ProductEditForm", ["categories" => Catagories::all(), "product" => $product, "thumbs" => $thumbs]);
    }

    public function DeleteImages($id, Request $request)
    {
        foreach ($request->input("imageToDelete") as $image) {
            $image = Thumbs::find($image);
            $image->delete();
        }

        return redirect("/admin/products/edit/" . $id);
    }

    public function SaveChanges(Request $request)
    {

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
        $product->salesPrice = $request->input("salesPrice");
        $product->machineCondition = $request->input("condition");
        $product->price = $request->input("purchasePrice");
        $product->location = $request->input("location");
        $product->deliveryTime = $request->input("deliveryTime");
        $product->deliveryTerms = $request->input("deliveryTerms");
        $product->paymentTerms = $request->input("paymentTerms");
        $product->waysOfPayments = $request->input("waysOfPayments");
        $product->termsAndCondition = $request->input("terms");
        //uploading featured image
        if ($request->file("fileToUpload") != null) {
            $path = $request->file("fileToUpload")->store("products");
            $pathTokens = explode("/", $path);
            $fileName = $pathTokens[1];
            $product->image = $fileName;
        }
        //upload other images
        if ($request->file("filesToUpload") != null) {
            foreach ($request->file("filesToUpload") as $file) {
                $path = $file->store("products");
                $pathTokens = explode("/", $path);
                $fileName = $pathTokens[1];
                $thumb = new Thumbs();
                $thumb->file_name = $fileName;
                $thumb->org_id = $product->id;
                $thumb->save();
            }
        }
        $product->save();
        $thumbs = Thumbs::where("org_id", $product->id)->get();
        return view("admin.ProductEditForm", ["categories" => Catagories::all(), "product" => $product, "thumbs" => $thumbs, "message" => "Product Edit Successfully"]);
    }
}
