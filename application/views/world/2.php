<?php $this->load->view('world/world-header')?>

<div class="game">
    <div class="top">
        <h1>cocobox</h1>
        <?php $this->load->view('world/world-menu')?>
    </div>
    <div class="game-container">
        <div class="left">
            <div class="world dog-park" style="background: url('<?php echo base_url('img/dogpark/land.png') ?>')">
                <?php $this->load->view('world/pets')?>
                <img src="<?php echo base_url('img/dogpark/tree.png') ?>" class="dog-park-tree">
            </div>
        </div>
        <div class="right">
            <?php $this->load->view('world/chat')?>
        </div>
    </div>
</div>

<?php $this->load->view('world/world-footer')?>