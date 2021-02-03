@extends("admin.templates.products")
@section("products_content")
<div class="container-fluid">
<h5>At this area you can see the uploaded products by the public or you can approve or reject it</h5>
<table id="myTable" class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Person Name</th>
            <th>Company</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Technical Secifications</th>
            <th>Machine Image</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)

            <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->personName}}</td>
            <td>{{$product->company}}</td>
            <td>{{$product->phone}}</td>
            <td>{{$product->email}}</td>
            <td>{{$product->technicalSpecifications}}</td>
            <td><img src="{{URL::to('/storage/app/products')}}/{{$product->featuredImage}}" style="max-height:100px" alt="image failed to load" class="img-thumbnail"></td>
            <td>
                <a href="" class="btn btn-primary btn-sm" style="padding:2px 2px">View</a>
                <a href="" class="btn btn-success btn-sm"style="padding:2px 2px">Approve</a>
                <a href="" class="btn btn-danger btn-sm"style="padding:2px 2px">Delete</a>
            </td>
            </tr>

        @endforeach
    </tbody>
</table>
</div>
@endsection
