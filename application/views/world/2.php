<?php $this->load->view('header')?>
<link href="<?php echo base_url('css/world.css') ?>" rel="stylesheet">

<div class="game">
    <div class="top">
        <h1>cocobox</h1>
        <div class="menu">
            <a href="#" onclick="openToybox()"><img src="<?php echo base_url('img/toybox.png') ?>"></a>
            <a href="#" onclick="openShop()"><img src="<?php echo base_url('img/shop.png') ?>"></a>
            <a href="#" onclick="openTravel()"><img src="<?php echo base_url('img/move.png') ?>"></a>
        </div>
    </div>
    <div class="game-container">
        <div class="left">
            <div class="world dog-park" style="background: url('<?php echo base_url('img/dogpark/land.png') ?>')">
                <div class="pet-container" data-user-id="<?php echo $this->user->id ?>">
                    <img src="" class="hat">
                    <img src="" class="pet">
                </div>
                <?php foreach ($pets as $index => $otherpet): ?>
                    <div class="pet-container" data-user-id="<?php echo $otherpet->user_id ?>" style="top: -100px">
                        <img src="" class="hat">
                        <img src="" class="pet">
                    </div>
                <?php endforeach?>
                <img src="<?php echo base_url('img/dogpark/tree.png') ?>" class="dog-park-tree">
            </div>
        </div>
        <div class="right">
            <div class="chat">
                <div class="messages">
                    <div class="text-muted">Welcome to Cocobox!</div>
                    <?php foreach ($chat as $message): ?>
                        <div><b><?php echo $message->username ?></b>: <?php echo $message->message ?></div>
                    <?php endforeach?>
                </div>
                <div class="form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Message" name="message">
                        <div class="input-group-append">
                            <button type="button" class="input-group-text btn">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="window" id="shop">
    <div class="header float-left">Shop</div>
    <div class="close-window float-right" onclick="closeWindow(this)">x</div>
    <div class="inner" id="shop-home" style="display:block">
        <h3>Select a category</h3>
        <div class="icon-row">
            <a class="link" data-link="shop-hats"><div class="icon icon-lg">Hats</div></a>
            <a class="link" data-link="shop-trees"><div class="icon icon-lg">Trees</div></a>
        </div>
        <div class="icon-row">
            <a class="link" data-link="shop-beds"><div class="icon icon-lg">Beds</div></a>
            <a class="link" data-link="shop-land"><div class="icon icon-lg">Land</div></a>
        </div>
    </div>
    <div class="inner" id="shop-hats">
        <a class="link btn" data-link="shop-home">&laquo; Back</a>
        <h4>Hats</h4>
        <small>Fancy hats for your little pet.</small>
        <div class="icon-row">
        </div>
    </div>
    <div class="inner" id="shop-trees">
        <a class="link btn" data-link="shop-home">&laquo; Back</a>
        <h4>Trees</h4>
        <small>Decorate your land with a tree.</small>
        <div class="icon-row">
        </div>
    </div>
    <div class="inner" id="shop-beds">
        <a class="link btn" data-link="shop-home">&laquo; Back</a>
        <h4>Beds</h4>
        <small>Beds for your pet to rest on.</small>
        <div class="icon-row">
        </div>
    </div>
    <div class="inner" id="shop-land">
        <a class="link btn" data-link="shop-home">&laquo; Back</a>
        <h4>Land</h4>
        <small>Different environments for your pet.</small>
        <div class="icon-row">
        </div>
    </div>
    <div class="inner" id="product">
        <a class="link btn back" data-link=""></a>
        <div class="item-type">-</div>
        <h4 class="item-name">-</h4>
        <div class="item-desc">-</div>
        <div class="icon"><img src=""></div>
        <div>
            <img src="<?php echo base_url('img/loot/bean.png') ?>">
            <span class="item-price">-</span>
        </div>
        <a class="btn buy mt-2" onclick="buyItem()">Buy</a>
        <a class="btn owned mt-2 dim disabled">Owned</a>
        <div class="error"></div>
    </div>
</div>

<div class="window" id="toybox">
    <div class="header float-left">Toybox</div>
    <div class="close-window float-right" onclick="closeWindow(this)">x</div>
    <div class="inner" id="toybox-home" style="display:block">
        <div id="toybox-hats">
            <h4>Hats</h4>
            <div class="icon-row">
            </div>
        </div>
        <div id="toybox-trees">
            <h4>Trees</h4>
            <div class="icon-row">
            </div>
        </div>
        <div id="toybox-beds">
            <h4>Beds</h4>
            <div class="icon-row">
            </div>
        </div>
        <div id="toybox-land">
            <h4>Land</h4>
            <div class="icon-row">
            </div>
        </div>
    </div>
    <div class="inner" id="item">
        <a class="link btn" data-link="toybox-home">&laquo; Back to Toybox</a>
        <div class="item-type">-</div>
        <h4 class="item-name">-</h4>
        <div class="item-desc">-</div>
        <div class="icon"><img src=""></div>
        <br>
        <a class="btn buy mt-2 equip" onclick="equipItem()">Equip</a>
        <a class="btn buy mt-2 unequip" onclick="unequipItem()">Unequip</a>
    </div>
</div>

<div class="window" id="travel">
    <div class="header float-left">Travel</div>
    <div class="close-window float-right" onclick="closeWindow(this)">x</div>
    <div class="inner" id="travel-home" style="display:block">
    <h4>Public Rooms</h4>
    <ul>
        <li><a class="travel-link" href="<?php echo base_url('move/1') ?>">Welcome Island</a></li>
        <li><a class="travel-link" href="<?php echo base_url('move/2') ?>">Dog Park</a></li>
    </ul>
    <h4>User Rooms</h4>
    <ul>
        <li><a class="travel-link" href="<?php echo base_url('move/6') ?>">My Room</a></li>
    </ul>
    <hr>
    <label>Search Room</label>
    <div class="search-map">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Type a username" name="keyword">
            <div class="input-group-append">
                <button type="button" class="input-group-text btn">Search</button>
            </div>
        </div>
    </div>
    <div class="results mt-2">
    </div>
</div>

<script>
    var map = <?php echo json_encode($map) ?>;
    var pet = <?php echo json_encode($pet) ?>;
    var pets = <?php echo json_encode($pets) ?>;
    var chat = <?php echo json_encode($chat) ?>;
    var baseUrl = '<?php echo base_url() ?>';
    var username = '<?php echo $this->user->username ?>';
</script>
<?php $this->load->view('footer')?>