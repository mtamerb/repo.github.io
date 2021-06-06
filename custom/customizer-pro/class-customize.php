<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class best_construction_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( THEME_DIR ) . 'custom/customizer-pro/section-pro.php' );
		// Register custom section types.
		$manager->register_section_type( 'best_construction_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new best_construction_Customize_Section_Pro(
				$manager,
				'best-construction',
				array(
					'title'    => esc_html__( 'Theta All (Best Construction Pro)', 'best-construction' ),
					'priority'	=> 8,	
					'pro_text' => esc_html__( 'Upgrade to Pro',         'best-construction' ),
					'pro_url'  => 'https://www.coothemes.com/theme-theta-all/'
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'best-construction-customize-controls', trailingslashit( THEME_URL ) . 'custom/customizer-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'best-construction-customize-controls', trailingslashit( THEME_URL ) . 'custom/customizer-pro/customize-controls.css' );
	}
}

// Doing this customizer thang!
best_construction_Customize::get_instance();
