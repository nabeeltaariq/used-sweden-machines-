@extends("templates.public")
@section("content")
    <style>
table td:nth-child(2)
{
    padding-left:49px;
}
.mobile_contact_form
{
    display:none;
}
/*  @media screen and (min-width: 417px) */
/*    {*/
/*        .desktop_contact_form*/
/*        {*/
/*            display: none;*/
/*        }*/
/*    }*/
   


/*   @media screen and (max-width:570px)  {*/
/*   .desktop_contact_form*/
/*       {*/
           
/*           margin-left:5px;*/
/*       }*/
/*}*/
  /*@media screen and (max-width: 1024px) */
  /*  {*/
  /*   .desktop_contact_form input,textarea*/
  /*   {*/
  /*      width:90% !important;*/
  /*      margin-left:20px !important;*/
  /*      margin-right:20px !important;*/
  /*   }*/
     
  /*  }*/
    
      @media screen and (max-width: 1024px) 
    {
     .desktop_contact_form input,textarea
     {
        width:100% !important;
    border:1px solid rgb(59, 59, 59) ;
     }
#submit_btn
    {
        
   
           width:80px !important;
    } 
    }
      @media screen and (max-width: 416px) 
    {
        .mobile_contact_form
        {
            display: inherit;
         
          
            margin-top:10px;
           
        }
          .desktop_contact_form
        {
            display: none;
        }
            td, th {
    padding: 0;
    background-color: white;
}
.item
{
    margin-left:16px;
    margin-top:20px;
}
    }
    

    </style>
<br/>
<h3 class="item" style="
font-weight:bold;
 display: block;
 font-family: 'arial';
 display:inline-block;
 font-size:14px;
 background: #b43720;
 background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…IgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
 background: -moz-linear-gradient(90deg, #b43720 0%, #e94541 100%);
 background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,#b43720), color-stop(100%,#e94541));
 background: -webkit-linear-gradient(90deg, #b43720 0%,#e94541100%);
 background: -o-linear-gradient(90deg, #b43720 0%,#e94541 100%);
 background: -ms-linear-gradient(90deg, #b43720 0%,#e94541 100%);
 background: linear-gradient(90deg, #FBCA01 0%,#FBCA01 100%);
 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b43720', endColorstr='#e94541',GradientType=1 );

 color: #034b84;

 line-height: 30px;
 padding: 0px 14px;
 position: relative;
 margin-top:20px">Upload Your Machine</h3>
 
 
@if (session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p  style="text-align: justify;"> Success! Your machine has been successfully uploaded, please wait it will take time to approve from  our administation to display on the used tetra pack machines , you will get confirmation email from our administration.</p>

    </div>
   <div style="display: none;"> {{Session::pull('success')}}</div>
@endif
     <div id="suc" class="success-alert" style="display: none;">
<div class="alert alert-success">
   <p  style="text-align: justify;"> Success! Your machine has been successfully uploaded, please wait it will take time to approve from  our administation to display on the used tetra pack machines , you will get confirmation email from our administration.</p>
</div>
     </div>


<!--@if (session('success'))-->
<!--    <div class="alert alert-success alert-dismissible">-->
<!--        <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--            <span aria-hidden="true">&times;</span>-->
<!--        </button>-->
<!--        <p  style="text-align: justify;"> Success! Your machine has been successfully uploaded, please wait it will take time to approve from  our administation to display on the used tetra pack machines , you will get confirmation email from our administration.</p>-->

<!--    </div>-->
<!--   <div style="display: none;"> {{Session::pull('success')}}</div>-->
<!--@endif-->
<!--     <div id="suc" class="success-alert" style="display: none;">-->
<!--<div class="alert alert-success">-->
<!--   <p  style="text-align: justify;"> Success! Your machine has been successfully uploaded, please wait it will take time to approve from  our administation to display on the used tetra pack machines , you will get confirmation email from our administration.</p>-->
<!--</div>-->
<!--     </div>-->



 <form action="" method="post" id="form-sub" enctype="multipart/form-data" class="desktop_contact_form">

    <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
        <tbody>
        <!-- <tr>
          <td width="110" height="22" align="left" valign="top"><div align="left"><span class="kontakt-form-text">Title</span><span class="kontakt-info">*</span><span class="kontakt-form-text">:</span> </div></td>
          <td width="30" height="22" align="center" valign="middle"></td>
        <td height="22" align="left" valign="top"><input name="title" type="radio" class="kontakt-form-text" value="Mrs" >
              <span class="kontakt-form-text">Mrs.</span>
              <input name="title" type="radio" class="kontakt-form-text" value="Mr">
              <span class="kontakt-form-text">Mr.</span> </td>
        </tr> -->
        <tr >
          <td width="110" height="22" align="left" valign="top" style="border-right:1px solid #ccc"><div align="left"><span class="kontakt-form-text">Company</span><span class="kontakt-form-text"> :</span> </div></td>
          <td width="30" height="22" align="center" valign="middle"></td>
        <td height="22" align="left" valign="top"><label for="textfield"></label>
              <input name="company" type="text" class="kontakt-text" id="company" style="width:80%;margin-bottom:2px" value=""></td>
        </tr>
        <tr >
          <td width="110" height="22" align="left" valign="top" style="border-right:1px solid #ccc"><div align="left"><span class="kontakt-form-text">Name</span><span class="kontakt-info">*</span><span class="kontakt-form-text">:</span> </div></td>
          <td width="30" height="22" align="center" valign="middle"></td>
          <td height="22" align="left" valign="top">&nbsp;<input name="name" type="text" class="kontakt-text" id="name" style="width:80.0%;margin-bottom:2px" value="" required="required"></td>
        </tr>
        <!-- <tr>
          <td width="110" height="22" align="left" valign="top"><div align="left"><span class="kontakt-form-text">First Name</span><span class="kontakt-form-text"> :</span> </div></td>
          <td width="30" height="22">&nbsp;</td>
          <td height="22" align="left" valign="top"><input name="fname" type="text" class="kontakt-text" id="fname" size="30" value=""></td>
        </tr> -->
     
        <tr>
            
          <td width="110" height="22" align="left" valign="top" style="border-right:1px solid #ccc"><div align="left"><span class="kontakt-form-text">First Name :</span> </div></td>

          <td width="30" height="22">&nbsp;</td>
          <td height="22" align="left" valign="top">&nbsp;<input name="fname" type="text" class="kontakt-text" id="fname" style="width:80.0%;margin-bottom:2px" value=""></td>
        </tr>
        
           <tr >
            
          <td width="110" height="22" align="left" valign="top" style="border-right:1px solid #ccc"><div align="left"><span class="kontakt-form-text">Phone :</span> </div></td>

          <td width="30" height="22">&nbsp;</td>
          <td height="22" align="left" valign="top">&nbsp;<input name="phone" type="text" class="kontakt-text" id="phone" style="width:80.0%;margin-bottom:2px" value=""></td>
        </tr>
        <tr >
          <td width="110" height="22" align="left" valign="top" style="border-right:1px solid #ccc"><div align="left"><span class="kontakt-form-text">E-Mail</span><span class="kontakt-info">*</span><span class="kontakt-form-text">: </span></div></td>
          <td width="30" height="22" align="center" valign="middle"></td>
          <td height="22" align="left" valign="top">&nbsp;<input name="email" type="email" class="kontakt-text" id="email" style="width:80.0%;margin-bottom:2px" value="" required="required"></td>
        </tr>

        <tr >
            <td width="110" height="" align="left" valign="top" style="border-right:1px solid #ccc"><div align="left"><span class="kontakt-form-text">Machine Name</span><span class="kontakt-info">*</span><span class="kontakt-form-text">:</span></div></td>
            <td width="30" height="" align="center" valign="top"></td>
             <td height="" align="left" valign="top"><label for="textarea"></label>
            <input type="text" name="machineName" id="machineName" style="width:80%">
          </tr>


        <tr>
            <td width="110" height="" align="left" valign="top" style="border-right:1px solid #ccc"><div align="left"><span class="kontakt-form-text">Technical Secifications</span><span class="kontakt-info">*</span><span class="kontakt-form-text">:</span></div></td>
            <td width="30" height="" align="center" valign="top"></td>
             <td height="" align="left" valign="top"><label for="textarea"></label>
             <textarea style="width:80%" name="technicalSpecifications" requied></textarea>
          </tr>

       <input type="hidden" name="country" value="none">
        <tr>
          <td width="110" height="" align="left" valign="top" style="border-right:1px solid #ccc"><div align="left"><span class="kontakt-form-text">Machine Featured Image</span><span class="kontakt-info">*</span><span class="kontakt-form-text">:</span></div></td>
          <td width="30" height="" align="center" valign="top"></td>
      <td height="" align="left" valign="top"><label for="textarea"></label>
            <input type="file" name="featuredImage" id="featuredImage">
        </tr>
        <tr>
            <td width="110" height="" align="left" valign="top" style="border-right:1px solid #ccc"><div align="left"><span class="kontakt-form-text">Machine Other Image</span><span class="kontakt-info">*</span><span class="kontakt-form-text">:</span></div></td>
            <td width="30" height="" align="center" valign="top"></td>
        <td height="" align="left" valign="top"><label for="textarea"></label>
              <input type="file" name="otherImages[]" id="otherImages" multiple>
              <Br/><br/>
          </tr>


        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <tr align="left" valign="bottom">
          <td width="110" align="left" valign="top"><input type="hidden" name="ueberpruefung" value="1"><input type="hidden" name="ID" value=""></td>
          <td width="30">&nbsp;</td>
        <td valign="middle"><label for="Submit"></label>
              <input name="contactformnew" type="submit" id="submit_btn" class="kontakt_btn"  value="Submit">
              <span class="kontakt-info">*</span><span class="kontakt-form-text">Required</span>
              <span class="kontakt-info">*</span><span class="kontakt-form-text">Please write English if possible!</span>                      </td>
          </tr>
        </tbody>
      </table>

 </form>

    </br> 
    
    
    <div class="container mobile_contact_form">

 <form action="" method="post" id="form-sub" enctype="multipart/form-data" >
        @csrf
                  <label for="company" id="testLabel" style="width:100%">
                    Company po
                    <input type="text" required name="company" id="company" style="width:100%" autocomplete="off" class="form-control">
                    <input type="hidden" name="Email-From" value="Contact US Form">

                  </label>
                  <label for="fullName" style="width:100%">
                     Name <span class="text-danger">*</span>
                    <input type="text" required name="name" id="fullName" style="width:100%" class="form-control">

                  </label>
                 
                  <label for="phone" style="width:100%">
                    Phone 
                    <input type="number" required name="phone" id="phone" style="width:100%" class="form-control">

                  </label>

                  <label for="email" style="width:100%">
                    Email <span class="text-danger">*</span>
                  
                    <input type="email" required name="email"  id="email" style="width:100%" class="form-control">

                  </label>
                     <label for="email" style="width:100%">
                    Machine Name <span class="text-danger">*</span>
                  
                    <input type="text" required name="machineName" id="machineName" style="width:100%" class="form-control">

                  </label>

                  <label for="message" style="width:100%">
                    Technical Secifications <span class="text-danger">*</span>
                    <textarea class="form-control" required id="message" name="technicalSpecifications"></textarea>

                  </label>
                  
                         <label for="email" style="width:100%">
                    Machine Featured Image <span class="text-danger">*</span>
                  
                  
                       <input type="file" name="featuredImage" id="featuredImage" style="width:100%" class="form-control">

                  </label>
                  
                         <label for="email" style="width:100%">
                 Machine Other Image <span class="text-danger">*</span>
                  
                    <input type="file" name="otherImages[]" id="otherImages" style="width:100%" class="form-control" multiple required>
                  </label>
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="ueberpruefung" value="1"><input type="hidden" name="ID" value="">
                
                  <br/>
                  <input type="submit" value="Submit" class="btn btn-primary btn-block" style="background-color:#005292;"/>
                  <span class="kontakt-info">*</span><span class="kontakt-form-text">Required</span>
              <span class="kontakt-info">*</span><span class="kontakt-form-text">Please write English if possible!</span> 
                  <br/>

        </form>
    </div>
    


@endsection

