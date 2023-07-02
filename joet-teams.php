<?php
/*
    Plugin Name: Joet Teams
    Description: A dynamic block that displays team members.
    Version: 1.0
    Author: Theodore Mentis
    Author URI: https://www.linkedin.com/in/thmentis/
    
*/

if( !defined( 'ABSPATH' ) ) exit;

class JoetTeams{
    function __construct() {
        add_action('init', array($this, 'adminAssets'));
        add_action('wp_enqueue_scripts', array($this, 'enqueueStyles'));
    }

    function enqueueStyles(){
        wp_enqueue_style('joetTeamsStyles', plugin_dir_url(__FILE__) . 'style.css');
    }


    function adminAssets() {
        wp_register_script('joetTeamBlock', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element'));
        register_block_type('joetteams/joet-teams', array(
            'editor_script' => 'joetTeamBlock',
            'render_callback' => array($this, 'theHTML')
        ));
    }
    function theHTML($attributes){
      $team_members = new WP_Query(array(
        'post_type' => 'team',
        'posts_per_page' => -1, // Retrieves all team members
      ));

      $team_member_ids = wp_list_pluck($team_members->posts, 'ID'); // Get an array of team member IDs
      shuffle($team_member_ids); // Randomize the array of IDs
    
      $randomized_ids = array_slice($team_member_ids, 0, $attributes['teamMembers']); // Limit the array to the maximum number of members
    
      // Access the randomized IDs and return the output
      $output = '<div class="team-wrapper">';
    
    foreach ($randomized_ids as $id) {
        $team_member = get_post($id); // Retrieve the team member post object
        $title = $team_member->post_title; // Get the title of the team member
        $image = get_field('tm-profile-image', $id);
        if( !empty($image) ) {
            // Image variables.
            $imageurl = $image['url'];
        }  

        $department = get_field('tm-department', $id) ?: 'N/A';
        $email = get_field('tm-email', $id) ?: "info@example.com";
        $website = get_field('tm-website', $id) ?: "https://www.example.com";
        $parts = parse_url($website);
        $website = "<a class='ov-wsites' href='" . $website . "'>" . $parts['host'] . "</a>";

        $output .= '<div class="tm-member">';
        $output .= '<div class="tm-title">' . $title . '</div>';
        $output .= '<div class="tm-image"><img src="'. $imageurl . '" title="' . esc_attr($title) . '" /></div>';
        $output .= '<div class="tm-department">Department: ' . $department . "</div>";
        $output .= '<div class="tm-email">Email: ' . $email . "</div>";
        $output .= '<div class="tm-website">Website: ' . $website . "</div>";        
        $output .= '</div>';
    }
    $output .= '</div>';
    

      return $output;
    }
}

$joetTeams = new JoetTeams();