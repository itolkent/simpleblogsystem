<?php if (!empty($_SESSION['flash_errors'])): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($_SESSION['flash_errors'] as $e): ?>
                <li>
                    <?= htmlspecialchars($e) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php unset($_SESSION['flash_errors']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['flash_success'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION['flash_success']); ?>
    </div>
    <?php unset($_SESSION['flash_success']); ?>
<?php endif; ?>