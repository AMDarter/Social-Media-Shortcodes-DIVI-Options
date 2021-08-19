<?php

// Instantiate the class.
add_action( 'init', function(){
    $taxPRO_Social_Media_Shortcodes = new taxPRO_Social_Media_Shortcodes();
    $taxPRO_Social_Media_Shortcodes->social_media_shortcodes_init();
});

/*
* Class responsible for creating Social Media Shortcodes.
*/
class taxPRO_Social_Media_Shortcodes{
    
    // Array of social media in the DB.
    public $et_divi_social;
    
    /*
    * Initialize.
    */
    public function social_media_shortcodes_init(){
        
        $et_divi_social = $this->get_et_divi_social();
        $this->et_divi_social = $et_divi_social;
        
        foreach( array_keys($et_divi_social) as $social_key ){
            
            add_shortcode( $social_key, array($this, 'social_shortcode'));
            
        }
        
    }
 
    /*
    * Social
    * @return string social media url.
    */    
    public function social_shortcode($atts, $content, $shortcode_tag){
        
        return $this->et_divi_social[$shortcode_tag];
        
    }  
    
    /*
    * Gets Social Media from DB.
    * @return array social media.
    */    
    public function get_et_divi_social(){
        
        // Get options.
        $et_divi = get_option('et_divi');
        
        $et_divi_social_defaults = array(
            'divi_facebook_url',
            'divi_twitter_url',
            'divi_instagram_url',
            'divi_youtube_url',
            'divi_linkedin_url'
            );
            
        // Set a default empty string if not set.    
        foreach($et_divi_social_defaults as $social_default){
            
            if( !isset($et_divi[$social_default]) ){
                
                $et_divi[$social_default] = '';
                
            }
            
        }
        
        // Update the following keys if you wish to change the shortcode names.
        // Key = shortcode name.
        // Value = URL in the DB.
        return array(
                'social_facebook_url'  => $et_divi['divi_facebook_url'],
                'social_twitter_url'   => $et_divi['divi_twitter_url'],
                'social_instagram_url' => $et_divi['divi_instagram_url'],
                'social_youtube_url'   => $et_divi['divi_youtube_url'],
                'social_linkedin_url'  => $et_divi['divi_linkedin_url'],
            );
            
    }
    
}
