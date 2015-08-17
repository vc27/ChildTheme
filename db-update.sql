### local to stage
UPDATE wp_posts SET post_content = replace( post_content, 'olddomain.com', 'newdomain.com' );
UPDATE wp_posts SET guid = replace( guid, 'olddomain.com', 'newdomain.com' );

UPDATE wp_options SET option_value = replace( option_value, 'olddomain.com', 'newdomain.com' ) WHERE option_name = 'siteurl';
UPDATE wp_options SET option_value = replace( option_value, 'olddomain.com', 'newdomain.com' ) WHERE option_name = 'home';
