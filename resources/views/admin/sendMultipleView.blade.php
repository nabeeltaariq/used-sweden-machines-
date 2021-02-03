@extends('admin.templates.products')

@section('products_content')

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
    <form action='' method='post'>
    <table>
    <a href="{{URL::to('/admin/products')}}">Back to Products</a><table width='80%' border='0' align='center'>
        <br/>
        @if(isset($message))
        <div class="alert alert-success">Send to multiple emails successfully</div>
        @endif
        <tr>
        <td align='left'><a href='http://usedswedenmachines.com/'><img src="{{URL::to('/public/imgs/logo.png')}}" height='75' style='height: 144px;'></a> <br/>



            </td>
            <td width='60%' align='right'>
                <p ><span style='color:#034375;font-weight:bold;font-size: 19px;'>Used Sweden Machines</span><br>
                    D.O.H.S 290, Phase 1 Gujranwala, Pakistan<br>
                    Company Registration No: <span style='color:#034375;font-weight:bold;'>4015134-4</span><br>
                    Tel.: +92(321)7415373<br>
                    E-Mail: <a href='mailto:info@usedswedenmachines.com'>info@usedswedenmachines.com</a><br>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan='2' >
                <p align='center'><strong>{{$product[0]->pr_title}} </strong></p><hr>
            </td>
        </tr>
        <tr>
            <td colspan='2' align='left'>
                <a href='http://usedswedenmachines.com/machine.php?m_id=9' ><img style='margin-bottom:-6px' src='{{URL::to('/storage/app/products/')}}/{{$product[0]->image}}' height='250' ></a>
                <br/>
            <a style='color:#e01515;text-decoration:none' href="{{URL::to('/machineView/')}}/{{$product[0]->id}}" >click here for more details and pictures</a>
            </td>
        </tr>
        <tr>

            <td colspan='2' align='left'>
                <div class='st_div'>Title: {{$product[0]->pr_title}} <br>SKU:  {{$product[0]->SKU}}<br>Specifications:{!! html_entity_decode($product[0]->long_des) !!}

            </td>
        </tr>
    </table><table width='80%' align='center'>
        <tr><td>Select Contact Type</td><td>

                    <select name="" id="contactType">
                        <option value="*">Plaase Select</option>
                        @foreach($heads as $h)

                    <option value="{{$h['id']}}">{{$h["Name"]}}</option>

                        @endforeach
                    </select>
                    
                    <br/></td></tr>
                    <tr>
                        <td>Select Contact</td>
                        <td id="contacts">
                            <code>You have not selected any contact type</code>
                        </td>
                    </tr>
                    
                    
                    <tr><td>Price:</td><td><input type='text' name='price' value='{{$product[0]->salesPrice}}' required></td></tr><tr><td>Condition:</td><td><input type='text' value='{{$product[0]->machineCondition}}' name='condition' ></td></tr><tr><td>Terms & Conditions:</td><td><input type='text' value='{{$product[0]->termsAndCondition}}' name='tandc' required></td></tr><tr><td>Delivery Time:</td><td><input type='text' value='{{$product[0]->deliveryTime}}' name='dt' required></td></tr><tr><td>Delivery Terms:</td><td><input type='text' value='{{$product[0]->deliveryTerms}}' name='dtt' required></td></tr><tr><td>Payment terms:</td><td><input type='text' value='{{$product[0]->paymentTerms}}' name='pt' required></td></tr><tr><td>Way of Payment:</td><td><input type='text' value='{{$product[0]->waysOfPayments}}' name='wop' required></td></tr><tr><td colspan='2'><div style="text-align: left;"><strong><u>BENEFICIARY BANK INFORMATION:</u></strong></div>
                    <div style="text-align: left;">Bank Name: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Habib Bank Limited</div>
                    <div style="text-align: left;">Account Number: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;14297900692903</div>
                    <div style="text-align: left;">Account Name: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Used Sweden Machines</div>
                    <div style="text-align: left;">IBAN: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;PK76HABB0014297900692903</div>
                    <div style="text-align: left;">Bank Address: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Main Model Town&nbsp;Branch(1429) Gujranwala, Pakistan</div>
                    <div style="text-align: left;">Bank Tel: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; +92-55-4445018</div>
                    <div style="text-align: left;"><strong><u>BENEFICIARY COMPANY INFORMATION:</u></strong></div>
                    <div style="text-align: left;">Company Name: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Used Sweden Machines</div>
                    <div style="text-align: left;">Address: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;D.O.H.S 290, Phase 1, Gujranwala Cantt, Pakistan</div>
                    <div style="text-align: left;">Telephone: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; +92-321-7415373; +92-55-3845988</div></td></tr>
            <tr>
                <td colspan='2' align='center' width='50%'>
                    <p align='center'>All offers are prior to sale</p>
                    <p style='padding-top: 10px;'> <span style='color:red;font-weight:bold;'>* CONDITION RATING </span><br>
                        <span style='color:red;font-weight:bold;'>1 = very good 2 = good 3 = fair 4 = poor 5 = very poor</span><br>
                        Tel +92-321-7415373  Fax +92-55-3845997     <a href='mailto:info@usedswedenmachines.com'>info@usedswedenmachines.com</a><br>
                        <a href='http://usedswedenmachines.com'>www.usedswedenmachines.com</a><br>

                    </p>
                </td>
            </tr>

            <tr><td><input type='submit' value='Send Performa Invoice' name='submit_single' ></td></tr></form></table><div style='height:40px;'></div></div>
   
        </table>
    </form>
    <div id="response">
    </div>
    <script>
        $("#contactType").on("change",function(){
           let selectedType = $(this).val();
           if(selectedType != "*"){
            $("#contacts").html("<div class='spinner-border text-info'></div>Please Wait fetching contacts");
            $.ajax({
                url:"{{URL::to('/api/fetchContactEmails')}}",
                method:"GET",
                data:{"contactType":selectedType},
                success:function(data){
                    console.log(data);
                    $("#contacts").html("");
                    data.map(email => {
                        $("#contacts").append("<label title='"+email.title+"' style='width:inherit'><input type='checkbox' class='email' name='personEmail[]' value='"+email.email+"'/>"+email.title + "</label>");
                    });
                }
            })
           }else{
                $("#contacts").html("<code>You have not selected any contact type</code>");
           }
        });
    
        $("form").on("submit",function(e){
            e.preventDefault();
            let countChecked = $(".email:checked").length;
            if(countChecked >= 1){
                $("form")[0].submit();
            }else{
                alert("Sorry! please select any contact first");
            }

        });
    </script>
    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });
        </script>

    
@endsection