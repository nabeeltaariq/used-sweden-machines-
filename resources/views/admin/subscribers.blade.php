@extends("admin.templates.contacts")
@section("contacts_content")
<h3>All Subscribers</h3>
<hr/>
<table id="myTable" class="table table-brodered table-striped table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Country</th>
            <th>Language</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 1;
        @endphp
        @foreach($subscribers as $sub)

            <tr>
            <td>{{$i++}}</td>
            <td>{{$sub->email_add}}</td>
            <td>{{$sub->country}}</td>
            <td>{{$sub->selected_language}}</td>
            <td>
            <a href="{{URL::to('/admin/contacts/subscribers/edit')}}/{{$sub->id}}" class="btn btn-primary btn-sm">Edit</a>
                <a onclick="return confirm('are you sure you want to remove?')" href="{{URL::to('/admin/contacts/deleteSubscriber/')}}/{{$sub->id}}" class="btn btn-danger btn-sm">Delete</a>
            </td>
            </tr>

        @endforeach
    </tbody>
</table>
@endsection