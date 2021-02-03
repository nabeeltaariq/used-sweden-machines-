@extends("templates.public")

@section("content")
    <section class="desktop_contact_form">   <!-- FIRST BLOCK -->


        <div id="first-block"   style="padding-top:-30px;paddin-bottom:10px; margin-top:18px;" >

            <div class="line">


                <div class="row">

                    <div class="col-lg-8 col-md-8 col-sm-12 p-0">


                        <form id="desktop-contact-form">
                            @csrf
                            @if(isset($message))
                                <div style="color: #034375; font-weight: bold;">
                                    {{$message}}
                                </div>
                            @endif
                            <table style='width:88%;margin-bottom:2px'>

                                <tr >
                                    <td style="padding:2px">
                                        <b>We Would like to hear from you</b><br/>
                                        Contact USM-Used Sweden Machines<br/>
                                        Contact us via our form.
                                    </td>

                            </table>


                            <table border="0" cellpadding="0" cellspacing="0"
                                   style="background: none repeat scroll 0 0 rgba(53, 147, 175, 0.06);width:88%">

                                <tbody>

                                </tr>

                        
                                <tr >

                                    <td style="background-color"  width="110" height="22" align="left" valign="top" style="">
                                        <div align="left"><span class="kontakt-form-text">Item #</span>
                                        </div>
                                    </td>


                                    <td height="22" align="left" valign="top">

                                        <input name="serial_no" type="text" class="kontakt-text" id="desk_serial_no"
                                               style="margin-bottom:2px;width:100%;outline:none" size="30"></td>
                                 
                                </tr>
                                   <tr >

                                    <td style="background-color"  width="110" height="22" align="left" valign="top" style="">
                                        <div align="left"><span class="kontakt-form-text">Machine Name</span>
                                        </div>
                                    </td>


                                    <td height="22" align="left" valign="top">

                                        <input name="machine_name" type="text" class="kontakt-text" id="desk_machine_name"
                                               style="margin-bottom:2px;width:100%;outline:none" size="30"></td>
                                 
                                </tr>
                                <tr >

                                    <td style="background-color"  width="110" height="22" align="left" valign="top" style="">
                                        <div align="left"><span class="kontakt-form-text">Company Name</span>
                                        </div>
                                    </td>


                                    <td height="22" align="left" valign="top">

                                        <input name="company" type="text" class="kontakt-text" id="desk_company"
                                               style="margin-bottom:2px;width:100%;outline:none" size="30"></td>
                 
                                </tr>

                                <tr style="background-color:white">

                                    <td width="110" height="22" align="left" valign="top" style="">
                                        <div align="left"><span class="kontakt-form-text">Your Name*</span>
                                        </div>
                                    </td>


                                    <td height="22" align="left" valign="top">
                                        <input name="full_name" type="text" class="kontakt-text" id="desk_full_name"
                                               style="margin-bottom:2px;width:100%;outline:none" size="30"
                                               required="required">
                                    </td>

                                </tr>


                                <tr >

                                    <td style="border: 2px double #f3f9fa;" width="110" height="22" align="left" valign="top" style="">
                                        <div align="left"><span class="kontakt-form-text">Phone</span></div>
                                    </td>


                                    <td height="22" align="left" valign="top">
                                        <input name="phone" type="text" class="kontakt-text" id="desk_phone"
                                               style="margin-bottom:2px;width:100%;outline:none" size="30"></td>

                                </tr>

                                <tr >

                                    <td style="background-color:white" width="110" height="22" align="left" valign="top" style="">
                                        <div align="left">
                                            <span class="kontakt-form-text">E-Mail*</span></div>
                                    </td>


                                    <td height="22" align="left" valign="top">
                                        <input name="email" type="email" class="kontakt-text" id="desk_email"
                                               style="margin-bottom:2px;width:100%;outline:none" size="30"
                                               required="required"></td>

                                </tr>


                                <input type="hidden" name="country" value="none">

                                <tr >

                                    <td  width="110" height="" align="left" valign="top" style="">
                                        <div align="left"><span class="kontakt-form-text">Message*</span></div>
                                    </td>


                                    <td height="" align="left" valign="top">

                                   
                                                  <textarea name="message" class="kontakt-text" id="desk_message" style="width:100%;outline:none" cols="31"  rows="4"></textarea>

                                </tr>


                                <tr align="left" valign="bottom">

                                    <td width="110" align="left" valign="top"><input type="hidden" name="ueberpruefung"
                                                                                     value="1"><input type="hidden"
                                                                                                      name="ID"
                                                                                                      value=""></td>


                                    <td>

                                        <input name="quote_form" type="submit" class="kontakt_btn" id="Submit"
                                               style="height:30px;width:75px;font-size: 13px;font-weight: bolder;"
                                               value="Submit">


                                        <span class="kontakt-info">*</span><span
                                            class="kontakt-form-text">Required</span>

                                        <span class="kontakt-info">*</span><span class="kontakt-form-text">Please write English if possible!</span>
                                    </td>

                                </tr>

                                </tbody>

                            </table>


                        </form>

                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 p-0">

                        <h3 class="item" style="

              display: inline-block;

              padding: 7px 20px;

              margin: 0;

              font-size: 14px;

              font-weight: bolder;

              color: #034375;

               background: #b43720;

               background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…IgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);

               background: -moz-linear-gradient(90deg, #b43720 0%, #e94541 100%);

               background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,#b43720), color-stop(100%,#e94541));

               background: -webkit-linear-gradient(90deg, #b43720 0%,#e94541100%);

               background: -o-linear-gradient(90deg, #b43720 0%,#e94541 100%);

               background: -ms-linear-gradient(90deg, #b43720 0%,#e94541 100%);

               background: linear-gradient(90deg, #FBCA01 0%,#FBCA01 100%);">Contact Us</h3>

                        <br/>

                        <p style="font-size:12px;margin:0"><strong>USM-Used Sweden Machines</strong><br>83-A, S.I.E # 1,<br>Gujranwala
                            Pakistan</p>

                        <p style="margin:0">Tel.: +92 (321) 7415373<br>E-Mail: <a class="link"
                                                                                  style="color: blue; text-decoration: underline;"
                                                                                  href="mailto: info@usedswedenmachines.com">info@usedswedenmachines.com</a>
                        </p>

                        <div style="margin-top:15px;">

                            <div id="vcard"><a href="{{URL::to('/public/imgs/Sweden Machine.vcf')}}"><img
                                        src="{{URL::to('/public/imgs/vcard1.png')}}" alt="Download vcard"
                                        style="width:39%;">


                                </a>

                            </div>

                        </div>

                    </div>


                </div>

            </div>


     
    </section>
    </br> 
    
    

    <style>
.desktop_contact_form
{
    display:none;
}
      textarea {
  resize: vertical;

  overflow:hidden;
}


  @media screen and (min-width: 417px) 
    {
        .desktop_contact_form
        {
            display: inherit;
        }
    }
   


   @media screen and (max-width:570px)  {
   .desktop_contact_form
       {
           
           margin-left:5px;
       }
}
   
    td, th {
    padding: 0;
    background-color: white;
}
    </style>

<script>
    $("#desktop-contact-form").submit(function(e){
  e.preventDefault();
 let machine_name=$("desk_#machine_name").val();
 let serial_no=$("#desk_serial_no").val();
 let phone=$("#desk_phone").val();
 let email=$("#desk_email").val();
 let full_name=$("#desk_full_name").val(); 
 let company=$("#desk_company").val();
 let message=$("#desk_message").val();
 
 


 $.ajax({

    url:"/machine/contactUsform",
    type:"POST",
    data:{
      token:"{{ csrf_token() }}",

      machine_name:machine_name,
      serial_no:serial_no,
      phone:phone,
      email:email,
      full_name:full_name,
      company:company,
            message:message,
   
       },

       success:function(data)
       {
        
if(data=="success")
      swal("", " Your email has been sent Successfully!", "success"); 
      else
       swal("", " Your email has not been sent ", "error"); 
       
       }
    //   error: function(){
    //     swal("", " Your email has not been sent!", "error");
    //  }
//       error: function(xhr, status, error) {
//   var err = eval("(" + xhr.responseText + ")");
//   alert(err.Message);
// }
 });
});
</script>
@endsection
