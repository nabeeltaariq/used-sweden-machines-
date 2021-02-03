@extends("admin.templates.parts")
@section("parts_content")
<h3>Browse Machines&nbsp;<sup><a href="{{URL::to('admin/spareParts/machines/new')}}" class="btn btn-primary btn-sm">Add New</sup></a></h3>

<table id="myTable" class="table table-bordered table-hover table-striped table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Machine Name</th>
            <th>Image</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($machines as $machine)

        <tr>
            <th>{{$machine->id}}</th>
            <th>{{$machine->title}}</th>
            <th><img src="{{URL::to('/storage/app/products/')}}/{{$machine->image}}" alt="" style="max-width:150px" class="img-thumbnail"></th>
            <th>
                <a href="spareParts/machines/{{$machine->id}}/edit">Edit</a>

            </th>
        </tr>

        @endforeach
    </tbody>
</table>
@endsection