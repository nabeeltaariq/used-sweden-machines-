@extends("templates.public")
@section("content")
<style>
  .table>tbody>tr>td,
  .table>tbody>tr>th,
  .table>tfoot>tr>td,
  .table>tfoot>tr>th,
  .table>thead>tr>td,
  .table>thead>tr>th {

    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
  }

  .table {
    margin-top: 70px;


  }

  .btn {
    display: inline-block;
    border: 1px solid #ccc;
    padding: 10px;
    margin-top: 10px;
    margin-right: 10px;
  }

  .btn-continue {
    background-color: #034375;
    color: white;
  }

  .btn-continue:hover {
    background-color: #034375;
    color: white;
  }


  .btn-proceed {
    background-color: #034375;
    color: white;
  }

  .btn-proceed:hover {
    background-color: #034375;
    color: white;
  }

  .footerclass {
    position: relative;
    top: 45px;
    left: -20px;
    width: 925px;
  }
</style>
<section style="width:100%;max-height:460px;overflow:auto">


  <div style="margin-bottom:30px;
    display: flex;
    width:inherit;
    position: absolute;
    background: white;
    width: auto;z-index: 10;width: 100%">
    <span style="    margin-top: 11px;
    background: linear-gradient( 
90deg
 , #FBCA01 0%,#FBCA01 100%);
    height: 40px;
    /* padding: 20px; */
    padding-right: 10px;
    font-size: 20px;
    padding: 10px;
    border-radius: 4px; ">Your Basket</span>

    <p style="float: right;margin-left:10px;"><a href="all-spare-parts?machineId=1" class="btn btn-continue">Continue Shopping</a><a href="{{url('/auth')}}" onclick="#" style="color:white" class="btn btn-proceed">Proceed to Checkout</a></p>
  </div>


  <div style="clear:both">
  </div>
  <!-- <div style="float:right"><a href="" class="btn btn-continue">Continue Shopping</a><a href="" style="color:white" class="btn btn-proceed">Proceed to Checkout</a></div> -->

  <table class="table table-bordered table-sm">
    <thead>
      <tr>
        <th>Part No.</th>
        <th>Part Name</th>
        <th>Manufacturer</th>
        <th>Ordered Quantity</th>
        <th>Unit Price</th>
        <th>Total Price</th>
        <th>Delivery Status</th>
      </tr>
    </thead>
    <tbody id="itemsData">

      <?php

      if (!Request::session()->has("cartData")) {

        echo "<tr><td colspan='4'>Please Add Some Items to Cart First</td></tr>";
      } else {
        $total = 0;
        foreach (Request::session()->get("cartData") as $item) {
          $total=0;

      ?>

          <tr>
            <td><?= $item["partNo"] ?></td>
            <td><?php echo $item["partTitle"] ?></td>
            <td><?= $item["manu"] ?></td>
            <td align=""><span class="fa fa-minus-square leftArrow" style="cursor:pointer"></span>&nbsp;&nbsp;<span id="quantity"><?= $item["quantity"] ?></span>&nbsp;&nbsp;<span class="fa fa-plus-square rightArrow" style="cursor:pointer"></span></td>
            <td>$ <?= $item["price"] ?></td>
            <td>$ <?php echo $item["quantity"]; ?></td>
            <td style="position:relative"><?= $item["status"] ?>
              <span style="position:absolute;top:3px;right:0;color:maroon;cursor:pointer" class="fas fa-times removeButton" title="remove this item"></span>
            </td>

          </tr>


        <?php

        }

        ?>
        <tr style="border-top:2px solid black">
          <td colspan="5" align="left"><Strong>Total Order</Strong></td>
          <td align="left" colspan="2"><strong>$ <?= $total ?></strong></td>
        </tr>
      <?php

      }

      ?>

    </tbody>
  </table>

</section>


<script type="text/javascript">
  function checkCart(totalItems) {
    totalItems = parseInt(totalItems);

    if (totalItems >= 1) {
      return true;
    } else {
      return false;
    }


  }


  $(".leftArrow").on("click", function() {

    var quanitySpan = $(this).parent().parent().find("span#quantity");
    var quantity = parseInt(quanitySpan[0].innerHTML);
    if (quantity > 1) {
      quantity--;
    }
    quanitySpan[0].innerHTML = quantity;

    var unitPrice = $(this).parent().parent()[0].cells[4].innerHTML;
    unitPrice = unitPrice.split(" ");
    unitPrice = unitPrice[1];
    unitPrice = parseFloat(unitPrice);

    var totalPrice = quantity * unitPrice;
    $(this).parent().parent()[0].cells[5].innerHTML = "$ " + totalPrice;
    getTotal();
    var partName = $(this).parent().parent()[0].cells[1];

    updateCartSession(partName, quantity);

  });

  $(".rightArrow").on("click", function() {

    var quanitySpan = $(this).parent().parent().find("span#quantity");
    var quantity = parseInt(quanitySpan[0].innerHTML);
    if (quantity >= 1) {
      quantity++;
    }
    quanitySpan[0].innerHTML = quantity;

    var unitPrice = $(this).parent().parent()[0].cells[4].innerHTML;
    unitPrice = unitPrice.split(" ");
    unitPrice = unitPrice[1];
    unitPrice = parseFloat(unitPrice);

    var totalPrice = quantity * unitPrice;
    $(this).parent().parent()[0].cells[5].innerHTML = "$ " + totalPrice;
    getTotal();
    var partName = $(this).parent().parent()[0].cells[1];

    updateCartSession(partName, quantity);
  });

  function getTotal() {
    var allTrs = $("#itemsData")[0].children;
    var totalBill = 0;
    for (var i = 0; i < (allTrs.length - 1); i++) {
      var price = allTrs[i].cells[5].innerHTML.split(" ");
      price = parseFloat(price[1]);
      totalBill += price;
    }
    allTrs[allTrs.length - 1].cells[1].innerHTML = "<strong>$ " + totalBill + "</strong>";

  }

  function updateCartSession(partName, newQuantity) {
    console.clear();
    partName = partName.innerHTML;
    $.ajax({
      url: "{{URL::to('/api/updateCart')}}",
      method: "GET",
      data: {
        part: partName,
        qty: newQuantity
      },
      success: function(data) {
        console.log(data);

      }
    });
  }



  $(".removeButton").on("click", function() {


    var itemName = $(this).parent().parent()[0].cells[1].innerHTML;
    var answer = confirm("Are you sure you want to remove " + itemName + "?");
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var data = {};
    data.item = itemName;
    data._token = CSRF_TOKEN;
    if (answer == true) {
      $(this).parent().parent().remove();
      getTotal();
      $.ajax({
        url: "{{URL::to('api/item/deleteFromCart')}}",
        method: "GET",
        data: data,
        request: {
          item: itemName,
        },
        success: function(data) {

          $("#totalItems").innerHTML = data;
          window.location.reload();

        }
      });



    }


  })
</script>
@endsection