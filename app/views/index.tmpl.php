<?php $posts = $posts ?? []; ?>

<?php require_once(COMPONENTS.'/header.php'); ?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <?php require_once(COMPONENTS.'/sidebar.php'); ?>
            
            <div class="col-10">
                <h3><?= $header ?? "" ?></h3>
                <?php foreach ($posts as $post): ?>
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title"><a href="post?id=<?= $post['post_id'] ?>"><?= $post['title'] ?></a></h5>
                                <p class="card-text"><?= $post['excerpt'] ?></p>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                
                <?php if(isset($paginator) && $paginator->pages_count > 1): ?>
                <nav aria-label="Page navigation">
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
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php require_once(COMPONENTS.'/footer.php'); ?> 