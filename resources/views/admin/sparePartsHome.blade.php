@extends("admin.templates.parts")
@section("parts_content")
<h3>Manage All Spare Parts&nbsp;<sup><a href="{{ url('/admin/spareParts/new') }}" class="btn btn-primary">Add New</a></sup></h3>
<h3>Import Machines Data&nbsp;<sup><a href="{{URL::to('admin/spareParts/import/data')}}" class="btn btn-primary btn-sm">Import Machines Data</sup></a></h3>
<table class="table table-bordere table-hover table-striped table-sm" id="myTable">
    <thead>
        <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Name</th>
            <th>Machine</th>
            <th>Price</th>
            <th>Delivery Status</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($parts as $part)
        <tr>
            <td>{{$part->id}}</td>
            <td><img src="{{URL::to('/storage/app/products/')}}/{{$part->image}}" style="max-height:75px" class="img-thumbnail" alt="Not Available"></td>
            <td>{{$part->title}}</td>
            <td>@php
                $test = (App\Machine::find($part->machine_id));
                if($test != null){
                echo $test->title;
                }
                @endphp
            </td>
            <td>{{$part->price}}$</td>
            <td>{{$part->ds}}</td>
            <td>

                <a href="{{ url('/admin/spareParts') }}/{{$part->id}}/edit" class="btn btn-primary btn-sm">Edit</a>
                <a href="{{ url('/admin/spareParts') }}/{{$part->id}}/delete" onclick="return confirm('Are you sure, you want to delete {{$part->title}}?')" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection