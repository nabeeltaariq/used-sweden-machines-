@extends("admin.templates.products")
@section("products_content")
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">
</script>
<div class="container-fluid">
    <h5>At this area you can see the uploaded products by the public or you can approve or reject it</h5>
    <table id="myTable" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Person Name</th>
                <th>Company</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Technical Secifications</th>
                <th>Machine Image</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($products as $product)

            <tr id="{{$product->id}}">
                <td><?php echo $i ?></td>
                <td>{{$product->personName}}</td>
                <td>{{$product->company}}</td>
                <td>{{$product->phone}}</td>
                <td>{{$product->email}}</td>
                <td>{{$product->technicalSpecifications}}</td>
                <td><img src="{{URL::to('/storage/app/products')}}/{{$product->featuredImage}}" style="height:70px; width:80px" alt="image failed to load" class="img-thumbnail"></td>
                <td>
                    <a href="{{URL::to('/admin/products/uploaded-products/view/')}}/{{$product->id}}" class="btn btn-primary btn-sm" style="padding:2px 2px">View</a>
                    <a href="" class="btn btn-success btn-sm" style="padding:2px 2px">Approve</a>
                    <button onclick="deleteUploads(this)" value="{{$product->id}}" class="btn btn-danger btn-sm" style="padding:2px 2px">Delete</button>
                </td>
                <?php $i++; ?>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript">
    function deleteUploads(e) {
        let id = e.value;

        $.ajax({

            url: "deleteUploadedProducts",
            type: "GET",
            data: {
                id: id,



            },

            success: function(data) {


                if (data == "success")
                    document.getElementById(id).style.display = "none";
                else
                    swal("", " OOPS! Something went wrong... ", "error");



            }
        });

    }
</script>
@endsection