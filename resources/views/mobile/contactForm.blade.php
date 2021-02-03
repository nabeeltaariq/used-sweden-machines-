@extends("mobile.templates.public")
@section("content")

<div class="container">
    <div id="blog_left" class="contact" style="margin-top:190px">
                      <h4 class="item" style="
                       
                       width: 62.333%;
                       font-weight:bold;
                       z-index: -200;
                       display: block;
                       /* line-height: 28px; */
                       /* padding-left: 14px; */
                       font-family: 'arial';
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
                       width: 37.333%;
                       font-size: 19px;
                       /* margin-top: 30px; */
                       ">Contact Us</h4>
                  <div id="vcard" style="float:right;margin-top:-60px"><a href="img/Sweden Machine.vcf"><img src="http://demo.usedswedenmachines.com/public/imgs/vcard1.png" height="80px" width="120px" style="margin-top:10px">

                       </a>
                       </div>
                      <p style="margin-bottom:0px;/* font-family: arial; */font-size: 14px;"><strong>USM-Used Sweden Machines</strong><br>83-A, S.I.E # 1 Gujranwala Pakistan</p>
    <p>Tel.: <a href='tel:+92 (321) 7415373' style="color:#015292">+92 (321) 7415373</a><br>E-Mail: <a class="link" style="color: #015292; text-decoration: underline;" href="mailto: info@usedswedenmachines.com">info@usedswedenmachines.com</a></p>
                      <div style="margin-top:15px;">

                      </div>
                    </div>
    <form method="GET" action="{{route('ContactFormSubmit')}}" name="contactformnew">
        @csrf
                  <label for="company" id="testLabel" style="width:100%">
                    Company <span class="text-danger">*</span>
                    <input type="text" required name="company" id="company" style="width:100%" autocomplete="off" class="form-control">
                    <input type="hidden" name="Email-From" value="Contact US Form">

                  </label>
                  <label for="fullName" style="width:100%">
                    Full Name <span class="text-danger">*</span>
                    <input type="text" required name="fullName" id="fullName" style="width:100%" class="form-control">

                  </label>
                  <label for="phone" style="width:100%">
                    Phone <span class="text-danger">*</span>
                    <input type="number" required name="phone" id="phone" style="width:100%" class="form-control">

                  </label>

                  <label for="email" style="width:100%">
                    Email <span class="text-danger">*</span>
                    <input type="email" required name="emailAddress" id="emailAddress" style="width:100%" class="form-control">

                  </label>

                  <label for="message" style="width:100%">
                    Message <span class="text-danger">*</span>
                    <textarea class="form-control" required id="message" name="message"></textarea>

                  </label>
                  <br/>
                  <input type="submit" value="Submit" class="btn btn-primary btn-block" style="background-color:#005292;"/>
                  <br/>

        </form>
    </div>
    <style>

    </style>
    <script>
      $("input,textarea").on("focus",function(){

        $(".head").hide();


      });

      $("input,textarea").on("focusout",function(){


        $(".head").show();

      });

      $("form").on("submit",function(e){
        e.preventDefault();
        var company = $("#company").val();
        var fullName = $("#fullName").val();
        var phone = $("#phone").val();
        var email = $("#emailAddress").val();
        var message = $("#message").val();
        var from = $("Email-From").val();
        console.log(company + fullName + phone + email + message + from );
        $.ajax({
          url:"/contact/mobile",
          data:{Company:company,Name:fullName,Telephone:phone,emailAddress:email,Message:message,EmailFrom:"USM-Contact Us Page"},
          success:function(data){
            const wrapper = document.createElement('div');
                    wrapper.innerHTML = "<div style='padding-top:10px'>Your inquiry from email <b>"+email+"</b> has been received</div>";
                    swal({
                      title: '',
                      text: '',
                      content: wrapper,
                      icon:"success",
                      showCloseButton:true

                    });
          }
        });

      });

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
    <script>
      $("input[name='search']").attr("disabled","true");
    </script>

@endsection
