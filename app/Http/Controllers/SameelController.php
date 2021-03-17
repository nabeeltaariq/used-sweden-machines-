<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class SameelController extends Controller
{


    public function updateCart(Request $request)
    {

        $partName = $request->input("part");
        $newQuantity = $request->input("qty");
        $cartData = [];
        $items = Session::get("cartData");

        foreach ($items as $item) {

            if ($partName == $item["partTitle"]) {
                $item["quantity"] = $newQuantity;
            }

            array_push($cartData, $item);
        }

        $request->session()->put("cartData", $cartData);
        return count($cartData);
    }
    public function cartUpdate(Request $request)
    {

        $partName = $request->input("part");
        $newQuantity = $request->input("qty");
        $cartData = [];
        $items = Session::get("cartData");

        foreach ($items as $item) {

            if ($partName == $item["partTitle"]) {
                $item["quantity"] = $newQuantity;
            }

            array_push($cartData, $item);
        }

        $request->session()->put("cartData", $cartData);
        return count($cartData);

    }

    public function ProcessLogin(Request $request)
    {
        $message = "";
        $user = DB::table("sp_userInformation")->where("email", $request->email)->where("password", base64_encode($request->password))->first();

        if ($user != null) {
            $request->session()->put("orderUser", $user);

            return redirect("/processOrder");
        } else {

            $message = "The user with this email or password not found";
        }

        return view("auth.auth", ["message" => $message]);
    }

    public function ProcessOrder(Request $request)
    {
        $user = $request->session()->get("orderUser");
        $cartData = $request->session()->get("cartData");
        $ordernum = DB::table('sp_order')->get('orderId')->last();


        if ($request->session()->has("tab")) {
            $area = $request->session()->get("tab");
        } else {
            $area = "Delivery Information";
        }




        return view("shipping", ["user" => $user, "cart" => $cartData, "area" => $area, "ordernum" => $ordernum->orderId]);
    }

    public function Checkout(Request $request)
    {
        if ($request->session()->has("cartData")) {
            $userinfo = $request->session()->get("orderUser");
            $cartData = $request->session()->get("cartData");

            $id = DB::table("sp_ordermaster")->insertGetId(["orderDateTime" => date("Y-m-d h:i:s"), "userId" => $userinfo->userId]);

            foreach ($cartData as $data) {
                $info = [
                    "partNo" => $data["partNo"],
                    "partTitle" => $data["partTitle"],
                    "unitPrice" => $data["price"],
                    "qty" => $data["quantity"],
                    "status" => $data["status"],
                    'userId' => $userinfo->userId,
                    'orderDate' => date("Y-m-d h:i:s"),
                    'orderMasterId' => $id

                ];
                DB::table("sp_order")->insert($info);
            }


            //email specimen
            $user = $userinfo;
            $emailcontent = '<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>';

            $emailcontent .= ' <div class="container">
    <div class="row">
    <div class="col-xs-8 col-md-9">
        <div class="invoice-title">
            <h2>Used Sweden Machines <sup>Purchase Invoice</sup></h2><h3 class="pull-right">Order # ' . $id . '</h3>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-9">
                <address>
                <strong>Billed To:</strong><br>
                    <strong>Company: </strong>' . $user->companyName . '<br>
                    ' . $user->address . '
                </address>
            </div>
            <div class="col-xs-12">
             
            </div>
             
        </div>
        <div class="row">
            <div class="col-xs-6">
                <address>
                    <strong>Payment Method:</strong><br>
                    ' . $user->paymentMode . '
                </address>
            </div>
            <div class="col-xs-6 text-right">
                <address>
                    <strong>Order Date:</strong><br>
                    ' . date("M") . date("d") . ', ' . date("Y") . '<br><br>
                </address>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>Order summary</strong></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">

                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <td><strong>Item</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                                <td class="text-center"><strong>Quantity</strong></td>
                                <td class="text-right"><strong>Totals</strong></td>
                            </tr>
                        </thead>
                        <tbody>';

            $subTotal = 0;
            foreach ($cartData as $item) {
                $subTotal += ($item["quantity"] * $item["price"]);
                $emailcontent .= '<tr>
                                    <td>' . $item["partTitle"] . '</td>
                                    <td class="text-center">$' . $item["price"] . '</td>
                                    <td class="text-center">' . $item["quantity"] . '</td>
                                    <td class="text-right">$' . $item["quantity"] * $item["price"] . '</td>
                                </tr>
                                ';
            }


            $emailcontent .= '

                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                <td class="thick-line text-right">$' . $subTotal . '</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Shipping</strong></td>
                                <td class="no-line text-right">$15</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Total</strong></td>
                                <td class="no-line text-right">$' . ($subTotal + 15) . '</td>
                            </tr>
                        </tbody>
                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        Thank you from purchasing @ Used Sweden Machines
                        </div>
                        <style>
                            .invoice-title h2, .invoice-title h3 {
                    display: inline-block;
                    }

                    .table > tbody > tr > .no-line {
                    border-top: none;
                    }

                    .table > thead > tr > .no-line {
                    border-bottom: none;
                    }

                    .table > tbody > tr > .thick-line {
                    border-top: 2px solid;
                    }

                    /* Hide scrollbar for Chrome, Safari and Opera */
                    .cotnainer::-webkit-scrollbar {
                    display: none;
                    }

                    /* Hide scrollbar for IE and Edge */
                    .container {
                    -ms-overflow-style: none;
                    }

                        </style>';


            $headersfrom = '';
            $headersfrom .= 'MIME-Version: 1.0' . "\r\n";
            $headersfrom .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headersfrom .= 'From: ' . 'no-replay@info@usm.com.pk' . ' ' . "\r\n";
            mail($user->email, "Purchase Invoice USM", $emailcontent, $headersfrom);


            $headersfrom = '';
            $headersfrom .= 'MIME-Version: 1.0' . "\r\n";
            $headersfrom .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headersfrom .= 'From: ' . $user->email . ' ' . "\r\n";
            mail('shahzaib@pms.net.pk', "Purchase Invoice USM", $emailcontent, $headersfrom);







            $request->session()->pull("cartData");


            return view("thankspage", ["user" => $userinfo, "orderId" => $id]);
        } else {
            return redirect("/cart");
        }
    }

    public function PushInfo(Request $request, $id)
    {

        if ($id == "deliveryInfo") {
            $user = $request->session()->get("orderUser");

            $info = [
                "companyName" => $request->companyName,
                "personName" => $request->personName,
                "address" => $request->addressLine1 . ' ' . $request->addressLine2,
                "city" => $request->city,
                "postCode" => $request->postCode,
                "countryCode" => $request->country,
                "phoneNo" => $request->phoneNumber,
                "sales_tax_no" => $request->sales_tax_num,
                "company_reg_no" => $request->company_num,
                "vat_no" => $request->vat_num,
                "order_notes" => $request->order_notes


            ];

            DB::table("sp_userInformation")->where("email", $user->email)->update($info);


            $user = DB::table("sp_userInformation")->where("email", $user->email)->first();
            $request->session()->put("orderUser", $user);

            $request->session()->put("tab", "payment");
        } else if ($id == "payment") {


            $user = $request->session()->get("orderUser");
            $info["paymentMode"] = $request->method;
            DB::table("sp_userInformation")->where("email", $user->email)->update($info);


            $user = DB::table("sp_userInformation")->where("email", $user->email)->first();
            $request->session()->put("orderUser", $user);


            $request->session()->put("tab", "confirmOrder");
        }

        return redirect("/processOrder");
    }


    public function CreateProfile(Request $request)
    {


        $isExist =  DB::table("sp_userInformation")->where("email", $request->email)->count();

        if ($isExist == 1) {
            $request->session()->flash('status', 'This user already exists');
            return redirect("/auth");
        } else {
            if ($request->password == $request->confirmpassword) {


                DB::table("sp_userInformation")->insert([
                    "email" => $request->email, "password" => base64_encode($request->password), "lock" => 1, "companyName" => $request->company, "personName" => $request->fname,

                    "country" => $request->country, "phoneNo" => $request->phone
                ]);
                $user = DB::table("sp_userInformation")->where("email", $request->email)->where("password", base64_encode($request->password))->get();

                $request->session()->put("orderUser", $user);
            $request->session()->flash('profile-created', 'Profile has been Created');

                return redirect("/auth");
            } else {
                return view("auth.auth", ["errorMessage" => "Password and confirm password does not matched"]);
            }
        }
    }



    public function removeItem(Request $request)
    {



        $partName = $request->item;



        $cartData = [];
        $items = Session::get("cartData");


        foreach ($items as $item) {

            if ($item["partTitle"] != $partName) {

                array_push($cartData, $item);
            } else {
                Session::forget($item);
            }
        }

        $request->session()->put("cartData", $cartData);
        return count($cartData);
    }


    public function showAuthPage(Request $request)
    {


        return view("auth.auth");
    }

    public function ForgetPassword(Request $request)
    {
        $userInfo =  DB::table("sp_userInformation")->where("email", $request->Email)->first();
        $message = "";

        if ($userInfo) {

            if (mail($request->Email, "Your USM Password", "Welcome to USM\n Your forgotted password is: " . base64_decode($userInfo->password) . "\n", "From:no-reply@usedswedenmachines.com"))
                $type = "success";
        } else {
            $type = "Error";
        }



        return view("auth.forgetpasswordpage", ["type" => $type, "request" => $request]);
    }
}
