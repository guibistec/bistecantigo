<?php
/**
 * ReduxFramework Config File
 * For full documentation, please visit: https://docs.reduxframework.com
 */

if ( !class_exists( 'Redux_Framework' ) ) {

    class Redux_Framework {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }

            }

            public function initSettings() {

                // Just for demo purposes. Not needed per say.
                $this->theme = wp_get_theme();

                // Set the default arguments
                $this->setArguments();

                // Set a few help tabs so you can see how it's done
                $this->setHelpTabs();

                // Create the sections and fields
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }

                // If Redux is running as a plugin, this will remove the demo notice and links
                //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

                // Function to test the compiler hook and demo CSS output.
                // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
                add_filter( 'redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

                // Change the arguments after they've been declared, but before the panel is created
                //add_filter( 'redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

                // Change the default value of a field after it's been set, but before it's been useds
                //add_filter( 'redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

                // Dynamically add a section. Can be also used to modify sections/fields
                //add_filter( 'redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section' ));

                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }

            /**
             * This is a test function that will let you see when the compiler hook occurs.
             * It only runs if a field    set with compiler=>true is changed.
             * */
            function compiler_action( $options, $css, $changed_values ) {
                echo '<h1>The compiler hook has run!</h1>';
                echo "<pre>";
                print_r( $changed_values ); // Values that have changed since the last save
                echo "</pre>";
                //print_r($options); //Option values
                //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

                /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
            }

            /**
             * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
             * Simply include this function in the child themes functions.php file.
             * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
             * so you must use get_template_directory_uri() if you want to use any of the built in icons
             * */
            function dynamic_section( $sections ) {
                //$sections = array();
                $sections[] = array(
                    'title'  => __( 'Section via hook', MOKAINE_THEME_NAME ),
                    'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', MOKAINE_THEME_NAME ),
                    'icon'   => 'el-icon-paper-clip',
                    // Leave this as a blank section, no options just some intro text set above.
                    'fields' => array()
                );

                return $sections;
            }

            /**
             * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
             * */
            function change_arguments( $args ) {
                //$args['dev_mode'] = true;

                return $args;
            }

            /**
             * Filter hook for filtering the default value of any given field. Very useful in development mode.
             * */
            function change_defaults( $defaults ) {
                $defaults['str_replace'] = 'Testing filter hook!';

                return $defaults;
            }

            // Remove the demo link and the notice of integrated demo from the redux-framework plugin
            function remove_demo() {

                // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    remove_filter( 'plugin_row_meta', array(
                        ReduxFrameworkPlugin::instance(),
                        'plugin_metalinks'
                    ), null, 2 );

                    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
                }
            }

            public function setSections() {

                /**
                 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
                 * */
                // Background Patterns Reader
                $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
                $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :

                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();

                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;

                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', MOKAINE_THEME_NAME ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo $this->theme->display( 'Name' ); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( __( 'By %s', MOKAINE_THEME_NAME ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( __( 'Version %s', MOKAINE_THEME_NAME ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . __( 'Tags', MOKAINE_THEME_NAME ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <p class="theme-description"><?php echo $this->theme->display( 'Description' ); ?></p>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', MOKAINE_THEME_NAME ), $this->theme->parent()->display( 'Name' ) );
                            }
                        ?>

                    </div>
                </div>

                <?php
                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';
                if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
                    Redux_Functions::initWpFilesystem();

                    global $wp_filesystem;

                    $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
                }

                // ACTUAL DECLARATION OF SECTIONS
                $this->sections[] = array(
                    'icon'   => 'dashicons-before dashicons-admin-home',
                    'title'  => __( 'General settings', MOKAINE_THEME_NAME ),
                    'fields' => array(
                        array(
                            'id' => 'custom-favicon',
                            'type' => 'media',
                            'title' => __( 'Custom favicon', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Upload a 16px x 16px Png/Gif image that will represent your website favicon', MOKAINE_THEME_NAME )
                        ),
                        array(
                            'id' => 'dribbble-token',
                            'type' => 'text',
                            'title' => __( 'Dribbble token', MOKAINE_THEME_NAME ), 
                            'subtitle' => sprintf( wp_kses( __( 'Set your Dribbble app&lsquo;s client access token if you wish to use the Dribbble shortcode. If you do not have a token, <a href="%1$s" target="_blank">create a new Dribbble app</a>. Read the documentation for further details.', MOKAINE_THEME_NAME ), array( 'a' => array( 'href' => array() ) ) ), esc_url( "https://dribbble.com/account/applications/new" ) )
                        ),
                        array(
                            'id' => 'google-maps-api-key',
                            'type' => 'text',
                            'title' => __( 'Google Maps API key', MOKAINE_THEME_NAME ), 
                            'subtitle' => sprintf( wp_kses( __( 'Google Maps may not work without an API key. <a href="%1$s" target="_blank">Get your key</a> and paste it here.', MOKAINE_THEME_NAME ), array( 'a' => array( 'href' => array() ) ) ), esc_url( "https://developers.google.com/maps/documentation/javascript/get-api-key" ) )
                        ),
                        array(
                            'id' => 'google-analytics',
                            'type' => 'ace_editor',
                            'title' => __( 'Tracking code', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', MOKAINE_THEME_NAME ),
                            'mode' => 'php',
                            'theme' => 'chrome',
                            'desc' => "E.g. <pre>&lt;script type=&quot;text/javascript&quot;&gt;<br>var _gaq = _gaq || [];<br>_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);</pre>..."                            
                        ), 
                        array(
                            'id'       => 'enable-updates',
                            'type'     => 'switch',
                            'title'    => __( 'Enable update notifications', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Decide if you wish to receive notifications on theme updates.', MOKAINE_THEME_NAME ),
                            'default'  => true
                        )                          
                    )
                );

                /**
                 *  Note here I used a 'heading' in the sections array construct
                 *  This allows you to use a different title on your options page
                 * instead of reusing the 'title' value.  This can be done on any
                 * section - kp
                 */
                $this->sections[] = array(
                    'icon'    => 'dashicons-before dashicons-schedule',
                    'title'   => __( 'Header &amp; Logo', MOKAINE_THEME_NAME ),
                    'heading' => __( 'Header &amp; logo settings', MOKAINE_THEME_NAME ),
                    'fields'  => array(
                        array(
                            'id' => 'header-style',
                            'type' => 'radio',
                            'title' => __( 'Header style', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Choose the style you wish to use', MOKAINE_THEME_NAME ),
                            //Must provide key => value pairs for radio options
                            'options' => array(
                                'header-1' => 'Transparent & White typography',
                                'header-2' => 'Transparent & Black typography',
                                'header-3' => 'White solid & Black typography'
                            ),
                            'default' => 'header-1'
                        ),
                        array(
                            'id'       => 'parallax',
                            'type'     => 'switch',
                            'title'    => __( 'Parallax', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Parallax scrolling effect on intros', MOKAINE_THEME_NAME ),
                            'desc' => __( 'NOTE: When parallax is Off, <em>Header Style</em> options have no effect (the header will be white solid with black typography)', MOKAINE_THEME_NAME ),
                            'default'  => true
                        )                                                  
                    )
                );

                $this->sections[] = array(
                    'icon'    => 'dashicons-before dashicons-schedule dashicons-rotate-180',
                    'title'   => __( 'Footer', MOKAINE_THEME_NAME ),
                    'heading' => __( 'Footer settings', MOKAINE_THEME_NAME ),
                    'fields'  => array(
                        array(
                            'id' => 'enable-footer',
                            'type' => 'switch',
                            'title' => __( 'Enable footer', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Enable the footer widgets section', MOKAINE_THEME_NAME ),
                            'default' => true
                        ),
                        array(
                            'id' => 'footer-bottom-left',
                            'type' => 'textarea',
                            'title' => __( 'Bottom left notes', MOKAINE_THEME_NAME ),
                            'subtitle' => 'Use this space for Copyrights informations',
                            'default' => "&copy;[current_year] <a href='http://mokaine.com'>Mokaine</a> &middot; All Right Reserved."
                        ),  
                        array(
                            'id' => 'footer-bottom-right',
                            'type' => 'textarea',
                            'title' => __( 'Bottom right notes', MOKAINE_THEME_NAME ),
                            'subtitle' => 'Use this space for additional notes'
                        ),  
                        array(
                            'id' => 'footer-layout',
                            'type' => 'image_select',
                            'title' => __( 'Footer layout', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Select the footer column layout', MOKAINE_THEME_NAME ),
                            //Must provide key => value(array:title|img) pairs for radio options
                            'options'  => array(
                                'footer-1' => array( 'alt' => 'Layout 1', 'img' => get_template_directory_uri() . '/mokaine/includes/img/footer-1.png' ),
                                'footer-2' => array( 'alt' => 'Layout 2', 'img' => get_template_directory_uri() . '/mokaine/includes/img/footer-2.png' ),
                                'footer-3' => array( 'alt' => 'Layout 3', 'img' => get_template_directory_uri() . '/mokaine/includes/img/footer-3.png' ),
                                'footer-4' => array( 'alt' => 'Layout 4', 'img' => get_template_directory_uri() . '/mokaine/includes/img/footer-4.png' ),
                                'footer-5' => array( 'alt' => 'Layout 5', 'img' => get_template_directory_uri() . '/mokaine/includes/img/footer-5.png' ),
                                'footer-6' => array( 'alt' => 'Layout 6', 'img' => get_template_directory_uri() . '/mokaine/includes/img/footer-6.png' ),
                                'footer-7' => array( 'alt' => 'Layout 7', 'img' => get_template_directory_uri() . '/mokaine/includes/img/footer-7.png' ),
                                'footer-8' => array( 'alt' => 'Layout 8', 'img' => get_template_directory_uri() . '/mokaine/includes/img/footer-8.png' ),
                                'footer-9' => array( 'alt' => 'Layout 9', 'img' => get_template_directory_uri() . '/mokaine/includes/img/footer-9.png' )                            
                            ),
                            'default'  => 'footer-1'
                        )                                                                                             
                    )
                );

                $this->sections[] = array(
                    'icon'    => 'dashicons-before dashicons-schedule dashicons-rotate-90',
                    'title'   => __( 'Sidebar', MOKAINE_THEME_NAME ),
                    'heading' => __( 'Sidebar settings', MOKAINE_THEME_NAME ),
                    'fields'  => array(
                        array(
                            'id' => 'enable-sidebar-blog-page',
                            'type' => 'switch',
                            'title' => __( 'Sidebar on blog pages', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Enable to display the sidebar on blog pages (not available on Masonry style)', MOKAINE_THEME_NAME ),
                            'default' => true
                        ), 
                        array(
                            'id' => 'enable-sidebar-blog-post',
                            'type' => 'switch',
                            'title' => __( 'Sidebar on blog posts', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Enable to display the sidebar on post pages', MOKAINE_THEME_NAME ),
                            'default' => true
                        ),  
                        array(
                            'id' => 'enable-sidebar-page',
                            'type' => 'switch',
                            'title' => __( 'Sidebar on pages', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Enable to display the sidebar on pages (i.e. pages, 404, archive pages, etc.)', MOKAINE_THEME_NAME ),
                            'default' => true
                        )                                                                                                                                              
                    )
                );

                $this->sections[] = array(
                    'icon'    => 'dashicons-before dashicons-admin-post',
                    'title'   => __( 'Blog settings', MOKAINE_THEME_NAME ),
                    'fields'  => array(
                        array(
                            'id' => 'enable-excerpts',
                            'type' => 'switch',
                            'title' => __( 'Show excerpts', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Enable to display excerpts on blog pages', MOKAINE_THEME_NAME ),
                            'default' => true
                        ),                                              
                        array(
                            'id' => 'enable-first-post-big',
                            'type' => 'switch',
                            'title' => __( 'Masonry settings', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Enable to show the first post bigger on blog shortcode', MOKAINE_THEME_NAME ),
                            'default' => true
                        ),                                                                          
                        array(
                            'id' => 'enable-blog-navigator',
                            'type' => 'switch',
                            'title' => __( 'Show post navigation', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Enable to display navigation links on blog posts', MOKAINE_THEME_NAME ),
                            'default' => true
                        ),
                        array(
                            'id' => 'enable-author-bio',
                            'type' => 'switch',
                            'title' => __( 'Show author bio', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Enable to display the author box at the bottom of the article', MOKAINE_THEME_NAME ),
                            'default' => true
                        ),                          
                        array(
                            'id' => 'enable-blog-related-posts',
                            'type' => 'switch',
                            'title' => __( 'Show related posts', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Enable to display related posts at the bottom of the article', MOKAINE_THEME_NAME ),
                            'default' => true
                        )                                                                                                                                           
                    )
                );

                $this->sections[] = array(
                    'icon'    => 'dashicons-before dashicons-portfolio',
                    'title'   => __( 'Portfolio settings', MOKAINE_THEME_NAME ),
                    'fields'  => array(
                        array(
                            'id' => 'enable-portfolio-filters',
                            'type' => 'switch',
                            'title' => __( 'Show filter tags', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Enable to display filter tags on portfolio pages', MOKAINE_THEME_NAME ),
                            'default' => true
                        ),                        
                        array(
                            'id' => 'enable-portfolio-navigator',
                            'type' => 'switch',
                            'title' => __( 'Show item navigation', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Enable to display navigation links on portfolio items', MOKAINE_THEME_NAME ),
                            'default' => true
                        ),      
                        array(
                            'id' => 'portfolio-widgets',
                            'type' => 'multi_text',
                            'title' => __( 'Portfolio sidebar widgets', MOKAINE_THEME_NAME ),
                            'validate' => 'no_special_chars',
                            'subtitle' => __( 'Choose a title for any custom widget to be showed on portfolio items', MOKAINE_THEME_NAME )
                        ),
                        array(
                            'id' => 'enable-portfolio-related-items',
                            'type' => 'switch',
                            'title' => __( 'Show related items', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Enable to display related items at the bottom of the post', MOKAINE_THEME_NAME ),
                            'default' => true
                        )                                                                                                                                                                
                    )
                );

                $this->sections[] = array(
                    'icon'    => 'dashicons-before dashicons-editor-textcolor',
                    'title'   => __( 'Font options', MOKAINE_THEME_NAME ),
                    'fields'  => array(
                        array(
                            'id' => 'info-headings-size',
                            'type' => 'info',
                            'icon' => 'dashicons dashicons-unlock',
                            'style' => 'warning',
                            'title' => __( 'Unlock this panel!', MOKAINE_THEME_NAME ),
                            'desc' => __( 'The Font options panel is not available in Beetle Go. Purchase <a href="http://mokaine.com/beetle-pro-wordpress-theme/">Beetle Pro</a> to unlock it!', MOKAINE_THEME_NAME )
                        )                                                                                                                                                        
                    )
                );

                $this->sections[] = array(
                    'icon'    => 'dashicons-before dashicons-media-text',
                    'title'   => __( 'Font size options', MOKAINE_THEME_NAME ),
                    'desc' => __( 'Beetle typography has been built using <code>em</code> measurement unit. Em’s is a "relative" sizing technique, so it can be useful when you control the sizing of your page as completely relative to other things on your page. <a href="http://www.w3schools.com/cssref/css_units.asp" target="_blank">Click here</a> to know more about CSS units.<br><br>Before setting <code>em</code> values, we need to tell Beetle what is the <strong>base font size</strong> in <code>px</code> to be applied on the body tag: all the other <code>em</code> values will adjust on that value', MOKAINE_THEME_NAME ),                    
                    'fields'  => array(
                        array(
                            'id' => 'base-font-size',
                            'type' => 'slider', 
                            'title' => __( 'Base font size', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Set the base font size in px', MOKAINE_THEME_NAME ),
                            'desc' => __( 'Default value is <code>18px</code>. Set an higher value to make all bigger or vice versa', MOKAINE_THEME_NAME ),
                            'default' => 18,
                            'min' => 14,
                            'step' => 1,
                            'max' => 26,
                            'resolution' => 1,
                            'display_value' => 'text'
                        ), 
                        array(
                            'id' => 'base-font-size-smaller',
                            'type' => 'slider', 
                            'title' => __( 'Small screens font size', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Set the base font size in px for small devices', MOKAINE_THEME_NAME ),
                            'desc' => __( 'Default value is <code>16px</code>. Set an higher value to make all bigger or vice versa', MOKAINE_THEME_NAME ),
                            'default' => 16,
                            'min' => 12,
                            'step' => 1,
                            'max' => 24,
                            'resolution' => 1,
                            'display_value' => 'text'
                        ),
                        array(
                            'id' => 'info-headings-size',
                            'type' => 'info',
                            'desc' => __( 'Now that you have set the <strong>base font size</strong> in <code>px</code>, you can adjust the font size of each heading tag', MOKAINE_THEME_NAME ),
                        ),                                                 
                        array(
                            'id' => 'h1-font-size',
                            'type' => 'slider', 
                            'title' => __( 'H1 size', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Set h1 tags font size in em', MOKAINE_THEME_NAME ),
                            'desc' => __( 'Default value is <code>2.369em</code>', MOKAINE_THEME_NAME ),
                            'default' => 2.369,
                            'min' => 0.5,
                            'step' => 0.001,
                            'max' => 4,
                            'resolution' => 0.001,
                            'display_value' => 'text'
                        ),  
                        array(
                            'id' => 'h2-font-size',
                            'type' => 'slider', 
                            'title' => __( 'H2 size', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Set h2 tags font size in em', MOKAINE_THEME_NAME ),
                            'desc' => __( 'Default value is <code>1.777em</code>', MOKAINE_THEME_NAME ),
                            'default' => 1.777,
                            'min' => 0.5,
                            'step' => 0.001,
                            'max' => 4,
                            'resolution' => 0.001,
                            'display_value' => 'text'
                        ),  
                        array(
                            'id' => 'h3-font-size',
                            'type' => 'slider', 
                            'title' => __( 'H3 size', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Set h3 tags font size in em', MOKAINE_THEME_NAME ),
                            'desc' => __( 'Default value is <code>1.333em</code>', MOKAINE_THEME_NAME ),
                            'default' => 1.333,
                            'min' => 0.5,
                            'step' => 0.001,
                            'max' => 4,
                            'resolution' => 0.001,
                            'display_value' => 'text'
                        ),  
                        array(
                            'id' => 'h4-font-size',
                            'type' => 'slider', 
                            'title' => __( 'H4 size', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Set h4 tags font size in em', MOKAINE_THEME_NAME ),
                            'desc' => __( 'Default value is <code>1em</code>', MOKAINE_THEME_NAME ),
                            'default' => 1,
                            'min' => 0.5,
                            'step' => 0.001,
                            'max' => 4,
                            'resolution' => 0.001,
                            'display_value' => 'text'
                        ),  
                        array(
                            'id' => 'h5-font-size',
                            'type' => 'slider', 
                            'title' => __( 'H5 size', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Set h5 tags font size in em', MOKAINE_THEME_NAME ),
                            'desc' => __( 'Default value is <code>0.75em</code>', MOKAINE_THEME_NAME ),
                            'default' => 0.75,
                            'min' => 0.5,
                            'step' => 0.001,
                            'max' => 4,
                            'resolution' => 0.001,
                            'display_value' => 'text'
                        ),  
                        array(
                            'id' => 'h6-font-size',
                            'type' => 'slider', 
                            'title' => __( 'H6 size', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Set h6 tags font size in em', MOKAINE_THEME_NAME ),
                            'desc' => __( 'Default value is <code>0.563em</code>', MOKAINE_THEME_NAME ),
                            'default' => 0.563,
                            'min' => 0.5,
                            'step' => 0.001,
                            'max' => 4,
                            'resolution' => 0.001,
                            'display_value' => 'text'
                        ), 
                        array(
                            'id'   => 'info-line-height',
                            'type' => 'info',
                            'desc' => __( 'Finally, adjust the <strong>line-height</strong> if you really need to', MOKAINE_THEME_NAME ),
                        ),                             
                        array(
                            'id' => 'body-line-height',
                            'type' => 'slider', 
                            'title' => __( 'Body line height', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Set the body line-height', MOKAINE_THEME_NAME ),
                            'desc' => __( 'Default value is <code>1.8</code>', MOKAINE_THEME_NAME ),
                            'default' => 1.8,
                            'min' => 1,
                            'step' => 0.01,
                            'max' => 3,
                            'resolution' => 0.01,
                            'display_value' => 'text'
                        ), 
                        array(
                            'id' => 'headings-line-height',
                            'type' => 'slider', 
                            'title' => __( 'Headings line height', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Set the headings line-height', MOKAINE_THEME_NAME ),
                            'desc' => __( 'Default value is <code>1.34</code>', MOKAINE_THEME_NAME ),
                            'default' => 1.34,
                            'min' => 1,
                            'step' => 0.01,
                            'max' => 3,
                            'resolution' => 0.01,
                            'display_value' => 'text'
                        ),                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                    )
                );

                $this->sections[] = array(
                    'icon'    => 'dashicons-before dashicons-art',
                    'title'   => __( 'Style settings', MOKAINE_THEME_NAME ),
                    'fields'  => array(
                        array(
                            'id' => 'primary-color',
                            'type' => 'color', 
                            'title' => __( 'Primary color', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Set the primary color (links, icons, etc.)', MOKAINE_THEME_NAME ),
                            'desc' => __( 'Try our pre-picked colors in the palette!', MOKAINE_THEME_NAME ),
                            'transparent' => false,
                            'default' => '#FD685B',
                        ),  
                        array(
                            'id' => 'secondary-color',
                            'type' => 'color', 
                            'title' => __( 'Secondary color', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Set the secondary color (thumbnail color on hover, etc.)', MOKAINE_THEME_NAME ),
                            'desc' => __( 'Try our pre-picked colors in the palette!', MOKAINE_THEME_NAME ),
                            'transparent' => false,
                            'default' => '#4FC1E9',
                        ),
                        array(
                            'id' => 'intro-bg-color',
                            'type' => 'color',
                            'title' => __( 'Intro background color', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Pick a background color', MOKAINE_THEME_NAME ),
                            'transparent' => false,
                            'default' => '#363842',
                            'output' => array( 'background-color' => '#intro-wrap' )
                        ), 
                        array(
                            'id' => 'footer-bg-color',
                            'type' => 'color',
                            'title' => __( 'Footer background color', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Pick a background color', MOKAINE_THEME_NAME ),
                            'transparent' => false,
                            'default' => '#363842',
                            'output' => array( 'background-color' => 'footer.site-footer' )
                        ), 
                        array(
                            'id' => 'footer-text-color',
                            'type' => 'color',
                            'title' => __( 'Footer text color', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Pick a color for the footer links', MOKAINE_THEME_NAME ),
                            'transparent' => false,
                            'default' => '#545766',
                            'output' => array( 'color' => 'footer.site-footer, footer.site-footer a, footer.site-footer ul.meta-social li a', 'border-color' => 'footer.site-footer ul.meta-social li a' )
                        ),                            
                        array(
                            'id' => 'img-radius',
                            'type' => 'slider',
                            'title' => __( 'Image corners', MOKAINE_THEME_NAME ),
                            'subtitle' => __( 'Use the slider to round image corners', MOKAINE_THEME_NAME ),
                            'desc' => __( '<code>em</code> value associated to border-radius', MOKAINE_THEME_NAME ),
                            'default' => 1.0,
                            'min' => 0,
                            'step' => 0.1,
                            'max' => 2.5,
                            'resolution' => 0.1,
                            'display_value' => 'text'
                        )                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
                    )
                );

                $this->sections[] = array(
                    'icon'    => 'dashicons-before dashicons-editor-code',
                    'title'   => __( 'Custom code', MOKAINE_THEME_NAME ),
                    'fields'  => array(
                        array(
                            'id' => 'custom-css',
                            'type' => 'ace_editor',
                            'title' => __( 'Custom CSS', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Paste here your custom CSS code', MOKAINE_THEME_NAME ),
                            'mode' => 'css',
                            'theme' => 'chrome',
                            'desc' => 'E.g. <pre>body { background-color: #E7E7E7; }</pre>'                            
                        ),  
                        array(
                            'id' => 'custom-js',
                            'type' => 'ace_editor',
                            'title' => __( 'Custom JS', MOKAINE_THEME_NAME ), 
                            'subtitle' => __( 'Paste here your custom jQuery code.<br><br>No need to add <em>jQuery(document).ready(function($) {</em> ...', MOKAINE_THEME_NAME ),
                            'mode' => 'javascript',
                            'theme' => 'chrome',
                            'desc' => 'E.g. <pre>$("header").last("li").addClass("last");</pre>'                        
                        )                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                    )
                );

                $this->sections[] = array(
                    'title' => __( 'Import / Export', MOKAINE_THEME_NAME ),
                    'desc' => __( 'Import and Export your Redux Framework settings from file, text or URL', MOKAINE_THEME_NAME ),
                    'icon' => 'el-icon-refresh',
                    'fields' => array(
                        array(
                            'id' => 'import-export',
                            'type' => 'import_export',
                            'title' => 'Import Export',
                            'subtitle' => 'Save and restore your Redux options',
                            'full_width' => true,
                        ),
                    ),
                );

                $this->sections[] = array(
                    'type' => 'divide',
                );

                $this->sections[] = array(
                    'icon'   => 'el-icon-info-sign',
                    'title'  => __( 'Theme Information', MOKAINE_THEME_NAME ),
                    'desc'   => __( '<p class="description">A powerful WordPress theme for Designers, Photographers and Storytellers.</p>', MOKAINE_THEME_NAME ),
                    'fields' => array(
                        array(
                            'id'      => 'opt-raw-info',
                            'type'    => 'raw',
                            'content' => $item_info,
                        )
                    ),
                );

                if ( file_exists( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) ) {
                    $tabs['docs'] = array(
                        'icon'    => 'el-icon-book',
                        'title'   => __( 'Documentation', MOKAINE_THEME_NAME ),
                        'content' => nl2br( file_get_contents( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) )
                    );
                }
            }

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                // $this->args['help_tabs'][] = array(
                //     'id'      => 'redux-help-tab-1',
                //     'title'   => __( 'Theme Information 1', MOKAINE_THEME_NAME ),
                //     'content' => __( '<p>This is the tab content, HTML is allowed.</p>', MOKAINE_THEME_NAME )
                // );

                // $this->args['help_tabs'][] = array(
                //     'id'      => 'redux-help-tab-2',
                //     'title'   => __( 'Theme Information 2', MOKAINE_THEME_NAME ),
                //     'content' => __( '<p>This is the tab content, HTML is allowed.</p>', MOKAINE_THEME_NAME )
                // );

                // Set the help sidebar
                // $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', MOKAINE_THEME_NAME );
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'mokaine',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'Beetle Go Options', MOKAINE_THEME_NAME ),
                    'page_title'           => __( 'Beetle Go Options', MOKAINE_THEME_NAME ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-admin-generic',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => true,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => false,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => 50,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => '',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => '_options',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );

                // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
                $this->args['admin_bar_links'][] = array(
                    'id'    => 'redux-docs',
                    'href'   => 'http://docs.mokaine.com/beetle-for-wordpress/index.html',
                    'title' => __( 'Documentation', MOKAINE_THEME_NAME ),
                );

                $this->args['admin_bar_links'][] = array(
                    //'id'    => 'redux-support',
                    'href'   => 'http://mokaine.com/help/',
                    'title' => __( 'Support', MOKAINE_THEME_NAME ),
                );

                // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
                $this->args['share_icons'][] = array(
                    'url'   => 'https://www.facebook.com/pages/Mokaine/291531271001808',
                    'title' => 'Like us on Facebook',
                    'icon'  => 'el-icon-facebook'
                );

                // Panel Intro text -> before the form
                // if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                //     if ( ! empty( $this->args['global_variable'] ) ) {
                //         $v = $this->args['global_variable'];
                //     } else {
                //         $v = str_replace( '-', '_', $this->args['opt_name'] );
                //     }
                //     $this->args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', MOKAINE_THEME_NAME ), $v );
                // } else {
                //     $this->args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn&rsquo;t required, but more info is always better! The intro_text field accepts all HTML.</p>', MOKAINE_THEME_NAME );
                // }

                // Add content after the form.
                // $this->args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn&rsquo;t required, but more info is always better! The footer_text field accepts all HTML.</p>', MOKAINE_THEME_NAME );
            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';

                /*
              do your validation

              if(something) {
                $value = $value;
              } elseif(something else) {
                $error = true;
                $value = $existing_value;
                
              }
             */

                $return['value'] = $value;
                $field['msg']    = 'your custom error message';
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public function class_field_callback( $field, $value ) {
                print_r( $field );
                echo '<br/>CLASS CALLBACK';
                print_r( $value );
            }

        }

        global $reduxConfig;
    	$reduxConfig = new Redux_Framework();
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';

            /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            
          }
         */

            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }

            return $return;
        }
    endif;
