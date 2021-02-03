@extends("admin.templates.news")
@section("news_content")
    <div class="container-fluid">
        <h5>All News</h5>
        <hr>
        <table id="myTable" class="table table-bordere table-sm table-striped">
            <thead>
                <tr>
                    <th>Sr#</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $x = 1;
                @endphp
                @foreach($news as $n)

                <tr>
                <td>{{$x++}}</td>
                <th>{{$n->news_title}}</th>
                <td>{{$n->news_date}}</td>
                <td>
                <a href="{{URL::to('/news/')}}/{{$n->id}}" target="_blank" data-toggle="tooltip" title="View" class="text-sucess"><i class="fas fa-eye"></i></a>
                    <a href="{{URL::to('admin/news/edit/')}}/{{$n->id}}" data-toggle="tooltip" title="Edit" class="text-primary"><i class="fas fa-edit"></i></a>
                    <a href="{{URL::to('admin/news/remove/')}}/{{$n->id}}" data-toggle="tooltip" title="Remove Product" onclick="return confirm('are you sure you want to remove this News and all the associate data with it?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>
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