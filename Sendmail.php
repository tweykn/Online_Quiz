<?php

$Mail = $_POST['mail'];
$Title = $_POST['title'];
$Subject = $_POST['subject'];
$Message = $_POST['message'];


   if(empty($Title) || empty($Subject) || empty($Message) || empty($Mail)) {
      echo '';
   } else {
     include 'class.phpmailer.php';
     $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 1; // Hata ayıklama değişkeni: 1 = hata ve mesaj gösterir, 2 = sadece mesaj gösterir
    $mail->SMTPAuth = true; //SMTP doğrulama olmalı ve bu değer değişmemeli
    $mail->SMTPSecure = 'tls'; // Normal bağlantı için tls , güvenli bağlantı için ssl yazın
    $mail->Host = "smtp.yandex.com"; // Mail sunucusunun adresi (IP de olabilir)
    $mail->Port = 587; // Normal bağlantı için 587, güvenli bağlantı için 465 yazın
    $mail->IsHTML(true);
    $mail->SetLanguage("tr", "phpmailer/language");
    $mail->CharSet  ="utf-8";
    $mail->Username = "destek@oguzhanferli.com"; // Gönderici adresiniz (e-posta adresiniz)
    $mail->Password = "Destek123"; // Mail adresimizin sifresi
    $mail->SetFrom("destek@oguzhanferli.com", "Antalya Bilim universitesi"); // Mail atıldığında gorulecek isim ve email
    $mail->AddAddress($Mail); // Mailin gönderileceği alıcı adres
    $mail->Subject = $Title; // Email konu başlığı
    $mail->Body = $Message; // Mailin içeriği
    if(!$mail->Send()){
    	echo "Email Gönderim Hatasi: ".$mail->ErrorInfo;
    } else {
    	echo "Email Gonderildi";
    }
   }

?>
