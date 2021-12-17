<?php
//Niki-Sepasian 400105003

$LOL = 'سوال خود را بپرس!';
$question = '';

$en_name = 'hafez';
$fa_name = 'حافظ';

$message= file_get_contents('messages.txt');
$messages = explode(PHP_EOL,$message);

$poets = file_get_contents('people.json');
$PoetB = json_decode($poets,true);

$word='';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["question"])){
	$en_name = $_POST["person"];
    $fa_name = $PoetB[$en_name];
	$question="";
	$LOL = 'سوال خود را بپرس!';
	$word='';
	}
	
	
	else{
	$word='پرسش:';
    $en_name = $_POST["person"];
    $fa_name = $PoetB[$en_name];
	$question = $_POST["question"];
    $LOL=$messages[(intval(hash('md5', $fa_name.$question),10) % 16)];
	
	}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/default.css">
    <title>مشاوره بزرگان</title>
</head>
<body>

<p id="copyright">تهیه شده برای درس کارگاه کامپیوتر،دانشکده کامییوتر، دانشگاه صنعتی شریف</p>
<div id="wrapper">
    <div id="title">
        <span id="label"> <?php echo $word;?></span>
        <span id="question"><?php echo $question ?></span>
    </div>
    <div id="container" >
        <div id="message">
            <p><?php echo $LOL ?></p>
        </div>
        <div id="person">
            <div id="person">
                <img src="images/people/<?php echo "$en_name.jpg" ?>"/>
                <p id="person-name"><?php echo $fa_name ?></p>
            </div>
        </div>
    </div>
    <div id="new-q">
        <form method="post">
            سوال
            <input type="text" name="question" value="<?php echo $question ?>" maxlength="150" placeholder="..."/>
            را از
            <select name="person">
                <?php
                $poets = file_get_contents('people.json');
                $PoetB = json_decode($poets);
                foreach($PoetB as $key => $value){
                    if ($key == $en_name){
                       echo '<option selected value='."$key".'> '."$value".'</option>';
                    }
                    else{
                        echo '<option value='."$key".'> '."$value".'</option>';
                    }
                }
                ?>
            </select>
            <input type="submit" value="بپرس"/>
        </form>
    </div>
</div>
</body>
</html>