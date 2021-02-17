<style>
  .margin {
    margin-left: 10px;
    padding: 10px;
  }

  .bannerRow {
    background-size: cover;
    margin: 0 auto;
    margin-bottom: 4px;
  }

  .logo1 {
    position: absolute;

    position: absolute;
    right: 10px;
    height: 137px;
    width: 172px;
    top: 15px;
    /*position:absolute;*/
    /*right:0;*/
    /*height: 160px;*/
    /*width: 163px;*/
    /*top: -15px;*/
    /*margin-top: 40px;*/
    /*margin-right: 15px;*/
  }

  .logo2 {
    position: absolute;
    right: 150px;
    height: 160px;
    width: 163px;
    top: 10px;
    margin-right: 5px;

  }

  @media screen and (max-width: 415px) {
    .logo1 {
      position: absolute;
      right: 0;
      height: 65px;
      width: 65px;
      top: -15px;
      margin-top: 40px;
      margin-right: 15px;
    }

    .logo2 {
      position: absolute;
      right: 50px;
      height: 75px;
      width: 75px;
      top: -10px;
      margin-top: 60px;
      margin-right: 20px;
    }
  }

  .desktop_header {
    background-color: white;
    padding-top: 12px;
    padding-left: 12px;
    padding-right: 12;
    display: none;
  }

  .mobile_header {
    display: none;
  }

  @media screen and (min-width: 417px) {
    .desktop_header {
      display: inherit;
    }
  }

  @media screen and (max-width: 765px) {
    .desktop_header {
      display: none;
    }

    .mobile_header {
      display: inherit;
      margin-bottom: 20px;

    }

    /*.mobile-fixed*/
    /*{*/
    /*position: sticky;*/
    /*top:0;*/
    /*z-index:1;*/
    /*}*/

  }

  @media screen and (min-width: 320px) and (max-width:700px) {
    .logo1 {
      position: absolute;
      right: 0;
      height: 80px;
      width: 80px;
      top: -15px;
      margin-top: 70px;
      margin-right: 15px;
    }

    .logo2 {
      position: absolute;
      right: 50px;
      height: 85px;
      width: 85px;
      top: -10px;
      margin-top: 80px;
      margin-right: 20px;
    }

    .app-logo {
      display: none;
    }
  }

  @media screen and (max-width:1081px) {

    .app-logo {
      /*display: none;*/

      left: 285px !important;
    }
  }

  @media screen and (min-width: 700px) and (max-width:800px) {
    .app-logo {
      display: none;
    }
  }
</style>
<div class="mobile_header">
  <div class="container-fluid adjust-on-cart" style="background-color:#044271;width:100%;margin-left:0px;position:fixed;top:0;z-index:1 !important">
    <p style="margin:0px;color:white;font-weight:bolder;font-family:arial;font-size:12px" align="center">Best Supplier Of Refurbished Tetra Pak Machines</p>
  </div>
  <div class="container" style="background-color:white;padding-top:22px">
    <div style="float:left;margin-left:5px;"><img onclick="javascript:window.location='{{URL::to('/')}}';" src="{{URL::to('public/imgs/usm.svg')}}" height="90px"></div>
    <div style="float:left;font-size:12px;padding-top:0px;padding-left:20px">
      <a href="tel:+92-321-741-5373" style="color:red;line-height:2.5;font-weight:bolder;"> Call USM: </a>
      <span style=""><a href="tel:+92-321-741-5373" style="color:#0b4692;">+92-321-741-5373</a></span>
      <br>
      <span><a href="mailto:info@usm.com.pk" style="color:#0b4692;">info@usm.com.pk</a> </span><br>
      <span>
        <a href="#" target="_blank" style="color:#0b4692;">
          <img src="{{url('public/imgs/app.png')}}" style="max-height:25px;margin-top:4px;" alt="">
        </a>
      </span><br>
      <!--
      <span><a href="#" style="color:#0b4692;">e-Business</a></span> -->
    </div>
    <div style="clear:both"></div>
  </div>
</div>
<div class="desktop_header" style="margin-bottom:-10px;">
  <div style="background-color: white;padding-bottom:5px;margin-top:-5px;">
    <span style="color:red;margin-top:-5px;"><strong style="font-weight:bold;font-size:14px">Hotline: <a href="tel:+92-321-741-5373" style="color:#034375;font-weight:bold;font-size:14px">+92-321-7415373</a></strong></span>
    <div class="page-header bannerRow" style="background-image: url('https://usedswedenmachines.com/public/imgs/banner1.png');z-index:-2;border:none">
      <div class="margin logo" style="cursor:pointer;height:130px;width:180px;box-sizing:border-box;padding-top:4px">
        <a href="{{URL::to('/')}}"> <img style="margin-top:5px;" src="{{url('public/imgs/logo.png')}}" alt="logo" height="100%" width="90%"> </a>
      </div>
      <a style="cursor:pointer;"><img alt="" class="app-logo" src="{{url('public/imgs/app.png')}}" style="position: absolute;
    height: 35px;
    left: 285px;
    top: 85px;
      margin-top:15px;
      margin-left: 50px;" />

      </a>
      <img alt="" class="logo2" src="{{ url('public/imgs/2.png') }}">
      <img alt="" class="logo1" src="{{url('public/imgs/1.png')}}">
    </div>
  </div>
</div>