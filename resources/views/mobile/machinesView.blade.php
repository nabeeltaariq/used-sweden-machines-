@extends("mobile.templates.public")
@section("content")
    <div style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;
    font-size: 14px;">
    @foreach($products as $product)
    
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content" style="border-radius:0px">
            <div class="modal-header" style="padding:10px">
             
              <h4 class="modal-title" style="font-weight:200;font-size:18px">Modal Header</h4>
               <button type="button" class="close" style="float-right" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:0px">
              <div class="bg-primary" style="padding:10px 0px;background-color:#005294;">
                  <div class="container">
                      <h5 style="margin:0px;font-size:14px;color:white">Enter Contact Information for Inquiry This machine Details</h5>
                  </div>
              </div>
              <br/>
                  <div class="container-fluid">
                        <form method="post" action="">
                         <label for="itemNo" style="width:100%">
                          Item#
                          <input type="text" style="border-radius:0px" name="itemNo" id="itemNo" readonly class="form-control">
                         </label>
                            <label for="machineName" style="width:100%">
                          Machine Name
                          <input type="text" style="border-radius:0px" name="machineName" id="machineName" readonly class="form-control">
                         </label>
                         <label for="fullName" style="width:100%">
                          Full Name <span class="text-danger">*</span>
                          <input type="text" style="border-radius:0px" required name="fullName" id="fullName" class="form-control">
                         </label>
                         <label for="phoneNo" style="width:100%">
                          Phone No.<span class="text-danger">*</span>
                          <input type="text" inputmode="numeric" style="border-radius:0px" required name="phoneNo" id="phoneNo" class="form-control">
                         </label>
                         <label for="email" style="width:100%">
                          Email<span class="text-danger">*</span>
                          <input type="email" style="border-radius:0px" required name="email" id="email" class="form-control">
                         </label>
                         <label for="company" style="width:100%">
                          Company<span class="text-danger">*</span>
                          <input type="text" style="border-radius:0px" required name="company" id="company" class="form-control">
                         </label>

                         <label for="specialRequest" style="width:100%">
                          Special Request <span class="text-danger">*</span>
                          <textarea name="specialRequest" id="specialRequest" required style="border-radius:0px" class="form-control">Please, contact regarding this machine</textarea>
                         </label>
                         <p align="right"><input style="border: 1px solid lightgray;color: #333; background-color: #fff; border-color: #ccc; font-size: 14px;" type="button" id="submitButton" value="Submit" class="btn btn-default"/></p>
                     </form>

                  </div>
            </div>

          </div>

        </div>
      </div>
      <div class="mobile_row" sku="<?= $product->SKU ?>">
          <div class="image">
              <!--
              img/justInLogo.png
              img/soldLogo.png

               -->
               <?php
                  $statusIcon = "";
                  if($product->s_status == "SOLD"){
                          $statusIcon = URL::to('/public/imgs') . "/soldLogo.png";
                  }else{
                      $statusIcon = URL::to('/public/imgs') . "/justInLogo.png";
                  }

               ?>
              <img src="<?= $statusIcon ?>" style="box-shadow: none;border:none;position:absolute">
              <img src="<?= URL::to('/storage/app/products/') . '/' . $product->image ?>" height="100px" style="width:30vw" alt="<?= $product->pr_title ?>"></div>
          <div class="description">
              Item# <?= $product->SKU ?><br/>
              <b><?= htmlentities($product->pr_title) ?></b>
              <p style="margin:0px;">

                  <?= substr($product->short_des,0,90) ?>...<a class="readMoreButton" href="#" style="color:#015292">Read More</a>

              </p>


          </div>
          <div class="more">
              <table class="table table-bordered">

                 
                   <tr style="display:none">
                      <th>Reference Number</th>
                      <td>
                          <?= $product->SKU ?>
                      </td>

                  </tr>
                  <tr style="display:none">
                      <th colspan="2">Description</th>
                  </tr>
                  <tr>

                      <td colspan="2">
                          <?= html_entity_decode($product->long_des) ?>
                      </td>
                  </tr>
                  <tr>
                      <td colspan="2">

                          <a href="#" class="modelButton btn btn-primary" style="
          color: #015291;
          font-weight: bolder;
          /* background-color: #337ab7; */
          border-color: #2e6da4;
          background-color:white;
          border: 2px solid;
          padding: 4px 7px;
          padding-bottom: 2px;
          padding-right: 7px;
          " data-toggle="modal" data-target="#myModal">
                         <span style="
          font-size: 15px;
          margin-top: -10px;
          display: inline-block;
          padding-bottom: 2px;
      "> Request Info.</span></a>
                          &nbsp;
                      <a href="{{URL::to('/machine-pdf')}}/{{$product->id}}" style="
          color: #015291;
          font-weight: bolder;
          /* background-color: #337ab7; */
          border-color: #2e6da4;
          background-color:white;
          border: 2px solid;
          padding: 4px 7px;
          padding-bottom: 2px;
          padding-right: 7px;
          " class="btn btn-primary" target="_blank">

                          <i class="fas fa-file-pdf text-danger" style="
          font-size: 20px;
      "></i> <span style="
          font-size: 15px;
      ">Download PDF</span>

                          </a>

                          &nbsp;

                          <a href="tel:+92-321-741-5373" class="btn btn-primary" style="
          color: #015291;
          font-weight: bolder;
          /* background-color: #337ab7; */
          border-color: #2e6da4;
          background-color:white;
          border: 2px solid;
          padding: 4px 7px;
          padding-bottom: 2px;
          padding-right: 7px;
          ">
                              <span style="
          font-size: 14px;
          margin-top: -8px;
          display: inline-block;
          padding-bottom: 2px;
              padding-left: 7px;
          padding-right: 7px;
      ">Call</span>
                          </a>
                      </td>
                  </tr>

              </table>
          </div>
      </div>
      <div style="clear:both"></div>


    @endforeach
    </div>

    <style>
        .mobile_row{
            width:100%;
            border:0.5px solid #ccc;
        }

        .mobile_row .image{
            width:30%;
            float:left
        }

        .mobile_row .description{
            width:70%;
            float:left;
            padding-left:10px;
        }

        .mobile_row .more{

            width:100%;
            display:none;

        }

        .modal-title h4{
            font-weight:unset;
            font-size:16px;
        }

    </style>
    <script>
        $(".readMoreButton").on("click",function(e){
            e.preventDefault();

            // $( ".mobile_row" ).each(function( i , e ) {

            //     if($(this).parent().parent().parent() != e){
            //         $(this).find(".more").hide();
            //     }

            // });

           //if ($('#DivToSlide').is(':visible'))


            $(this).parent().parent().parent().find(".more").slideToggle("slow");
           // console.log($(this).parent().parent().parent()[0]);
            //$(this).parent().parent().parent().scrollIntoView();

            //$(this).parent().parent().parent()[0].scrollTop += 800;
            if($(this).html() == "Read More"){
                $(this).html("Read Less");
            }else{
                $(this).html("Read More");
            }

            $(this).parent().parent().parent()[0].scrollIntoView(true);
           var scrolledY = window.scrollY;
           window.scroll(0, scrolledY - 180);

        });

        $machine = null;
        let usmNo = null;
        var machineName = null;
        $(".modelButton").on("click",function(){

           $machine = $(this).parent().parent().parent().parent().parent().parent();
           let usmNo = $machine.find(".more").children()[0].rows[0].cells[1].innerText;
           machineName = $machine.find(".description").find("b").html();
           $("#itemNo").val(usmNo);
          $(".modal-title").html("Inquiry about " + $machine.find(".description").find("b").html());
          $("input[name='machineName']").val(machineName);


        });

      let captchaToken = "";
grecaptcha.ready(function() {
    grecaptcha.execute('6LeZq9gUAAAAAEG6mWFXj3o_k0h35O8otcNK7ftL', {action: 'homepage'}).then(function(token) {
        captchaToken = token;
        console.log(captchaToken);
    });
});




        $("#submitButton").on("click",function(e){
           // e.preventDefault();
            var machineNo = $("#itemNo").val();
            var fullName = $("#fullName").val();
            var phoneNo = $("#phoneNo").val();
            var email = $("#email").val();
            var company = $("#company").val();
            var specialRequest = $("#specialRequest").val();
            var machineName = $("input[name='machineName']").val();

            console.log("Going to send email");
            $('#myModal').modal('hide');
                    //console.log(data);
                    const wrapper = document.createElement('div');
                    wrapper.innerHTML = "<div style='padding-top:10px'>Your inquiry related <b>"+machineName+"</b> has been received</div>";
                    swal({
                      title: '',
                      text: '',
                      content: wrapper,
                      icon:"success",
                      showCloseButton:true

                    });

            $("button.swal-button").html("Close");


            if(machineName.length >= 4 && phoneNo.length >= 5 && email.length >= 5 && company.length >= 4 && specialRequest.length >= 5){

            $.ajax({
                url:"{{URL::to('/machine/109')}}",
                method:"POST",
                data:{serial_no:machineNo,machine_name:machineName,full_name:fullName,phone:phoneNo,email:email,company:company,request:specialRequest,token:captchaToken,_token:"{{csrf_token()}}"},
                success:function(data){
                   console.log(data);
                }

            });
            }else{
                console.log("Issue Raised");
                console.log(phoneNo);
            }






        });

        $("input[name='search']").on("keyup",function(){

         let val = $(this).val();
         if(val.length >= 1){
           $(".mobile_row").each(function(){

           let currentVal = $(this).children()[1].childNodes[3].innerHTML;


           if(currentVal.toUpperCase().indexOf(val.toUpperCase()) != -1){
            $(this).show();
           }else{
            $(this).hide();
            let sku =  $(this).attr("sku");


            if(sku.toUpperCase().indexOf(val.toUpperCase()) == -1){
                $(this).hide();
            }else{
                $(this).show();
            }

            // sku = sku.split("#");
            // console.log(sku);
           }

           });
         }else{
            $(".mobile_row").each(function(){

            $(this).show();

           });
         }

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

@endsection
