<?php $this->load->view('world/world-header')?>

<div class="game">
    <div class="top">
        <h1>cocobox</h1>
        <?php $this->load->view('world/world-menu')?>
    </div>
    <div class="game-container">
        <div class="left">
            <div class="world" style="background-image: url('<?php echo item_image_url('l', $map->land_id) ?>')">
                <?php $this->load->view('world/pets')?>
                <img src="<?php echo item_image_url('t', $map->tree_id) ?>" class="tree">
                <img src="<?php echo item_image_url('b', $map->bed_id) ?>" class="bed">
                <?php if (!empty($bean)): ?>
                    <img src="<?php echo base_url('img/loot/bean.png') ?>" class="bean">
                <?php endif?>
            </div>
        </div>
        <div class="right">
            <?php $this->load->view('world/chat')?>
        </div>
    </div>
</div>

<?php $this->load->view('world/world-footer')?>