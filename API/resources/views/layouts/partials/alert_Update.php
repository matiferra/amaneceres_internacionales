<?php if(isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['message']['type']; ?>">
        <?php echo $_SESSION['message']['text']; ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>