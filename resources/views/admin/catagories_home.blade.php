@extends("admin.templates.products")
@section("products_content")
    <div class="container-fluid">
        <table id="myTable" class="table table-bordered table-hover table-sm">
            <thead>
                <tr class="bg-info">
                    <th>Order Id</th>
                    <th>Catagory Name</th>
                    <th>Status</th>
                    <th>
                        Operations
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($catagories as $catagory)

                   <tr>
                   <td>{{$catagory->order}}</td>
                   <td>{{$catagory->name}}</td>
                   <td>{{($catagory->status == 1 ? 'Active':'Disabled')}}</td>
                       <td>
                       <a href="{{URL::to('/admin/products/categories/edit')}}/{{$catagory->id}}" class="btn btn-info btn-sm">Edit</a>
                       <a href="{{URL::to('/admin/products/categories/remove')}}/{{$catagory->id}}" onclick="return confirm('are you sure you want to remove the category \n Remember That each and every product associate with this category will be lost')" class="btn btn-danger btn-sm">Delete</a>
                       </td>
                   </tr> 

                @endforeach
            </tbody>
        </table>
    </div>
    <style>
        .btn-sm{
            padding:0px 5px;
        }
    
    </style>
<script>

$(document).ready( function () {
    $('#myTable').DataTable();
} );

</script>
@endsection