@extends("admin.templates.contacts")
@section("contacts_content")
<div><div class="row">
    <div class="col-lg-8 col-md-8">
        <form action="" method="post" enctype="multipart/form-data">
            <table style="font-size:12px">
                <tbody><tr>
                <th>Product/Service (Name)</th><td><input value="{{$service->name}}" type="text" name="serviceName" id="serviceName" readonly=""></td>
                    <th>Description</th>
                <td colspan="4"><input type="text" value="{{$service->description}}" name="productDescription" id="productDescription" style="width:100%" readonly=""></td>
                    <input type="hidden" name="productId" value="47">
                </tr>
                <tr>
                    <th>HS-Code</th>
                <td><input type="text" readonly="" name="hsCode" id="hsCode" value="{{($service->Detail() != null ? $service->Detail()->hsCode : '')}}" ;=""></td>
                    <th>
                        Custom Duty
                    </th>
                    <td><input type="text" readonly="" name="customDuty" id="customDuty" value="{{($service->Detail() != null ? $service->Detail()->customDuty : '')}}"></td>
                    <th>Sales Tax</th>
                    <td><input type="text" readonly="" name="salesTax" id="salesTax" style="width:100%" value="{{($service->Detail() != null ? $service->Detail()->salesTax : '')}}"></td>
                </tr>
                <tr>
                    <th>Income Tax</th>
                    <td><input type="text" readonly="" name="incomeTax" id="incomeTax" value="{{($service->Detail() != null ? $service->Detail()->incomeTax : '')}}"></td>
                    <th>Value</th>
                    <td>
                        <input style="width:100%" type="text" readonly="" name="valueProduct" id="valueProduct" placeholder="Per Kg" value="{{($service->Detail() != null ? $service->Detail()->valueProduct : '')}}">
                    </td>
                    <th></th>
                    <td align="right">

                    </td>
                </tr>
                <tr>
                    <th>Height</th>
                    <td><input type="text" readonly="" name="height" id="height" value="{{($service->Detail() != null ? $service->Detail()->height : '')}}"></td>
                    <th>Width</th>
                    <td><input type="text" readonly="" name="width" id="width" value="{{($service->Detail() != null ? $service->Detail()->width : '')}}"></td>
                    <th>Loading Capacity</th>
                    <td>
                        <input type="radio" disabled="" name="loadingCapacity" id="capacity" value="20">20-Feet
                        <input type="radio" disabled="" name="loadingCapacity" id="capacity" value="40">40Feet
                    </td>
                </tr>
                <tr>
                    <th>Quality Parameter</th>
                    <td colspan="5">
                        <input type="text" readonly="" name="qualityParameter" id="qualityParameter" style="width:100%" value="{{($service->Detail() != null ? $service->Detail()->qualityParameter : '')}}"/>
                    </td>
                </tr>
                <tr>
                    <th>FTA</th>
                    <td><input type="text" readonly="" name="fta" id="fta" value="{{($service->Detail() != null ? $service->Detail()->fta : '')}}" ;=""></td>
                    <th>Custom Value</th>
                    <td><input type="text" readonly="" name="valueAtCustom" id="valueAtCustom" value="{{($service->Detail() != null ? $service->Detail()->valueAtCustom : '')}}" ;=""></td>
                    <td>AST</td>
                    <td><input type="text" name="ast" id="ast" value="{{($service->Detail() != null ? $service->Detail()->ast : '')}}" readonly=""></td>
                    </tr>
                    <tr>
                    <th>RD</th>
                    <td><input type="text" name="rd" id="rd" value="{{($service->Detail() != null ? $service->Detail()->rd : '')}}" readonly=""></td>
                    <td colspan="4" align="right">
                        <a href="{{($service->Previous() != null ? URL::to('admin/contacts/services/single/') . '/' . $service->Previous()->id : '#')}}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Previous"><i class="fas fa-arrow-circle-left"></i></a>

                        <a href="{{($service->Next() != null ? URL::to('admin/contacts/services/single/') . '/' . $service->Next()->id : '#')}}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Next" {{$service->Next() == null ? 'disabled' : ''}}><i class="fas fa-arrow-circle-right"></i></a>
                    <a href="{{URL::to('admin/contacts/services/edit/')}}/{{$service->id}}" data-toggle="tooltip" class="btn btn-success btn-sm" title="Edit"><i class="fas fa-edit" aria-hidden="true"></i></a>
                    </td>
                </tr>
            </tbody></table>
        </form>
        <div>
            <br/>

        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        @php
            $imageURL = "";
            if($service->Detail() != null){
              $imageURL =  $service->Detail()->pictureUrl;
            }

        @endphp
        <img src="{{URL::to('/storage/app/cms/')}}/{{$imageURL}}" style="max-height:200px" alt="Image Not Available" class="img-thumbnail">
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="bg-primary" style="color:white;padding:5px 10px;cursor:pointer">
            Custom Duty Calculations For this Product/Service
            <span style="float:right">
                <i class="fas fa-angle-down"></i>
            </span>
        </div>
        <div class="jumbotron" style="padding:10px 20px; display:block">
            <table style="font-size:12px;border-collapse: collapse;" border="1">
                <tbody><tr>
                    <th>Description</th><th>Percentage</th><th>Amount</th><th>Accumulative Amount</th>
                </tr>
                <tr>
                    <td>Custom Value of Goods Per Kg</td><td><input style="width:100%" type="text" id="valueOfGood" ng-model="service.customWeight" none=""></td>
                    <td></td><td id="calcValue"><%service.customWeight%></td>
                </tr>
                <tr>
                    <td>Total Weight (in Kg)</td><td><input type="number" style="width:100%" ng-model="service.weightInKg" name="weightInKg" id="weightInKg"></td><td></td>
                    <td id="calcWeight"><%service.customWeight*service.weightInKg%>$</td>
                </tr>
                <tr>
                    <td>Exchange Rate</td><td><input type="number" min="1" style="width:100%" name="exchangeRate" id="exchangeRate" ng-model="service.exchangeRate"></td>
                    <td></td><td id="calcExchange">
                        <%service.customWeight*service.weightInKg*service.exchangeRate%> PKR
                    </td>
                </tr>
                <tr>
                    <td>Main Value</td>
                    <td></td>
                    <td></td>
                    <td><%service.customWeight*service.weightInKg*service.exchangeRate%> PKR</td>
                </tr>
                <tr>
                    <td>Custom Duty (%)</td><td><input type="number" ng-model="service.customDuty" id="cDuty" none=""></td>
                    <td id="valCustom"><%calculateCustomDutyAmount()%></td>
                    <td id="calcCustom"></td></tr>
                    <tr>
                        <td>RD (%)</td>
                        <td><input type="number" id="rD" ng-model="service.rd" none=""></td>
                        <td id="valRd"><%calculateRd()%></td>
                        <td id="calcRd"></td></tr>
                        <tr>
                            <td>ACD (%)</td>
                            <td><input type="number" ng-model="service.acd" id="a.St" none=""></td>
                            <td id="valAct">
                                <%calulateAcd()%>
                            </td>
                            <td id="calcAct"></td>
                        </tr>
                        <tr><td>Sales Tax (%)</td>
                    <td><input type="number" ng-model="service.salesTax" id="sTax" none=""></td>
                    <td id="valSales"><%calculateSalesTax()%></td>
                    <td id="CalcSales"></td></tr>


                    <tr>
                        <td>AST (%)</td>
                        <td><input type="number" ng-model="service.ast" id="a.St" none=""></td>
                        <td id="valAct">
                            <%calculateAst()%>
                        </td>
                        <td id="calcAct"></td>
                    </tr>
                    <tr>
                        <td>Income Tax (%)</td>
                        <td><input type="text" ng-model="service.incomeTax" id="iTax" none=""></td>
                        <td id="valIncome"><%calculateIncomeTax()%></td>
                        <td id="calcIncome"></td></tr>

                <tr>
                    <td>Total Duties and Taxes</td>
                    <td></td>
                    <td><%calculateTotalDutyAndTaxis()%></td>
                    <td><%calculateTotalDutyAndTaxis()%></td>
                </tr>

                <tr>

                    <td>Sindh Excise Duty</td>
                    <td><input type="number" name="sindhExcise" ng-model="service.sindhExcise" id="sindhEx"></td>
                    <td><%calculateSindhExcise()%></td>
                    <td id="sindhExcise"><%calculateAmountAfterExciseDuty()%> PKR</td>
                </tr>
                <tr>
                    <td>Delivery Order</td>
                    <td><input type="number" name="deliveryOrder" ng-model="service.deliveryOrder" id="deliveryOr"></td>
                    <td></td>
                    <td id="deliveryOrder"><%calculateAmountAfterExciseDuty()+service.deliveryOrder%> PKR</td>
                </tr>
                <tr>
                    <td>Port Rent</td>
                    <td><input type="number" name="portRent" ng-model="service.portRent" id="portR"></td>
                    <td></td>
                    <td id="portRent"><%calculateAmountAfterExciseDuty()+service.deliveryOrder+service.portRent%> PKR</td>
                </tr>
                <tr>
                    <td>Container Rent</td>
                    <td><input type="number" name="containerRent" ng-model="service.containerRent" id="containerR"></td>
                    <td></td>
                    <td id="containerRent"><%calculateAmountAfterExciseDuty()+service.deliveryOrder+service.portRent+service.containerRent%> PKR</td>
                </tr>
                <tr>
                    <td>Insurance Charges</td>
                    <td><input type="number" name="insuranceCharges" ng-model="service.insuranceCharges" id="insuranceChar"></td>
                    <td></td>
                    <td id="insuranceCharges"><%calculateAmountAfterExciseDuty()+service.deliveryOrder+service.portRent+service.containerRent+service.insuranceCharges%> PKR</td>
                </tr>
                <tr>
                    <td>Agency Commission</td>
                    <td><input type="number" name="agencyCommission" ng-model="service.agencyCommission" id="agencyCom"></td>
                    <td></td>
                    <td id="agencyCommission"><%calculateAmountAfterExciseDuty()+service.deliveryOrder+service.portRent+service.containerRent+service.insuranceCharges+service.agencyCommission%> PKR</td>
                </tr>
                <tr>
                    <td>Road Trasport Charges</td>
                    <td><input type="number" name="roadTransportCharges" ng-model="service.roadTransportCharges" id="rtc"></td>
                    <td></td>
                    <td id="agencyCommission"><%calculateAmountAfterExciseDuty()+service.deliveryOrder+service.portRent+service.containerRent+service.insuranceCharges+service.agencyCommission+service.roadTransportCharges%> PKR</td>
                </tr>
                <tr>
                    <td>Others</td>
                    <td><input type="number" name="other" ng-model="service.other" id="oth"></td>
                    <td></td>
                    <td id="agencyCommission"><%calculateAmountAfterExciseDuty()+service.deliveryOrder+service.portRent+service.containerRent+service.insuranceCharges+service.agencyCommission+service.roadTransportCharges+service.other%> PKR</td>
                </tr>

            </tbody></table>
        </div>

    </div>
    <div class="col-lg-6 col-md-6">
        <h5>Buying and Selling History</h5>
        <table border="1" style="border-collapse:collapse;width:100%">
            <tbody><tr style="font-size:12px">
                <th colspan="2" align="left">Buying Rates Company Wise</th>
                <th>Port of Loading</th>
            </tr>
                @php
                    $buyingCount = 0;
                @endphp
                    @foreach($service->Suppliers() as $supplier)
                       @if($supplier["mode"] == 1)
                        @php
                            $buyingCount++;
                        @endphp
                        <tr style="font-size:12px">
                        <td><a href="{{URL::to('admin/contacts/redirectToContact/')}}/{{$supplier["customerInfo"]->contactUdId}}/{{$supplier["customerInfo"]->contactTypeId}}" style="color:blue">{{$supplier["customerInfo"]->companyName}}</a></td>
                        <td>{{$supplier["rate"]}}</td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach

                @if($buyingCount <= 0)
                    </tr><tr style="font-size:12px">
                        <td colspan="3">No buying history is available</td>
                    </tr>

                @endif




            <tr>
                <th colspan="2" align="left" style="font-size:12px">Selling Rates Company Wise</th>
                <th style="font-size:12px">Port of Loading</th>
                @php
                    $sellingCount = 0;
                @endphp
                    @foreach($service->Suppliers() as $supplier)
                       @if($supplier["mode"] == 2)
                        @php
                            $sellingCount++;
                        @endphp
                        <tr style="font-size:12px">
                        <td><a href="{{URL::to('admin/contacts/redirectToContact/')}}/{{$supplier["customerInfo"]->contactUdId}}/{{$supplier["customerInfo"]->contactTypeId}}" style="color:blue">{{$supplier["customerInfo"]->companyName}}</a></td>
                        <td>{{$supplier["rate"]}}</td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach

                @if($sellingCount <= 0)
                    </tr><tr style="font-size:12px">
                        <td colspan="3">No selling history is available</td>
                    </tr>

                @endif





        </tbody></table>
    </div>
</div>
</div>

<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
      $(".bg-primary").on("click",function(){
      //  alert("Hello world");
        $(".jumbotron").slideToggle("slow");

    });


    });

    let mymodule = angular.module("mymodule",[],function($interpolateProvider){

        $interpolateProvider.startSymbol("<%");
        $interpolateProvider.endSymbol("%>");


    });

    mymodule.controller("mycontroller",function($scope){
        $scope.service = {
            name:"{{$service->name}}",
            id:"{{$service->id}}",
            description:"test service",
            hsCode:"{{($service->Detail() != null ? $service->Detail()->hsCode : '')}}",
            height:"{{($service->Detail() != null ? $service->Detail()->height : '')}}",
            width:"{{($service->Detail() != null ? $service->Detail()->width : '')}}",
            qualityParameter:"{{($service->Detail() != null ? $service->Detail()->qualityParameter : '')}}",
            customWeight:"{{($service->Detail() != null ? $service->Detail()->valueAtCustom : 0)}}",
            weightInKg:parseFloat("{{($service->Detail() != null ? $service->Detail()->weightInKg : 0)}}"),
            exchangeRate:parseFloat("{{($service->Detail() != null ? $service->Detail()->exchangeRate : 0)}}"),
            customDuty:parseFloat("{{($service->Detail() != null ? $service->Detail()->customDuty : 0)}}"),
            salesTax:parseFloat("{{($service->Detail() != null ? $service->Detail()->salesTax : 0)}}"),
            rd:parseFloat("{{($service->Detail() != null ? $service->Detail()->rd : 0)}}"),
            acd:parseFloat("{{($service->Detail() != null ? $service->Detail()->acd : 0)}}"),
            ast:parseFloat("{{($service->Detail() != null ? $service->Detail()->ast : 0)}}"),
            incomeTax:parseFloat("{{($service->Detail() != null ? $service->Detail()->incomeTax : 0)}}"),
            sindhExcise:parseFloat("{{($service->Detail() != null ? $service->Detail()->sindhExcise : 0)}}"),
            deliveryOrder:parseFloat("{{($service->Detail() != null ? $service->Detail()->deliveryOrder : 0)}}"),
            portRent:parseFloat("{{($service->Detail() != null ? $service->Detail()->portRent : 0)}}"),
            containerRent:parseFloat("{{($service->Detail() != null ? $service->Detail()->containerRent : 0)}}"),
            insuranceCharges:parseFloat("{{($service->Detail() != null ? $service->Detail()->insuranceCharges : 0)}}"),
            agencyCommission:parseFloat("{{($service->Detail() != null ? $service->Detail()->agencyCommission : 0)}}"),
            roadTransportCharges:parseFloat("{{($service->Detail() != null ? $service->Detail()->roadTransportCharges : 0)}}"),
            other:parseFloat("{{($service->Detail() != null ? $service->Detail()->other : 0)}}")

        }

        $scope.service.sindhExcise = 1.5;
        $scope.calculateCustomDutyAmount = () => {
          let totalPKRs = $scope.amountWithoutCustomDuty();
          let customDutyAmount = (totalPKRs*$scope.service.customDuty)/100;
          return customDutyAmount;
        }

        $scope.calculateSindhExcise = () => {
            return Math.round(($scope.amountWithoutCustomDuty() * $scope.service.sindhExcise)/100);
        }

        $scope.amountWithoutCustomDuty = () => {
            return $scope.service.customWeight*$scope.service.weightInKg*$scope.service.exchangeRate;
        }

        $scope.calculateAmountAfterExciseDuty = () => {
           return  $scope.amountWithoutCustomDuty() + $scope.calculateRd() + $scope.calulateAcd() + $scope.calculateSalesTax() + $scope.calculateAst() + $scope.calculateIncomeTax() + $scope.calculateSindhExcise();
        }



        $scope.calculateSalesTax = () => {

            let salesTax =  (($scope.amountWithoutCustomDuty() + $scope.calculateCustomDutyAmount() + $scope.calculateRd() + $scope.calulateAcd())*$scope.service.salesTax)/100;

            return Math.round(salesTax);
        }

        $scope.calculateTotalDutyAndTaxis = () => {
            return ($scope.calculateCustomDutyAmount() + $scope.calculateRd() + $scope.calulateAcd() + $scope.calculateSalesTax() + $scope.calculateAst() + $scope.calculateIncomeTax());
        }


        $scope.amountWithSalesTax = () => {
            return $scope.amountWithoutCustomDuty() + $scope.calculateSalesTax();
        }

        $scope.calculateRd = () => {
            return ($scope.amountWithoutCustomDuty() * $scope.service.rd)/100;
        }

        $scope.amountWithRd = () => {
            let amount = $scope.amountWithSalesTax() + $scope.calculateRd();
            return amount;
        }

        $scope.calulateAcd = () => {
            return ($scope.amountWithoutCustomDuty() * $scope.service.acd)/100;
        }

        $scope.amountWithAcd = () => {
            return Math.round($scope.amountWithRd() + $scope.calulateAcd());
        }

        $scope.calculateAst = () => {
            return Math.round((($scope.amountWithoutCustomDuty() + $scope.calculateCustomDutyAmount() + $scope.calculateRd() + $scope.calulateAcd()) * $scope.service.ast)/100);
        }

        $scope.amountWithAst = () => {
            return null;
        }

        $scope.calculateIncomeTax = () => {
            return Math.round((($scope.amountWithoutCustomDuty() + $scope.calculateCustomDutyAmount() + $scope.calculateRd() + $scope.calulateAcd() + $scope.calculateSalesTax() + $scope.calculateAst()) * $scope.service.incomeTax)/100);
        }

        $scope.amountWithIncomeTax = () => {
            return Math.round($scope.amountWithAst() + $scope.calculateIncomeTax());
        }




    });

    </script>
@endsection
