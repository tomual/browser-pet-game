var maxX = 140;
var minX = -140;
var maxY = 130;
var minY = 80;
var walkTimeout = 2400;

pet.gif = {};
pet.gif.idle = baseUrl + 'img/pet/' + pet.race_id + '.gif';
pet.gif.walk =  baseUrl + 'img/pet/' + pet.race_id + '_walk.gif';
pet.gif.hat = {};
if(pet.hat_id) {
    pet.gif.hat.idle = baseUrl + 'img/equip/h' + pet.hat_id + '.gif';
    pet.gif.hat.walk = baseUrl + 'img/equip/h' + pet.hat_id + '_walk.gif';
} else {
    pet.gif.hat.idle = null;
    pet.gif.hat.walk = null;
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

$( document ).ready(function() {
    updateHatImage(pet.user_id, pet.gif.hat.idle);
    updatePetImage(pet.user_id, pet.gif.idle);
    updatePetZIndex(pet.user_id);
    for (var i = pets.length - 1; i >= 0; i--) {
        updatePetImage(pets[i].user_id, pets[i].gif.idle);
        updatePetZIndex(pets[i].user_id);
    }
    window.setInterval(function(){
        randomWalk();
    }, 8000);
});

function randomWalk() {
    var all_pets = pets.slice();
    all_pets.push(pet);
    target = all_pets[getRandomInt(pets.length - 1)];
    if(getRandomInt(2)) {
        walkX(target);
    } else {
        walkY(target);
    }
}

function walkX(target) {
    var distance = 0;
    if(getRandomInt(2)) {
        distance  = -20;
        flipPet(target.user_id, -1);
    } else {
        distance  = 20;
        flipPet(target.user_id, 1);
    }
    var currentX = getPetX(target.user_id);
    var destinationX = currentX + distance;
    if(!checkValidWalkX(destinationX)) {
        return false;
    }
    movePetX(target.user_id, destinationX);
    updateHatImage(target.user_id, target.gif.hat.walk);
    updatePetImage(target.user_id, target.gif.walk);
    setTimeout(function(){
        updateHatImage(target.user_id, target.gif.hat.idle);
        updatePetImage(target.user_id, target.gif.idle);
    }, walkTimeout);
}

function walkY(target) {
    var distance = 0;
    if(getRandomInt(2)) {
        distance  = -10;
    } else {
        distance  = 10;
    }
    var currentY = getPetY(target.user_id);
    var destinationY = currentY + distance;
    if(!checkValidWalkY(destinationY)) {
        return false;
    }
    movePetY(target.user_id, destinationY);
    updateHatImage(target.user_id, target.gif.hat.walk);
    updatePetImage(target.user_id, target.gif.walk);
    setTimeout(function(){
        updateHatImage(target.user_id, target.gif.hat.idle);
        updatePetImage(target.user_id, target.gif.idle);
    }, walkTimeout);
}

function getPetX(user_id) {
    var x = $('[data-user-id=' + user_id + ']').css('left');
    return parseInt(x);
}

function movePetX(user_id, destinationX) {
    $('[data-user-id=' + user_id + ']').css('left', destinationX + 'px');
}

function getPetY(user_id) {
    var y = $('[data-user-id=' + user_id + ']').css('top');
    return parseInt(y);
}

function movePetY(user_id, destinationY) {
    $('[data-user-id=' + user_id + ']').css('top', destinationY + 'px');
    updatePetZIndex(user_id);
}

function updatePetZIndex(user_id) {
    var offsetY = parseInt($($('[data-user-id=' + user_id + ']')).offset().top);
    $('[data-user-id=' + user_id + ']').css('z-index', offsetY);
}

function flipPet(user_id, scaleX) {
    $('[data-user-id=' + user_id + '] img').css('transform', 'scaleX(' + scaleX + ')');
}

function getRandomInt(max) {
    return Math.floor(Math.random() * Math.floor(max));
}

function checkValidWalkX(destinationX) {
    if(destinationX > maxX || destinationX < minX) {
        return false;
    }
    return true;
}

function checkValidWalkY(destinationY) {
    if(destinationY > maxY || destinationY < minY) {
        return false;
    }
    return true;
}
