<?php

namespace App\Http\Controllers;

use App\CustomerProduct;
use Illuminate\Http\Request;
use App\contact;
use App\ContactTeam;
use App\Engineer;
use App\EngineerTeam;
use App\Designation;
use App\Service;
use App\ContactHead;
use App\Subscriber;
use App\Country;
use App\Common;
use DB;

class Contacts extends Controller
{

    public function Index()
    {
        return view("admin.contacts_home");
    }

    public function EditContactForm(Request $request, $id)
    {
        $type = $request->session()->get("currentContactTypeId");

        return view("admin.editContactForm", ["id" => $id, "type" => $type]);
    }

    public function ShowAllContacts()
    {
       $firstContactType=ContactHead::first();
       $allContactsType=ContactHead::get();
       
       $contacts = contact::where('contactTypeId',$firstContactType->id)->get();

          
        return view("admin.showAllContacts",['allContacts' => $contacts,'allTypes' => $allContactsType ,'id' =>'empty']);
    }
     
    public function ShowSingleContacts(Request $request)
    {
       
        $allContactsType=ContactHead::get();
        if($request->id!=6)
        {
            $contacts = contact::where('contactTypeId',$request->id)->get();
        }
        else{
            $contacts = Engineer::all();
            foreach ($contacts as $engineer) {
                $otherInfo = EngineerTeam::find($engineer->engineerId);
                $engineer->dateOfBirth = $otherInfo->dateOfBirth;
                $engineer->nationality = $otherInfo->nationality;
                $engineer->country = $otherInfo->country;
                $engineer->experienceMechanic = $otherInfo->experienceMechanic;
            }
           
        }

       
    return view("admin.showAllContacts",['allContacts' => $contacts,'allTypes' => $allContactsType,'id' => $request->id ]);
    }

    public function DeleteEngineer(Request $request)
    {
   
$eng=Engineer::where('engineerId',$request->id)->delete();
$eng_team=EngineerTeam::where('engineerId',$request->id)->delete();
if($eng && $eng_team )
     echo "success";
    else
        echo "error";
    }
    
 
    public function EditEngineer($id)
    {
        $eng=Engineer::where('engineerId',$id)->get()->first();
        $eng_team=EngineerTeam::where('engineerId',$id)->get()->first();
        $allCounteries=Country::get();
       return view("admin.editEngineer",['allCounteries' => $allCounteries,'engineer' => $eng,'engineer_team' =>$eng_team  ]);
    }
 public function ViewEngineer($id)
 {
    $eng=Engineer::where('engineerId',$id)->get()->first();
    $eng_team=EngineerTeam::where('engineerId',$id)->get()->first();
 
   return view("admin.view-engineer",['engineer' => $eng,'engineer_team' =>$eng_team  ]);
  
 }
    public function UpdateEngineer(Request $request)
    {
        $eng = Engineer::where('engineerId',$request->id)->get()->first();
  
        $eng->teamPersonName = $request->name;
        $eng->email = $request->email;
        $eng->mobileNo = $request->mob_no;
        $eng->linkedIn = $request->linkdin;
       

        $eng_team = EngineerTeam::where('engineerId',$request->id)->get()->first();

        $eng_team->cnicPassport = $request->cnic;
        $eng_team->nationality = $request->nationality;
        $eng_team->dateOfBirth = $request->dob;
        $eng_team->experienceMechanic = $request->jcp;
        $eng_team->workshopDetails = $request->wdetails;
       $eng_team->country = $request->country;
        
       
      if(( $eng->save()) && ($eng_team->save()))
      return redirect()->route('allContacts');
      else
      echo "not updated";
    }
    public function Head()
    {

        return view("admin.contactHeads", ["heads" => ContactHead::all()]);
    }

    public function EditHead(Request $request)
    {
        $headToEdit = ContactHead::find($request->id);
        $headToEdit->name = $request->name;
        $headToEdit->save();
        echo "Saved";
    }


    public function SaveHead(Request $request)
    {
        //creation of head id
        $lastHead = ContactHead::where("id", ">=", 0)->orderBy("id", "desc")->first();
        $idToApply = $lastHead->id;
        $idToApply++;
        //creation of new head
        $head = new ContactHead();
        $head->id = $idToApply;
        $head->name = $request->input("headName");
        $head->save();
        return view("admin.contactHeads", ["heads" => ContactHead::all(), "message" => "New head saved successfully"]);
    }

    public function Subscribers()
    {
        return view("admin.subscribers", ["subscribers" => Subscriber::all()]);
    }

    public function RemoveSubscriber($id)
    {
        $subscriberToRemove = Subscriber::find($id);
        $subscriberToRemove->delete();
        return redirect("admin/contacts/subscribers");
    }

    public function SubscriberEditForm($id)
    {
        $subscriberToEdit = Subscriber::find($id);
        return view("admin.editSubscriberForm", ["subscriber" => $subscriberToEdit]);
    }

    public function SaveSubscriberChanges($id, Request $request)
    {
        $subscriberToEdit = Subscriber::find($id);
        $subscriberToEdit->email_add = $request->email;
        $subscriberToEdit->save();
        return view("admin.editSubscriberForm", ["subscriber" => $subscriberToEdit, "message" => "Subscriber Updated Successfully"]);
    }


    public function Countries()
    {
        return view("admin.countries", ["countries" => Country::all()]);
    }

    public function SaveCountry(Request $request)
    {
        $country = new Country();
        $country->country_code = $request->shortCode;
        $country->country_name = $request->countryName;
        $country->population = $request->population;
        $country->gdb = $request->gdb;
        $country->exports = $request->exports;
        $country->imports = $request->imports;
        $country->language = $request->language;
        $country->currency = $request->currency;

        if ($request->file("countryFlag") != null) {
            $path = $request->file("countryFlag")->store("cms/countries");
            $common = new Common();
            $name = $common->SimplifiedPath($path);
            $country->picUrl = $name;

        }

        $country->save();

        return view("admin.countries", ["countries" => Country::all(), "message" => "Country saved successfully"]);
    }

    public function EditCountryForm($id)
    {
        $country = Country::find($id);
        return view("admin.editCountryForm", ["country" => $country]);
    }

    public function CountrySaveChanges(Request $request, $id)
    {
        $country = Country::find($id);
        $country->country_code = $request->countryCode;
        $country->country_name = $request->countryName;
        $country->population = $request->population;
        $country->gdb = $request->gdb;
        $country->exports = $request->exports;
        $country->imports = $request->imports;
        $country->language = $request->language;
        $country->currency = $request->currency;

        if ($request->file("flag") != null) {
            $path = $request->file("flag")->store("cms/countries");
            $common = new Common();
            $name = $common->SimplifiedPath($path);
            $country->picUrl = $name;

        }

        $country->save();
        return view("admin.editCountryForm", ["country" => $country, "message" => "Country Updated Successfully"]);
    }

    public function New()
    {
        return view("admin.newcontact");
    }

    public function SingleContact(Request $request, $id)
    {
    //      $request->session()->put("currentContactTypeId", $id);
    //     $type = $request->session()->get("currentContactTypeId");

        $contact = contact::where("contactId", $id)->first();
        $productBuy = $contact->BuyProducts();
        $sellProducts = $contact->SellProducts();
        $referenceCustomers = explode(",", $contact->referenceCustomers);
        return view("admin.singleContact", ["contact" => $contact, "buyProducts" => $productBuy, "sellProducts" => $sellProducts, "references" => $referenceCustomers]);
    }

    public function Designations()
    {
        return view("admin.allDesignations", ["designations" => Designation::where("designationId", ">=", 1)->orderBy("name", "asc")->get()]);
    }

    public function AddDesignation(Request $request)
    {
        $designationName = $request->input("designationName");
        $designation = new Designation();
        $designation->name = $designationName;
        $designation->save();
        return view("admin.allDesignations", ["designations" => Designation::where("designationId", ">=", 1)->orderBy("name", "asc")->get(), "message" => "Designation $designationName has been saved successfully"]);

    }


    public function Services(Request $request)
    {

        return view("admin.productServices", ["services" => Service::all()]);
    }


    public function SaveSearch(Request $request)
    {
        $service = new Service();
        $service->name = $request->service;
        $service->description = "";
        $service->saveDateTime = date("Y-m-d h:i:s");
        $service->save();

        return view("admin.productServices", ["services" => Service::all()]);
    }

    public function SingleService($id)
    {

        return view("admin.singleService", ["service" => Service::find($id)]);
    }

    public function ServiceEditForm($id)
    {
        return view("admin.editServiceForm", ["service" => Service::find($id)]);
    }

    public function RedirectToContact($udId, $typeId, Request $request)
    {

        $request->session()->put("currentContactTypeId", $typeId);

        return redirect("admin/contacts/singleContact/" . $udId);
    }


    //api functions
    public function FetchContacts(Request $request, $id)
    {

        $request->session()->put("currentContactTypeId", $id);
        if ($id != 6) {
            $allContacts = contact::where("contactTypeId", $id)->get();
     
            $output = "";
            $output .= "<thead>";
            $output .="
            <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Country</th>
            <th>Product</th>
            <th>Website</th>
            
        </tr> </thead>";
            $output .= "<tbody id='example'>";
               foreach ($allContacts as $contacts )
            {
                $output .= "<tr>";
                $output .= "<td>".$contacts['contactUdId']."</td>";
                $output .= "<td><a href='singleContact/".$contacts['contactId']."'>".$contacts['companyName']."</a></td>";
                $output .= " <td>".$contacts['country']."</td>";
                $output .="<td>".$contacts['productService']."</td>";
                
                $output .="<td>";
                $output .="<a href='".$contacts['web']."' target='_blank' class='btn btn-primary btn-sm'><i class='fab fa-internet-explorer'></i> Visit Site</a>";
                $output .="<a href='edit/".$contacts['contactUdId']."' class='btn btn-success btn-sm'><i class='fas fa-edit'></i> Quick Edit</a>";
                $output .="</td>";
                $output .= "</tr>";
            }
        
            $output .= "</tbody>";
            return $output;

            }

           
        else {
            $allEngineers = Engineer::all();
            foreach ($allEngineers as $engineer) {
                $otherInfo = EngineerTeam::find($engineer->engineerId);
                $engineer->dateOfBirth = $otherInfo->dateOfBirth;
                $engineer->nationality = $otherInfo->nationality;
                $engineer->country = $otherInfo->country;
                $engineer->experienceMechanic = $otherInfo->experienceMechanic;
            }
               
            $output = "";
            $output .= "<thead>";
            $output .="
            <tr>
            <th>Engineer ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Linked In</th>
            <th>Nationality</th>
            <th>Date of Birth</th>
            <th>Jobs Can Perform</th>
            <th>Operations</th>
        </tr> </thead><tbody id='example'>";
               foreach ($allEngineers as $engineer )
            {
                $output .= "<tr id='eng-".$engineer['engineerId']."'>";
                $output .= "<td>".$engineer['engineerId']."</td>";
                $output .= "<td><a href='#'>".$engineer['teamPersonName']."</a></td>";

                $output .="<td>".$engineer['email']."</td>";
                $output .="<td>".$engineer['mobileNo']."</td>";
                $output .="<td> <span>
                <a href='#".$engineer['linkedIn']."' target='_blank' class='btn btn-primary btn-sm' style='font-size:11px'>Visit Profile</a>
            </span></td>";

            
                $output .= "<td>".$engineer['nationality']."</td>";
                $output .= "<td>".$engineer['dateOfBirth']."</td>";
                $output .= "<td>".$engineer['experienceMechanic']."</td>";
                $output .="
                <td>
                <button  class='btn btn-primary btn-sm' title='View' onclick='deleteContact(this)' value='".$engineer['engineerId']."'><i class='fa fa-trash'></i></button>
                <a href='editEngineer/".$engineer['engineerId']."' class='btn btn-warning btn-sm' title='Quick Edit'><i class='fas fa-user-edit'></i></a>
                <a href='viewEngineer/".$engineer['engineerId']."' class='btn btn-warning btn-sm' title='view'><i class='fa fa-eye'></i></a>
                </td>
                ";
                $output .= "</tr>";
            }
            $output .= "</tbody>";
            return $output;
        }
    }


    public function UpdateDesignation(Request $request)
    {
        $id = $request->input("id");
        $newName = $request->input("newName");
        $currentDesignation = Designation::find($id);
        $oldName = $currentDesignation->name;
        $allContacts = contact::all();
        $recordsUpdated = 0;
        foreach ($allContacts as $c) {
            if ($c->productService == $oldName) {
                $c->productService = $newName;
                $c->save();
                $recordsUpdated++;
            }
        }

        $allTeam = ContactTeam::all();
        foreach ($allTeam as $member) {
            if ($member->designation == $oldName) {
                $member->designation = $newName;
                $member->save();
                $recordsUpdated++;
            }
        }

        $allEngineers = Engineer::all();
        foreach ($allEngineers as $engineer) {
            if ($engineer->designation == $oldName) {
                $engineer->designation = $newName;
                $recordsUpdated++;
            }
        }


        $currentDesignation->name = $newName;
        $currentDesignation->save();
        echo $recordsUpdated;


    }

    public function AllContactHeads()
    {
        return ContactHead::all();
    }

}
