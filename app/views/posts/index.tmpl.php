<?php require_once COMPONENTS.'/header.php'; ?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <?php require_once COMPONENTS.'/sidebar.php'; ?>
            
            <div class="col-10">
                <h2><?= $header ?></h2>
                
                <div class="posts-container mt-4">
                    <?php if(!empty($posts)): ?>
                        <?php foreach($posts as $post): ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h3 class="card-title"><?= $post['title'] ?></h3>
                                    <p class="card-text"><?= $post['excerpt'] ?></p>
                                    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item <?= ($paginator->page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= ($paginator->page > 1) ? $paginator->page - 1 : 1 ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php for($i=1; $i<=$paginator->pages_count; $i++): ?>
                                    <li class="page-item <?= ($i == $paginator->page) ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?=$i?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?= ($paginator->page >= $paginator->pages_count) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= ($paginator->page < $paginator->pages_count) ? $paginator->page + 1 : $paginator->pages_count ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    <?php else: ?>
                        <p>No posts found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once COMPONENTS.'/footer.php'; ?> 