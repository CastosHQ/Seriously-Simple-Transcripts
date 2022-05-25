<?php

namespace SSP_Transcripts\Integrations\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Text_Editor;

class Elementor_Transcripts_Widget extends Widget_Text_Editor {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		$this->add_style_depends( 'ssp_transcripts' );
	}

	public function get_name() {
		return 'ssp-transcript';
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


	/**
	 * Register text editor widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls() {

        /**
         * Content Controls
         * */
		$this->start_controls_section(
			'section_editor',
			[
				'label' => esc_html__( 'Transcript', 'seriously-simple-transcripts' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => 'Title',
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Transcript', 'seriously-simple-transcripts' ),
			]
		);

		$this->add_control(
			'content',
			[
				'label'   => 'Content',
				'type'    => Controls_Manager::WYSIWYG,
				'default' => '<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ) . '</p>',
			]
		);

		$this->end_controls_section();


		/**
		 * Style Controls
		 * */
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => esc_html__( 'General', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'hide_title',
			[
				'label'     => esc_html__( 'Hide Title', 'elementor' ),
				'type'      => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_content',
			[
				'label'     => esc_html__( 'Show Content By Default', 'elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'hide_title' => '',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'seriously-simple-podcasting' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'hide_title' => '',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'seriously-simple-podcasting' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ssp-transcript-title' => 'color: {{VALUE}};',
				],
				'global'    => [
					'default' => '',
				],
			]
		);

		$this->add_control(
			'title_bg',
			[
				'label'     => esc_html__( 'Title Background', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ssp-transcript-title' => 'background: {{VALUE}};',
				],
				'global'    => [
					'default' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'title_typography',
				'label'          => esc_html__( 'Typography', 'seriously-simple-podcasting' ),
				'fields_options' => [
					'font_family'     => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-title' => 'font-family: "{{VALUE}}"',
						],
					],
					'font_size'       => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-title' => 'font-size: {{SIZE}}{{UNIT}}',
						],
					],
					'font_weight'     => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-title' => 'font-weight: {{VALUE}}',
						],
					],
					'text_transform'  => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-title' => 'text-transform: {{VALUE}}',
						],
					],
					'font_style'      => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-title' => 'font-style: {{VALUE}}',
						],
					],
					'text_decoration' => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-title' => 'text-decoration: {{VALUE}}',
						],
					],
					'line_height'     => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-title' => 'line-height: {{SIZE}}{{UNIT}}',
						],
					],
					'letter_spacing'  => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-title' => '--e-global-typography-{{external._id.VALUE}}-letter-spacing: {{SIZE}}{{UNIT}}',
						],
					],
				],
			]
		);

		$this->end_controls_section();


		// Content style
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'seriously-simple-podcasting' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_align',
			[
				'label'     => esc_html__( 'Alignment', 'elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'elementor' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ssp-transcript-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => esc_html__( 'Text Color', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ssp-transcript-content' => 'color: {{VALUE}};',
				],
				'global'    => [
					'default' => '',
				],
			]
		);

		$this->add_control(
			'content_bg',
			[
				'label'     => esc_html__( 'Content Background', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ssp-transcript-content' => 'background: {{VALUE}};',
				],
				'global'    => [
					'default' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'content_typography',
				'label'          => esc_html__( 'Typography', 'elementor' ),
				'fields_options' => [
					'font_family'     => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-content' => 'font-family: "{{VALUE}}"',
						],
					],
					'font_size'       => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-content' => 'font-size: {{SIZE}}{{UNIT}}',
						],
					],
					'font_weight'     => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-content' => 'font-weight: {{VALUE}}',
						],
					],
					'text_transform'  => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-content' => 'text-transform: {{VALUE}}',
						],
					],
					'font_style'      => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-content' => 'font-style: {{VALUE}}',
						],
					],
					'text_decoration' => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-content' => 'text-decoration: {{VALUE}}',
						],
					],
					'line_height'     => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-content' => 'line-height: {{SIZE}}{{UNIT}}',
						],
					],
					'letter_spacing'  => [
						'selectors' => [
							'{{SELECTOR}} .ssp-transcript-content' => 'letter-spacing: {{SIZE}}{{UNIT}}',
						],
					],
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
		$is_dom_optimized             = Plugin::$instance->experiments->is_feature_active( 'e_dom_optimization' );
		$is_edit_mode                 = Plugin::$instance->editor->is_edit_mode();
		$should_render_inline_editing = ( ! $is_dom_optimized || $is_edit_mode );

		$hide_title   = $this->get_settings_for_display( 'hide_title' );
		$show_content = $this->get_settings_for_display( 'show_content' );
		$title        = $this->get_settings_for_display( 'title' );

		$editor_content = $this->get_settings_for_display( 'content' );
		$editor_content = $this->parse_text_editor( $editor_content );

		$check_id = 'ssp-transcript-check-' . wp_generate_password( 6 );

		if ( $should_render_inline_editing ) {
			$this->add_render_attribute( 'content', 'class', [ 'elementor-text-editor', 'elementor-clearfix' ] );
			$this->add_render_attribute( 'title', 'class', [ 'elementor-text-editor', 'elementor-clearfix' ] );
			$this->add_render_attribute( 'title', 'class', [ 'elementor-text-editor', 'elementor-clearfix' ] );
		}

		$this->add_inline_editing_attributes( 'title' );
		$this->add_inline_editing_attributes( 'content', 'advanced' );
		?>

        <div class="ssp-transcript">
            <div class="row">
                <div class="col">
                    <div class="tabs">
                        <div class="tab">
                            <input type="checkbox" id="<?php echo $check_id ?>" <?php checked( $show_content, 'yes' ) ?>>
                            <?php if( ! $hide_title ) : ?>
                            <label class="tab-label ssp-transcript-title" for="<?php echo $check_id ?>">
								<?php if ( $should_render_inline_editing ) : ?>
                                    <div <?php $this->print_render_attribute_string( 'title' ); ?>>
                                <?php endif; ?>
									<?php echo $title ?>
                                <?php if ( $should_render_inline_editing ) : ?>
                                    </div>
                                <?php endif ?>
                            </label>
                            <?php endif; ?>
                            <div class="tab-content ssp-transcript-content">
								<?php if ( $should_render_inline_editing ) : ?>
                                <div <?php $this->print_render_attribute_string( 'content' ); ?>>
									<?php endif; ?>
									<?php echo $editor_content; ?>
									<?php if ( $should_render_inline_editing ) : ?>
                                </div>
							<?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}


	/**
	 * Render text editor widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
        <#
        const isDomOptimized = ! ! elementorFrontend.config.experimentalFeatures.e_dom_optimization,
        isEditMode = elementorFrontend.isEditMode(),
        shouldRenderInlineEditing = ( ! isDomOptimized || isEditMode );
        checked = "yes" === settings.show_content;
        checkId = "ssp-transcript-check-" + (Math.random() + 1).toString(36).substring(6);

        if ( shouldRenderInlineEditing ) {
        view.addRenderAttribute( 'title', 'class', [ 'elementor-text-content', 'elementor-clearfix' ] );
        view.addRenderAttribute( 'content', 'class', [ 'elementor-text-content', 'elementor-clearfix' ] );
        }

        view.addInlineEditingAttributes( 'title' );
        view.addInlineEditingAttributes( 'content', 'advanced' ); #>

        <div class="ssp-transcript">
            <div class="row">
                <div class="col">
                    <div class="tabs">
                        <div class="tab">
                            <input type="checkbox" id="{{{ checkId }}}" <# if (settings.show_content) { #>checked<# } #>>
                            <# if ( ! settings.hide_title ) { #>
                            <label class="tab-label ssp-transcript-title" for="{{{ checkId }}}">
                                <# if ( shouldRenderInlineEditing ) { #>
                                <div {{{ view.getRenderAttributeString("title") }}}>
                                <# } #>
                                {{{ settings.title }}}
                                <# if ( shouldRenderInlineEditing ) { #>
                                </div>
                                <# } #>
                            </label>
                            <# } #>
                            <div class="tab-content ssp-transcript-content">
                                <# if ( shouldRenderInlineEditing ) { #>
                                <div {{{ view.getRenderAttributeString("content") }}}>
                                <# } #>
                                {{{ settings.content }}}
                                <# if ( shouldRenderInlineEditing ) { #>
                                </div>
                                <# } #>
                            </div>
                        </div><!-- tab -->
                    </div><!-- tabs -->
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- ssp-transcript -->
		<?php
	}


	/**
	 * Render plain content (what data should be stored in the post_content).
	 *
	 * @since 2.11.0
	 */
	public function render_plain_content() {
		$this->render_content();
	}
}
