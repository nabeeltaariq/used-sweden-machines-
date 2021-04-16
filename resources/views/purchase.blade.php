@extends("templates.public")

@section("content")
<style>
  textarea {
    resize: vertical;

    overflow: hidden;
  }

  #mobile-form {
    display: none;
  }

  @media only screen and (max-width: 600px) {
    #upload-machine {
      margin-left: 15px;
      margin-right: 15px;
    }


    #search-bar {
      display: none !important;
    }

    #small-search {
      display: none !important;
    }

    #address {
      display: none;
    }

    #mobile-form {
      display: block;
    }

    #desk-form {
      display: none;
    }
  }
</style>

<section style="margin-top:5px" id="upload-machine">

  <!-- FIRST BLOCK -->

  @if(session()->has('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}
  </div>
  @endif
  @if(session()->has('danger'))
  <div class="alert alert-danger">
    {{ session()->get('danger') }}
  </div>
  @endif
  <div style="padding-top: 10px;">

    <div>





      <!-- CONTENT -->
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
          <h3 style="*/

    /* width: 62.333%; */

    /* width: 62.333%; */

    /* padding-left: 14px; */

    font-weight: bold;

    display: block;

    /* padding-left: 14px; */

    /* font-family: 'arial'; */

    /* max-width: 300px; */

    /* width: 62.333%; */

    /* background: #b43720; */

    /* background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…IgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=); */

    background: -moz-linear-gradient(90deg, #b43720 0%, #e94541 100%);

    background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,#b43720), color-stop(100%,#e94541));

    background: -webkit-linear-gradient(90deg, #b43720 0%,#e94541100%);

    background: -o-linear-gradient(90deg, #b43720 0%,#e94541 100%);

    background: -ms-linear-gradient(90deg, #b43720 0%,#e94541 100%);

    background: linear-gradient(90deg, #FBCA01 0%,#FBCA01 100%);

    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b43720', endColorstr='#e94541',GradientType=1 );

    color: #034b84;

    /* line-height: 30px; */

    position: relative;

    /* width: 51.333%; */

    display: inline-block;

    font-size: 14px;

    padding: 8px 40px 8px 10px;

    margin: 0px;font-weight:bolder">Sell to Used Sweden Machines</h3>
          <p style="margin-bottom: 0px;

    font-family: arial;

    font-size: 13px;margin-top:4px">
            <!-- <strong>USM-Used Sweden Machines</strong><br>83-A, S.I.E # 1 Gujranwala Pakistan</p>

<p>Tel.: +92 (321) 7415373<br>E-Mail: <a class="link" style="color: blue; text-decoration: underline;" href="mailto: info@usedswedenmachines.com">info@usedswedenmachines.com</a> -->



            We buy a wide range of plant and machinery at competitive prices. Whether it's a individual machine or a complete manufacturing facility you have for sale, please contact us with details by filling the form below including attaching photos of the equipment.


          </p>

          <p style="color:red;    font-family: times;

    font-size: 14px;margin:15px 0px" align="center"><i style="color:red;font-style:italic;">"WE PAY BEST PRICES FOR USED TETRA PAK<br> MACHINES AND COMPLETE FACILITIES"</i></p>

          <p style="font-family: arial;

    font-size: 13px;"> To discuss any aspect of Used Tetra Pak Machines For Sale supply or sourcing or for any other dairy processing machinery, just give us a call on: <a href="tel:+92-321-741-5373" style="color:blue">+92-321-741-5373</a></p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12" id="address">
          <h3 style="

                background-color: #fbca01;

    font-weight: bolder;

    padding: 3px 14px;

    color: #034b84;

    display: inline-block;

    font-size: 14px;

    padding: 8px 14px;

    margin: 0px;

            ">Purchase</h3>
          <p style="font-family:arial;font-size:12px;margin-bottom:-2px;margin-top:4px"><strong>USM-Used Sweden Machines</strong><br>83-A, S.I.E # 1,<br>Gujranwala Pakistan</p>
          <p style="margin:0px">Tel.: +92 (321) 7415373<br>E-Mail: <a class="link" style="color: blue; text-decoration: underline;" href="mailto: info@usm.com.pk">info@usm.com.pk</a></p>
        </div>
      </div>
      <br>

      <div class="col-sm-12" id="mobile-form">
        <form action="/upload-your-machine" method="POST" enctype="multipart/form-data">
          <span class="kontakt-form-text">Company Name:</span><br>
          <input name="company" type="text" style="width: 100%" required><br>

          <span class="kontakt-form-text">Machine Name:</span><br>
          <input name="machine_name" type="text" style="width: 100%" required><br>

          <span class="kontakt-form-text">Your Name #:</span><br>
          <input name="serial_no" type="text" style="width: 100%" required><br>

          <span class="kontakt-form-text">Email ID:</span><br>
          <input name="email" type="email" style="width: 100%" required><br>

          <span class="kontakt-form-text">Phone #:</span><br>
          <input name="phone" type="number" style="width: 100%" required><br>

          <span class="kontakt-form-text"> Full Machine Name:</span><br>
          <input name="full_name" type="text" style="width: 100%" required><br>

          <span class="kontakt-form-text">Technical Specifications:</span><br>
          <textarea name="technical_specification" style="width:100%;outline:none" cols="31" rows="2" required></textarea><br>

          <span class="kontakt-form-text">Machine Featured Image:</span><br>
          <input type="file" name="featuredImage" required style="width: 100%"><br>

          <span class="kontakt-form-text">Machine Other Image:</span><br>
          <input type="file" name="otherImages[]" multiple style="width: 100%"><br>

          <input type="hidden" name="country" value="none">
          <input name="quote_form" type="submit" class="kontakt_btn" id="Submit" style="height:30px;width:75px;font-size: 13px;font-weight: bolder;" value="Submit">
        </form>
      </div>
      <section class="s-12 m-7 l-8 " style="

               width: 70%;

               float: left;padding-right:10px" id="desk-form">
        <form action="/upload-your-machine" method="POST" enctype="multipart/form-data">


          <table style="width:100%;font-family:arial;font-size:12px;margin-top:1px">



            <tbody>
              <tr>

                <td width="110" height="22" align="left" valign="top">
                  <div align="left"><span class="kontakt-form-text">Company Name:</span> </div>
                </td>




                <td height="22" colspan="2" align="left" valign="top"><input name="company" type="text" class="kontakt-text" style="width:100%;outline:none" size="30" required></td>

              </tr>
              <tr>

                <td width="110" height="22" align="left" valign="top">
                  <div align="left"><span class="kontakt-form-text">Machine Name:</span> </div>
                </td>




                <td height="22" colspan="2" align="left" valign="top"><input name="machine_name" type="text" class="kontakt-text" style="width:100%;outline:none" size="30" required></td>

              </tr>

              <tr>

                <td width="110" height="22" align="left" valign="top">
                  <div align="left"><span class="kontakt-form-text">Your Name #:</span> </div>
                </td>



                <td colspan="2" style="background-color: #f3f9fa;" height="22" align="left" valign="top"><input name="serial_no" style="width:100%;outline:none" type="text" class="kontakt-text" size="30" required></td>

              </tr>

              <tr>

                <td width="110" height="22" align="left" valign="top">
                  <div align="left"><span class="kontakt-form-text">Email ID:</span> </div>
                </td>



                <td height="22" colspan="2" align="left" valign="top"><input name="email" style="width:100%;outline:none" type="email" class="kontakt-text" size="30" required></td>

              </tr>

              <tr>

                <td width="110" height="22" align="left" valign="top">
                  <div align="left"><span class="kontakt-form-text">Phone #:</span> </div>
                </td>



                <td height="22" colspan="2" align="left" valign="top"><input name="phone" style="width:100%;outline:none" type="number" class="kontakt-text" size="30" required></td>

              </tr>

              <tr>

                <td width="110" height="22" align="left" valign="top">
                  <div align="left"><span class="kontakt-form-text"> Full Machine Name:</span> </div>
                </td>




                <td height="22" colspan="2" align="left" valign="top"><input name="full_name" type="text" class="kontakt-text" style="width:100%;outline:none" size="30" required></td>

              </tr>









              <tr>

                <td width="110" height="22" align="left" valign="top">
                  <div align="left"><span class="kontakt-form-text">Technical Specifications:</span> </div>
                </td>



                <td height="22" colspan="2" align="left" valign="top"><textarea name="technical_specification" class="kontakt-text" style="width:100%;outline:none" cols="31" rows="2" required></textarea></td>

              </tr>
              <tr>

                <td width="110" height="22" align="left" valign="top">
                  <div align="left"><span class="kontakt-form-text">Machine Featured Image:</span> </div>
                </td>



                <td height="22" colspan="2" align="left" valign="top"><input type="file" name="featuredImage" required></td>

              </tr>
              <tr>

                <td width="110" height="22" align="left" valign="top">
                  <div align="left"><span class="kontakt-form-text">Machine Other Image:</span> </div>
                </td>



                <td height="22" colspan="2" align="left" valign="top"> <input type="file" name="otherImages[]" multiple></td>

              </tr>


              <input type="hidden" name="country" value="none">



              <tr align="left" valign="bottom">
                <td></td>

                <td valign="middle">


                  <input name="quote_form" type="submit" class="kontakt_btn" id="Submit" style="height:30px;width:75px;font-size: 13px;font-weight: bolder;" value="Submit">

                </td>

              </tr>





            </tbody>
          </table>

        </form>
      </section>




    </div>

  </div>

</section>


@endsection