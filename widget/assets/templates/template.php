<div class="rooms">
    <?php if($rooms != null): ?>
        <div class="rooms_header_message">Conheça <?= count($hotels_in_chain) ?> hotéis da rede Hilton ao redor do mundo!</div>
        <?php foreach($rooms as $key => $rooms_per_hotel): ?>
            <div class="rooms-per-hotel">
                <?php foreach($rooms_per_hotel as $room): ?>
                    <p class="hotel_name"><?= @$hotels_in_chain[$key]["HotelName"] ?></p>
                    <?php break; ?>
                <?php endforeach; ?>

                <?php foreach($rooms_per_hotel as $key => $room): ?>
                    <div class="room-card">

                        <?php if ($key === key($rooms_per_hotel)): ?>
                            <div class="room-card-best-price">
                                <p class="ribbon">
                                    <span class="text">Menor preço</span>
                                </p>
                            </div>
                        <?php endif; ?>

                        <?php if(@$hotels_in_chain[$key]["MaxPartialPaymentParcel"] != null): ?>
                            <div class="MaxPartialPaymentParcel" data-toggle="modal" data-target="#partial-modal-payment">
                                Pay up to <span><?= @$hotels_in_chain[$key]["MaxPartialPaymentParcel"] ?>x</span>
                            </div>
                        <?php endif; ?>

                        <?php if(isset($room->MultimediaDescriptionsType->MultimediaDescriptions[1]->ImageItemsType->ImageItems[0]->URL->Address)): ?>
                            <img class="room-card-img" src="<?= $room->MultimediaDescriptionsType->MultimediaDescriptions[1]->ImageItemsType->ImageItems[0]->URL->Address?>" onError="this.onerror=null;this.src='/img/placeholderNewWhite.svg';" alt="<?=@$room->DescriptiveText?>">
                        <?php else: ?>
                            <img class="room-card-img" src="<?= $plugin_directory_path . '/assets/icons/placeholderNewWhite.svg' ?>" alt="promotion">
                        <?php endif; ?>

                        <div class="room-card-body">
                            <div class="room-card-body-top"> 
                                <a href="/chain/<?=$chain?>/room/<?=$room->ID ?>" class="room-card-title card-title-desktop"><?= substr($room->DescriptiveText, 0, 80) ?>
                                </a>
                                <div class="room-card-hotel-name"><?= @$hotels_in_chain[$key]["HotelName"] ?></div>

                                <div class="room-card-hotel-address"><?= @$hotels_in_chain[$key]["AddressLine"] ?></div>
                            </div>

                            <div class="room-card-body-bottom">
                                <p class="room-card-text-desktop"><?= substr($room->MultimediaDescriptionsType->MultimediaDescriptions[0]->TextItemsType->TextItems[0]->Description, 0, 140) . "..." ?></p>
                                <p class="room-card-text-mobile"><?= substr($room->MultimediaDescriptionsType->MultimediaDescriptions[0]->TextItemsType->TextItems[0]->Description, 0, 60) . "..." ?></p>

                                <div class="price-and-button-holder">
                                    <div class="price_holder">
                                        <span class="price-text">A partir de</span> 
                                        <span class="price"><?= Lang_Curr_Functions::ValueAndCurrencyCultureV4(100, $currencies, $currency, $language) ?></span>
                                    </div>
                                    <a href="<?="/room/?room_id=".$room->ID ?>" class="room-button">Saber mais
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h1>No rooms available</h1>
    <?php endif; ?>
</div>