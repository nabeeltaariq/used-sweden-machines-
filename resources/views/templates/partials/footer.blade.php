<style>

  .footer-icons {
    color: white;
    margin-left: 200px;
    margin-top: 18px;
    width: 33%;
    margin-top: 11px;
  }

  .footer-icons:hover {
    color: white;
  }

  /*#desktop_footer*/
  /*        {*/
  /*        position:absolute;*/
  /*b*/
  /*        width:100%;*/
  /*      padding-top:10px !important; padding-left:auto !important; padding-right:auto !important;margin:0px;*/
  /*        }*/
  #desktop_footer {


    width: 100%;
    margin-top: 7px;
    height: 36px;
    margin-left: 0px;
    border: 3px solid #B7B4B4;
    padding: 6px 10px 10px 10px;
    display: flex;

  }

  #mobile_footer {
    display: none;
  }

  @media screen and (max-width: 1024px) {


    #social-media {
      width: 115px;
      margin-left: -50px !important;
    }

    #details {
      margin-left: -10px
    }

    .footerSocial {
      width: 115px;
    }

    #desktop_footer {
      height: 40px;
    }
  }

  @media screen and (max-width: 768px) {

    #social-media {
      width: 115px;
      margin-right: 160px !important;
      margin-top: 7px;
    }

    #details {

      margin-left: -10px;
      margin-right: 31px;

    }

    .footerSocial {
      width: 115px;
    }

    #desktop_footer {
      height: 60px;
    }
  }

  @media screen and (max-width: 765px) {
    #mobile_footer {
      display: inherit;
      margin-top: 30px !important;
    }

    #desktop_footer {
      display: none;
    }

    .footer-icons {
      margin-left: 60px !important;
      margin-top: 10px !important;
      width: 33%;
    }

    .footer-icons:nth-child(1) {
      margin-left: 45px !important;
    }

    .sticky-footer {

      bottom: 0 min-height:60px;
      max-height: 55px;
      margin-left: 0px !important;
      width: 100% !important;
      background-color: #044271;
    }
  }

  .footer {
    width: 100%;
    background-color: #044271;
    padding: 10px 10px;
    color: white;

  }

  .socialFa {
    font-size: 34px;
    color: white;
    display: inline-block;
    margin-right: 10px;
  }

  .footerButton {
    display: inline-block;
    width: 260px;
    height: 50px;
    background: linear-gradient(#FFFFFF, #d9e1ea);
    box-sizing: border-box;
    padding: 10px 8px;
    font-weight: bolder;
    font-size: 24px;
    color: #1e5b90;
    margin-top: 10px;
  }

  .helpChat {
    width: 100%;
    padding: 10px 10px;
    position: fixed;
    bottom: 55px;
    right: -15px;
    z-index: 200;
  }
</style>
<!--<div class="divider" style="width:100%;background-color:black;height:10px;"></div>-->
<div id="desktop_footer" class="panel panel-default row">

  <div class="col-lg-9 col-md-9 " id="details">
    <a style="color:red;cursor:pointer;font-size:14px;margin-left:-16px" href="https://trepak.pk">Trepak International</a>
    |
    <a href="https://www.resale.info/angebotelink-user.php?myid=40669&user=1&remote=1" style="color:#034375; font-size:12px;font-weight:bold;margin-top:3px;">USM-Resale Offers</a>
    |
    <span style="color:red;font-size:14px; ">
      Email:
    </span>
    <a href="mailto:info@usm.com.pk" style="color:#034375;font-size:12px;font-weight:bold;margin-top:3px;">info@usm.com.pk</a>
    |
    <a href="{{URL::to('upload-your-machine')}}" style="color:#034375;font-size:12px;font-weight:bold;margin-top:3px;">Upload Your Machine</a>

  </div>
  <div class="col-lg-3 col-md-3 " style="margin-left:-60px" id="social-media">
    <ul class="footerSocial" style="list-style-type: none;display: inline-block;margin-top:0px">
      <li><a href="https://www.linkedin.com/company/used-sweden-machines" target="_blank" style="background-color:#0077b5" data-toggle="tooltip" title="Linked In"><img src="{{URL::to('public/imgs/linkedin.svg')}}" style="min-width:15px;max-height:12px"></a></li>
      <li><a href="skype:AREHMANABC?call" target="_blank" data-toggle="tooltip" title="Skype" style="background-color:#6cdfea"><span class="myfa fab fa-skype"></span></a></li>
      <li><a href="https://www.facebook.com/usedswedenmachines/" target="_blank" style="background-color:#3b5998" data-toggle="tooltip" title="Facebook"><span class="fab fa-facebook-f"></span></a></li>
      <li><a href="https://twitter.com/tpusm" target="_blank" style="background-color:#6cdfea" data-toggle="tooltip" title="Twitter"><span class="fab fa-twitter"></span></a></li>
      <li>
        <a href="" style="background-color:#008000" data-toggle="tooltip" title="Message">
          <img src="{{URL::to('public/imgs/message.svg')}}" style="min-width: 15px;max-height: 12px;height: 120px;min-height: 14px; margin-top:-4px;">
        </a>
      </li>
      <li><a href="mailto:info@usedswedenmachines.com" style="background-color:red" data-toggle="tooltip" title="Email"><span class="fas fa-envelope"></span></a></li>
    </ul>
    <script>
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({
          pageLanguage: 'en',
          includedLanguages: 'ar,de,en,es,fr,ru,pt,fa',
          layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
      }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <div id="google_translate_element" style="margin-top:-4px;width:10px"></div>

  </div>


</div>


<div id="mobile_footer">
  <div class="footer">
    <h2 style="margin:0px;float:left">Contact</h2><br><br>
    <p style="float:right">
      <a href="https://www.facebook.com/Used-Sweden-Machines-1422520224715742/" target="_blank">
        <i class="fab fa-facebook-square socialFa"></i>
      </a>
      <a href="https://www.linkedin.com/in/used-sweden-machines-a9b812a1" target="_blank">
        <i class="fab fa-linkedin socialFa"></i>
      </a>
    </p>
    <br>
    <p style="font-size:16px;">
      The management team of <br>
      Used Sweden Machines
    </p>
    <p style="font-size:16px;">
      83-A, S.I.E # 1,<br>
      Gujranwala Pakistan
      <br>
      Tel.: +92 (321) 7415373
    </p>
    <p>
      <a href="tel:+92-321-741-5373" class="footerButton"><i class="fas fa-phone-square"></i> Call</a>
      <br>
      <br>
      <span style="color:red;cursor:pointer" onclick="javascript:window.open('https://trepak.pk');">Trepak International</span>
      |
      <a href="https://www.resale.info/angebotelink-user.php?myid=40669&user=1&remote=1" class="themeAnchor" style="color:white;font-weight:bold;font-size:12px"><span>USM-Resale Offers</span></a>
      <br>
      <span style="color:red">
        Email:
      </span>
      <a href="mailto:info@usm.com.pk" class="themeAnchor" style="color:white;font-weight:bold;font-size:12px">info@usm.com.pk</a>
      <br>
      <a href="{{URL::to('upload-your-machine')}}" class="themeAnchor" style="color:white;font-weight:bold;font-size:12px">Upload Your Machine</a>
    </p>
  </div>
</div>


<!--<div class="sticky-footer">-->

<!--  <a href="href="tel:+92-321-741-5373"" target="_blank" class="footer-icons" ><span class="fa fa-phone"> </span></a>-->
<!--  <a href="mailto:info@usedswedenmachines.com" target="_blank" class="footer-icons"><span class="fa fa-envelope"> </span></a>-->
<!--  <a href="https://api.whatsapp.com/send?phone=923217415373&amp;&amp;text=hello" target="_blank" class="footer-icons"><span class="fa fa-whatsapp">  </span></a>-->
<!--</div>-->