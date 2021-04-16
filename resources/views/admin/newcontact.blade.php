@extends("admin.templates.contacts")
@section("contacts_content")

<div ng-app="contactModule" ng-controller="contactController">Select any Contact Type
    <select ng-options="item as item.name for item in types track by item.id" ng-change="fetchTypeInfo()" ng-model="selectedType"></select>
    <div class="spinner-border text-muted" ng-show="loading"></div>
    <br /><br />
    <div ng-show="showForm">
        <table>
            <tbody>

                <tr>
                    <td>Company Id</td>
                    <td><input type="number" disabled="" ng-model="contact.contactUdId" name="companyId" id="companyId">
                        <input type="hidden" id="companyIdOrigional" name="companyIdOrigional" value="65">
                    </td>
                </tr>

                <tr>
                    <td>Product Can Buy</td>
                    <td>
                        <select ng-model="selectedByProduct" ng-change="updateBuyProducts()" ng-options="item as item.name for item in services track by item.id"></select>
                    </td>
                    <td colspan="4">

                        <div class="dropdown" ng-repeat="product in contact.buyProducts" style="display:inline-block;margin-right:10px;margin-bottom:2px">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                <%product.name%>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" ng-click="editRate(product)" href="#" class="text-primary">Edit
                                    Rate</a>
                                <a class="dropdown-item" ng-click="removeProduct(product,'buy')" href="#" class="text-danger">Remove</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Product Can Sell</td>
                    <td>
                        <select ng-model="selectedSellProduct" ng-change="updatedSellProducts()" ng-options="item as item.name for item in services track by item.id"></select>
                    </td>
                    <td colspan="4">

                        <div class="dropdown" ng-repeat="product in contact.sellProducts" style="display:inline-block;margin-right:10px;margin-bottom:2px">
                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                <%product.name%>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" ng-click="editRate(product)" href="#" class="text-primary">Edit
                                    Rate</a>
                                <a class="dropdown-item" ng-click="removeProduct(product,'sell')" href="#" class="text-danger">Remove</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Reference Customers</td>
                    <td>
                        <form ng-submit="saveReferenceCustomer()">
                            <input type="text" style="width:100%" ng-model="customer" />
                            <input type="submit" value="Save" style="display:none">
                        </form>
                    </td>
                    <td colspan="4">
                        <span class="badge badge-info" style="cursor:pointer" ng-click="removeCustomer(customer)" ng-repeat="customer in contact.referenceCustomers"><%customer%></span>
                    </td>
                </tr>

                <tr>
                    <!-- productCatagory -->
                    <td style="min-width:100px">Company Name:</td>
                    <td><input type="text" size="52" id="companyName" ng-model="contact.companyName"></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Products/Services:</td>
                    <td>
                        <select ng-model="selectedService" ng-change="getSelectedService()" ng-options="item as item.name for item in services track by item.id"></select>
                    </td>
                    <input type="hidden" name="contactType" value="0">
                </tr>
                <tr>
                    <td>Address:</td>
                    <td colspan="5">
                        <input type="text" size="100" id="addressline1" ng-model="contact.addressline1" style="display:block">

                    </td>
                </tr>
                <tr>

                </tr>
                <tr>
                    <td>Country:</td>
                    <td><input type="text" ng-model="contact.country" id="country">
                        City: <input type="text" ng-model="contact.city" name="city" id="city">
                    </td>
                    <td>
                        &nbsp;&nbsp;&nbsp;Postal Code:
                    </td>
                    <td><input type="text" ng-model="contact.postalCode" id="postalCode">
                    </td>


                </tr>
                <tr>
                    <td>Currency:</td>
                    <td><input type="text" ng-model="contact.currency" id="currency">
                        Tel:&nbsp;&nbsp; <input type="text" id="telephone" ng-model="contact.telephone"></td>

                    <td>
                        &nbsp;&nbsp;&nbsp;Fax:
                    </td>
                    <td><input type="text" id="fax" ng-model="contact.fax">
                    </td>


                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" ng-model="contact.email" id="email">
                        Web: <input type="text" id="website" ng-model="contact.web" size="19"></td>

                    <td>Port of Loading</td>
                    <td><input type="text" ng-model="contact.portOfLoading" id="portOfLoading"></td>
                    <td align="right">
                        <span id="dataToggle" ng-show="!isSave"><input type="button" value="Register" class="btn btn-primary btn-sm" ng-click="saveCompany()" id="submitButton"></span>
                        <button class="btn btn-primary" ng-show="isSave">
                            <span class="spinner-border spinner-border-sm"></span>
                            Saving..
                        </button>
                    </td>
                </tr>


            </tbody>
        </table>
        <br /><br />
        <table border="1" style="border-collapse:collapse;min-width:750px" cellpadding="3">
            <tbody>
                <tr>
                    <th>Designation</th>
                    <th>Name</th>
                    <th>Mobile No</th>
                    <th>Email</th>
                    <th>Skype</th>
                    <th>Linked In</th>
                    <th style="width:12px">Edit/Delete</th>
                    <th style="width:12px">Insert</th>
                </tr>
            </tbody>
            <tbody id="data">
            </tbody>
            <tbody>
                <tr>
                    <td>
                        <select name="designation" id="designation" ng-options="designation as designation.name for designation in designations track by designation.designationId" ng-model="teamPerson.selectedDesignation">


                        </select>
                    </td>
                    <td id="whatsAppEdit">
                        <input type="text" ng-model="teamPerson.name" style="max-width:100px">
                    </td>
                    <td id="mobilNumberEdit">
                        <input type="text" ng-model="teamPerson.mobileNo" style="max-width:100px">
                    </td>
                    <td id="emailEdit">
                        <input type="text" ng-model="teamPerson.email" style="max-width:100px">
                    </td>
                    <td id="skypeEdit">
                        <input type="text" ng-model="teamPerson.skype" style="max-width:100px">
                    </td>
                    <td id="whatsAppEdit">
                        <input type="text" ng-model="teamPerson.linkedIn" style="max-width:100px">
                    </td>
                    <td></td>
                    <td><a href="#" ng-click="saveTeamPerson()" id="insertButton" style="color:blue;text-decoration:underline;width:12px">Insert</a></td>
                </tr>
                <tr ng-repeat="person in contact.team">
                    <td><%person.selectedDesignation.name%></td>
                    <td><%person.name%></td>
                    <td><%person.mobileNo%></td>
                    <td><%person.email%></td>
                    <td><%person.skype%></td>
                    <td><%person.linkedIn%></td>
                    <td>
                        <a href="" ng-click="editTeamMember(person)">Edit</a>
                        <a href="" ng-click="removeTeamMember(person)">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('script')
<script>
    let contactModule = angular.module("contactModule", [], function($interpolateProvider) {

        $interpolateProvider.startSymbol("<%");
        $interpolateProvider.endSymbol("%>");

    });

    contactModule.controller("contactController", function($scope, $http) {
        $scope.showForm = false;
        $scope.isSave = false;
        $scope.loading = false;
        $scope.canByProducts = [];
        $scope.canSellProducts = [];
        $scope.selectedByProduct = {};
        $scope.selectedSellProduct = {};
        $scope.types = [{
            id: -1,
            name: "Select Contact Type"
        }];
        $scope.selectedType = $scope.types[0];
        $scope.services = [];
        $scope.designations = [];
        $scope.teamPerson = {
            name: "",
            mobileNo: "",
            email: "",
            skype: "",
            linkedIn: "",
            selectedDesignation: {}
        }

        $scope.contact = {
            contactUdId: 0,
            companyName: "",
            addressline1: "",
            country: "",
            postalCode: "",
            currency: "",
            web: "",
            city: "",
            email: "",
            telephone: "",
            fax: "",
            portOfLoading: "",
            contactTypeId: -1,
            team: [],
            buyProducts: [],
            sellProducts: [],
            referenceCustomers: [],
            selectedService: null
        }

        $http({
            url: "{{URL::to('/api/getContactType')}}",
            method: "GET"
        }).then(response => {
            response.data.map(head => {
                $scope.types.push(head);
            });

        });

        $http({
            method: "GET",
            url: "{{URL::to('/api/getservices')}}"
        }).then(response => {
            $scope.services = response.data;
            $scope.canByProducts = response.data;
            $scope.canSellProducts = response.data;
        });

        $http({
            method: "GET",
            url: "{{URL::to('/api/allDesignations')}}"
        }).then(response => {
            $scope.designations = response.data;
        });

        $scope.saveCompany = function() {
            if ($scope.contact.companyName.length >= 4 && $scope.contact.selectedService != null) {
                $scope.isSave = true;
                $scope.contact.type = $scope.selectedType.id;
                $http({
                    url: "{{URL::to('api/saveCompany')}}",
                    method: "POST",
                    data: $scope.contact
                }).then(response => {

                    $scope.isSave = false;
                    let newUdId = parseInt($scope.contact.contactUdId) + 1;
                    $scope.contact = {
                        contactUdId: newUdId,
                        companyName: "",
                        addressline1: "",
                        country: "",
                        postalCode: "",
                        currency: "",
                        web: "",
                        city: "",
                        email: "",
                        telephone: "",
                        fax: "",
                        portOfLoading: "",
                        contactTypeId: -1,
                        team: [],
                        buyProducts: [],
                        sellProducts: [],
                        referenceCustomers: '',
                        selectedService: null
                    }

                    console.log($scope.contact);


                })


            } else {
                alert("Company Name must be filled and Product/Service Must be selected");
            }
        }

        $scope.getSelectedService = function() {
            $scope.contact.selectedService = $scope.selectedService;
        }


        $scope.updateBuyProducts = function() {

            $scope.contact.buyProducts.push({
                ...$scope.selectedByProduct,
                rate: ''
            });
            $scope.selectedByProduct = {};

        }

        $scope.updatedSellProducts = function() {
            $scope.contact.sellProducts.push({
                ...$scope.selectedSellProduct,
                rate: ''
            });
            $scope.selectedSellProduct = {};
        }

        $scope.saveTeamPerson = function() {
            if ($scope.teamPerson != undefined) {
                $scope.contact.team.push($scope.teamPerson);
                $scope.teamPerson = {};
            }
        }


        $scope.editRate = function(product) {
            product.rate = prompt("Please enter product rate");
        }


        $scope.removeProduct = function(product, mode) {
            if (mode == 'buy') {
                $scope.contact.buyProducts = $scope.contact.buyProducts.filter(p => p.id != product.id);
            } else {
                $scope.contact.sellProducts = $scope.contact.sellProducts.filter(p => p.id != product.id);
            }
        }

        $scope.saveReferenceCustomer = function() {
            if ($scope.customer.length >= 3) {
                $scope.contact.referenceCustomers.push($scope.customer.slice());
                $scope.customer = "";
            }
        }


        $scope.removeTeamMember = person => {
            $scope.contact.team = $scope.contact.team.filter(p => p.name != person.name);
        }

        $scope.removeCustomer = function(customer) {
            $scope.contact.referenceCustomers = $scope.contact.referenceCustomers.filter(c => c != customer);
        }

        $scope.editTeamMember = person => {
            $scope.teamPerson = {
                ...person
            };
            $scope.contact.team = $scope.contact.team.filter(p => p.name != person.name);
        }

        $scope.fetchTypeInfo = function() {
            $scope.showForm = false;
            $scope.loading = true;
            $scope.contact.contactTypeId = $scope.selectedType.id;

            if ($scope.selectedType.id != -1) {
                $http({
                    url: "{{URL::to('/api/GETContactNewId')}}",
                    method: "POST",
                    data: $scope.selectedType
                }).then(response => {
                    $scope.contact.contactUdId = response.data.newId;
                    $scope.showForm = true;
                    $scope.loading = false;
                });
            }
        }

    });
</script>

@stop