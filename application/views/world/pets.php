<div class="pet-container" data-user-id="<?php echo $this->user->id ?>">
    <img src="" class="hat">
    <img src="" class="pet">
    <i><?php echo $this->user->username ?></i>
</div>
<?php foreach ($pets as $index => $otherpet): ?>
    <?php $top = rand(-100, -20); ?>
    <?php $left = rand(-120, 120); ?>
    <?php $scale = rand(0, 1) ? -1 : 1; ?>
    <div class="pet-container" data-user-id="<?php echo $otherpet->user_id ?>" style="top: <?php echo $top ?>px; left: <?php echo $left ?>px">
        <img src="" style="transform: scaleX(<?php echo $scale ?>)" class="hat">
        <img src="" style="transform: scaleX(<?php echo $scale ?>)" class="pet">
        <i><?php echo $otherpet->username ?></i>
    </div>
<?php endforeach?>