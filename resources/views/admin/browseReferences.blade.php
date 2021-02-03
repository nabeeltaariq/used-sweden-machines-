@extends("admin.templates.news")
@section("news_content")
    <h3>Browse All References</h3>
    <table id="myTable" class="table table-bordered table-hover table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Delivery Scope</th>
                <th>Contact Person</th>
                <th>Project Status</th>
                <th>Reference Letter</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach($references as $reference)

                <tr>
                    <td>{{$reference->referenceId}}</td>
                    <td>{{$reference->customerName}}</td>
                    <td>{{$reference->deliveryScope}}</td>
                    <td>{{$reference->contactPerson}}</td>
                    <td>{{$reference->projectStatus}}</td>
                    <td>
                        @if($reference->referenceLetter != null)

                            <a href="{{URL::to('/storage/app/')}}/{{$reference->referenceLetter}}" download>Download</a>

                        @endif
                    </td>
                <td>
                    <a href="{{URL::to('/admin/news/references/edit/')}}/{{$reference->referenceId}}">Edit</a>
                    <a href="{{URL::to('/admin/news/references/delete/')}}/{{$reference->referenceId}}" onclick="return confirm('are you sure you want to remove?')">Delete</a>
                </td>
                </tr>

            @endforeach
        </tbody>
    </table>
@endsection