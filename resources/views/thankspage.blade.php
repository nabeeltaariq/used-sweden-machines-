@extends("templates.public")
@section("content")


<section style="overflow:hidden">
    <h3 align="center">Thank you for Purchasing Parts At Used Sweden Machines</h3>
    <h5 align="center">Digital Invoice has been emiled to <strong>{{$user->email}}</strong></h5>
    <h5 align="center">Order#{{$orderId}}</h5>
    <p align="center">
        <a href="{{URL::to('cart')}}" style="display:inline-block;padding:10px 30px;border:1px solid #ccc;color:white;background-color:maroon">Shopping Again</a>

    </p>
</section>


@endsection