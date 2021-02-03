@extends("admin.templates.admin")
<?php

use Illuminate\Support\Facades\DB;

$parentPages = DB::table("sp_adminpages")->where("parentId",2)->get();
?>
@section("content")
    <ul class="productMenu">
    @if(Request::session()->get("activeUser")->roleId==1)
    @foreach($parentPages as $parentPage)
    <li><a href="{{URL::to('/')}}/{{$parentPage->pageURL}}">{{$parentPage->pageName}}</a></li>
    @endforeach
    @endif
    @if(Request::session()->get("activeUser")->roleId==0 )
    @foreach($parentPages as $parentPage)
    <?php
    $userPages = DB::table("sp_userpages")->where("pageId", $parentPage->pageId)->where("userId", session()->get("activeUser")->uId)->get();
    if (count($userPages) >= 1) {
    ?>
        <li>
            <a href="{{URL::to('/')}}/{{$parentPage->pageURL}}">
                <span><span>{{$parentPage->pageName}}</span></span></a>
        </li>
    <?php
    }
    ?>
    @endforeach
    @endif
    <!-- <li><a href="{{URL::to('/admin/products/catagories')}}">Manage Catagories</a></li>
    <li><a href="{{URL::to('admin/products/addCategory')}}">Add Category</a></li>
    <li><a href="{{URL::to('/admin/products/new')}}">Add Product</a></li>
    <li><a href="{{URL::to('admin/products')}}">Manage Products</a></li>
    <li><a href="{{URL::to('admin/products/uploadedProducts')}}">Uploaded Products</a></li>
    <li><a href="{{URL::to('admin/products/stockReport')}}">Stock Reports</a></li> -->
    </ul>
   <style>
       ul.productMenu{
           list-style-type:none;
           padding-left:30px;
           width:100%;
           background-color:#ccc;
           font-size:12px;
           font-weight:bolder;
           position:fixed;
           z-index:100;

       }
       ul.productMenu li{
           display:inline-block;
       }

       ul.productMenu li a{
           display:inline-block;
           padding:0px 10px;
           color:black;
           border-right:1px solid gray;
       }

   </style>
   <br/>
    @yield("products_content")

@endsection
