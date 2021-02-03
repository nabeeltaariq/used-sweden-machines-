@extends("admin.templates.products")
@section("products_content")
    <div class="container-fluid">
        <h4>Add New Product</h4>
        <hr/>
        <form action="" method="post" enctype="multipart/form-data">
            @if(isset($message))

            <div class="alert alert-primary alert-dismissable">
                {{$message}}
            <a href="{{URL::to('admin/products')}}" class="alert-link">You can browse all products</a>
            </div>

            @endif
        <input type="hidden" name="_token" value="{{csrf_token()}}">
            <table class="">
                <tr>
                    <td>SKU</td>
                    <td><input type="text" name="sku" id="sku" class="" placeholder="Will assign automatically" disabled></td>
                    <td>Title</td>
                    <td><input type="text" name="title" id="title" class="" placeholder="dont use special char" required></td>
                    <td>Featured</td>
                    <td><input type="checkbox" name="isFeatured" id="isFeatured" class="form-check-input">
                        <code>*only first two featured product will display on home page</code>
                    </td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category" id="category" class="">
                            @foreach($categories as $category)

                        <option value="{{$category->id}}">
                                    {{$category->name}}
                                </option>

                            @endforeach
                        </select>
                    </td>
                    <td>Display Image</td>
                    <td>
                        <input type="file" name="fileToUpload" id="fileToUpload" required>
                    </td>
                    <td>Gallery Images</td>
                    <td><input type="file" name="filesToUpload[]" id="filesToUpload[]" multiple></td>
                </tr>
                <tr>
                    <td>Machine Status</td>
                    <td>
                        <select name="status" id="status" class="">
                            <option value="0">In-Active</option>
                            <option value="1" selected>Active</option>
                        </select>
                    </td>
                    <td>Purchase Price</td>
                    <td>
                        <input type="text" name="purchasePrice" id="purchasePrice" class="" required>
                    </td>
                    <td>Sales Price</td>
                    <td><input type="text" name="salesPrice" id="salesPrice" class="" required></td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td><input type="text" name="location" id="location" class="" required></td>
                    <td>Stock Status</td>
                    <td>
                        <select name="stockStatus" id="stockStatus" class="">
                            <option value="Just In">Just In</option>
                            <option value="Sold">Sold</option>
                        </select>
                    </td>
                    <td id="selectCountry" style="visibility:hidden">
                        Select Country
                    </td>
                    <td id="countries" style="visibility:hidden">

                        <select name="country" id="country" class=""></select>
                    </td>
                </tr>
                <tr>
                    <td>Machine Condition</td>
                    <td><input type="text" name="condition" id="condition" class="" required></td>
                    <td>Terms & Conditions</td>
                    <td><input type="text" name="terms" id="terms" class="" required></td>
                    <td>Delivery Time</td>
                    <td><input type="text" name="deliveryTime" id="deliveryTime" class="" required></td>
                </tr>
                <tr>
                    <td>Delivery Terms</td>
                    <td><input type="text" name="deliveryTerms" id="deliveryTerms" class="" required></td>
                    <td>Payment Terms</td>
                    <td><input type="text" name="paymentTerms" id="paymentTerms" class="" required></td>
                    <td>Ways of Payment</td>
                    <td><input type="text" name="waysOfPayments" id="waysOfPayments" class="" required></td>
                </tr>
                <tr>
                    <td>Short Description</td>
                    <td colspan="2">
                        <textarea name="shortDescription" id="shortDescription" class="" required></textarea>
                    </td>
                    <td>Meta keywords</td>
                    <td colspan="2">
                        <input type="text" name="metaKeywords" id="metaKeywords" class="" required>
                    </td>

                </tr>
                <tr>
                    <td>Long Description</td>
                    <td colspan="5">
                        <textarea style="visibility: visible;" name="description" id="description" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Meta Description</td>
                    <td colspan="3">
                        <textarea name="metaDescription" id="metaDescription" class="" required></textarea>
                    </td>
                    <td><input type="submit" value="Add Product" class="btn btn-primary btn-block"></td>
                </tr>
            </table>
        </form>
    </div>
<script>
    $("#title").alphanum();

</script>

@endsection
