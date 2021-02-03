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
        return view("admin.showAllContacts");
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
        $type = $request->session()->get("currentContactTypeId");

        $contact = contact::where("contactUdId", $id)->where("contactTypeId", $type)->first();
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
            $contacts = contact::where("contactTypeId", $id)->get();
            foreach ($contacts as $contact) {
                $buyProducts = CustomerProduct::where("buyOrSell", 1)->where("customer_spplier_id", $contact->contactId)->get();
                $contact->buyProductRate = $buyProducts;

            }

            foreach ($contacts as $contact) {
                $buyProducts = CustomerProduct::where("buyOrSell", 2)->where("customer_spplier_id", $contact->contactId)->get();
                foreach ($buyProducts as $buyProduct) {
                    $contact->sellProductRate = $buyProducts;
                }
            }

            return $contacts;
        } else {
            $allEngineers = Engineer::all();
            foreach ($allEngineers as $engineer) {
                $otherInfo = EngineerTeam::find($engineer->engineerId);
                $engineer->dateOfBirth = $otherInfo->dateOfBirth;
                $engineer->nationality = $otherInfo->nationality;
                $engineer->country = $otherInfo->country;
                $engineer->experienceMechanic = $otherInfo->experienceMechanic;
            }
            return $allEngineers;
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
