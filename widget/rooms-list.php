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
			'color_section',
			[
				'label' => __('Package Main Image Style', 'OBPress_RoomsList'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
