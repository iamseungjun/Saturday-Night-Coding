<?php
    header('Content-Type: text/html; charset=utf-8');

	require '/home/bitnami/vendor/autoload.php';

	use Aws\Ses\SesClient;
	use Aws\Exception\AwsException;

    $conn = mysqli_connect(
        'localhost',
        'root',
        'E9LWMIZotVGX',
        'contest'
    );

    function GenerateString(){
       $characters  = "0123456789";
       $characters .= "abcdefghijklmnopqrstuvwxyz";
       $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
       $characters .= "_";

       $string_generated = "";

       $nmr_loops = 10;
       while ($nmr_loops--){
           $string_generated .= $characters[mt_rand(0, strlen($characters) - 1)];
       }

       return $string_generated;
    }

    $identy = $_POST['id'];
    $name = $_POST['name'];

    $idch = "SELECT * FROM member WHERE id='$identy'";
    $result = mysqli_query($conn, $idch);
    $row = mysqli_fetch_array($result);

    if($row <= 0){
        echo "<script>alert('아이디 또는 이름이 잘못되었습니다. 이 알림이 지속되면 관리자에게 연락해주세요.'); history.back();</script>";
    } else {
        $email = $row['email'];
        $pw = GenerateString();
        $pwresult = password_hash($pw, PASSWORD_DEFAULT);

        $sql = "UPDATE member SET pw='{$pwresult}' WHERE id='{$identy}'";
        $result = mysqli_query($conn, $sql);

		$SesClient = new SesClient([
		    'profile' => 'default',
		    'version' => '2010-12-01',
			'region'  => 'ap-southeast-2'
		]);
		$sender_email = 'smcsnc2020@gmail.com';
		$recipient_emails = [$email];
		$configuration_set = 'findpassword';
		$subject = 'Saturday-Night-Coding 임시 비밀번호 발급';
		$plaintext_body = 'Saturday-Night-Coding에서 보내는 임시 비밀번호입니다.';
        $html_body =  '<h1>Saturday-Night-Coding 임시 비밀번호 발급</h1>'.
                      '<p>안녕하세요, '.$name.'님, SNC에서 임시 비밀번호를 보내드립니다.</p>'.
                      '<p>임시 비밀번호 : '.$pw.'</p>'.
                      '<p>임시 비밀번호로 로그인한 후, 반드시 비밀번호를 변경해주세요.</p>'.
                      '<p>임시 비밀번호로 로그인이 되지 않을 경우, <a href="mailto:smcsnc2020@gmail.com">smcsnc2020@gmail.com</a> 또는 슬랙으로 연락주시기 바랍니다.</p>';
        $char_set = 'UTF-8';
	/////////////////////////////////////EMAIL START
		try {
            $result = $SesClient->sendEmail([
                'Destination' => [
                    'ToAddresses' => $recipient_emails,
                ],
                'ReplyToAddresses' => [$sender_email],
                'Source' => $sender_email,
                'Message' => [
                  'Body' => [
                      'Html' => [
                          'Charset' => $char_set,
                          'Data' => $html_body,
                      ],
                      'Text' => [
                          'Charset' => $char_set,
                          'Data' => $plaintext_body,
                      ],
                  ],
                  'Subject' => [
                      'Charset' => $char_set,
                      'Data' => $subject,
                  ],
                ],
                'ConfigurationSetName' => $configuration_set,
            ]);
            $messageId = $result['MessageId'];
?>
			<meta charset="utf-8">
    		<script type="text/javascript">alert('등록된 이메일을 확인해주세요. 임시 비밀번호가 발급되었습니다.');</script>
		    <meta http-equiv="refresh" content="0 url=login.php">
<?php
        } catch (AwsException $e) {
            //echo $e->getMessage();
            //echo("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
			echo "<script>alert('오류가 발생했습니다. 이 알림이 지속되면 관리자에게 연락해주세요.'); histori.back();</script>";
        }
    }
?>
