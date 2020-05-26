<!doctype html>
<html>
<head>
<link rel="stylesheet" href="bootstrap.min.css">
<script src="bootstrap.min.js"></script>
<title>Spell Check</title>
<style>
.cc{
    color:red;
}
.bcc{
    background-color:black;
    color:whitesmoke;
    border-color:whitesmoke;
}
.ac{
    border:4px double whitesmoke;
}
</style>
</head>
<body>
<div class="container bcc ac">
<div class="jumbotron page-header">                     <h2 align="center"><b><mark>SPELL_CHECK</mark></b></h2>
</div>
    
        
        <div class="row">
            <div class="col-md-6 ac">

    <?php
 $spellErr="";
  $spell="";
if($_SERVER["REQUEST_METHOD"]== "POST")
{
  if(empty($_POST["spell"])){
    $spellErr="Empty";}
  
  else{
      $spell=test_input($_POST["spell"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$spell)) {
        $spellErr = "Only letters and white space allowed";
      }
  }
}
function test_input($data)
{
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

    ?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
<fieldset>
    <legend><b>SPELL CHECK</b></legend>   

<textarea name="spell" col="12" row="3"></textarea><span class="cc">* <?php echo "($spellErr)"; ?></span><br>
<?php
require "phpspellcheck/include.php";

$mySpell = new SpellCheckButton();
$mySpell->InstallationPath = "/phpspellcheck/";
$mySpell->Fields = "ALL";
echo $mySpell->SpellImageButton();


$mySpell = new SpellAsYouType();
$mySpell->InstallationPath = "/phpspellcheck/";
$mySpell->Fields = "ALL";
echo $mySpell->Activate();
?>
<input class="btn-success" type="submit" name="Submit" value="Show">

</fieldset>
</form>
</div>
<div class="col-md-6 ac">
<form>
    <fieldset>
        <legend><small><b><ins>SHOW DATA:</ins></b></small></legend>
<?php
echo(">>");
echo $spell;
?>
</fieldset>
</form>
</div>
</div>
</div>
</body>
</html>