@extends("admin.templates.contacts")
@section("contacts_content")
    <div ng-app="showContactModule" ng-controller="showContactController" class="container-fluid">
    <div ng-show="contactMode">
        <table class="table table-bordered table-sm">

                <thead>
                    <tr>
                        <td colspan="2">
                            <select name="" ng-change="loadNewContacts()" ng-options="x.name for x in types" id="" class="form-control" ng-model="selectedType">

                            </select>
                        </td>
                        <td colspan="3">
                            <input type="text" ng-model="query" name="" id="" class="form-control" placeholder="Search By name, country or product/service name">
                        </td>
                        <td  align="right">

                            <a href="{{url('/admin/contacts')}}" class="btn text-white btn-primary" >
                                Back..
                            </a>
                        </td>

                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>Country</th>
                        <th>Product</th>
                        <th>Product Can Buy</th>
                        <th>Product  Can Sell</th>
                        <th>Website</th>
                    </tr>
                    <tr ng-show="loading">
                        <th colspan="5" style="text-align:center">
                            <div class="spinner-border text-success"></div>
                        </th>
                    </tr>
                </thead>
                <tbody ng-repeat="contact in contacts|filter:query">
                    <tr>
                        <td><%contact.contactUdId%></td>
                        <td><a href="{{URL::to('admin/contacts/singleContact/')}}/<%contact.contactUdId%>"><%contact.companyName%></a></td>
                        <td><%contact.country%></td>
                        <td><%contact.productService%></td>
                        <td><ul ng-repeat="buyRate in contact.buyProductRate"><li><%buyRate.rate%></li></ul></td>
                        <td><ul ng-repeat="SellRate in contact.sellProductRate"><li><%SellRate.rate%></li></ul></td>

                        <td>
                            <a href="<%contact.web%>" target="_blank" class="btn btn-primary btn-sm"><i class="fab fa-internet-explorer"></i> Visit Site</a>
                        <a href="{{URL::to('/admin/contacts/edit')}}/<%contact.contactUdId%>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Quick Edit</a>
                        </td>
                    </tr>
                </tbody>
        </table>
    </div>
    <div ng-show="!contactMode">
        <table class="table table-bordered table-hover table-sm">
            <thead>
                <tr>
                    <td colspan="6">
                        <input type="text" ng-model="query" name="" id="" class="form-control" placeholder="Search By name, country or product/service name">
                    </td>
                    <td colspan="3">
                        <select name="" ng-change="loadNewContacts()" ng-options="x.name for x in types" id="" class="form-control" ng-model="selectedType">

                        </select>
                    </td>

                </tr>
                <tr>
                    <th>Engineer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Linked In</th>
                    <th>Nationality</th>
                    <th>Date of Birth</th>
                    <th>Jobs Can Perform</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody ng-repeat="contact in contacts|filter:query">
                    <tr>
                        <td><%contact.engineerId%></td>
                        <td><a href="#"><%contact.teamPersonName%></a></td>
                        <td><%contact.email%></td>
                        <td><%contact.mobileNo%></td>
                        <td>
                            <span ng-if="contact.linkedIn.length>=4">
                                <a href="<%contact.linkedIn%>" target='_blank' class="btn btn-primary btn-sm" style="font-size:11px">Visit Profile</a>
                            </span>
                        </td>
                        <td><%contact.nationality%></td>
                        <td><%contact.dateOfBirth%></td>
                        <td><%contact.experienceMechanic%></td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm" title="View"><i class="far fa-eye"></i></a>
                            <a href="" class="btn btn-warning btn-sm" title="Quick Edit"><i class="fas fa-user-edit"></i></a>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    let showContactModule = angular.module("showContactModule",[],function($interpolateProvider){

        $interpolateProvider.startSymbol("<%");
        $interpolateProvider.endSymbol("%>");


    });
    showContactModule.controller("showContactController",function($scope,$http){

        $scope.loading = true;
        $scope.contacts = [];
        $scope.contactMode = true;
        $scope.types = [
            {id:0,name:"Aseptic Packaging Manufacturer"},
            {id:1,name:"Customer"},
            {id:2,name:"Supplier"},
            {id:3,name:"Agents"},
            {id:4,name:"Dealers"},
            {id:5,name:"Auction Company"},
            {id:6,name:"Engineer"},
            {id:7,name:"Tetra Pack Offices"},
            {id:8,name:"Trepak office & Representatives"},
            {id:9,name:"Herbal, Health & Body Care"},
            {id:10,name:"Sergical Goods Customers"},
            {id:11,name:"Whipping Cream Customers"},
            {id:12,name:"Juice Distributors"},
            {id:13,name:"Dairy Distributors"}
        ];
        $scope.selectedType = $scope.types[0];

        $http.get("{{URL::to('admin/contacts/AllContactHeads')}}")
        .then(response => {
             $scope.types = response.data;

             $scope.selectedType = $scope.types[0];

             $http.get("{{URL::to('/admin/contacts/getContacts')}}/"+$scope.selectedType.id)
            .then(response => {
                $scope.contacts = response.data;
                $scope.loading = false;
            });

        });





        $scope.loadNewContacts = function(){
            $scope.loading = true;
            $scope.contacts.splice(0,$scope.contacts.length);
            $http.get("{{URL::to('/admin/contacts/getContacts')}}/"+$scope.selectedType.id)
            .then(response => {
               if($scope.selectedType.id != 6){
                $scope.contacts = response.data;
                $scope.loading = false;
                $scope.contactMode = true;
               }else{
                $scope.contactMode = false;

                $scope.contacts = response.data;
                console.log($scope.contacts);
               }
            });
        }

    });
</script>
<style>
    table{
        font-size:12px;
    }
    .btn{
        padding: 0px 2px;
    }



</style>
@endsection
