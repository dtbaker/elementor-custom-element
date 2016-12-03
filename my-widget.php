<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_My_Custom_Elementor_Thing extends Widget_Base {

	public function get_name() {
		return 'my-blog-posts';
	}

	public function get_title() {
		return __( 'My Custom Widget', 'elementor-custom-element' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'post-list';
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_my_custom',
			[
				'label' => esc_html__( 'Blog Posts', 'elementor' ),
			]
		);
		

		$this->add_control(
			'some_text',
			[
				'label' => __( 'Text', 'elementor-custom-element' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Enter some text', 'elementor-custom-element' ),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Number of Posts', 'elementor-custom-element' ),
				'type' => Controls_Manager::SELECT,
				'default' => 5,
				'options' => [
					1 => __( 'One', 'elementor-custom-element' ),
					2 => __( 'Two', 'elementor-custom-element' ),
					5 => __( 'Five', 'elementor-custom-element' ),
					10 => __( 'Ten', 'elementor-custom-element' ),
				]
			]
		);
		
		$this->end_controls_section();

	}

	protected function render( $instance = [] ) {

		// get our input from the widget settings.

		$custom_text = ! empty( $instance['some_text'] ) ? $instance['some_text'] : ' (no text was entered ) ';
		$post_count = ! empty( $instance['posts_per_page'] ) ? (int)$instance['posts_per_page'] : 5;

		?>

		<h3>My Example Elementor Widget</h3>
		<p>My text was: <?php echo esc_html( $custom_text );?> </p>
		<h3>Some Recent Posts Here:</h3>
		<ul>
			<?php
			$args = array( 'numberposts' => $post_count );
			$recent_posts = wp_get_recent_posts( $args );
			foreach( $recent_posts as $recent ){
				echo '<li><a href="' . esc_url( get_permalink( $recent["ID"] ) ). '">' .   esc_html( $recent["post_title"] ).'</a> </li> ';
			}
			wp_reset_query();
			?>
		</ul>

		<?php

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}


