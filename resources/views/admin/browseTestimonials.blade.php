@extends("admin.templates.news")
@section("news_content")
    <h3>Browse All Testimonials</h3>
    <table class="table table-bordered table-striped table-sm" id="myTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Company Name</th>
                <th>Person Name</th>
                <th>Testimonial</th>
                <th>Person Designation</th>
                <th>Sent Date</th>
                <th>Brand Logo</th>
                <th>Operat           </tr>
        </thead>
        <tbody>
            @foreach($testimonials as $test)

                <tr>
                <td>{{$test->testimonialId}}</td>
                <td>{{$test->companyName}}</td>
                <td>{{$test->personName}}</td>
                <td>{{$test->testimonial}}</td>
                <td>{{$test->personDesignation}}</td>
                <td>{{$test->sentDate}}</td>
                <td>
                <img src="{{URL::to('/storage/app/')}}/{{$test->brandLogo}}" style="max-height:75px" class="img-thumbnail" alt="{{(!empty($test->brandLogo) ? $test->brandLogo : 'Logo not set')}}">
                </td>
                <td>
                    <a href="{{URL::to('admin/news/testimonials/edit/')}}/{{$test->testimonialId}}">Edit</a>
                <a href="{{URL::to('admin/news/testimonials/remove/')}}/{{$test->testimonialId}}"onclick="return confirm('are you sure you want to remove this testimonial?')" >Delete</a>
                </td>
                </tr>

            @endforeach
        </tbody>
    </table>
@endsection