var shop = [];
var toybox = [];
var product = {};
var item = {};
var windowZ = 1000;
var types = ['hats', 'trees', 'beds', 'land'];

if (pets.length) {
    console.log(pets[0]);

}

$('.window').on('click', function () {
    $(this).css('z-index', ++windowZ);
});

$('.world').on('click', '.bean', function () {
    $('.bean').css('transform', 'scale(0)');
    setTimeout(function(){
        $('.bean').remove();
    }, 1000);
    $.get("collect/bean", function (result) {
        if (parseInt(result)) {
            animateBeanCount(12);
        }
    });
});

function animateBeanCount(addened) {
    var current = parseInt($('#my-beans').text());
    $({ numberValue: current })
        .animate({ numberValue: current + addened }, {
            duration: 500,
            easing: 'linear',
            step: function () {
                $('#my-beans').text(Math.floor(this.numberValue + 1));
            }
        });
}

$(document).keyup(function(e) {
    if (e.key === "Escape") {
        if ($('.window:visible').length) {
            var windowToClose = getFrontWindowName();
            $('#' + windowToClose).fadeOut('fast');
        }
    }
});

function getFrontWindowName() {
    var windowsz = {
        shop: $('#shop:visible').css('z-index'),
        toybox: $('#toybox:visible').css('z-index'),
        travel: $('#travel:visible').css('z-index')
    }
    var sortable = [];
    for (var vehicle in windowsz) {
        sortable.push([vehicle, windowsz[vehicle]]);
    }

    sortable.sort(function(a, b) {
        if (!a[1]) a[1] = 0;
        if (!b[1]) b[1] = 0;
        return a[1] - b[1];
    });
    return sortable[sortable.length - 1][0];
}

$(".chat input").on('keyup', function (event) {
    if (event.key == 'Enter') {
        sendChat();
    }
});

$('.chat button').on('click', function () {
    sendChat();
});

$(".search-map input").on('keyup', function (event) {
    if (event.key == 'Enter') {
        searchMap();
    }
});

$('.search-map button').on('click', function () {
    searchMap();
});

function welcomeChat() {
    var message = 'Welcome to Cocobox!';
    $('.messages').append("<div class='text-muted'>" + message + "</div>");
}

function sendChat() {
    var message = $('[name=message]').val();
    $('.messages').append("<div><b>" + username + "</b>: " + message + "</div>");
    $('[name=message]').val('');
    $.post("chat/send", { message: message }, function (result) {
        console.log(result);
    });
}

function searchMap() {
    var keyword = $('[name=keyword]').val();
    $.post("map/search", { keyword: keyword }, function (result) {
        console.log(result);
        displaySearchMapResults(keyword, result);
        $('[name=keyword]').val('');
    });
}

function displaySearchMapResults(keyword, result) {
    $('#travel .results').empty();
    $('#travel .results').append("<label>Rooms for \"" + keyword + "\"</label>");
    var list = $("#travel .results").append('<ul></ul>').find('ul');
    for (let i = 0; i < result.length; i++) {
        const room = result[i];
        list.append("<li><a href='" + base_url + 'move/' + room.id + "'>" + room.username + "</a></li>");
    }
    if(result.length == 0) {
        list.append("<li class='text-muted'>No rooms found</li>");
    }
}

$('.link').on('click', function () {
    var page = $(this).data('link');
    var win = '#' + $(this).closest('.window').attr('id');
    $(win + ' .inner').hide();
    $(win + ' #' + page).show();
})
$('.icon-row').on('click', '.product', function () {
    $('#product .error').text('');
    var id = $(this).data('id');
    var type = $(this).data('type');
    product = getItem(type, id);
    $('#product .item-type').text(getTypeLabel(product.type));
    $('#product .item-name').text(product.name);
    $('#product .item-price').text(product.price);
    $('#product .item-desc').text(product.description);
    $('#product .icon img').attr('src', base_url + 'img/equip/' + product.type + product.id + '-icon.gif');
    $('#shop .inner').hide();
    $('#product .back').attr('data-link', 'shop-' + getTypeLabel(product.type));
    $('#product .back').html('&laquo; Back to ' + getTypeLabel(product.type));
    if (itemOwned(product.type, product.id)) {
        $('#product .buy').hide();
        $('#product .owned').show();
    } else {
        $('#product .buy').show();
        $('#product .owned').hide();
    }
    $('#product').show();
});

$('.icon-row').on('click', '.item', function () {
    var id = $(this).data('id');
    var type = $(this).data('type');
    item = getItem(type, id);
    $('.item-type').text(getTypeLabel(item.type));
    $('.item-name').text(item.name);
    $('.item-desc').text(item.description);
    $('#item .icon img').attr('src', base_url + 'img/equip/' + item.type + item.id + '-icon.gif');
    $('#toybox .inner').hide();
    if (itemEquipped(item.type, item.id)) {
        $('#item .equip').hide();
        $('#item .unequip').show();
    } else {
        $('#item .equip').show();
        $('#item .unequip').hide();
    }
    $('#item').show();
});

function itemOwned(type, item_id) {
    var owned = false;
    toybox[getTypeLabel(type)].forEach(function (item) {
        if (item.id == item_id) {
            owned = true;
        }
    });
    return owned;
}

function itemEquipped(type, item_id) {
    var equipped = false;
    if (type == 'h') {
        equipped = pet.hat_id == item_id;
    }
    if (type == 't') {
        equipped = map.tree_id == item_id;
    }
    if (type == 'b') {
        equipped = map.bed_id == item_id;
    }
    if (type == 'l') {
        equipped = map.land_id == item_id;
    }
    return equipped;
}

function closeWindow(element) {
    $(element).closest('.window').fadeOut('fast');
}

function getItem(type, id) {
    var category = getTypeLabel(type);
    for (var i = 0; i < shop[category].length; i++) {
        if (shop[category][i].id == id) {
            product = shop[category][i];
        }
    }
    return product;
}

function getTypeLabel(type) {
    var label;
    if (type == 'h') {
        label = 'hats';
    }
    if (type == 't') {
        label = 'trees';
    }
    if (type == 'b') {
        label = 'beds';
    }
    if (type == 'l') {
        label = 'land';
    }

    return label;
}


function buyItem() {
    $.get("shop/buy/" + product.id, function (result) {
        if (result.type == 'error') {
            $('#product .error').text(result.message);
        } else {
            animateBeanCount(-product.price);
            $('#product .buy').hide();
            $('#product .owned').show();
            addItemToToybox(product);
        }
    })
}

function equipItem() {
    if (item.type == 'h') {
        equipHat(item.id);
    }
    if (item.type == 't') {
        equipTree(item.id);
    }
    if (item.type == 'b') {
        equipBed(item.id);
    }
    if (item.type == 'l') {
        equipLand(item.id);
    }
    setToyboxButton('equip');
}

function unequipItem() {
    if (item.type == 'h') {
        unequipHat();
    }
    if (item.type == 't') {
        unequipTree();
    }
    if (item.type == 'b') {
        unequipBed();
    }
    if (item.type == 'l') {
        unequipLand();
    }
    setToyboxButton('unequip');
}

function equipHat(hat_id) {
    pet.gif.hat.idle = baseUrl + 'img/equip/h' + hat_id + '.gif';
    pet.gif.hat.walk = baseUrl + 'img/equip/h' + hat_id + '_walk.gif';
    updatePetImage(pet.user_id, pet.gif.idle);
    updateHatImage(pet.user_id, pet.gif.hat.idle);

    $.get("pet/equip/" + hat_id, function (result) {
        console.log(result);
    })
}

function equipTree(tree_id) {
    $('.tree').attr('src', baseUrl + 'img/equip/t' + tree_id + '.gif');

    $.get("map/equip/" + tree_id, function (result) {
        map.tree_id = tree_id;
        console.log(result);
    })
}

function equipBed(bed_id) {
    $('.bed').attr('src', baseUrl + 'img/equip/b' + bed_id + '.gif');

    $.get("map/equip/" + bed_id, function (result) {
        map.bed_id = bed_id;
        console.log(result);
    })
}

function equipLand(land_id) {
    $('.world').css('background', 'url("' + baseUrl + 'img/equip/l' + land_id + '.gif' + '")');

    $.get("map/equip/" + land_id, function (result) {
        map.land_id = land_id;
        console.log(result);
    })
}

function unequipHat(hat_id) {
    pet.gif.hat.idle = null;
    pet.gif.hat.walk = null;
    updatePetImage(pet.user_id, pet.gif.idle);
    updateHatImage(pet.user_id, pet.gif.hat.idle);
    $.get("pet/unequip/", function (result) {
        console.log(result);
    })
}

function updatePetImage(user_id, image) {
    $('[data-user-id=' + user_id + '] .pet').attr('src', image);
}

function updateHatImage(user_id, image) {
    $('[data-user-id=' + user_id + '] .hat').attr('src', image);
}

function unequipTree(tree_id) {
    $('.tree').attr('src', null);

    $.get("map/unequip/t", function (result) {
        map.tree_id = null;
        console.log(result);
    })
}

function unequipBed(bed_id) {
    $('.bed').attr('src', null);

    $.get("map/unequip/b", function (result) {
        map.bed_id = null;
        console.log(result);
    })
}

function unequipLand(land_id) {
    equipLand(12);
}

function openShop() {
    $('#shop').fadeIn('fast');
    $('#shop').css('z-index', ++windowZ);
}

function openToybox() {
    $('#toybox').fadeIn('fast');
    $('#toybox').css('z-index', ++windowZ);
}

function openTravel() {
    $('#travel').fadeIn('fast');
    $('#travel').css('z-index', ++windowZ);
    $('#travel [name=keyword]').focus(  );
}

function setToyboxButton(mode) {
    if (mode == 'equip') {
        $('#item .equip').hide();
        $('#item .unequip').show();
    } else {
        $('#item .equip').show();
        $('#item .unequip').hide();
    }
}

function addItemToToybox(item) {
    $('#toybox-' + getTypeLabel(item.type) + ' .icon-row').append('<a class="item icon" data-id="' + item.id + '" data-type="' + item.type + '"><img src="' + base_url + 'img/equip/' + item.type + item.id + '-icon.gif"></a>');
    $('#toybox-' + getTypeLabel(item.type) + ' .icon-row .no-items').remove();
}

function updateChat() {
    $.get("chat/get", function (result) {
        $('.messages').empty();
        welcomeChat();
        for (var i = 0; i < result.length; i++) {
            $('.messages').append("<div><b>" + result[i].username + "</b>: " + result[i].message + "</div>");
        }
    })
}

function updateBean() {
    if (!$(".bean").length) {
        $.get("collect/check/bean", function (result) {
            if (result == '1') {
                var x = getPetX(pet.user_id);
                var y = getPetY(pet.user_id) - 25;
                $('.world').append("<img src='" + base_url + "img/loot/bean.png' class='bean' style='top:" + y + "px; left: " + x + "px;'>");
                var z = parseInt($($('.bean')).offset().top) - 140;
                $('.bean').css('z-index', z);
            }
        })
    }
}

function updatePets() {
    $.get("map/info", function (result) {
        for (let i = 0; i < result.length; i++) {
            for (let j = 0; j < pets.length; j++) {
                if (pets[j].user_id == result[i].user_id) {
                    pets[j] = result[i];
                }
            }
        }

        for (var i = pets.length - 1; i >= 0; i--) {
            pets[i].gif = {};
            pets[i].gif.idle = baseUrl + 'img/pet/' + pets[i].race_id + '.gif';
            pets[i].gif.walk =  baseUrl + 'img/pet/' + pets[i].race_id + '_walk.gif';
            pets[i].gif.hat = {};
            if(pets[i].hat_id) {
                pets[i].gif.hat.idle = baseUrl + 'img/equip/h' + pets[i].hat_id + '.gif';
                pets[i].gif.hat.walk = baseUrl + 'img/equip/h' + pets[i].hat_id + '_walk.gif';
            } else {
                pets[i].gif.hat.idle = null;
                pets[i].gif.hat.walk = null;
            }
        }
    })
}

$(document).ready(function () {

    // Get chat messages
    window.setInterval(function () {
        updateChat();
    }, 2000);

    window.setInterval(function () {
        updateBean();
    }, 10000);

    window.setInterval(function () {
        updatePets();
    }, 4000);
    
    // Init draggable windows
    $(".window").draggable({
        start: function () {
            $(this).css('z-index', ++windowZ);
        },
        cancel: ".inner"
    });

    // Fetch shop
    $.get("shop/get", function (result) {
        shop = result;
        types.forEach(function (type) {
            for (var i = 0; i < shop[type].length; i++) {
                $('#shop-' + type + ' .icon-row').append('<a class="product icon" data-id="' + shop[type][i].id + '" data-type="' + shop[type][i].type + '"><img src="' + base_url + 'img/equip/' + shop[type][i].type + shop[type][i].id + '-icon.gif"></a>');
            }
        });
    })

    // Fetch toybox
    $.get("toybox/get", function (result) {
        toybox = result;
        types.forEach(function (type) {
            console.log(type);
            console.log(toybox[type].length);
            if (!toybox[type].length) {
                $('#toybox-' + type + ' .icon-row').append('<div class="no-items">You do not own any ' + type + '</div>');
            }
            for (var i = 0; i < toybox[type].length; i++) {
                $('#toybox-' + type + ' .icon-row').append('<a class="item icon" data-id="' + toybox[type][i].id + '" data-type="' + toybox[type][i].type + '"><img src="' + base_url + 'img/equip/' + toybox[type][i].type + toybox[type][i].id + '-icon.gif"></a>');
            }
        });
    })

});