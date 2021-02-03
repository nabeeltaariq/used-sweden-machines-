@extends("admin.templates.products")
@section("products_content")
<div class="container">
    <br/>
    <h4>Edit Category</h4>
    <hr/>
    <form action="" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
        <label for="categoryName">
            Category Name
        <input type="text" name="categoryName" id="categoryName" class="form-control" value="{{$category->name}}">
        </label>
        <label for="status">
            Status
            <input type="radio" name="status" id="status" value="1" {{($category->status==1 ? "checked" : "")}}>Active
            <input type="radio" name="status" id="status" value="2" {{($category->status==2 ? "checked" : "")}}>In-Active
        </label>
        <label for="orderNo">
            Order No.
            <input type="number" name="orderNo" id="orderNo" class="form-control" value="<?= $category->order ?>">
            *orders can be changed from here, remember that two categories having same order will be displayed below each other
        </label>
        <input type="submit" value="Save Changes" class="btn btn-success btn-block">
    </form>
    <br/><br/>
    @if(isset($message))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> Category Saved Successfully.
      </div>

    @endif
</div>
<style>
    label{
        width:100%;
    }
</style>
@endsection