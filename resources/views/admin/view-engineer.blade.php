@extends("admin.templates.contacts")
@section("contacts_content")
<style type="text/css">


    .st_main_div
    {

        margin: 0 0 0 250;
        width: 570px;
        position: absolute;




    }

    .st_div_link
    {
        margin-top: 20px;
    }

    .st_div_success
    {
        height: 20px;
        border: 1px solid;
        background-color: #66ffcc;
        border-radius: 8px;
        border-color: #66ffcc;

    }



</style>

<script src='js/jquery.js'></script>


</head>


<a href="{{URL::to('/admin')}}">Back to Admin Panel</a>
<table width='80%' border='0' align='center'>
    <tr>
        <td align='left'><a href='http://usedswedenmachines.com/'><img src="https://www.usedswedenmachines.com/public/imgs/logo.png" height='75' style='height: 144px;'></a> <br/>



        </td>
        <td width='60%' align='right'>
            <p ><span style='color:#034375;font-weight:bold;font-size: 19px;'>Used Sweden Machines</span><br>
                D.O.H.S 290, Phase 1 Gujranwala, Pakistan<br>
                Company Registration No: <span style='color:#034375;font-weight:bold;'>4015134-4</span><br>
                Tel.: +92(321)7415373<br>
                E-Mail: <a href='mailto:info@usm.com.pk'>info@usm.com.pk</a><br>
            </p>
        </td>
    </tr>
    <tr>
        <td colspan='2' >
            <p align='center'><strong>{{$engineer->teamPersonName}} </strong></p><hr>
        </td>
    </tr>
   
</table>
<table width='80%' align='center'>
    <tr>
        <td><b>Email</b></td>
        <td>{{$engineer->email}}</td>
    </tr>
    <tr>
        <td><b>Cnic/Passport</b></td>
        <td>{{$engineer_team->cnicPassport}} </td>
    </tr>
   
    <tr>
        <td><b>Mobile No</b></td>
        <td>{{$engineer->mobileNo}} </td>
    </tr>
    <tr>
        <td><b>Email</b></td>
        <td>{{$engineer->email}}</td>
    </tr>
    <tr>
        <td><b>LinkdIn</b></td>
        <td><a href="{{$engineer->linkdIn}}">{{$engineer->linkdIn}}</a></td>
    </tr>
    <tr>
        <td><b>Nationality</b></td>
        <td>{{$engineer_team->nationality}}</td>
    </tr>
    <tr>
        <td><b>Date of Birth</b></td>
        <td>{{$engineer_team->dateOfBirth}}</td>
    </tr>
    <tr>
        <td><b>Job Can Perform</b></td>
        <td>{{$engineer_team->experienceMechanic}}</td>
    </tr>
    <tr>
        <td><b>WorkShop Details</b></td>
        <td>{{$engineer_team->workshopDetails}}</td>
    </tr>




</table>
@endsection
