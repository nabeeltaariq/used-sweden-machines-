@extends("admin.templates.parts")
@section("parts_content")
<h3>Manage Categories&nbsp;<sup><a href="{{URL::to('admin/spareParts/categories/new')}}" class="btn btn-primary btn-sm">Add New</sup></a></h3>
    
    <table class="table table-bordered table-hover table-striped" id="myTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Machine Name</th>
                <th>Image</th>
                <th>
                    Operations
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)

                <tr>
                <td>{{$cat->id}}</td>
                <td>{{$cat->title}}</td>
                <td>
                    @php
                    $machine = App\Machine::where("id",$cat->machine_id)->first();
                    if($machine != null){
                        echo $machine->title;
                    }
                    @endphp
                </td>
                <td><img src="{{URL::to('/storage/app/products/')}}/{{$cat->image}}" style="max-height:75px" class="img-thumbnail"></td>
                    <td>
                        <a href="{{url('/admin/spareParts/categories')}}/{{$cat->id}}/edit" class="btn btn-primary btn-sm">Edit</a>
                        
                        <a href="{{url('/admin/spareParts/sub-categories')}}/{{$cat->id}}" class="btn btn-info btn-sm">Manage Sub Categories</a>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
@endsection