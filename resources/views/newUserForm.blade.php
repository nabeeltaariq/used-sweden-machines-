<?php

use Illuminate\Support\Facades\DB;

$adminPages = DB::table("sp_adminpages")->where("parentId", 0)->get();
?>
<!-- User Management Page -->
@extends("admin.templates.admin")

@section("content")
<br />
<div class="container">
    <h4>Add New User</h4>
    <form action="{{URL::to('admin/addNewUser')}}" method="post" id="newUserForm">
        <table cellpadding="10">
            <tr>
                <td> Full Name:</td>
                <td><input type="text" name="fname" id="fname" placeholder="Enter Full Name" required class="fields"></td>
                <td>Username:</td>
                <td><input type="text" name="username" id="username" placeholder="Enter Username" required class="fields"></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" id="email" placeholder="Enter Email" required class="fields"></td>
                <td>Mobile Number:</td>
                <td><input type="text" name="MobNo" id="MobNo" placeholder="Enter Mobile Number" class="fields"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="pass" id="pass" placeholder="Enter Password" required class="fields"></td>
                <td>Confirm Password: <strong id="passwordError" class="text-danger"></strong></td>
                <td><input type="password" name="confirmpass" id="confirmpass" placeholder="Confirm Password" required class="fields"></td>
            </tr>
            <tr>
                <td>User Role:</td>
                <td>
                    <select name="roleId" id="roleId" class="userPages">
                        <option value="1">Admin</option>
                        <option value="0">Custom User</option>
                    </select>
                </td>
            </tr>
        </table>

        <div class="showPages">
            <h3>Add User Pages</h3>
            <ul id="menu">
                @foreach($adminPages as $adminPage)
                <li><a href=""><i class="fa fa-plus text-primary"></i></a>&nbsp;&nbsp;
                    <input type="checkbox" name="pageName[]" id="" value="{{$adminPage->pageId}}" checked>
                    {{$adminPage->pageName}}


                    <ul>
                        <?php
                        $chlidPages = DB::table("sp_adminpages")->where("parentId", $adminPage->pageId)->get();
                        ?>
                        @foreach($chlidPages as $childPage)

                        <li><input type="checkbox" name="pageName[]" id="" value="{{$childPage->pageId}}" checked>
                            {{$childPage->pageName}}</li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
        <center><input type="submit" value="Add New User" class="btn btn-primary btn-block" onclick="return Validate()"></center>
    </form>

    @isset($message)
    <div class="alert alert-success">
        {{$message}}
    </div>

    @endisset
</div>
<style>
    .fields {
        width: 400px;
    }

    select {
        width: 400px;
    }

    li {
        list-style: none;
    }
</style>
<script>
    $("#menu li ul").hide();
    $("#menu li a").click(function(e) {
        var li = $(this).parent('li');
        if (!li.has("ul")) {
            return;
        }
        li.children('ul').toggle();
    });

    function Validate() {
        var password = document.getElementById("pass").value;
        var confirmPassword = document.getElementById("confirmpass").value;
        if (password != confirmPassword) {
            document.getElementById("passwordError").innerHTML = '*Password did not matched.';
            return false;
        }
        return true;
    }
    $(".showPages").hide();
    $('.userPages').on('change', function() {
        if (this.value == 0) {
            $(".showPages").show();
        } else {
            $(".showPages").hide();
        }
    });
    $(function() {
        $("li:has(li) > input[type='checkbox']").change(function() {
            $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
        });
        $("input[type='checkbox'] ~ ul input[type='checkbox']").change(function() {
            $(this).closest("li:has(li)").children("input[type='checkbox']").prop('checked', $(this).closest('ul').find("input[type='checkbox']").is(':checked'));
        });
    });
</script>
@endsection