@extends("mobile.templates.public")
@section("content")
<div class="container" style="margin-top:20px">
    <div id="blog_left" class="contact">
                      <h4 class="item" style="
                       width: 62.333%;
                       font-weight:bold;
                       z-index: -200;
                       display: inline-block;
                       /* line-height: 28px; */
                       /* padding-left: 14px; */
                       font-family: 'arial';
                       font-size: 18px;
                       /* max-width: 300px; */
                       width: 62.333%;
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
                       position: relative;
                       width: 84%;
                       margin-top: 20px;
                       ">Sell to Used Sweden Machines</h4>

                      <p style="margin-bottom:0px"><!-- <strong>USM-Used Sweden Machines</strong><br>83-A, S.I.E # 1 Gujranwala Pakistan</p>
    <p>Tel.: +92 (321) 7415373<br>E-Mail: <a class="link" style="color: blue; text-decoration: underline;" href="mailto: info@usedswedenmachines.com">info@usedswedenmachines.com</a> -->

                        We buy a wide range of plant and machinery at competitive prices. Whether it's a individual machine or a complete manufacturing facility you have for sale, please contact us with details by filling the form below including attaching photos of the equipment.
                        <br/>
                        <span style="color:red;"><i>WE PAY BEST PRICES FOR USED TETRA PAK MACHINES AND COMPLETE FACILITIES</i></span><br/>
                        To discuss any aspect of Used Tetra Pak Machines For Sale supply or sourcing or for any other dairy processing machinery, just give us a call on: <br/><a href="tel:+92-321-741-5373">+92-321-741-5373</a>

    </p>
                      <div style="margin-top:15px;">

                      </div>
                    </div>
          <form method="post" action="">

                  <?php
                    $message = "";
                    if(isset($_POST["company"])){

                        $message = "Message from Purchase Form mobile USM \n";
                        $message .= "Company: " . $_POST["company"] . "\n";
                        $message .= "Email: " . $_POST["emailAddress"] . "\n";
                        $message .= "Mobile: " . $_POST["mobile"] . "\n";
                        $message .= "Country: " . $_POST["country"] . "\n";
                        $message .= "Equipment Details: " . $_POST["message"] . "\n";



                       $headers = "From: " . strip_tags($_POST['emailAddress']) . "\r\n";

                        //
                        mail("inquiry@trepak.pk","USM Purchase Inquiry",$message,$headers);


                    ?>

                    <script>

                         const wrapper = document.createElement('div');
                        wrapper.innerHTML = "<div style='padding-top:10px'>Your response has been received successfully!</div>";
                        swal({
                          title: '',
                          text: '',
                          content: wrapper,
                          icon:"success",
                          showCloseButton:true

                        });

                    </script>

                <?php
                    }


                  ?>


                  <label for="company" id="testLabel" style="width:100%">
                    Company <span class="text-danger">*</span>
                    <input type="text" required name="company" id="company" style="width:100%" autocomplete="off" class="form-control">
                    <input type="hidden" name="Email-From" value="Contact US Form">

                  </label>

                  <label for="email" style="width:100%">
                    Email <span class="text-danger">*</span>
                    <input type="email" required name="emailAddress" id="emailAddress" style="width:100%" class="form-control">

                  </label>


                    <label for="email" style="width:100%">
                    Mobile Number <span class="text-danger">*</span>
                    <input type="number" required name="mobile" id="mobile" style="width:100%" class="form-control">

                  </label>


                  <label for="message" style="width:100%">
                    Country <span class="text-danger">*</span>
                    <input type="text" name="country" required id="country" style="width:100%" class="form-control"/>
                  </label>

                  <br/>
                  <label for="message" style="width:100%">

                    <textarea id="message" required name="message" placeholder="Enter details of equipment you want to sell." class="form-control"></textarea>

                  </label>
                   <br/>
                  <input type="submit" value="Submit" class="btn btn-primary btn-block" style="background-color:#005292;"/>
                <br/><br/>

        </form>
    </div>
    <style>

    </style>
    <script>


    </script>

    <style>
        .swal-modal{
                margin-top: -280px;
                border-radius: 0px;
        }
        .swal-footer{
            text-align:center;
        }

        .swal-button{
                background-color: white;
        border: 1px solid #005294;
        border: 2px solid #005294;
        padding: 5px 30px;
        font-size: 18px;
        font-weight: normal;
        color:#005294;
        }

    </style>

@endsection
