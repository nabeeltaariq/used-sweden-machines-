@extends("admin.templates.contacts")
@section("contacts_content")
<div class="container">
   <table>
    <tbody>
        <tr>
        <td>Product Can Buy</td>
        <td colspan="4">

                @foreach($buyProducts as $product)
                    <button class="btn btn-primary btn-sm" disabled>{{$product->Info()->name}}</button>
                @endforeach

        </td>

    </tr>
    <tr>
        <td>Product Can Sell</td>
        <td colspan="4">

                @foreach($sellProducts as $product)
                    <button class="btn btn-primary btn-sm" disabled>{{$product->Info()->name}}</button>
                @endforeach

        </td>

    </tr>
    <tr>
        <td>Reference Customers</td>
        <td colspan="4">
                @foreach($references as $reference)
                    <button class="btn btn-primary btn-sm" disabled>{{$reference}}</button>
                @endforeach
        </td>
    </tr>
<tr>
<td>Company Id</td>
<td><input type="text" readonly="" value="{{$contact->contactUdId}}" name="companyId" id="companyId">
<input type="hidden" name="companyIdOrigional" value=""></td>
</tr>
<tr>
<td style="min-width:100px">Company Name:</td>
<td><input type="text" size="52" id="companyName" value="{{$contact->companyName}}" name="companyName" readonly=""></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Products/Services:</td>
<td><input type="text" id="productCatagory" name="productCatagory" value="{{$contact->productService}}" readonly=""></td>

</tr>
<tr>
<td>Address:</td>
<td colspan="5">
<input type="text" size="100" value="{{$contact->address}}" id="addressline1" name="addressline1" style="display:block" readonly="">

</td>
</tr>

<tr>
<td>Country:</td>
<td><input type="text" name="country" value="{{$contact->country}}" readonly="" id="country">
City: <input type="text" name="city" value="{{$contact->city}}" readonly="" id="city">
</td>
<td>
&nbsp;&nbsp;&nbsp;Postal Code:</td><td> <input value="{{$contact->postalCode}}" type="text" name="postalCode" id="postalCode" readonly="">
</td>


</tr>
<tr>
<td>Currency:</td>
<td><input type="text" value="Renminbi" name="currency" readonly="" value="{{$contact->currency}}" id="currency">
Tel:&nbsp;&nbsp; <input type="text" value="{{$contact->telephone}}" readonly="" id="telephone" name="telephone"></td>

<td>
&nbsp;&nbsp;&nbsp;Fax: </td><td><input readonly="" value="{{$contact->fax}}" type="text" id="fax" name="fax">
</td>


</tr>
<tr>
<td>Email: </td>
<td><a style="color:blue;text-decoration:underline;margin-right:10px;" href="mailto:{{$contact->email}}">
{{(strlen($contact->email) >= 4 ? 'Send Email' : '')}}
</a>

Web: <a style="color:blue;text-decoration:underline" onclick="return processUrl(this)" href="{{$contact->web}}" target="_blank">{{(strlen($contact->web) >= 4 ? 'Visit Web Site' : '')}}</a></td>
<td>Port of Loading</td><td><input type="text" value="" name="portOfLoading" id="portOfLoading" readonly=""></td>
<td colspan="2">
@if($contact->previous() != null)
<a href="{{URL::to('admin/contacts/singleContact')}}/{{$contact->previous()->contactUdId}}" class="btn btn-primary btn-sm" title="Previous Contact"><i class="fas fa-arrow-circle-left"></i></a>
@else
<a href="" class="btn btn-primary btn-sm disabled" title="Previous Contact"><i class="fas fa-arrow-circle-left"></i></a>
@endif
@if($contact->next() != null)
<a href="{{URL::to('admin/contacts/singleContact')}}/{{$contact->next()->contactUdId}}" class="btn btn-primary btn-sm" title="Next Contact"><i class="fas fa-arrow-circle-right"></i></a>
@else

<a href="#" class="btn btn-primary btn-sm disabled" title="Next Contact"><i class="fas fa-arrow-circle-right"></i></a>

@endif
<a href="{{URL::to('/admin/contacts/edit')}}/{{$contact->contactUdId}}" class="btn btn-success btn-sm" title="Edit Contact"><i class="fas fa-user-edit"></i></a>

</td>
</tr>


</tbody></table>
<br/>
<h6>Other Importent Info or Team Members Related This Contact</h5>
<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>Designation</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Email</th>
            <th>Skype</th>
            <th>Linked In</th>
        </tr>
    </thead>
    <tbody>
        @php
           $teamMembers = App\ContactTeam::where("contactId",$contact->contactUdId)->where("contactTypeId",$contact->contactTypeId)->get();

        @endphp
        @foreach($teamMembers as $member)

            <tr>
            <td>{{$member->designation}}</td>
            <td>{{$member->teamPersonName}}</td>
            <td>{{(!empty($member->mobileNo) && $member->mobileNo != '<br>' ? $member->mobileNo : '')}}</td>
            <td><a href="mailto:{{$member->email}}" title="Send Email">{{$member->email}}</a></td>
            <td>{{$member->skype}}</td>
            <td><a href="{{$member->whatsapp}}" target="_blank">{{$member->whatsapp}}</a></td>
            </tr>

        @endforeach
    </tbody>
</table>
</div>
<style>
.btn{
    padding:0px 3px;
    font-size:12px;
}
</style>

<script>
    function processUrl(anchor){
        let url = anchor.getAttribute("href");

        if(url.indexOf("http") == 0){
            window.open(url);
        }else if(url.indexOf("https") == 0){
            window.open(url);
        }else{
            window.open("http://" + url);
        }

        return false;
    }

</script>
@endsection
