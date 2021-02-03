@extends("admin.templates.contacts")
@section("contacts_content")
    <form action="" method="post">
        <input type="text" name="service" required id="service" size="30" placeholder="Quick Register Product/Service">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="submit" value="Register" class="btn btn-primary">
    </form>

    <table id="myTable" data-page-length='50' class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>Serial No. </th>
                <th>Name</th>
                <th>Description</th>
                <th>HS-Code</th>
                <th>Image</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @php
                $srNo = 1;
            @endphp
            @foreach($services as $service)

                <tr>
                <td>{{$srNo++}}</td>
                <td>{{$service->name}}</td>
                <td>{{$service->description}}</td>
                <td>
                    {{($service->Detail() != null ? $service->Detail()->hsCode : '')}}
                </td>
                <td>
                    @if($service->Detail() != null)
                    @if($service->Detail()->pictureUrl != "none")
                        <img src="{{URL::to('/storage/app/cms/')}}/{{$service->Detail()->pictureUrl}}" class="img-thumbnail" style="max-height:100px"/>
                    @endif
                    @endif
                </td>
                    <td>
                    <a href="{{URL::to('admin/contacts/services/single/')}}/{{$service->id}}" data-toggle='tooltip' title="View" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                    <a href="{{URL::to('admin/contacts/services/edit/')}}/{{$service->id}}" data-toggle='tooltip' title="Quick Edit" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
    <style>
    </style>
    <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        });
        </script>
    </script>
@endsection
