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
}

$( document ).ready(function() {
    updateHatImage(pet.user_id, pet.gif.hat.idle);
    updatePetImage(pet.user_id, pet.gif.idle);
    for (var i = pets.length - 1; i >= 0; i--) {
        updatePetImage(pets[i].user_id, pets[i].gif.idle);
        console.log(pets[i].user_id);
        console.log(pets[i].gif.idle);
    }
    window.setInterval(function(){
        randomWalk();
    }, 8000);
});

function randomWalk() {
    if(getRandomInt(2)) {
        walkX();
    } else {
        walkY();
    }
}

function walkX() {
    var distance = 0;
    if(getRandomInt(2)) {
        distance  = -10;
        $('.pet-container img').css('transform', 'scaleX(-1)');
    } else {
        distance  = 10;
        $('.pet-container img').css('transform', 'scaleX(1)');
    }
    var currentX = parseInt($('.pet-container').css('left'));
    var destinationX = currentX + distance;
    if(!checkValidWalkX(destinationX)) {
        return false;
    }
    $('.pet-container').css('left', destinationX + 'px');
    updateHatImage(pet.user_id, pet.gif.hat.walk);
    updatePetImage(pet.user_id, pet.gif.walk);
    setTimeout(function(){
        updateHatImage(pet.user_id, pet.gif.hat.idle);
        updatePetImage(pet.user_id, pet.gif.idle);
    }, walkTimeout);
}

function walkY() {
    var distance = 0;
    if(getRandomInt(2)) {
        distance  = -10;
    } else {
        distance  = 10;
    }
    var currentY = parseInt($('.pet-container').css('top'));
    var destinationY = currentY + distance;
    if(!checkValidWalkY(destinationY)) {
        return false;
    }
    $('.pet-container').css('top', destinationY + 'px');
    updateHatImage(pet.user_id, pet.gif.hat.walk);
    updatePetImage(pet.user_id, pet.gif.walk);
    setTimeout(function(){
        updateHatImage(pet.user_id, pet.gif.hat.idle);
        updatePetImage(pet.user_id, pet.gif.idle);
    }, walkTimeout);
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
