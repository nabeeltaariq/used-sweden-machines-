@extends("admin.templates.products")
@section("products_content")
<div class="container">
    <br/>
    <h4>Add New Category</h4>
    <hr/>
    <form action="" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
        <label for="categoryName">
            Category Name
            <input type="text" name="categoryName" id="categoryName" class="form-control">
        </label>
        <label for="status">
            Status
            <input type="radio" name="status" id="status" value="1">Active
            <input type="radio" name="status" id="status" value="2">In-Active
        </label>
        <label for="orderNo">
            Order No.
            <input type="number" name="orderNo" id="orderNo" class="form-control" value="<?= $suggestedOrder ?>">
            *orders can be changed from here, remember that two categories having same order will be displayed below each other
        </label>
        <input type="submit" value="Add Category" class="btn btn-primary btn-block">
    </form>
    <br/><br/>
    @if(isset($message))

    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> New Category Recorded Successfully.
      </div>

    @endif


    
</div>
<style>
    label{
        width:100%;
    }
</style>
@endsection