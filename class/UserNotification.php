<?php

namespace Tweakr;

class UserNotification{

    // new user registrations
    public static function processNewRegistrations($behaviour){
        // do nothing
        if ($behaviour == 'default'){
            return;
        }

        // handle user registrations (self registered users)
        remove_action('register_new_user', 'wp_send_new_user_notifications');

        // new users added via wp-admin are created using add_user() -> edit_user() chain, NOT register_new_user()
        // @see https://developer.wordpress.org/reference/functions/add_user/
        remove_action('edit_user_created_user', 'wp_send_new_user_notifications', 10, 2);

        // notifications disabled ?
        if ($behaviour == 'none'){
            return;
        }

        // add custom callback and override the $notify setting with custom behaviour
        add_action('register_new_user', function($user_id) use ($behaviour){
            // trigger notification
            wp_new_user_notification($user_id, null, $behaviour);
        });
        add_action('edit_user_created_user', function($user_id) use ($behaviour){
            // trigger notification
            wp_new_user_notification($user_id, null, $behaviour);
        });
    }
}
