<?php if(isset($_SESSION['success'])) : ?>
<div class="note note-success">
    <h5 style="padding: 0;margin: 0"><?php echo $_SESSION['success'] ; unset($_SESSION['success']) ?></h5>
</div>
<?php endif;  ?>

<?php if(isset($_SESSION['errors'])) : ?>
    <div class="note note-errors">
        <h5 style="padding: 0;margin: 0"><?php echo $_SESSION['errors'] ; unset($_SESSION['errors']) ?></h5>
    </div>
<?php endif;  ?>
