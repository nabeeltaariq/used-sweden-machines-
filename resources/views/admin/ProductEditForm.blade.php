@extends("admin.templates.products")

@section("products_content")



    <div class="container-fluid">

        <br/><br/><br/><br/><br/><br/>

        <h4>Edit Product</h4>

        <hr/>

    <form action="{{URL::to('admin/products/saveChanges')}}" method="post" enctype="multipart/form-data">

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

                <input type="hidden" name="id" value="{{$product->id}}">

                <td><input type="text" name="sku" id="sku" class="" value="{{$product->SKU}}" disabled></td>

                    <td>Title</td>

                <td><input type="text" name="title" id="title" class="" placeholder="dont use special chars" value="{{$product->pr_title}}" required></td>

                    <td>Featured</td>

                    <td><input type="checkbox" name="isFeatured" id="isFeatured" class="form-check-input" {{($product->is_feature ? 'checked' : '')}}>

                        <code>*only first two featured product will display on home page</code>

                    </td>

                </tr>

                <tr>

                    <td>Category</td>

                    <td>

                        <select name="category" id="category" class="">

                            @foreach($categories as $category)



                        <option value="{{$category->id}}" {{($category->id == $product->cat_id ? 'selected':'')}}>

                                    {{$category->name}}

                                </option>



                            @endforeach

                        </select>

                    </td>

                    <td>Display Image</td>

                    <td>

                        <input type="file" name="fileToUpload" id="fileToUpload">

                    <img src="{{URL::to('/storage/app/products/')}}/{{$product->image}}" alt="" class="img-thumbnail" height="50px" width="50px"/>

                    </td>

                    <td>Gallery Images</td>

                    <td><input type="file" name="filesToUpload[]" id="filesToUpload[]" multiple></td>

                </tr>

                <tr>

                    <td>Machine Status</td>

                    <td>

                        <select name="status" id="status" class="">

                            <option value="0" {{$product->status == 0 ? 'selected':''}}>In-Active</option>

                            <option value="1" {{$product->status == 1 ? 'selected':''}}>Active</option>

                        </select>

                    </td>

                    <td>Purchase Price</td>

                    <td>

                    <input type="text" name="purchasePrice" id="purchasePrice" class="" value="{{$product->price}}" required>

                    </td>

                    <td>Sales Price</td>

                <td><input type="text" name="salesPrice" id="salesPrice" class="" value="{{$product->salesPrice}}" required></td>

                </tr>

                <tr>

                    <td>Location</td>

                <td><input type="text" name="location" id="location" class="" value="{{$product->location}}" required></td>

                    <td>Stock Status</td>

                    <td>

                        <select name="stockStatus" id="stockStatus" class="">

                            <option value="Just In" {{$product->s_status == 'Just In' ? 'selected' : ''}}>Just In</option>

                            <option value="Sold" {{$product->s_status == 'Sold' ? 'selected' : ''}}>Sold</option>

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

                <td><input type="text" name="condition" id="condition" class="" value="{{$product->machineCondition}}" required></td>

                    <td>Terms & Conditions</td>

                <td><input type="text" name="terms" id="terms" class="" value="{{$product->termsAndCondition}}" required></td>

                    <td>Delivery Time</td>

                <td><input type="text" name="deliveryTime" id="deliveryTime" class="" value="{{$product->deliveryTime}}" required></td>

                </tr>

                <tr>

                    <td>Delivery Terms</td>

                <td><input type="text" name="deliveryTerms" id="deliveryTerms" class="" value="{{$product->deliveryTerms}}" required></td>

                    <td>Payment Terms</td>

                <td><input type="text" name="paymentTerms" id="paymentTerms" class="" value="{{$product->paymentTerms}}" required></td>

                    <td>Ways of Payment</td>

                <td><input type="text" name="waysOfPayments" id="waysOfPayments" class="" value="{{$product->waysOfPayments}}" required></td>

                </tr>

                <tr>

                    <td>Short Description</td>

                    <td colspan="2">

                        <textarea name="shortDescription" id="shortDescription" class="" required>{{$product->short_des}}

                        </textarea>

                    </td>

                    <td>Meta keywords</td>

                    <td colspan="2">

                    <input type="text" name="metaKeywords" id="metaKeywords" style="width:300px" class="" value="{{$product->meta_key}}" required>

                    </td>

                    

                </tr>

                <tr>

                    <td>Long Description</td>

                    <td colspan="5">

                    <textarea name="description" id="description" required>

                        @php 

                            

                            echo html_entity_decode($product->long_des)



                        @endphp

                    </textarea>

                    </td>
                   
                </tr>

                <tr>

                <td>Meta Description</td>
                    <td>

                    <textarea name="metaDescription" id="metaDescription" class="" required>{{$product->meta_des}}</textarea>
                    
                    </td>
                    <td><input type="submit" value="Save Changes" class="btn btn-primary btn-block"></td>

                    

                    

                </tr>

            </table>

        </form>

        <hr/>

        <form method="post" action="{{URL::to('/admin/products/edit/')}}/{{$product->id}}">

            <h4 class="bg-danger" style="padding:5px 0px">Remove Previously uploaded other images</h4>

            <input type="hidden" name="_method" value="delete"/>

            <input type="hidden" name="_token" value="{{csrf_token()}}"/>

            @foreach($thumbs as $thumb)

                <label style="width:120px">

                <input type="checkbox" name="imageToDelete[]" value="{{$thumb->id}}">

                <img src="{{URL::to('/storage/app/products/')}}/{{$thumb->file_name}}" height="100px" width="100px" class="img-thumbnail">

                </label>

            @endforeach

            <input type="submit" onclick="return confirm('are you sure you want to remove?')" value="Remove Images" class="btn btn-danger btn-sm">

        </form>

    </div>
    <script>
    $("#title").alphanum();
    
</script>
@endsection