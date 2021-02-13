@extends("templates.public")
@section("content")
<style>
	.invoice-title h2,
	.invoice-title h3 {
		display: inline-block;
	}

	.table>tbody>tr>.no-line {
		border-top: none;
	}

	.table>thead>tr>.no-line {
		border-bottom: none;
	}


	/* Hide scrollbar for Chrome, Safari and Opera */
	.cotnainer::-webkit-scrollbar {
		display: none;
	}

	/* Hide scrollbar for IE and Edge */
	.container {
		-ms-overflow-style: none;
	}

	.steps {
		list-style-type: none;
		padding: 0;
	}

	.steps li.step {
		min-width: 143px;
	}


	a {
		color: black;
	}

	a:hover {
		text-decoration: none;
	}

	a.active {
		color: #034375;
		font-weight: bolder;
	}

	a.active:hover {
		cursor: default;
		text-decoration: none;
	}

	.steps li {
		display: inline-block;
		background-color: #f3f3f3;
		padding: 8px;
		float: left;
	}

	.steps li.stepDesign {
		background-color: white;
		background: url("{{URL::to('/public/imgs/step_li_cor.png')}}") no-repeat;
		background-size: cover;
		padding: 8px;
		width: 30px;
		height: 35px;
	}

	.formControl {
		width: 100%;
	}



	@media only screen and (max-width: 417px) {

		section {
			margin-top: 20px;
			width: 100%;
			overflow: hidden;

		}

		form {
			margin-top: 10px;
			padding: 10px 10px 20px 10px;
		}


	}

	.table {
		padding: 20px;
	}

	textarea {
		resize: none;

		overflow: scroll;
	}

	textarea {
		resize: none;

		overflow: hidden;
	}
</style>

<section>

	<h4 align="center">Secure Connection</h4>
	<ul class="steps">
		<li class="step"><a href="#" style="color:#5fbe62">Secure Connection</a></li>
		<li class="stepDesign"><a href="#"></a></li>
		<li class="step"><a href="{{URL::to('/cart')}}" style="color:black">1. Basket</a></li>
		<li class="stepDesign"><a href="#"></a></li>
		<li class="step"><a href="#" class="{{($area == 'Delivery Information' ? 'active' : '')}}">2. Delivery Information</a></li>
		<li class="stepDesign"><a href="#"></a></li>
		<li class="step"><a href="#" class="{{($area == 'payment' ? 'active' : '')}}">3. Payment</a></li>
		<li class="stepDesign"><a href="#"></a></li>
		<li class="step" style="width:153px"><a href="#" class="{{$area=='confirmOrder' ? 'active' : ''}}">4. Confirm</a></li>
	</ul>

	@if($area == 'Delivery Information')

	<h5 align="center" style="font-family:'Times New Roman', Times, serif;font-weight:bolder">Billing Address and Delivery Information</h5>
	<form method="post" style="width:100%;" action="{{URL::to('/submitinfo/deliveryInfo')}}">
		<table style="max-width:80%;margin:0 auto;margin-top:0px">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<tbody>
				<tr>
					<td style="margin-top:0px;"><b>Comapany Name</b></td>
					<td colspan="3"><input style="margin-left:10px;" type="text" name="companyName" value="{{$user->companyName}}" required="" class="formControl"></td>
				</tr>
				<tr>
					<td><b>Contact Person Name</b></td>
					<td colspan="3"><input style="margin-left:10px;margin-top:0px;" type="text" name="personName" value="{{$user->personName}}" required="" class="formControl"></td>
				</tr>
				<tr>
					<td><b>Postal Address</b></td>
					<td colspan="3"><input style="margin-left:10px;margin-top:0px;" type="text" class="formControl" value="{{$user->address}}" name="addressLine1" required></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="3"><input style="margin-left:10px;margin-top:0px;" style="margin-left:10px;" type="text" class="formControl" value="" name="addressLine2"></td>
				</tr>

				<tr>
					<td><b>City</b></td>
					<td colspan="3"><input style="margin-left:10px;margin-top:0px;" type="text" class="formControl" name="city" value="{{$user->city}}" required></td>
				</tr>


				<tr>
					<td><b>Postal Code</b></td>
					<td><input type="text" style="margin-left:10px;margin-top:0px;" name="postCode" required="" value="{{$user->postCode}}" class="formControl"></td>
				</tr>
				<tr>
					<td><b>Sales Tax Number</b></td>
					<td><input type="text" style="margin-left:10px;margin-top:0px;" name="sales_tax_num" placeholder="optional" class="formControl"></td>
				</tr>

				<tr>
					<td><b>Country</b></td>
					<td colspan="3">
						<select name="country" style="margin-top:0px;margin-left:10px;" class="formControl">
							<?php
							$countries =  DB::table("apps_countries")->get();

							?>

							@foreach($countries as $country)

							<option value="{{$country->country_code}}" {{($user->countryCode == $country->country_code ? 'selected' : '')}}>{{$country->country_name}}</option>

							@endforeach



						</select>
					</td>
				</tr>
				<tr>
					<td><b>Company Registration Number</b></td>
					<td><input type="text" style="margin-left:10px;margin-top:0px;" name="company_num" placeholder="optional" class="formControl"></td>
				</tr>
				<tr>
					<td><b>Vat Number</b></td>
					<td><input type="text" style="margin-left:10px;margin-top:0px;" name="vat_num" placeholder="optional" class="formControl"></td>
				</tr>
				<tr>
					<td><b>Order Notes</b></td>
					<td><textarea style="margin-left:10px;margin-top:0px;" class="formControl" name="order_notes" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
					</td>
				</tr>
				<tr>
					<td><b>Phone No</b></td>
					<td colspan="3">
						<input style="margin-left:10px;margin-top:0px;" type="number" required="" name="phoneNumber" value="{{$user->phoneNo}}" style="width:100%">
					</td>
				</tr>
				<tr>
					<td colspan="2" style="font-weight:bolder"><input type="checkbox" name="sameAddress">Delivery to same address </td>
				</tr>
				<tr>
					<td colspan="4" align="right">
						<input type="submit" value="Next" style="margin-left:10px;display:inline-block;padding:10px 30px;border:1px solid #ccc;color:white;background-color:maroon">
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<div style="margin-top:-20px">
		<div style="width:40%;float:left;padding-top:30px">
			<b>Delivery With</b>
			<img src="{{URL::to('/public/imgs/deliveryIcon.png')}}">
		</div>
		<div style="width:60%;float:right">
			<p align="right"><img src="{{URL::to('/public/imgs/secureIcon.png')}}" alt=""></p>
		</div>
	</div>

	@endif
	@if($area == 'payment')
	<h5 style="font-weight:bolder">Select Payment Method</h5>
	<form method="post" action="{{URL::to('/submitinfo/payment')}}">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<label><input type="radio" name="method" value="Bank Transfer"><img src="{{URL::to('public/imgs/bankTransfer.png')}}" style="max-width:100px;margin-right:50px" />Bank Transfer</label><br />
		<label><input type="radio" name="method" value="Credit Card"><img src="{{URL::to('public/imgs/debit_credit_card.png')}}" style="max-width:100px;margin-right:50px" />Debit/Credit Card</label><br />
		@if($user->countryCode == "PK")
		<label><input type="radio" name="method" value="Easy Paisa"><img src="{{URL::to('public/imgs/easy-paisa-transparent-Logo.png')}}" style="max-width:100px;margin-right:50px" />Easy Paisa</label><br />
		<label><input type="radio" name="method" value="Jazz Cash"><img src="{{URL::to('public/imgs/jazzcash.png')}}" style="max-width:100px;margin-right:50px" />Jazz Cash</label><br />
		<label><input type="radio" name="method" value="HBL Connect"><img src="{{URL::to('public/imgs/konnect.png')}}" style="max-width:100px;margin-right:50px" />Konnect By HBL</label><br />

		@endif
		<input type="submit" value="Next" style="padding:10px 30px;border:1px solid #ccc;color:white;background-color:maroon">

	</form>




	@endif
	@if($area == 'confirmOrder')
	<div class="container">
		<div class="row">
			<div class="col-xs-8 col-md-9">
				<div class="invoice-title">
					<h2>Invoice</h2>
					<h3 class="pull-right">Order # {{++$ordernum}} </h3>
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-9">
						<address>
							<strong>Billed To:</strong><br>
							<strong>Company: </strong>{{$user->companyName}}<br>
							{{$user->address}}
						</address>
					</div>
					<div class="col-xs-12">
						<address>
							<strong>Shipped To:</strong><br>
							{{$user->personName}}<br>
							{{$user->address}}<br />
							{{$user->phoneNo}}</br>
							{{$user->company_reg_no}}</br>
							{{$user->order_notes}}</br>
							{{$user->vat_no}}</br>
						</address>
						<address>
							<strong>Other Details:</strong><br>
							<span>City:</span>{{$user->city}}<br>
							<span>Sales Tax No:</span>{{$user->sales_tax_no}}<br>
							<span>Vat No:</span>{{$user->vat_no}}<br>
							<span>Company Registration No:</span>{{$user->company_reg_no}}<br>
							<span>Order Notes:</span>{{$user->order_notes}}
						</address>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<address>
							<strong>Payment Method:</strong><br>
							{{$user->paymentMode}}
						</address>
					</div>
					<div class="col-xs-6 text-right">
						<address>
							<strong>Order Date:</strong><br>
							{{date("M")}} {{date("d")}}, {{date("Y")}}<br><br>
						</address>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>Order summary</strong></h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">

							<table class="table table-condensed">
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
								<tbody>
									@php
									$subTotal = 0;

									@endphp
									<!-- foreach ($order->lineItems as $line) or some such thing here -->
									@foreach($cart as $item)
									<tr style="border-bottom:2px solid gray;">
										<td>{{$item["partNo"]}}</td>
										<td class="text-center">${{$item["partTitle"]}}</td>
										<td class="text-center">{{$item["manu"] }}</td>
										<td class="text-center">{{$item["quantity"]}}</td>
										<td class="text-center">${{$item["price"]}}</td>
										<td class="text-center">{{$item["quantity"] * $item["price"]}}</td>
										<td class="text-right">${{$item["status"]}}</td>
										@php
										$subTotal += ($item["quantity"] * $item["price"]);

										@endphp
									</tr>

									@endforeach


									<tr>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line text-center"><strong>Subtotal</strong></td>
										<td class="thick-line text-center">${{$subTotal}}</td>
									</tr>
									<tr>
										<td class="no-line"></td>
										<td class="no-line"></td>
										<td class="no-line text-center"><strong>Shipping</strong></td>
										<td class="no-line text-center">$15</td>
									</tr>
									<tr>
										<td class="no-line"></td>
										<td class="no-line"></td>
										<td class="no-line text-center"><strong>Total</strong></td>
										<td class="no-line text-center">${{$subTotal+15}}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

</section>

<a href="{{URL::to('cart')}}" style="display:inline-block;padding:10px 30px;border:1px solid #ccc;color:white;background-color:maroon">Back To Cart</a>
<a href="{{URL::to('checkout')}}" style="display:inline-block;padding:10px 30px;border:1px solid #ccc;color:white;background-color:maroon">Checkout</a>

@endif



@endsection