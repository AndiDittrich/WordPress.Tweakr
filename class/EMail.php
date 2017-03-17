<?php

namespace Tweakr;

class EMail{

    // fix WordPress Mail-From Setting to avoud PHP Errors
    public static function setMailFromAddress($settingsManager){

        // get safe default values
        $name = get_bloginfo('name');

        // set from to wordpress@yourdomain.tld
        // this is always a valid value!
        $address = 'wordpress@' . $_SERVER['HTTP_HOST'];

        // manual set ?
        if (!empty($settingsManager->getOption('email-from-address'))){
            $address = $settingsManager->getOption('email-from-address');
        }

        if (!empty($settingsManager->getOption('email-from-name'))){
            $name = $settingsManager->getOption('email-from-name');
        }

        // set the from address
        add_filter('wp_mail_from', function($originalFrom) use ($address){
            return $address;
        });

        // set the name to your blog name
        add_filter('wp_mail_from_name', function($originalName) use ($name){
            return $name;
        });
    }

    // use SMTP Transport to deliver mails send with wp_mail
    public static function smtpTransport($settingsManager){

        // hook into PHPMailer initialization to set custom smtp options
        add_action('phpmailer_init', function($phpmailer) use ($settingsManager){
             
            // use smtp transport
            $phpmailer->isSMTP();

            // use smtp authentication
            $phpmailer->SMTPAuth = true;

            // use secure connection ?
            if ($settingsManager->getOption('email-smtp-ssltls') != 'none'){
                $phpmailer->SMTPSecure = $settingsManager->getOption('email-smtp-ssltls');
            }

            // set smtp hostname
            $phpmailer->Host = $settingsManager->getOption('email-smtp-host');

            // set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $port = intval($settingsManager->getOption('email-smtp-port'));
            $phpmailer->Port = ($port > 0 ? $port : 25);

            // set login credentials
            $phpmailer->Username = $settingsManager->getOption('email-smtp-username');
            $phpmailer->Password = $settingsManager->getOption('email-smtp-password');

        }, 100, 1);
    }
    
}