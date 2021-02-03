@extends("mobile.templates.public")
@section("content")

<ul class="mobile_products" align="right">
<li><a href="{{URL::to('/used-tetra-pak-machines')}}/?cat_id=All">All Machines ({{$totalMachines}})</a></li>
    @foreach($statistics as $stat)

        <li><a href="{{URL::to('/used-tetra-pak-machines')}}/?cat_id={{$stat['id']}}">{{$stat["name"]}} ({{$stat["totalProducts"]}})</a></li>

    @endforeach
</ul>
<style>
ul.mobile_products{
    list-style-type:none;
    margin:0;
    padding:0;

}

ul.mobile_products li{
    display:block;
}

ul.mobile_products li a{
    display: block;
    margin-bottom: 3px;
    font-size: 18px;
    font-weight: bolder;
    color: #015292;
}
</style>
<script>
    $("input[name='search']").on("keyup",function(){

        let val = $(this).val();
        $(".mobile_products li").each(function(index,listitem){

          let data = listitem.childNodes[0].innerHTML;
        
            if(data.toUpperCase().indexOf(val.toUpperCase()) >= 0){
                listitem.style.display = "block";
            }else{
                listitem.style.display = "none";
            }


        });

    });
</script>
@endsection
