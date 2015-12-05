### local to stage
UPDATE wp_posts SET post_content = replace( post_content, 'oldvalue', 'newvalue' );
UPDATE wp_posts SET guid = replace( guid, 'oldvalue', 'newvalue' );

UPDATE wp_options SET option_value = replace( option_value, 'oldvalue', 'newvalue' ) WHERE option_name = 'siteurl';
UPDATE wp_options SET option_value = replace( option_value, 'oldvalue', 'newvalue' ) WHERE option_name = 'home';
