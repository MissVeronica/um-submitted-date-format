<?php
/**
 * Plugin Name:     Ultimate Member - Submitted Date Format
 * Description:     Extension to Ultimate Member for custom formatting of dates submitted during registration in the admin notification email.
 * Version:         1.0.0
 * Requires PHP:    7.4
 * Author:          Miss Veronica
 * License:         GPL v2 or later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Author URI:      https://github.com/MissVeronica
 * Text Domain:     ultimate-member
 * Domain Path:     /languages
 * UM version:      2.8.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; 
if ( ! class_exists( 'UM' ) ) return;

Class UM_Submitted_Date_Format {

    public $custom_format = array();

    function __construct() {

        add_filter( 'um_submitted_data_value',                  array( $this, 'um_submitted_data_value_custom_dates' ), 10, 4 );
        add_filter( 'um_admin_settings_email_section_fields',   array( $this, 'um_admin_settings_email_section_fields_date_format' ), 10, 2 );
    }

    public function um_submitted_data_value_custom_dates( $v, $k, $data, $style ) {

        if ( $k != 'user_registered' && $k != 'use_gdpr_agreement' ) {

            if ( empty( $this->custom_format )) {

                $formats = UM()->options()->get( 'notification_new_user_date_format' );
                $terminator = strpos( $formats, "\n" ) ? $terminator = "\n" : $terminator = "\r";
                $formats = array_map( 'sanitize_text_field', array_map( 'trim', explode( $terminator, $formats )));

                foreach( $formats as $format ) {
                    $array = array_map( 'sanitize_text_field', array_map( 'trim', explode( ':', $format )));
                    if ( count( $array ) == 2 ) {
                        $this->custom_format[$array[0]] = $array[1];
                    }
                }
            }

            if ( array_key_exists( $k, $this->custom_format )) {

                $v = wp_date( $this->custom_format[$k], strtotime( $v ) );
            }
        }

        return $v;
    }

    public function um_admin_settings_email_section_fields_date_format( $section_fields, $email_key ) {

        if ( $email_key == 'notification_new_user' ) {

            $section_fields[] = array(
                        'id'            => $email_key . '_date_format',
                        'type'          => 'textarea',
                        'size'          => 'medium',
                        'label'         => __( 'Submitted Date Format - meta_key:Date/Time formats', 'ultimate-member' ),
                        'tooltip'       => __( 'Formatting the content of {submitted_registration} with: meta_key and PHP date format separated with colon and one format per line. Example birth_date : F j, Y', 'ultimate-member' ),
                        'conditional'   => array( $email_key . '_on', '=', 1 ),
                    );
        }

        return $section_fields;
    }

}

new UM_Submitted_Date_Format();
