<div class="chat">
    <div class="messages" id="messages">
        <div class="text-muted">Welcome to Cocobox!</div>
        <?php foreach ($chat as $message): ?>
            <div><b><?php echo $message->username ?>:</b> <?php echo $message->message ?></div>
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