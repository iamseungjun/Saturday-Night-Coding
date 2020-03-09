<?php
    require 'vendor/autoload.php';
    use Aws\Ses\SesClient;
    use Aws\Exception\AwsException;

    $SesClient = new SesClient([
        'profile' => 'default',
        'version' => '2010-12-01',
        'region'  => 'ap-southeast-2'
    ]);

    function sendEmail($recv_mail, $name, $pw){
        $sender_email = 'sender@example.com';
        $recipient_emails = [$recv_mail];
        $configuration_set = 'ConfigSet';
        $subject = 'Saturday-Night-Coding 임시 비밀번호 발급';
        $plaintext_body = 'Saturday-Night-Coding에서 보내는 임시 비밀번호입니다.' ;
        $html_body =  '<h1>Saturday-Night-Coding 임시 비밀번호 발급</h1>'.
                      '<p>안녕하세요, '.$name.'님, SNC에서 임시 비밀번호를 보내드립니다.</p>'.
                      '<br>'.
                      '<p>임시 비밀번호 : '.$pw.'</p>'.
                      '<br>'.
                      '<p>임시 비밀번호로 로그인한 후, 반드시 비밀번호를 변경해주세요.</p>'.
                      '<p>임시 비밀번호로 로그인이 되지 않을 경우, <a href="mailto:smcsnc2020@gmail.com">smcsnc2020@gmail.com</a> 또는 슬랙으로 연락주시기 바랍니다.</p>';
        $char_set = 'UTF-8';
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
            //echo("Email sent! Message ID: $messageId"."\n");
            return 1;
        } catch (AwsException $e) {
            //echo $e->getMessage();
            //echo("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
            return 0;
        }
    }
?>
