@extends("admin.templates.news")
@section("news_content")
<div class="container-fluid">
<h4>All Events</h4>
    <table id="myTable" class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Image</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)

                <tr>
                <td>{{$event->eventId}}</td>
                <td>{{$event->eventName}}</td>
                <td>{{$event->dateofevent}}</td>
                <td><img src="{{URL::to('/storage/app/event/')}}/{{$event->featuredImage}}" class="img-thumbnail" style="max-height:75px"></td>
                    <td>
                        <a href="" data-toggle="tooltip" title="View & Email" class="text-sucess"><i class="fas fa-envelope"></i></a>
                    <a href="{{URL::to('admin/news/events/edit/')}}/{{$event->eventId}}" data-toggle="tooltip" title="Edit" class="text-primary"><i class="fas fa-edit"></i></a>
                    <a href="{{URL::to('admin/news/events/remove/')}}/{{$event->eventId}}" data-toggle="tooltip" title="Remove" onclick="return confirm('are you sure you want to remove this News and all the associate data with it?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                  
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
        $('[data-toggle="tooltip"]').tooltip();
    } );
    
    </script>
@endsection