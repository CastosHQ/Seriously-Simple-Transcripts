<?php

namespace SSP_Transcripts\Integrations\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Text_Editor;

class Elementor_Transcripts_Widget extends Widget_Text_Editor {

	public function get_name() {
		return 'transcript';
	}

	public function get_title() {
		return __( 'Transcript', 'seriously-simple-podcasting' );
	}

	public function get_icon() {
		return 'eicon-post-excerpt';
	}

	public function get_categories() {
		return array( 'podcasting' );
	}

	/*protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'seriously-simple-podcasting' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		echo 'Hello World!';
	}*/

	/**
	 * Register text editor widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_editor',
			[
				'label' => esc_html__( 'Transcript', 'elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => 'Title',
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Transcript', 'elementor' ),
			]
		);

		$this->add_control(
			'editor',
			[
				'label' => 'Content',
				'type' => Controls_Manager::WYSIWYG,
				'default' => '<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ) . '</p>',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Text Editor', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_drop_cap',
			[
				'label' => esc_html__( 'Drop Cap', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'drop_cap' => 'yes',
				],
			]
		);

		$this->add_control(
			'drop_cap_view',
			[
				'label' => esc_html__( 'View', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'elementor' ),
					'stacked' => esc_html__( 'Stacked', 'elementor' ),
					'framed' => esc_html__( 'Framed', 'elementor' ),
				],
				'default' => 'default',
				'prefix_class' => 'elementor-drop-cap-view-',
			]
		);

		$this->add_control(
			'drop_cap_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-drop-cap-view-stacked .elementor-drop-cap' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-drop-cap-view-framed .elementor-drop-cap, {{WRAPPER}}.elementor-drop-cap-view-default .elementor-drop-cap' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$this->add_control(
			'drop_cap_secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-drop-cap-view-framed .elementor-drop-cap' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-drop-cap-view-stacked .elementor-drop-cap' => 'color: {{VALUE}};',
				],
				'condition' => [
					'drop_cap_view!' => 'default',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'drop_cap_shadow',
				'selector' => '{{WRAPPER}} .elementor-drop-cap',
			]
		);

		$this->add_control(
			'drop_cap_size',
			[
				'label' => esc_html__( 'Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-drop-cap' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'drop_cap_view!' => 'default',
				],
			]
		);

		$this->add_control(
			'drop_cap_space',
			[
				'label' => esc_html__( 'Space', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .elementor-drop-cap' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .elementor-drop-cap' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'drop_cap_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-drop-cap' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'drop_cap_border_width', [
				'label' => esc_html__( 'Border Width', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .elementor-drop-cap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'drop_cap_view' => 'framed',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'drop_cap_typography',
				'selector' => '{{WRAPPER}} .elementor-drop-cap-letter',
				'exclude' => [
					'letter_spacing',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render text editor widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$is_dom_optimized = Plugin::$instance->experiments->is_feature_active( 'e_dom_optimization' );
		$is_edit_mode = Plugin::$instance->editor->is_edit_mode();
		$should_render_inline_editing = ( ! $is_dom_optimized || $is_edit_mode );

		$editor_content = $this->get_settings_for_display( 'editor' );
		$editor_content = $this->parse_text_editor( $editor_content );

		if ( $should_render_inline_editing ) {
			$this->add_render_attribute( 'editor', 'class', [ 'elementor-text-editor', 'elementor-clearfix' ] );
		}

		$this->add_inline_editing_attributes( 'editor', 'advanced' );
		?>
		<?php if ( $should_render_inline_editing ) { ?>
			<div <?php $this->print_render_attribute_string( 'editor' ); ?>>
		<?php } ?>
		<?php // PHPCS - the main text of a widget should not be escaped.
		echo 'Test!!! ' . $editor_content; // phpcs:ignore WordPress.Security.EscapeOutput ?>
		<?php if ( $should_render_inline_editing ) { ?>
			</div>
		<?php } ?>




		<?php
	}

	/**
	 * Render plain content (what data should be stored in the post_content).
	 *
	 * @since 2.11.0
	 */
	public function render_plain_content() {
		echo '';
	}
}
