<?php	
	require_once("/Resources/config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>MVC4 Chargify Direct Example</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Chargify Direct PHP Example">
        <meta name="author" content="Kori Francis">

        <link href="/Content/css/bootstrap.min.css" rel="stylesheet" media="screen" />
        <style type="text/css">
              /* Custom page CSS
            -------------------------------------------------- */
              /* Not required for template or sticky footer method. */
            
            .container .credit {
                margin: 20px 0;
            }
            
              legend {
                  margin-bottom: 0px;
              }
            
              .form-horizontal .control-group {
                  margin-bottom: 5px !important;
              }
        </style>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="/Content/js/html5shiv.js"></script>
      <script src="/Content/js/respond.min.js"></script>
    <![endif]-->
    </head>

    <body>
        <div id="wrap">

            <!-- Begin page content -->
            <div class="container">
                <div class="page-header">
                    <h1>Chargify Direct PHP Example</h1>
                </div>

                <h2>Signup for Acme Projects</h2>

                <form class="form-horizontal" role="form" method="post" action="https://api.chargify.com/api/v2/signups">
                    <?php 
                        $timestamp = time();
                        $nonce = guid();
                        $apiId = $config['Chargify']['apiKey'];
                        $apiSecret = $config['Chargify']['secret'];
                        $apiSecretStr = mb_convert_encoding($config['Chargify']['secret'], 'ASCII');
                        $utf8Str = mb_convert_encoding($apiId.$timestamp.$nonce.'redirect_uri='.$config['paths']['redirectUrl'], 'ASCII');
                        echo '<p>'.$utf8Str.'</p>';
                        $hmac_sha1_str1 = base64_encode(hash_hmac("sha1", $utf8Str, $apiSecretStr));
                        echo '<p>'.$hmac_sha1_str1.'</p>';
                        $hmac_sha1_str2 = base64_encode(hash_hmac("sha1", $utf8Str, $apiSecretStr, true));
                        echo '<p>'.$hmac_sha1_str2.'</p>';
                        $hmac_sha1_str3 = base64_encode(hash_hmac("sha1", $utf8Str, $apiSecretStr, false));
                        echo '<p>'.$hmac_sha1_str3.'</p>';
                        echo '<p>'.hash_hmac('sha1', $apiId.$timestamp.$nonce.'redirect_uri='.$config['paths']['redirectUrl'], $apiSecretStr).'</p>';
                    ?>
                    <input type="hidden" name="secure[api_id]" value="<?php echo $apiId ?>" />
                    <input type="hidden" name="secure[timestamp]" value="<?php echo $timestamp ?>" />
                    <input type="hidden" name="secure[nonce]" value="<?php echo $nonce ?>" />
                    <input type="hidden" name="secure[data]" value="redirect_uri=<?php echo $config['paths']['redirectUrl']?>" />
                    <input type="hidden" name="secure[signature]" value="<?php echo base64_encode(hash_hmac('sha1', $apiId.$timestamp.$nonce.'redirect_uri='.$config['paths']['redirectUrl'], $config['Chargify']['secret'], true)) ?>" />

                    <div class="well well-sm">
                        <h4>Select Plan</h4>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Product:</label>
                            <div class="col-lg-10">
                                <label class="radio-inline">
                                    <input type="radio" name="signup[product][handle]" id="signup_product_handle_basic" value="basic" />
                                    Basic
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="signup[product][handle]" id="signup_product_handle_premium" value="premium" />
                                    Premium
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="well well-sm">
                        <h4>$1 Widgets</h4>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="signup_coupon_code">How Many Widgets?</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="signup[components][17729]" id="signup_widgets">
                                    <option value="">Please Select</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="well well-sm">
                        <h4>Coupon</h4>
                        <div id="couponGroup" class="form-group">
                            <label class="col-lg-2 control-label" for="signup_coupon_code">Coupon Code</label>
                            <div class="col-lg-10">
                                <span class="input-group-btn">
                                    <button class="btn" type="button" id="verifyCoupon">Verify!</button>
                                </span>
                                <input class="span2" type="text" name="signup[coupon_code]" id="signup_coupon_code" />
                                <span class="help-inline">Try 'awesome'</span>
                            </div>
                        </div>
                    </div>

                    <div class="well well-sm">
                        <h4>About You</h4>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="signup_customer_first_name">First Name</label>
                            <div class="col-lg-10">
                                <input type="text" name="signup[customer][first_name]" id="signup_customer_first_name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="signup_customer_last_name">Last Name</label>
                            <div class="col-lg-10">
                                <input type="text" name="signup[customer][last_name]" id="signup_customer_last_name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="signup_customer_email">Email</label>
                            <div class="col-lg-10">
                                <input type="text" name="signup[customer][email]" id="signup_customer_email" />
                            </div>
                        </div>
                    </div>

                    <div class="well well-sm">
                        <h4>Payment Profile</h4>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="signup_payment_profile_first_name">First Name on Card</label>
                            <div class="col-lg-10">
                                <input type="text" name="signup[payment_profile][first_name]" id="signup_payment_profile_first_name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="signup_payment_profile_first_name">Last Name on Card</label>
                            <div class="col-lg-10">
                                <input type="text" name="signup[payment_profile][last_name]" id="signup_payment_profile_last_name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="signup_payment_profile_card_number">Card Number</label>
                            <div class="col-lg-10">
                                <input type="text" name="signup[payment_profile][card_number]" id="signup_payment_profile_card_number" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 control-label span1">Expiration</label>
                            <div class="col-lg-10">
                &nbsp;&nbsp;&nbsp;&nbsp;
                                <select name="signup[payment_profile][expiration_month]" id="signup_payment_profile_expiration_month" style="width:75px;">
                                    <option value="1">01</option>
                                    <option value="2">02</option>
                                    <option value="3">03</option>
                                    <option value="4">04</option>
                                    <option value="5">05</option>
                                    <option value="6">06</option>
                                    <option value="7">07</option>
                                    <option value="8">08</option>
                                    <option value="9">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                <select name="signup[payment_profile][expiration_year]" id="signup_payment_profile_expiration_year" style="width:140px;">
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <p>
                        <input class="btn btn-large btn-primary" type="submit" value="Sign Up" />
                    </p>
                </form>


            </div>
        </div>

        <div id="footer">
            <div class="container">
                <p class="muted credit" style="position: relative;">
                Example courtesy <a href="http://twitter.com/djbyter" target="_blank">Kori Francis</a> based on the documentation <a href="http://docs.chargify.com/chargify-direct-introduction" target="_blank">here</a>. See <a href="https://github.com/kfrancis/ChargifyDirectSampleDotNet" target="_blank"><code>Github Repo</code></a>, 2013.
                    <iframe style="border: 0; margin: 0; padding: 0; position: absolute; top: 0px; right: 5px;" src="https://www.gittip.com/kfrancis/widget.html" width="48pt" height="22pt"></iframe>
                </p>
            </div>
        </div>

        <script src="/Content/js/jquery.js"></script>
        <script src="/Content/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('form:first').submit(function () {
                    // Magic, don't post empty values for coupon and component
                    $(this).find('input, textarea, select').each(function () {
                        if ($(this).val() === '' || $(this).val() === null)
                            $(this).attr("disabled", "disabled");
                    });
                    return true;
                });
                $("#verifyCoupon").click(function () {
                    $.ajax({
                        type: "GET",
                        url: '/Home/VerifyCoupon',
                        data: { 'couponCode': $("#signup_coupon_code").val() },
                        success: function (msg) {
                            if (msg.valid === 'true') {
                                var obj = $('#couponGroup');
                                obj.removeClass('success warning error');
                                obj.addClass('success');
                            } else {
                                var obj = $('#couponGroup');
                                obj.removeClass('success warning error');
                                obj.addClass('warning');
                            }
                        },
                        error: function () {
                            var obj = $('#couponGroup');
                            obj.removeClass('success warning error');
                            obj.addClass('error');
                        }
                    });
                    return false;
                });
            });
        </script>

    </body>
</html>
<?php 
function guid(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = substr($charid, 0, 8).$hyphen
               .substr($charid, 8, 4).$hyphen
               .substr($charid,12, 4).$hyphen
               .substr($charid,16, 4).$hyphen
               .substr($charid,20,12);
        return $uuid;
    }
}
?>