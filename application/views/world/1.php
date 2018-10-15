<?php $this->load->view('world/world-header')?>

<div class="game">
    <div class="top">
        <h1>cocobox</h1>
        <?php $this->load->view('world/world-menu')?>
    </div>
    <div class="game-container">
        <div class="left">
            <div class="world welcome-island" style="background: url('<?php echo base_url('img/welcome/land.png') ?>')">
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

<?php $this->load->view('world/world-footer')?>