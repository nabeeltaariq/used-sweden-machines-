@extends("admin.templates.parts")
@section("parts_content")
<h3>Manage Sub-Categories&nbsp;<sup><a href="{{URL::to('admin/spareParts/sub-categories/add/new')}}" class="btn btn-primary btn-sm">Add New</sup></a></h3>
    
    <table class="table table-bordered table-hover table-striped" id="myTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sub-Category Name</th>
                <th>Machine Name</th>
                <th>Parent Category</th>
                <th>
                    Operations
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($subCats as $cat)

                <tr>
                <td>{{$cat->id}}</td>
                <td>{{$cat->title}}</td>
                <td>{{(App\Machine::find($cat->machine_id))->title}}</td>
                <td>{{(App\PartCatagory::find($cat->parent_id))->title}}</td>
                    <td>
                        <a href="{{url('/admin/spareParts/sub-categories')}}/{{$cat->id}}/edit" class="btn btn-primary btn-sm">Edit</a>
                        
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
@endsection