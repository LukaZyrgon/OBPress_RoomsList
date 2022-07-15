<?php

class RoomsList extends \Elementor\Widget_Base
{

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		
		wp_register_script( 'rooms-list_js',  plugins_url( '/OBPress_RoomsList/widget/assets/js/rooms-list.js'), [ 'elementor-frontend' ], '1.0.0', true );

		wp_register_style( 'rooms-list_css', plugins_url( '/OBPress_RoomsList/widget/assets/css/rooms-list.css') );        
	}

	public function get_script_depends()
	{
		return ['rooms-list_js'];
	}

	public function get_style_depends()
	{
		return ['rooms-list_css'];
	}
	
	public function get_name()
	{
		return 'RoomsList';
	}

	public function get_title()
	{
		return __('Rooms List', 'OBPress_RoomsList');
	}

	public function get_icon()
	{
		return 'fa fa-calendar';
	}

	public function get_categories()
	{
		return ['OBPress'];
	}
	
	protected function _register_controls()
	{
		$this->start_controls_section(
			'search_input_and_order_button_section',
			[
				'label' => __('Search And Order Button Style', 'OBPress_SpecialOffersList'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'obpress_packages_search_order_align',
			[
				'label' => __( 'Search and Order Vertical Align', 'OBPress_SpecialOffersList' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => 'center',
				'mobile_default' => 'center',
				'options' => [
					'left'  => __( 'Left', 'OBPress_SpecialOffersList' ),
					'center'  => __( 'Center', 'OBPress_SpecialOffersList' ),
					'right'  => __( 'Right', 'OBPress_SpecialOffersList' ),
				],
				'selectors' => [
					'.rooms .search-and-order' => 'justify-content: {{obpress_packages_search_order_align}}'
				],
			]
		);

		$this->add_responsive_control(
			'obpress_search_input_width',
			[
				'label' => __( 'Search Input Width', 'OBPress_SpecialOffersList' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'size' => 500,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 100,
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'.rooms #search-input' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'obpress_search_input_height',
			[
				'label' => __( 'Search Input Height', 'OBPress_SpecialOffersList' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'size' => 40,
				],
				'mobile_default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'max' => 100,
						'min' => 10,
						'step' => 1,
					]
				],
				'render_type' => 'ui',
				'selectors' => [
					'.rooms #search-input' => 'height: {{SIZE}}px',
				],
			]
		);

		$this->add_control(
			'obpress_search_input_bg_color',
			[
				'label' => __('Search Input Bg Color', 'OBPress_SpecialOffersList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#fff',
				'selectors' => [
					'.rooms #search-input' => 'background-color: {{obpress_search_input_bg_color}}'
				],
			]
		);

		$this->add_responsive_control(
			'obpress_search_input_padding',
			[
				'label' => __( 'Search Input Padding', 'OBPress_SpecialOffersList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '10',
					'right' => '30',
					'bottom' => '10',
					'left' => '10',
					'isLinked' => false
				],
				'mobile_default' => [
					'top' => '10',
					'right' => '30',
					'bottom' => '10',
					'left' => '10',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms #search-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'obpress_order_button_margin',
			[
				'label' => __( 'Order Btn Margin', 'OBPress_SpecialOffersList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '15',
					'isLinked' => false
				],
				'mobile_default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '15',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms .obpress-chain-results-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'obpress_order_button_bg_color',
			[
				'label' => __('Order Btn Bg Color', 'OBPress_SpecialOffersList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#fff',
				'selectors' => [
					'.rooms .obpress-chain-results-button' => 'background-color: {{obpress_order_button_bg_color}}'
				],
			]
		);

		$this->add_control(
			'obpress_order_button_hover_bg_color',
			[
				'label' => __('Order Btn Hover Bg Color', 'OBPress_SpecialOffersList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#191919',
				'selectors' => [
					'.rooms .obpress-chain-results-button:hover' => 'background-color: {{obpress_order_button_hover_bg_color}}'
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'obpress_order_button_border',
				'label' => __( 'Order Btn Border', 'OBPress_SpecialOffersList' ),
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '1',
							'bottom' => '1',
							'left' => '1',
							'isLinked' => true,
						],
					],
					'color' => [
						'default' => '#191919',
					],
				],
				'selector' => '.rooms .obpress-chain-results-button',
			]
		);

		$this->add_control(
			'obpress_order_button_border_hover_color',
			[
				'label' => __('Order Btn Hover Border Color', 'OBPress_SpecialOffersList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#191919',
				'selectors' => [
					'.rooms .obpress-chain-results-button:hover' => 'border-color: {{obpress_order_button_border_hover_color}}'
				],
			]
		);

		$this->add_control(
			'obpress_order_button_color',
			[
				'label' => __('Order Btn Color', 'OBPress_SpecialOffersList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#191919',
				'selectors' => [
					'.rooms .obpress-chain-results-button' => 'color: {{obpress_order_button_color}}',
					'.rooms .obpress-chain-results-button path' => 'fill: {{obpress_order_button_color}}',
					'.rooms .obpress-chain-results-button  line' => 'stroke: {{obpress_order_button_color}}'
				],
			]
		);

		$this->add_control(
			'obpress_order_button_hover_color',
			[
				'label' => __('Order Btn Hover Color', 'OBPress_SpecialOffersList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#fff',
				'selectors' => [
					'.rooms .obpress-chain-results-button:hover' => 'color: {{obpress_order_button_color}}',
					'.rooms .obpress-chain-results-button:hover path' => 'fill: {{obpress_order_button_color}}',
					'.rooms .obpress-chain-results-button:hover line' => 'stroke: {{obpress_order_button_color}}'
				],
			]
		);

		$this->add_control(
			'obpress_order_button_hover_Transition',
			[
				'label' => __( 'Order Transition Duration', 'OBPress_SpecialOffersList' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'.rooms .obpress-chain-results-button, .rooms .obpress-chain-results-button path, .rooms .obpress-chain-results-button  line' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_responsive_control(
			'obpress_order_button_width',
			[
				'label' => __( 'Order Btn Width', 'OBPress_SpecialOffersList' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'size' => 138,
				],
				'mobile_default' => [
					'size' => 138,
				],
				'range' => [
					'px' => [
						'max' => 500,
						'min' => 10,
						'step' => 1,
					]
				],
				'render_type' => 'ui',
				'selectors' => [
					'.rooms .obpress-chain-results-button' => 'min-width: {{SIZE}}px',
				],
			]
		);

		$this->add_responsive_control(
			'obpress_order_button_height',
			[
				'label' => __( 'Order Btn Height', 'OBPress_SpecialOffersList' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'size' => 40,
				],
				'mobile_default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'max' => 100,
						'min' => 10,
						'step' => 1,
					]
				],
				'render_type' => 'ui',
				'selectors' => [
					'.rooms .obpress-chain-results-button' => 'height: {{SIZE}}px',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'package_main_section',
			[
				'label' => __('Package Main Style Section', 'OBPress_RoomsList'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'package_rooms_direction_select',
			[
				'label' => esc_html__( 'Package Column View', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'OBPress_RoomsList' ),
				'label_off' => esc_html__( 'Off', 'OBPress_RoomsList' ),
				'return_value' => 'column',
				'default' => '',
			]
		);

        $this->add_responsive_control(
			'package_room_width',
			[
				'label' => __( 'Room Width', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'size' => 100,
				],
				'mobile_default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'max' => 100,
                        'min' => 1,
						'step' => 1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'.rooms .rooms-per-hotel.column .room-card' => 'width: {{SIZE}}%',
				],
                'condition' => [
					'package_rooms_direction_select' => 'column',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'package_main_title_typography',
				'label' => __('Main Title Typography', 'OBPress_RoomsList'),
				'selector' => '.rooms .rooms_header_message',
				'fields_options' => [
					'typography' => [
						'default' => 'yes'
					],
					'font_family' => [
						'default' => 'Montserrat',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '24',
						],
					],
					'font_weight' => [
						'default' => '700',
					],
				],
			]
		);

		$this->add_control(
			'package_main_title_color',
			[
				'label' => __('Main Title Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#000',
				'selectors' => [
					'.rooms .rooms_header_message' => 'color: {{package_main_title_color}}'
				],
			]
		);

		$this->add_responsive_control(
			'package_main_title_margin',
			[
				'label' => __( 'Main Title Margin', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '20',
					'right' => '0',
					'bottom' => '25',
					'left' => '0',
					'isLinked' => false
				],
				'mobile_default' => [
					'top' => '20',
					'right' => '0',
					'bottom' => '25',
					'left' => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms .rooms_header_message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'package_hotel_name_typography',
				'label' => __('Hotel Name Typography', 'OBPress_RoomsList'),
				'selector' => '.rooms .hotel_name',
				'fields_options' => [
					'typography' => [
						'default' => 'yes'
					],
					'font_family' => [
						'default' => 'Montserrat',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '20',
						],
					],
					'font_weight' => [
						'default' => '700',
					],
				],
			]
		);

		$this->add_control(
			'package_hotel_name_color',
			[
				'label' => __('Hotel Name Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#000',
				'selectors' => [
					'.rooms .hotel_name' => 'color: {{package_hotel_name_color}}'
				],
			]
		);

		$this->add_responsive_control(
			'package_hotel_name_margin',
			[
				'label' => __( 'Hotel Name Margin', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '50',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => false
				],
				'mobile_default' => [
					'top' => '50',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms .hotel_name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'package_cards_section',
			[
				'label' => __('Package Cards Style', 'OBPress_RoomsList'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'package_cards_margin',
			[
				'label' => __( 'Cards Margin', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '29',
					'right' => '0',
					'bottom' => '29',
					'left' => '0',
					'isLinked' => false
				],
				'mobile_default' => [
					'top' => '29',
					'right' => '0',
					'bottom' => '29',
					'left' => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms .room-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'package_cards_box_shadow',
				'label' => esc_html__( 'Cards Box Shadow', 'OBPress_RoomsList' ),
				'selector' => '{{WRAPPER}} .rooms .room-card',
				'fields_options' => [
					'box_shadow_type' => [ 
						'default' =>'yes' 
					],
					'box_shadow' => [
						'default' =>[
							'horizontal' => 0,
							'vertical' => 3,
							'blur' => 15,
							'color' => '#00000029'
						]
					]
				]
			]
		);

        $this->add_control(
			'package_rooms_cards_direction',
			[
				'label' => esc_html__( 'Cards Column View', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'OBPress_RoomsList' ),
				'label_off' => esc_html__( 'Off', 'OBPress_RoomsList' ),
				'return_value' => 'column',
				'default' => '',
			]
		);

        $this->add_responsive_control(
			'package_room_cards_image_height',
			[
				'label' => __( 'Image Height', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'size' => 248,
				],
				'mobile_default' => [
					'size' => 248,
				],
				'range' => [
					'px' => [
						'max' => 500,
                        'min' => 100,
						'step' => 1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'.rooms .room-card.column .room-card-img' => 'height: {{SIZE}}px',
				],
                'condition' => [
					'package_rooms_cards_direction' => 'column',
				],
			]
		);

        $this->add_responsive_control(
			'package_room_cards_info_height',
			[
				'label' => __( 'Cards Info Height', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'size' => 248,
				],
				'mobile_default' => [
					'size' => 248,
				],
				'range' => [
					'px' => [
						'max' => 500,
                        'min' => 100,
						'step' => 1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'.rooms .room-card.column .room-card-body' => 'height: {{SIZE}}px',
				],
                'condition' => [
					'package_rooms_cards_direction' => 'column',
				],
			]
		);

        $this->add_control(
			'package_cards_ribbon_bg_color',
			[
				'label' => __('Ribbon Background Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#82B789',
				'selectors' => [
					'.rooms .ribbon .text' => 'background-color: {{package_cards_ribbon_bg_color}}',
                    '.rooms .ribbon .text:before' => 'border-top-color: {{package_cards_ribbon_bg_color}}'
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'package_cards_ribbon_box_shadow',
				'label' => esc_html__( 'Ribbon Box Shadow', 'OBPress_RoomsList' ),
				'selector' => '{{WRAPPER}} .rooms .ribbon .text',
				'fields_options' => [
					'box_shadow_type' => [ 
						'default' =>'yes' 
					],
					'box_shadow' => [
						'default' =>[
							'horizontal' => 0,
							'vertical' => 0,
							'blur' => 24,
							'color' => '#0000004f'
						]
					]
				]
			]
		);

        $this->add_responsive_control(
			'package_cards_ribbon_padding',
			[
				'label' => __( 'Ribbon Padding', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '10',
					'right' => '26',
					'bottom' => '10',
					'left' => '26',
					'isLinked' => false
				],
				'mobile_default' => [
					'top' => '10',
					'right' => '26',
					'bottom' => '10',
					'left' => '26',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms .ribbon .text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'package_cards_ribbon_typography',
				'label' => __('Ribbon Typography', 'OBPress_RoomsList'),
				'selector' => '.rooms .ribbon .text',
				'fields_options' => [
					'typography' => [
						'default' => 'yes'
					],
					'font_family' => [
						'default' => 'Montserrat',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '16',
						],
					],
					'font_weight' => [
						'default' => '500',
					],
				],
			]
		);

        $this->add_control(
			'package_cards_ribbon_color',
			[
				'label' => __('Ribbon Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#fff',
				'selectors' => [
					'.rooms .ribbon .text' => 'color: {{package_cards_ribbon_color}}'
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'package_cards_pay_up_to_typography',
				'label' => __('Pay Up To Typography', 'OBPress_RoomsList'),
				'selector' => '.rooms .room-card .MaxPartialPaymentParcel',
				'fields_options' => [
					'typography' => [
						'default' => 'yes'
					],
					'font_family' => [
						'default' => 'Montserrat',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '12',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
				],
			]
		);

        $this->add_control(
			'package_cards_pay_up_to_color',
			[
				'label' => __('Pay Up To Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#fff',
				'selectors' => [
					'.rooms .room-card .MaxPartialPaymentParcel' => 'color: {{package_cards_pay_up_to_color}}'
				],
			]
		);

        $this->add_control(
			'package_cards_pay_up_to_bg_color',
			[
				'label' => __('Pay Up To Background Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#000',
				'selectors' => [
					'.rooms .room-card .MaxPartialPaymentParcel' => 'background-color: {{package_cards_pay_up_to_bg_color}}'
				],
			]
		);

        $this->add_responsive_control(
			'package_cards_pay_up_to_padding',
			[
				'label' => __( 'Pay Up To Padding', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '5',
					'right' => '10',
					'bottom' => '6',
					'left' => '8',
					'isLinked' => false
				],
				'mobile_default' => [
					'top' => '5',
					'right' => '10',
					'bottom' => '6',
					'left' => '8',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms .room-card .MaxPartialPaymentParcel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'package_cards_info_section',
			[
				'label' => __('Package Cards Info Part Style', 'OBPress_RoomsList'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'package_cards_info_bg_color',
			[
				'label' => __('Background Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#fff',
				'selectors' => [
					'.rooms .room-card-body' => 'background-color: {{package_cards_info_bg_color}}'
				],
			]
		);

        $this->add_responsive_control(
			'package_cards_info_padding',
			[
				'label' => __( 'Padding', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '19',
					'right' => '27',
					'bottom' => '22',
					'left' => '23',
					'isLinked' => false
				],
				'mobile_default' => [
					'top' => '19',
					'right' => '27',
					'bottom' => '22',
					'left' => '23',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms .room-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'package_cards_room_name_typography',
				'label' => __('Room Name Typography', 'OBPress_RoomsList'),
				'selector' => '.rooms .room-card-title',
				'fields_options' => [
					'typography' => [
						'default' => 'yes'
					],
					'font_family' => [
						'default' => 'Montserrat',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '20',
						],
					],
					'font_weight' => [
						'default' => '700',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '24',
						],
					],
				],
			]
		);

        $this->add_control(
			'package_cards_info_room_name_color',
			[
				'label' => __('Room Name Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#000',
				'selectors' => [
					'.rooms .room-card-title' => 'color: {{package_cards_info_bg_color}}'
				],
			]
		);

        $this->add_responsive_control(
			'package_cards_info_room_name_margin',
			[
				'label' => __( 'Room Name Margin', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '12',
					'left' => '0',
					'isLinked' => false
				],
				'mobile_default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '12',
					'left' => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms .room-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'package_cards_info_room_name_alignment',
			[
				'label' => __( 'Room Name Alignment', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'devices' => [ 'desktop', 'mobile' ],
				'options' => [
					'left' => [
						'title' => __( 'Left', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'desktop_default' => 'left',
				'mobile_default' => 'left',
				'selectors' => [
					'.rooms .room-card-title' => 'text-align: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'package_cards_info_hotel_name_typography',
				'label' => __('Hotel Name Typography', 'OBPress_RoomsList'),
				'selector' => '.rooms .room-card-hotel-name',
				'fields_options' => [
					'typography' => [
						'default' => 'yes'
					],
					'font_family' => [
						'default' => 'Montserrat',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '14',
						],
					],
					'font_weight' => [
						'default' => '700',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '18',
						],
					],
				],
			]
		);

        $this->add_control(
			'package_cards_info_hotel_name_color',
			[
				'label' => __('Hotel Name Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#000',
				'selectors' => [
					'.rooms .room-card-hotel-name' => 'color: {{package_cards_info_bg_color}}'
				],
			]
		);

        $this->add_responsive_control(
			'package_cards_info_hotel_name_margin',
			[
				'label' => __( 'Hotel Name Margin', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '12',
					'left' => '0',
					'isLinked' => false
				],
				'mobile_default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '12',
					'left' => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms .room-card-hotel-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'package_cards_info_hotel_name_alignment',
			[
				'label' => __( 'Hotel Name Alignment', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'devices' => [ 'desktop', 'mobile' ],
				'options' => [
					'left' => [
						'title' => __( 'Left', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'desktop_default' => 'left',
				'mobile_default' => 'left',
				'selectors' => [
					'.rooms .room-card-hotel-name' => 'text-align: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'package_cards_info_address_typography',
				'label' => __('Address Typography', 'OBPress_RoomsList'),
				'selector' => '.rooms .room-card-hotel-address',
				'fields_options' => [
					'typography' => [
						'default' => 'yes'
					],
					'font_family' => [
						'default' => 'Montserrat',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '12',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '15',
						],
					],
				],
			]
		);

        $this->add_control(
			'package_cards_info_address_color',
			[
				'label' => __('Address Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#000',
				'selectors' => [
					'.rooms .room-card-hotel-address' => 'color: {{package_cards_info_address_color}}'
				],
			]
		);

        $this->add_responsive_control(
			'package_cards_info_address_alignment',
			[
				'label' => __( 'Address Alignment', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'devices' => [ 'desktop', 'mobile' ],
				'options' => [
					'left' => [
						'title' => __( 'Left', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'desktop_default' => 'left',
				'mobile_default' => 'left',
				'selectors' => [
					'.rooms .room-card-hotel-address' => 'text-align: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'package_cards_info_divider_border',
				'label' => __( 'Divider Border', 'OBPress_RoomsList' ),
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width' => [
						'default' => [
							'top' => '0',
							'right' => '0',
							'bottom' => '1',
							'left' => '0',
							'isLinked' => true,
						],
					],
					'color' => [
						'default' => '#E6E6E6',
					],
				],
				'selector' => '.rooms .room-card-body-top',
			]
		);

        
        $this->add_responsive_control(
			'package_cards_info_divide_padding',
			[
				'label' => __( 'Divider Padding', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '18',
					'left' => '0',
					'isLinked' => false
				],
				'mobile_default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '18',
					'left' => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms .room-card-body-top' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'package_cards_info_description_typography',
				'label' => __('Description Typography', 'OBPress_RoomsList'),
				'selector' => '.rooms .room-card-text-desktop',
				'fields_options' => [
					'typography' => [
						'default' => 'yes'
					],
					'font_family' => [
						'default' => 'Montserrat',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '14',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '20',
						],
					],
				],
			]
		);

        $this->add_control(
			'package_cards_info_description_color',
			[
				'label' => __('Description Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#2C2F33',
				'selectors' => [
					'.rooms .room-card-text-desktop' => 'color: {{package_cards_info_description_color}}'
				],
			]
		);

        $this->add_responsive_control(
			'package_cards_info_description_margin',
			[
				'label' => __( 'Description Margin', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '18',
					'right' => '0',
					'bottom' => '18',
					'left' => '0',
					'isLinked' => false
				],
				'mobile_default' => [
					'top' => '18',
					'right' => '0',
					'bottom' => '18',
					'left' => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms .room-card-text-desktop' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'package_cards_info_description_alignment',
			[
				'label' => __( 'Description Alignment', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'devices' => [ 'desktop', 'mobile' ],
				'options' => [
					'left' => [
						'title' => __( 'Left', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'desktop_default' => 'left',
				'mobile_default' => 'left',
				'selectors' => [
					'.rooms .room-card-text-desktop' => 'text-align: {{VALUE}}',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'package_cards_info_price_and_button_section',
			[
				'label' => __('Price And Button Style', 'OBPress_RoomsList'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'package_cards_info_price_and_button_justify_content',
			[
				'label' => __( 'Price Button Horizontal Align', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => 'space-between',
				'mobile_default' => 'space-between',
				'options' => [
					'space-between'  => __( 'Space Between', 'OBPress_RoomsList' ),
					'space-around'  => __( 'Space Around', 'OBPress_RoomsList' ),
					'space-evenly'  => __( 'Space Evenly', 'OBPress_RoomsList' ),
					'center' => __( 'Center', 'OBPress_RoomsList' ),
					'flex-end'  => __( 'Flex End', 'OBPress_RoomsList' ),
					'flex-start'  => __( 'Flex Start', 'OBPress_RoomsList' ),
				],
				'selectors' => [
					'.rooms .price-and-button-holder' => 'justify-content: {{package_cards_info_price_and_button_justify_content}}'
				],
			]
		);

        $this->add_responsive_control(
			'package_cards_info_price_and_button_align_items',
			[
				'label' => __( 'Price Button Vertical Align', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => 'flex-end',
				'mobile_default' => 'flex-end',
				'options' => [
					'flex-end'  => __( 'Bottom', 'OBPress_RoomsList' ),
					'flex-start'  => __( 'Top', 'OBPress_RoomsList' ),
					'center'  => __( 'Center', 'OBPress_RoomsList' ),
				],
				'selectors' => [
					'.rooms .price-and-button-holder' => 'align-items: {{releted_rooms_cards_room_price_button_align_items}}'
				],
			]
		);
        
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'package_cards_info_price_text_typography',
				'label' => __('Price Text Typography', 'OBPress_RoomsList'),
				'selector' => '.rooms .price-text',
				'fields_options' => [
					'typography' => [
						'default' => 'yes'
					],
					'font_family' => [
						'default' => 'Montserrat',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '14',
						],
					],
					'font_weight' => [
						'default' => '700',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '18',
						],
					],
				],
			]
		);

        $this->add_control(
			'package_cards_info_price_text_color',
			[
				'label' => __('Price Text Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#000',
				'selectors' => [
					'.rooms .price-text' => 'color: {{package_cards_info_price_text_color}}'
				],
			]
		);

        $this->add_responsive_control(
			'package_cards_info_price_text_margin',
			[
				'label' => __( 'Price Text Margin', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '5',
					'left' => '0',
					'isLinked' => false
				],
				'mobile_default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '5',
					'left' => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms .price-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'package_cards_info_price_text_alignment',
			[
				'label' => __( 'Price Text Alignment', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'devices' => [ 'desktop', 'mobile' ],
				'options' => [
					'left' => [
						'title' => __( 'Left', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'OBPress_RoomsList' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'desktop_default' => 'left',
				'mobile_default' => 'left',
				'selectors' => [
					'.rooms .price-text' => 'text-align: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'package_cards_info_price_typography',
				'label' => __('Price Typography', 'OBPress_RoomsList'),
				'selector' => '.rooms .price',
				'fields_options' => [
					'typography' => [
						'default' => 'yes'
					],
					'font_family' => [
						'default' => 'Montserrat',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '24',
						],
					],
					'font_weight' => [
						'default' => '700',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '24',
						],
					],
				],
			]
		);

        $this->add_control(
			'package_cards_info_price_color',
			[
				'label' => __('Price Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#BEAD8E',
				'selectors' => [
					'.rooms .price' => 'color: {{package_cards_info_price_color}}'
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'package_cards_info_price_dec_and_curr_typography',
				'label' => __('Curr And Dec Typography', 'OBPress_RoomsList'),
				'selector' => '.rooms .price .currency_symbol_price, .rooms .price .decimal_value_price',
				'fields_options' => [
					'typography' => [
						'default' => 'yes'
					],
					'font_family' => [
						'default' => 'Montserrat',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '20',
						],
					],
					'font_weight' => [
						'default' => '700',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '24',
						],
					],
				],
			]
		);

        $this->add_responsive_control(
			'package_cards_info_button_padding',
			[
				'label' => __( 'Button Padding', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '11',
					'right' => '33',
					'bottom' => '11',
					'left' => '33',
					'isLinked' => false
				],
				'mobile_default' => [
					'top' => '11',
					'right' => '33',
					'bottom' => '11',
					'left' => '33',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms .room-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'package_cards_info_button_border_radius',
			[
				'label' => __( 'Button Border Radius', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'devices' => [ 'desktop', 'mobile' ],
				'desktop_default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true
				],
				'mobile_default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.rooms .room-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'package_cards_info_button_bg_color',
			[
				'label' => __('Button Background Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#191919',
				'selectors' => [
					'.rooms .room-button' => 'background-color: {{package_cards_info_button_bg_color}}'
				],
			]
		);

		$this->add_control(
			'package_cards_info_button_color',
			[
				'label' => __('Button Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#fff',
				'selectors' => [
					'.rooms .room-button' => 'color: {{package_cards_info_button_color}}'
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'package_cards_info_button_border',
				'label' => __( 'Order Btn Border', 'OBPress_SpecialOffersList' ),
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '1',
							'bottom' => '1',
							'left' => '1',
							'isLinked' => true,
						],
					],
					'color' => [
						'default' => '#191919',
					],
				],
				'selector' => '.rooms .room-button',
			]
		);

		$this->add_control(
			'package_cards_info_button_border_hover_color',
			[
				'label' => __('Button Border Hover Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#191919',
				'selectors' => [
					'.rooms .room-button' => 'border-color: {{package_cards_info_button_border_hover_color}}'
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'package_cards_info_button_typography',
				'label' => __('Button Typography', 'OBPress_RoomsList'),
				'selector' => '.rooms .room-button',
				'fields_options' => [
					'typography' => [
						'default' => 'yes'
					],
					'font_family' => [
						'default' => 'Montserrat',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '14',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '18',
						],
					],
				],
			]
		);

		$this->add_control(
			'package_cards_info_button_bg_hover_color',
			[
				'label' => __('Button Hover Background Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#fff',
				'selectors' => [
					'.rooms .room-button:hover' => 'background-color: {{package_cards_info_button_bg_hover_color}}'
				],
			]
		);

		$this->add_control(
			'package_cards_info_button_hover_color',
			[
				'label' => __('Button Hover Color', 'OBPress_RoomsList'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'input_type' => 'color',
				'default' => '#191919',
				'selectors' => [
					'.rooms .room-button:hover' => 'color: {{package_cards_info_button_hover_color}}'
				],
			]
		);

        $this->add_control(
			'package_cards_info_button_transition',
			[
				'label' => __( 'Transition Duration', 'OBPress_RoomsList' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'.rooms .room-button' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

        $this->end_controls_section();
	}

	protected function render()
	{
		//NEW CODE
		ini_set("xdebug.var_display_max_children", '-1');
		ini_set("xdebug.var_display_max_data", '-1');
		ini_set("xdebug.var_display_max_depth", '-1');

		require_once(WP_CONTENT_DIR . '/plugins/obpress_plugin_manager/BeApi/BeApi.php');
		require_once(WP_PLUGIN_DIR . '/obpress_plugin_manager/class-lang-curr-functions.php');
		new Lang_Curr_Functions();
		Lang_Curr_Functions::chainOrHotel($id);

		$settings_so = $this->get_settings_for_display();
		$chain = get_option('chain_id');

		$languages = Lang_Curr_Functions::getLanguagesArray();
		$language = Lang_Curr_Functions::getLanguage();
		$language_object = Lang_Curr_Functions::getLanguageObject();        
		$currencies = Lang_Curr_Functions::getCurrenciesArray();
		$currency = Lang_Curr_Functions::getCurrency();

		foreach ($currencies as $currency_from_api) {
			if ($currency_from_api->UID == $currency) {
				$currency_string = $currency_from_api->CurrencySymbol;
				break;
			}
		}

        $hotels_in_chain = [];
        $hotels = BeApi::ApiCache('hotel_search_chain_'.$chain.'_'.$language.'_true', BeApi::$cache_time['hotel_search_chain'], function() use ($chain, $language){
            return BeApi::getHotelSearchForChain($chain, "true",$language);
        });

        foreach($hotels->PropertiesType->Properties as $Property) {
            $hotels_in_chain[$Property->HotelRef->HotelCode]["HotelCode"] = $Property->HotelRef->HotelCode;
            $hotels_in_chain[$Property->HotelRef->HotelCode]["HotelName"] = $Property->HotelRef->HotelName;
            $hotels_in_chain[$Property->HotelRef->HotelCode]["ChainName"] = $Property->HotelRef->ChainName;
            $hotels_in_chain[$Property->HotelRef->HotelCode]["Country"] = $Property->Address->CountryCode;
            $hotels_in_chain[$Property->HotelRef->HotelCode]["City"] = $Property->Address->CityCode;
            $hotels_in_chain[$Property->HotelRef->HotelCode]["StateProvCode"] = $Property->Address->StateProvCode;
            $hotels_in_chain[$Property->HotelRef->HotelCode]["AddressLine"] = $Property->Address->AddressLine;
            $hotels_in_chain[$Property->HotelRef->HotelCode]["Latitude"] = $Property->Position->Latitude;
            $hotels_in_chain[$Property->HotelRef->HotelCode]["Longitude"] = $Property->Position->Longitude;
            $hotels_in_chain[$Property->HotelRef->HotelCode]["MaxPartialPaymentParcel"] = $Property->MaxPartialPaymentParcel;
        }



		$descriptive_infos = BeApi::ApiCache('descriptive_infos_'.$chain.'_'.$language, BeApi::$cache_time['descriptive_infos'], function() use($hotels_in_chain, $language){
			return BeApi::getHotelDescriptiveInfos($hotels_in_chain, $language);
		});

		$rooms = [];

		foreach($descriptive_infos->HotelDescriptiveContentsType->HotelDescriptiveContents as $HotelDescriptiveContent) {
			foreach($HotelDescriptiveContent->FacilityInfo->GuestRoomsType->GuestRooms as $GuestRoom) {
				$rooms[$HotelDescriptiveContent->HotelRef->HotelCode][$GuestRoom->ID] = $GuestRoom;
			}
		}

		// var_dump($rooms);
		// die;

        // $available_packages = BeApi::ApiCache('available_packages_'.$chain.'_'.$currency.'_'.$language.'_'.$mobile, BeApi::$cache_time['available_packages'], function() use ($chain, $currency, $language, $mobile){
        //     return BeApi::getClientAvailablePackages($chain, $currency, $language, null, $mobile);
        // });

        // function sortByPrice($param1, $param2) {
		//     return strcmp($param1->Total->AmountBeforeTax, $param2->Total->AmountBeforeTax);
		// }

		// $hotels_from_packages = [];
        // //sort packages by price
        // if(isset($available_packages->RoomStaysType) && $available_packages->RoomStaysType != null) {
        //     foreach($available_packages->RoomStaysType->RoomStays as $RoomStay) {
        //         $RoomRates = $RoomStay->RoomRates;
        //         usort($RoomRates, "sortByPrice");
        //         $RoomStay->RoomRates = $RoomRates;
        //         $hotels_from_packages[] = $RoomStay->BasicPropertyInfo->HotelRef->HotelCode;
        //     }
        // }
        // $hotels_from_packages = array_unique($hotels_from_packages);

        // $rateplans = [];
        // $package_offers = [];
        // $rateplans_per_hotel = [];

        // if(isset($available_packages->RoomStaysType) && $available_packages->RoomStaysType != null) {
            
        //     foreach ($hotels_from_packages as $hotel_from_packages) {
        //         $rateplans[] = BeApi::ApiCache('rateplans_array_'.$hotel_from_packages.'_'.$language, BeApi::$cache_time['rateplans_array'], function() use ($hotel_from_packages, $language){
        //             return BeApi::getHotelRatePlans($hotel_from_packages, $language);
        //         });
        //     }


        //     foreach ($rateplans as $rateplan) {
        //         if($rateplan->RatePlans != null) {
        //             foreach ($rateplan->RatePlans->RatePlan as $RatePlan) {
        //                 if ($RatePlan->RatePlanTypeCode == 11) {
        //                     $rateplans_per_hotel[$rateplan->RatePlans->HotelRef->HotelCode][$RatePlan->RatePlanID] = $RatePlan;
        //                 }
        //             }
        //         }
        //     }
                
        //     foreach ($available_packages->RoomStaysType->RoomStays as $RoomStay) {
        //         foreach ($RoomStay->RoomRates as $RoomRate) {
        //             $package_offers[$RoomStay->BasicPropertyInfo->HotelRef->HotelCode][$RoomRate->RatePlanID]["room_rate"] = $RoomRate;
        //         }
        //         foreach ($RoomStay->RatePlans as $RatePlan) {
        //             $package_offers[$RoomStay->BasicPropertyInfo->HotelRef->HotelCode][$RatePlan->RatePlanID]["rate_plan"] = $RatePlan;
        //         }  
        //     }

        //     if($available_packages->TPA_Extensions != null) {
        //         foreach ($available_packages->TPA_Extensions->MultimediaDescriptionsType->MultimediaDescriptions as  $MultimediaDescription) {
        //             foreach ($package_offers as $hotel_code => $package_offer) {
        //                 foreach ($package_offer as $rate_plan_code => $offer) {
        //                     if ($MultimediaDescription->ID == $rate_plan_code) {
        //                         $package_offers[$hotel_code][$rate_plan_code]["image"] = $MultimediaDescription;
        //                     }
        //                 }
        //             }
        //         }
        //     }

        //     foreach ($package_offers as $hotel_code => $package_offer) {
        //         foreach ($package_offer as $rate_plan_code => $offer) {
        //             foreach ($rateplans_per_hotel as $hotel_code2 => $per_hotel) {
        //                 foreach ($per_hotel as $rate_plan_code2 => $rateplan) {
        //                     if($rate_plan_code2 == $rate_plan_code) {

        //                         $package_offers[$hotel_code][$rate_plan_code]["get_rate_plans"] = $rateplan;

        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }

        $plugin_directory_path = plugins_url( '', __FILE__ );


		require_once(WP_PLUGIN_DIR . '/OBPress_RoomsList/widget/assets/templates/template.php');
	}
}
