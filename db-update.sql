### local to stage
UPDATE wp_posts SET post_content = replace( post_content, 'http://ishinelive.com', 'http://ishinelive.loc.metacakehq.com' );
UPDATE wp_posts SET guid = replace( guid, 'http://ishinelive.com', 'http://ishinelive.loc.metacakehq.com' );

UPDATE wp_options SET option_value = replace( option_value, 'http://ishinelive.com', 'http://ishinelive.loc.metacakehq.com' ) WHERE option_name = 'siteurl';
UPDATE wp_options SET option_value = replace( option_value, 'http://ishinelive.com', 'http://ishinelive.loc.metacakehq.com' ) WHERE option_name = 'home';
