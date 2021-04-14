<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;
use App\Catagories;
use App\Product;
use App\News;
use App\SavedTemplate;
use App\Testimonial;
use App\Reference;
use App\Event;
use App\Machine;
use App\EventPicture;
use App\PartCatagory;
use App\PartsSubCatagory;
use App\SparePart;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;
use Mpdf\Mpdf;
use App\Thumbs;
use App\UploadedMachine;
use App\Common;
use App\UploadedThumbs;
use App\Subscriber;
use App\Purchase;
use Mail;
use App\Mail\SendMail;
use App\News_Image;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;






class Home extends Controller
{

    public function privacyPolicy()
    {
        return view("policy");
    }
    public function all(Request $request)
    {

        // $watermark = url('public/imgs/confetti.png');
        // $img = Image::make(public_path('imgs/0_HICLyAdNSIyT0ODU.jpg'));
        // $watermark = public_path('imgs/confetti.png');

        // $img->insert($watermark, 'bottom-right', 10, 10);
        // $img->save(public_path('imgs/main-new.png'));
        // dd("saved");



        $request->session()->forget("mode");
        $request->session()->put("mode", "all");
        $allCatagories = Catagories::where('id', ">=", 1)->orderBy("order", "asc")->get();
        $allProducts = Product::all()->sortByDesc("id");
        $allProductsJustIn = Product::where('id', ">=", 1)->where('s_status', 'Just In')->orderBy("id", "desc")->get();

        $allProductsSold = Product::where('id', ">=", 1)->where('s_status', 'SOLD')->orderBy("id", "desc")->get();
        return view("machinesView", ["allCatagories" => $allCatagories, "allProductsJustIn" =>  $allProductsJustIn, "allProductsSold" => $allProductsSold, "selectedCat" => "all"]);
    }



    // public function fetchAllMachines()
    // { 
    // $allCatagories = Catagories::where('id',">=",1)->orderBy("order","asc")->get();
    // $allProducts = Product::where('s_status','sold')->sortByDesc("id");
    // return view("machinesView",["allCatagories" => $allCatagories,"allProducts" => $allProducts,"selectedCat" => "*"]);
    // }

    public function fetchFewMachines($cat_id, Request $request)
    {

        session()->put('remove', 'true');
        $request->session()->forget("mode");
        $request->session()->put("mode", "single");

        $allCatagories = Catagories::where('id', ">=", 1)->orderBy("order", "asc")->get();
        $allProductsJustIn = Product::where('cat_id', $cat_id)->where('s_status', 'Just In')->orderBy("id", "desc")->get();
        $allProductsSold = Product::where('cat_id', $cat_id)->where('s_status', 'SOLD')->orderBy("id", "desc")->get();
        return view("machinesView", ["allCatagories" => $allCatagories, "allProductsJustIn" =>  $allProductsJustIn, "allProductsSold" => $allProductsSold, "selectedCat" => $cat_id]);
    }
    public function GeneratePdf($id)
    {

        $product = Product::find($id);
        $thumbs = $product->Thumbs();


        $mpdf = new Mpdf(['setAutoTopMargin' => 'pad']);
        $logoPath = public_path() . "\imgs\logo.png";
        $mpdf->SetHTMLHeader(
            '
        <div>
        <table style="width:100%;margin:0px;">
          <tr>
          <td><h3 style="font-family:calibri;color:#034375">Used Sweden Machines</h3></td>
          <td rowspan="2"><img src="' . $logoPath . '" height="100px" width="140px"/></td>

          </tr>
          <tr>
              <td><p><span style="color:black;">Mob:</span> <a href="skype:+92(321)7415373?call" style="text-decoration:none;font-size:13px">+92 (321) 7415373</a></p><p><span style="color:black;">Landline:</span> <a href="skype:+92(55)3845988?call" style="text-decoration:none;font-size:13px">+92(55)3845988</a></p></td>
              <td><p><span style="color:black">Website:</span> <a href="https://www.usedswedenmachines.com">www.usedswedenmachines.com</a></p><p><span style="color:black">Email:</span> <a href="mailto:info@usm.com.pk">info@usm.com.pk</a></p></td>
          </tr>
        </table></div><hr style="margin:0px"/>'
        );

        $html = '<style>body{margin:0}</style>
          <h3 align="center" style="font-family:calibri;">' . $product->pr_title . '</h3>
          <table style="width:100%;font-family:calibri">
              <tr><td><b>SKU</b></td><td>' . $product->SKU . '</td></tr>
              <tr><td><b>Status</b></td><td>' . $product->s_status . '</td></tr>
              <tr><td><b>Condition</b></td><td>' . $product->machineCondition . '</td></tr>
              <tr><td colspan="2"><b>Machine has the following  cherectristics</b></td></tr>
              <tr><td colspan="2">' . $product->short_des . '</td></tr>
              <tr><td colspan="2">' . html_entity_decode($product->long_des) . '</td></tr>
              <tr><td><b>Delivery Time: </b></td><td>' . $product->deliveryTime . '</td></tr>
              <tr><td><b>Payment Terms: </b></td><td>' . $product->paymentTerms . '</td></tr>
              <tr><td><b>Ways of Payments</b></td><td>' . $product->waysOfPayments . '</td></tr>
              <tr><td colspan="2"><b>Second hand machine with not guarantee</b></td></tr>
              <tr><td colspan="2"><b>Machine Subject Prior to Sale</b></td></tr>
              <tr><td colspan="2"><b>Machine Images</b></td></tr>
            </table>
      ';
        $path = "http://usedswedenmachines.com/storage/app/products/";

        $newThumbs = [];
        $mainThumb = new Thumbs();
        $mainThumb->file_name = $product->image;
        array_push($newThumbs, $mainThumb);

        for ($i = 0; $i < count($thumbs); $i++) {
            array_push($newThumbs, $thumbs[$i]);
        }

        for ($i = 0; $i < count($newThumbs); $i += 2) {
            $image = $path . "/" . $newThumbs[$i]->file_name;

            $secondImage = null;
            $html .= '<img style=" padding:5px; height:250px" width="300" src="' . $image . '"/>';
            if (isset($newThumbs[$i + 1])) {
                $secondImage = $path . "/" . $newThumbs[$i + 1]->file_name;
                $html .= '<img style=" padding:5px; height:250px" width="300" src="' . $secondImage . '"/>';
            }
        }


        $mpdf->WriteHTML($html);
        $mpdf->SetTitle($product->pr_title);
        $mpdf->Output($product->pr_title.'.pdf', 'I');
    }





    //generate news Pdf

    public function GeneratePdfNews($id)
    {
        $news = News::find($id);
        $thumb_nails = News_Image::where("news_id", $id)->get();

        $mpdf = new Mpdf(['setAutoTopMargin' => 'pad']);
        $logoPath = public_path() . "\imgs\logo.png";

        $mpdf->SetHTMLHeader(
            '
        <div>
        <table style="width:100%;margin:0px;">
          <tr>
          <td><h3 style="font-family:calibri;color:#034375">Used Sweden Machines</h3></td>
          <td rowspan="2"><img src="' . $logoPath . '" height="100px" width="140px"/></td>

          </tr>
          <tr>
              <td><p><span style="color:black;">Mob:</span> <a href="skype:+92(321)7415373?call" style="text-decoration:none;font-size:13px">+92 (321) 7415373</a></p><p><span style="color:black;">Landline:</span> <a href="skype:+92(55)3845988?call" style="text-decoration:none;font-size:13px">+92(55)3845988</a></p></td>
              <td><p><span style="color:black">Website:</span> <a href="https://www.usedswedenmachines.com">www.usedswedenmachines.com</a></p><p><span style="color:black">Email:</span> <a href="mailto:info@usm.com.pk">info@usm.com.pk</a></p></td>
          </tr>
        </table></div><hr style="margin:0px"/>'
        );


        $html = '<style>body{margin:0}</style>
          <h3 align="center" style="font-family:calibri;">' . $news->news_title . '</h3>
          <table style="width:100%;font-family:calibri">
              <tr><td><b>News Number</b></td><td>' . $news->id . '</td></tr>
              <tr><td><b>News Date</b></td><td>' . $news->news_date . '</td></tr>
              <tr><td colspan="2"><b>News Description</b></td></tr>
              <tr><td colspan="2">' . html_entity_decode($news->news_des) . '</td></tr>
            </table>
      ';
        $path = "http://usedswedenmachines.com/storage/app/products/";

        $newThumbs = [];
        $mainThumb = new Thumbs();
        $mainThumb->file_name = $news->image;
        array_push($newThumbs, $mainThumb);

        for ($i = 0; $i < count($thumb_nails); $i++) {
            array_push($newThumbs, $thumb_nails[$i]);
        }

        for ($i = 0; $i < count($newThumbs); $i += 2) {
            $image = $path . "/" . $newThumbs[$i]->file_name;

            $secondImage = null;
            $html .= '<img style=" padding:5px; height:250px" width="300" src="' . $image . '"/>';
            if (isset($newThumbs[$i + 1])) {
                $secondImage = $path . "/" . $newThumbs[$i + 1]->file_name;
                $html .= '<img style=" padding:5px; height:250px" width="300" src="' . $secondImage . '"/>';
            }
        }


        $mpdf->WriteHTML($html);
        $mpdf->SetTitle($news->news_title);
       $mpdf->Output($news->news_title.'.pdf', 'I');
    }
    public function Main()
    {

        return redirect("/refurbished_tetra_pak_machines_supplier_home");
    }

    public function Index()
    {


        return view("welcome", ["statistics" => Catagories::ListWithTotal(), "totalMachines" => Catagories::getAllMachinesCount()]);
    }

    public function purchase()
    {
        return view('purchase');
    }
 public function purchaseForm(Request $request)
    {


        $machine = new UploadedMachine();
        $machine->company = $request->input("company");
        $machine->personName = $request->input("full_name");
        $machine->phone = $request->input("phone");
        $machine->email = $request->input("email");
        $machine->technicalSpecifications = $request->input("technical_specification");
        $machine->machineName = $request->input("machine_name");

         $path = $request->file("featuredImage")->store("products");
        $common = new Common();
        $path = $common->SimplifiedPath($path);

        $machine->featuredImage = $path;
        $machine->isApproved = 0;

   

       
  

        if ($request->file("otherImages") != null) {
            foreach ($request->file("otherImages") as $file) {
                $path =  $file->store("products");
                $path = $common->SimplifiedPath($path);
                $thumb = new UploadedThumbs();
                $thumb->thumb_name = $path;
                $thumb->machine_id = $machine->id;
                $thumb->save();
            }
           
        } 
             if($machine->save())
             {
                $request->session()->flash("success", "Your machine has been uploaded");
                $request = request()->all();
                $data =  $this->sendEmailFuction($request);
             }
             else {
            $request->session()->flash("danger", "OOPS! Something went wrong...");
              
             }




        return redirect()->back();


    }
   public function sendEmailFuction($getData)
    {
        
        $last_row = DB::table('uploaded_machines')->latest()->first();
        $id =  $last_row->id;
        $product = UploadedMachine::find($id);
        $all_contents = "<table width='80%' align='center'>
            
                    
                    <tr>
                        <td style='font-family:Times New Roman;' align='left'>
                        <h2 style='font-family:Times New Roman; margin-top:10px; color:#034375' ><b>Used Sweden Machines</b></h2>
                        <div style='margin-top:20px'>
                        <b style='font-size:17px'>Mob:</b> <a href='tel:+92 (321) 7415373' style='font-size:17px'>+92 (321) 7415373</a><br>
                        <b style='font-size:17px'>Landline:</b> <a href='tel:+92 (55) 3845988' style='font-size:17px'>+92 (55) 3845988</a>
                        </div>
                        </td>
                        <td>
                        <center>
                    <img src=" . URL::to('/') . '/public/imgs/logo.png' ." height='100px' width='135px' style='margin-left:40px; margin-top:-40px'>
                        <center>
                        </td>
                    <td style='font-family:Times New Roman;'  align='right'>
                    <div style='margin-top:55px'>
                        <b style='font-size:17px'>Website:</b> <a href='www.usedswedenmachines.com' style='font-size:17px'>www.usedswedenmachines.com</a><br>
                        <b style='font-size:17px'>Email:</b> <a href='mailto:info@usm.com.pk' style='font-size:17px'>info@usm.com.pk</a>
                    <div>
                        </td>
                    </tr>
                    <tr>
                    <td colspan='3' style='background-color:black; '><center><b style='font-size:17px; color:white'>".strtoupper( $product->company) ." Has Uploaded Machine Information</b></center></td>
                    </tr>
                    <br>
                
                    <tr style='padding:10px'>
                        <td colspan='3'>
                    <span align='right' style='font-size:15px'><b>Machine Name: </b>".$product->machineName."</span><br>
                    <span align='right' style='font-size:15px'><b>Your Name: </b>".$product->personName."</span><br>
                    <span align='right' style='font-size:15px'><b>Email ID: </b>".$product->email."</span><br>
                    <span align='right' style='font-size:15px'><b>Phone #: </b>".$product->phone."</span><br>
                    <span align='right' style='font-size:15px'><b>Technical Specification: </b>".$product->technicalSpecifications."</span>
                    </td>
                    </tr>
                    <br>
                  <tr style='padding:10px; margin:10px'>
                    <td colspan='3'>
                                            <hr style='border:2px solid black'>

            
                    
                    <span><img src=" . URL::to('/') . '/storage/app/products/' . $product->featuredImage . " height='200' ></span>
                    
                    </td>
                
                    </tr>
";



 

        $all_contents .= '</table>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <info@usm.com.pk>' . "\r\n";

        $subject = ucfirst($product->personName) . " Uploaded Machine At Used Sweden Machines";
        mail("purchase@usedswedenmachines.com", $subject, "$all_contents", $headers);
    }




    public function AddSubscriber(Request $request)
    {
        $message = "";
        if (!empty($request->email)) {
            $count = Subscriber::where("email_add", $request->email)->count();
            if ($count <= 0) {
                $newSubscriber = new Subscriber();
                $newSubscriber->title = "Subscriber";
                $newSubscriber->email_add = $request->email;
                $newSubscriber->country = "country";
                $newSubscriber->selected_language = "English";
                $newSubscriber->save();
                $message = "Your subscription recoreded successfully";
            } else {
                $message = "You are already a subscriber";
            }
        }
        return view("welcome", ["message" => $message, "statistics" => Catagories::ListWithTotal(), "totalMachines" => Catagories::getAllMachinesCount()]);
    }

    public function About()
    {
        return view("about");
    }

    public function MachineViewFromSharing($id, Request $request)
    {
        $productToDisplay = Product::find($id);
        $nextMachine = $productToDisplay->next();
        if ($nextMachine != null) {
            $str = preg_replace("/(™|®|©|&trade;|&reg;|&copy;|&#8482;|&#174;|&#169;)/", "", $nextMachine->pr_title);
            $str = str_replace(" ", "-", $str);
        } else {
            $str = null;
        }
        if ($request->session()->get("mode") == "all") {
            $request->session()->put("selectedCat", "*");
        } else {
            $request->session()->put("selectedCat", $productToDisplay->cat_id);
        }
        return view("displayProduct", ["product" => $productToDisplay, "next" => $str, "id" => $id]);
    }

    public function FetchMachine($id, Request $request)
    {
        $allProducts = Product::all();
        $productToDisplay = null;
        foreach ($allProducts as $product) {
            $str = preg_replace("/(™|®|©|&trade;|&reg;|&copy;|&#8482;|&#174;|&#169;)/", "", $product->pr_title);
            $str = str_replace(" ", "-", $str);
            $idToken = explode("&", $id);
            if ($str == $idToken[0]) {
                $productToDisplay = $product;
                break;
            }
        }

        if ($productToDisplay == null) {
            return redirect("/");
        } else {
            $nextMachine = $productToDisplay->next();
            if ($nextMachine != null) {
                $str = preg_replace("/(™|®|©|&trade;|&reg;|&copy;|&#8482;|&#174;|&#169;)/", "", $nextMachine->pr_title);
                $str = str_replace(" ", "-", $str);
            } else {
                $str = null;
            }
            if ($request->session()->get("mode") == "all") {
                $request->session()->put("selectedCat", "*");
            } else {
                $request->session()->put("selectedCat", $productToDisplay->cat_id);
            }
        }
        $agent = new Agent();
        if (!$agent->isMobile()) {
            return view("displayProduct", ["product" => $productToDisplay, "next" => $str, "id" => $id]);
        } else {
            return view("mobile.displayProduct", ["product" => $productToDisplay, "next" => $str, "id" => $id]);
        }
    }

    public function TechnicalServices()
    {

        return view("technicalServices");
    }



    public function AllMachines(Request $request)
    {
        $allCatagories = Catagories::where('id', ">=", 1)->get();
        $selected = $request->session()->get("selectedCat");
        $request->session()->put("mode", "all");
        $allProductsJustIn = Product::where('id', ">=", 1)->where('s_status', 'Just In')->orderBy("id", "desc")->get();
        $allProductsSold = Product::where('id', ">=", 1)->where('s_status', 'SOLD')->orderBy("id", "desc")->get();
        return view("machinesView", ["allCatagories" => $allCatagories, "allProductsJustIn" =>  $allProductsJustIn, "allProductsSold" => $allProductsSold, "selectedCat" => $selected]);
    }


    public function SpareParts(Request $request)
    {
        //        $agent = new Agent();
        //        if(!$agent->isMobile()){
        $allMachines = Machine::all();
        $allSpareParts = SparePart::all();
        return view("machineView", ["machines" => $allMachines, "parts" => $allSpareParts]);
        //        }else{
        //
        //            $allMachines = Machine::all();
        //            $allSpareParts = SparePart::all();
        //
        //            if($request->has("machineId") && $request->machineId != "*"){
        //                $allSpareParts = SparePart::where("machine_id",$request->machineId)->get();
        //                if($request->has("catagories") && $request->catagories != "*"){
        //                    echo "Sub category checking";
        //                    $allSpareParts = SparePart::where("machine_id",$request->machineId)
        //                    ->where("category",$request->catagories)
        //                    ->get();
        //
        //                    if($request->has("subCat") && $request->subCat != "*"){
        //                        $allSpareParts = SparePart::where("machine_id",$request->machineId)
        //                        ->where("category",$request->categories)
        //                        ->where("sub_category",$request->subCat)
        //                        ->get();
        //                    }
        //
        //                }
        //
        //
        //            }
        //
        //
        //            return view("mobile.spareparts",["parts" => $allSpareParts,"machines" => $allMachines]);
        //        }
    }

    public function ShowSparePartCategories($machineId)
    {
        $categories = PartCatagory::where("machine_id", $machineId)->get();
        $allMachines = Machine::all();
        $selectedMachine = Machine::where("id", $machineId)->first();
        $subCategories = PartsSubCatagory::where("machine_id", $machineId)->get();

        return view("categoriesGrid", ["machineId" => $machineId, "categories" => $categories, "machines" => $allMachines, "subCategories" => $subCategories, "selectedMachine" => $selectedMachine]);
    }

    public function DisplaySpareParts(Request $request)
    {

        $allParts = null;
        if ($request->input("machineId") != null && $request->input("cat_id") == null && $request->input("subcat_id") == null) {
            $allParts = SparePart::where("machine_id", $request->input("machineId"))->get();
        } else if ($request->input("machineId") != null && $request->input("cat_id") != null && $request->input("subcat_id") == null) {
            $allParts = SparePart::where("machine_id", $request->input("machineId"))->where("category", $request->input("cat_id"))->get();
        } else if ($request->input("machineId") != null && $request->input("cat_id") != null && $request->input("subcat_id") != null) {
            $allParts = SparePart::where("machine_id", $request->input("machineId"))->where("category", $request->input("cat_id"))->where("sub_category", $request->input("subcat_id"))->get();
        }

        $machineId = $request->input("machineId");
        $categories = PartCatagory::where("machine_id", $machineId)->get();
        $allMachines = Machine::all();
        $subCategories = PartsSubCatagory::where("machine_id", $machineId)->get();
        $selectedMachine = Machine::where("id", $machineId)->first();
        return view("partsForShopping", ["spareParts" => $allParts, "machineId" => $machineId, "categories" => $categories, "machines" => $allMachines, "subCategories" => $subCategories, "selectedMachine" => $selectedMachine]);
    }

    public function FetchNews(Request $request)
    {
        $data = [];
        $mode = "news";
        if ($request->input("news_type") == null) {
            $data = News::where("id", ">=", 1)->orderBy("id", "desc")->get();
        } else if ($request->input("news_type") == "newsletter") {
            $data =  SavedTemplate::all();
            $mode = "newsletter";
        } else if ($request->input("news_type") == "testimonials") {
            $mode = "testimonials";
            $data = Testimonial::where("testimonialId", ">=", 1)->orderBy("testimonialId", "desc")->get();
        } else if ($request->input("news_type") == "references") {
            $data = Reference::where("referenceId", ">=", 1)->get();
            $mode = "references";
        } else {
            $data = Event::where("eventId", ">=", 1)->orderBy("eventId", "desc")->get();
            $mode = "events";
        }
        return view("news", ["data" => $data, "mode" => $mode]);
    }

    public function SubscriptionWithNews(Request $request)
    {

        $message = "";
        if (!empty($request->email)) {
            $count = Subscriber::where("email_add", $request->email)->count();
            if ($count <= 0) {
                $newSubscriber = new Subscriber();
                $newSubscriber->title = "Subscriber";
                $newSubscriber->email_add = $request->email;
                $newSubscriber->country = "country";
                $newSubscriber->selected_language = "English";
                $newSubscriber->save();
                $message = "Your subscription recoreded successfully";
            } else {
                $message = "You are already a subscriber";
            }
        }




        $data = [];
        $mode = "news";
        if ($request->input("news_type") == null) {
            $data = News::where("id", ">=", 1)->orderBy("id", "desc")->get();
        } else if ($request->input("news_type") == "newsletter") {
            $data =  SavedTemplate::all();
            $mode = "newsletter";
        } else if ($request->input("news_type") == "testimonials") {
            $mode = "testimonials";
            $data = Testimonial::where("testimonialId", ">=", 1)->orderBy("testimonialId", "desc")->get();
        } else if ($request->input("news_type") == "references") {
            $data = Reference::where("referenceId", ">=", 1)->get();
            $mode = "references";
        } else {
            $data = Event::where("eventId", ">=", 1)->orderBy("eventId", "desc")->get();
            $mode = "events";
        }
        return view("news", ["data" => $data, "mode" => $mode, "message" => $message]);
    }

    public function ContactForm()
    {

        return view("contactForm");
    }
    public function ContactFormSubmit(Request $request)
    {

        $newSubscriber = new Subscriber();
        $newSubscriber->title = "Contact Us";
        $newSubscriber->email_add = $request->input('email');
        $newSubscriber->country = 'country';
        $newSubscriber->selected_language = "English";
        $newSubscriber->save();

        $to = "inquiry@trepak.pk"; //inquiry@trepak.pk
        //$to = "inquiry@trepak.pk";
        $subject = "Email from contact page.  Used Sweden Machines";
        $message = 'This Email is from Contact page - Used Sweden Machines' . "\n";
        $message .= 'Name: ' . $request->input('name') . "\n";
        $message .= 'Company:  ' .  $request->input('company') . "\n";
        $message .= 'Phone #:  ' .  $request->input('phone') . "\n";
        $message .= 'Email:  ' .  $request->input('email') . "\n";
        //$message .='Use:  '.  $POST['use'] ."\n";
        //$message .='Subject: '.  $_POST['sbj']."\n";
        $message .= 'Country:  ' .  $request->input('country') . "\n";
        $message .= 'Message:  ' .  $request->input('message') . "\n";
        $message .= "This email is backed up into database also";


        //$message .= 'Message:  '.$_POST['ueberpruefung'];

        $header = 'From:' . $request->input('email');

        //captcha integration
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $testdata = [
            "secret" => "6LeZq9gUAAAAAJeFL1UopthwusHQBs_ntRx92S78",
            "response" => $_POST["_token"],
            "remoteip" => $_SERVER["REMOTE_ADDR"]
        ];

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($testdata)
            )
        );


        //captcha integration ended
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        $res = json_decode($response, true);

        if ($res['success'] == true) {


            if (mail($to, $subject, $message, $header))
                $messageFlush = "success";
            else
                $messageFlush = "error";
        } else {
            $messageFlush = "error";
        }


        echo $messageFlush;
    }
    public function ContactFormSubmitFromMobile()
    {

        $to = "inquiry@trepak.pk"; //inquiry@trepak.pk
        //$to = "inquiry@trepak.pk";
        $subject = "Email from contact page.  Used Sweden Machines";
        $message = 'This Email is from Contact page - Used Sweden Machines' . "\n";
        $message .= 'Name: ' . $_GET['Name'] . "\n";
        $message .= 'Company:  ' .  $_GET['Company'] . "\n";
        $message .= 'Phone #:  ' .  $_GET['Telephone'] . "\n";
        $message .= 'Email:  ' .  $_GET['emailAddress'] . "\n";
        //$message .='Use:  '.  $POST['use'] ."\n";
        //$message .='Subject: '.  $_POST['sbj']."\n";
        $message .= 'Message:  ' .  $_GET['Message'] . "\n";
        $message .= "This email is backed up into database also";

        //$message .= 'Message:  '.$_POST['ueberpruefung'];

        $header = 'From:' . $_GET['EmailFrom'];


        $retval = mail($to, $subject, $message, $header);

        return "Your mail has been sent successfully!";
    }

    public function SingleEvent($eventId)
    {
        $event = Event::find($eventId);
        $eventPictures = EventPicture::where("eventId", $eventId)->get();
        return view("singEventPage", ["event" => $event, "pictures" => $eventPictures]);
    }

    public function FetchNewsById($newsId)
    {
        $news = News::find($newsId);
        return view("singleNewsPage", ["news" => $news]);
    }

    public function SingleNewsLetter($id)
    {
        $newsLetter = SavedTemplate::find($id);
        return view("singleNewsLetter", ["newsLetter" => $newsLetter, "id" => $id]);
    }

    public function sendmail()
    {
        Mail::send(new SendMail());
    }
    public function email()
    {
        return view('email');
    }

    public function QuoteForm($id, Request $request)
    {
        $product = Product::find($id);
        $nextMachine = $product->next();
        if ($nextMachine != null) {
            $str = preg_replace("/(™|®|©|&trade;|&reg;|&copy;|&#8482;|&#174;|&#169;)/", "", $nextMachine->pr_title);
            $str = str_replace(" ", "-", $str);
        } else {
            $str = null;
        }
        if ($request->session()->get("mode") == "all") {
            $request->session()->put("selectedCat", "*");
        } else {
            $request->session()->put("selectedCat", $product->cat_id);
        }

        return view("quote_form", ["product" => $product, "next" => $str]);
    }

    public function QuoteFormContactUs(Request $request)
    {

        $to = "info@usm.com.pk";
        $subject = "Email from Machine page. Price Query.";
        $message = 'This Email is for Price Query - ' . request('machine_name') . '  - Used Sweden Machines' . "\n";
        if(request('page')=='desktop')
        {
            $message .= 'Machine Name: ' . request('machine_name') . "\n";
        $message .= 'Item #:  ' .  request('serial_no') . "\n";
        }
        $message .= 'Name :  ' . request('full_name') . "\n";
        $message .= 'Phone #:  ' . request('phone') . "\n";
        $message .= 'Email:  ' .  request('email') . "\n";
        $message .= 'Company:  ' . request('company')  . "\n";

        $message .= 'Special Request:  ' .  request('message') . "\n";
        $message .= "This email is fully backed up in database";

        $header = 'From:' . request('email');


        if (mail($to, $subject, $message, $header))
            $flash_message = "success";
        else
            $flash_message = "error";

        echo $flash_message;
    }
    public function QuoteFormSubmit($id)
    {
         $to = "info@usm.com.pk";
        $subject = "Email from Machine page. Price Query.";
        $message = 'This Email is for Price Query - ' . request('machine_name') . '  - Used Sweden Machines' . "\n";
        $message .= 'Sender:  ' .  request('email') . "\n";
        $message .= 'Machine Name: ' . request('machine_name') . "\n";
        $message .= 'Item #:  ' .  request('serial_no') . "\n";
        $message .= 'Name :  ' . request('full_name') . "\n";
        $message .= 'Phone #:  ' . request('phone') . "\n";

        $message .= 'Company:  ' . request('company')  . "\n";

        $message .= 'Special Request:  ' .  request('request') . "\n";
        $message .= "This email is fully backed up in database";

        $header = 'From:' . request('email');

         if (mail($to, $subject, $message, $header))
            $messageFlush = true;
        else
            $messageFlush = false;
        return redirect()->back()->with('message', $messageFlush);
    }

    public function UploadMachineForm()
    {
        return view("uploadMachineForm");
    }

    public function DisplayCart(Request $request)
    {


        return view("cart", ["items" => $request->session()->get("cartData")]);
    }

    public function ProcessMachine(Request $request)
    {
        $machine = new UploadedMachine();
        $machine->company = $request->input("company");
        $machine->personName = $request->input("name");
        $machine->phone = $request->input("phone");
        $machine->email = $request->input("email");
        $machine->technicalSpecifications = $request->input("technicalSpecifications");
        $machine->machineName = $request->input("machineName");
        $machine->save();

        $path = $request->file("featuredImage")->store("products");
        $common = new Common();
        $path = $common->SimplifiedPath($path);

        $machine->featuredImage = $path;
        $machine->isApproved = 0;
        $machine->save();

        if ($request->file("otherImages") != null) {
            foreach ($request->file("otherImages") as $file) {
                $path =  $file->store("products");
                $path = $common->SimplifiedPath($path);
                $thumb = new UploadedThumbs();
                $thumb->thumb_name = $path;
                $thumb->machine_id = $machine->id;
                $thumb->save();
            }
        }
        session()->put('success', "hello");

        return redirect()->back();
        //
    }
}
