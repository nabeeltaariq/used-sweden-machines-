<?php
use Illuminate\Support\Facades\DB;
$parentPages = DB::table("sp_adminpages")->where("parentId", 0)->get();
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USM-Admin</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{URL::to('/public/js/jquery.alphanum.js')}}"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://kit.fontawesome.com/6ba88d1a21.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
{{--    <script src="{{asset("public/js/angular2.js")}}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.1/angular-csp.min.css"
          integrity="sha512-nptw3cPhphu13Dy21CXMS1ceuSy2yxpKswAfZ7bAAE2Lvh8rHXhQFOjU+sSnw4B+mEoQmKFLKOj8lmXKVk3gow=="
          crossorigin="anonymous"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.1/angular.min.js"
            integrity="sha512-QFmqHpmYymVcJudvGsU3IDBfwnTOdfmY42YUwyORin2namhG6FCku8MiSc6igF2OIwChlEuFkvuwNo6pbMOUSg=="
            crossorigin="anonymous"></script>
</head>

<body >

    <div id="head" style="position:fixed;top:0;left:0;right:0;z-index:1">
        <div
            style="width:100%;height:80px;background-image: url('https://usedswedenmachines.com/public/imgs/banner1.png') ;background-size:cover">
            <div style="float:left;margin-left:30px;height:80px;width:50%;">
                <img src="https://www.usedswedenmachines.com/public/imgs/logo.png" width="111.33px" height="80px">
            </div>
            <div style="float:right;height:80px;width:45%;">
                <p align="right" style="padding-bottom:0px;margin-top:9px;font-size:11px;margin-right:30px">
                    <span style="color:#034375;font-weight:bold;font-size: 17px;">Used Sweden Machines</span><br>
                    D.O.H.S 290, Phase 1 Gujranwala, Pakistan
                    <br>
                    Company Registration No: 4015134-4<br>
                    Tel.: +92(321)7415373<br>
                    E-Mail: <a href="#" style="text-decoration:underline;color:blue">info@usedsweedenmachines.com</a>
                </p>
                <p align="right" style="padding-bottom:0">

                </p>
                <p></p>

            </div>

        </div>


        <div id="menus_wrapper" style="padding:0px">
            <div id="main_menu">
                <ul>
                    @if(Request::session()->get("activeUser")->roleId==1)
                        @foreach($parentPages as $parentPage)
                            <li>
                                <a href="{{URL::to('/')}}/{{$parentPage->pageURL}}">
                                    <span><span>{{$parentPage->pageName}}</span></span></a></li>

                        @endforeach
                    @endif

                    @if(Request::session()->get("activeUser")->roleId==0 )
                        @foreach($parentPages as $parentPage)
                            <?php
                            $userPages = DB::table("sp_userpages")->where("pageId", $parentPage->pageId)->where("userId", session()->get("activeUser")->uId)->get();
                            if(count($userPages) >= 1){
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
                <!-- <li ng-repeat="page in pages">
{{--                    <a href="{{URL::to('/')}}/@{{page.pageURL}}" ng-if="page.isActive==1 && page.parentId==0">--}}
                            <span><span>@{{page.pageName}}</span></span></a>
                    </li> -->
                <!-- <li>
{{--                        <a href="{{URL::to('/admin')}}">--}}
                            <span><span>Home</span></span></a></li>
                             -->

                    <!--<li><a href="siteoptions.php" >
                    <span><span>Website Configuration</span></span></a></li>-->
                    <!--<li><a href="users.php" >
                    <span><span>Mailer</span></span></a></li>-->
{{--                <!-- <li><a href="{{URL::to('admin/products')}}">--}}
{{--                            <span><span>Products</span></span></a></li>--}}
{{--                    <li><a href="{{URL::to('admin/pages')}}">--}}
{{--                            <span><span>Pages</span></span></a></li>--}}
{{--                    <li><a href="{{URL::to('admin/news')}}">--}}
{{--                            <span><span>News</span></span></a></li> -->--}}
                    <!-- <li>
                    <a href="https://www.usedswedenmachines.com/admin/newsletter/newsletter.php"  >
                    <span><span>Newsletter</span></span></a></li> -->
                    {{-- <li>
                    <a href="">
                    <span><span>Stock Lists</span></span></a></li> --}}
                <!-- <li>
{{--                        <a href="{{URL::to('admin/spareParts')}}">--}}
                            <span><span>Spare Parts</span></span></a></li>

                    -->
                <!-- <li>
{{--                        <a href="{{URL::to('admin/contacts')}}">--}}
                            <span><span>CMS</span></span></a></li> -->
                    {{--
                    <li>
                    <a href="">
                    <span><span>HCMS</span></span></a></li>
                    <li>
                    <a href="">
                    <span><span>E-CMS</span></span></a></li>






                     <li>
                    <a href="https://www.usedswedenmachines.com/admin/data/index.php">
                    <span><span>DMS</span></span></a></li>
                                                     <li>
                    <a href="https://www.usedswedenmachines.com/admin/ebusiness/index.php">
                    <span><span>E-Business</span></span></a></li>
                                                     <li>
                    <a href="https://www.usedswedenmachines.com/admin/accounts/index.php">
                    <span><span>User Accounts</span></span></a></li> --}}
                    <li style="float:right;">
                        <div class="btn-group">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                {{Request::session()->get("activeUser")->username}}
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{URL::to('/')}}" class="dropdown-item" target="_blank">Visit Site</a>
                                @if(Request::session()->get("activeUser")->roleId==1)
                                    <a href="{{URL::to('admin/userManagement')}}" class="dropdown-item">User Management</a>
                                @endif
                                <a class="dropdown-item" href="{{URL::to('admin/changePassword')}}">Change Password</a>
                                <a class="dropdown-item" href="{{URL::to('/admin/logout')}}">Logout</a>
                            </div>
                        </div>
                    </li>


                </ul>
            </div>


        </div>
    </div>
    <style>
        #menus_wrapper {
            position: fixed;
            top: 81px;
            background-color: #034375;
            left: 0;
            right: 0;
            z-index: 500;
        }

        #menus_wrapper #main_menu ul {
            width: 100%;
            list-style-type: none;
            margin: 0;
            padding-left: 30px;
        }

        #menus_wrapper #main_menu ul li {
            display: inline-block;
        }

        #menus_wrapper #main_menu ul li a {
            display: inline-block;
            padding: 12px 10px;
            color: white;
            text-decoration: none;
            font-weight: bolder;
            font-family: arial;

            border-right: 1px solid #cccccc3d;

            font-size: 14px;
        }


        #menus_wrapper #main_menu ul li a:hover {
            background-color: #ccc;
            color: black;
        }

        #menus_wrapper #main_menu ul li a.dropdown-item {
            color: black;
        }

        body {
            background-color: #eee;
        }

        label {
            width: 100%;
        }
    </style>
    <div class="" style="margin-top:126px">
        @yield("content")
    </div>
    @yield('script')

    <script>
    {{--var adminModule = angular.module('adminModule',[]);--}}

    {{--adminModule.controller('adminController',['$scope', function($scope){--}}
    {{--    $scope.pages = [];--}}
    {{--    $scope.userPages = [];--}}
    {{--    --}}{{--$http({--}}
    {{--    --}}{{--    url: "{{URL::to('admin/getPages')}}",--}}
    {{--    --}}{{--    method: "GET"--}}
    {{--    --}}{{--}).then(response => {--}}
    {{--    --}}{{--    $scope.pages = response.data;--}}
    {{--    --}}{{--})--}}
    {{--}]);--}}


    $(document).ready(function () {
        $('#myTable').DataTable();
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('description');

    });
</script>
</body>

</html>
