@extends("admin.templates.products")

@section("products_content")
<div class="container-fluid">
    <table data-order='[[ 0, "desc" ]]' id="myTable" data-page-length='100' class="table table-striped table-sm">
        <thead>
            <tr>
                <th>S#</th>
                <th>SKU</th>
                <th>Title</th>
                <th>Image</th>
                <th>Category</th>
                <th>Status</th>
                <th>Location</th>
                <th>Purchase/Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)

            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->SKU}}</td>
                <td>{{$product->pr_title}}</td>
                <td><img src="{{URL::to('/storage/app/products/')}}/{{$product->image}}" alt="" style="height:70px; width:80px;" class="img-thumbnail"></td>
                <td>
                    {{App\Catagories::find($product->cat_id)->name}}
                </td>
                <td>{{$product->s_status}}</td>
                <td>{{$product->location}}</td>
                <td>{{$product->price}}</td>
                <td>
                    <a href="{{URL::to('admin/products/view/')}}/{{$product->id}}" data-toggle="tooltip" title="View & Email" class="text-sucess"><i class="fas fa-envelope"></i></a>
                    <a href="{{URL::to('admin/products/edit/')}}/{{$product->id}}" data-toggle="tooltip" title="Edit" class="text-primary"><i class="fas fa-edit"></i></a>
                    <a href="{{URL::to('admin/products/remove/')}}/{{$product->id}}" data-toggle="tooltip" title="Remove Product" onclick="return confirm('are you sure you want to remove this product and all the associate data with it?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>


            @endforeach
        </tbody>
    </table>
</div>
<style>
    .btn-sm {
        padding: 0px 2px;
        margin-bottom: 4px;
    }

    table tr td,
    table thead tr th,
    table tbody tr td {
        text-align: center;
    }
</style>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection