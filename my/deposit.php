<?php
session_start();
require '../config/dbconfig.php';
require_once '../class/class.user.php';
require_once '../class/class.money.php';
require_once '../class/class.error.php';

$user_home = new USER();
$money_home = new Money();
$error_home = new ErrorRep();
if(!$user_home->is_logged_in())
{
	$user_home->redirect('../login.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['transfer']))
{
	$sentemail = addslashes($row['userEmail']);
	$pass = addslashes($_POST['password']);
	$receemail = addslashes($_POST['email']);
	$ccash = addslashes($row['userBalance']);
	$balance = addslashes($_POST['balance']);
	$content = addslashes($_POST['content']);
	$money_home->transfercash($sentemail,$pass,$receemail,$ccash,$balance,$content);
}
?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Recharge account-PiggyBank</title>
        <?php include("../template/header.php") ?>
        
    </head>
    <body>
	<?php include("../template/menu_ac.php") ?>
	 <div class="container">
	</br></br>
    <center><h1 style="font-size: 30px; ">Recharge account</h1>
	<p style="font-weight: 400; width:50%;">Transfer money to your PiggyBank account and make a purchase, then immediately transfer money to relatives and friends.</p></center>
    </br>
 <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#bank">money transfer</a></li>
  <li><a data-toggle="tab" href="#topup">phone card</a></li>
  <li><a data-toggle="tab" href="#creditc">credit card</a></li>
  <li><a data-toggle="tab" href="#office">Directly in the office</a></li>
</ul>

<div class="tab-content">
  <div id="bank" class="tab-pane fade in active">
    <h3>money transfer</h3>
	<p style="width:50%;">We will deposit the deposit into your account via bank transfer and will not charge you. Please remit to during office hours (8h-16h)
</br>Transfer content: "The email account you want to transfer" + PiggyBank. </br>
<b>Example:</b> nguyenvanhai@abc.com PiggyBank </p>
    </br>
	<p><b>Vietnam Foreign Trade Joint-stock Commercial Bank (Vietcombank)</b></br>
	Branch: Tan Dinh-HCMC</br>
	Account number: 0371000397238</br>
	Account holder: Le Thi Nga</br>
	Swift Code: BFTVVNVX</p>
  </div>
  <div id="topup" class="tab-pane fade">
    <h3>Mobile phone scratch card/service card</h3>
    <p style="width:50%;">Use your mobile phone scratch card to recharge your account. Please note that there will be a 10% charge for charging using a mobile phone scratch card. </br>
We currently support: Viettel, Vinaphone, Mobifone, Vietnammobile, Gate. </p>
 <table class="table table-hover">
    <thead>
      <tr>
        <th>Vinaphone</th>
        <th>Mobifone</th>
        <th>Viettel</th>
		<th>Vietnammobile</th>
        <th>Gate</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>20%</td>
        <td>20%</td>
        <td>20%</td>
        <td>21%</td>
		<td>14%</td>
      </tr>
    </tbody>
  </table>
	<p style="color: #01AB4F"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Your transaction is currently protected by SSL </p>
  </div>
  <div id="creditc" class="tab-pane fade">
    <h3>credit</h3>
    <p style="width:50%;">Use a credit card to top up your account. Please note that there is a charge for using a credit card to convert foreign currency into Vietnamese Dong. </br>
We currently support: Visa, MasterCard</p>
	<p style="color: #01AB4F"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Your transaction is currently protected by SSL </p>
  </div>
  <div id="office" class="tab-pane fade">
    <h3>Directly in the office</h3>
    <p style="width:50%;">You can directly go to our office to fund your PiggyBank account. This method of remittance will not charge any fees and is extremely convenient and fast.</p>
    </br>
	<p><b>HCM City Headquarters:</ b> </br>
Address: TanQuý Ward, TanKanTuanQ427/2, TanPhu District, H'ChíMinh City. </br>
<b>Anjiang Office:</ b> </br>
Address: ChuVănAn, Ph M M Town, Ph T Tn District, An Giang Province,</p>
  </div>
</div>
</div>
 
<?php include("../template/footer_ac.php") ?>
<?php include("../template/misc.php") ?>
        
    </body>

</html>