<div class="rooms">
    <?php if($rooms != null): ?>
        <div class="search-and-order">
            <input type="text" id="search-input" placeholder="Search by keyword, hotel or destination" class="btn-ic">
            <button class="obpress-chain-results-button order-button obpress-secundary-btn" data-bs-toggle="modal" data-bs-target="#ordenar">
                <?php _e('Order', 'OBPressTheme') ?>
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

          <p class="title">Order by:</p>

            <div class="close-modal" data-bs-dismiss="modal"> </div>

            <form class="order">

                <div>
                    <label for="most" id="folder" class="checked"> <span><span>✓</span></span>By folder (default)</label>
                </div>

                <div>
                    <label for="least" id="date" class=""> <span><span>✓</span></span>By date</label>
                </div>

                 <div>
                    <label for="least" id="price" class=""> <span><span>✓</span></span>By price</label>
                </div>

            </form>


            <div class="modal-bottom">
                <span class="obpress-primary-link" data-bs-dismiss="modal">Clear</span>
                <div class="order-hotels obpress-primary-btn">Submit</div>
            </div> 


        </div>

    </div>

</div>

<div class="no-rooms">
    <img src="http://bev.test/icons/not_found.svg" alt="No results found" class="no-results-img">           
    <p class="no-results-text">No results found</p>
</div>