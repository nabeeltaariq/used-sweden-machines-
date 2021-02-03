@extends("admin.templates.products")
@section("products_content")
    <br/><br/>
    <div class="container">
        <h3>Select Stock Report Format</h3>
        <hr/>
        <form action="" method="post" target="_blank">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="radio" name="format" id="format" value="1">With Price
        <input type="radio" name="format" id="format2" value="2">Without Price
        <input type="submit" value="Generate Report" class="btn btn-primary">
        </form>
    </div>

@endsection