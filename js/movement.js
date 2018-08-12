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

$( document ).ready(function() {
    $('.hat').attr('src', pet.gif.hat.idle);
    $('.pet').attr('src', pet.gif.idle);
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
    $('.hat').attr('src', pet.gif.hat.walk);
    $('.pet').attr('src', pet.gif.walk);
    setTimeout(function(){
        $('.hat').attr('src', pet.gif.hat.idle);
        $('.pet').attr('src', pet.gif.idle);
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
    $('.hat').attr('src', pet.gif.hat.walk);
    $('.pet').attr('src', pet.gif.walk);
    setTimeout(function(){
        $('.hat').attr('src', pet.gif.hat.idle);
        $('.pet').attr('src', pet.gif.idle);
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
