<h1>Insert Data</h1>
<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
    <input type="hidden" name="action" value="edi_data_insert_save">
    <?php wp_nonce_field('edi_data_insert_save_nonce', 'edi_data_insert_nonce'); ?>

    <p>
        <label for="code">Code:</label>
        <input type="text" name="code" id="code" required>
    </p>
    <p>
        <label for="category">Category:</label>
        <input type="text" name="category" id="category" required>
    </p>
    <p>
        <label for="group">Group:</label>
        <input type="text" name="group" id="group" required>
    </p>
    <p>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
    </p>
    
    <p>
        <input type="submit" value="Save Data">
    </p>
</form>

<?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <div class="notice notice-success">
        <p>Data saved successfully!</p>
    </div>
<?php endif; ?>