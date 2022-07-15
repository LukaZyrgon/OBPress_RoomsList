<div class="rooms">
    <?php if($rooms != null): ?>
        <div class="search-and-order">
            <input type="text" id="search-input" placeholder="Search by keyword, hotel or destination" class="btn-ic">
            <button class="obpress-chain-results-button order-button obpress-secundary-btn" data-bs-toggle="modal" data-bs-target="#ordenar">
                <svg xmlns="http://www.w3.org/2000/svg" width="16.707" height="12.375" viewBox="0 0 16.707 12.375">
                    <g id="ordination" transform="translate(-11.176 -13.984)">
                        <g id="Grupo_9729" data-name="Grupo 9729" transform="translate(12.383 14.485)">
                        <path id="Caminho_10311" data-name="Caminho 10311" d="M-397.586,269.174l2.859,2.859,2.859-2.859Z" transform="translate(397.586 -260.864)" stroke="rgba(0,0,0,0)" stroke-width="1"/>
                        <line id="Linha_1740" data-name="Linha 1740" x2="9.877" transform="translate(5.123)" fill="none" stroke="#000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="1"/>
                        <line id="Linha_1741" data-name="Linha 1741" y1="10.278" transform="translate(2.859)" fill="none" stroke="#000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="1"/>
                        <line id="Linha_1742" data-name="Linha 1742" x2="7.527" transform="translate(7.473 3.526)" fill="none" stroke="#000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="1"/>
                        <line id="Linha_1743" data-name="Linha 1743" x2="5.176" transform="translate(9.824 7.052)" fill="none" stroke="#000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="1"/>
                        <line id="Linha_1744" data-name="Linha 1744" x2="2.825" transform="translate(12.175 10.578)" fill="none" stroke="#000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="1"/>
                        </g>
                    </g>
                </svg>
                <?php _e('Order', 'OBPress_RoomsList') ?>
            </button>
        </div>
        <div class="rooms_header_message"><?php _e('Discover', 'OBPress_RoomsList') ?> <?= count($hotels_in_chain) ?> <?php _e('Hilton hotels around the world!', 'OBPress_RoomsList') ?></div> 
        <?php foreach($rooms as $key => $rooms_per_hotel): ?>
            <?php 
                $roomId = $key;
            ?>
            <div class="rooms-per-hotel <?= $settings_so['package_order_direction_select']; ?>">
                <?php foreach($rooms_per_hotel as $room): ?>
                    <p class="hotel_name"><?= @$hotels_in_chain[$key]["HotelName"] ?></p>
                    <?php break; ?>
                <?php endforeach; ?>

                <?php foreach($rooms_per_hotel as $key => $room): ?>
                    <?php 
                        $description = $room->MultimediaDescriptionsType->MultimediaDescriptions[0]->TextItemsType->TextItems[0]->Description;
                        if(strstr($description, '<br/>')) {
                            if(strstr($description, '<br/><br/>')) {
                                $descriptionWithoutDoubleBr = str_replace('<br/><br/>', ': ', $description);
                            } 
                            $descriptionWithoutBr = str_replace('<br/>', ' ', $descriptionWithoutDoubleBr);
                        } else {
                            $descriptionWithoutBr = $description;
                        }
                    ?>
                    <div class="room-card <?= $settings_so['package_rooms_cards_direction']; ?>">

                        <?php if ($key === key($rooms_per_hotel)): ?>
                            <div class="room-card-best-price">
                                <p class="ribbon">
                                    <span class="text"><?php _e('Lowest price', 'OBPress_RoomsList') ?></span>
                                </p>
                            </div>
                        <?php endif; ?>

                        <?php if(@$hotels_in_chain[$roomId]["MaxPartialPaymentParcel"] != null): ?>
                            <div class="MaxPartialPaymentParcel" data-toggle="modal" data-target="#partial-modal-payment">
                                <?php _e('Pay up to', 'OBPress_RoomsList') ?> <span><?= @$hotels_in_chain[$roomId]["MaxPartialPaymentParcel"] ?>x</span>
                            </div>
                        <?php endif; ?>

                        <?php if(isset($room->MultimediaDescriptionsType->MultimediaDescriptions[1]->ImageItemsType->ImageItems[0]->URL->Address)): ?>
                            <img class="room-card-img" src="<?= $room->MultimediaDescriptionsType->MultimediaDescriptions[1]->ImageItemsType->ImageItems[0]->URL->Address?>" onError="this.onerror=null;this.src='/img/placeholderNewWhite.svg';" alt="<?=@$room->DescriptiveText?>">
                        <?php else: ?>
                            <img class="room-card-img" src="<?= $plugin_directory_path . '/assets/icons/placeholderNewWhite.svg' ?>" alt="promotion">
                        <?php endif; ?>

                        <div class="room-card-body">
                            <div class="room-card-body-top"> 
                                <a href="<?="/room/?room_id=".$room->ID ?>" class="room-card-title card-title-desktop"><?= substr($room->DescriptiveText, 0, 80) ?>
                                </a>
                                <?php if(@$hotels_in_chain[$roomId]["HotelName"] != null) : ?>
                                    <div class="room-card-hotel-name"><?= @$hotels_in_chain[$roomId]["HotelName"] ?></div>
                                <?php endif; ?>

                                <?php if(@$hotels_in_chain[$roomId]["AddressLine"] != null) : ?>
                                    <div class="room-card-hotel-address"><?= @$hotels_in_chain[$roomId]["AddressLine"] ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="room-card-body-bottom <?php if($descriptionWithoutBr == null) echo 'empty'; ?>">
                                <?php if($descriptionWithoutBr != null) : ?>
                                    <?php if(strlen($descriptionWithoutBr) > 140) : ?>
                                        <p class="room-card-text-desktop"><?= substr($descriptionWithoutBr, 0, 140) . "..." ?></p>
                                    <?php else : ?>
                                        <p class="room-card-text-desktop"><?= $descriptionWithoutBr; ?></p>
                                    <?php endif; ?>
                                    <?php if(strlen($descriptionWithoutBr) > 120) : ?>
                                        <p class="room-card-text-mobile"><?= substr($descriptionWithoutBr, 0, 120) . "..." ?></p>
                                    <?php else : ?>
                                        <p class="room-card-text-mobile"><?= $descriptionWithoutBr; ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div class="price-and-button-holder">
                                    <div class="price_holder">
                                        <span class="price-text"><?php _e('From', 'OBPress_RoomsList') ?></span> 
                                        <span class="price"><?= Lang_Curr_Functions::ValueAndCurrencyCultureV4(100, $currencies, $currency, $language) ?></span>
                                    </div>
                                    <a href="<?="/room/?room_id=".$room->ID ?>" class="room-button"><?php _e('See more', 'OBPress_RoomsList') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h1><?php _e('No rooms available', 'OBPress_RoomsList') ?></h1>
    <?php endif; ?>
</div>

<div class="modal hide" id="ordenar" tabindex="-1" aria-modal="true" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

          <p class="title"><?php _e('Order by:', 'OBPress_RoomsList') ?></p>

            <div class="close-modal" data-bs-dismiss="modal"> </div>

            <form class="order">

                <div>
                    <label for="most" id="folder" class="checked"> <span><span>✓</span></span><?php _e('By folder (default)', 'OBPress_RoomsList') ?></label>
                </div>

                <div>
                    <label for="least" id="date" class=""> <span><span>✓</span></span><?php _e('By date', 'OBPress_RoomsList') ?></label>
                </div>

                 <div>
                    <label for="least" id="price" class=""> <span><span>✓</span></span><?php _e('By price', 'OBPress_RoomsList') ?></label>
                </div>

            </form>


            <div class="modal-bottom">
                <span class="obpress-primary-link" data-bs-dismiss="modal"><?php _e('Clear', 'OBPress_RoomsList') ?></span>
                <div class="order-hotels obpress-primary-btn"><?php _e('Submit', 'OBPress_RoomsList') ?></div>
            </div> 


        </div>

    </div>

</div>

<div class="no-rooms">
    <img src="http://bev.test/icons/not_found.svg" alt="No results found" class="no-results-img">           
    <p class="no-results-text"><?php _e('No results found', 'OBPress_RoomsList') ?></p>
</div>