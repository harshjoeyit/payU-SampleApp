<?php
#remove below if you have latest version of php,it will not show warnings
error_reporting(E_ERROR | E_PARSE);

include "payu/PayUClient.php";

use payu\PayUClient;

$PAYU_BASE_URL = "https://test.payu.in";
$KEY = "7rnFly";
$SALT = "pjVQAWpA";

$PAYU_BASE_URL = "https://test.payu.in";
$action = $PAYU_BASE_URL . '/_payment';

// $PAYU_SUCCESS_URL = "https://success-url.herokuapp.com/";
// $PAYU_FIALURE_URL = "https://failure-url.herokuapp.com/";
$PAYU_SUCCESS_URL = "http://localhost/payU-SampleApp/success.php";
$PAYU_FIALURE_URL = "http://localhost/payU-SampleApp/failure.php";

$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$amount = "10.00";
$firstname = $_POST['firstname'];
if ($firstname == '') {
  $firstname = 'Harshit';
}
$email = "harshjoeyit@gmail.com";
$productinfo = "Admission Fee";
$udf1 = "";
$udf2 = "";
$udf3 = "";
$udf4 = "";
$udf5 = "";

# You should set your key & salt values to the function as below:
$payuClient = new PayUClient($KEY, $SALT);

# Set params as follows
$params = array(
  "txnid" => $txnid, 
  "amount" => $amount, 
  "productinfo" => $productinfo, 
  "firstname" => $firstname, 
  "email" => $email, 
  "udf1" => $udf1, 
  "udf2" => $udf2, 
  "udf3" => $udf3, 
  "udf4" => $udf4, 
  "udf5" => $udf5
);

# you can generate payment hash as follows:
$hash = new Hasher();
$payment_hash = $hash->generate_hash($params);

?>


<html>

<head>
  <style>
    div {
      height: 200px;
      width: 400px;
      background: white;

      position: fixed;
      top: 90%;
      left: 55%;
      margin-top: -100px;
      margin-left: -200px;
      /* div {text-align: center;} */
    }

    h1 {
      text-align: center;
    }

    p {
      text-align: center;
    }
  </style>
  <script>
    function load() {
      // document.payuform.submit()
      // var payuForm = document.forms.payuForm;
      //       payuForm.submit();
      document.payuform.submit();
    }
  </script>
</head>


<body onload="load()">

  <div>
    <h1>Redirecting...</h1>
    <p>Wait while we redirect to you</p>

  </div>

  <form action="<?php echo $action; ?>" name="payuform" id="payuform" method="post">

    <input type="hidden" name="key" value="<?php echo $key ?>" />
    <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
    <input type="hidden" name="amount" value="<?php echo $amount ?>" />
    <input type="hidden" name="firstname" value="<?php echo $firstname ?>" />
    <input type="hidden" name="email" value="<?php echo $email ?>" />
    <input type="hidden" name="productinfo" value="<?php echo $productinfo ?>" />
    <input type="hidden" name="hash" value="<?php echo $payment_hash ?>" />
    <input type="hidden" name="surl" value=<?php echo $PAYU_SUCCESS_URL ?> />
    <input type="hidden" name="furl" value=<?php echo $PAYU_FIALURE_URL ?> />
    <input name="curl" input type="hidden" value="" />
    <input name="udf1" input type="hidden" value="" />
    <input name="udf2" input type="hidden" inputvalue="" />
    <input name="udf3" input type="hidden" value="" />
    <input name="udf4" input type="hidden" value="" />
    <input name="udf5" input type="hidden" value="" />

  </form>

</body>

</html>