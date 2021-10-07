<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;
	

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';


	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru','phpmailer/language/');
	$mail-> IsSMTP(true);

	$mail->SMTPDebug = SMTP::DEBUG_SERVER;

	$mail->Host = 'smtp.gmail.com';

	$mail->Port = 465;

	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

	$mail->SMTPAuth = true;

	$mail->Username = 'orderkitchensforyou@gmail.com';

	$mail->Password = 'CFW-KSV-4Zm-zUD';

	//От кого письмо
	$mail->setFrom('orderkitchensforyou@gmail.com', 'Фрилансер по жизни');
	//Кому письмо
	$mail->addAddress('ocpp@ro.ru');
	//Тема письма
	$mail->Subject = 'Привет! Это "Фрилансер по жизни"';

	//Рука
	$hand = "Правая";
	if($_POST['hand'] == "left"){
		$hand = "Левая";
	}

	$mail->isHTML(true);
	//Тело письма
	$body = "<h1>Встречайте супер письмо!</h1><br>";

	if(trim(!empty($_POST['name']))){
		$body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
	}
	if(trim(!empty($_POST['email']))){	
		$body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
	}
	if(trim(!empty($_POST['hand']))){	
		$body.='<p><strong>Рука:</strong> '.$hand.'</p>';
	}
	if(trim(!empty($_POST['age']))){	
		$body.='<p><strong>Возраст:</strong> '.$_POST['age'].'</p>';
	}
	if(trim(!empty($_POST['message']))){	
		$body.='<p><strong>Сообщение:</strong> '.$_POST['message'].'</p>';
	}

	//Прикрепить файлы
	if (!empty($_FILES['image']['tmp_name'])) {
		$filePath = __DIR__ . "/files/" . $_FILES['image']['name'];
		if (copy($_FILES['image']['tmp_name'], $filePath)) {
			$fileAttach = $filePath;
			$body.='<p><strong>Фото в приложении</strong></p>';
			$mail->addAttachment($fileAttach);
		}
	}

	$mail->Body = $body;
	if ($mail->send()){
		$response = "Форма отправлена";
	} else {
		$response = "Что то пошло не так";
		$mail->ErrorInfo;
	}
	//exit(json_encode(array("response"=> $response)));
	//$mail->smtpClose();






	//$mail->Body = $body;
	//if (!$mail->send()){
	//	$message = 'Ошибка';
	//} else {
	//	$message = 'Данные отправлены!';
	//}

	//$response = ['message' => $message];

	//header('Content-type: application/json');
	//echo json_encode($response);
	//$mail->smtpClose();
?>