@extends("admin.templates.admin")
@section("content")
<br/>
<div class="container-fluid">
    <table id="myTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Sr#</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)

            <tr>
            <td>{{$page->id}}</td>
            <td>{{$page->page_title}}</td>
                <td>
                <a href="{{URL::to('admin/pages/edit/')}}/{{$page->id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit Content</a>
                </td>
            </tr>

            @endforeach
        </tbody>

    </table>
</div>
@endsection