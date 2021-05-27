@extends("admin.templates.admin")
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <a href="{{URL::to('/admin/backupdb')}}" class="btn btn-primary" style="margin-top:02px"><b>Backup Database Now</b></a>
        </div>
        <div class="col-lg-6">
            <input style="margin-top:2px" type="text" name="searchBar" id="searchBar" class="form-control" placeholder="Search Anything in USM">
        </div>
    </div>
    <br />
    <div class="row" id="resultRow">
        <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="card-header"><strong>Recently Added Tetra Pak Machines<sup><a href="{{URL::to('/admin/all/products')}}">View All</a></sup></strong></div>
                <div class="card-body">
                    @php
                    $recentProducts = App\Product::where("id",">=",1)->orderBy("id","desc")->limit(2)->get();

                    @endphp
                    @foreach($recentProducts as $product)
                    <div class="media border p-3">
                        <img src="{{URL::to('/storage/app/products/')}}/{{$product->image}}" alt="John Doe" class="mr-3 mt-3" style="width:60px;">
                        <div class="media-body">
                            <h6>{{$product->pr_title}} <small><br /><i>Uploaded on {{$product->created_at}}</i></small></h6>
                            <p>
                                {{ substr($product->short_des,0,20) }}...<a href="{{URL::to('admin/products/view/')}}/{{$product->id}}">Read More</a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-5">
            <div class="card">
                <div class="card-header"><strong>Contact Categories Summary<sup><a href="{{URL::to('/admin/contacts/find')}}">View Contacts</a></sup></strong></div>
                <div class="card-body">
                    @php
                    $allContactHeads = App\ContactHead::all();

                    @endphp
                    <table id="records" class="table table-bordered table-hover">
                        @foreach($allContactHeads as $head)
                        @if($head->name != null)
                        <tr>
                            <td><a href="admin/contacts/find/{{$head->id}}">{{$head->name}}({{$head->CountContacts()}})</a></td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="card">
                <div class="card-header"></div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    $(document).ready(function() {
        $("#searchBar").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#records tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)


            });
        });
    });
    ss
</script>
@endsection